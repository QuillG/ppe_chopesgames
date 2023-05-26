<?php
namespace App\Controllers;
use App\Models\ModeleProduit;
use App\Models\ModeleCategorie;
use App\Models\ModeleIdentifiant;
use App\Models\ModeleMarque;
use App\Models\ModeleAdministrateur;
use App\Models\ModeleNewsLetter;
use App\Models\ModeleAbonnes;

helper(['url', 'assets', 'form']);

class AdministrateurSuper extends BaseController
{

    public function ajouter_un_produit($prod = false)
    {   
        $session = session();
        if ($session->get('statut') != 3){
            return redirect()->to('visiteur/accueil');
        }
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $data['TitreDeLaPage'] = 'Ajouter un produit';

        $rules = [ //régles de validation creation
            'Categorie' => 'required',
            'Marque' => 'required',
            'txtLibelle' => 'required',
            'txtDetail'    => 'required',
            'txtPrixHT' => 'required',
            'txtQuantite' => 'required',
            'txtNomimage' => 'required',
            'image' => [
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg]',
                'max_size[image,1024]',
            ]
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                if($prod==false) {
                    $data['TitreDeLaPage'] = 'Ajouter un produit';
                }
                // else { //abandonné !
                //     $data['TitreDeLaPage'] = 'Modifier un produit';
                //     $modelProd = new ModeleProduit();
                //     $produit =  $modelProd->retourner_produits($prod);
                //     $data['Categorie'] = $produit['NOCATEGORIE'];
                //     $data['Marque'] = $produit['NOMARQUE'];
                //     $data['txtLibelle'] = $produit['LIBELLE'];
                //     $data['txtDetail'] = $produit['DETAIL'];
                //     $data['txtPrixHT'] = $produit['PRIXHT'];
                //     $data['txtNomimage'] = $produit['NOMIMAGE'];
                //     $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
                // }
                
            }
            Return view('templates/header', $data).
            view('AdministrateurSuper/ajouter_un_produit').
            view('templates/footer');
        } else // si formulaire valide
        {


            $donneesAInserer = array(
                'NOCATEGORIE' => $this->request->getPost('Categorie'),
                'NOMARQUE' => $this->request->getPost('Marque'),
                'LIBELLE' => $this->request->getPost('txtLibelle'),
                'DETAIL' => $this->request->getPost('txtDetail'),
                'PRIXHT' => $this->request->getPost('txtPrixHT'),
                'TAUXTVA' => (($this->request->getPost('txtPrixHT') * 20) / 100),
                'NOMIMAGE' => pathinfo($this->request->getPost('txtNomimage'), PATHINFO_FILENAME), // on n'insère que le nom du fichier dans la BDD
                'QUANTITEENSTOCK' => $this->request->getPost('txtQuantite'),
                'DATEAJOUT' => date("Y-m-d"),
                'DISPONIBLE' => 0,
            );

            if ($this->request->getPost('txtQuantite') > 0) $donneesAInserer['DISPONIBLE'] = 1;

            if ($img = $this->request->getFile('image')) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $this->request->getPost('txtNomimage') . '.jpg';
                    $img->move('assets/images/', $newName);
                    print_r($donneesAInserer);
                    $modelProd = new ModeleProduit();
                    $modelProd->save($donneesAInserer);
                    
                    return redirect()->to('visiteur/lister_les_produits');
                }
            }
            //else redirecte ??
        }
    }

    public function ajouter_une_categorie(){

        $session = session();
        if ($session->get('statut') != 3){
            return redirect()->to('visiteur/accueil');
        }
        helper(['form']);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelCate = new ModeleCategorie();
        $data['TitreDeLaPage'] = 'Ajouter une catégorie';
        $rules = [ //régles de validation creation
            'txtCategorie' => 'required',
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                    $data['TitreDeLaPage'] = 'Ajouter une catégorie';
            }
        Return view('templates/header', $data).
        view('AdministrateurSuper/ajouter_une_categorie').
        view('templates/footer');
    } else // si formulaire valide
    {
        $donneesAInserer = array(
            'LIBELLE' => $this->request->getPost('txtCategorie'),
        );
        $modelCate->insert($donneesAInserer);  
        return redirect()->to('visiteur/lister_les_produits');
            }
        }

        public function ajouter_une_marque(){

        $session = session();
        if ($session->get('statut') != 3){
            return redirect()->to('visiteur/accueil');
        }    
        helper(['form']);
        $modelMar = new ModeleMarque();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $data['TitreDeLaPage'] = 'Ajouter une marque';
        $rules = [ //régles de validation creation
            'txtMarque' => 'required',
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                    $data['TitreDeLaPage'] = 'Ajouter une marque';
            }
        Return view('templates/header', $data).
        view('AdministrateurSuper/ajouter_une_marque').
        view('templates/footer');
    } else // si formulaire valide
    {
        $donneesAInserer = array(
            'NOM' => $this->request->getPost('txtMarque'),
        );
        $modelMar->insert($donneesAInserer);  
        return redirect()->to('visiteur/lister_les_produits');
            }
        }

        public function ajouter_un_administrateur(){
        
            $session = session();
            if ($session->get('statut') != 3){
                return redirect()->to('visiteur/accueil');
            }     
            helper(['form']);
            $validation =  \Config\Services::validation();
            $modelAdm = new ModeleAdministrateur();
            $modelCat = new ModeleCategorie();
            $data['AdmEmp'] = $modelAdm->retourner_administrateurs_employes();
            $data['categories'] = $modelCat->retourner_categories();
            $data['TitreDeLaPage'] = 'Ajouter un administrateur';

            $rules = [ //régles de validation creation
                'Identifiant' => 'required',
                'Mdp' => 'required',
                'Email' => 'required|valid_email',
            ];
            $messages = [ //message à renvoyer en cas de non respect des règles de validation
                'Email' => [
                    'required' => 'Aucune Adresse mail renseignée',
                    'valid_email' => 'Format d\'adresse email incorrect',
                ],
                'Mdp'    => [
                    'required' => 'Mot de passe non renseigné',
                ],
                'Identifiant'    => [
                    'required' => 'Email non renseigné',
                ]

            ];
            if (isset($_POST['btnValidate'])){
                $val = $_POST['btnValidate'];
            }   
            if (!$this->validate($rules , $messages)) {
                if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre ajout'; //correction
                else {
                        $data['TitreDeLaPage'] = 'Ajouter un administrateur';
                }
            Return view('templates/header', $data).
            view('AdministrateurSuper/ajouter_un_administrateur').
            view('templates/footer');
        } else // si formulaire valide
        { 
            if ($val === 'Modifier') {
                $idEmp = $this->request->getPost('IdentifiantEmp');
                $donneesAUpdate = array(
                    'IDENTIFIANT' => $this->request->getPost('Identifiant'),
                    'EMAIL' => $this->request->getPost('Email'),
                    'MOTDEPASSE' => $this->request->getPost('Mdp'),
                );
                $modelAdm->update($idEmp, $donneesAUpdate);
            }
            else 
            {
            $donneesAInserer = array(
                    'IDENTIFIANT' => $this->request->getPost('Identifiant'),
                    'EMAIL' => $this->request->getPost('Email'),
                    'PROFIL' => 'Employé',
                    'MOTDEPASSE' => $this->request->getPost('Mdp'),
                );
            $modelAdm->insert($donneesAInserer);  
            }
            return redirect()->to('visiteur/lister_les_produits');
                }
            }

    public function modifier_supprimer_un_administrateur(){

        $session = session();
        if ($session->get('statut') != 3){
            return redirect()->to('visiteur/accueil');
        }   
        helper(['form']);
        $modelAdm = new ModeleAdministrateur();
        $modelCat = new ModeleCategorie();
        $data['AdmEmp'] = $modelAdm->retourner_administrateurs_employes();
        $data['categories'] = $modelCat->retourner_categories();
        $data['TitreDeLaPage'] = 'Ajouter un administrateur';
        if (isset($_POST['btnModif'])){
            $Employe = $modelAdm->retourner_administrateur_par_id( $this->request->getPost('idEmp'));
            $data['txtIdentifiant'] = $Employe['IDENTIFIANT'];
            $data['txtEmail'] = $Employe['EMAIL'];
            $data['TitreDeLaPage'] = 'Modifier un administrateur';
            $data['txtBtn'] = 'Modifier';

        
        }
        if (isset($_POST['btnSup'])) {
            $modelAdm->delete($this->request->getPost('idEmp'));
            $data['AdmEmp'] = $modelAdm->retourner_administrateurs_employes();
        }
        Return view('templates/header', $data).
        view('AdministrateurSuper/ajouter_un_administrateur').
        view('templates/footer');
        
    }

    public function rendre_indisponible($noProduit = null)
    {
        $session = session();
        if ($session->get('statut') != 3){
            return redirect()->to('visiteur/accueil');
        }   
        if ($noProduit == null) {
            return redirect()->to('visiteur/lister_les_produits');
        }

        $donneesAInserer = array(
            'DISPONIBLE' => 0
        );
        $modelProd = new ModeleProduit();
        $modelProd->update($noProduit, $donneesAInserer);
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function rendre_disponible($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/lister_les_produits');
        }
        $donneesAInserer = array(
            'DISPONIBLE' => 1
        );
        $modelProd = new ModeleProduit();
        $modelProd->update($noProduit, $donneesAInserer);
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function modifier_produit($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/lister_les_produits');
        }
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $modelProd = new ModeleProduit();
        $data['TitreDeLaPage'] = 'Modifier un produit';

        $rules = [ //régles de validation creation
            'Categorie' => 'required',
            'Marque' => 'required',
            'txtLibelle' => 'required',
            'txtDetail'    => 'required',
            'txtPrixHT' => 'required',
            'txtQuantite' => 'required',
            'txtNomimage' => 'required',
            'vitrine' => '',
        ];

        if (!$this->validate($rules)) {
            if($_POST)$data['TitreDeLaPage'] = 'Corriger votre formulaire';
            $produit =  $modelProd->retourner_produits($noProduit);
            $data['noProduit'] = $produit['NOPRODUIT'];
            $data['Categorie'] = $produit['NOCATEGORIE'];
            $data['Marque'] = $produit['NOMARQUE'];
            $data['txtLibelle'] = $produit['LIBELLE'];
            $data['txtDetail'] = $produit['DETAIL'];
            $data['txtPrixHT'] = $produit['PRIXHT'];
            $data['txtNomimage'] = $produit['NOMIMAGE'];
            $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
            $data['vitrine'] = $produit['VITRINE'];
            
            Return view('templates/header', $data).
            view('AdministrateurSuper/modifier_produit').
            view('templates/footer');
        } else {

            $donneesAInserer = array(
                'NOCATEGORIE' => $this->request->getPost('Categorie'),
                'NOMARQUE ' => $this->request->getPost('Marque'),
                'LIBELLE' => $this->request->getPost('txtLibelle'),
                'DETAIL' => $this->request->getPost('txtDetail'),
                'PRIXHT' => $this->request->getPost('txtPrixHT'),
                'TAUXTVA' => (($this->request->getPost('txtPrixHT') * 20) / 100),
                'DATEAJOUT' => date("Y-m-d"),
                'NOMIMAGE' => $this->request->getPost('txtNomimage'),
                'QUANTITEENSTOCK' => $this->request->getPost('txtQuantite'),
                'VITRINE' => 0
            );

            if ($this->request->getPost('checkbox') == 1) {$donneesAInserer['VITRINE']=1;} 
            
            $modelProd->update($noProduit, $donneesAInserer);

            return redirect()->to('visiteur/lister_les_produits');
        }
    }

    function modifier_identifiants_bancaires_site()
    {
        $session = session();
        if ($session->get('statut') != 3){
            return redirect()->to('visiteur/accueil');
        }   
        $modelIdent = new ModeleIdentifiant();
        $data['identifiant'] = $modelIdent->retourner_identifiant();

        $rules = [ //régles de validation creation
            'txtSite' => 'required',
            'txtRang' => 'required',
            'txtIdentifiant' => 'required',
            'txtHmac'    => 'required',
        ];


        if (!$this->validate($rules)) {
            $modelCat = new ModeleCategorie();
            $data['categories'] = $modelCat->retourner_categories();
            Return view('templates/header', $data).
            view('AdministrateurSuper/modifier_identifiants_bancaires_site').
            view('templates/footer');
        } else {

            $donneesAInserer = array(
                'SITE' => $this->request->getPost('txtSite'),
                'RANG' => $this->request->getPost('txtRang'),
                'IDENTIFIANT' => $this->request->getPost('txtIdentifiant'),
                'CLEHMAC' => $this->request->getPost('txtHmac'),
                'SITEENPRODUCTION' => 0
            );

            if ($this->request->getPost('checkbox') == 1) {
                $donneesAInserer['SITEENPRODUCTION'] = 1;
            }

            $modelIdent->update(1, $donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
        }
    }

    

    public function envoyer_newsletter(){
        $session = session();
        if ($session->get('statut') != 3){
            return redirect()->to('visiteur/accueil');
        }   
        helper(['form']);
        $email = \Config\Services::email();
        $modelCat = new ModeleCategorie();
        $modelNews = new ModeleNewsLetter();
        $data['categories'] = $modelCat->retourner_categories();
        $data['TitreDeLaPage'] = 'Nouvelle NewsLetter';
        $rules = [ //régles de validation creation
            'txtObjet' => 'required',
            'txtTitre' => 'required',
            'txtMessage' => 'required',
        ];

        if (!$this->validate($rules)) {
            if($_POST)$data['TitreDeLaPage'] = 'Corriger votre formulaire';
        Return view('templates/header', $data).
        view('AdministrateurSuper/envoyer_newsletter').
        view('templates/footer');      
    }
    else {
        $donneesAInserer = array(
            'OBJET' => $this->request->getPost('txtObjet'),
            'TITRE' => $this->request->getPost('txtTitre'),
            'MESSAGE' => $this->request->getPost('txtMessage'),
        );   
        $modelNews->insert($donneesAInserer);
        $modelAbo = new ModeleAbonnes();
        $abonnes = $modelAbo->findAll();
        foreach($abonnes as $abo){
            $email->setFrom('ChopeGames@gmail.com', 'ChopeGames');
            $email->setTo($abo['MAIL']);
            $email->setSubject('NewsLetter');
            $email->setMessage('Merci de ton inscription à la NewsLetter');
            $email->send();
            
        }
        return redirect()->to('visiteur/lister_les_produits');
    }

    }
}

