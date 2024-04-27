<?php

class Profile extends DB
{
    function getProfileJoin()
    {
        $query = "SELECT * FROM profile JOIN role ON profile.role_id=role.role_id JOIN creature ON profile.creature_id=creature.creature_id ORDER BY profile.profile_id";

        return $this->execute($query);
    }

    function getProfile()
    {
        $query = "SELECT * FROM profile";
        return $this->execute($query);
    }

    function getProfileById($id)
    {
        $query = "SELECT * FROM profile JOIN role ON profile.role_id=role.role_id JOIN creature ON profile.creature_id=creature.creature_id WHERE profile_id=$id";
        return $this->execute($query);
    }

    function searchProfile($keyword)
    {
        $query = "SELECT * FROM profile 
              JOIN role ON profile.role_id=role.role_id 
              JOIN creature ON profile.creature_id=creature.creature_id 
              WHERE profile.profile_ign LIKE '%$keyword%' 
              OR profile.profile_realname LIKE '%$keyword%' 
              OR role.role_nama LIKE '%$keyword%' 
              OR creature.creature_nama LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function getProfileJoinSortedByRole()
    {
        $query = "SELECT * FROM profile 
              JOIN role ON profile.role_id=role.role_id 
              JOIN creature ON profile.creature_id=creature.creature_id 
              ORDER BY role.role_nama, profile.profile_id";

        return $this->execute($query);
    }

    function addProfile($data)
    {
        $profile_ign = $data['profile_ign'];
        $profile_realname = $data['profile_realname'];
        $role_id = $data['role_id'];
        $creature_id = $data['creature_id'];

        $profile_foto = $_FILES['profile_foto']['name'];
        $target_dir = "../assets/images/";
        $target_file = $target_dir . basename($_FILES["profile_foto"]["name"]);

        if ($_FILES['profile_foto']['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        if (!move_uploaded_file($_FILES["profile_foto"]["tmp_name"], $target_file)) {
            return false;
        }

        $query = "INSERT INTO profile (profile_foto, profile_ign, profile_realname,role_id, creature_id) VALUES ('$profile_foto', '$profile_ign', '$profile_realname', '$role_id', '$creature_id')";

        $this->open();
        $result = $this->executeAffected($query);
        $this->close();

        return $result;
    }

    function updateProfile($id, $data)
    {
        $profile_ign = $data['profile_ign'];
        $profile_realname = $data['profile_realname'];
        $role_id = $data['role_id'];
        $creature_id = $data['creature_id'];

        $profile_foto = $_FILES['profile_foto']['name'];
        $target_dir = "../assets/images/";
        $target_file = $target_dir . basename($_FILES["profile_foto"]["name"]);

        if ($_FILES['profile_foto']['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        if (!move_uploaded_file($_FILES["profile_foto"]["tmp_name"], $target_file)) {
            return false;
        }

        $query = "UPDATE profile SET profile_foto='$profile_foto', profile_ign='$profile_ign', profile_realname='$profile_realname', role_id='$role_id', creature_id='$creature_id' WHERE profile_id=$id";
        return $this->executeAffected($query);
    }

    function deleteProfile($id)
    {
        $query = "DELETE FROM profile WHERE profile_id=$id";
        return $this->executeAffected($query);
    }
}
