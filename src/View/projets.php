
<?php

use vendor\jdl\App\Security;
use vendor\jdl\App\Dispatcher;


// var_dump($_SESSION);
if (Security::is_connected()) {
    echo '<a href="index.php?controller=ProjetController&method=createProjet"> Ajouter un projet : </a><br><br>';
    // ajouter le foreach ici 
    // var_dump($_SESSION);
    foreach ($projets as $value) {


        if ($_SESSION['id'] == $value->getId_utilisateur()) {
            // ajouter un if avec la table participe 

            echo '<a href=' . Dispatcher::generateUrl('ProjetController', 'displayProjet', ['id' => $value->getId_projet()]) . '>' . $value->getNom_projet() . '<br>' . '</a>';
        }
    }
}
