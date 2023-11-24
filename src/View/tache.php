<?php

use vendor\jdl\App\Dispatcher;
use vendor\jdl\App\Security;



echo "<h1>". $tache->getTitre_tache() . "</h1>";

echo "Description de la tâche : " . $tache->getDescription() . "<br>";
echo "Priorité de la tâche : " . $priorite . "<br>";
echo "Statut de la tâche : " . $cdv . "<br>";
echo "Personne rattaché à la tache : " . $utilisateurs;

if (Security::isAdmin($_SESSION['id'], $_GET['id_projet'])){
    echo "<p>(ADMIN)</p>";
    echo '<a href='. Dispatcher::generateUrl('TacheController', 'updateUtilisateurToTache', [
        'id_projet' => $_GET['id_projet'],
        'id_tache' => $_GET['id_tache'],

        ]). '>Modifier le participant à la tâche</a><br>';
}
