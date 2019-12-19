<!DOCTYPE html>
<html>
<head lang="eng">
    <title>betalingbevestiging</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3c0f9f28b6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/betaling.css">
    <?php
    /**
     * Created by PhpStorm.
     * User: tim11
     * Date: 7-11-2019
     * Time: 09:52
     */
    include_once("../src/core/DbHandler.php");
    $pageTitle = "Home";
    include_once("../public/includes/header.php");
    ?>
<div class="container my-5 text-center" role="alert" style="">
    <?php

    if (isset ($_POST["unregistered"])) {
        //search in database if e-mail already exists
        $eMail=($_POST["e-mail"]);

        $db = new DbHandler("USER");
        $connection = $db->connect();
        //insert select for finding customerID
        $sql = "SELECT customerID FROM customer WHERE email=:addr";
        $stmt = $connection->prepare($sql);
        $stmt->execute([':addr' => $eMail]);
        $result = $stmt->fetch();
        sleep(0.25);
        //if e-mail exists then set $userID as found ID
        if (($result["customerID"])!=0) {
            $userID=($result["customerID"]);
        } else {
            //if not then insert e-mail, select given customerID and set $userID as resulting customerID
            $sql = "INSERT INTO customer (email) VALUES (:addr)";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':addr' => $eMail]);
            sleep(0.25);
            //select orderrecordID from table to use in product insert
            $sql = "SELECT customerID FROM customer WHERE email=:addr";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':addr' => $eMail]);
            $result = $stmt->fetch();
            sleep(0.25);
            $userID=($result["customerID"]);
            $_POST['bevestiging']="proceed";
        }
    }
    //check if bevestiging is set else 404 page
    if(isset($_POST['bevestiging'])) {
        //check if bestiging is set to "proceed" else set error
        $bevestiging = $_POST['bevestiging'];
        if ($bevestiging == "proceed") {
            if (isset($_SESSION["id"])) {
                $userID=$_SESSION["id"];

            } else if (!isset($userID)) {
                //if account is not set show a form to enter e-mail
                print "<p>Gebruik een account of vul hier uw gegevens in om een bestelling te plaatsen.</p>";
                print "<form method='post' action='betalingbevestiging.php?bevestiging=proceed'>
<input type='email' placeholder='voorbeeld@wwi.nl' name='e-mail'>
<input type='submit' value='verzenden' name='unregistered'>
</form>";
            }

            //if account is set start process
            if (isset($userID)) {
                $db = new DbHandler("USER");
                $connection = $db->connect();
                //insert new ordernumber with usernumber
                $sql = "INSERT INTO orderrecord (customerID) VALUES (:id)";
                $stmt = $connection->prepare($sql);
                $stmt->execute([':id' => $userID]);
                sleep(0.25);
                //select orderrecordID from table to use in product insert
                $sql = "SELECT orderrecordID FROM orderrecord WHERE customerID=:id ORDER BY date DESC LIMIT 1";
                $stmt = $connection->prepare($sql);
                $stmt->execute([':id' => $userID]);
                $result = $stmt->fetch();
                sleep(0.25);
                $orderID=($result["orderrecordID"]);

                $productArray=($_SESSION["shoppingCart"]);
                //use foreach to place each product in order
                foreach ($productArray as $product) {
                    if (isset($_SESSION["aantallen"])){
                        $amountArray=($_SESSION["aantallen"]);
                    } else {
                        $amountArray = array();
                    }

                    //check the amount and set if exists
                    print ($amountArray["$product"]);
                    if ($product == (array_key_exists($product, $amountArray))) {
                        $amount = ($amountArray["$product"]);
                    } else {
                        $amount = 1;
                    }

                    //start of inserting into orderproduct
                    //search product name & price to use in insert
                    $pDb = new DbHandler("ERP");
                    $pConnection = $pDb->connect();
                    $pSql = "SELECT StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemID=:pid";
                    $pStmt = $pConnection->prepare($pSql);
                    $pStmt->execute([':pid' => $product]);
                    $pResult = $pStmt->fetch();
                    $pDb->disconnect();
                    $pDb = null;
                    sleep(0.25);

                    //use insert into orderproduct for orderrecordID, productName, amount, UnitPrice
                    $pDb = new DbHandler("USER");
                    $pConnection = $pDb->connect();
                    $pSql = "INSERT INTO orderproduct (orderrecordID, productName, amount, unitPrice) VALUES (:oid, :pid, :amount,:price)";
                    $pStmt = $pConnection->prepare($pSql);
                    //replace StockItemID with StockItemName later
                    $pStmt->execute([':oid' => $orderID, ':pid' => ($pResult["StockItemName"]), ':amount' => $amount, ':price' => ($pResult["RecommendedRetailPrice"])]);
                    $pDb->disconnect();
                    $pDb = null;
                }

                //close connection
                $db->disconnect();
                $db = null;

                unset($_SESSION["aantallen"]);
                unset($_SESSION["shoppingCart"]);

                print('
        <div class="row">
            <div class="col-12">
                <div class="m-auto alert alert-success">
                    <a href="index.php">
                    <p class="text-center">U heeft succesvol betaald</p>
                    <img src="images/betaald.png" class="img-fluid m-auto" alt="Responsive image">
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <button type="button" class="btn btn-lg btn-primary center-block">home <i class="fas fa-home"></i></button>
            </div>
        </div>');
            }

        } else {
            print('
        <div class="row">
            <div class="col-12">
                <div class="m-auto alert alert-danger">
                    <p class="text-center">Betaling mislukt</p>
                    <img src="images/geweigerd.png" class="img-fluid m-auto" alt="Responsive image">
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <button type="button" class="btn btn-lg btn-primary center-block">home <i class="fas fa-home"></i></button>
            </div>
        </div>
        ');
        }
    } else
    {
        print("404");
    }
    include_once("../public/includes/footer.php");

    ?>


