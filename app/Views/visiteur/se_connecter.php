<div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="col-md-12 container">
                        <?php  echo form_open('Visiteur/se_connecter') ?>
                        <br>
                            <h3 class="text-center text-primary"><?php echo $TitreDeLaPage ?></h3>                         
                            <div>
                                <?php echo csrf_field();
                                      echo form_label('Email','txtEmail',['class'=>'text-primary']);
                                      echo form_input('txtEmail', set_value('txtEmail'),['placeholder' => 'Votre Email', 'class'=>'form-control'], 'email');
                                      echo csrf_field();?>
                            </div>
                            <div>
                            <?php
                                      echo form_label('Mot de passe','txtMdp',['class'=>'text-primary']);
                                      echo form_input('txtMdp', set_value('txtMdp'),['placeholder' => 'Votre Mot de passe', 'class'=>'form-control', 'id'=>'mdp'], 'password');
                                      echo form_checkbox('password','accept',false,'onclick = Affichermasquermdp()')?>Afficher le mot de passe
                            </div>
                            <?php
                            echo form_input('submit', 'Valider',['class'=>'btn btn-primary btn-md'], 'submit');?>  
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