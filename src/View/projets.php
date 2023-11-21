
<?php

use vendor\jdl\App\Security;
use vendor\jdl\Form\UtilisateurForm;


if (Security::is_connected()) {
    echo '<a href="index.php?controller=ProjetController&method=createProjet"> Ajouter un projet : </a><br>';
    // ajouter le foreach ici 
    var_dump($_SESSION);
    foreach ($projets as $value) {
        // echo '<ul><li><a href="index.php?controller=ProjetController&method=displayProjets&id='
        // .$value->getId_projet(). '">'
        // .$value->getNom_projet()."</a></li></ul>";

        if ($_SESSION['id'] == $value->getId_projet()) {
            // ajouter un if avec la table participe
            echo $value->getNom_projet() . PHP_EOL;
        }
    }
}

//else {
// Dispatcher::redirect();
//echo 'toto'; // faire un redirect vers l'index
//}

// ajouter pour voir ses projets lié a son propres id si on est admin
// afficher les projet lié a l'id utilisateur connecté 

// foreach ($projets as $value){
//     echo '<ul><li><a href="index.php?controller=ProjetController&method=displayProjets&id='
//     .$value->getId_projet(). '">'
//     .$value->getNom_projet()."</a></li></ul>";


foreach ($projets as $value) {
    echo '<ul><li><a href="index.php?controller=ProjetController&method=displayProjet&id='
        . $value->getId_projet() . '">'
        . $value->getNom_projet() . "</a></li></ul>";
}
