<?php

include_once("../src/core/DbHandler.php");
$pageTitle = "orderGeschiedenis";
include_once("../public/includes/header.php");
print "<link href='css/productOverzicht.css' rel='stylesheet'>";


print "<div class='container'>";
//placeholder for user ID
$userID=3;

if (isset($userID)) {
    print "Hier komt de order geschiedenis van de gebruiker<br>";

    //start db connectie
    $db = new DbHandler("ERP");
    $connection = $db->connect();
    $sql = "SELECT O.orderrecordID, OP.orderproductID, O.date, OP.productID, OP.amount FROM orderrecord O JOIN orderproduct OP ON O.orderrecordID=OP.orderrecordID WHERE O.customerID=:id";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $userID]);
    $results = $stmt->fetchAll();
    //clear db connectie
    $db->disconnect();
    $db = null;

    foreach($results as $result) {
        print "test";
        print ($result["date"]);
        //if orderrecordID is the same as previous orderrecord make new div

        //else add to div

        //print orderrecordID
        //print date

        //insert items into orderrecordID div
    }
} else {
    //wanneer er geen geschiedenis is van de bestelling
    print "Er zijn geen eerdere aankopen gevonden :(";
}



include_once("../public/includes/footer.php");
?>
