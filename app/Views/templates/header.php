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
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url('assets/images/favicon.ico')?>">
    <link rel="alternate" type="application/rss+XML" title="ChopesGames" href="<?php echo base_url('AdministrateurSuper/flux_rss') ?>" />
    <link rel="stylesheet" href="<?php echo css_url('bootstrap.min') ?>">
</head>
<body>
    
    <nav class="navbar navbar-light bg-danger col-12">
        <div class="container-fluid justify-content-start">
            <a class="navbar-brand h5 link-dark justify-content-start" href="<?php echo base_url('Visiteur/accueil') ?>">
                <img class="d-inline-block" width=75 height=70 src="<?php echo site_url('/assets/images/game-center.png')?>"
                    alt="Logo">Chope Games
                </a>
            <a class="nav-link active h5 link-dark" href="<?php echo base_url('Visiteur/lister_les_produits') ?>">Notre catalogue</a>
            <form class="d-flex col-5" role="search" method="post" action="<?php echo base_url('Visiteur/lister_les_produits') ?>">
                        <input class="form-control me-2" type="search" placeholder="search" name="search" id='search' aria-label="Search">
                        <button class="btn btn-danger btn-outline-dark" type="submit"><img class="bi bi-search" src="<?php echo site_url('/assets/images/search.svg')?>"></button>
            <div class="container-fluid justify-content-end col">                            
                    <a href="<?php echo base_url('Visiteur/afficher_panier') ?>" class="btn btn-dark btn-md me-2">
                        <span class="fas fa-shopping-cart"><?php if ($nb > 0) echo "($nb)" ?></span>
                    </a>
                </li>

                <?php if ($session->get('statut') == 2 or $session->get('statut') == 3) : ?>
                    <div class="nav-item dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            Administration
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo site_url('AdministrateurEmploye/afficher_les_clients') ?>">Clients->Commandes</a>
                            <a class="dropdown-item" href="">(2Do) Commandes non traitées</a>
                            <?php if ($session->get('statut') == 3) { ?>
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_un_produit') ?>">Ajouter un produit</a>
                                <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/modifier_identifiants_bancaires_site') ?>">Modifier identifiants bancaires site</a>
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
                                <a class="dropdown-item" href="<?php echo site_url('Client/historique_des_commandes') ?>">Mes commandes</a>
                                <a class="dropdown-item" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">Modifier son compte</a>
                            <?php } elseif ($session->get('statut') == 3) { ?>
                                <a class="dropdown-item" href="?>">(2Do) Modifier son compte</a>
                            <?php } ?>
                            <a class="dropdown-item" href="<?php echo site_url('Client/se_de_connecter') ?>">Se déconnecter</a>
                        <?php } else { ?>
                            <a class="dropdown-item" href="<?php echo site_url('Visiteur/se_connecter') ?>">Se connecter</a>
                            <a class="dropdown-item" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">S'enregister</a>
                        <?php } ?>
                    </div>
                        </div>
                <?php if (empty($session->get('statut'))) : ?>
                    <div class="nav-item droite">
                        <a href="<?php echo site_url('Visiteur/connexion_administrateur') ?>" class="fas fa-lock"></a>
                </div>
                <?php endif; ?>
            </ul>
        </div>
             
        </div>


        
    </nav>
    <main>