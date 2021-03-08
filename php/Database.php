<?php

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "todo";

    private $conn;
    private $statement;

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=' . $this->servername . ';dbname=' .$this->dbname, $this->username);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//                echo "Success connect";
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    // allows us to write queries
    public function query($sql)
    {
        $this->statement = $this->conn->prepare($sql);
    }

    // bind values
    public function bind($parameter, $value, $type = null)
    {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }

        $this->statement->bindValue($parameter, $value, $type);
    }

    // execute the prepared statement
    public function execute()
    {
        return $this->statement->execute();
    }

    // return an array
    public function resultSet()
    {
        $this->execute();

        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // return a specific row as an object
    public function single()
    {
        $this->execute();

        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // get's the row count
    public function rowCount()
    {
        return $this->statement->rowCount();
    }

}