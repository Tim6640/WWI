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
</head>
<body>
<div class="container my-5 text-center" role="alert" style="">
    <?php
    //check if bestiging is set else 404 page
    if(isset($_GET['bevestiging'])) {
        //check if bestiging is set to "proceed" else set error
        $bevestiging = $_GET['bevestiging'];
        if ($bevestiging == "proceed") {

            $db = new DbHandler("USER");
            $connection = $db->connect();
            //insert new ordernumber with usernumber
            //replace with real user ID in final product
            //$userID=$_SESSION["id"];
            $userID=3;
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

            //test data----------------------------------------------------------
//            $productArray=($_SESSION["shoppingCart"]);
            $productArray=array(1, 18, 25, 69);

            //end test data-------------------------------------------------------

            //use foreach to place each product in order
            foreach ($productArray as $product) {
//                $amountArray=($_SESSION["aantallen"]);
                $amountArray= array(25=>6, 69=>69);

                //check the amount and set if exists
                if ($product == (array_key_exists($product, $amountArray))) {
                    $amount = ($amountArray["$product"]);
                } else {
                    $amount = 1;
                }
                //done with gathering orderdata

                //start of inserting into orderproduct
                //search product name & price to use in insert
                $pDb = new DbHandler("ERP");
                $pConnection = $pDb->connect();
                //replace StockItemID with StockItemName later
                $pSql = "SELECT StockItemID, RecommendedRetailPrice FROM stockitems WHERE StockItemID=:pid";
                $pStmt = $pConnection->prepare($pSql);
                $pStmt->execute([':pid' => $product]);
                $pResult = $pStmt->fetch();
                $pDb->disconnect();
                $pDb = null;
                sleep(0.25);

                //use insert into orderproduct for orderrecordID, productName, amount, UnitPrice
                $pDb = new DbHandler("USER");
                $pConnection = $pDb->connect();
                //replace StockItemID with StockItemName later
                $pSql = "INSERT INTO orderproduct (orderrecordID, productID, amount, unitPrice) VALUES (:oid, :pid, :amount,:price)";
                $pStmt = $pConnection->prepare($pSql);
                //replace StockItemID with StockItemName later
                $pStmt->execute([':oid' => $orderID, ':pid' => ($pResult["StockItemID"]), ':amount' => $amount, ':price' => ($pResult["RecommendedRetailPrice"])]);
                $pDb->disconnect();
                $pDb = null;

            }

            //close connection
            $db->disconnect();
            $db = null;

            print('
        <div class="row">
            <div class="col-12">
                <div class="m-auto alert alert-success">
                    <p class="text-center">U heeft succesvol betaald</p>
                    <img src="images/betaald.png" class="img-fluid m-auto" alt="Responsive image">
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <button type="button" class="btn btn-lg btn-primary center-block">home <i class="fas fa-home"></i></button>
            </div>
        </div>');
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
        </div>');
        }
    }
    else
    {
        print("404");
    }

        ?>



</body>
</html>

