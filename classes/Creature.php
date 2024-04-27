<?php

class Creature extends DB
{
    function getCreature()
    {
        $query = "SELECT * FROM creature";
        return $this->execute($query);
    }

    function getCreatureById($id)
    {
        $query = "SELECT * FROM creature WHERE creature_id=$id";
        return $this->execute($query);
    }

    function addCreature($data)
    {
        $creature_nama = $data['creature_nama'];
        $query = "INSERT INTO creature (creature_nama) VALUES ('$creature_nama')";
        return $this->executeAffected($query);
    }

    function updateCreature($id, $data)
    {
        $creature_nama = $data['creature_nama'];
        $query = "UPDATE creature SET creature_nama='$creature_nama' WHERE creature_id=$id";
        return $this->executeAffected($query);
    }

    function deleteCreature($id)
    {
        $query = "DELETE FROM creature WHERE creature_id=$id";
        return $this->executeAffected($query);
    }
}
