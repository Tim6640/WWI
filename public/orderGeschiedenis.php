<?php

include_once("../src/core/DbHandler.php");
$pageTitle = "orderGeschiedenis";
include_once("../public/includes/header.php");
print "<link href='css/productOverzicht.css' rel='stylesheet'>";
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse"  id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0 text-lg-center">
            <li class="nav-item">
                <a class="nav-link"style="color: black" href="accountinformatie.php">accountinformatie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: black" href="verlanglijstje.php">verlanglijstje</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: black" href="orderGeschiedenis.php">transactiegeschiedenis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: black" href="activeren.php">membership</a>
            </li>
        </ul>
    </div>
</nav>
<?php
//placeholder for user ID
$userID=$_SESSION["id"];

ini_set('display_errors', 0);
if (isset($userID)) {
//  Hier komt de order geschiedenis van de gebruiker
    //start db connectie
    $db = new DbHandler("USER");
    $connection = $db->connect();
    $sql = "SELECT O.orderrecordID, O.date, OP.productName, OP.amount, OP.unitPrice FROM orderrecord O JOIN orderproduct OP ON O.orderrecordID=OP.orderrecordID WHERE O.customerID=:id";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $userID]);
    $results = $stmt->fetchAll();
    //clear db connectie
    $db->disconnect();
    $db = null;

    if (!empty($results)) {
        print "<h1 class='display-4 text-center'>Order Geschiedenis</h1>";
        $inOrder=null;
        foreach($results as $result) {
            $recordID=($result["orderrecordID"]);
            $date = date("d-m-Y", strtotime($result["date"]));

            //if orderrecordID is the same as previous orderrecord make new div
            if ($recordID!=$inOrder) {
//            dit komt in een nieuwe div
                print "<div class='card'>".
                    "<div class='card-header' style='color:white; background-color:blue'>Ordernummer: $recordID&nbsp&nbsp&nbsp&nbsp".
                    "<span class='mr-auto'>datum: $date</span></div>";
                $totaal=0;
                foreach ($results as $result) {
                    $pid= ($result["productName"]);
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
                print "<div class='m-auto'>Totaalprijs: €$totaal</div></div><br>";
            }
            //make clear for next loop that previous orderrecord==$inOrder
            $inOrder=$recordID;
        }

    } else {
        print "Er zijn geen eerdere aankopen gevonden";
    }

} else {
    //wanneer er geen geschiedenis is van de bestelling
    ?>
    <div U moet ingelogd zijn om deze pagina te bekijken</div>
    <?php
}

?>
</div>
<?php
include_once("../public/includes/footer.php");
?>
