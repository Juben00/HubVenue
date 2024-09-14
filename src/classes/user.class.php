<?php

require_once __DIR__ . '/../dbconnection.php';

class User
{
    public $id;
    public $usertype;
    public $username;
    public $email;
    public $password;
    public $message;
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

            if ($checkexe->fetchColumn() > 0) {
                $this->message = "Error: Duplicate entry for Email '" . htmlspecialchars($this->email) . "'. Please use a different email.";
                return false;
            } else {
                $insertquery = "INSERT INTO users (usertype, username, email, password) VALUES (:usertype, :username, :email, :password)";
                $queryexe = $this->db->connect()->prepare($insertquery);
                $queryexe->bindParam(":usertype", $this->usertype);
                $queryexe->bindParam(":username", $this->username);
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
                $row = $queryexe->fetch();
                if (password_verify($this->password, $row['password'])) {
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    // $_SESSION['usertype'] = $row['usertype'];
                    // $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
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




}