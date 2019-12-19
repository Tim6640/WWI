<?php
$pageTitle = "Home";
include_once("../public/includes/header.php");
?>
    <link href='css/wishlist.css' rel='stylesheet'>
<?php
# verwijderen van de shopping cart
if (array_key_exists("action", $_GET)) {
    $delete = $_GET["id"];
    unset($_SESSION["shoppingCart"][$delete]);
}


# verwijderen van de shopping cart
if (array_key_exists("action", $_GET)) {
    $pos = array_search($_GET["id"], $_SESSION["shoppingCart"]);
    unset($_SESSION["shoppingCart"][$pos]);
}
# toevoegen aan verlanglijstje
if (array_key_exists("wishlist", $_GET)) {
    //check if a request to add to wishlist is started
        //check if the user is logged in through a db check
        if (!empty($_SESSION["id"])) {
            $userID = $_SESSION["id"];
            $wadd = ($_GET["id"]);
            $userID = $_SESSION["id"];
            $db = new DbHandler("USER");
            $connection = $db->connect();
            $sql = "SELECT productId FROM wishlist WHERE customerID=:id AND productId=:pid";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':id' => $userID, ':pid' => $wadd]);
            $product = $stmt->fetch();
            //insert if product in not already in db (previous select is empty)
            if (empty($product["productId"])) {
                $sql = "INSERT INTO wishlist (customerId, productId) VALUES (:id, :pid)";
                $stmt = $connection->prepare($sql);
                $stmt->execute([':id' => $userID, ':pid' => $wadd]);
                ?>
                <div class='holder'>
                    <div id='popupcontent' class='popup'>
                        <div class='content'>Het product is in uw verlanglijstje geplaatst.</div>
                    </div>
                </div>
                <?php
                //don't insert if product is not in db and show error
            } else {
                ?>
                <div class='holder'>
                    <div id='popupcontent' class='popup'>
                        <div class='content'>Het product staat al in uw verlanglijstje</div>
                    </div>
                </div>
                <?php
            }
            //close the database
            $db->disconnect();
            $db = null;
            //if userid is not set then show an error
        } else {
            ?>
            <div class='holder'>
                <div id='popupcontent' class='popup'>
                    <div class='content'>Sorry, u moet ingelogd zijn om het verlanglijstje te kunnen gebruiken</div>
                </div>
            </div>
            <?php
        }

} else {
    $_SESSION["verlanglijstje"] = array();
}
#aantallen veranderen
if (!empty($_GET)) {
    foreach ($_GET as $number => $aantal) {
        $_SESSION["aantallen"][$number] = $aantal;

    }
}
//         else {
//            $numbers = 0;
//            $aantallen = 1;
//        }
//    }
//} else {
//    $numbers = 1;
//    $aantallen = 1;
//}

# reken bedragen voor het eindbedrag
$totaal = 0;
$shipping = 10;
#connectie met de database
ini_set('display_errors', 0);
$db = new DbHandler("ERP");
$connection = $db->connect();

