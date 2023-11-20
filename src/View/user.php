<?php

use vendor\jdl\Form\UtilisateurForm;
use vendor\jdl\App\Dispatcher;

echo UtilisateurForm::formSubscribe(Dispatcher::generateUrl("UtilisateurController","displayCreateUtilisateur"));

