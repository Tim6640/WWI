<?php
session_start();

/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */
include_once("../src/core/DbHandler.php");
$pageTitle = "overzicht";
include_once("../public/includes/header.php");
print "<link href='css/productOverzicht.css' rel='stylesheet'>";
print "<script
            src='https://code.jquery.com/jquery-3.4.1.min.js'
            integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo='
            crossorigin='anonymous'></script>
       <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'
            integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1'
            crossorigin='anonymous'></script>";
print "<div class='container'>";

//lookup groupitems from wwi database
if (isset($_GET["productgroep"])) {
    $groep = $_GET["productgroep"];
    //establish connection
    $db = new DbHandler();
    $connection = $db->connect();
    $sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE StockItemID IN ( SELECT StockItemID FROM stockitemstockgroups WHERE StockGroupID=:id)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $groep]);
    $products = $stmt->fetchAll();
    $db->disconnect();
    $db = null;
//} else if (isset($_GET["pid"])) {
//    $pid = ($_GET["pid"]);
//    $pid = array(1, 2, 3, 4, 5, 6, 7, 8);
//    //establish connection
//    $db = new DbHandler();
//    $connection = $db->connect();
//    $sql = "SELECT StockItemID, StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE StockItemID IN (:id)";
//    $stmt = $connection->prepare($sql);
//    $stmt->execute([':id' => $pid]);
//    $products = $stmt->fetchAll();
//    $db->disconnect();
//    $db = null;
}

if(isset($_POST["wagen"])) {
    $_SESSION["shoppingCart"] = $_POST["wagen"];
}

if (isset($products)) {
//start of loop for printing searchresults
    foreach ($products as $product) {
//submit query
        $name = $product["StockItemName"];
        $price = $product["RecommendedRetailPrice"];
        $pid = $product["StockItemID"];

        //start card body
        print "<div class='card no_border'>
            <div class='card-body'>

            <!--print product image-->
            <div class='d-flex'>
            <a href='productPagina.php?pid=" . $pid . "/'<br>
            <div class='p-2'>
            <img src='images\productPlaceholder.png' class='product_image'>
            </a>
            </div>

            <!--print title, review and price-->
            <a href='productPagina.php?pid=" . $pid . "'<br>
            <div class='ml-auto p-2 a_text'>
            <b class='card-title'>" . $name . "</b>";

        //look up review----------------------------------------------------------------------------------
        print "<h6> Review *****</h6>";

        print "<h6>€ " . $price . "</h6>
            </div>
            </a>

            <!--print icons-->
            <div class='ml-auto my-auto'>";

        //send session page to shopping cart
// link naar winkelmand en verlanglijstje
        print "<form>
                <button formmethod='post' name='wagen' type='button' class='btn shoppingcart fa-2x' data-toggle='modal' data-target='#product' onclick='startAjax()'>
                    <i class='fas fa-cart-plus'></i>
                </button>
            </form>
            <!--</form>-->
            <br>
            <!--add function to add product to cart-->
            <a class='verlanglijst' href='wishlist.php?pid=" . $pid . "'><i class='fas fa-heart fa-2x'></i></a>
            </div>
            </div>
            <div class='modal' tabindex='-1' id='product' role='dialog'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Wilt u verder winkelen of doorgaan naar de winkelwagen</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        <a type='button' class='btn btn-primary btn-lg bnt-block my-3' href='winkelmandje.php'>
                            Doorgaan naar de winkelwagen
                        </a>
                        <a type='button' class='btn btn-primary btn-lg bnt-block' href='productpagina.php'>
                            Verder winkelen
                        </a>
                    </div>
                    <div class='modal-footer'>

                    </div>
                </div>
            </div>
        </div>
            
            </div>
            </div>";
    }
} else if (isset ($_post["search"])) {
    print "hier komen de search results";
} else {
    print "helaas bestaat het gezochte product niet<br>
    klik <a href='/wwi/public'>hier</a> om terug te gaan naar de thuispagina";
}



print "</div>";

?>

    <script>
        function startAjax() {
            $.ajax({
                    type: "POST",
                    url: "productOverzicht.php",
                    data: "wagen= <?php echo($pid); ?>",
                    success: function(result){
                        console.log("Yes!");
                        console.log(<?= $pid ?>)
                    }
                }
            );
        }
    </script>

<?php


//if (isset($_GET['addToCart'])) {
//    if (isset($_SESSION['item'])) {
//        $pid=$_GET['addToCart'];
////        $cart = array($_SESSION['item']);
////        array_push($cart, $pid);
//        array_push($_SESSION['item'], $pid);
//    } else {
//        $_SESSION['item'] = $_GET['addToCart'];
//    }
//}
//
//print_r($_SESSION['item']);

include_once("../public/includes/footer.php");

?>