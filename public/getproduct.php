<?php
include_once("../src/core/DbHandler.php");

// check if any input in searchbar
if(isset($_POST["query"])) {
    $query = $_POST["query"];
}
// send query yo database
if(isset($query)) {
    // database connection
    $db = new DbHandler("ERP");
    $connection = $db->connect();
    $sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID FROM stockitems WHERE StockItemName like '%$query%' limit 6";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $productsName = $stmt->fetchAll();
    $db->disconnect();
    $db = null;
}

foreach ($productsName as $productName) {
    $name = $productName["StockItemID"];
    print("<div style='border: 1px black'><row><col-8><a style='color: black' href='product.php?pid=$name'  >"  . $productName["StockItemName"] . "</col-8>       <col-2><b> €" .  $productName["RecommendedRetailPrice"] . "</b></col-2></row></div>");
}

?>