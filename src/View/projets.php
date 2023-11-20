
<?php

use vendor\jdl\App\Dispatcher;

if (Dispatcher::is_connected()){
    echo '<a href="index.php?controller=ProjetController&method=createProjet"> Ajouter un projet : </a><br>';
}
else {
    echo 'toto';
}

// ajouter pour voir ses projets lié a son propres id si on est admin

foreach ($projets as $value){
    echo '<ul><li><a href="index.php?controller=ProjetController&method=displayProjets&id='
    .$value->getId_projet(). '">'
    .$value->getNom_projet()."</a></li></ul>";
}