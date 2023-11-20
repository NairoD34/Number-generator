<a href="index.php"> Retour sur l'index </a><br>
<br>
<a href="index.php?controller=ProjetController&method=createProjet"> Ajouter un projet : </a><br>
<br>

<?php 

foreach ($projets as $value){
    echo '<ul><li><a href="index.php?controller=ProjetController&method=displayProjet&id='
    .$value->getId_projet(). '">'
    .$value->getNom_projet()."</a></li></ul>";
}