<?php
include_once('includes/header.php');
$pageTitle = "contact";
?>
    <html>
    <head>
<body>
<?php
if (empty($_POST)) {
    ?>
    <div class="container">
        <div class="row" style="padding-top: 20px">
            <div class="text-center mx-auto">
                <!-- header-->
                <h2>Neem contact met ons op</h2>
                <!-- Forms-->
                <form class="w-auto" method="post">
                    <div class="form-group row">
                        <!--Naam-->
                        <div class="col-7" style="padding-top: 50px">
                            <input type="text" class="form-control" name="Naam" placeholder="Naam"
                                   pattern="[A-Z a-z]{1,64}" required="required">
                        </div>
                        <!--E-mail-->
                        <div class="col-7" style="padding-top: 10px">
                            <input type="text" class="form-control" name="E-mail" placeholder="E-mail"
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required="required">
                        </div>
                        <!--Onderwerp-->
                        <div class="col-7" style="padding-top: 10px">
                            <input type="text" class="form-control" name="Onderwerp" placeholder="Onderwerp"
                                   pattern="[A-Z a-z]{1,64}" required="required">
                        </div>
                        <!--Bericht-->
                        <div class="col-12" style="padding-top: 40px">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                          placeholder="Bericht" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                          required="required"></textarea>
                        </div>
                    </div>
                    <!--Image-->
                    <div class="row">
                        <div class="mx-auto" style="border: solid 2px grey; border-radius: 16pxs ">
                            <img class="img-fluid" src="../public/images/logo_recaptcha_2.png"
                                 alt="">
                            <!--Checkbox-->
                            <div class="col-12">
                                <label class="mx-auto"><input type="checkbox" required="required">Ik ben
                                    geen robot</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                    </div>
                    <!--Verzenden-->
                    <button type="submit" class="btn btn-primary btn-lg text-center mx-auto"
                            style="margin-top: 20px; margin-bottom: 10px">Verzenden
                    </button>
            </div>
            </form>
        </div>
    </div>
    </form>

    </div>
    </div>
    </container>
    <?php
} else {


    ?>
    <!--Versturen succesvol-->
    <div class="row">
        <div class="col-12">
            <div class="m-auto alert alert-success">
                <h6 class="text-center">U heeft contact met WWI opgenomen, uw vraag wordt nu behandeld door een van onze
                    medewerkers.</h6>
                <img src="images/betaald.png" class="img-fluid m-auto" alt="Responsive image" style="width: 100px; height: auto; display: block;">
            </div>
        </div>
    </div>
    <!--homepage knop-->
    <div class="px-4 px-lg-0 " style="padding-top: 10px">
        <div class="text-lg-center">
            <a href="homepage.php">
                <h5 class="text-center">terug naar homepage</h5>
            </a>
        </div>
    </div>
    </body>
    </head>
    </html>
    <?php

}
include_once('includes/footer.php');

?>