<?php

use number\gen\App\Security;

if (!Security::is_connected()) : ?>
  <h1>Bienvenux !!!</h1>
<?php else : ?>
  <h1>Bienvenux, <?php echo $_SESSION['username']; ?>!!!</h1>
<?php endif;

if (!empty($message)) {
  echo "<p class='alert'>$message</p>";
}
