<h2 class='titrepage mt-2 h1'>Accueil</h2>
<hr />
  <div class="col-12 d-flex">
    <div class="col-2 voletGauche">
      <div class="text-center">
        <h3 class="mb-3 h2 ">Marque:</h3>
        <?php foreach ($marques as $marque) {
          echo '<h4>' . anchor('visiteur/lister_les_produits_parmarque/' . $marque["NOMARQUE"], $marque["NOM"]) . '</h4>'; ?><?php } ?>
      </div>
    </div>
    <div class="carou justify-content-center">
      <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
        <div class="carousel-inner">
          <?php $count = 0;
          $indicators = '';
          foreach ($vitrines as $vitrine) :
            $count++;
            if ($count === 1) {
              $class = 'active';
            } else {
              $class = '';
            } ?>
            <div class="carousel-item <?php echo $class; ?>">
              <a class="imgCarousel" href="<?= site_url('visiteur/voir_un_produit/') . $vitrine["NOPRODUIT"] ?>">
                <?= img_class($vitrine["NOMIMAGE"] . '.jpg', $vitrine["LIBELLE"], 'd-block'); ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>