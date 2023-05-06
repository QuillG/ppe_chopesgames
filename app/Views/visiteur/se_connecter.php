<div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="col-md-12 container">
                        <?php  echo form_open('Visiteur/se_connecter') ?>
                        <br>
                            <h3 class="text-center text-primary m-4"><?php echo $TitreDeLaPage ?></h3>
                            <?PHP if($TitreDeLaPage=='Corriger votre formulaire') {
                                echo service('validation')->getError("txtEmail"); 
                                if(service('validation')->getError("txtEmail")=='') {
                                    echo service('validation')->getError("txtMdp");
                                }
                            }
                            ?>
                            <div>
                                <?php echo form_input('txtEmail', set_value('txtEmail'),['placeholder' => 'Email', 'class'=>'form-control'], 'email');?> <br/>
                            </div>
                            <div>
                                <?php 
                                echo form_input('txtMdp', set_value('txtMdp'),['placeholder' => 'Mot de passe', 'class'=>'form-control', 'id'=>'mdp'], 'password');
                                echo form_checkbox('password', 'accept', false, ['class'=>'mt-3'], 'onclick = Affichermasquermdp()');?>Afficher mot de passe
                            </div>
                            <div class="d-flex flex-nowrap justify-content-between mt-3">
                            <?php echo form_submit('submit', 'Valider',['class'=>'btn btn-danger','id'=>'connect'], 'submit'); ?>
                            <a class="btn btn-outline-danger" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">Crée un compte</a>
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