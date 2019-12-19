<?php
//add include
//$pageTitle = "product"
include_once("../src/core/DbHandler.php");
$pageTitle = "product";
include_once("../public/includes/header.php");

?>

    <link href='css/wishlist.css' rel='stylesheet'>
    <!--    # benodigde meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <!--    # bootstrap aan php kopelen-->
<!--    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"-->
<!--          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"-->
<!--          media="all">-->
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>

<?php
//check if a request to add to wishlist is started
if (isset($_POST["wadd"])) {
    //check if the user is logged in through a db check
    if (!empty($_SESSION["id"])) {
        $userID = $_SESSION["id"];
        $wadd = ($_POST["wadd"]);
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
}

// SQL SETUP
$productNummer=$_GET["pid"];

$db = new DbHandler("ERP");
$connection = $db->connect();
$sql = "SELECT StockItemName, RecommendedRetailPrice, StockItemID FROM stockitems WHERE StockItemID=:pid";
$stmt = $connection->prepare($sql);
$stmt->execute([':pid' => $productNummer]);
$result = $stmt->fetch();
$db->disconnect();
$db = null;

$name = $result["StockItemName"];
$price = $result["RecommendedRetailPrice"];
$nummer = $result["StockItemID"];



if(!isset($_SESSION["shoppingCart"])) {
    $_SESSION["shoppingCart"] = array();
}

if (isset($_GET["pid"])) {
    $productNummer = $_GET["pid"];
} else {
    print ("helaas bestaat het gezochte product niet<br>");
    print ("klik <a href='/wwi/public'>hier</a> om terug te gaan naar de thuispagina");
}

if(isset($_POST["wagen"]) AND !in_array($_POST["wagen"] , $_SESSION["shoppingCart"])) {
    array_push($_SESSION["shoppingCart"], $_POST["wagen"]);
}


?>
<!--# einde voorwerk-->
<!--# begin pagina-->

<div class="container min-vh-100">
    <div class="row">
        <div class="col-12">
            <h6 class="text-center" style="font-size: x-large">
                <?php print($name); ?>
            </h6>
        </div>
    </div>
<!--    div showing the current rating-->
    <div class="row" style="font-size: larger">
        <div class="col-7">
        <?php
        $db = new DbHandler("USER");
        $connection = $db->connect();
        $sql = "SELECT AVG(score) as score FROM review WHERE productID=:pid";
        $stmt = $connection->prepare($sql);
        $stmt->execute([':pid'=>$productNummer]);
        $result = $stmt->fetch();
        if ($result["score"]==0) {
        print "<h6>Score: onbeoordeeld</h6>";
        } else {
        print " Score: ";
            for ($i=0;$i<(round($result["score"], 0));$i++) {
            print "<i class='fa fa-star' style='color:gold'></i>";
            }
        }
        $db->disconnect();
        $db = null;
        ?>
       </div>
        <!--        Links naar winkelmand en verlanglijstje-->
        <div class="row" style="padding-top: 10px">
        <div class="col-md-5">
            </a><a href="winkelmandje.php" class="mr-3 ml-3" data-toggle="modal" data-target="#product" onclick="startAjax();">
                <i class="fas fa-cart-plus fa-2x"></i>
            </a>
        </div>
            <!-- Niet doorsturen maar toevoegen-->
            <div class="col-md-5">
            <form method='post'>
                <button type='submit' formaction='#' name='wadd' type='button' value='<?php print $nummer ?>' class='btn'>
                    <i style='color:#00BDF3' class='fas fa-heart fa-2x'></i>
                </button>
            </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            var carousel = $('#carousel');
            carousel.on('slid.bs.carousel', function () {
                var div = $('div.active');
                if(div.find("video").get(0))
                {
                    var video = div.find("video").get(0);
                    video.play();
                }

            });
        });
    </script>
    <!--    Carrousel start-->
    <div class="row" >
        <div class="col-12">
        <div class="text-center">
            <div id="carousel" class="carousel slide" data-ride="carousel"  data-pause="hover" style=" width:100%; height: 100%; !important;">
                <!--            Carrousel inner items-->
                <div class="carousel-inner" style="margin-bottom:10%; height: 100%">
                    <div class="carousel-item active">
                        <img class="img-fluid" src="images/wijn1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="img-fluid" src="images/wijn2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="img-fluid" src="images/wijn3.png" alt="Third slide">
                    </div>
                    <div class="carousel-item" style="video{ width:100%; height: auto}">
                        <video width="100%" height="auto" controls>
                            <source src="images/test.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
                <!--            Carrousel controls-->
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <!--            Carrousel small indicators-->
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active" style="width: 20%;">
                        <img class="d-block w-100" src="images/wijn1.jpg">
                    </li>
                    <li data-target="#carousel" data-slide-to="1" style="width: 20%;">
                        <img class="d-block w-100" src="images/wijn2.jpg">
                    </li>
                    <li data-target="#carousel" data-slide-to="2" style="width: 20%;">
                        <img class="d-block w-100" src="images/wijn3.png">
                    </li>
                    <li data-target="#carousel" data-slide-to="3" style="width: 20%;">
                        <img class="d-block w-100" src="images/video.png">
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="h-divider" style=" border-top: white">
    </div>
        <!--    items under the carrousel-->
        <div class="row pt-md-5" style="margin-top: 16%">
            <div class="col-4">
                <h2><?php print("€" . $price); ?></h2>
            </div>
            <div class="col-6">
                <h2>Voorraad</h2>
            </div>
        </div>
        <!--    style for css needs to be moved-->
        <style type="text/css">
            .h-divider {
                margin-top: 5px;
                margin-bottom: 5px;
                height: 1px;
                width: 100%;
                border-top: 1px solid gray;
            }
        </style>
        <div class="h-divider">
        </div>
        <!--    needs intermediate database  -->
        <div class="col-12">
            <h4>Productcategorie</h4>
        </div>
        <div class="col-12">
            <div class="panel-body" align="centre">
                Uitgebreide beschrijving van een product die over meerdere paginas kan gaan over een product dit is gewoon
                filler
            </div>
        </div>
        <div class="col-12" align="middle" style="margin-top: 5px">
            <!--        Door winkelen of naar winkelwagen op klik-->
            <script type="text/javascript">
                function startAjax() {
                    $.ajax({
                            type: "POST",
                            url: "product.php",
                            data: "wagen= <?php echo($productNummer); ?>",
                            success: function(result){
                                console.log("Yes!");
                                console.log(<?= $productNummer ?>);
                            }
                        }
                    );
                }
                function startVerlanglijst() {
                    $.ajax({
                            type: "POST",
                            url: "product.php",
                            data: "verlang= <?php echo($productNummer); ?>",
                            success: function(result){
                                console.log("Yes!");
                                console.log(<?= $productNummer ?>);
                            }
                        }
                    );
                }
            </script>

        </div>
        <div class="text-centre">
            <form>
                <button formmethod="post" name="wagen" type="button" value="<?php print($productNummer); ?>" class="btn btn-primary btn-lg bnt-block" data-toggle="modal" data-target="#product" onclick="startAjax();">
                    <i class="fas fa-cart-plus"></i> Voeg toe aan winkelwagen
                </button>
            </form>
        </div>
        <div class="h-divider">
        </div>
        <!--        Reviews to be added-->
