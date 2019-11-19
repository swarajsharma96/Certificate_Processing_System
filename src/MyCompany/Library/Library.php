<?php


namespace App\Library;


use App\Model\Database;

class Library extends Database
{
    private $applyID, $clearance;

    public function __construct()
    {
        parent::__construct();
    }

    public function initVar($postArray)
    {
        if (array_key_exists('applyID', $postArray))
            $this->applyID = $postArray['applyID'];
        if (array_key_exists('clearance', $postArray))
            $this->clearance = $postArray['clearance'];
    }

    public function storeLib()
    {
        $query = "INSERT INTO `library` (`apply_id`, `clearance`) VALUES ($this->applyID, $this->clearance)";
        echo "$query";

        try {
            parent::delete_Update_Store($query);
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

}