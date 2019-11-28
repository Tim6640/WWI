<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 13-11-2019
 * Time: 12:13
 */

?>
<!-- webpagina code-->
<!-- Footer -->

<footer class="bg-info page-footer">
    <div class="container pt-3">
        <div class="row">
            <!-- logo -->
            <div class="col-4">
                <img class="footer-logo " src="images/wwi_logo_small.png">
                <h6 class="footer-title">Wide World <span class="text-secondary">Importers</span></h6>
            </div>
            <!-- Over ons -->
            <div class="col-4">
                <h6 class="text-uppercase text-white">over ons</h6>
                <ul class="list-unstyled">
                    <li><a class="text-white" href="#!"><i class="fas fa-at"> E-mail</i></a></li>
                    <li><a class="text-white" href="#!"><i class="fas fa-phone-alt"> Telefoon</i></a></li>
                    <li><a class="text-white" href="#!"><i class="fas fa-map-marker"> Adres</i></a></li>
                    <li><a class="text-white" href="#!"><i class="far fa-newspaper"> Nieuwsbrief</i></a></li>
                </ul>
            </div>
            <!-- Overig -->
            <div class="col-4">
                <h6 class="text-uppercase text-white">Overig</h6>
                <ul class="list-unstyled">
                    <li><a class="text-white" href="#!"><i class="fab fa-facebook"> Facebook</i></a></li>
                    <li><a class="text-white" href="#!"><i class="fab fa-twitter-square"> Twitter</i></a></li>
                    <li><a class="text-white" href="#!"><i class="fab fa-instagram"> Instagram</i></a></li>
                    <li><a class="text-white text-decoration-none" href="#!"><i class="fas fa-question-circle"></i> FAQ</i></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <h5 class="text-white">Inschrijven Nieuwsbrief&nbsp</h5>
            <form method="post">
                <input type="email" name="email"><br>
                <p style="color:white">Ik geef toestemming dat WWI mij e-mails verstuurt
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
    </div>

<?php
    if (isset($_POST["verzenden"])){
        $db = new DbHandler();
        $connection = $db->connect();
        $sql = "INSERT INTO subscription VALUES (email=?)";
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $_POST["email"]]);
        $db->disconnect();
        $db = null;
    }
    ?>

    <!-- Copyright -->
    <div class="footer-copyright bg-secondary text-center">© ICTM1e2 Windesheim
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
</body>
</html>
