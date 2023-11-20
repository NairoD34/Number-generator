<?php

namespace vendor\jdl\Entity;

class Utilisateur
{
    private int $id_utilisateur;
    private ?string $nom_utilisateur;
    private ?string $mdp;



    /**
     * Get the value of id_utilisateur
     */
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    /**
     * Get the value of nom_utilisateur
     */
    public function getNom_utilisateur()
    {
        return $this->nom_utilisateur;
    }

    /**
     * Set the value of nom_utilisateur
     *
     * @return  self
     */
    public function setNom_utilisateur($nom_utilisateur)
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    /**
     * Get the value of mdp
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set the value of mdp
     *
     * @return  self
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }
}
