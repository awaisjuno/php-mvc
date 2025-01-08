<?php

namespace System\Database;

class Schema
{
    public static function table($tableName, $callback)
    {
        $table = new \Table($tableName);
        $callback($table);
        echo "Table {$tableName} has been created with the following columns:\n";
        print_r($table->getColumns());
    }
}