<?php
#header
include_once("../src/core/DbHandler.php");
$pageTitle = "Home";
include_once("../public/includes/header.php");

if(isset($_POST["email"], $_POST["password"]))
{
    #connectie
    $email = $_POST["email"];
    $password = hash('sha256', $_POST["password"]);
    $db = new DbHandler("USER");
    $connection = $db->connect();
    $sql = "SELECT firstname, password, email, customerID FROM customer WHERE email =:id AND password =:pid";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id'=>$email, ':pid'=>$password]);
    $result = $stmt->fetch();
    //clear db connectie
    $db->disconnect();
    $db = null;

    if(!empty($result)) {
        $_SESSION["logged_in"] = true;
        $_SESSION["naam"] = ($result["firstname"]);
        $_SESSION["id"] = ($result["customerID"]);
    }
    else {
    }

}

#verwijdert error
//error_reporting(0);
?>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<?php
#als al bent ingelogt krijg je dit scherm
if (isset($_SESSION["logged_in"])) {
    ?>
    <div class="container h-100">
    <div class="px-4 px-lg-0">
        <!-- For demo purpose -->
        <div class="text-lg-center">
            <h1 class="display-4 text-center" style="color: green">Je bent ingelogd</h1>


        </div>
    </div>
    <div class="px-4 px-lg-0 ">
            <div class="text-lg-center">
                <a href="index.php">
                    <h5 class="text-center">terug naar homepage</h5>
                </a>
            </div>
        </div>
    </div>
    <?php
}else {
    ?>
    <!-- kaartje van alles -->
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <!-- logo plaats -->
                    <div class="brand_logo_container">
                        <img src="images/wwi_logo_small.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form method="post" action="login.php">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <!-- als geprobeert is in te loggen maar fout email of wachtoowrd maakt de vakken rood -->
                            <input type="email" name="email" class="form-control input_user" value=""
                                   placeholder="gebruiker@outlook.com" <?php if (array_key_exists("email", $_POST)) {
                                if (!array_key_exists("logged_in", $_SESSION)) {
                                    print "style=\"border: 2px red solid\"";
                                }
                            } ?>>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <!-- als geprobeert is in te loggen maar fout email of wachtoowrd maakt de vakken rood -->
                            <input type="password" name="password" class="form-control input_pass" value=""
                                   placeholder="wachtwoord" <?php if (array_key_exists("email", $_POST)) {
                                if (!array_key_exists("logged_in", $_SESSION)) {
                                    print "style=\"border: 2px red solid\"";
                                }
                            } ?>>
                        </div>
                        <!-- als geprobeert is in te loggen maar fout email of wachtoowrd laat deze tekst zien-->
                        <?php if (array_key_exists("email", $_POST)) {
                            if (!array_key_exists("logged_in", $_SESSION)) {
                                print "<span style='color: red'>Email of wachtwoord is incorrect</span>";
                            }
                        } ?>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <input type="submit" name="button" value="login" class="btn login_btn">
                        </div>
                    </form>
                </div>
                <!-- registeren -->
                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Heb je nog geen account? <a href="account.php" class="ml-2">Registeren
                    </div>

                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}
include_once ("../public/includes/footer.php");
?>