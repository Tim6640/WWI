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
print "<link href='css/productOverzicht.css' rel='stylesheet'>";
//include_once("css/productOverzicht.css");


print "<div class='container'>";


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
            <a href='/productPagina.php?pid=" . $pid . "/'<br>
            <div class='p-2'>
            <img src='images\wwi_logo_small.png' class='product_image'>
            </div>
            </a>

            <!--print title, review and price-->
            <a class='a_text' href='/productPagina.php?pid=" . $pid . "/'<br>
            <div class='p-2'>
            <b class=\"card-title\">" . $name . "</b>";

        //look up review----------------------------------------------------------------------------------
        print "<h6> Review *****</h6>";

        print "<h6>€ " . $price . "</h6>
            </div>
            </a>

            <!--print icons-->
            <div class='ml-auto my-auto'>
            <form method='post' type='hidden' value='addToCart'>
            <a class='winkelwagen' href='productOverzicht.php?productgroep=".$groep."'><i class='fas fa-cart-plus fa-2x'></i></a><br>
            </form>
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
if (isset($_POST["addToCart"])) {
    print "<br>it works";
}

print "</div>";

include_once("../public/includes/footer.php");
?>