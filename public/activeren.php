<?php
$pageTitle = "Activeren";
include_once("../public/includes/header.php");
$_SESSION["id"] = 2;
$invalid = false;
if(isset($_POST['submit']))
{
    if($_POST['code'] == "12-34-56-78-90")
    {
        $customerID = $_SESSION["id"];
        $db = new DbHandler("USER");
        $connection = $db->connect();
        var_dump($connection);
        $sql = "UPDATE customer SET membership = true WHERE customerID =:id";
        $stmt = $connection->prepare($sql);
        $stmt->execute(['id' => $customerID]);
    }
    else{
        $invalid = true;
    }


}

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
                <a class="nav-link" style="color: black" href="verlanglijstje.php">verlanglijstje</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: black" href="orderGeschiedenis.php">transactiegeschiedenis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: black" href="activeren.php">membership</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div id="accountModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Heeft u al een account?</h5>
                    </div>
                    <div class="modal-body">
                        <p>Heeft u al een account? Zo niet maak nu een account aan in 5 minuten en ontvang uw korting.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="login.php" class="btn btn-primary">Ja, inloggen</a>
                        <a href="account.php" class="btn btn-secondary">Nee, registreren</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 text-center">
            <h1>Word nu member bij WWi</h1>
            <p>Word nu een member bij Wide World Importers.<br>Doormiddel van het invullen van een geldige membership
                code krijg u korting op uw volgende aankopen.</p>
            <form name="membership" method="post">
                <div class="form-group text-left">
                    <label for="membercode">Membership code</label>
                    <?php
                        if($invalid)
                        {
                            print('<input class="form-control is-invalid" name="code" id="membercode" type="text" placeholder="Code">');
                        }
                        else{
                            print('<input class="form-control" name="code" id="membercode" type="text" placeholder="Code">');
                        }
                    ?>
                    <div class="invalid-feedback">
                        Vul een geldige code in.
                    </div>
                </div>
                <div class="form-group">
                    <label for="submit"></label>
                    <input class="btn btn-primary" name="submit" id="submit" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if(empty(isset($_SESSION["id"])))
{
    print("
        <script type=\"text/javascript\">
            $(window).on('load',function(){
                $('#accountModal').modal('show');
            });
        </script>
    ");

}
else{
    $customerID = $_SESSION["id"];
    $db = new DbHandler("USER");
    $connection = $db->connect();
    $sql = "SELECT membership FROM customer WHERE customerID = :id";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['id' => $customerID]);
    $member = $stmt->fetchAll();
    if($member == true)
    {
        header("location: index.php");
        exit();
    }
}
include_once("../public/includes/footer.php");
?>
