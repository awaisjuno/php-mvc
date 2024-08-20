<?php

namespace System;
use Model;

class Loader
{
    protected $viewPath;
    protected $modelPath;

    public function __construct()
    {
        $this->viewPath = 'app/view/';
        $this->modelPath = 'app/model/';
    }

    public function view($viewName, $data = [])
    {
        extract($data);
        $viewFile = $this->viewPath . $viewName . '.php';

        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            echo "View file '$viewFile' not found.";
        }
    }

    public function model($modelName, $alias = '')
    {
        $modelName = ucfirst($modelName);
        $modelFile = 'app/model/' . $modelName . '.php';
        echo $modelFile;
        if (file_exists($modelFile)) {
            require_once $modelFile;
            if (empty($alias)) {
                $alias = $modelName;
            }
            $this->$alias = new Model/$modelName();
        } else {
            throw new Exception('Model file not found: ' . $modelFile);
        }
    }
}