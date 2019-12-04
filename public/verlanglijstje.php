<?php

include_once("../src/core/init.php");
$pageTitle = "verlanglijstje";
include_once("../public/includes/header.php");

$db = new DbHandler();
$connection = $db->connect();
$sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE StockItemID IN (Select StockitemID from Wishlist where customerID = $thisCustomerId";
$stmt = $connection->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();
$db->disconnect();
$db = null;