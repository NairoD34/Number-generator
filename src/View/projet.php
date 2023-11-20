<?php

use vendor\jdl\App\Dispatcher;

echo "Nom du projet : " . $projet->getNom_projet() . "<br>";


foreach ($taches as $tache) {
    echo '<li><a href=' . Dispatcher::generateUrl("UtilisateurController", "displayCreateUtilisateur") . '>' . $tache->getTitre_tache() . '</a></li>';
}
