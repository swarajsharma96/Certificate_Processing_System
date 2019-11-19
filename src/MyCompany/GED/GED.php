<?php


namespace App\GED;


use App\Model\Database;

class GED extends Database
{
    private $isCompleteGED, $applyID;

    public function __construct()
    {
        parent::__construct();
    }

    public function initVar($postArray)
    {
        if (array_key_exists('GED', $postArray))
            $this->isCompleteGED = $postArray['GED'];
        if (array_key_exists('applyID', $postArray))
            $this->applyID = $postArray['applyID'];
    }

    /**
     * @return mixed
     */
    public function getApplyID()
    {
        return $this->applyID;
    }


    /**
     * @return mixed
     */
    public function getIsCompleteGED()
    {
        return $this->isCompleteGED;
    }


    public function storeGED()
    {
        $query = "INSERT INTO `ged` (`apply_id`, `ged_clearance`) VALUES ($this->applyID, $this->isCompleteGED)";
        echo "$query";

        try {
            parent::delete_Update_Store($query);
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }


}