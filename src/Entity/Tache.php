<?php 

namespace vendor\jdl\Entity;

class Tache
{
    private int $id_tache;
    private ?string $titre_tache;
    private ?string $description;
    private int $id_utilisateur;
    private int $id_priorite;
    private int $id_cdv;
    private int $id_projet;
}