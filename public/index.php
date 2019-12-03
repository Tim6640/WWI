<?php
/**
 * Created by PhpStorm.
 * User: tim11
 * Date: 7-11-2019
 * Time: 09:52
 */

include_once("../src/core/DbHandler.php");
$pageTitle = "Home";
include_once("../public/includes/header.php");

if (isset($_POST["email"])) {
    $db = new DbHandler("USER");
    $connection = $db->connect();
    $sql = "INSERT INTO newsletter (email) VALUES (:id)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id' => $_POST["email"]]);
    $db->disconnect();
    $db = null;
}

?>
    <div class="container pt-3">
        <div class="row">
            <h5>Inschrijven Nieuwsbrief&nbsp</h5>
            <form method="post" action="">
                <input type="email" name="email" placeholder="bla@bla.nl">
                <p>Ik geef toestemming dat WWI mij e-mails verstuurt
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
include_once("../public/includes/footer.php");