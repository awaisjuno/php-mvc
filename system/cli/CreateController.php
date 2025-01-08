<?php

namespace System\Cli;

class CreateController
{
    private $controllerName;

    public function __construct($controllerName)
    {
        $this->controllerName = ucfirst($controllerName);
    }

    public function execute()
    {
        // Define the controller directory
        $controllerDir = ROOT_DIR . 'app/controller/';

        // Ensure the controller directory exists
        if (!is_dir($controllerDir)) {
            echo "Error: Controller directory does not exist. Creating...\n";
            mkdir($controllerDir, 0777, true);
        }

        $fileName = $controllerDir . $this->controllerName . '.php';

        // Check if the controller file already exists
        if (file_exists($fileName)) {
            echo "Controller file '{$fileName}' already exists.\n";
            return;
        }

        // Controller template with placeholders for the controller name
        $template = "<?php\n\n";
        $template .= "namespace Controller;\n";
        $template .= "use System\\Loader;\n\n";
        $template .= "class {$this->controllerName} extends Loader\n";
        $template .= "{\n";
        $template .= "    protected \$load;\n\n";
        $template .= "    public function __construct()\n";
        $template .= "    {\n";
        $template .= "        parent::__construct();\n";
        $template .= "    }\n\n";
        $template .= "    public function index()\n";
        $template .= "    {\n";
        $template .= "        // Add your code for the index method here\n";
        $template .= "    }\n";
        $template .= "}\n";

        file_put_contents($fileName, $template);
        echo "Controller file '{$fileName}' created successfully.\n";
    }
}