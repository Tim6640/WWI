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
    <a class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"><i class="fas fa-bars fa-2x"></i>
    </a>
    <div class="dropdown-menu bg-secondary" aria-labelledby="dropdownMenuLink">
<!--        <button type="button" class="close">&times;</button>-->
        <h5 class="">Productcategorieën</h5>
            <div class="row">
                <div class="col text-center">
                    <a class="btn" href='/productOverzicht.php?category='"><i class="fas fa-gamepad fa-3x rounded-circle circle"></i></a>
                    <h5>1</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-laptop fa-3x rounded-circle circle"></i></button>
                    <h5>2</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-baby-carriage fa-3x rounded-circle circle"></i></button>
                    <h5>3</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-band-aid fa-3x rounded-circle circle"></i></button>
                    <h5>4</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-basketball-ball fa-3x rounded-circle circle"></i></button>
                    <h5>5</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-cannabis fa-3x rounded-circle circle"></i></button>
                    <h5>6</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-baby-carriage fa-3x rounded-circle circle"></i></button>
                    <h5>3</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-band-aid fa-3x rounded-circle circle"></i></button>
                    <h5>4</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-basketball-ball fa-3x rounded-circle circle"></i></button>
                    <h5>5</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-cannabis fa-3x rounded-circle circle"></i></button>
                    <h5>6</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-baby-carriage fa-3x rounded-circle circle"></i></button>
                    <h5>3</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-band-aid fa-3x rounded-circle circle"></i></button>
                    <h5>4</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-basketball-ball fa-3x rounded-circle circle"></i></button>
                    <h5>5</h5>
                </div>
                <div class="col text-center">
                    <button class="btn" onclick=" window.location.href = 'https://www.windesheim.nl/'"><i class="fas fa-cannabis fa-3x rounded-circle circle"></i></button>
                    <h5>6</h5>
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