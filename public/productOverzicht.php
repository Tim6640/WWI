<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */
include_once("../src/core/DbHandler.php");
$pageTitle = "overzicht";
include_once("../public/includes/header.php");
include_once("css/productOverzicht.css");
$groep=$_GET["productgroep"];

print "<div class='container'>";
 $results = 2;
if (isset($results)) {
    //establish connection
    $db = new DbHandler();
    $connection = $db->connect();
    $sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE StockItemID IN ( SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID=:id)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $groep]);
    $products = $stmt->fetchAll();
    $db->disconnect();
    $db = null;

//    var_dump($products);
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
            <a href='/productPagina.php?pid=".$pid."/'<br>
            <div class='p-2'>
            <img src='images\wwi_logo_small.png' class='product_image'>
            </div>
            </a>

            <!--print title, review and price-->
            <a class='a_title' href='/productPagina.php?pid=".$pid."/'<br>
            <div class='p-2'>
            <b class=\"card-title\">" . $name ."</b>";

            //look up review----------------------------------------------------------------------------------
            print "<h6> Review *****</h6>";

           print "<h6>€ ".$price."</h6>
            </div>
            </a>

            <!--print icons-->
            <div class='ml-auto my-auto'>
            <a class='winkelwagen' href='/winkelwagen.php?pid=".$pid."'<i class='fas fa-cart-plus fa-2x'></i></a><br>
            <a class='verlanglijst' href='/wishlist.php?pid=".$pid."'><i class='fas fa-heart fa-2x'></i></a>
            </div>
            </div>
            </div>
            </div>";
    }

} else {
    print "helaas bestaat het gezochte product niet<br>
    klik <a href='/wwi/public'>hier</a> om terug te gaan naar de thuispagina";
}

print "</div>";

include_once("../public/includes/footer.php");
?>