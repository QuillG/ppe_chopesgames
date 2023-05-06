<!DOCTYPE html>
<html>
<?php $session = session();
if ($session->has('cart')) {
    $cart = session('cart');
    $nb = count($cart);
} else $nb = 0; ?>

<head>
    <title>ChopesGames</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url('/assets/images/game-center.png')?>">
    <link rel="alternate" type="application/rss+XML" title="ChopesGames" href="<?php echo base_url('AdministrateurSuper/flux_rss') ?>" />
    <link rel="stylesheet" href="<?php echo css_url('bootstrap.min') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo site_url('/assets/css/style.css'); ?>">
    
    <head>
    <title>Ma page</title>
    
</head>

</head>
<body>
    <nav class="navbar navbar-light bg-danger col-12" id="nav">
        <div class="justify-content-start d-flex flex-nowrap align-items-center col">
            <a class="navbar-brand h5 link-dark justify-content-start pt-2" href="<?php echo base_url('Visiteur/accueil') ?>">
                <img class="d-inline-block" width=75 height=70 src="<?php echo site_url('/assets/images/game-center.png')?>"
                    alt="Logo">Chope Games
                </a>
            <a class="nav-link active h5 link-dark" href="<?php echo base_url('Visiteur/lister_les_produits') ?>">Notre catalogue</a>
            <div class="dropdown">
                <button type="button" class="btn btn-danger btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown">
                            Catégories
                </button>
                <ul class="dropdown-menu dropCategorie">
                    <?php foreach ($categories as $categorie) {
                        $class = 'dropdown-item';
                        $no = $categorie["NOCATEGORIE"];
                        $li = $categorie["LIBELLE"];
                        echo "<li><a class='$class' href='". base_url("Visiteur/lister_les_produits_par_categorie/$no") . "'>$li</a></li>"; ?><?php } ?>
                    </div>

        </div>
        <div class="container-fluid d-inline-flex justify-content-center col">
            <form class="d-flex col-5" role="search" method="post" action="<?php echo base_url('Visiteur/lister_les_produits') ?>">
                        <input class="form-control me-2" type="search" placeholder="search" name="search" id='search' aria-label="Search" />
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <button class="btn btn-danger btn-outline-dark"><svg width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg></button>
            </form>
        </div>
        <div class="container-fluid justify-content-end col me-4">      
                    <a href="<?php echo base_url('Visiteur/afficher_panier') ?>" class="btn btn-danger btn-outline-dark btn-md me-2">
                        <span><i class="bi bi-cart"></i><?php if ($nb > 0) echo "($nb)" ?></span>
                    </a>
                </li>
                <?php if ($session->get('statut') == 2 or $session->get('statut') == 3) : ?>
                    <div class="nav-item dropdown">
                        <button type="button" class="btn btn-danger btn-outline-dark dropdown-toggle me-2" data-bs-toggle="dropdown">
                            Administration
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url('AdministrateurEmploye/afficher_les_clients') ?>">Clients->Commandes</a>
                            <a class="dropdown-item" href="">(2Do) Commandes non traitées</a>
                            <?php if ($session->get('statut') == 3) { ?>
                                <a class="dropdown-item" href="<?php echo base_url('AdministrateurSuper/ajouter_un_produit') ?>">Ajouter un produit</a>
                                <a class="dropdown-item" href="<?php echo base_url('AdministrateurSuper/modifier_identifiants_bancaires_site') ?>">Modifier identifiants bancaires site</a>
                            <?php } ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="nav-item dropdown">
                    <button type="button" class="btn btn-danger btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown">
                        Mon compte
                    </button>
                    <div class="dropdown-menu">
                        <?php if (!is_null($session->get('statut'))) { ?>
                            <?php if ($session->get('statut') == 1) { ?>
                                <a class="dropdown-item" href="<?php echo base_url('Client/historique_des_commandes') ?>">Mes commandes</a>
                                <a class="dropdown-item" href="<?php echo base_url('Visiteur/s_enregistrer') ?>">Modifier son compte</a>
                            <?php } elseif ($session->get('statut') == 3) { ?>
                                <a class="dropdown-item" href="?>">(2Do) Modifier son compte</a>
                            <?php } ?>
                            <a class="dropdown-item" href="<?php echo base_url('Client/se_de_connecter') ?>">Se déconnecter</a>
                        <?php } else { ?>
                            <a class="dropdown-item" href="<?php echo base_url('Visiteur/se_connecter') ?>">Se connecter</a>
                            <a class="dropdown-item" href="<?php echo base_url('Visiteur/s_enregistrer') ?>">S'enregister</a>
                        <?php } ?>
                    </div>
                        </div>
                <?php if (empty($session->get('statut'))) : ?>
                    <div class="nav-item droite">
                        <a href="<?php echo base_url('Visiteur/connexion_administrateur') ?>"><i class="bi bi-lock nav-link active h2 link-dark"></i></a>
                </div>
                <?php endif; ?>
            </ul>
        </div>         
    </nav>
    <div id="conteneur-page">
        <main id="enveloppe-contenu">