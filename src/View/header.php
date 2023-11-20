<?php

use vendor\jdl\App\Dispatcher;
?>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <?php if (!Dispatcher::is_connected()) : ?>
                <li><a href="<?php echo Dispatcher::generateUrl("UtilisateurController", "displayCreateUtilisateur"); ?>">S'enregistrer</a></li>
                <li><a href="<?php echo Dispatcher::generateUrl("UtilisateurController", "displayConnectUtilisateur"); ?>">Se connecter</a></li>
            <?php else : ?>
<<<<<<< HEAD
                <li><a href="<?php echo Dispatcher::generateUrl("ProjetController", "displayProjets"); ?>"> Projets : </a></li>
                <li><a href="<?php echo Dispatcher::generateUrl("UtilisateurController", "disconnect"); ?>">Se déconnecter</a></li>
=======
            <li><a href="<?php echo Dispatcher::generateUrl("ProjetController", "displayProjets"); ?>"> Projets : </a></li>
            <li><a href="<?php echo Dispatcher::generateUrl("UtilisateurController", "disconnect"); ?>">Se déconnecter</a></li>
>>>>>>> 482c51366fd8f3dd04cdbd3f6a064fed6fc73fc5
            <?php endif; ?>

        </ul>
    </nav>
</header>