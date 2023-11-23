<?php 

echo "<h1>Modifier la tâche</h1>";
echo $form;

if (!is_null($error)) {
  echo "<pre>$error</pre>";
}