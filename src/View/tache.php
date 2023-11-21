<?php

use vendor\jdl\App\Dispatcher;

var_dump($_SESSION);
echo "Nom de la tâche : " . $tache->getTitre_tache() . "<br>";
echo "Description de la tâche : " . $tache->getDescription() . "<br>";
echo "Priorité de la tâche : " . $priorite[0]->getLibelle() . "<br>";
echo "Statut de la tâche : " . $cdv[0]->getLibelle() . "<br>";
echo "Personne rattaché à la tache :";
foreach ($utilisateurs as $utilisateur) {
    echo '<li><a href=' . Dispatcher::generateUrl("TacheController", "displayTache") . '>' . $utilisateur->getNom_utilisateur() . '</a></li>';
}
