<?php require("header.php"); ?>

<main>
    <form class="catchUrl" name="catchUrl" method="get" action="/">
        <h2>Introduce url del evento</h2>
        <input type="text" name="url" value="" list="exampleUrls"/>
        <datalist id="exampleUrls">
            <option value="<?= LOCAL_JSON ?>"></option>
            <option value="<?= SEATGEEK_EXAMPLE_URL ?>"></option>
        </datalist>
        <button type="submit">Aceptar</button>
    </form>
    <?php if((strcmp($GLOBALS["SEATGEEK_AUTH"]["CLIENT_ID"],"") == 0)
        ||(strcmp($GLOBALS["SEATGEEK_AUTH"]["SECRET"],"") == 0)) : 
    ?>
    <div class="warning">
        <span>Warning:</span>
        <span>Claves Personales de seatgeek no establecidas</span> 
    </div>
    <?php endif; ?>
</main>

<?php require("footer.php"); ?>