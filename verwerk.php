<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>winkelmand</title>
</head>
<body>
<form action="verwerk.php" method="post">
<?php
$totaal = 0;
$aantal = 6;


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

for ($i=0;$i <=$aantal;$i++){
    if (isset($_POST[$i])) {
        $result = $conn->query("SELECT * FROM stockitems where StockItemID = '$i' LIMIT 6");
        foreach ($result as $row) {
            printf('<img src="%s" alt="dobbelsteen" style=\'width: 240px;height: 120px;border: 5px;\'/>', $row['Photo']);
            print "<img src='hartje.png' style='width:48px;height:48px;border:5px;  '> 
<img src='vuilnisbak.png' style='width: 48px;height: 48px;border: 5px;'> 
<select><option value='1'>1</option>
 <option value='2'>2</option>
 <option value='3'>3</option>
 <option value='4'>4</option>
 <option value='5'>5</option>
 <option value='6'>6</option>
 <option value='7'>7</option>
 <option value='8'>8</option>
 <option value='9'>9</option></select>" . "prijs: $" . $_POST[$i] . "<br>";

        }
        $totaal += $_POST[$i];
    }
}
print "<br><br>totaalprijs: $" . $totaal;
print "<br>" . "<input type='submit' name='winkelmandje' value='afrekenen'";

?>
</form>
</body>
</html>