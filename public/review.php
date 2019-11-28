<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */
include_once("../src/core/DbHandler.php");
$pageTitle = "overzicht";
include_once("../public/includes/header.php");

$succesfulReview=false;

if (isset($_POST["submit"])) {
    //start connection---------------
    $db = new DbHandler();
    $connection = $db->connect();

//input data to database--------------------------------------------------------------------------------------------
//get customerId from session
//    $customerId=$_session["CustomerId"];
    $customerId=1;
//    $productNummer = $_GET["pid"];
    $productNummer=23;

    //check if review already exists
    $sql = "SELECT COUNT(*) AS 'count' FROM review WHERE customerId=? AND StockItemID=?";
    mysqli_stmt_bind_param($statement, 'ii', $customerId, $productNummer);
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $customerId, ':id' => $pid]);
    $products = $stmt->fetchAll();

    //insert rating and review
    $rating= $_POST["rating"];
    $review= $_POST["review"];
    if ($result['count'] = 0) {
        //if review doesn't exist yet use insert
        $sql = "INSERT CustomerId, ProductID, rating, review INTO review VALUES (rating=?, review=?)";
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $rating, ':id' => $review]);
    } else {
        //if review already exist yet use update
        $sql = "UPDATE review SET (rating=?, review=?) WHERE CustomerId=? AND ProductID=? ";
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $rating, ':id' => $review]);
    }
    $succesfulReview=true;
    print "review is gepost";

    //close connection
    $db->disconnect();
    $db = null;
}

// check if review is set. if not then show form---------------------------------------------------------------------
if (!$succesfulReview) {
    if (isset($_GET["pid"])) {
        $pid=$_GET["pid"];
        $db = new DbHandler();
        $connection = $db->connect();
//gather data
        $sql = "SELECT StockItemName, Photo FROM stockitems WHERE StockItemID=:id";
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $pid]);
        $product = $stmt->fetchAll();
        $db->disconnect();
        $db = null;
        $product=$product[0];
        $name=($product["StockItemName"]);
        $photo=($product["Photo"]);

        //        $name = $product["StockItemName"];
        ?>
<!--        start of form-------------------------------------------------------------------------->
        <div class="content" style="text-align:center;align-item:center">
        <div class='mx-auto text-center'>
        <img src='images\productPlaceholder.png' width='50%'>
         <h3><?php print "$name";?></h3>
        </div>
        <br><form method='post' action='review.php'>
        score<br>
        <input type='text' value='5,0' name='rating'><br>
        Review<br>
        <textarea name='review' rows='6' cols='37'>Plaats hier uw review</textarea><br><br>
        <input type='submit' name='submit' value='Plaatsen'>
        </form>
        </div>
        <?php
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