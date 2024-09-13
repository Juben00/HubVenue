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

    function viewProp($location = '', $price = '', $search = '')
    {
        $query = "SELECT * FROM properties 
                  WHERE (
                  location LIKE CONCAT('%', :location, '%') AND 
                  price LIKE CONCAT('%', :price, '%') AND 
                  property_name LIKE CONCAT('%' :search, '%')
                  )
                  ORDER BY property_name";

        $stmt = $this->db->connect()->prepare($query);

        // Bind parameters properly to ensure safety and correct execution
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':search', $search);

        $data = null; // Initialize a variable to hold the fetched data.

        // Execute the query. If successful, fetch all the results into an array.
        if ($stmt->execute()) {
            $data = $stmt->fetchAll(); // Fetch all rows from the result set.
        }

        return $data; // Return the fetched data.
    }

    function fetchlocation()
    {
        $sql = 'SELECT * from properties ORDER BY location ASC;';

        $stmt = $this->db->connect()->prepare($sql);

        $data = null;

        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
        }

        return $data;
    }

    function fetchprice()
    {
        $sql = 'SELECT * from properties ORDER BY location ASC;';

        $stmt = $this->db->connect()->prepare($sql);

        $data = null;

        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
        }

        return $data;
    }

    function fetchfocus($id)
    {
        if (!is_numeric($id)) {
            return false;
        }

        $sql = "SELECT * FROM properties WHERE p_id = :id";

        $stmt = $this->db->connect()->prepare($sql);
        $data = null;

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            $data = $stmt->fetch();
        }
        return $data;
    }
}

// Create an instance of the Property class
$property = new Property();

// Call the viewProp method using the instance and print the result
// var_dump($property->viewProp('', ''));
// var_dump($property->fetchfocus(6));
