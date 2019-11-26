<!DOCTYPE html>
<html>
<head>
    <!-- $pageTitle is defined on the page visited -->
    <title>Wide World Importers</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WideWorldImporters">
    <meta name="keywords" content="WWI, WideWorldImporters">
    <!-- Homepage stylesheet include -->
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <!-- Fontawesome, handles the icons -->
    <script src="https://kit.fontawesome.com/6756a99abc.js" crossorigin="anonymous"></script>
    <!-- Bootstrap javascript include -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <?php
    include_once("../src/core/init.php");
    include_once("../public/includes/header.php");
    ?>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <img src="images/bannerMain.jpg" class="img-responsive2" alt="hoofdbanner">
    </div>
</div>
<div class="container-fluid" style="padding-right: 0px; padding-left: 0px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding-right: 0px; padding-left: 0px;">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox" style="margin: 0px; padding: 0px; border: 0px; margin: none; ">
                    <div class="carousel-item img-responsive active">
                        <img src="images/banner1.jpg" class="img-responsive" alt="Afbeelding1">
                    </div>

                    <div class="carousel-item img-responsive">
                        <img src="images/banner2.jpg" class="img-responsive" alt="Afbeelding2">
                    </div>

                    <div class="carousel-item img-responsive">
                        <img src="images/banner3.jpg" class="img-responsive" alt="Afbeelding3">
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--einde carousel-->

<!--Bestsellers-->

<!--Nieuws-->
<div class="container-fluid" style="padding-right: 30px; padding-left: 30px;">
    <div class="row">
        <h1>Nieuwskopje 1</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed euismod nisi porta lorem mollis. Nibh nisl condimentum id venenatis a condimentum. Morbi leo urna molestie at elementum eu. Pharetra massa massa ultricies mi quis hendrerit. Ut consequat semper viverra nam libero justo laoreet sit. Congue quisque egestas diam in arcu cursus euismod quis viverra. Mattis nunc sed blandit libero volutpat sed cras ornare arcu. Dolor purus non enim praesent elementum facilisis leo. Dolor morbi non arcu risus. In massa tempor nec feugiat nisl pretium fusce id velit. Tincidunt augue interdum velit euismod in pellentesque. Sit amet nulla facilisi morbi. Felis bibendum ut tristique et egestas quis ipsum. Diam sit amet nisl suscipit adipiscing. Egestas erat imperdiet sed euismod nisi. Risus in hendrerit gravida rutrum. Rhoncus dolor purus non enim praesent elementum facilisis leo.
        </p>
    </div>
</div>



<?php
include_once("../public/includes/footer.php");
?>
</body>