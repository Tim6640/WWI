<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 13-11-2019
 * Time: 12:12
 */
session_start();
include_once("../src/core/DbHandler.php");
$db = new DbHandler("ERP");
$connection = $db->connect();
$sql = "SELECT StockGroupID, StockGroupName from stockgroups ";
$stmt = $connection->prepare($sql);
$stmt->execute();
$groepen = $stmt->fetchAll();
$db->disconnect();
$db = null;

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
                <a class="col-2 col-md-1 pr-0 text-center" role="button" href="<?php if (array_key_exists("logged_in", $_SESSION)){print "accountinformatie.php";}else{print "login.php";} ?>" >
        <span class="mr-md-3"><i class="fas fa-user text-white"></i></span>

                <a class="mr-md-3" href="winkelmandje.php">
                    <i class="fas fa-shopping-cart text-white"></i>
                </a>
            </span>
            <!-- Menu icon -->
            <a class="col-2 col-md-1 pr-0 text-center" id="dropdownMenuLink" role="button" data-toggle="dropdown"
               aria-haspopup="true">
                <span class="menu-button my-auto text-white"><i class="fas fa-bars black"></i></span>
            </a>
            <div class="dropdown-menu bg-secondary" aria-labelledby="dropdownMenuLink" style="width: 97%">
                <!--        <button type="button" class="close">&times;</button>-->
                <div class="row">
                    <?php
                    foreach ($groepen as $groep) {
                        print("
                     <div class='col-6 col-md-4 text-center'>
                    <a class='btn' href='productOverzicht.php?productgroep=" . $groep['StockGroupID'] . "'>
                    <img class='center' style='width:55px' src=images/categorieicons/groep" . $groep['StockGroupID'] . ".png >
                    <h5>" . $groep['StockGroupName'] . "</h5>
                    </a>
                </div> ");
                    }
                    ?>
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