?>
<?php
sleep(0.25);
if(!empty($_SESSION["shoppingCart"])) {
    ?>
    <!-- shopping cart style -->
    <div class="px-4 px-lg-0">
        <!-- For demo purpose -->
        <div class="text-lg-center">
            <h1 class="display-4 text-center">shopping cart</h1>

        </div>
        <!-- End -->
        <!-- opmaak voor de table heads -->
        <div class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                        <!-- Shopping cart table -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Product</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Price</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                # De SockITemID loopen door de database
                                if (!empty($_SESSION["shoppingCart"])) {
                                    foreach ($_SESSION["shoppingCart"] as $key => $stockNumber) {
                                        if (!empty($stockNumber)) {
                                            $sql="SELECT * FROM stockitems where StockItemID = '$stockNumber'";
                                            $stmt = $connection->prepare($sql);
                                            $stmt->execute();
                                            $products = $stmt->fetchAll();
                                            foreach ($products as $row) {
                                                if (!empty($_SESSION["aantallen"][$row["StockItemID"]])) {
                                                    $recommendPrice = $_SESSION["aantallen"][$row["StockItemID"]] * $row["RecommendedRetailPrice"];
                                                    $price = (float)$recommendPrice;
                                                }else{ $recommendPrice = $row["RecommendedRetailPrice"];}
                                                ?>
                                                <!-- opmaak voor de foto en naam-->
                                                <tr>
                                                    <th scope="row" class="border-0">
                                                        <div class="p-2"><a
                                                                    href="product.php?pid=<?php print$row["StockItemID"] ?>">
                                                                <img src="<?php print $row["Photo"] ?>" alt="foto"
                                                                     width="70"
                                                                     class="img-fluid rounded shadow-sm"></a>
                                                            <div class="ml-3 d-inline-block align-middle">
                                                                <h6 <a href="#"
                                                                                    class="text-dark d-inline-block text-center"><?php print($row["StockItemName"]) ?></a>
                                                                    <h6>
                                                                        <form>
                                                                            <!-- opmaak voor de knoppen: hartje, prullenbak en combobox -->
                                                                            <a href="winkelmandje.php?wishlist=add&id=<?php print $row["StockItemID"]; ?>">
                                                                                <img src="images/hartje.png"
                                                                                     class="img-responsive"
                                                                                     style="width: 20px;height: 20px "
                                                                                     alt="verlanglijstje"></a>
                                                                            <a href="winkelmandje.php?action=delete&id=<?php print $row["StockItemID"]; ?>">
                                                                                <img src="images/vuilnisbak.png"
                                                                                     class="img-responsive"
                                                                                     style="width: 20px;height: 20px "
                                                                                     alt="delete"></a>
                                                                            <!-- combobox -->
                                                                            <a>
                                                                                <form action="winkelmandje.php" method="get">
                                                                                    <select name="<?php print $row["StockItemID"] ?>"
                                                                                            onchange="this.form.submit()">
                                                                                        <?php
                                                                                        for ($i = 1; $i < 10; $i++) {
                                                                                            print "<option value='" . $i . "'";
                                                                                            foreach ((array) $_SESSION["aantallen"] as $aantalID => $aantalAantal) {
                                                                                                if ($aantalAantal == $i && $aantalID == $row["StockItemID"]) {
                                                                                                    print " selected='selected'";
                                                                                                }
                                                                                            }
                                                                                            print ">" . $i . "</option>";
                                                                                        }


                                                                                        ?>
                                                                                    </select>

                                                                                </form>
                                                                    </h6>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td class="border-0 align-middle">
                                                        <strong><?php  $price = (float)$recommendPrice;

                                                            $totaal += $price;
                                                            print("€" . $price); ?></strong>
                                                    </td>
                                                </tr>
                                            <?php }


                                        }
                                    }
                                }
                                # opruimen verbinding
                                $db->disconnect();
                                $db = null;
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>

                <!-- opmaak checkout blok -->
                <div class="text-lg-center">
                    <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary</div>
                    <div class="p-4">
                        <ul class="list-unstyled mb-4">
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order
                                    Subtotaal </strong><strong><?php print ("€" . $totaal); ?></strong></li>
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">verzendkosten
                                </strong><strong><?php print("€" .$shipping) ?></strong></li>
                            <li class="d-flex justify-content-between py-3 border-bottom"><strong
                                        class="text-muted">Totaal</strong>
                                <h5 class="font-weight-bold"><?php $totaliteit = $totaal + $shipping;
                                    print("€" . $totaliteit); ?></h5>
                            </li>

                        </ul>
                        <form method="post" action="betalingbevestiging.php">
                        <input type="submit" name="submit" value="proceed to checkout"
                               class="btn btn-primary rounded-pill py-2 btn-block">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
}
else{
?>
<div class="px-4 px-lg-0">
    <!-- For demo purpose -->
    <div class="text-lg-center">
        <h1 class="display-4 text-center">shopping cart is leeg</h1>


    </div>
</div>
<div class="px-4 px-lg-0 ">
    <div class="text-lg-center">
    <a href="homepage.php">
        <h5 class="text-center">terug naar homepage</h5>
    </a>
    </div>
</div>

    <?php }

    include_once("includes/footer.php")?>