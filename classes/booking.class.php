<?php

require_once __DIR__ . '/../dbconnection.php';

class Booking
{
    // payment table

    public $amount;
    public $payment_method;
    public $payment_info;

    // booking table

    public $userId;
    public $propertyId;
    public $day;
    public $startdate;
    public $enddate;
    public $check_in;
    public $check_out;
    public $paymentId;


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

            // Insert payment data
            $query = "INSERT INTO payments (amount, payment_method, payment_info) 
                  VALUES (:amount, :payment_method, :payment_info)";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->bindParam(":amount", $this->amount);
            $stmt->bindParam(":payment_method", $this->payment_method);
            $stmt->bindParam(":payment_info", $this->payment_info);


            if (!$stmt->execute()) {
                // throw new Exception("Error inserting booking: " . implode(", ", $stmt->errorInfo()));
                echo "Error inserting payments: " . implode(", ", $stmt->errorInfo());
                exit();
            }

            // Get the generated booking ID
            $this->paymentId = $this->dbConnection->lastInsertId();

            // Insert booking data
            $query = "INSERT INTO bookings (userId, propertyId, day, start_date, end_date, check_in, check_out, paymentId) 
                  VALUES (:userId, :propertyId, :day, :start_date, :end_date, :check_in, :check_out, :paymentId)";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->bindParam(':userId', $this->userId);
            $stmt->bindParam(':propertyId', $this->propertyId);
            $stmt->bindParam(':day', $this->day);
            $stmt->bindParam(':start_date', $this->startdate);
            $stmt->bindParam(':end_date', $this->enddate);
            $stmt->bindParam(':check_in', $this->check_in);
            $stmt->bindParam(':check_out', $this->check_out);
            $stmt->bindParam(':paymentId', $this->paymentId);

            if (!$stmt->execute()) {
                // throw new Exception("Error inserting payment: " . implode(", ", $stmt->errorInfo()));
                echo "Error inserting bookings: " . implode(", ", $stmt->errorInfo());
                exit();
            }

            // Commit the transaction
            $this->dbConnection->commit();
            return true;

        } catch (Exception $e) {
            // Rollback transaction if something goes wrong
            $this->dbConnection->rollBack();
            // error_log($e->getMessage()); // Log the error for debugging
            echo $e->getMessage();
            return false;
        }
    }

    function fetchbookeddate($id)
    {
        try {
            $query = "SELECT start_date, day FROM bookings WHERE propertyId = :propertyId";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->bindParam(':propertyId', $id);

            if (!$stmt->execute()) {
                throw new Exception("Error fetching booked dates: " . implode(", ", $stmt->errorInfo()));
            }

            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch both start_date and day

            $disabledDates = [];
            foreach ($bookings as $booking) {
                $startDate = new DateTime($booking['start_date']);
                $days = intval($booking['day']);

                // Loop to add all booked dates within the booked period
                for ($i = 0; $i <= $days; $i++) {
                    $disabledDates[] = $startDate->format('Y-m-d');
                    $startDate->modify('+1 day'); // Add one day to the date
                }
            }
            if (count($disabledDates) > 0) {
                return $disabledDates;
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


}

$bookingObj = new Booking();

// var_dump($bookingObj->fetchbookeddate(10));

