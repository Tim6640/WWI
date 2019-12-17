<!DOCTYPE html>
<?php
#headers
include_once("../src/core/init.php");
$pageTitle = "Home";
include_once("../public/includes/header.php");
ini_set('display_errors', 0);
if ($_POST["change"] == "change"){
    $email = $_POST["Email"];
    if (array_key_exists("PassNew", $_POST)){
        $password = hash('sha256',$_POST["PassNew"]);
    }else{
        $password = hash('sha256',$_POST["Pass"]);
    }
    $firstName = ucfirst(mb_strtolower($_POST["Voornaam"]));
    $inPrefix = ucfirst(mb_strtolower($_POST["Tussenvoegsel"]));
    $lastName = ucfirst(mb_strtolower($_POST["Achternaam"]));
    $city = ucfirst(mb_strtolower($_POST["Woonplaats"]));
    $street = ucfirst(mb_strtolower($_POST["Straatnaam"]));
    $postcalcode = mb_strtoupper($_POST["Postcode"]);
    $housenumber = mb_strtoupper($_POST["Huisnr"]);
    $tel = $_POST["Tel"];
    $id = $_SESSION["id"];
    $host = "localhost";
    $databasename = "wideworldimportersextra";
    $user = "root";
    $pass = "";
    $port = 3306;
    $conn = new mysqli($host, $user, $pass, $databasename, $port);
    $sql = $conn->query("UPDATE customer SET email = '$email', password = '$password', firstname = '$firstName', ln_prefix = '$inPrefix', lastname = '$lastName', city = '$lastName', city = '$city', street = '$street', postalcode = '$postcalcode', tel = '$tel' WHERE customerID = '$id';");
    if ($_POST["nieuwsbrief"] == "nieuwsbrief"){
        $sql2 = $conn->query("INSERT INTO newsletter(email) VALUES ('$email')");
    }
    else{
        $sql2 = $conn->query("DELETE FROM newsletter WHERE email = '$email'");
    }
}

?>
<head>
    <!-- stylesheets -->
    <title>registration</title>
</head>
<body>

<div>
<?php
$host = "localhost";
$databasename = "wideworldimportersextra";
$user = "root";
$pass = "";
$port = 3306;
$conn = new mysqli($host, $user, $pass, $databasename, $port);
$ID = $_SESSION["id"];
$result = $conn->query("SELECT * FROM CUSTOMER WHERE customerID = '$ID'");
$row = mysqli_fetch_assoc($result);
$result2 = $conn->query("SELECT email FROM newsletter WHERE email = '$email' ");
$nieuwsbrief = mysqli_fetch_assoc($result2);
if ($_POST["logout"] == "uitloggen"){
    unset($_SESSION["logged_in"]);
    unset($_SESSION["naam"]);
    unset($_SESSION["id"]);
}
#de daadwerkelijke registratie pagina
if($_SESSION["logged_in"]) {
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse"  id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0 text-lg-center">
                <li class="nav-item">
                    <a class="nav-link"style="color: black" href="accountinformatie.php">accountinformatie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black" href="#">verlangijstje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black" href="#">transactiegeschiedenis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: black" href="activeren.php">membership</a>
                </li>
            </ul>
        </div>
    </nav>
    <form method="post" action="accountinformatie.php">
        <div class="px-4 px-lg-0">
            <!-- For demo purpose -->
            <div class="text-lg-center">
                <h1 class="display-4 text-center" STYLE="margin-bottom: 0.2cm">Account informatie </h1>

            </div>
            <div class="container">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>Voornaam</label>
                        <input type="text" name="Voornaam" class="form-control" required=required
                               pattern="[A-Za-z]{1,64}"
                               value="<?php print($row["firstname"]); ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Tussenvooegsel</label>
                        <input type="text" name="Tussenvoegsel" class="form-control" pattern="[A-Za-z]{1,10}"
                               value="<?php print($row["ln_prefix"]); ?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Achternaam</label>
                        <input type="text" name="Achternaam" required=required class="form-control"
                               pattern="[A-Za-z]{1,64}" value="<?php print($row["lastname"]); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Woonplaats</label>
                        <input type="text" name="Woonplaats" class="form-control" required=required
                               pattern="[A-Za-z]{1,64}" value="<?php print($row["city"]); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Straatnaam</label>
                        <input type="text" name="Straatnaam" class="form-control" required=required
                               pattern="[A-Za-z]{1,64}" value="<?php print($row["street"]); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Postcode</label>
                        <input type="text" name="Postcode" class="form-control" required=required
                               pattern="[1-9][0-9][0-9][0-9][A-Za-z][A-Za-z]"
                               value="<?php print($row["postalcode"]); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Huisnummer en toevoeging</label>
                        <input type="text" name="Huisnr" class="form-control" required=required
                               pattern="[A-Za-z0-9]{1,3}"
                               value="<?php print($row["housenumber"]); ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Telefoonnummer</label>
                        <input type="text" name="Tel" class="form-control" required=required pattern="[0-9,-]{10,15}"
                               value="<?php print($row["tel"]); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>Email</label>
                        <input type="email" name="Email" class="form-control" required=required
                               value="<?php print($row["email"]); ?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Huidige wachtwoord</label>
                        <input type="password" name="Pass" required=required class="form-control">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Nieuwe wachtwoord(optioneel)</label>
                        <input type="password" name="PassNew" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="nieuwsbrief" value="nieuwsbrief" <?php if(!empty($nieuwsbrief)){print "checked";} ?>>
                        <label class="form-check-label" for="gridCheck" >
                            schrijf me in voor de nieuwsbrief (optioneel)
                        </label>
                    </div>
                </div>
<div class="form-row">
                <input type="submit" name="change" value="change" class="btn btn-primary"
                       style="margin-bottom: 25px;margin-right: 10px"></form>
        <form method="post" action="accountinformatie.php"><input type="submit" name="logout" value="uitloggen" class="btn btn-primary"
                            style="margin-bottom: 25px"></form>
</div>

            </div>


    <?php
}else{
?>
<div class="container h-100">
    <div class="px-4 px-lg-0">
        <!-- For demo purpose -->
        <div class="text-lg-center">
            <h1 class="display-4 text-center" style="color: red">Je bent uitgelogd</h1>


        </div>
    </div>
    <div class="px-4 px-lg-0 ">
        <div class="text-lg-center">
            <a href="homepage.php">
                <h5 class="text-center">terug naar homepage</h5>
            </a>
        </div>
    </div>
</div>
<!-- javescripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php
}
#footer
include_once ("../public/includes/footer.php");
?>