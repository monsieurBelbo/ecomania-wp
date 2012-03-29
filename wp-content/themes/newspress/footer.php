<div id="footer" class="clearfix">

    <div id="footer-quienes-somos" class="footer-column">
        <h2><a href="<?php echo get_site_url()?>/acerca-de/" class="no-decoration">¿Quiénes somos?</a></h2>
        <p>Somos una Asociación Civil Sin Fines de Lucro surgida en 2008 cuya misión es promover un cambio de la comunidad en su relación con el medioambiente a partir de la difusión de los valores: desarrollo sostenible, consumo responsable y responsabilidad conjunta.</p>
        <div class="color-line"></div>
    </div>

    <div id="footer-colaborators" class="footer-column">
        <h2><a href="<?php echo get_site_url()?>/staff/" class="no-decoration">¿Querés ser voluntario?</a></h2>
        <p>Te invitamos a sumarte a nuestra ONG escribiéndonos a <a href="mailto:voluntarios@ecomania.org.ar">voluntarios@ecomania.org.ar</a></p>
        <div class="color-line"></div>
    </div>

    <div id="footer-contact" class="footer-column">
        <h2>Contacto</h2>
        <p>
            Intendente Becco 1556<br/>
            Beccar, (B1643BZF)<br/>
            Provincia de Buenos Aires<br/>
            +5411 6009 0851<br/>
            <a href="mailto:info@ecomania.org.ar">info@ecomania.org.ar</a><br/>
        </p>
        <div class="color-line"></div>
    </div>

    <div id="friends" class="clearfix">
        <h2>Amigos</h2>
        <p>Creemos en la RESPONSABILIDAD CONJUNTA. Por eso construimos Ecomanía junto a los siguientes amigos:</p>

        <div class="row1">
            <div class="friend-link greendrinksba" href="http://greendrinksba.org/"></div>
            <div class="friend-link sustentator" href="http://sustentator.com/"></div>
            <div class="friend-link directorio-verde" href="http://directorio-verde.com/"></div>
            <div class="friend-link grecaweb" href="http://www.grecaweb.com/"></div>
            <div class="friend-link britishcouncil" href="http://www.britishcouncil.org/es/argentina.htm"></div>
            <div class="friend-link sabelatierra" href="http://www.sabelatierra.com/"></div>
            <div class="friend-link revistaplot" href="http://www.revistaplot.com/"></div>
            <div class="friend-link dqbstudio" href="http://www.dqbstudio.com/"></div>
            <div class="friend-link greenfilmfest" href="http://www.greenfilmfest.com.ar/"></div>
            <div class="friend-link dondereciclo" href="http://www.dondereciclo.org.ar/"></div>
        </div>

        <div class="row2">
            <div class="friend-link lavidaenbici" href="http://lavidaenbici.com/"></div>
            <div class="friend-link inicia" href="http://www.inicia.org.ar/"></div>
            <div class="friend-link vidasilvestre" href="http://www.vidasilvestre.org.ar/"></div>
            <div class="friend-link monoblock" href="http://monoblock.tv/"></div>
            <div class="friend-link tuverde" href="http://www.tuverde.com/"></div>
        </div>
        
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    $(function() {
        $(".friend-link").hover(function() {
            $(this).addClass("hover");
        }, function() {
            $(this).removeClass("hover");
        });

        $(".friend-link").click(function() {
            var href = $(this).attr("href");
            window.open(href);
        })
    });
</script>