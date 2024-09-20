<?php
require_once './classes/user.class.php';
require_once './sanitize.php';
$userObj = new User();

$message = '';
$usertype = $username = $email = $password = "";
$usertypeErr = $usernameErr = $emailErr = $passwordErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usertype = isset($_POST['user']) ? sanitizeInput($_POST['user']) : '';
    $username = isset($_POST['username']) ? sanitizeInput($_POST['username']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $password = isset($_POST['password']) ? sanitizeInput($_POST['password']) : '';

    if (empty($usertype)) {
        $usertypeErr = "* User type is required";
    }
    if (empty($username)) {
        $usernameErr = "* Username is required";
    }
    if (verifyEmail($email) === false) {
        $emailErr = "* Invalid email format";
    }
    if (empty($email)) {
        $emailErr = "* Email is required";
    }
    if (empty($password)) {
        $passwordErr = "* Password is required";
    }


    if (empty($usertypeErr) && empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
        $userObj->usertype = $usertype;
        $userObj->username = $username;
        $userObj->email = $email;
        $userObj->password = $password;

        if ($userObj->register()) {
            header("Location: .././index.php");
        } else {
            $message = $userObj->message;
        }
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css?v=1.0">
    <style>
        .bg {
            background-image: url('../public/images/pexels-creative-vix-7283.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg flex justify-center items-center min-h-screen relative box-border">
    <form method="POST"
        class="flex flex-col items-center py-4 px-6 overflow-hidden border-2 rounded-2xl border-neutral-600 bg-neutral-200/80 gap-2 shadow-2xl"
        style="width: 400px; ">
        <div class="pt-4">
            <img src="../public/images/black_transparent.png" alt="" class="h-24">
        </div>
        <h1 class="font-semibold text-xl">SIGNUP FORM</h1>
        <?php if (!empty($message)) { ?>
            <div id="error-message"
                class="absolute  left-1/2 bg-neutral-200 border-2 border-red-600  p-4 pt-0 rounded-xl overflow-auto w-96 h-fit text-center top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-start  shadow-xl text-2xl">
                <button type="button" onclick="document.getElementById('error-message').style.display='none'"
                    class=" text-red-600 font-bold  w-fit self-end">X</button>
                <?php echo $message; ?>
            </div>
        <?php } ?>


        <!-- USERTYPE Field -->
        <div class="flex flex-col w-full">
            <span class="flex items-center justify-between">
                <label for="" class="font-semibold text-sm">USERTYPE </label>
                <span class="text-red-500"><?php echo $usertypeErr; ?></span>
            </span>
            <div class="flex gap-2">
                <span class="flex items-center">
                    <input type="radio" name="user" id="user" value="user" <?php echo ($usertype === 'user') ? 'checked' : ''; ?>>
                    <label for="user">User</label>
                </span>
                <span class="flex items-center">
                    <input type="radio" name="user" id="client" value="client" <?php echo ($usertype === 'client') ? 'checked' : ''; ?>>
                    <label for="client">Client</label>
                </span>
            </div>
        </div>

        <!-- USERNAME Field -->
        <div class="flex flex-col w-full">
            <span class="flex items-center justify-between">
                <label for="username" class="font-semibold text-sm">USERNAME</label>
                <span class="text-red-500"><?php echo $usernameErr; ?></span>
            </span>
            <input type="text" class="px-2 py-1 border" placeholder="Enter Username" name="username"
                value="<?php echo htmlspecialchars($username); ?>">
        </div>

        <!-- EMAIL Field -->
        <div class="flex flex-col w-full">
            <span class="flex items-center justify-between">
                <label for="email" class="font-semibold text-sm">EMAIL</label>
                <span class="text-red-500"><?php echo $emailErr; ?></span>
            </span>
            <input type="text" class="px-2 py-1 border" placeholder="Enter Email" name="email"
                value="<?php echo htmlspecialchars($email); ?>">

        </div>

        <!-- PASSWORD Field -->
        <div class="flex flex-col w-full">
            <span class="flex items-center justify-between">
                <label for="password" class="font-semibold text-sm">PASSWORD</label>
                <span class="text-red-500"><?php echo $passwordErr; ?></span>
            </span>
            <input type="password" class="px-1 py-1 border" placeholder="Enter Password" name="password"
                value="<?php echo htmlspecialchars($password); ?>">
        </div>

        <!-- Buttons -->
        <div class="flex flex-col gap-2 mt-2 w-1/2">
            <button type="submit" class="px-3 py-2 border-2 bg-blue-700 font-semibold text-white rounded-md">SIGN
                UP</button>
            <a href=".././index.php"
                class="underline underline-offset-1 text-xs text-center hover:text-red-500 duration-150">Back to
                Login</a>
        </div>
    </form>


</body>

</html>