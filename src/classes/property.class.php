<?php

require_once __DIR__ . '/../dbconnection.php';

class Property
{
    public $p_id = "";
    public $userId = "";
    public $p_name = "";
    public $location = "";
    public $description = "";
    public $image = "";
    public $amenities = "";
    public $price = "";
    public $booked_date = "";

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function viewProp()
    {
        $query = "SELECT * FROM properties";
        $stmt = $this->db->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
