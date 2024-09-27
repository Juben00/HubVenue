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

    public $status = "";

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

    public function addProp()
    {
        try {
            $sql = "INSERT INTO properties (userId, property_name, location, description, image, amenities, price, status)
                VALUES (:userId, :property_name, :location, :description, :image, :amenities, :price, :status)";
            $stmt = $this->db->connect()->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':userId', $this->userId);
            $stmt->bindParam(':property_name', $this->p_name);
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':image', $this->image, PDO::PARAM_LOB); // Assuming image is binary/blob
            $stmt->bindParam(':amenities', $this->amenities);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':status', $this->status); // Assuming status defaults to 'pending'

            // Execute query
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}

// Create an instance of the Property class
$property = new Property();

// Call the viewProp method using the instance and print the result
// var_dump($property->viewProp('', '', ''));
// var_dump($property->fetchfocus(6));
