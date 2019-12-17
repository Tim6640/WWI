<?php

include_once("../src/core/DbHandler.php");
$pageTitle = "orderGeschiedenis";
include_once("../public/includes/header.php");
print "<link href='css/productOverzicht.css' rel='stylesheet'>";


//placeholder for user ID
//$userID=$_SESSION["id"];
$userID=3;

if (isset($userID)) {
//  Hier komt de order geschiedenis van de gebruiker

    //start db connectie
    $db = new DbHandler("USER");
    $connection = $db->connect();
    $sql = "SELECT O.orderrecordID, O.date, OP.productID, OP.amount, OP.unitPrice FROM orderrecord O JOIN orderproduct OP ON O.orderrecordID=OP.orderrecordID WHERE O.customerID=:id";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $userID]);
    $results = $stmt->fetchAll();
    //clear db connectie
    $db->disconnect();
    $db = null;


    $inOrder=null;
    print "<div class='container'>";
    foreach($results as $result) {
        $recordID=($result["orderrecordID"]);
        $date = date("d-m-Y", strtotime($result["date"]));

        //if orderrecordID is the same as previous orderrecord make new div
        if ($recordID!=$inOrder) {
//            dit komt in een nieuwe div
            print "<div class='card'>".
            "<div class='card-header'>Ordernummer: $recordID&nbsp&nbsp&nbsp&nbsp".
            "<span class='mr-auto'>datum: $date</span></div>";
            $totaal=0;
            foreach ($results as $result) {
                $pid= ($result["productID"]);
                $amount= ($result["amount"]);
                $unitPrice= ($result["unitPrice"]);
                print "<div><ul class='list-group list-group-flush'>";
                if ($recordID==$result["orderrecordID"]) {
                    print "<li class='m-auto my-auto list-group-item'>".
                    "Product: ".$pid."&nbsp&nbsp&nbsp".
                    "aantal: ".$amount." &nbsp&nbsp&nbsp prijs: €$unitPrice</li><br>";
                    $totaal= $totaal+($amount*$unitPrice);
                }
                print "</ul></div>";
            }
            print "<div class='ml-auto'>Totaalprijs: €$totaal</div></div><br>";
        }
        //make clear for next loop that previous orderrecord==$inOrder
        $inOrder=$recordID;
    }
} else {
    //wanneer er geen geschiedenis is van de bestelling
    print "Er zijn geen eerdere aankopen gevonden :(";
}

?>
</div>
<?php
include_once("../public/includes/footer.php");
?>
