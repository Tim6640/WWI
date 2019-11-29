<?php
session_start();


# $_SESSION["shoppingcart"} wordt gecontroleerd of hij leeg i
    if (empty($_SESSION["shoppingCart"])) {
        $leeg = TRUE;
    }else{
        $_SESSION["shoppingCart"] = array();
        $leeg = FALSE;
    }

# verwijderen van de shopping cart
if (array_key_exists("action", $_GET)) {
    $delete = $_GET["id"];
    unset($_SESSION["shoppingCart"][$delete]);
}
# toevoegen aan verlanglijstje
if (array_key_exists("wishlist", $_GET)) {
    if (!in_array($_GET["id"], $_SESSION["verlanglijstje"])) {
        $verlanglijst = $_GET["id"];
        array_push($_SESSION["verlanglijstje"], $_GET["id"]);
    }
} else {
    $_SESSION["verlanglijstje"] = array();
}
#aantallen veranderen
if (!empty($_GET)) {
    foreach ($_GET as $number => $aantal) {
        $_SESSION["aantallen"][$number] = $aantal;
        if (is_int($number)) {
            $numbers = $number;
            $aantallen = $aantal;
        } else {
            $numbers = 0;
            $aantallen = 1;
        }
    }
} else {
    $numbers = 1;
    $aantallen = 1;
    $_SESSION["aantallen"] = array();
}
//if(empty($_SESSION["prijs"])){
//    $_SESSION["prijs"] = array();
//}else{
//    foreach ($_SESSION["shoppingCart"] as $ID => $currentPrice){
//        if (array_key_exists($ID, $_SESSION["aantallen"])){
//            $_SESSION["prijs"][$ID] = $currentPrice*$_SESSION["aantallen"][$ID];}
//    }
//}
# dit is de header
include_once("../src/core/init.php");
$pageTitle = "Home";
include_once("../public/includes/header.php");
# reken bedragen voor het eindbedrag
$totaal = 0;
$shipping = 10;

#connectie met de database
ini_set('display_errors', 1);
$host = "localhost";
$databasename = "wideworldimporters";
$user = "root";
$pass = "";
$port = 3306;
$conn = new mysqli($host, $user, $pass, $databasename, $port);
if ($conn->error) {
    user_error('Onze error ' . $conn->error);
    die();
}

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
                                    foreach ($_SESSION["shoppingCart"] as $stockNumber => $recommendPrice) {
                                        if (!empty($stockNumber)) {
                                            $result = $conn->query("SELECT * FROM stockitems where StockItemID = '$stockNumber'");
                                            foreach ($result as $row) {
                                                if ($numbers == $row["StockItemID"]) {
                                                    $recommendPrice = $aantallen * $row["RecommendedRetailPrice"];
                                                    $price = (float)$recommendPrice;
                                                    $_SESSION["shoppingCart"][$numbers] = $price;
                                                }
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
                                                                            <a href="scherm.php?wishlist=add&id=<?php print $row["StockItemID"]; ?>">
                                                                                <img src="images/hartje.png"
                                                                                     class="img-responsive"
                                                                                     style="width: 20px;height: 20px "
                                                                                     alt="verlanglijstje"></a>
                                                                            <a href="scherm.php?action=delete&id=<?php print $row["StockItemID"]; ?>">
                                                                                <img src="images/vuilnisbak.png"
                                                                                     class="img-responsive"
                                                                                     style="width: 20px;height: 20px "
                                                                                     alt="delete"></a>
                                                                            <!-- combobox -->
                                                                            <a>
                                                                                <form action="scherm.php" method="get">
                                                                                    <select name="<?php print $row["StockItemID"] ?>"
                                                                                            onchange="this.form.submit()">
                                                                                        <?php
                                                                                        for ($i = 1; $i < 10; $i++) {
                                                                                            print "<option value='" . $i . "'";
                                                                                            foreach ($_SESSION["aantallen"] as $aantalID => $aantalAantal) {
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
                                mysqli_free_result($result);
                                mysqli_close($conn);
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
                            <form method="post" action="betalingbevestiging.php">
                        </ul>
                        <input type="submit" name="submit" value="proceed to checkout"
                               class="btn btn-primary rounded-pill py-2 btn-block">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <?php
}
elseif($leeg){
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