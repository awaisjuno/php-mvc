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

    function show($id, $name)
    {
        $users = $this->userModel->fetchUser();
        echo $name;
        //echo '<pre>';
        //print_r($users);
        //echo '</pre>';

    }

    function hello()
    {
        echo "Hello";
    }

    function insert()
    {
        $data = array(
            'first_name' => 'AAA',
            'last_name' => 'zzz',
            'email' => 'xxx@gmail.com',
            'password' => '233435'
        );
        //Caling the Model to Insert Data
        $run = $this->userModel->insertUser($data);

    }

}

?>