<?php
include_once("../src/core/DbHandler.php");

// check if any input in searchbar
if(isset($_POST["query"])) {
    $query = $_POST["query"];
}
// send query yo database
if(isset($query)) {
    // database connection
    $db = new DbHandler();
    $connection = $db->connect();
    $sql = "SELECT StockItemName FROM stockitems WHERE StockItemName like '$query%' LIMIT 6";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $productsName = $stmt->fetchAll();
    $db->disconnect();
    $db = null;
}

foreach ($productsName as $productName) {
    print("<div></div><row>" . $productName["StockItemName"] . "</row>,");
}

?>