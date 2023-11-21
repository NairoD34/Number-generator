<?php

namespace vendor\jdl\Entity;

class Priorite
{
    private int $id_priorite;
    private ?string $libelle;

    /**
     * Get the value of libelle
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set the value of libelle
     *
     * @return  self
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get the value of id_priorite
     */
    public function getId_priorite()
    {
        return $this->id_priorite;
    }

    /**
     * Set the value of id_priorite
     *
     * @return  self
     */
    public function setId_priorite($id_priorite)
    {
        $this->id_priorite = $id_priorite;

        return $this;
    }
}
