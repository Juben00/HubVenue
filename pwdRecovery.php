<?php
require_once './src/classes/user.class.php';
require_once './src/sanitize.php';
require_once './src/authmiddleware.php';

redirectIfAuth();

$userObj = new User();
$message = '';
$email = "";
$emailErr = "";


date_default_timezone_set('Asia/Manila');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';

    if (verifyEmail($email) === false) {
        $emailErr = "* Invalid email format";
    }
    if (empty($email)) {
        $emailErr = "* Email is required";
    }
    if (empty($emailErr)) {
        // Proceed to send the password recovery email
        require_once './send_recovery_email.php';

        $message = "If the email exists in our system, a recovery link has been sent.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>HubVenue - Password Recovery</title>
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
    <form method="POST"
        class="flex flex-col items-center py-4 px-6 overflow-hidden border-2 rounded-2xl border-neutral-600 bg-neutral-200/80 gap-2 shadow-2xl"
        style="width: 400px;">
        <div class="pt-4">
            <img src="./public/images/black_transparent.png" alt="" class="h-24">
        </div>
        <h1 class="font-semibold text-xl">PASSWORD RECOVERY FORM</h1>

        <!-- Display error message if available -->
        <?php if (!empty($message)) { ?>
            <div id="error-message"
                class="absolute left-1/2 bg-neutral-200 border-2 border-red-600 p-4 pt-0 rounded-xl overflow-auto w-96 h-fit text-center top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-start shadow-xl text-2xl">
                <button type="button" onclick="document.getElementById('error-message').style.display='none'"
                    class="text-red-600 font-bold w-fit self-end">X</button>
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php } ?>

        <!-- EMAIL Field -->
        <div class="flex flex-col w-full">
            <label for="email" class="font-semibold text-sm">EMAIL</label>
            <input type="text" id="email" name="email" class="px-2 py-1 border" placeholder="Enter your Recovery Email"
                value="<?php echo htmlspecialchars($email); ?>">
            <span class="text-red-500">
                <?php echo $emailErr; ?>
            </span>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col gap-2 mt-2">
            <button type="submit"
                class="px-3 py-2 border-2 bg-red-500 hover:text-neutral-700 duration-150 hover:bg-red-400 font-semibold text-white rounded-md">SEND
                RECOVERY LINK</button>
            <a href="./index.php"
                class="underline underline-offset-1 text-xs text-center hover:text-red-500 duration-150">Back to
                Login</a>
        </div>
    </form>
</body>

</html>