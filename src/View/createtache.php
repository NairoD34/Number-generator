<?php

echo "<h1>Ajoutez une tache</h1>";
echo $form;

if (!is_null($error)) {
  echo "<pre>$error</pre>";
}