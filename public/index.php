<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */

include_once("../src/core/init.php");
$pageTitle = "Home";
include_once("../public/includes/header.php");

?>
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

include_once("../public/includes/footer.php");