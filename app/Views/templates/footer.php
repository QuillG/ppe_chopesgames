</main>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark" id="pied-de-page">
    <div class='container-fluid'>
        <div class="col-md-3 col-sm-6">
            <img class="navbar-brand" src="<?php echo base_url('/assets/images/logo.jpg') ?>" alt="Logo" id="logoFooter">
            <a href="<?php echo site_url('Visiteur/flux_rss') ?>">
                <img class="navbar-brand"  src="<?php echo base_url('/assets/images/rss.png') ?>" id="logoRss">
            </a>
            <BR>© Quentin Guillemand, 2023 - D. Boucard and co
        </div>
        <div class="col-md-3 col-sm-6">
            <h4>Nous contacter</h4>
            <a href='https://www.google.fr/maps/place/Lyc%C3%A9e+Rabelais/@48.5042205,-2.7503218,17z/data=!4m13!1m7!3m6!1s0x480e1d185a2011d3:0xca3c59f0bff91073!2s8+Rue+Rabelais,+22000+Saint-Brieuc!3b1!8m2!3d48.5042205!4d-2.7481331!3m4!1s0x480e1d18e9d8109d:0x739b07353bbf2d23!8m2!3d48.5042841!4d-2.7468056'><i class="bi bi-geo-alt"></i> 8 Rue Rabelais, 22000 Saint-Brieuc</a>
            <br>
            <a href='mailto:master@chopesgames.com'><i class="bi bi-envelope-at"></i> master@chopesgames.com</a>
            <br>
            <a href="#"><i class="bi bi-telephone-fill"></i> 02 96 00 00 00</a><br />
        </div>
        <div class="col-md-3 col-sm-6">
            <h4>Nous suivre</h4>
            <a href="https://www.facebook.com/ChopesGamesShop"><i class="bi bi-facebook"></i> Facebook</a><br>
            <a href="https://www.twitter.com/ChopesGamesShop"><i class="bi bi-twitter"></i> Twitter</a><br>
            <a href="https://www.Instagram.com/ChopesGamesShop"><i class="bi bi-instagram"></i> Instagram</a><br>
        </div>

        <div class="col-md-3 col-sm-6" id="newsLetter">
            <h4>NewsLetter</h4>
            <p>Abonnez vous à notre lettre d'information pour ne rater aucune nouveauté</p>
            <div>
                <form class="d-flex" role="add" method="post" action="<?php echo base_url('Visiteur/s_enregistrer_Newletter') ?>">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input class="form-control col" type="text" placeholder="Votre Email" name="txtMail" id="txtMail">
                    <input type="submit" name="submit" class="btn btn-danger btn-md ms-2" value="Envoyer">
                </form>
            </div>
        </div>

    </div>
</nav>
</div>
<script {csp-script-nonce} src="<?php echo js_url('bootstrap.min') ?>"></script>
</body>

</html>