<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: back;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
            height: auto;
            background-color: black;
        }

        .message {
            margin-bottom: 20px;
        }

        .signature {
            margin-top: 20px;
            font-style: italic;
            color: #888;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="<?php echo $image; ?>" alt="Company Logo">
        </div>
        <div class="message">
         <?php echo $data; ?>
        </div>
       
         <div class="footer">
           <?php echo $footer ?>
        </div>
    </div>
</body>
</html>
