
<?php

use vendor\jdl\App\Dispatcher;
use vendor\jdl\Form\UtilisateurForm;


if (Dispatcher::is_connected()) {
    echo '<a href="index.php?controller=ProjetController&method=createProjet"> Ajouter un projet : </a><br>';
    // ajouter le foreach ici 
    // var_dump($_SESSION);
    foreach ($projets as $value){

    
        if ($_SESSION['id'] == $value->getId_utilisateur())
        {
            // ajouter un if avec la table participe 

            echo '<a href='.Dispatcher::generateUrl('ProjetController', 'displayProjet') . '&id=' . $value->getId_projet() .'>' . $value->getNom_projet() . '</a>';
        }
    }
}