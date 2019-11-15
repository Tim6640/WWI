<!DOCTYPE html>
<html>
<head lang="eng">
    <title>betalingsbevestiging</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3c0f9f28b6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="betaling.css">
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
    ?>
</head>
<body>
<div class="container my-5 text-center" role="alert" style="">
    <div class="row">
        <div class="col-12">
            <div class="m-auto alert alert-success">
                <p class="text-center">U heeft succesvol betaald</p>
                <img src="images/betaald.png" class="img-fluid m-auto" alt="Responsive image">
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <button type="button" class="btn btn-lg btn-primary center-block">home <i class="fas fa-home"></i></button>
        </div>
    </div>
</body>
</html>
