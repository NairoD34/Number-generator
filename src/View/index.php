<?php 
use vendor\jdl\App\Security;

if (!Security::is_connected()) :?>
  <h1>Bienvenux !!!</h1>
<?php else : ?>
  <h1>Bienvenux, <?php echo $_SESSION['username']; ?>!!!</h1>
<?php endif;?>