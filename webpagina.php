<!DOCTYPE html>
<!--[Marijn Van Wietmarschen s1142956]-->
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>product</title>
</head>
<body>

<?php
ini_set('display_errors', 1);
$host = "localhost";
$databasename = "wideworldimporters";
$user = "root";
$pass = "";
$port = 3306;
$conn = new mysqli($host, $user, $pass, $databasename, $port);
$result = $conn->query('SELECT * FROM stockitems LIMIT 6');
if ($conn->error) {
    user_error('Onze error ' . $conn->error);
    die();
}
print "<form action=\"verwerk.php\" method=\"post\">";
foreach ($result as $row) {
    printf('<img src="%s" alt="dobbelsteen" style=\'width: 240px;height: 120px;border: 5px;\'/>', $row['Photo']);
    printf("<input type=\"checkbox\" name=\"%d\" value=\"%d\" style='width: 48px;height: 48px;border: 5px;'><br>", $row["StockItemID"], $row["RecommendedRetailPrice"]);

}
print "<input type=\"submit\" name=\"submit\" value=\"verwerk\"></form>";

?>
</body>
</html>