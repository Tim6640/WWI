<?php
//add include
//$pageTitle = "product"
include_once("../src/core/DbHandler.php");
$pageTitle = "product";
include_once("../public/includes/header.php");

?>
<!doctype html>
<html lang="Ne" xmlns="http://www.w3.org/1999/html">
<head>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</head>

<?php


// SQL SETUP
$productNummer=$_GET["pid"];

$db = new DbHandler("ERP");
$connection = $db->connect();
$sql = "SELECT StockItemName, RecommendedRetailPrice FROM stockitems WHERE StockItemID=:pid";
$stmt = $connection->prepare($sql);
$stmt->execute([':pid' => $productNummer]);
$result = $stmt->fetch();
$db->disconnect();
$db = null;

$name = $result["StockItemName"];
$price = $result["RecommendedRetailPrice"];

// Logica
if(!isset($_SESSION["verlanglijstje"])) {
    $_SESSION["verlanglijstje"] = array();
}

if(isset($_POST["verlang"]) AND !in_array($_POST["verlang"] , $_SESSION["verlanglijstje"])) {
    array_push($_SESSION["verlanglijstje"], $_POST["verlang"]);
}

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
<body>
<div class="container" style="min-height:100vh">
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
        <div class="col-5">
            <a href="winkelmandje.php" class="mr-3 ml-3" data-toggle="modal" data-target="#product" onclick="startAjax();">
                <i class="fas fa-cart-plus fa-2x"></i>
            </a>
            <!-- Niet doorsturen maar toevoegen-->
            <button onclick="startVerlanglijst()">
                <i class="fas fa-heart fa-2x" ></i>
            </button>
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
    <div class="row">
        <div class="col-12">
            <div id="carousel" class="carousel slide" data-ride="carousel" data-pause="hover" style=" width:100%; height: 100%; !important;">
                <!--            Carrousel inner items-->
                <div class="carousel-inner" style="margin-bottom:10%; height: 100%">
                    <div class="carousel-item active">
                        <img class="img-fluid" src="test1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="img-fluid" src="test2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="img-fluid" src="test3.jpg" alt="Third slide">
                    </div>
                    <div class="carousel-item" style="video{ width:100%; height: auto}">
                        <video width="100%" height="auto" muted>
                            <source src="test4.mp4" type="video/mp4">
                        </video>
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
                <!--            Carrousel small indicators !!help me with the scaling!!-->
                <ol class="carousel-indicators" style="height: available">
                    <li data-target="#carousel" data-slide-to="0" class="active" style="width: 20%;">
                        <img class="d-block w-100" src="images/product/test1.jpg">
                    </li>
                    <li data-target="#carousel" data-slide-to="1" style="width: 20%">
                        <img class="d-block w-100" src="images/product/test2.jpg">
                    </li>
                    <li data-target="#carousel" data-slide-to="2" style="width: 20%">
                        <img class="d-block w-100" src="images/product/test3.jpg">
                    </li>
                    <li data-target="#carousel" data-slide-to="3" style="width: 20%">
                        <img class="d-block w-100" src="images/product/test3.jpg">
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="h-divider" style="margin-top: 5%; border-top: white ">
        <!--    items under the carrousel-->
        <div class="row">
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
                        <a type="button" class="btn btn-primary btn-lg bnt-block" href="productpagina.php">
                            Verder winkelen
                        </a>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?PHP
include_once("../public/includes/footer.php");
?>