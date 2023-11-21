<?php

use vendor\jdl\App\Dispatcher;
use vendor\jdl\Controller\TacheController;

echo '<a href=' . Dispatcher::generateUrl('TacheController', 'createTache') . '&id=' . $projet->getId_projet() . '>Créer une nouvelle tâche</a><br>';

echo "Nom du projet : " . $projet->getNom_projet() . "<br>";


foreach ($taches as $tache) {
    echo '<li><a href=' . Dispatcher::generateUrl("TacheController", "displayTache", ["id" => $tache->getId_tache(), "id_utilisateur" => $tache->getId_utilisateur(), "id_priorite" => $tache->getId_priorite(), "id_cdv" => $tache->getId_cdv()]) . '>' . $tache->getTitre_tache() . '</a></li>';
}
