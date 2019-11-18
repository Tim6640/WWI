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
        <!-- $pageTitle is defined on the page visited -->
        <title><?= $pageTitle ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="WideWorldImporters">
        <meta name="keywords" content="WWI, WideWorldImporters">
        <!-- Bootstrap stylesheet include -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- Project stylesheet includes -->
        <link rel="stylesheet" href="css/header.css">
        <!-- Fontawesome, handles the icons -->
        <script src="https://kit.fontawesome.com/6756a99abc.js" crossorigin="anonymous"></script>
        <!-- Bootstrap javascript include -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
<body>
<!-- Header start -->
<div class="header bg-primary">
    <div class="container p-3">
        <div class="row">
            <!-- Logo -->
            <a class="col-2 col-md-1 pr-0" href="index.php">
                <img class="logo-small m-auto" src="images/wwi_logo_small.png" alt="">
            </a>
            <!-- Title -->
            <a class="col-6 col-md-7 my-auto pl-md-0" href="index.php">
                <h1 class="title">Wide World <span>Importers</span></h1>
            </a>
            <!-- Account & shopping cart icons -->
            <span class="col-4 my-auto icons text-right">
                <a class="mr-3 mr-md-5" href="#">
                    <i class="fas fa-user-alt"></i>
                </a>
                <a class="mr-md-3" href="#">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </span>
            <!-- Menu icon -->
            <a class="col-2 col-md-1 pr-0 text-center" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="menu-button my-auto"><i class="fas fa-bars black"></i></span>
            </a>
            <!-- Search bar -->
            <form class="col-10 col-md-11 pl-0 input-group" method="post">
                <input class="search form-control mr-0" type="text" name="search" placeholder="Zoeken" aria-label="none">
                <div class="input-group-append">
                    <span class="input-group-text icons"><i class="fas fa-filter"></i></span>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Header end -->
