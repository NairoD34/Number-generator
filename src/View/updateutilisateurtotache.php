<?php 

use vendor\jdl\App\Dispatcher;

echo "<h1>Modifier l'utilisateur sur la tâche</h1>";
echo $form;
if(!empty($error)){
    echo $error;
}