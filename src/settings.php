<?php
require_once './authmiddleware.php';
require_once './classes/user.class.php';

checkAuth();

$user = new User();

$settings = $user->fetchprofile();

$first_name = $last_name = $email = $password = "";
$first_nameErr = $last_nameErr = $emailErr = $passwordErr = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->usertype = $_POST['usertype'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    //update
    // if ($user->register()) {
    //     header('Location: login.php');
    // }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="icon" href="../public/images/white_transparent.png">
    <link rel="stylesheet" href="../output.css?v=1.14">
</head>

<body
    class="bg-neutral-100 text-neutral-700 flex relative justify-center items-center box-border lg:h-screen lg:overflow-hidden">

    <div
        class="p-4 w-full lg:w-[1000px] flex flex-col relative h-screen lg:grid lg:grid-cols-2 gap-4 lg:h-[600px] rounded-md ">

        <!-- upload_property_for -->
        <form action="upload_property.php"
            class="absolute z-50 w-full gap-2 left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 p-4 rounded-md flex-col"
            method="POST" enctype="multipart/form-data">
            <h1 class="font-bold text-lg md:text-2xl text-center">SETTINGS</h1>

            <!-- image -->
            <div class="lg:grid lg:grid-cols-2 lg:gap-2 lg:mt-2 overflow-hidden lg:h-[500px] ">

                <div class="flex flex-col gap-2">
                    <!-- property name -->
                    <div class="flex flex-col">
                        <label for="property_name" class="font-semibold">Property Name</label>
                        <input type="text" name="property_name" class="px-2 py-1 border-2 " required
                            placeholder="Enter property name">
                    </div>

                    <!-- property location -->
                    <div class="flex flex-col">
                        <label for="property_location" class="font-semibold">Property Location</label>
                        <input type="text" name="property_location" class="px-2 py-1 border-2" required
                            placeholder="Enter property location">
                    </div>

                    <!-- description -->
                    <div class="flex flex-col flex-1">
                        <label for="property_description" class="font-semibold ">Property Description</label>
                        <textarea name="property_description" rows="4"
                            class="px-2 py-1 leading-5 flex-1 border-2 resize-none" required
                            placeholder="Enter property d                                           escription"></textarea>
                    </div>

                    <!-- amenities (JSON format) -->
                    <div class="flex flex-col flex-1">
                        <label for="property_amenities" class="font-semibold">Amenities (Separated by commas)</label>
                        <textarea name="property_amenities" rows="4"
                            class="px-2 py-1 leading-5 flex-1 border-2 resize-none" required
                            placeholder='e.g. Wifi, Pool, Billard Hall, Kitchen'></textarea>
                    </div>

                    <!-- price -->
                    <div class="flex flex-col">
                        <label for="property_price" class="font-semibold">Price</label>
                        <input type="number" name="property_price" class="px-2 py-1 border-2" required
                            placeholder="Enter property price">
                    </div>

                    <input type="submit" class="bg-neutral-700 text-neutral-100 p-2 rounded-md"
                        value="Upload Property"></input>
                </div>
            </div>
        </form>

    </div>

</body>

</html>