<?php

use number\gen\App\Dispatcher;
use number\gen\App\Security;
?>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php if (!Security::is_connected()) : ?>
                <li><a href="<?php echo Dispatcher::generateUrl("UtilisateurController", "displayCreateUtilisateur"); ?>">S'enregistrer</a></li>
                <li><a href="<?php echo Dispatcher::generateUrl("UtilisateurController", "displayConnectUtilisateur"); ?>">Se connecter</a></li>
            <?php else : ?>
                <li><a href="<?php echo Dispatcher::generateUrl("DiceController", "displayDice"); ?>">Lancer vos dés</a></li>
                <li><a href="<?php echo Dispatcher::generateUrl("UtilisateurController", "disconnect"); ?>">Se déconnecter</a></li>
            <?php endif; ?>

        </ul>
    </nav>
</header>