<?php

include_once("../src/core/DbHandler.php");
$pageTitle = "orderGeschiedenis";
include_once("../public/includes/header.php");
print "<link href='css/productOverzicht.css' rel='stylesheet'>";


print "<div class='container'>";


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
    foreach($results as $result) {
        $recordID=($result["orderrecordID"]);
        $date = ($result["date"]);

        //if orderrecordID is the same as previous orderrecord make new div
        if ($recordID!=$inOrder) {
//            dit komt in een nieuwe div
            print "<div class='card'>";
            print "<div class='card-header'>Ordernummer: $recordID";
            print "&nbsp&nbsp&nbsp datum: $date<br>";
            $totaal=0;
            foreach ($results as $result) {
                $pid= ($result["productID"]);
                $amount= ($result["amount"]);
                $unitPrice= ($result["unitPrice"]);
                print "<ul class='list-group list-group-flush'>";
                if ($recordID==$result["orderrecordID"]) {
                    print "<li class='list-group-item'>Product: ".$pid." &nbsp&nbsp&nbsp aantal: ".$amount." &nbsp&nbsp&nbsp prijs per product: €$unitPrice</li><br>";
                    $totaal= $totaal+($amount*$unitPrice);
                }
                print "</ul>";
            }
            print "Totaalprijs: €$totaal</div>";
            print "</div><br>";
        }

        //insert items into orderrecordID div

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
