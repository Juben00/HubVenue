<?php
require_once __DIR__ . '/authmiddleware.php';
require_once __DIR__ . '/classes/property.class.php';

$property = new Property();

$item = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET['id'];
    $item = $property->fetchfocus($id);
}

checkAuth(); // Check if the user is logged in

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" href="../public/images/white_transparent.png">
    <link rel="stylesheet" href="../output.css?v=1.4"> <!-- Increment version number -->
</head>

<body class="bg-neutral-700 text-neutral-100 relative h-screen">
    <div
        class="absolute left-1/2 rounded-md max-h-[600px] max-w-[1000px] top-1/2 -translate-x-1/2 -translate-y-1/2 container mx-auto min-h-screen md:min-h-0 flex flex-col md:grid grid-cols-2 w-full border-2 overflow-hidden">

        <div class="h-[380px] object-cover overflow-hidden order-1  md:h-[1000px] max-h-[600px] max-w-[1000px]">

            <img src="<?= $item['image'] ?>" alt="Property Image" class="w-full h-full">
        </div>

        <div
            class="flex flex-col bg-neutral-100 p-6 relative overflow-x-hidden pt-4 text-neutral-800 order-2 md:order-1 overflow-y-scroll flex-1">
            <div class="absolute top-0  right-1">
                <button onclick="window.history.back()" class="absolute right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-x"
                        viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-col h-full mt-2">
                <div>
                    <div class="flex items-center justify-between w-full">
                        <span class="flex items-center gap-2">
                            <p class="text-red-500 flex-1 text-2xl truncate">
                                <?= $item['property_name'] ?>
                            </p>
                        </span>
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                            </svg>
                            <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($item['location']) ?>"
                                target="_blank" class="text-neutral-600 underline underline-offset-1 text-sm truncate">
                                <?= $item['location'] ?>
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center gap-1">
                        <p class="text-green-500 p-1 rounded-md">Available</p>
                    </div>



                    <div class="mt-2 flex flex-col w-full">
                        <p class="text-sm"><?= $item['description'] ?></p>
                    </div>

                </div>

                <form class="mt-auto flex flex-col w-full gap-2 h-full">
                    <h1 class="text-center font-semibold">BOOKING INFORMATION</h1>

                    <!-- Number of Attendees -->
                    <div class="flex flex-col gap-1">
                        <label for="attendees" class="text-sm">Number of Attendees</label>
                        <input type="number" name="attendees" id="attendees" placeholder="Enter Number of Attendees"
                            class="p-2 py-1 border-2 border-neutral-800/30 outline-none rounded-md flex-1">
                    </div>

                    <!-- Date selection -->
                    <div class="flex flex-col gap-1">
                        <label for="date" class="text-sm">Select Date</label>
                        <input type="date" name="date" id="date"
                            class="p-2 py-1 border-2 border-neutral-800/30 outline-none rounded-md flex-1">
                    </div>

                    <!-- Time selection -->
                    <div class="flex flex-row justify-around gap-2">
                        <div class="flex flex-col gap-1 w-full">
                            <label for="starttime" class="text-xs">Start Time</label>
                            <input type="time" name="starttime" id="starttime"
                                class="p-2 py-1 border-2 border-neutral-800/30 outline-none rounded-md flex-1">
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <label for="endtime" class="text-xs">End Time</label>
                            <input type="time" name="endtime" id="endtime"
                                class="p-2 py-1 border-2 border-neutral-800/30 outline-none rounded-md flex-1">
                        </div>
                    </div>

                    <!-- Payment method selection -->
                    <div class="flex flex-col gap-1">
                        <label for="payment" class="text-sm">Payment Method</label>
                        <select name="payment" id="payment"
                            class="p-2 py-1 border-2 border-neutral-800/30 outline-none rounded-md flex-1">
                            <option value="" class="text-neutral-800/50">Specify Your Payment Method</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Gcash">Gcash</option>
                            <option value="PayMaya">PayMaya</option>
                            <option value="PayPal">PayPal</option>
                        </select>
                    </div>

                    <!-- Payment credentials container -->
                    <div id="paymentCredentials"></div>

                    <!-- Book Now Button -->
                    <div class="mt-auto flex">
                        <button type="submit" class="bg-neutral-900 text-neutral-50 p-2 rounded-md w-full">
                            Book Now
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>


    <script>
        // check the type of payment method
        document.getElementById("payment").addEventListener("change", function () {
            let payment = document.getElementById("payment").value;
            let paymentCredentials = document.getElementById("paymentCredentials");

            if (payment == "Bank Transfer") {
                paymentCredentials.innerHTML = `
                    <div class="flex flex-col gap-1">
                        <label for="paymentinfo" class="text-sm">Account Number</label>
                        <input type="text" name="paymentinfo" id="paymentinfo" placeholder="Enter Bank Account Number"
                            class="p-2 py-1 border-2 border-neutral-800/30 outline-none rounded-md flex-1">
                    </div>
                `;
            } else if (payment == "Gcash") {
                paymentCredentials.innerHTML = `
                    <div class="flex flex-col gap-1">
                        <label for="paymentinfo" class="text-sm">Gcash Number</label>
                        <input type="text" name="paymentinfo" id="paymentinfo" placeholder="Enter Account Gcash Number"
                            class="p-2 py-1 border-2 border-neutral-800/30 outline-none rounded-md flex-1">
                    </div>
                `;
            } else if (payment == "PayMaya") {
                paymentCredentials.innerHTML = `
                    <div class="flex flex-col gap-1">
                        <label for="paymentinfo" class="text-sm">PayMaya Number</label>
                        <input type="text" name="paymentinfo" id="paymentinfo" placeholder="Enter PayMaya Account Number"
                            class="p-2 py-1 border-2 border-neutral-800/30 outline-none rounded-md flex-1">
                    </div>
                `;
            } else if (payment == "PayPal") {
                paymentCredentials.innerHTML = `
                    <div class="flex flex-col gap-1">
                        <label for="paymentinfo" class="text-sm">PayPal Email</label>
                        <input type="email" name="paymentinfo" id="paymentinfo" placeholder="Enter PayPal Account Number"
                            class="p-2 py-1 border-2 border-neutral-800/30 outline-none rounded-md flex-1">
                    </div>
                `;
            } else {
                paymentCredentials.innerHTML = "";
            }
        });
    </script>
</body>



</html>