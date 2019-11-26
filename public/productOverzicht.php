<?php
session_start();

/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */
include_once("../src/core/DbHandler.php");
$pageTitle = "overzicht";
include_once("../public/includes/header.php");
print "<link href='css/productOverzicht.css' rel='stylesheet'>";
print "<div class='container'>";


//lookup groupitems from WWI database
if (isset($_GET["productgroep"])) {
    $groep = $_GET["productgroep"];
    //establish connection
    $db = new DbHandler();
    $connection = $db->connect();
    $sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE StockItemID IN ( SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID=:id)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $groep]);
    $products = $stmt->fetchAll();
    $db->disconnect();
    $db = null;
//} else if (isset($_GET["pid"])) {
//    $pid = ($_GET["pid"]);
//    $pid = array(1, 2, 3, 4, 5, 6, 7, 8);
//    //establish connection
//    $db = new DbHandler();
//    $connection = $db->connect();
//    $sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE StockItemID IN (:id)";
//    $stmt = $connection->prepare($sql);
//    $stmt->execute([':id' => $pid]);
//    $products = $stmt->fetchAll();
//    $db->disconnect();
//    $db = null;
}

//    var_dump($products);
if (isset($products)) {
//start of loop for printing searchresults
    foreach ($products as $product) {
//submit query
        $name = $product["StockItemName"];
        $price = $product["RecommendedRetailPrice"];
        $pid = $product["StockItemID"];
//          $photo=$row["Photo"];

        //start card body
        print "<div class='card no_border'>
            <div class='card-body'>

            <!--print product image-->
            <div class='d-flex'>
            <a href='productPagina.php?pid=" . $pid . "/'<br>
            <div class='p-2'>
            <img src='images\productPlaceholder.png' class='product_image'>
            </a>
            </div>

            <!--print title, review and price-->
            <a href='productPagina.php?pid=" . $pid . "'<br>
            <div class='ml-auto p-2 a_text'>
            <b class='card-title'>" . $name . "</b>";

        //look up review----------------------------------------------------------------------------------
//            $reviewHost = "localhost";
//            $reviewDatabasename = "wideworldimporters";
//            $reviewUser = "root";
//            $reviewPass = null;
//            $reviewPort = 3306;
//            $reviewConnection = mysqli_connect($reviewHost, $reviewUser, $reviewPass, $reviewDatabasename, $reviewPort);
//
//            $reviewSql = "SELECT AVG(rating) FROM review WHERE StockItemId=? AND CustomerId=?";
//            $reviewStatement = mysqli_prepare($reviewConnection, $reviewSql);
//            mysqli_stmt_bind_param($reviewStatement, 'ii', $productNummer, $customerId);
//            mysqli_stmt_execute($reviewStatement);
//            $reviewResult = mysqli_stmt_get_result($reviewStatement);

        print "<h6> Review *****</h6>";

//            mysqli_stmt_close($reviewStatement);
//            mysqli_free_result($reviewResult);
//            mysqli_close($reviewConnection);


        //look up and print price
        print "<h6>€ " . $price . "</h6>
            </div>
            </a>

            <!--print icons-->
            <div class='ml-auto my-auto'>";

        //send session page to shopping cart
        print " <!--<form><button name='button' formmethod='post' value=".$pid." type='submit'> -->
            <a class='winkelwagen' href='winkelwagen.php?pid=" . $pid . "'>
            <i class='fas fa-cart-plus fa-2x'></i></button>
            </a>
            <br>
            <!--add function to add product to cart-->
            <a class='verlanglijst' href='wishlist.php?pid=" . $pid . "'><i class='fas fa-heart fa-2x'></i></a>
            </div>
            </div>
            </div>
            </div>";
    }
} else if (isset ($_post["search"])) {
    print "hier komen de search results";
} else {
    print "helaas bestaat het gezochte product niet<br>
    klik <a href='/wwi/public'>hier</a> om terug te gaan naar de thuispagina";
}

print "</div>";

//if (isset($_GET['addToCart'])) {
//    if (isset($_SESSION['item'])) {
//        $pid=$_GET['addToCart'];
////        $cart = array($_SESSION['item']);
////        array_push($cart, $pid);
//        array_push($_SESSION['item'], $pid);
//    } else {
//        $_SESSION['item'] = $_GET['addToCart'];
//    }
//}
//
//print_r($_SESSION['item']);

include_once("../public/includes/footer.php");

?>