<?php

ini_set('display_errors',0);
include_once("../src/core/DbHandler.php");
$pageTitle = "overzicht";
include_once("../public/includes/header.php");
$customerId = ($_SESSION["id"]);
if (!empty($customerId)){
    if (isset($_POST['rating'])) {
    //start connection---------------
    $db = new DbHandler("USER");
    $connection = $db->connect();

//input data to database--------------------------------------------------------------------------------------------
//get customerId from session
//$customerId=$_session["CustomerId"];

//$productNummer = $_GET["pid"];
    $productNummer = $_GET["pid"];

        if (!isset($_POST["review"]) || (($_POST["rating"])<1 || ($_POST["rating"])>5)) {
            $wrongRate = true;
        } else {
            $wrongRate = false;
            //check if review already exists
            $sql = "SELECT COUNT(*) as count FROM Review WHERE customerId=:cid AND productID=:pid";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':cid' => $customerId, ':pid' => $productNummer]);
            $result = $stmt->fetch();
            $count = $result['count'];
            //insert rating and review
            $rating = $_POST["rating"];
            $review = $_POST["review"];
            if ($count == 0) {
                //if review doesn't exist yet use insert
                $sql = "INSERT INTO review (customerId, score, description, productID) VALUES (:cid, :sid, :did, :pid)";
                $stmt = $connection->prepare($sql);
                $stmt->execute([':cid' => $customerId, ':sid' => $rating, ':did' => $review, ':pid' => $productNummer]);
            }  else {
                    //if review already exist yet use update
                    $sql = "UPDATE review SET score=:sid, description=:did WHERE CustomerId=:cid AND ProductID=:pid ";
                    $stmt = $connection->prepare($sql);
                    $stmt->execute([':sid' => $rating, ':did' => $review, ':cid' => $customerId, ':pid' => $productNummer]);
                }
                $succesfulReview = true;
                print "<div style='text-align:center'><h1 style='color: green'>review is succesvol gepost</h1><br>
            <h5>klik <a href='product.php?pid=" . $productNummer . "'>hier</a> om terug te gaan naar de productpagina</h5></div>";

                //close connection
                $db->disconnect();
                $db = null;
            }

        }else {
            $succesfulReview = false;
        }
    // check if review is set. if not then show form---------------------------------------------------------------------
        if (!$succesfulReview) {
            if (!empty($_GET["pid"])) {
                $pid = $_GET["pid"];
                $db = new DbHandler("ERP");
                $connection = $db->connect();
    //gather data
                $sql = "SELECT StockItemName, Photo FROM stockitems WHERE StockItemID=:id";
                $stmt = $connection->prepare($sql);
                $stmt->execute([':id' => $pid]);
                $product = $stmt->fetchAll();
                $db->disconnect();
                $db = null;
                $product = $product[0];
                $name = ($product["StockItemName"]);
                $photo = ($product["Photo"]);
                ?>
                <!--        start of form-------------------------------------------------------------------------->
                <div class="container">
                    <div class="content" style="text-align:center;align-item:center">
                        <div class='mx-auto text-center'>
                            <img src='images\productPlaceholder.png' style="margin-top:5px" width='50%'>
                            <h3><?php print "$name"; ?></h3>
                        </div>
                        <br>
                        <form method='post' action=''>
                            <label for="rating" class="control-label">Score (1-5)</label>
                            <input type="number" id="rating" name="rating" data-show-clear="false" data-show-caption="true"
                                   min="1" max="5">
                            <div class="form-group w-75% center-block" style="text-align:center">
                                <?php if (isset($wrongRate)) {
                                    if ($wrongRate == true) {
                                        print "<h6 style='color:red;text-align: center'>Vul een nummer in van 1 tot 5</h6>";
                                    }
                                }
                                ?>
                                <label for="review">Opmerking</label>
                                <textarea class="form-control rounded-0" id="review" name="review" rows="5" style="text-align: center"
                                          placeholder="(optioneel) Vul hier uw mening in over dit product"></textarea>
                            </div>
                            <input style="margin-bottom:10px" type="submit" value="verwerken">
                        </form>
                    </div>
                </div>
                <?php
                //if pid is not set-----------------------------------------------------
            } else {
                print "";
                print "<div style='text-align:center'><h1 style='color: red'> Deze pagina bestaat niet</h1><br>
            <h5>klik <a href='homepage.php'>hier</a> om terug te gaan naar de thuispagina</h5></div>";
            }
        }
}else {
        print "<div style='text-align:center'><h1 style='color: red'>Log in om deze pagina te bekijken</h1><br>
        <h5>klik <a href='login.php'>hier</a> om naar de inlogpagina te gaan</h5></div>";
    }

include_once("../public/includes/footer.php");
?>