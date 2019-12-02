<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 13-11-2019
 * Time: 12:12
 */
include_once("C:/xampp/htdocs/WWI/src/core/DbHandler.php");
$db = new DbHandler("ERP");
$connection = $db->connect();
$sql = "SELECT StockGroupID, StockGroupName from stockgroups ";
$stmt = $connection->prepare($sql);
$stmt->execute();
$groepen = $stmt->fetchAll();
$db->disconnect();
$db = null;

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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- Project stylesheet includes -->
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <!-- Fontawesome, handles the icons -->
    <script src="https://kit.fontawesome.com/6756a99abc.js" crossorigin="anonymous"></script>
    <!-- Bootstrap javascript include -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</head>
<body>

<!-- Header start -->
<div class="header bg-info">
    <div class="container p-3">
        <div class="row">
            <!-- Logo -->
            <a class="col-2 col-md-1 pr-0" href="index.php">
                <img class="logo-small m-auto" src="images/wwi_logo_small.png" alt="">
            </a>
            <!-- Title -->
            <a class="col-6 col-md-7 my-auto pl-md-0" href="index.php">
                <h1 class="title">Wide World <span class="text-secondary">Importers</span></h1>
            </a>
            <!-- Account & shopping cart icons -->
            <span class="col-4 my-auto icons text-right">
                <a class="mr-3 mr-md-5 text-white" href="#">
                    <i class="fas fa-user-alt"></i>
                </a>
                <a class="mr-md-3" href="#">
                    <i class="fas fa-shopping-cart text-white"></i>
                </a>
            </span>
            <!-- Menu icon -->
            <a class="col-2 col-md-1 pr-0 text-center" id="dropdownMenuLink" role="button" data-toggle="dropdown"
               aria-haspopup="true">
                <span class="menu-button my-auto text-white"><i class="fas fa-bars black"></i></span>
            </a>
            <div class="dropdown show">
                <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"><i
                            class="fas fa-bars fa-2x"></i>
                </a>
                <div class="col-12">
                <div class="dropdown-menu bg-secondary" aria-labelledby="dropdownMenuLink" style="width: 100%">
                    <!--        <button type="button" class="close">&times;</button>-->
                    <div class="row">
                        <?php
                        foreach ($groepen as $groep) {
                            print("
                     <div class='col text-center'>
                    <a class='btn' href='productPagina.php?productgroep=".$groep['StockGroupID']."'>
                    <img class='center' style='width:60px' src=images/categorieicons/groep".$groep['StockGroupID'].".png >
                    <h5>".$groep['StockGroupName']."</h5>
                    </a>
                </div> ");
                        }
                        ?>
                    </div>
                </div>
                </div>
            </div>

            <!-- Search bar -->
            <form class="col-10 col-md-11 pl-0 input-group" method="post">
                <input class="search form-control mr-0" type="text" name="search" placeholder="Zoeken"
                       aria-label="none">
                <div class="input-group-append">
                    <span class="input-group-text icons"><i class="fas fa-filter"></i></span>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Header end -->