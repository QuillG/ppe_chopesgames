    <?php $session = session();?>
    <div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="col-md-12 container">
                        <?php echo form_open('Visiteur/s_enregistrer') ?>
                            <br>
                            <h3 class="text-center text-primary"><?php echo $TitreDeLaPage ?></h3>
                            <?PHP if($TitreDeLaPage=='Corriger votre formulaire') echo service('validation')->listErrors();
                             if(!isset($txtNom)) $txtNom=''; if(!isset($txtPrenom)) $txtPrenom=''; if(!isset($txtAdresse)) $txtAdresse=''; if(!isset($txtVille)) $txtVille=''; if(!isset($txtCP)) $txtCP=''; if(!isset($txtEmail)) $txtEmail=''; ?>
                                <?php 
                                      echo form_input('txtNom', set_value('txtNom', $txtNom),['placeholder' => 'Nom', 'class'=>'form-control']);
                                      echo '<br>';
                                      echo form_input('txtPrenom', set_value('txtPrenom', $txtPrenom),['placeholder' => 'Prénom', 'class'=>'form-control']);
                                      echo '<br>';
                                      echo form_input('txtAdresse', set_value('txtAdresse', $txtAdresse),['placeholder' => 'Adresse', 'class'=>'form-control']);
                                      echo '<br>';
                                      echo form_input('txtVille', set_value('txtVille', $txtVille),['placeholder' => 'Ville', 'class'=>'form-control']);
                                      echo '<br>';
                                      echo form_input('txtCP', set_value('txtCP', $txtCP),['placeholder' => 'Code postal', 'class'=>'form-control']);
                                      echo '<br>';
                                      echo form_input('txtEmail', set_value('txtEmail', $txtEmail),['placeholder' => 'Email', 'class'=>'form-control'],'email');
                                      echo '<br>';
                                      echo form_input('txtMdp', set_value('txtMdp'),['placeholder' => 'Mot de passe', 'class'=>'form-control','id'=>'mdp'],'password');
                                      echo '<br>';
                                      echo form_input('confirmMdp', set_value('confirmMdp'),['placeholder' => 'Confirmez mot de passe', 'class'=>'form-control'],'password');
                                      echo '<br>';?>
                            <div class="d-flex flex-nowrap justify-content-between">
                            <input type="submit" name="submit" class="btn btn-danger btn-md" value="Valider">
                            <div class="text-primary right">
                            <?php if($txtNom == '') { ?>   
                                <a class="btn btn-outline-danger" href="<?php echo site_url('Visiteur/se_connecter') ?>">Se connecter</a>
                            <?php }
                            else { ?> 
                                <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Exercer mon droit à l'oubli</a>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Exercer mon droit à l'oubli ?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-dark">
                                            Le droit a l'oubli permet a l'ultilisateur d'effacer toutes ces informations de notre site, cette action entrainera une suppresion de votre profils utilisateur, vous serez donc deconnecter définitivement et rediriger vers l'accueil.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fermer</button>
                                            <button type="button" href="<?php echo site_url('Visiteur/RGPD') ?>" class="btn btn-danger">Sauvegarder</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                            <?php }?>
                            </div>                                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language=javascript>
     function Affichermasquermdp() {
  var x = document.getElementById("mdp");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
} 
      </script> 