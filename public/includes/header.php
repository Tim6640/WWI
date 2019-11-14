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
    <div class="container-fluid">
        <div class="row">
            <div class="sm-col-12">
                <div class="row">
                    <a class="col-2 pr-0" href="<?=__ROOT__?>/public/index.php">
                        <img class="logo-small" src="images/wwi_logo_small.png" alt="">
                    </a>
                    <a class="col-7 my-auto" href="<?=__ROOT__?>/index.php">
                        Wide World Importers
                    </a>
                    <span class="col-3 text-center my-auto icons">
                        <a>
                            <i class="fas fa-user-alt mr-1"></i>
                        </a>
                        <a>
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </span>
                </div>
            </div>
            <div class="sm-col-12">
                <div class="row">
                    <a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span><i class="fas fa-bars"></i></span>
                    </a>
                    <form method="post">
                        <input type="text" name="search" placeholder="Zoeken">
                        <span><i class="fas fa-filter"></i></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
