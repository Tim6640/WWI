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


<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dropdown button
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
    </div>
</div>

<h3>Productcategorieën:</h3>
<div class="container text-center">
    <div class="row">
        <div class="col my-md-lg">
            <i class="fas fa-gamepad fa-4x"></i>
            <h5>Categorie 1</h5>
        </div>
        <div class="col my-md-lg">
            <i class="fas fa-laptop fa-4x"></i>
            <h5>Categorie 2</h5>
        </div>
        <div class="col my-md-lg">
            <i class="fas fa-baby-carriage fa-4x"></i>
            <h5>Categorie 3</h5>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col">
            <i class="fas fa-band-aid fa-4x"></i>
            <h5>Categorie 4</h5>
        </div>
        <div class="col">
            <i class="fas fa-basketball-ball fa-4x"></i>
            <h5>Categorie 5</h5>
        </div>
        <div class="col">
            <i class="fas fa-cannabis fa-4x"></i>
            <h5>Categorie 6</h5>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col">
            <i class="fas fa-gamepad fa-4x"></i>
            <h5>Categorie 7</h5>
        </div>
        <div class="col">
            <i class="fas fa-bong fa-4x"></i>
            <h5>Categorie 8</h5>
        </div>
        <div class="col">
            <i class="fas fa-cat fa-4x"></i>
            <h5>Categorie 9</h5>
        </div>
    </div>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col">
            <i class="fab fa-apple fa-4x"></i>
            <h5>Categorie 10</h5>
        </div>
        <div class="col">
            <i class="fas fa-birthday-cake fa-4x"></i>
            <h5>Categorie 11</h5>
        </div>
        <div class="col">
            <i class="fas fa-bus fa-4x"></i>
            <h5>Categorie 12</h5>
        </div>
    </div>
</div>
<!-- Dit is zijn de body-includes -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>