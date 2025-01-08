<?php 

namespace Controller;
use System\Loader;

class Pages extends Loader {

    protected $load;

    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $this->view('Welcome');
    }

}

?>