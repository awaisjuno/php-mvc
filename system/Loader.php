<?php

namespace System;
use Model;

class Loader
{
    protected $viewPath;
    protected $modelPath;

    public function __construct()
    {
        // Define the base paths for views and models
        $this->viewPath = ROOT_DIR . '/app/view/';
        $this->modelPath = ROOT_DIR . '/app/model/';
    }

    /**
     * Load a view and return its rendered content
     *
     * @param string $viewName
     * @param array $data
     * @return string
     */
    public function view($viewName, $data = [])
    {
        $viewFile = $this->viewPath . str_replace('.', '/', $viewName) . '.php';

        if (file_exists($viewFile)) {
            // Extract data into variables
            extract($data);

            // Start output buffering
            ob_start();

            // Include the view file
            include $viewFile;

            // Return the content of the view
            return ob_get_clean();
        } else {
            return "Error: View file '$viewName' not found.";
        }
    }

    /**
     * Load and instantiate a model
     *
     * @param string $modelName
     * @param string $alias
     */
    public function model($modelName, $alias = '')
    {
        $modelName = ucfirst($modelName); // Capitalize model name (e.g., UserModel)
        $modelFile = $this->modelPath . $modelName . '.php';

        // Check if the model file exists
        if (file_exists($modelFile)) {
            // Include the model file
            require_once $modelFile;

            // If no alias is provided, use the model name
            if (empty($alias)) {
                $alias = $modelName;
            }

            // Instantiate the model and store it in the class property
            $this->$alias = new $modelName();
        } else {
            // Throw an exception if the model file is not found
            throw new \Exception("Model file not found: $modelFile");
        }
    }
}