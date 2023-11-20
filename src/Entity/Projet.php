<?php 

namespace vendor\jdl\Entity;

class Projet
{
    private int $id_projet;
    private ?string $nom_projet;
    private int $id_utilisateur;

    /**
     * Get the value of id_projet
     */ 
    public function getId_projet()
    {
        return $this->id_projet;
    }

    /**
     * Get the value of nom_projet
     */ 
    public function getNom_projet()
    {
        return $this->nom_projet;
    }
}

