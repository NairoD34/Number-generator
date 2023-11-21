<?php

use vendor\jdl\App\Dispatcher;

echo "<a href=" . Dispatcher::generateUrl('TacheController', 'createTache', ['id' => $_GET['id']]) . ">Créer une nouvelle tâche</a><br>";

echo "Nom de la tâche : " . $tache->getTitre_tache() . "<br>";
echo "Description de la tâche : " . $tache->getDescription() . "<br>";
echo "Priorité de la tâche : " . $priorite[0]->getLibelle() . "<br>";
echo "Statut de la tâche : " . $cdv[0]->getLibelle() . "<br>";
echo "Personne rattaché à la tache : ";
foreach ($utilisateurs as $utilisateur) {
    echo  $utilisateur->getNom_utilisateur();
}
