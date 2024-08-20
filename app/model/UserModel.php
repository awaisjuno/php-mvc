<?php 

namespace Model;

use System\Loader;

class UserModel extends BaseModel {

    function fetchUser()
    {
        $result = $this->db->con()->select('users')->execute();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function insertUser($data)
    {
        $this->db->con()->insert('users', $data);
    }

}


?>