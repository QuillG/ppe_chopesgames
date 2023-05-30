<?php
namespace App\Controllers;

use App\Models\ModeleClient;
use App\Models\ModeleCategorie;
use App\Models\Modele_commande;
use App\Models\ModeleLigne;

helper(['url', 'assets']);

class AdministrateurEmploye extends BaseController
{
    public function afficher_les_clients()
    {
        $session = session();
        if ($session->get('statut') < 2){
            return redirect()->to('visiteur/accueil');
        }   
        $modelCli = new ModeleClient();
        $data['clients'] = $modelCli->retourner_clients();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        Return view('templates/header', $data).
        view('AdministrateurEmploye/afficher_les_clients').
        view('templates/footer');
    }

    public function historique_des_commandes($noclient = null)
    {
        $session = session();
        if ($session->get('statut') < 2){
            return redirect()->to('visiteur/accueil');
        }   
        $modelCli = new ModeleClient();
        $data['client'] = $modelCli->retourner_client_par_no($noclient);
        $modelComm = new Modele_commande();
        $data['commandes'] = $modelComm->retourner_commandes_client($noclient);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        Return view('templates/header', $data).
        view('AdministrateurEmploye/historique_des_commandes').
        view('templates/footer');
    }

    public function details_commande($noCommande = false)
    {
        $session = session();
        if ($session->get('statut') < 2){
            return redirect()->to('visiteur/accueil');
        }   
        if (empty($noCommande)) {
            return redirect()->to('AdministrateurEmploye/historique_des_commandes');
        }
        $modelComm = new Modele_commande();
        $data['commande'] = $modelComm->retourner_commande($noCommande);
        $modelLig = new ModeleLigne();
        $data['lignes'] = $modelLig->retourner_lignes($noCommande);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        Return view('templates/header', $data).
        view('AdministrateurEmploye/details_commande').
        view('templates/footer');
    }

    public function afficher_les_commandes_non_traitees()
    {
        $session = session();
        if ($session->get('statut') < 2){
            return redirect()->to('visiteur/accueil');
        }   
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelCom = new Modele_commande();
        $data['commandesNonTraitees'] = $modelCom->retourner_commande_non_traitees();
        Return view('templates/header', $data).
        view('AdministrateurEmploye/commande_non_traite').
        view('templates/footer');
    }

    public function traiter_la_commande(){

            $session = session();
            if ($session->get('statut') < 2){
                return redirect()->to('visiteur/accueil');
            }   
            $email = \Config\Services::email();
            $noCommande = intval($this->request->getPost('noCommande'));
            $modelCom = new Modele_commande();
            $client = $modelCom->retourner_client_par_nocommande($noCommande);
            $commande = $modelCom->retourner_commande($noCommande);
            $produits = $modelCom->retourner_produit_nocommande($noCommande);
            print_r($produits); exit();
            $donneesAUpdate = array(
                'DATETRAITEMENT' => date('y/m/d'),
            );
            $modelCom->update($noCommande, $donneesAUpdate);

            $email->setFrom('ChopeGames@gmail.com', 'ChopeGames');
            $email->setTo($client['MAIL']);
            $email->setSubject('Facture');
            $email->setMessage('Commande expediée !');
            $email->send();   
            return redirect()->to('Visiteur/accueil');
        }

        

    }

