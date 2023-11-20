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
        extract($vars);
        include_once(__DIR__ . '/../view/' . $view);
    }
}