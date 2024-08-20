<?php 

namespace Controller;
use System\Loader;

class Pages extends Loader {

    protected $load;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "Index Hello";
    }

    public function home($id, $name)
    {
        $data = array(
            'msg' => 'Welcome to Colab MVC.'
        );

        print_r($data);
        //echo "Hello To the Home Page";
        //$this->view('Welcome', $data);

    }

    public function about()
    {
        echo "Hello To the About Page";
    }


    public function default()
    {
        echo 'Hi default';
    }

}

?>