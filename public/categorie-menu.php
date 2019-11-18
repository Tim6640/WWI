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

<!-- dropdown Menu -->

<nav class="navbar navbar-default navbar-slide-nav">
    <div class="container">
        <div id="navbar" class="navbar-slide offcanvas" style="width: 100%;">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><i class="fas fa-bars fa-2x"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <div class="text-center">
                            <div class="row">
                                <div class="card text-center" id="123">
                                    <button class="btn"><i class="fas fa-gamepad fa-3x rounded-circle circle"></i></button>
                                    <span class="h5"><h5>1</h5></span>
                                </div>
                                <div class="col-4 col-md-2">
                                    <button class="btn"><i class="fas fa-laptop fa-3x rounded-circle circle"></i></button>
                                    <span class="h5"><h5>2</h5></span>
                                </div>
                                <div class="col-4 col-md-2">
                                    <button class="btn"><i class="fas fa-baby-carriage fa-3x rounded-circle circle"></i></button>
                                    <span class="h5"><h5>3</h5></span>
                                </div>
                                <div class="col-4 col-md-2">
                                    <button class="btn"><i class="fas fa-band-aid fa-3x rounded-circle circle"></i></button>
                                    <h5>4</h5>
                                </div>
                                <div class="col-4 col-md-2">
                                    <button class="btn"><i class="fas fa-basketball-ball fa-3x rounded-circle circle"></i></button>
                                    <h5>5</h5>
                                </div>
                                <div class="col-4 col-md-2">
                                    <button class="btn"><i class="fas fa-cannabis fa-3x rounded-circle circle"></i></button>
                                    <h5>6</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </li>
        </ul>
    </div><!--/.nav-collapse -->
    </div>
</nav>


<!-- Dit is zijn de body-includes -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>