<?php

namespace vendor\jdl\App;

class AbstractController
{

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function render($view, $vars)
    {
        // Si y'a pas de titre dans le tableau, on en met un par défaut
        if (empty($vars["title"])) {
            $vars["title"] = "Tarpin Projet Manager";
        }
        extract($vars);
        echo "<!DOCTYPE html><html>";
        include_once(__DIR__ . '/../View/head.php');
        include_once(__DIR__ . '/../View/header.php');
        include_once(__DIR__ . '/../View/' . $view);
        echo "</html>";
    }
}
