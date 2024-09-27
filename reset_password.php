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
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="./output.css" rel="stylesheet">
            <title>HubVenue - Password Reset</title>
            <link rel="icon" href="./public/images/white_transparent.png">
            <style>
                .bg {
                    background-image: url('./public/images/pexels-creative-vix-7283.jpg');
                    background-attachment: fixed;
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                }
            </style>
        </head>

        <body class="bg flex justify-center items-center min-h-screen box-border">
            <form method="POST" action="reset_password.php"
                class="flex flex-col items-center py-4 px-6 overflow-hidden border-2 rounded-2xl border-neutral-600 bg-neutral-200/80 gap-2 shadow-2xl"
                style="width: 400px;">
                <div class="pt-4">
                    <img src="./public/images/black_transparent.png" alt="" class="h-24">
                </div>
                <h1 class="font-semibold text-xl">PASSWORD RESET FORM</h1>

                <!-- Display error message if available -->
                <?php if (!empty($message)) { ?>
                    <div id="error-message"
                        class="absolute left-1/2 bg-neutral-200 border-2 border-red-600 p-4 pt-0 rounded-xl overflow-auto w-96 h-fit text-center top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-start shadow-xl text-2xl">
                        <button type="button" onclick="document.getElementById('error-message').style.display='none'"
                            class="text-red-600 font-bold w-fit self-end">X</button>
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php } ?>

                <div class="flex flex-col w-full">
                    <label for="password">New Password:</label>
                    <input type="password" name="password" id="password" class="px-2 py-1 border"
                        placeholder="Enter your New Password">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                </div>

                <!-- Buttons -->
                <div class="flex flex-col gap-2 mt-2">
                    <input type="submit"
                        class="px-3 py-2 border-2 bg-red-500 hover:text-neutral-700 duration-150 hover:bg-red-400 font-semibold text-white rounded-md">SEND
                    RESET PASSWORD</input>
                </div>
            </form>
        </body>

        </html>
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
    header("Location: index.php");
}
