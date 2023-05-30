<div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col">
    
        <div class="row align-items-center mt-5">
        <h2>Commande n°<?php echo $commande['NOCOMMANDE']; ?></h2>
            <table class="table">

                <tr>
                        <th></th>
                        <th width="30%">Produit</th>
                        <th width="15%">Prix HT</th>
                        <th width="15%">TVA</th>
                        <th width="13%">Quantité</th>
                        <th width="25%">Total produit</th>
                </tr>
                <?php if(!empty($lignes)){foreach ($lignes as $produit):?>
        <tr>
        <td>
                <?php if(!empty($produit['NOMIMAGE'])){ ?>
                <a href="<?= base_url().'index.php/Visiteur/voir_un_produit/'.$produit['NOPRODUIT']?>"><img src="<?= base_url().'/assets/images/'.$produit['NOMIMAGE'].'.jpg'?>" width="80"/></a>
                <?php } else{?>
                    <a href="<?= base_url().'index.php/Visiteur/voir_un_produit/'.$produit['NOPRODUIT']?>"><img src="<?= base_url().'/assets/images/nonimage.jpg'?>" width="80"/></a>
                <?php } ?>
            </td>
                <td><a  href="<?= base_url().'index.php/Visiteur/voir_un_produit/'.$produit['NOPRODUIT']?>"><?php echo $produit['LIBELLE']; ?></a></td>
                <td><?php echo $produit['PRIXHT']; ?>€</td>
                <td><?php echo $produit['TAUXTVA']; ?></td>
                <td><?php echo $produit['QUANTITECOMMANDEE']; ?></td>
                <td><?php echo (($produit['PRIXHT'] + $produit['TAUXTVA']) *$produit['QUANTITECOMMANDEE']) ; ?>€</td>
                 </tr>

<?php endforeach; } ?>
<tr>
<td colspan='6' class='text-right'><h4>Total: <?php echo $commande['TOTALTTC']; ?>€</h4></td></tr>
                </table>
            </div>
            </div>
                <span style="display:inline-block; width: 40px;"></span>
                <div class="col-md-3 mt-5 me-4">
                    <div class="border border-secondary">
                    <h3 class="text-center top">Informations client</h3>
                    <table class="table">
                    <tr>
                        <th>Nom:</th>
                        <td><?php echo $commande['NOM'];?></td>
                    </tr>
                    <tr>
                        <th>Prénom:</th>
                        <td><?php echo $commande['PRENOM'];?></td>
                    </tr>
                    <tr>
                        <th>Adresse:</th>
                        <td><?php echo $commande['ADRESSE'];?></td>
                    </tr>
                    <tr>
                        <th>Ville:</th>
                        <td><?php echo $commande['VILLE'];?></td>
                    </tr>
                    <tr>
                        <th>Code Postal:</th>
                        <td><?php echo $commande['CODEPOSTAL'];?></td>
                    </tr>
                    </table>
             </div>
             <?php if ($commande['DATETRAITEMENT'] == NULL && session('statut') > 1) :?>
                <form class="d-flex justify-content-center" role="add" method="post" action="<?php echo base_url('AdministrateurEmploye/traiter_la_commande') ?>">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="noCommande" id="noCommande" value="<?php echo $commande['NOCOMMANDE']; ?>">
                    <input type="submit" name="submit" class="btn btn-danger btn-md mt-3" value="Passer la commande à 'Traitée'">
                </form>
                    <?php endif;?>
    <div class="col-sm-1">
    </div>
           
        
        
    </div>
</div>
