<div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                    <div class="container col-md-5">
                    <h4>Commande non traitées</h4> 
                    <table class="table table-hover">
                            <thead>
                                <tr>
                    
                                <th width="10%">Date de commande</th>
                                <th width="15%">Client</th>
                                <th width="15%">Total</th>
                                
                                </tr>
                            </thead>
                        <?php
                        foreach($commandesNonTraitees as $commande){?>
                        <tr onclick="window.location.href = '<?php echo site_url('AdministrateurEmploye/details_commande/'.$commande['NOCOMMANDE']) ?>'" class="hover">
                            <td><?php echo substr($commande['DATECOMMANDE'],0,10);?> </td>
                            <td><?php echo ($commande['NOM']." ".$commande['PRENOM']);?> </td>
                            <td> <?php echo $commande['TOTALTTC'].'€';?></td> </tr>
                        <?php }?></table>
                    </div>
            </div>
        </div>
    </div>
