<!DOCTYPE html>
<?php
#headers
include_once("../src/core/DbHandler.php");
$pageTitle = "Home";
include_once("../public/includes/header.php");

//ini_set('display_errors', 0);
if (isset($_POST["change"])) {

    //check password-----------------------------------------------------------------------------
//use email and password to compare passwords

    //if correct then execute update-------------------------------------------------------------
    if (!empty($_POST["PassNew"])) {
        $password = hash('sha256', $_POST["PassNew"]);
    }
    //defining variables to use in insert
    $passwordOld= hash('sha256', $_POST['Pass']);
    $email= ($_POST["Email"]);
    $firstName = ucfirst(mb_strtolower($_POST["Voornaam"]));
    $inPrefix = ucfirst(mb_strtolower($_POST["Tussenvoegsel"]));
    $lastName = ucfirst(mb_strtolower($_POST["Achternaam"]));
    $city = ucfirst(mb_strtolower($_POST["Woonplaats"]));
    $street = ucfirst(mb_strtolower($_POST["Straatnaam"]));
    $postcalcode = mb_strtoupper($_POST["Postcode"]);
    $housenumber = mb_strtoupper($_POST["Huisnr"]);
    $tel = $_POST["Tel"];
    $id = $_SESSION["id"];

    $db = new DbHandler("USER");
    $connection = $db->connect();
    $sql = "UPDATE customer SET email = '$email', password = '$password', firstname = '$firstName', ln_prefix = '$inPrefix', lastname = '$lastName', city = '$lastName', city = '$city', street = '$street', postalcode = '$postcalcode', housenumber = '$housenumber', tel = '$tel' WHERE customerID = :id;";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $id]);

    if (isset($_POST["nieuwsbrief"])) {
        if ($_POST["nieuwsbrief"] == "nieuwsbrief") {
            $sql = "UPDATE customer SET newsletter=1 WHERE email= ':id'";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':id' => $email]);
        } else {
            $sql = "UPDATE customer SET newsletter=0 WHERE email = ':id'";
            $stmt = $connection->prepare($sql);
            $stmt->execute([':id' => $email]);
        }
    } else {
        $wrongpassword = true;
        print "sorry verkeerde gegevens";
    }
    //clear db connectie
    $db->disconnect();
    $db = null;

    //if false then display wrong password error-------------------------------------------------



}

?>
<head>
    <title>registration</title>
</head>
<div>
    <?php
    //start displaying user information
    //call on dbhandler
    if (isset($_SESSION["id"])){
    $db = new DbHandler("USER");
    $connection = $db->connect();
//select variables to display
    $ID = $_SESSION["id"];
    $sql = "SELECT * FROM CUSTOMER WHERE customerID=:id";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['id' => $ID]);
    $result = $stmt->fetch();
//close db connection
    $db->disconnect();
    $db = null;

    if (isset($_POST["logout"])) {
        unset($_SESSION["logged_in"]);
        unset($_SESSION["naam"]);
        unset($_SESSION["id"]);
    }
    #de daadwerkelijke registratie pagina
    if (isset($_SESSION["logged_in"])) {
    ?>
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
                               value="<?php print($result["firstname"]); ?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Tussenvooegsel</label>
                        <input type="text" name="Tussenvoegsel" class="form-control" pattern="[A-Za-z]{1,10}"
                               value="<?php print($result["ln_prefix"]); ?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Achternaam</label>
                        <input type="text" name="Achternaam" required=required class="form-control"
                               pattern="[A-Za-z]{1,64}" value="<?php print($result["lastname"]); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Woonplaats</label>
                        <input type="text" name="Woonplaats" class="form-control" required=required
                               pattern="[A-Za-z]{1,64}" value="<?php print($result["city"]); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Straatnaam</label>
                        <input type="text" name="Straatnaam" class="form-control" required=required
                               pattern="[A-Za-z]{1,64}" value="<?php print($result["street"]); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Postcode</label>
                        <input type="text" name="Postcode" class="form-control" required=required
                               pattern="[1-9][0-9][0-9][0-9][A-Za-z][A-Za-z]"
                               value="<?php print($result["postalcode"]); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Huisnummer en toevoeging</label>
                        <input type="text" name="Huisnr" class="form-control" required=required
                               pattern="[A-Za-z0-9]{1,3}"
                               value="<?php print($result["housenumber"]); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Telefoonnummer</label>
                        <input type="text" name="Tel" class="form-control" required=required pattern="[0-9,-]{10,15}"
                               value="<?php print($result["tel"]); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>Email</label>
                        <input type="email" name="Email" class="form-control" required=required
                               value="<?php print($result["email"]); ?>">
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
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="nieuwsbrief"
                               value="nieuwsbrief" <?php
                               if (($result["newsletter"])==1) {
                            print "checked";
                        } ?>>
                        <label class="form-check-label" for="gridCheck">
                            schrijf me in voor de nieuwsbrief (optioneel)
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <input type="submit" name="change" value="Wijzigen" class="btn btn-primary"
                           style="margin-bottom: 25px;margin-right: 10px">
    </form>
    <form method="post" action="accountinformatie.php"><input type="submit" name="logout" value="uitloggen"
                                                              class="btn btn-primary"
                                                              style="margin-bottom: 25px"></form>
</div>
</div>
<?php
    }
} else {
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
    </body>
    </html>

    <?php
}
include_once("../public/includes/footer.php");
?>