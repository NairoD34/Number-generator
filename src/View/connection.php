<?php

use vendor\jdl\Form\UtilisateurForm;
use vendor\jdl\App\Dispatcher;

echo "<h1>Connectez-vous</h1>";
echo UtilisateurForm::formSubscribe(Dispatcher::generateUrl("UtilisateurController","displayConnectUtilisateur"));
