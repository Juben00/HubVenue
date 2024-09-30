<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

require_once './dbconnection.php';

$db = new Database();

date_default_timezone_set('Asia/Manila');

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $conn = $db->connect();
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user) {

        $token = bin2hex(random_bytes(50));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $conn->prepare("UPDATE users SET token = :token, expires_at = :expires_at WHERE email = :email");
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expires_at', $expiresAt);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kleosixth@gmail.com';
            $mail->Password = 'einc idxy mmkq rgre';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('kleosixth@gmail.com', 'HubVenue');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = 'Click the link to reset your password: '
                . '<a href="http://localhost/hub/reset_password.php?token=' . $token . '">Reset Password</a>';
            $mail->AltBody = 'Click the link to reset your password: http://localhost/hub/reset_password.php?token=' . $token;
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email address not found.";
    }
}

