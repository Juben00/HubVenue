<?php

require_once __DIR__ . '/../dbconnection.php';

class Booking
{
    public $b_id;
    public $userId;
    public $propertyId;
    public $date;
    public $check_in;
    public $check_out;

    // payment table

    public $amount;
    public $payment_method;
    public $payment_info;

    protected $db;
    protected $dbConnection;

    function __construct()
    {
        $this->db = new Database();
        $this->dbConnection = $this->db->connect(); // Reuse the same connection
    }

    function book()
    {
        try {
            $this->check_in = date('H:i:s', strtotime($this->check_in));
            $this->check_out = date('H:i:s', strtotime($this->check_out));
            // Begin transaction
            $this->dbConnection->beginTransaction();

            // Insert booking data
            $query = "INSERT INTO bookings (userId, propertyId, date, check_in, check_out) 
                      VALUES (:userId, :propertyId, :date, :check_in, :check_out)";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->bindParam(':userId', $this->userId);
            $stmt->bindParam(':propertyId', $this->propertyId);
            $stmt->bindParam(':date', $this->date);
            $stmt->bindParam(':check_in', $this->check_in);
            $stmt->bindParam(':check_out', $this->check_out);

            if (!$stmt->execute()) {
                throw new Exception("Error inserting booking: " . implode(", ", $stmt->errorInfo()));
                // echo "Error inserting booking: " . implode(", ", $stmt->errorInfo());
                // exit();
            }

            // Get the generated booking ID
            $this->b_id = $this->dbConnection->lastInsertId();

            // Insert payment data
            $query = "INSERT INTO payments (b_id, amount, payment_method, payment_info) 
                      VALUES (:b_id, :amount, :payment_method, :payment_info)";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->bindParam(":b_id", $this->b_id);
            $stmt->bindParam(":amount", $this->amount);
            $stmt->bindParam(":payment_method", $this->payment_method);
            $stmt->bindParam(":payment_info", $this->payment_info);

            if (!$stmt->execute()) {
                throw new Exception("Error inserting payment: " . implode(", ", $stmt->errorInfo()));
                // echo "Error inserting payment: " . implode(", ", $stmt->errorInfo());
                // exit();
            }

            // Commit the transaction
            $this->dbConnection->commit();
            return true;

        } catch (Exception $e) {
            // Rollback transaction if something goes wrong
            $this->dbConnection->rollBack();
            error_log($e->getMessage()); // Log the error for debugging
            // echo $e->getMessage();
            return false;
        }
    }
}

