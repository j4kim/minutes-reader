<?php
require "configure.php";
?>
<!DOCTYPE html>
<head>
    <title><?= getenv("TITLE") ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/3.0.1/github-markdown.css">
</head>
<html>
    <body data-edit-link-base="<?= getenv("EDIT_LINK_BASE") ?>">
        <div id="app">
            <!-- App injected by Vue -->
        </div>
    </body>
    <script src="dist/main.js"></script>
</html>