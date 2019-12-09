<?php
if(!isset($_COOKIE["PHPSESSID"])) {
    session_start();
}
include_once("../src/core/DbHandler.php");
$pageTitle = "orderGeschiedenis";
include_once("../public/includes/header.php");
print "<link href='css/productOverzicht.css' rel='stylesheet'>";
print "<script
            src='https://code.jquery.com/jquery-3.4.1.min.js'
            integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo='
            crossorigin='anonymous'></script>
       <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'
            integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1'
            crossorigin='anonymous'></script>
       <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"
            integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\"
            crossorigin=\"anonymous\"></script>";

print "<div class='container'>";
//placeholder for user ID
$userID=3;

if (isset($userID)) {
    print "Hier komt de order geschiedenis van de gebruiker";

    //start db connectie
    $db = new DbHandler("ERP");
    $connection = $db->connect();
    $sql = "SELECT O.orderrecordID, OP.orderproductID, O.date, OP.productID, OP.amount FROM orderrecord O JOIN orderproduct OP ON O.orderrecordID=OP.orderrecordID WHERE O.customerID=3";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $groep]);
    $results = $stmt->fetchAll();
    //clear db connectie
    $db->disconnect();
    $db = null;

    foreach($results as $result) {
        print "<div>";
        print "order geschiedenis van".$userID;
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
