<?php

class Table
{
    protected $columns = [];
    protected $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    public function int($columnName, $length = 11)
    {
        $this->columns[] = "`$columnName` INT($length)";
        return $this;
    }

    public function string($columnName, $length = 255)
    {
        $this->columns[] = "`$columnName` VARCHAR($length)";
        return $this;
    }

    public function primaryKey($columnName)
    {
        $this->columns[] = "PRIMARY KEY (`$columnName`)";
        return $this;
    }

    public function create()
    {
        $columnsSql = implode(", ", $this->columns);
        $query = "CREATE TABLE `$this->tableName` ($columnsSql);";
        return $query;
    }
}

?>