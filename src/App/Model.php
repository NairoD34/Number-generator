<?php

namespace vendor\jdl\App;

use PDO;
use vendor\jdl\Config\Config;

class Model extends PDO
{
    private static $instance = null;

    private function __construct()
    {
        try {
            parent::__construct(
                "mysql:dbname=" . Config::DBNAME . ";host=" . Config::DBHOST,
                Config::DBUSER,
                Config::DBPWD
            );
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function fetchQuery($query, $entity): array|null
    {
        $fetch = $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . $entity);
        if (empty($fetch)) {
            return null;
        } else {
            return $fetch;
        }
    }

    public static function getInstance(): Model
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function readAll($entity): array|null
    {
        $query = $this->query(' select * from ' . $entity);
        return $this->fetchQuery($query, $entity);
    }

    public function getById($entity, $id): object|null
    {
        $query = $this->query('select * from ' . $entity . ' where id_' . $entity . '=' . $id);
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . $entity)[0];
    }

    /**
     * Méthode permettant de récupérer toutes les lignes de la table $entity où la clé étrangère de
     * $foreign_entity égale $id.
     * 'SELECT * FROM '.$entity.' WHERE id_'.$foreign_entity.'='.$id
     * @param string $entity : la table dans laquelle on select
     * @param string $id : la valeur de la clé étrangère
     * @param string $foreing_entity : l'entité étrangère
     */
    public function getByFk(string $entity, string $id, string $foreign_entity): array
    {
        $query = $this->query('select * from ' . $entity . ' where id_' . $foreign_entity . '=' . $id);
        return $this->fetchQuery($query, $entity);
    }

    public function save($entity, $datas): void
    {
        $sql = 'INSERT into ' . $entity . ' (';
        $count = count($datas) - 1;
        $preparedDatas = [];
        $i = 0;
        foreach ($datas as $key => $value) {
            $sql .= $key;
            if ($i < $count) {
                $sql = $sql . ',';
            }
            $i++;
        }
        $sql .= ') VALUES (';
        $i = 0;
        foreach ($datas as $data) {
            $preparedDatas[] = htmlspecialchars($data);
            $sql .= "?";
            if ($i < $count) {
                $sql = $sql . ', ';
            }
            $i++;
        }
        $sql = $sql . ')';
        $preparedRequest = $this->prepare($sql);
        $preparedRequest->execute($preparedDatas);
    }

    public function supprById($entity, $id): void
    {
        $sql = 'delete from ' . $entity . ' where id_' . $entity . '=' . $id;
        $preparedSql = $this->prepare($sql);
        $preparedSql->execute();
    }

    // public function supprAll($entity, $id)
    // {
    //     $sql = ' delete from ' .$entity . 'where id_'. $entity . '='. $id;
    //     $sql = ' delete * from ' .$entity . 'where id_'. $entity . '='. $id;

    //     $preparedSql = $this->prepare($sql);
    //     $preparedSql->execute();
    // }

    public function updateById($entity, $id,  $datas): void
    {
        $sql = 'UPDATE ' . $entity . ' SET ';
        $count = count($datas) - 1;
        $preparedDatas = [];
        $i = 0;
        foreach ($datas as $key => $value) {
            $preparedDatas[] = htmlspecialchars($value);
            $sql .= $key . " = ?";
            if ($i < $count) {
                $sql = $sql . ', ';
            }
            $i++;
        }
        $sql = $sql . " WHERE id_". $entity ." = '$id'";
        $preparedRequest = $this->prepare($sql);
        $preparedRequest->execute($preparedDatas);
    }

    public function getByAttribute($entity, $attribute, $value, $comp = '='): array
    {
        // SELECT * FROM table WHERE attribute = value
        $query = $this->query("SELECT * FROM $entity WHERE $attribute $comp '$value'");
        return $query->fetchAll(PDO::FETCH_CLASS, Config::ENTITY . ucfirst($entity));
    }
}