<!--insert review on bottom of page--------------------->
        <div>
            <h3 class="col-12">review</h3>
            <?php
            $db = new DbHandler("USER");
            $connection = $db->connect();
            $sql = "SELECT R.score, R.description, C.firstname, C.lastname FROM review R JOIN customer C ON R.customerID=C.customerID WHERE productID=:pid";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':pid' => $productNummer]);
            $reviews = $stmt->fetchAll();
            $db->disconnect();
            $db = null;

            if (empty($reviews)){
                print "<h6>Er zijn nog geen reviews geschreven over dit product</h6>";
            } else {
            foreach ($reviews as $review){
                print "<div><strong>".($review["firstname"])." ".($review["lastname"])
                    ."</strong><br>Score: ";
                for ($i=0;$i<(round($review["score"], 0));$i++) {
                    print "<span class='fa fa-star' style='color:gold'></span>";
                }
                print "<br>".($review["description"]);
                print "</div><br>";
            }
            }
            ?>
            <a class="btn btn-primary btn-lg bnt-block" style="margin-bottom: 10px" href="review.php?pid=<?=$productNummer?>"><i class="fas fa-pen-nib"></i> Schrijf een review</a>
        </div>
        <div class="modal" tabindex="-1" id="product" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Wilt u verder winkelen of doorgaan naar de winkelwagen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a type="button" class="btn btn-primary btn-lg bnt-block my-3" href="winkelmandje.php">
                            Doorgaan naar de winkelwagen
                        </a>
                        <a type="button" class="btn btn-primary btn-lg bnt-block my-3" data-dismiss="modal">
                            Verder winkelen
                        </a>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>

<?PHP

include_once("../public/includes/footer.php");
?>