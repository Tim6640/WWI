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

?>



<?php
//start connection
$host = "localhost";
$databasename = "wideworldimporters";
$user = "root";
$pass = null;
$port = 3306;
$connection = mysqli_connect($host, $user, $pass, $databasename, $port);

//gather data
$productNummer=$_GET["pid"];
$sql = "SELECT StockItemName, Photo FROM stockitems WHERE StockItemID=?";
$statement = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($statement, 'i', $productNummer);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

//show product image/name/additional info
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$name = $row["StockItemName"];
$photo = $row["Photo"];

//print "$photo";
print "<img src='images\wwi_logo.png' align='left' width='80px' height='auto' style='display:block'><br>";
print "$name<br><br><br><br>";

//close connection
mysqli_stmt_close($statement);
mysqli_free_result($result);
mysqli_close($connection);





//review process
//form start
print "<form method='get' action='insertReview.php'>";

//input rating
print "score<br>";
print "<input type='text' value='5,0' name='rating'><br>";

//input reviewtext
print "Review<br>";
print "<input type='text' value='Schrijf hier uw review' name='review'><br><br>";

//input review button
print "<input type='submit' value='Plaatsen'>";

//form end
print "</form>";



include_once("../public/includes/footer.php");
?>