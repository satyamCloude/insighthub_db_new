/**
 * Form Editors
 */

'use strict';

(function () {
  // Snow Theme
  // --------------------------------------------------------------------
  const snowEditor = new Quill('#snow-editor', {
    bounds: '#snow-editor',
    modules: {
      formula: true,
      toolbar: '#snow-toolbar'
    },
    theme: 'snow'
  });

  // Bubble Theme
  // --------------------------------------------------------------------
  const bubbleEditor = new Quill('#bubble-editor', {
    modules: {
      toolbar: '#bubble-toolbar'
    },
    theme: 'bubble'
  });

  // Full Toolbar
  // --------------------------------------------------------------------
  const fullToolbar = [
    [
      {
        font: []
      },
      {
        size: []
      }
    ],
    ['bold', 'italic', 'underline', 'strike'],
    [
      {
        color: []
      },
      {
        background: []
      }
    ],
    [
      {
        script: 'super'
      },
      {
        script: 'sub'
      }
    ],
    [
      {
        header: '1'
      },
      {
        header: '2'
      },
      'blockquote',
      'code-block'
    ],
    [
      {
        list: 'ordered'
      },
      {
        list: 'bullet'
      },
      {
        indent: '-1'
      },
      {
        indent: '+1'
      }
    ],
    ['link', 'image'],
    ['clean'],
  ];

  // Get all elements with the class .full-editor
  const editorElements = document.querySelectorAll('.full-editor');

  // Loop through each element and initialize a Quill editor
  editorElements.forEach(function(editorElement) {
    const fullEditor = new Quill(editorElement, {
      bounds: editorElement,
      placeholder: 'Type Something...',
      modules: {
        formula: true,
        toolbar: fullToolbar
      },
      theme: 'snow'
    });
  });
})();
