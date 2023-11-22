<?php

use vendor\jdl\App\Dispatcher;
echo "<h1>".$projet->getNom_projet()."</h1>";

echo '<a href=' . Dispatcher::generateUrl('ParticipeController', 'addUtilisateurToProjet') . '&id_projet=' . $projet->getId_projet() . '>Ajouter un participant</a><br>';
echo '<a href=' . Dispatcher::generateUrl('TacheController', 'createTache') . '&id_projet=' . $projet->getId_projet() . '>Créer une nouvelle tâche</a><br>';

echo "Nom du projet : " . $projet->getNom_projet() . "<br>";


foreach ($taches as $tache) {
    if ($projet->getId_utilisateur() === $_SESSION['id']) {
        echo '<li><a href=' . Dispatcher::generateUrl("TacheController", "displayTache", ['id_projet' => $projet->getId_projet(), "id_tache" => $tache->getId_tache()]) . '>' . $tache->getTitre_tache() . '</a></li>
        <a href=' . Dispatcher::generateUrl('tacheController', 'displaySupprTache', ['id_tache' => $tache->getId_tache(), 'id_projet' => $projet->getId_projet()]) . '><button>Supprimer</button></a>';
    }
}
