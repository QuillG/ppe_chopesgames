<?php

namespace App\Models;

use CodeIgniter\Model;

class Modele_commande extends Model
{
    protected $table = 'commande';
    protected $allowedFields = ['NOCLIENT', 'DATECOMMANDE', 'TOTALHT', 'TOTALTTC', 'DATETRAITEMENT'];
    protected $primaryKey = 'NOCOMMANDE';

   public function retourner_commande($nocommande)
   {
    return $this->where(['NOCOMMANDE' => $nocommande])
       ->join('client', 'client.NOCLIENT = commande.noclient')
       ->first();
   }

   public function modifier_commande($nocommande,$pDonneesAInserer)
   {
      $this->where('NOCOMMANDE', $nocommande);
      $this->update('DATETRAITEMENT', $pDonneesAInserer);
      }

   public function retourner_commandes_client($noclient)
   {
    return $this->where(['commande.NOCLIENT' => $noclient])
       ->join('client', 'client.NOCLIENT = commande.noclient')
       ->findAll();
   }

   public function retourner_client_par_nocommande($nocommande){
      return $this->join('client cli' , 'cli.NOCLIENT = commande.NOCLIENT')
         ->select('cli.NOCLIENT, cli.NOM , cli.PRENOM, cli.ADRESSE , cli.VILLE, cli.CODEPOSTAL , cli.EMAIL')  
         ->where(['NOCOMMANDE' => $nocommande])
         ->find();
   }

   public function retourner_produit_nocommande($nocommande){
      return $this->join('ligne li' , 'li.NOCOMMANDE = commande.NOCOMMANDE')
         ->join('produit prod', 'prod.NOPRODUIT = li.NOPRODUIT',  'inner')
         ->select('prod.LIBELLE, prod.PRIXHT , prod.TAUXTVA, li.QUANTITECOMMANDEE , commande.TOTALTTC')  
         ->where(['commande.NOCOMMANDE' => $nocommande])
         ->findAll();
   }

   public function retourner_commande_non_traitees(){
      //select DATECOMMANDE, NOM , PRENOM , TOTALTTC
      // from commande com inner join client cli on com.NOCLIENT = cli.NOCLIENT
      //Where DATETRAITEMENT = NULL

      return $this->join('client cli' , 'cli.NOCLIENT = commande.NOCLIENT')
         ->select('commande.DATECOMMANDE, commande.TOTALTTC , commande.NOCOMMANDE, cli.NOM , cli.PRENOM')  
         ->where(['DATETRAITEMENT' => NULL])
         ->findAll();

   }
      
} 