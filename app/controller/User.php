<?php 

namespace Controller;

use System\Loader;
use Model\UserModel;

class User extends Loader
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    function show($id)
    {
        $users = $this->userModel->fetchUser();
        echo '<pre>';
        print_r($users);
        echo '</pre>';

    }

    function hello()
    {
        echo "Hrll";
    }

    function insert()
    {
        $data = array(
            'first_name' => 'Awajf',
            'last_name' => 'fef',
            'email' => 'awwa@gmail.com',
            'password' => '233435'
        );
        //Caling the Model to Insert Data
        $run = $this->userModel->insertUser($data);

    }

}

?>