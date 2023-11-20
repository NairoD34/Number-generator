<?php

foreach ($taches as $tache) {
    echo "<li><a href=http://localhost/phpobjet/mvc/?controller=TacheController&method=displayTache&id=" . $tache->getId_tache() .  ">" . $tache->getTitre_tache() . "</a></li>";
}
