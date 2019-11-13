<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 13-11-2019
 * Time: 12:12
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $pageTitle ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="WideWorldImporters">
        <meta name="keywords" content="WWI, WideWorldImporters">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
<body>

<nav class="navbar">
    <div class="col-12">
        <a class="navbar-brand" href="<?__ROOT__?>/public/index.php">
            <img>
        </a>
        <a class="navbar-brand" href="<?__ROOT__?>/public/index.php">
            Wide World Importers
        </a>
        <span></span>
    </div>
    <div class="col-12">
        <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span></span>
        </a>
        <form>
            <label><span></span></label>
            <input type="text" name="search" placeholder="Zoeken">
        </form>
    </div>
</nav>
