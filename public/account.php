<!DOCTYPE html>
<?php
#headers
include_once("../src/core/DbHandler.php");
$pageTitle = "Home";
include_once("../public/includes/header.php");

?>
<html>
<head>
    <title>registration</title>
</head>

<body>
<?php
#geen error
error_reporting(0);
#connectie maken met database als het gepost is
if(isset($_POST['registeren'])) {
    print "<div class=\"container my-5 text-center\" role=\"alert\" style=\"\">";
    $bevestiging = $_POST['registeren'];
    $email = $_POST["Email"];
    $host = "localhost";
    $databasename = "wideworldimportersextra";
    $user = "root";
    $pass = "";
    $port = 3306;
    $conn = new mysqli($host, $user, $pass, $databasename, $port);
    $emailCheck = $conn->query("SELECT email FROM customer WHERE email = '$email';");
    if (mysqli_num_rows($emailCheck) > 0){
        $bevestiging = "niet registeren";
    }
    #controleren of de submit goed is gegaan
    if ($bevestiging == "registeren") {
        print('
        <div class="row">
            <div class="col-12">
                <div class="m-auto alert alert-success">
                    <p class="text-center">Uw account is geregisteerd!</p>
                    <img src="images/betaald.png" class="img-fluid" alt="Responsive image"style="height: 100px">
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
            <a href="index.php">
                <button type="button" class="btn btn-lg btn-primary center-block">home <i class="fas fa-home"></i></button></a>
            </div>
        </div>
        </div>');
        #alles in de database gooien
        $password = hash('sha256',$_POST["Pass"]);
        $firstName = ucfirst(mb_strtolower($_POST["Voornaam"]));
        $inPrefix = ucfirst(mb_strtolower($_POST["Tussenvoegsel"]));
        $lastName = ucfirst(mb_strtolower($_POST["Achternaam"]));
        $city = ucfirst(mb_strtolower($_POST["Woonplaats"]));
        $street = ucfirst(mb_strtolower($_POST["Straatnaam"]));
        $postcalcode = mb_strtoupper($_POST["Postcode"]);
        $housenumber = mb_strtoupper($_POST["Huisnr"]);
        $tel = $_POST["Tel"];

        $result = $conn->query("INSERT INTO customer(email, password, firstname, ln_prefix, lastname, city, street, postalcode, housenumber, tel, newsletter) values ('$email', '$password', '$firstName', '$inPrefix', '$lastName', '$city', '$street', '$postcalcode', '$housenumber', '$tel', 0);");
        mysqli_close($conn);
        ?>

        <?php
        #als iets fout is gegaan laat dit scherm zien
    } else {
        print('
        <div class="row">
            <div class="col-12">
                <div class="m-auto alert alert-danger">
                    <p class="text-center">Email bestaat al</p>
                    <img src="images/geweigerd.png" class="img-fluid m-auto" alt="Responsive image">
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
            <a href="account.php">
                <button type="button" class="btn btn-lg btn-primary center-block">Terug naar registeren <i class="fas fa-home"></i></button></a>
            </div>
        </div>
        </div>');
    }
}
else
{
#de daadwerkelijke registratie pagina
?>
<form method="post" action="account.php">
    <div class="px-4 px-lg-0">
        <!-- For demo purpose -->
        <div class="text-lg-center">
            <h1 class="display-4 text-center" STYLE="margin-bottom: 0.2cm">Account register </h1>

        </div>
        <div class="container">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>Voornaam</label>
                    <input type="text" name="Voornaam" class="form-control" required=required pattern="[A-Za-z]{1,64}">
                </div>
                <div class="form-group col-md-2">
                    <label>Tussenvooegsel</label>
                    <input type="text" name="Tussenvoegsel" class="form-control" pattern="[A-Za-z" "]{1,10}">
                </div>
                <div class="form-group col-md-5">
                    <label>Achternaam</label>
                    <input type="text" name="Achternaam" required=required class="form-control"
                           pattern="[A-Za-z]{1,64}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Woonplaats</label>
                    <input type="text" name="Woonplaats" class="form-control" required=required
                           pattern="[A-Za-z]{1,64}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Straatnaam</label>
                    <input type="text" name="Straatnaam" class="form-control" required=required
                           pattern="[A-Za-z]{1,64}">
                </div>
                <div class="form-group col-md-4">
                    <label>Postcode</label>
                    <input type="text" name="Postcode" class="form-control" required=required pattern="[1-9][0-9][0-9][0-9][A-Za-z][A-Za-z]">
                </div>
                <div class="form-group col-md-4">
                    <label>Huisnummer en toevoeging</label>
                    <input type="text" name="Huisnr" class="form-control" required=required pattern="[A-Za-z0-9]{1,3}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Telefoonnummer</label>
                    <input type="text" name="Tel" class="form-control" required=required pattern="[0-9,-]{10,15}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>Email</label>
                    <input type="email" name="Email" class="form-control" required=required>
                </div>
                <div class="form-group col-md-5">
                    <label>Wachtwoord</label>
                    <input type="password" name="Pass" required=required class="form-control">
                </div>
            </div>


            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" required=required>
                    <label class="form-check-label" for="gridCheck">
                        I agree with the terms of agreement
                    </label>
                </div>
            </div>
            <input type="submit" name="registeren" value="registeren" class="btn btn-primary"
                   style="margin-bottom: 25px">
        </div>

</form>
</body>
</html>
<?php
}
#footer
include_once ("../public/includes/footer.php");
?>