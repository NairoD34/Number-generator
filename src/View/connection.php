<?php

echo "<h1>Connectez-vous</h1>";
echo $form;

if (!empty($error)) {
  echo "<pre>$error</pre>";
}
