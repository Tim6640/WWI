<!DOCTYPE html>
<html>
<head lang="eng">
    <title>Paginanaam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/11b906cc61.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/categorie-menu.css">

</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */
include_once("../src/core/init.php");
$pageTitle = "Home";
include_once("../public/includes/header.php");

//include_once(PUBLIC_ROOT."includes/footer.php");
?>
<div class="container">
    <div class="dropdown show">
        <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"><i
                    class="fas fa-bars fa-2x"></i>
        </a>
        <div class="dropdown-menu bg-secondary" aria-labelledby="dropdownMenuLink">
            <!--        <button type="button" class="close">&times;</button>-->
            <h5 class="">Menu</h5>
            <div class="row">
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=1'"><i
                                class="fas fa-newspaper fa-3x rounded-circle circle"></i></button>
                    <h5>1</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=2'"><i
                                class="fas fa-user-tie fa-3x rounded-circle circle"></i></button>
                    <h5>2</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=3'"><i
                                class="fas fa-mug-hot fa-3x rounded-circle circle"></i></button>
                    <h5>3</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=4'"><i
                                class="fas fa-tshirt fa-3x rounded-circle circle"></i></button>
                    <h5>4</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=5'"><i
                                class="fas fa-plane fa-3x rounded-circle circle"></i></button>
                    <h5>5</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=6'"><i
                                class="fas fa-laptop fa-3x rounded-circle circle"></i></button>
                    <h5>6</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=7'"><i
                                class="fab fa-usb fa-3x rounded-circle circle"></i></button>
                    <h5>7</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=8'"><i
                                class="fas fa-shoe-prints fa-3x rounded-circle circle"></i></button>
                    <h5>8</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=9'"><i
                                class="fas fa-gamepad fa-3x rounded-circle circle"></i></button>
                    <h5>9</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=10'"><i
                                class="fas fa-box-open fa-3x rounded-circle circle"></i></button>
                    <h5>10</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dit is zijn de body-includes -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>