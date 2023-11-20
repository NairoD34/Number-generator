<?php 
use vendor\jdl\Form\ProjetForm;
use vendor\jdl\App\Dispatcher;

echo "<h1>Ajoutez un projet</h1>";
echo ProjetForm::formProjet(Dispatcher::generateUrl("ProjetController", "createProjet"));


