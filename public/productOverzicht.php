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

<header>

<!--    <div class=".header"></div>-->
<!--    <div include-html="includes/header.php"></div>-->
</header>

<div class="card" ;">
    <img src="" class="card-img-top" alt="">
    <div class="card-body">
        <h5 class="card-title">Titel | Rating | Prijs</h5>
        <p class="card-text">Hier komt de product beschrijving zoals wat het kan, welke kleur het heeft of het kan vliegen etc</p>
        <a href="#" class="btn-cart">winkelwagen</a>
        <a href="#" class="btn-wishlist">wishlist</a>
    </div>
</div>



<!--put html footer here-->
<?php
include_once("../public/includes/footer.php");
?>