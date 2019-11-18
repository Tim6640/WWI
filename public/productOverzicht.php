<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */
include_once("../src/core/init.php");
$pageTitle = "overzicht";
include_once("../public/includes/header.php");


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
            print "<div class=\"card-body\">";

            //print product image
            print "<div class=\"d-flex\" style='position: static'>";
            print "<a href='/productPagina.php?pid=".$productNummer."/'<br>";
            print "<div class='p-2'>";
            //            print "<img src=\"data:image/jpeg;base64, '.base64_encode($photo).'\" class=\"card-img-top\">";
            print "<img src='images\wwi_logo_small.png' align='left' width='80px' height='auto'>";
            print "</div>";
            print "</a>";

            //print title, review and price
            print "<a style='color: #000000' href='/productPagina.php?pid=".$productNummer."/'<br>";
            print "<div class='p-2'>";
            print "<b class=\"card-title\">" . $name ."</b>";

            //look up review----------------------------------------------------------------------------------
//            $reviewHost = "localhost";
//            $reviewDatabasename = "wideworldimporters";
//            $reviewUser = "root";
//            $reviewPass = null;
//            $reviewPort = 3306;
//            $reviewConnection = mysqli_connect($reviewHost, $reviewUser, $reviewPass, $reviewDatabasename, $reviewPort);
//
//            $reviewSql = "SELECT AVG(rating) FROM review WHERE StockItemId=? AND CustomerId=?";
//            $reviewStatement = mysqli_prepare($reviewConnection, $reviewSql);
//            mysqli_stmt_bind_param($reviewStatement, 'ii', $productNummer, $customerId);
//            mysqli_stmt_execute($reviewStatement);
//            $reviewResult = mysqli_stmt_get_result($reviewStatement);

            print "<h6> Review *****</h6>";

//            mysqli_stmt_close($reviewStatement);
//            mysqli_free_result($reviewResult);
//            mysqli_close($reviewConnection);
            //----------------------------------------------------------------------------------------------

            print "<h6>€ ".$price."</h6>";
            print "</div>";
            print "</a>";

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
    print "helaas bestaat het gezochte product niet<br>";
    print "klik <a href='/wwi/public'>hier</a> om terug te gaan naar de thuispagina";
}


include_once("../public/includes/footer.php");
?>