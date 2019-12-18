<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */

include_once("../src/core/init.php");
$pageTitle = "Homepage";
include_once("../public/includes/header.php");
?>
    <!-- $pageTitle is defined on the page visited -->
    <title>Wide World Importers</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WideWorldImporters">
    <meta name="keywords" content="WWI, WideWorldImporters">
    <!-- Homepage stylesheet include -->
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <!-- Fontawesome, handles the icons -->
    <script src="https://kit.fontawesome.com/6756a99abc.js" crossorigin="anonymous"></script>
    <!-- Bootstrap javascript include -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-12" style="padding-right: 0px; padding-left: 0px;">
                <img class="img-responsive" src="images/banner7.jpg">
            </div>
        </div>
        <div class="row text-center" style="background-color: #0080ff;">
            <h4 class="text-center" style="margin-bottom: 5px; color: black;">Let op! U heeft nog</h4>
        </div>
        <div class="row" style="background-color: #0080ff; align-items: center;">
            <h5 class="text-center"
                style="margin-top: 5px; margin-bottom: 10px; font-family: Verdana; font-weight: bold; color:lightgrey;"
                id="demo"></h5>
        </div>
        <script>
            var countDownDate = new Date("Dec 9, 2019 00:00:25").getTime();

            // Update the count down every 1 second
            var x = setInterval(function () {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("demo").innerHTML = days + " dagen, " + hours + " uur, "
                    + minutes + " minuten en " + seconds + " seconden!";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
            }, 1000);
        </script>
        <!--Banner-Title-->
        <div class="text-left" style="padding-left: 0px; padding-top: 0px;">
            <h4>Onze bestsellers</h4>
        </div>
        <div class="col">
            <div class="carousel-slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php
                    $db = new DbHandler("ERP");
                    $connection = $db->connect();
                    $query = "SELECT distinct si.StockItemID, si.StockItemName, si.Photo FROM stockitems si JOIN orderlines ol ON si.StockItemID = ol.StockItemID ORDER BY ol.Quantity LIMIT 12;";
                    $stmt = $connection->prepare($query);
                    $stmt->execute();
                    $resultaten = $stmt->fetchAll();
                    $i = 0;
                    foreach ($resultaten as $resultaat) {
                        if ($i == 0) {
                            ?>
                            <div class="carousel-item active">
                                <a href="product.php?pid=<?=$resultaat["StockItemID"]?>"><img src="images/wijn3.png" alt="Wijnen! Wijnen! Wijnen!">
                                    <h5> <?php print($resultaat['StockItemName']); ?></h5>
                                    <button type="button" class="btn btn-primary" href="#" role="button">Bekijken</button></a>
                            </div>
                            <?php
                            $i++;
                        } else {
                            ?>
                            <div class="carousel-item">
                                <a href="product.php?pid=<?=$resultaat["StockItemID"]?>"><img src="images/wijn2.jpg" alt="Wijnen! Wijnen! Wijnen!">
                                    <h5> <?php print($resultaat['StockItemName']); ?></h5>
                                    <button type="button" class="btn btn-primary" href="#" role="button">Bekijken</button></a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <hr/>
        <!--Company description-->
        <div class="row" style="padding-right: 38px; padding-left: 38px;">
            <h1>Wij zijn Wide World Importers</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                anim id est laborum.</p>
        </div>
        <hr/>

        <!--Banner Carousel-->

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding-right: 0px; padding-left: 0px;">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!--Carousel item indicators-->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <!--Carousel items content-->
                <div class="carousel-inner" role="listbox" style="margin: 0px; padding: 0px; border: 0px; margin: none; ">
                    <div class="carousel-item img-responsive active">
                        <img src="images/banner1.jpg" class="img-responsive" alt="Afbeelding1">
                    </div>

                    <div class="carousel-item img-responsive">
                        <img src="images/banner2.jpg" class="img-responsive" alt="Afbeelding2">
                    </div>

                    <div class="carousel-item img-responsive">
                        <img src="images/banner3.jpg" class="img-responsive" alt="Afbeelding3">
                    </div>
                </div>
            </div>
        </div>

        <!--end of banner carousel-->
        <!--added subscription section-->
        <br>
        <h5>Inschrijven Nieuwsbrief&nbsp</h5>
        <form method="post" action="">
            <input type="email" name="email" placeholder="bla@bla.nl">
            <p>Ik sta toe dat WWI mij e-mails verstuurt
                <input type="checkbox" id="termsChkbx " onclick="change_button(this,'sub1')"></p>
            <p><input type="submit" name="submit" value="verzenden" id="sub1" disabled="disabled"></p>
        </form>
        <script type = "text/javascript">
            function change_button(checkbx,button_id) {
                var btn = document.getElementById(button_id);
                if (checkbx.checked == true) {
                    btn.disabled = "";
                } else {
                    btn.disabled = "disabled";
                }
            }
        </script>
    </div>
<?php
if (isset($_POST["email"])) {
    $db = new DbHandler("USER");
    $connection = $db->connect();
    $sql = "INSERT INTO newsletter (email) VALUES (:id)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $_POST["email"]]);
    $db->disconnect();
    $db = null;
}
include_once("../public/includes/footer.php");
?>