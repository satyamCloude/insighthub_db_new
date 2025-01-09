<?php

$language = 'en';  // Change this to the desired language code

// Check if the necessary extension is available
if (extension_loaded('pspell')) {
    $pspellConfig = pspell_config_create($language);
    $pspellLink = pspell_new_config($pspellConfig);

    if ($pspellLink) {
        // Function to get suggestions
        function getSpellingSuggestions($word, $pspellLink) {
            $suggestions = pspell_suggest($pspellLink, $word);
            return $suggestions ? $suggestions : [];
        }

        // Get input text from the text area
        $inputText = isset($_POST['textarea_content']) ? $_POST['textarea_content'] : '';

        // Split the text into words
        $words = str_word_count($inputText, 1);

        // Perform spell-checking and provide suggestions
        $misspelledWords = [];
        foreach ($words as $word) {
            if (!pspell_check($pspellLink, $word)) {
                $suggestions = getSpellingSuggestions($word, $pspellLink);
                $misspelledWords[$word] = $suggestions;
            }
        }

        // Display the misspelled words and suggestions
        echo '<pre>';
        print_r($misspelledWords);
        echo '</pre>';
    } else {
        echo 'Error creating pspell link.';
    }
} else {
    echo 'pspell extension not loaded.';
}
