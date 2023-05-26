<?php

namespace App\Models;

use CodeIgniter\Model;

class Modele_commande extends Model
{
    protected $table = 'commande com';
    protected $allowedFields = ['NOCLIENT', 'DATECOMMANDE', 'TOTALHT', 'TOTALTTC', 'DATETRAITEMENT'];
    protected $primaryKey = 'NOCOMMANDE';

   public function retourner_commande($nocommande)
   {
    return $this->where(['NOCOMMANDE' => $nocommande])
       ->join('client', 'client.NOCLIENT = commande.noclient')
       ->first();
   }

//    public function modifier_commande($nocommande,$pDonneesAInserer)
//    {
//     $this->db->where('NOCOMMANDE', $nocommande);
//     $this->db->update('commande', $pDonneesAInserer);
//    }

   public function retourner_commandes_client($noclient)
   {
    return $this->where(['commande.NOCLIENT' => $noclient])
       ->join('client', 'client.NOCLIENT = commande.noclient')
       ->findAll();
   }

   public function retourner_commande_non_traitees(){
      //select DATECOMMANDE, NOM , PRENOM , TOTALTTC
      // from commande com inner join client cli on com.NOCLIENT = cli.NOCLIENT
      //Where DATETRAITEMENT = NULL

      return $this->select('com.DATECOMMANDE', 'com.TOTALTTC','cli.NOM','cli.PRENOM' ,)
         ->join('client cli' , 'cli.NOCLIENT = com.NOCLIENT')
         ->where(['DATETRAITEMENT' => NULL])
         ->findAll();

   }
      
} 