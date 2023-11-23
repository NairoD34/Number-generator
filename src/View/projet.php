<?php

use vendor\jdl\App\Dispatcher;

echo "<h1>" . $projet->getNom_projet() . "</h1>";

if ($isAdmin) {
    echo "<p>(ADMIN)</p>";
    echo '<a href=' . Dispatcher::generateUrl('ParticipeController', 'addUtilisateurToProjet') . '&id_projet=' . $projet->getId_projet() . '>Ajouter un participant</a><br>';
}

echo '<a href=' . Dispatcher::generateUrl('TacheController', 'createTache') . '&id_projet=' . $projet->getId_projet() . '>Créer une nouvelle tâche</a><br>';
if ($isAdmin) {
    echo '<a style="color: red;" href=' . Dispatcher::generateUrl('ProjetController', 'deleteProjet') . '&id_projet=' . $projet->getId_projet() . '>Supprimer le projet</a><br>';
}
echo "<ul>";
foreach ($users as $user) {
    echo '<li>' . $user->getNom_utilisateur() . '</li>';
}
echo "</ul>";
echo "<ul>";
foreach ($taches as $tache) {
    if ($projet->getId_utilisateur() === $_SESSION['id']) {
        echo '<br><li><a href=' . Dispatcher::generateUrl("TacheController", "displayTache", ['id_projet' => $projet->getId_projet(), "id_tache" => $tache->getId_tache(), "id_utilisateur" => $tache->getId_utilisateur(), "id_priorite" => $tache->getId_priorite(), "id_cdv" => $tache->getId_cdv()]) . '>' . $tache->getTitre_tache() . '</a></li>
        <a href=' . Dispatcher::generateUrl('tacheController', 'displaySupprTache', ['id_tache' => $tache->getId_tache(), 'id_projet' => $projet->getId_projet()]) . '><button>Supprimer</button></a>
        <a href=' . Dispatcher::generateUrl('tacheController', 'updateTache', ['id_tache' => $tache->getId_tache()]) . '><button>Modifier</button></a>';

    }
}
echo "</ul>";
