<?php
include_once("functions.php");
$meta = getMeta();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= $meta['description'] ?>" />
    <title><?= $meta['title'] ?> </title>

    <?php getCSS(); ?>
</head>

<body></body>