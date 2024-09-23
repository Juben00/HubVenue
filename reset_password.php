<?php

require_once './src/dbconnection.php';

$db = new Database();

date_default_timezone_set('Asia/Manila');

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $conn = $db->connect();
    $query = $conn->prepare("SELECT * FROM users WHERE token = :token AND expires_at > NOW()");
    $query->bindParam(":token", $token);
    $query->execute();
    $user = $query->fetch();

    if ($user) {
        // Show the reset password form
        ?>
        <form method="POST" action="reset_password.php">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Reset Password</button>
        </form>
        <?php
    } else {
        echo "Invalid or expired token.";
    }
} elseif (isset($_POST['token']) && isset($_POST['password'])) {
    // Handle the form submission
    $token = $_POST['token'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Update the user's password in the database

    $conn = $db->connect();
    $query = $conn->prepare("UPDATE users SET password = :password, token = NULL, expires_at = NULL WHERE token = :token");
    $query->bindParam(":password", $new_password);
    $query->bindParam(":token", $token);
    $query->execute();

    // $pdo->prepare("UPDATE users SET password = ?, token = NULL, expires_at = NULL WHERE token = ?")
    //     ->execute([$new_password, $token]);

    echo "Your password has been reset successfully!";
}
