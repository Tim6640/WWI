<!doctype html>
<?php
//add include
//$pageTitle = "product"
?>
<html lang="Ne">
<head>
    <!--    # benodigde meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <!--    # bootstrap aan php kopelen-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"
          media="all">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3c0f9f28b6.js" crossorigin="anonymous"></script>
    <title>Product pagina</title>
</head>

<?php

// Logica
if (isset($_GET["pid"])) {
    $productNummer = $_GET["pid"];


} else {
    print ("helaas bestaat het gezochte product niet<br>");
    print ("klik <a href='/wwi/public'>hier</a> om terug te gaan naar de thuispagina");
}

// SQL SETUP

$host = "localhost";
$databasename = "wideworldimporters";
$user = "root";
$pass = null;
$port = 3306;
$connection = mysqli_connect($host, $user, $pass, $databasename, $port);
$sql = "SELECT StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemID=?";
$statement = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($statement, 'i', $productNummer);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$name = $row["StockItemName"];
$price = $row["RecommendedRetailPrice"];


?>
<!--# einde voorwerk-->
<!--# begin pagina-->
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h6 class="text-center" style="font-size: x-large">
                <?php print($name); ?>
            </h6>
        </div>
    </div>
    <div class="row" style="font-size: larger">
        <div class="col-9">
            Score:
            <i class="fas fa-star" style="color: gold"></i>
            <i class="fas fa-star" style="color: gold"></i>
            <i class="fas fa-star" style="color: gold"></i>
            <i class="fas fa-star" style="color: gold"></i>
            <i class="fas fa-star" style="color: gold"></i>
        </div>
        <div class="col-3">
            <a href="betalingbevestiging.php">
                <i class="fas fa-cart-plus"></i>
            </a>
            <a href="betalingbevestiging.php">
                <i class="fas fa-heart"></i> </a>
        </div>
    </div>
<!--    Carrousel start-->
    <div class="row">
    <div class="col-12">
        <div id="carousel" class="carousel slide" data-ride="carousel" data-pause="hover" style=" width:100%; height: 100%; !important;">
<!--            Carrousel inner items-->
            <div class="carousel-inner" style="margin-bottom:10%; height: 100%">
                <div class="carousel-item active">
                    <img class="img-fluid" src="test1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="img-fluid" src="test2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="img-fluid" src="test3.jpg" alt="Third slide">
                </div>
                <div class="carousel-item" style="video{ width:100%; height: auto}">
                    <video width="100%" height="auto" autoplay>
                        <source src="test4.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
<!--            Carrousel controls-->
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
<!--            Carrousel small indicators !!help me with the scaling!!-->
            <ol class="carousel-indicators" style="height: available">
                <li data-target="#carousel" data-slide-to="0" class="active" style="width: 20%;">
                    <img class="d-block w-100" src="test1.jpg">
                </li>
                <li data-target="#carousel" data-slide-to="1" style="width: 20%">
                    <img class="d-block w-100" src="test2.jpg">
                </li>
                <li data-target="#carousel" data-slide-to="2" style="width: 20%">
                    <img class="d-block w-100" src="test3.jpg">
                </li>
                <li data-target="#carousel" data-slide-to="3" style="width: 20%">
                    <img class="d-block w-100" src="test3.jpg">
                </li>
            </ol>
        </div>
    </div>
    </div>
    <div class="h-divider" style="margin-top: 5%; border-top: white ">
<!--    items under the carrousel-->
    <div class="row">
        <div class="col-4">
            <h2><?php print("€" . $price); ?></h2>
        </div>
        <div class="col-6">
            <h2>Voorraad</h2>
        </div>
    </div>
<!--    style for css needs to be moved-->
    <style type="text/css">
        .h-divider {
            margin-top: 5px;
            margin-bottom: 5px;
            height: 1px;
            width: 100%;
            border-top: 1px solid gray;
        }
    </style>
    <div class="h-divider">
    </div>
<!--    needs intermediate database  -->
    <div class="col-12">
        <h4>Productcatogorie</h4>
    </div>
    <div class="col-12">
        <div class="panel-body" align="centre">
            Uitgebreide beschrijving van een product die over meerdere paginas kan gaan over een product dit is gewoon
            filler
        </div>
    </div>
    <div class="col-12" align="middle" style="margin-top: 5px">
        <div class="text-centre">
            <a type="button" class="btn btn-primary btn-lg bnt-block" href="winkelmandje.php">
                <i class="fas fa-cart-plus"></i> Voeg toe aan winkelwagen
            </a>
        </div>
        <div class="h-divider">
        </div>
        <div>
            <h1>review space</h1>
        </div>
    </div>
</div>
<?PHP
//close connection
mysqli_stmt_close($statement);
mysqli_free_result($result);
mysqli_close($connection);
?>
</body>


</html>