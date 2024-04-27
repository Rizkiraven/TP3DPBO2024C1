<?php

class Role extends DB
{
    function getRole()
    {
        $query = "SELECT * FROM role";
        return $this->execute($query);
    }

    function getRoleById($id)
    {
        $query = "SELECT * FROM role WHERE role_id=$id";
        return $this->execute($query);
    }

    function addRole($data)
    {
        $role_nama = $data['role_nama'];
        $query = "INSERT INTO role (role_nama) VALUES('$role_nama')";
        return $this->executeAffected($query);
    }

    function updateRole($id, $data)
    {
        $role_nama = $data['role_nama'];
        $query = "UPDATE role SET role_nama='$role_nama' WHERE role_id=$id";
        return $this->executeAffected($query);
    }

    function deleteRole($id)
    {
        $query = "DELETE FROM role WHERE role_id=$id";
        return $this->executeAffected($query);
    }
}
