<?php $session = session(); ?>
<h2 class='titrepage'><?php echo $TitreDeLaPage ?></h2>
<hr />

<div class="container-fluid">
    <div class="row">
    <div class="col-2 voletGauche">
      <div class="text-center">
        <h3 class="mb-3 h2 ">Categories:</h3>
        <?php foreach ($categories as $categorie) {
          echo '<h4>' . anchor('visiteur/lister_les_produits_par_categorie/' . $categorie["NOCATEGORIE"], $categorie["LIBELLE"]) . '</h4>'; ?><?php } ?>
      </div>
    </div>
        <div class="col-sm-10">
            <div class="container">
                <div class="row">
                    <?php if ($lesProduits == null) {
                        echo '<h3>Aucun produit correspondant à cette recherche</h3>';
                    } ?>
                    <?php $count = 0;
                    foreach ($lesProduits as $unProduit) {
                        $count++; ?>


                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="<?php echo base_url('Visiteur/voir_un_produit/' . $unProduit["NOPRODUIT"]) ?>">
                                        <?php
                                        if (!empty($unProduit["NOMIMAGE"])) echo img_class($unProduit["NOMIMAGE"] . '.jpg', $unProduit["LIBELLE"], 'img-responsive image');
                                        else echo img_class('nonimage.jpg', $unProduit["LIBELLE"], 'img-responsive image');
                                        ?>
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h4 class="title mb-3"><a class="link-dark" href="<?php echo base_url('Visiteur/voir_un_produit/' . $unProduit["NOPRODUIT"]) ?>"><?php echo $unProduit["LIBELLE"] ?></a>
                                        <?php if ($session->get('statut') == 3) { ?>
                                            <a href="<?php echo site_url('AdministrateurSuper/Vitrine/' . $unProduit["NOPRODUIT"]);  ?>"><?php if ($unProduit['VITRINE'] == 1) : ?><i class="bi bi-star"></i><?php else : ?><i class="bi bi-star-fill"></i></a><?php endif ?>
                                    <?php } ?>
                                    </h4>
                                    <div class="price mb-3">
                                        <?php echo number_format((($unProduit["PRIXHT"]) + ($unProduit["TAUXTVA"])), 2, ",", ' '), '€' ?>
                                    </div>
                                    <?php if ($session->get('statut') == 3) {
                                        if ($unProduit["DISPONIBLE"] == 0) {
                                    ?>
                                            <a class="disponible" href="<?php echo site_url('AdministrateurSuper/rendre_disponible/' . $unProduit["NOPRODUIT"]);  ?>">Rendre disponible</a>
                                        <?php } else { ?>

                                            <a class="indisponible" href="<?php echo site_url('AdministrateurSuper/rendre_indisponible/' . $unProduit["NOPRODUIT"]);  ?>">Rendre indisponible</a>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php if ($unProduit["DISPONIBLE"] == 0) : ?><div class="text-danger">Rupture de stock</div>
                                            <?php else : ?><div class="text-success">En stock</div><br />
                                                <div class='btn btn-outline-danger container'><a class="add-to-cart link-dark<?php if ($unProduit["DISPONIBLE"] == 0) {
                                                                                                                                            echo 'd-none';
                                                                                                                                            } ?>" href="<?php echo site_url('Visiteur/ajouter_au_panier/' . $unProduit["NOPRODUIT"]);  ?>">Ajouter au panier</a>
                                            <?php endif; ?>
                                        </div> <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php if ($count % 4 == 0) {
                            echo '</div><br/><hr/><br/><div class="row">';
                        }
                    } ?>
                </div>

            </div>
            <a class="btn"><?php echo $pager->links()?></a>
        </div>
    </div>
</div>