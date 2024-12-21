<?php

class Database
{
    private $con;
    //constructor to connect to database
    function __construct()
    {
        $this->con = $this->connect();
    }
    //connect to database
    private function connect()
    {
        $string = "mysql:host=localhost;dbname=fluxtalk_db";
        try {
            $connection = new PDO($string, DBUSER, DBPASS);
            return $connection;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return false;
    }

    //write to database
    public function write($query, $data_array = [])
    {
        $con = $this->connect();
        $statement = $con->prepare($query);
        $check = $statement->execute($data_array);
        if ($check) {
            return true;
        }
        return false;
    }
    public function generate_id($max)
    {
        $rand = "";
        $rand_count = rand(4, $max);
        for ($i = 0; $i < $rand_count; $i++) {
            $r = rand(0,9);
            $rand .= $r;
        }

        return $rand;
    }
}