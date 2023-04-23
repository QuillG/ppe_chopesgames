

<h2 class='titrepage'>Accueil</h2><hr/> 
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-10">
    <div class="container d-inline-flex justify-content-center mt-5">
  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-inner">
    <?php $count = 0; 
              $indicators = ''; 
              foreach ($vitrines as $vitrine): 
              $count++; 
              if ($count === 1) 
              { 
                  $class = 'active'; 
              } 
              else 
              { 
                  $class = ''; 
              }?> 
      <div class="carousel-item <?php echo $class; ?>">
            <a href="<?= site_url('visiteur/voir_un_produit/').$vitrine["NOPRODUIT"]?>">
            <?= img_class($vitrine["NOMIMAGE"] . '.jpg', $vitrine["LIBELLE"], 'd-block img-fluid'); ?>
            </a>
          </div>
          <?php endforeach;?> 
      </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
</div>
<div class="col-sm-2 marque mb-5">
<h3>Marque:</h3>
<?php foreach ($marques as $marque){ echo '<h4>'.anchor('visiteur/lister_les_produits_parmarque/'.$marque["NOMARQUE"],$marque["NOM"]). '</h4>'; ?><?php } ?>
<hr/> 
</div>
</div>

</div>



