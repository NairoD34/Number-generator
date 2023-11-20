<?php 
use vendor\jdl\App\Dispatcher;
?>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="<?php echo Dispatcher::generateUrl("UtilisateurController", "displayCreateUtilisateur"); ?>">S'enregistrer</a></li>
            <li><a href="<?php echo Dispatcher::generateUrl("UtilisateurController", "displayConnectUtilisateur"); ?>">Se connecter</a></li>
        </ul>
    </nav>
</header>