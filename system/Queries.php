<?php

namespace System;

class Queries
{

    private $con;
    private $query;

    public function con()
    {
        $this->con = mysqli_connect('localhost', 'root', '', 'db_queries');
        return $this;
    }

    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    public function insert($table, $array)
    {
        $column = implode(", ", array_keys($array));
        $value = implode(", ", array_map(function($value) {
            return "'" . mysqli_real_escape_string($this->con, $value) . "'";
        }, array_values($array)));

        //Insert Query
        $query = "INSERT INTO $table ($column) VALUES ($value);";
        return $this->setQuery($query);
    }

    public function update($key, $value, $table_name, $array)
    {
        $data = implode(", ", array_map(function($column, $val) {
            return "$column='" . mysqli_real_escape_string($this->con, $val) . "'";
        }, array_keys($array), array_values($array)));

        $query = "UPDATE $table_name SET $data WHERE $key='$value'";
        return $this->setQuery($query);
    }

    public function select($table)
    {
        $query = "SELECT * FROM $table";
        return $this->setQuery($query);
    }

    public function find($key, $value, $table_name)
    {
        $query = "SELECT * FROM $table WHERE $key='$value'";
        return $this->setQuery($query);
    }

    public function del($key, $value, $table_name)
    {
        $query = "DELETE FROM $table_name WHERE $key='$value'";
        return $this->setQuery($query);
    }

    public function execute()
    {
        $exec = mysqli_query($this->con, $this->query);
        if(!$exec) {
            echo "Error: " . mysqli_error($this->con);
            return null;
        }
        return $exec;
    }

    public function fetchAll()
    {
        $data = [];
        while ($row = $this->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

}