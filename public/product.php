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
    <title>Product pagina</title>
</head>
<!--# einde voorwerk-->
<!--# begin pagina-->
<body>
<div class="container">
    <h1> Product naam</h1>
    <div class="row">
        <button type="button" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart
        </button>
        <button type="button" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-star"></span> Wishlist
        </button>

    </div>
    <div class="col-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="test1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="test2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="test3.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div
    <div class="row">
        <div class="col-4">
            <h2>Prijs</h2>
        </div>
        <div class="col-6">
            <h2>Bezorginformatie</h2>
        </div>
    </div>
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
    <div class="col-12">
        <h4>Productbeschrijving</h4>
    </div>
    <div class="col-12">
        <div class="panel-body" align="centre">
            Uitgebreide beschrijving van een product die over meerdere paginas kan gaan over een product dit is gewoon filler
        </div>
    </div>
    <div class="col-12" align="middle">
        <div class="text-centre">
        <button type="button" class="btn btn-primary btn-lg bnt-block">
            <span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart
        </button>
        </div>
        <div class="h-divider">
        </div>
        <div>
            <h1>review space</h1>
        </div>
</div>
</div>


</body>


</html>