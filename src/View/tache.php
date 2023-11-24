<?php

use vendor\jdl\App\Dispatcher;
use vendor\jdl\App\Security;



echo "<h1>". $tache->getTitre_tache() . "</h1>";
//echo "<a href=" . Dispatcher::generateUrl('TacheController', 'createTache', ['id_projet' => $_GET['id_projet']]) . ">Créer une nouvelle tâche</a><br>";

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

// changer la personne rattaché a la tache 
// regarder le form pour ajouter un participant 
// ajout un btn modif qui redirige vers le form 
// changer l'id utilisateur sur la table tache 