<?php

require_once __DIR__ . '/../dbconnection.php';

class User
{
    public $message;
    public $id;
    public $usertype;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $cpassword;
    public $transaction_method;
    public $transaction_details;
    public $identification_card;
    public $identification_card_image_url;

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register()
    {
        try {
            $checkquery = "SELECT * FROM users WHERE email = :email";
            $checkexe = $this->db->connect()->prepare($checkquery);
            $checkexe->bindParam(":email", $this->email);
            $checkexe->execute();

            $this->usertype = 'user';

            if ($checkexe->fetchColumn() > 0) {
                $this->message = "Error: Duplicate entry for Email '" . htmlspecialchars($this->email) . "'. Please use a different email.";
                return false;
            } else {
                $insertquery = "INSERT INTO users (usertype, first_name, last_name, email, password) VALUES (:usertype, :first_name, :last_name, :email, :password)";
                $queryexe = $this->db->connect()->prepare($insertquery);
                $queryexe->bindParam(":usertype", $this->usertype);
                $queryexe->bindParam(":first_name", $this->first_name);
                $queryexe->bindParam(":last_name", $this->last_name);
                $queryexe->bindParam(":email", $this->email);
                $hash_pass = password_hash($this->password, PASSWORD_DEFAULT);
                $queryexe->bindParam(":password", $hash_pass);

                if ($queryexe->execute()) {
                    echo "Registration successful!";
                    return true;
                } else {
                    $this->message = "Registration failed!";
                    return false;
                }
            }

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $this->message = "Error: Duplicate entry for Email '" . htmlspecialchars($this->email) . "'. Please use a different email.";
            } else {
                $this->message = "Database error: " . $e->getMessage();
            }
            return false;
        }
    }

    public function login()
    {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $queryexe = $this->db->connect()->prepare($query);
            $queryexe->bindParam(":email", $this->email);
            $queryexe->execute();

            if ($queryexe->rowCount() > 0) {
                $row = $queryexe->fetch(PDO::FETCH_ASSOC);
                if (password_verify($this->password, $row['password'])) {
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    // $_SESSION['usertype'] = $row['usertype'];
                    // $_SESSION['username'] = $row['username'];
                    // $_SESSION['email'] = $row['email'];
                    return true;
                } else {
                    $this->message = "Invalid credentials!";
                }
            } else {
                $this->message = "User Doesn't Exist!";
            }
        } catch (PDOException $e) {
            $this->message = "Database error: " . $e->getMessage();
        }
        return false;
    }

    public function fetchprofile()
    {
        try {
            $localid = $_SESSION['id'];
            $query = "SELECT * FROM users WHERE id = :id";
            $queryexe = $this->db->connect()->prepare($query);
            $queryexe->bindParam(":id", $localid);
            $queryexe->execute();

            $data = null;

            if ($queryexe->rowCount() > 0) {
                $data = $queryexe->fetch(PDO::FETCH_ASSOC);
            }

            return $data;
        } catch (PDOException $e) {
            $this->message = "Database error: " . $e->getMessage();
        }
    }

    public function changeInfo()
    {
        try {
            $localid = $_SESSION['id'];
            // Fetch the old password from the database
            $checkquery = "SELECT password FROM users WHERE id = :id;";
            $checkqueryexe = $this->db->connect()->prepare($checkquery);
            $checkqueryexe->bindParam(":id", $localid);
            $checkqueryexe->execute();
            $oldPasswordHash = $checkqueryexe->fetchColumn(PDO::FETCH_ASSOC); // Fetches the password hash directly

            // If there is an existing password hash for the user
            if ($oldPasswordHash) {
                // Check if the new password matches the old password
                if (password_verify($this->password, $oldPasswordHash)) {
                    $this->message = "New Password cannot be the same as the Old Password";
                    return; // Stop further execution if passwords match
                }

                // Check if the new password matches the confirm password
                if ($this->password === $this->cpassword) {
                    // Hash the new password
                    $newPasswordHash = password_hash($this->password, PASSWORD_DEFAULT);

                    // Update the user's details and the password
                    $query = "UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, password = :password WHERE id = :id;";
                    $queryexe = $this->db->connect()->prepare($query);
                    $queryexe->bindParam(":first_name", $this->first_name);
                    $queryexe->bindParam(":last_name", $this->last_name);
                    $queryexe->bindParam(":email", $this->email);
                    $queryexe->bindParam(":password", $newPasswordHash); // Bind the hashed new password
                    $queryexe->bindParam(":id", $localid);
                    $queryexe->execute();
                    $this->message = "Information updated successfully!";
                    return;
                } else {
                    $this->message = "New password and confirm password do not match!";
                }
            }
        } catch (Exception $e) {
            $this->message = "Database error: " . $e->getMessage();
        }
    }
    public function hostApplication()
    {
        try {
            // Ensure session has user ID
            if (!isset($_SESSION['id'])) {
                throw new Exception('User not authenticated.');
            }

            $localid = $_SESSION['id'];
            $query = "SELECT * FROM users WHERE id = :id";
            $queryexe = $this->db->connect()->prepare($query);
            $queryexe->bindParam(":id", $localid);
            $queryexe->execute();

            if ($queryexe->rowCount() > 0) {
                // Update user information with transaction method and details
                $updatequery = "UPDATE users 
                            SET 
                                usertype = 'pending',
                                transaction_method = :transaction_method, 
                                transaction_details = :transaction_details, 
                                identification_card = :identification_card, 
                                identification_card_image_url = :identification_card_image_url 
                            WHERE id = :id";

                $updatequeryexe = $this->db->connect()->prepare($updatequery);
                $updatequeryexe->bindParam(":transaction_method", $this->transaction_method);
                $updatequeryexe->bindParam(":transaction_details", $this->transaction_details);
                $updatequeryexe->bindParam(":identification_card", $this->identification_card);
                $updatequeryexe->bindParam(":identification_card_image_url", $this->identification_card_image_url);
                $updatequeryexe->bindParam(":id", $localid);

                if ($updatequeryexe->execute()) {
                    $this->message = "Application submitted successfully!";
                    return true;
                } else {
                    throw new Exception("Application submission failed!");
                }
            } else {
                throw new Exception("User not found.");
            }
        } catch (PDOException $e) {
            $this->message = "Database error: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return false;
        }
    }

}


// $userObj = new User();


// var_dump($userObj->fetchprofile());