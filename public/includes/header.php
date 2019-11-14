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
        <link rel="stylesheet" href="css/header.css">
        <script src="https://kit.fontawesome.com/6756a99abc.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
<body>

<nav class="navbar bg-light">
    <div class="container-fluid p-0">
        <div class="row">
            <a class="col-2 pr-0" href="<?=__ROOT__?>/public/index.php">
                <img class="logo-small img-fluid" src="images/wwi_logo_small.png" alt="">
            </a>
            <a class="col-6 my-auto" href="<?=__ROOT__?>/index.php">
                <h1 class="title">Wide World <span>Importers</span></h1>
            </a>
            <span class="col-4 my-auto icons text-center">
                <a class="mr-3">
                    <i class="fas fa-user-alt"></i>
                </a>
                <a>
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </span>
            <a class="col-2 pr-0" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="menu-button my-auto"><i class="fas fa-bars black"></i></span>
            </a>
            <form class="col-10 pl-0 input-group" method="post">
                <input class="search form-control mr-0" type="text" name="search" placeholder="Zoeken">
                <div class="input-group-append">
                    <span class="input-group-text icons"><i class="fas fa-filter"></i></span>
                </div>
            </form>
        </div>
    </div>
</nav>
