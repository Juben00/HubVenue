<?php

require_once __DIR__ . '/../dbconnection.php';

class Profile
{
    // public $id;
    // public $usertype;
    // public $username;
    // public $email;
    // public $password;
    // public $message;
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function fetchprofile()
    {
        try {
            $localid = $_SESSION['id'];
            $query = "SELECT 
    u.usertype, 
    u.first_name, 
    u.last_name, 
    u.profile_pic_url, 
    (SELECT COUNT(*) FROM properties p WHERE p.userId = u.id) AS posted,
    (SELECT COUNT(*) FROM bookings b WHERE b.userId = u.id) AS booked,
    (SELECT COUNT(*) FROM saved_properties s WHERE s.userId = u.id) AS saved 
FROM users u
WHERE u.id = :id;";
            $queryexe = $this->db->connect()->prepare($query);
            $queryexe->bindParam(":id", $localid);
            $queryexe->execute();

            $data = null;

            if ($queryexe->rowCount() > 0) {
                $data = $queryexe->fetch();
            }

            return $data;
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function fetchrent()
    {
        try {
            $localid = $_SESSION['id'];
            $query = "SELECT b.*, pr.*, p.amount, p.payment_method, p.payment_info 
                FROM bookings b 
                JOIN payments p ON b.paymentId = p.pay_id 
                JOIN properties pr ON b.propertyId = pr.p_id 
                WHERE b.userId = :id
                ORDER BY b.b_id DESC;
                ";

            // "SELECT b.*, p.amount, p.payment_method, p.payment_info FROM bookings b JOIN payments p ON b.paymentId = p.pay_id WHERE b.userId = :id"

            $queryexe = $this->db->connect()->prepare($query);
            $queryexe->bindParam(":id", $localid);
            $queryexe->execute();

            $data = null;

            if ($queryexe->rowCount() > 0) {
                $data = $queryexe->fetchAll();
            }

            return $data;
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function fetchsave()
    {
        try {
            $localid = $_SESSION['id'];
            $query = "SELECT p.* FROM properties p JOIN saved_properties s ON s.propertyId = p.p_id  WHERE s.userId = :id ORDER BY s.sp_id DESC";

            $queryexe = $this->db->connect()->prepare($query);
            $queryexe->bindParam(":id", $localid);
            $queryexe->execute();

            $data = null;

            if ($queryexe->rowCount() > 0) {
                $data = $queryexe->fetchAll();
            }

            return $data;
            // echo "<pre>";
            // print_r($data);
            // echo $data;
            // echo "</pre>";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function fetchpost()
    {
        try {
            $localid = $_SESSION['id'];
            $query = "SELECT * FROM properties WHERE userId = :id ORDER BY p_id DESC";

            $queryexe = $this->db->connect()->prepare($query);
            $queryexe->bindParam(":id", $localid);
            $queryexe->execute();

            $data = null;

            if ($queryexe->rowCount() > 0) {
                $data = $queryexe->fetchAll();
            }

            return $data;
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

$profileobj = new Profile();

// var_dump($profileobj->fetchprofile());