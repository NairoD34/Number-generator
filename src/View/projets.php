
<?php

use vendor\jdl\App\Security;
use vendor\jdl\App\Dispatcher;

if (Security::is_connected()) {
    echo '<a href="index.php?controller=ProjetController&method=createProjet"> Ajouter un projet : </a><br><br>';
    if(empty($projets)) {
        echo "<p>Vous n'avez actuellement aucun projet</p>";
    } else {
        foreach ($projets as $value) {
            echo '<a href=' . Dispatcher::generateUrl('ProjetController', 'displayProjet', ['id_projet' => $value->getId_projet()]) . '>' . $value->getNom_projet() . '<br>' . '</a>';
        }
    }
    
}
