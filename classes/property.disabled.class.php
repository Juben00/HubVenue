<?php
require_once __DIR__ . '/../dbconnection.php';

class Disable
{
    public $pd_id;

    public $propertyId;
    public $start_date;
    public $end_date;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function disableProperty()
    {
        $query = "INSERT INTO property_disabled (property_id, start_date, end_date) VALUES (:property_id, :start_date, :end_date)";

        $stmt = $this->db->connect()->prepare($query);

        $stmt->bindParam(':property_id', $this->propertyId);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);

        return $stmt->execute();
    }
}