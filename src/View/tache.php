<?php

use vendor\jdl\App\Dispatcher;

echo "<a href=" . Dispatcher::generateUrl('TacheController', 'createTache', ['id_projet' => $_GET['id_projet']]) . ">Créer une nouvelle tâche</a><br>";

echo "Nom de la tâche : " . $tache->getTitre_tache() . "<br>";
echo "Description de la tâche : " . $tache->getDescription() . "<br>";
echo "Priorité de la tâche : " . $priorite . "<br>";
echo "Statut de la tâche : " . $cdv . "<br>";
echo "Personne rattaché à la tache : " . $utilisateurs;
