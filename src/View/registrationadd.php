<?php

use vendor\jdl\Form\UtilisateurForm;
use vendor\jdl\App\Dispatcher;

echo "<h1>Enregistrez-votre participant</h1>";
echo UtilisateurForm::formSubscribe(Dispatcher::generateUrl("UtilisateurController", "displayCreateUtilisateurAndAddToProjet", ["id_projet" => $_GET['id_projet']]));
