<?php

namespace vendor\jdl\Entity;

class Cycle_de_vie
{
    private int $id_cdv;
    private ?string $libelle;

    /**
     * Get the value of id_cdv
     */
    public function getId_cdv()
    {
        return $this->id_cdv;
    }

    /**
     * Set the value of id_cdv
     *
     * @return  self
     */
    public function setId_cdv($id_cdv)
    {
        $this->id_cdv = $id_cdv;

        return $this;
    }

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
}
