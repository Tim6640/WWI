<?php
session_start();
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */
include_once("../src/core/init.php");
$pageTitle = "overzicht";
include_once("../public/includes/header.php");
?>

<header>

<!--    <div class=".header"></div>-->
<!--    <div include-html="includes/header.php"></div>-->
</header>

 <?php
 //placeholder

 $results = array(1,10, 20, 30, 40, 50, 227);
if (isset($results)) {
    //establish connection
    $host = "localhost";
    $databasename = "wideworldimporters";
    $user = "root";
    $pass = null;
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);

    //start of loop for printing searchresults
    foreach ($results as $productNummer) {
//submit query
        $sql = "SELECT StockItemName, RecommendedRetailPrice, Photo FROM stockitems WHERE StockItemID=?";
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, 'i', $productNummer);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

        //print results
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $name = $row["StockItemName"];
            $price = $row["RecommendedRetailPrice"];
//            $photo=$row["Photo"];

            //start card body
            print "<div class=\"card\" ;\">";
/*            print "<a href='/productPagina.php?id=<?php echo $productNummer; ?>' style='display:block; text-decoration: none'>";*/
            print "<div class=\"card-body\">";
//            print "<h5 class=\"card-title\">" . $name ."</h5>";

            //print product image
            print "<div class=\"d-flex\" style='position: static'>";
            print "<a href='/productPagina.php?pid=".$productNummer."/'<br>";
            print "<div class='p-2'>";
            //            print "<img src=\"data:image/jpeg;base64, '.base64_encode($photo).'\" class=\"card-img-top\">";
            print "<img src='images\wwi_logo.png' align='left' width='80px' height='auto'>";
            print "</div>";
            print "</a>";

            //print title, review and price
            print "<a style='color: #000000' href='/productPagina.php?pid=".$productNummer."/'<br>";
            print "<div class='p-2'>";
            print "<b class=\"card-title\">" . $name ."</b>";
            print "<h6> Review *****</h6>";
            print "<h6>€ ".$price."</h6>";
            print "</div>";
            print "</a>";

//            print "<a href='/winkelwagen.php?pid=".$productNummer."/'<i class=\"fas fa-cart-plus fa-2x\"></i></button><br>";

            //print icons
            print "<div class='p-2 ml-auto'>";
            print "<a href='/winkelwagen.php?pid=".$productNummer."/'<i class=\"fas fa-cart-plus fa-2x\"></i><br>";
            print "<a href=\"/wishlist.php?pid=".$productNummer."/\"><i class=\"fas fa-heart fa-2x\"></i></a>";
            print "</div>";
            print "</div>";
            print "</div>";
        }
    }
    //close connection
    mysqli_stmt_close($statement);
    mysqli_free_result($result);
    mysqli_close($connection);

} else {
    print "helaas bestaat het gezochte product niet";
}
 ?>

<!--<div class="card" ;">-->
<!--    <img src="//plaatjeslocatie/product/plaatje1.png" class="card-img-top" alt="">-->
<!--    <div class="card-body">-->
<!--        <h5 class="card-title">Titel | Rating | Prijs</h5>-->
<!--        <p class="card-text">Hier komt de product beschrijving zoals wat het kan, welke kleur het heeft of het kan vliegen etc</p>-->
<!--        <a href="#" class="btn-cart">winkelwagen</a>-->
<!--        <a href="#" class="btn-wishlist">wishlist</a>-->
<!--    </div>-->
<!--</div>-->



<!--put html footer here-->
<?php
include_once("../public/includes/footer.php");
?>