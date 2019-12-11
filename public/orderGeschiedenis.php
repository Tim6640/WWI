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
    $db = new DbHandler("USER");
    $connection = $db->connect();
    $sql = "SELECT O.orderrecordID, O.date, OP.productID, OP.amount FROM orderrecord O JOIN orderproduct OP ON O.orderrecordID=OP.orderrecordID WHERE O.customerID=:id";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $userID]);
    $results = $stmt->fetchAll();
    //clear db connectie
    $db->disconnect();
    $db = null;


    $inOrder=0;
    foreach($results as $result) {
        $recordID=($result["orderrecordID"]);
        $date = ($result["date"]);
        $pid= ($result["productID"]);
        $amount= ($result["amount"]);

        //if orderrecordID is the same as previous orderrecord make new div
        if ($recordID!=$inOrder) {
//            dit komt in een nieuwe div
            print "<br> Ordernummer: $recordID";
            print "&nbsp&nbsp&nbsp op $date<br>";
        }

        //insert items into orderrecordID div
        print "Product: ".$pid." ".$amount." keer<br>";

        //make clear for next loop that previous orderrecord==$inOrder
        $inOrder=$recordID;
    }
} else {
    //wanneer er geen geschiedenis is van de bestelling
    print "Er zijn geen eerdere aankopen gevonden :(";
}



include_once("../public/includes/footer.php");
?>
