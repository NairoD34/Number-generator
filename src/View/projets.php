
<?php

use vendor\jdl\App\Security;
use vendor\jdl\App\Dispatcher; ?>

<h1>Vos projets</h1>

<?php

if (Security::is_connected()) {
    echo '<a href=' . Dispatcher::generateUrl('ProjetController', 'createProjet') . '><button>Ajouter un projet</button></a><br><br>';
    if(empty($projets)) {
        echo "<p>Vous n'avez actuellement aucun projet</p>";
    } else {
        foreach ($projets as $value) {
            echo '<a href=' . Dispatcher::generateUrl('ProjetController', 'displayProjet', ['id_projet' => $value->getId_projet()]) . '>' . $value->getNom_projet() . '<br>' . '</a>';
        }
    }
    
}
