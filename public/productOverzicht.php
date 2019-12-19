<?php

// checking if post has been recieved setting session min max for search
if (isset($_POST["min"])) {
    $_SESSION["min"] = $_POST["min"];
}
if (isset($_POST["max"])) {
    $_SESSION["max"] = $_POST["max"];
}

// default price variables
if (isset($_SESSION["min"])) {
} else {
    $_SESSION["min"] = 0;
}
if (isset($_SESSION["max"])) {
} else {
    $_SESSION["max"] = 10000;
}
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */
include_once("../src/core/DbHandler.php");
$pageTitle = "overzicht";
include_once("../public/includes/header.php");
?>
    <link href='css/productOverzicht.css' rel='stylesheet'>
    <link href='css/wishlist.css' rel='stylesheet'>
    <script
            src='https://code.jquery.com/jquery-3.4.1.min.js'
            integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo='
            crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'
            integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1'
            crossorigin='anonymous'></script>
<!--        start script to send pid to post-->
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
    <div class='container'>
        <div class='modal' tabindex='-1' id='banaan' role='dialog'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Wilt u verder winkelen of doorgaan naar de winkelwagen</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <a type='button' class='btn btn-primary btn-lg bnt-block my-3' href='winkelmandje.php'>
                            Doorgaan naar de winkelwagen
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
//check if a request to add to wishlist is started
if (isset($_POST["wadd"])) {
    //check if the user is logged in
    if (!empty($_SESSION["id"])) {
        $userID = $_SESSION["id"];
        $wadd = ($_POST["wadd"]);
        $userID = $_SESSION["id"];
        $db = new DbHandler("USER");
        $connection = $db->connect();
        $sql = "SELECT productId FROM wishlist WHERE customerID=:id AND productId=:pid";
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $userID, ':pid' => $wadd]);
        $product = $stmt->fetch();
        //insert if product in not already in db
        if (empty($product["productId"])) {
            $sql = "INSERT INTO wishlist (customerId, productId) VALUES (:id, :pid)";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':id' => $userID, ':pid' => $wadd]);
            ?>
            <div class='holder'>
                <div id='popupcontent' class='popup'>
                    <div class='content'>Het product is in uw verlanglijstje geplaatst.</div>
                </div>
            </div>
            <?php
            //don't insert if product is not in db and show error
        } else {
            ?>
            <div class='holder'>
                <div id='popupcontent' class='popup'>
                    <div class='content'>Het product staat al in uw verlanglijstje</div>
                </div>
            </div>
            <?php
        }
        //close the database
        $db->disconnect();
        $db = null;
        //if userid is not set then show an error
    } else {
        ?>
        <div class='holder'>
            <div id='popupcontent' class='popup'>
                <div class='content'>Sorry, u moet ingelogd zijn om het verlanglijstje te kunnen gebruiken</div>
            </div>
        </div>
        <?php
    }
}


        if (!isset($_SESSION["shoppingCart"])) {
            $_SESSION["shoppingCart"] = array();
        }
        if (isset($_POST["wagen"]) AND !in_array($_POST["wagen"], $_SESSION["shoppingCart"])) {
            array_push($_SESSION["shoppingCart"], $_POST["wagen"]);
        }

        //lookup groupitems from WWI database
        if (isset($_GET["productgroep"])) {
            $groep = $_GET["productgroep"];
            //establish connection
            $db = new DbHandler("ERP");
            $connection = $db->connect();
            $sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE StockItemID IN ( SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID=:id)";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':id' => $groep]);
            $products = $stmt->fetchAll();
            $db->disconnect();
            $db = null;
            // Als er geen groupitem wordt gebruikt maar een zoekterm en filters
        } elseif (isset($_POST["search"])) {
            $search = $_POST["search"];
            // min price
            if (is_numeric($_POST["min"])) {
                $filter1 = "and RecommendedRetailPrice >=" . $_POST["min"];
            } else $filter1 = "and True";
            // max price
            if (is_numeric($_POST["max"])) {
                $filter2 = "and RecommendedRetailPrice <=" . $_POST["max"];
            } else $filter2 = "and True";
            // databasing
            $db = new DbHandler("ERP");
            $connection = $db->connect();
            // check if filters for price used
            $sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE StockItemName like '%$search%' $filter1 $filter2";
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $products = $stmt->fetchAll();
            $db->disconnect();
            $db = null;
        }
        //    var_dump($products);
        if (isset($products) and !($products == array())) {
//start of loop for printing searchresults
            foreach ($products as $product) {
//submit query
                $name = $product["StockItemName"];
                $price = $product["RecommendedRetailPrice"];
                $pid = $product["StockItemID"];

                //start card body
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
                $stmt->execute([':pid' => $pid]);
                $result = $stmt->fetch();
                if ($result["score"] == 0) {
                    print "<h6>Score: geen rating</h6>";

                } else {
                    print "<h6> Score: ";
                    for ($i = 0; $i < (round($result["score"], 0)); $i++) {
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
                <button type='submit' formaction='#' name='wadd' type='button' value='" . $pid . "' class='btn'>
                    <i style='color:#00BDF3' class='fas fa-heart fa-2x'></i>
                </button>
            </form>
            <!--add function to add product to cart-->
            </div>
        </div>
            
            </div>
            </div>";
            }
        } else {
            print "<div style='text-align:center'>helaas bestaat het gezochte product niet<br>
    klik <a href='/wwi/public'>hier</a> om terug te gaan naar de thuispagina</div>";
        }
        print "</div>";


include_once("../public/includes/footer.php");
?>