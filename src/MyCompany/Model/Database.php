<?php
/**
 * Created by PhpStorm.
 * User: Shuva
 * Date: 8/2/2019
 * Time: 11:30 AM
 */

namespace App\Model;
use PDO, PDOException;

class Database
{
    protected $dbconnection;

    public function __construct()
    {
        try {
            $this->dbconnection = new PDO("mysql:host=localhost;dbname=certificate_processing_system", "root", "");
            $this->dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getDbInstance()
    {
        return $this->dbconnection;
    }

    public function retrieve($query)
    {
        $statement = $this->dbconnection->prepare($query);
        $statement->execute();
        $data = $statement->fetch();
        return $data;
    }

    public function delete_Update_Store($query)
    {
        $statement = $this->dbconnection->prepare($query);
        $statement->execute();
        return true;
    }


}

