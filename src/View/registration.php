<?php

use number\gen\Form\UtilisateurForm;
use number\gen\App\Dispatcher;

echo "<h1>Enregistrez-vous</h1>";
echo UtilisateurForm::formSubscribe(Dispatcher::generateUrl("UtilisateurController", "displayCreateUtilisateur"));
