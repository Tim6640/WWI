<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 13-11-2019
 * Time: 12:12
 */
// default price variables
if(isset($_SESSION["min"])) {
} else {
    $_SESSION["min"] = 0;
}
if(isset($_SESSION["max"])) {
} else {
    $_SESSION["max"] = 10000;
}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
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
            <div style="position: relative;" class="dropdown-menu bg-secondary" aria-labelledby="dropdownMenuLink">
                <h5 class="">Menu</h5>
                <div class="row">
                    <div class="col text-center">
                        <button class="btn" onclick=" window.location.href = 'productOverzicht.php?productgroep=1'"><i
                                    class="fas fa-newspaper fa-3x rounded-circle circle"></i></button>
                        <h5>1</h5>
                    </div>
                    <div class="col text-center">
                        <button class="btn" onclick=" window.location.href = 'productOverzicht.php?productgroep=2'"><i
                                    class="fas fa-user-tie fa-3x rounded-circle circle"></i></button>
                        <h5>2</h5>
                    </div>
                    <div class="col text-center">
                        <button class="btn" onclick=" window.location.href = 'productOverzicht.php?productgroep=3'"><i
                                    class="fas fa-mug-hot fa-3x rounded-circle circle"></i></button>
                        <h5>3</h5>
                    </div>
                    <div class="col text-center">
                        <button class="btn" onclick=" window.location.href = 'productOverzicht.php?productgroep=4'"><i
                                    class="fas fa-tshirt fa-3x rounded-circle circle"></i></button>
                        <h5>4</h5>
                    </div>
                    <div class="col text-center">
                        <button class="btn" onclick=" window.location.href = 'productOverzicht.php?productgroep=5'"><i
                                    class="fas fa-plane fa-3x rounded-circle circle"></i></button>
                        <h5>5</h5>
                    </div>
                    <div class="col text-center">
                        <button class="btn" onclick=" window.location.href = 'productOverzicht.php?productgroep=6'"><i
                                    class="fas fa-laptop fa-3x rounded-circle circle"></i></button>
                        <h5>6</h5>
                    </div>
                    <div class="col text-center">
                        <button class="btn" onclick=" window.location.href = 'productOverzicht.php?productgroep=7'"><i
                                    class="fab fa-usb fa-3x rounded-circle circle"></i></button>
                        <h5>7</h5>
                    </div>
                    <div class="col text-center">
                        <button class="btn" onclick=" window.location.href = 'productPagina.php?productgroep=8'"><i
                                    class="fas fa-shoe-prints fa-3x rounded-circle circle"></i></button>
                        <h5>8</h5>
                    </div>
                    <div class="col text-center">
                        <button class="btn" onclick=" window.location.href = 'productOverzicht.php?productgroep=9'"><i
                                    class="fas fa-gamepad fa-3x rounded-circle circle"></i></button>
                        <h5>9</h5>
                    </div>
                    <div class="col text-center">
                        <button class="btn" onclick=" window.location.href = 'productOverzicht.php?productgroep=10'"><i
                                    class="fas fa-box-open fa-3x rounded-circle circle"></i></button>
                        <h5>10</h5>
                    </div>
                </div>
            </div>

            <!-- Search bar -->
            <form class="col-10 col-md-11 pl-0 input-group" method="post" action="../public/productOverzicht.php">
                <!--            Javascript for the autocomplete function-->
                <script type="text/javascript">
                    function startSearch(str) {
                        // send post to the server for the query
                        $.ajax({
                            type: "POST",
                            url: "../public/getproduct.php",
                            data: "query=" + str,
                            success: function (result) {
                                console.log("Yes!");
                                console.log(str);
                            }
                        }).done(function( data, textStatus, jqXHR) {
                                console.log(data);
                                console.log(jqXHR.responseText);
                            // if typed stuff is 0 long disable the box
                            if (str.length===0) {
                                document.getElementById("display").innerHTML = "";
                                document.getElementById("display").style.border = "0px";
                                // javascript isset
                            } else {
                                try {
                                    // try to get products to display
                                    document.getElementById("display").innerHTML= data;
                                } catch (e) {
                                    // display no result
                                    document.getElementById("display").innerHTML= "Geen resultaat"
                                } {
                                } document.getElementById("display").style.border="1px solid #A5ACB2";
                            }
                        }
                        )
                    }

                </script>
                <input class="search form-control mr-0" type="text" name="search" id="search" placeholder="Zoeken" autocomplete="off"
                       aria-label="none" onkeyup="startSearch(this.value);">
                <input type="submit" style="display: none">
                <div class="input-group-append">
                    <div class="btn-group dropleft" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="input-group-text icons"><i class="fas fa-filter"></i></span>
                    </div>
                    <div class="dropdown-menu">
<!--                        Filters-->
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-6">
                            Mininimale prijs:<input type="text" name="min" maxlength="5" value="<?php print($_SESSION["min"]) ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-6">
                            Maximale prijs:<input type="text" name="max" maxlength="5"  value="<?php print($_SESSION["max"]) ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--display the live search-->
        <row>
            <div class="col-2"></div>
        <div id="display" style="background: white"></div>
        </row>
    </div>
</div>
<!-- Header end -->