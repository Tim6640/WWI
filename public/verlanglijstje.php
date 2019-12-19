<?php

include_once("../src/core/dbhandler.php");
$pageTitle = "verlanglijstje";
include_once("../public/includes/header.php");
?>
    <div class='container'></div>
    <link href='css/productOverzicht.css' rel='stylesheet'>
    <link href='css/wishlist.css' rel='stylesheet'>
    <script
        src='https://code.jquery.com/jquery-3.4.1.min.js'
        integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo='
        crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'
            integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1'
            crossorigin='anonymous'></script>
    <script>
        function startAjax($productNummer) {
            var wagen = "wagen=";
            $.ajax({
                    type: "POST",
                    url: "productOverzicht.php",
                    data: wagen + $productNummer,
                    success: function (result) {
                        console.log("Yes!");
                        console.log($productNummer)
                    }
                }
            );
        }
    </script>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse"  id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0 text-lg-center">
                <li class="nav-item">
                    <a class="nav-link"style="color: black" href="accountinformatie.php">accountinformatie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black" href="verlanglijstje.php">verlanglijstje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black" href="orderGeschiedenis.php">transactiegeschiedenis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black" href="activeren.php">membership</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class='container'>
        <div class='modal' tabindex='-1' id='banaan' role='dialog'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Wilt u verder winkelen of doorgaan naar uw winkelmandje</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <a type='button' class='btn btn-primary btn-lg bnt-block my-3' href='winkelmandje.php'>
                            Doorgaan naar mijn winkelmandje
                        </a>
                        <a type='button' class='btn btn-primary btn-lg bnt-block' href=''>
                            Verder winkelen
                        </a>
                    </div>
                    <div class='modal-footer'>
                    </div>
                </div>
            </div>
        </div>
<?php
//placeholder for user ID

//delete if a delete request comes through via post
if ((isset($_POST["remove"])) && isset($_SESSION["id"])) {
    $userID=$_SESSION["id"];
    $rid=($_POST["remove"]);
    $userID=$_SESSION["id"];
    $db = new DbHandler("USER");
    $connection = $db->connect();
    $sql = "DELETE FROM wishlist WHERE customerID=:id AND productId=:pid";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $userID, ':pid' => $rid]);
    $db->disconnect();
    $db = null;
    ?>
    <div class='holder'>
        <div id='popupcontent' class='popup'>
            <div class='content'>Het product is uit uw verlanglijstje verwijdert.</div>
        </div>
    </div>
                    <?php
}
//check if session id is set
if (isset($_SESSION["id"])) {
    $userID=$_SESSION["id"];
    $db = new DbHandler("USER");
    $connection = $db->connect();
    $sql = "SELECT productId FROM wishlist WHERE customerID=:id";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $userID]);
    $products = $stmt->fetchAll();
    $db->disconnect();
    $db = null;
//check if there are products in the previous select
    if (empty($products)) {
                            ?>
                    <div class='holder'>
                        <div id='popupcontent' class='popup'>
                            <div class='content'>U heeft geen producten in uw verlanglijstje.</div>
                        </div>
                    </div> <img src='images/sad.gif' style='width:90%'>
                    <?php
    } else {?>
        <h1 class="text-lg-center">Mijn verlanglijstje</h1>
        <?php
        //if wishlist is not empty then print each item
        foreach ($products as $product) {
            $product=($product["productId"]);
            $db = new DbHandler("ERP");
            $connection = $db->connect();
            $sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE StockItemID=:id";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':id' => $product]);
            $result = $stmt->fetch();
            $db->disconnect();
            $db = null;

            $pid=$result["StockItemID"];
            $name=$result["StockItemName"];
            $price=$result["RecommendedRetailPrice"];

            print "<div class='card no_border'>
            <div class='card-body'>

            <!--print product image-->
            <div class='d-flex'>
            <a href='product.php?pid=" . $pid . "/'<br>
            <div class='p-2'>
            <img src='images\productPlaceholder.png' class='product_image'>
            </a>
            </div>

            <!--print title, review and price-->
            <a href='product.php?pid=" . $pid . "'<br>
            <div class='ml-auto p-2 a_text'>
            <b class='card-title'>" . $name . "</b>";

            //look up review----------------------------------------------------------------------------------
            $db = new DbHandler("USER");
            $connection = $db->connect();
            $sql = "SELECT AVG(score) as score FROM review WHERE productID=:pid";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':pid'=>$pid]);
            $result = $stmt->fetch();
            if ($result["score"]==0) {
                print "<h6>Score: geen rating</h6>";
            } else {
                print "<h6> Score: ";
                for ($i=0;$i<(round($result["score"], 0));$i++) {
                    print "<span class='fa fa-star' style='color:gold'></span>";
                }
                print "</h6>";
            }
            $db->disconnect();
            $db = null;

            //look up and print price
            print "<h6>€ " . $price . "</h6>
            </div>
            </a>

            <!--print icons-->
            <div class='ml-auto my-auto'>";

            //send session page to shopping cart
// link naar winkelmand en verlanglijstje
            print "<form>
                <button formmethod='post' name='wagen' type='button' value='" . $pid . "' class='btn' data-toggle='modal' data-target='#banaan' onclick='startAjax($pid)'>
                    <i style='color:#00BDF3' class='color: fas fa-cart-plus fa-2x'></i>
                </button>
            </form>
            <form method='post'>
                <button type='submit' formaction='verlanglijstje.php' name='remove' type='button' value='".$pid."' class='btn'>
                    <i style='color:#00BDF3' class='fas fa-heart-broken fa-2x'></i>
                </button>
            </form>
            <!--add function to add product to cart-->
            </div>
            </div>
            
            </div>
            </div>";
        }
    }
} else {
    print "sorry, u moet ingelogd zijn om deze pagina te bekijken";
}

?>
    </div>
<?php
include_once("../public/includes/footer.php");
?>