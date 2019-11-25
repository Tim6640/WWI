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

//start review page
//get customerId from session

$succesfulReview=false;


if (!empty($_POST["submit"])) {
    //start connection---------------
    $host = "localhost";
    $databasename = "kbsdatabase";
    $user = "root";
    $pass = null;
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $databasename, $port);

//input data to database--------------------------------------------------------------------------------------------
//    $customerId=$_session["CustomerId"];
    $customerId=1;
//    $productNummer = $_GET["pid"];
    $productNummer=23;
    $rating= $_POST["rating"];
    $review= $_POST["review"];

    //check if review already exists
    $sql = "SELECT COUNT(*) AS 'count' FROM review WHERE customerId=? AND StockItemID=?";
    $statement = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($statement, 'ii', $customerId, $productNummer);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if ($result['count'] = 0) {
        //if review doesn't exist yet use insert
        $sql = "INSERT CustomerId, ProductID, rating, review INTO review VALUES (rating=?, review=?)";
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, 'ds', $rating, $review);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

    } else {
        //if review already exist yet use update
        $sql = "UPDATE review SET (rating=?, review=?) WHERE CustomerId=? AND ProductID=? ";
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, 'ds', $rating, $review);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

    }
    $succesfulReview=true;
    print "review is gepost";

//close connection---------------
    mysqli_stmt_close($statement);
    mysqli_free_result($result);
    mysqli_close($connection);
}

// check if review is set. if not then show form---------------------------------------------------------------------
if (!$succesfulReview) {
    if (isset($_GET["pid"])) {
        //start connection-----------------
        $host = "localhost";
        $databasename = "wideworldimporters";
        $user = "root";
        $pass = null;
        $port = 3306;
        $connection = mysqli_connect($host, $user, $pass, $databasename, $port);

//gather data------------------------------------------------------------------
        $productNummer = $_GET["pid"];
        $sql = "SELECT StockItemName, Photo FROM stockitems WHERE StockItemID=?";
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, 'i', $productNummer);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

//show product image/name/additional info------------------------------------
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $name = $row["StockItemName"];
        $photo = $row["Photo"];
        print "<div class='card'>";
        print "<img src='images\wwi_logo_small.png' width='160px' height='auto'>";
        print "$name";
        print "</div>";

//close connection--------------------
        mysqli_stmt_close($statement);
        mysqli_free_result($result);
        mysqli_close($connection);

//review process-------------------------------------------
//form start

        print "<br><form method='post' action='review.php'>";
//input rating
        print "score<br>";
        print "<input type='text' value='5,0' name='rating'><br>";
//input reviewtext
        print "Review<br>";
        print "<textarea name='review' rows='6' cols='37'>Plaats hier uw review</textarea><br><br>";
//input review button
        print "<input type='submit' name='submit' value='Plaatsen'>";
//form end
        print "</form>";

        //if pid is not set-----------------------------------------------------
    } else {
        print "";
        print "Deze pagina bestaat niet<br>";
        print "klik <a href='/wwi/public'>hier</a> om terug te gaan naar de thuispagina";
    }
} else {
    print "review is succesvol gemaakt";
    print "klik <a href='/wwi/public'>hier</a> om terug te gaan naar de thuispagina";
}


include_once("../public/includes/footer.php");
?>