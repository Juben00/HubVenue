<?php
require_once __DIR__ . '/../dbconnection.php';

class Save
{
    public $userId;
    public $propertyId;
    protected $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    function saveProperty()
    {
        try {
            $query = "INSERT INTO saved_properties (userId, propertyId) VALUES (:userid, :propertyid);";
            $stmt = $this->db->connect()->prepare($query);
            $this->userId = $_SESSION['id'];
            $stmt->bindParam(":userid", $this->userId);
            $stmt->bindParam(":propertyid", $this->propertyId);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
            // echo $this->userId;
        } catch (PDOException $e) {
            echo json_encode(['message' => 'Database Error: ' . $e->getMessage()]);
            return false;
        }
    }

}

$saveobj = new Save();

// var_dump($saveobj->saveProperty());
