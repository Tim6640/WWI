
    <style>
        /* de style van de knop */
        .accordion {
            background-color: #eee;
            color: #444;
            padding: 18px;
            width: 100%;
            text-align: left;
            border: none;
            outline: none;
        }

        /* kleur van de knop als je erop klikt */
        .active, .accordion:hover {
            background-color: #ccc;
        }

        /* style van de tekst */
        .panel {
            padding: 0 18px;
            background-color: white;
            display: none;
        }
    </style>
    <?php
    include_once("../src/core/init.php");
    $pageTitle = "FAQ";
    include_once("../public/includes/header.php");
    ?>
<div class="container text-center">
    <h1>FAQ</h1>
</div>
<div class="container">
    <div class="align-content-center">
    <strong>Dit is onze FAQ, waar eerder gestelde vragen worden beantwoord. Hier kunt u met uw problemen terecht. Mocht dit uw probleem niet oplossen, neem dan graag contact op.</strong>
    <hr>
        <button class="accordion"><h5>1. Wanneer ontvang ik mijn bestelling?</h5></button>
        <div class="panel">
            <p>In verband met de drukte tijdens de feestdagen lukt het ons niet altijd om je pakketje op tijd langs te brengen. Wij streven ernaar om je bestelling binnen 2 dagen te bezorgen.
            Niet (alles) ontvangen?
            We kunnen niet altijd alle artikelen van één bestelling op hetzelfde moment verzenden. In je account zie je of we alles tegelijkertijd verzonden hebben. Als wij wel alles tegelijk hebben verzonden, kun je het beste even contact opnemen met onze klantenservice.
            </p>
        </div>
    <hr>
        <button class="accordion"><h5>2. Mijn review wil niet plaatsen, hoe kan dit?</h5></button>
        <div class="panel">
            <p>Onze reviews zijn 100% onafhankelijk. Dit houdt in dat wij geen neppe accounts of derde partijen gebruiken die onechte reviews schrijven. Om toch te voorkomen dat wij neppe reviews ontvangen hebben wij onze reviewpagina er op ingesteld dat je maximaal een cijfer van 1 tot en met 5 in kan voeren i.p.v. 1 tot en met 10. Ook moet je een account hebben, mocht je een review willen schrijven. </p>
        </div>
    <hr>
        <button class="accordion"><h5>3. Het product dat ik zoek is niet meer op voorraad, wanneer word deze weer beschikbaar?</h5></button>
        <div class="panel">
    <p>Wij doen ons best om ieder product altijd op voorraad te hebben. Toch kan het zijn dat er door de drukte i.v.m. de feestdagen toch een product niet op voorraad is. Neem in dat geval contact op met onze klantenservice, dan vertellen wij u wanneer het product weer op voorraad is.</p>
        </div>
    <hr>
        <button class="accordion"><h5>4. Mijn pinpas word telkens geweigerd, hoe kan dit?</h5></button>
            <div class="panel">
    <p>Door een storing bij IDeal kunnen wij daar helaas geen betalingen mee verwerken. Mocht dit probleem blijven voorkomen, stuur ons dan uw creditcardgegevens en pincode, dan helpen wij u graag verder!</p>
            </div>
    <hr>
        <button class="accordion"><h5>5. Ik wil graag een klacht indienen, waar kan ik dit doen?</h5></button>
                <div class="panel">
    <p>Dit kan onderaan de pagina onder het kopje contact, maar ook via een review onder een product.</p>
        <hr>
    </div>
</div>
</div>
    <br>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
<?php
include_once ("../public/includes/footer.php");
?>