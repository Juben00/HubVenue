<?php
require_once __DIR__ . '/authmiddleware.php';
require_once __DIR__ . '/classes/profile.class.php';

checkAuth();
$profileObj = new Profile();
$property = null;
$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $property = $profileObj->fetchpostandclient($id);

        // echo "<pre>";
        // print_r($property);
        // echo "</pre>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
    <link rel="stylesheet" href="./output.css?v=1.4">
</head>

<body>
    <div
        class="absolute left-1/2 bg-neutral-200 rounded-md md:max-h-[800px] max-w-[1000px] top-1/2 -translate-x-1/2 -translate-y-1/2 container mx-auto md:min-h-0 flex flex-col md:grid grid-cols-2 w-full border-2 overflow-hidden">
        <div id="addDate"
            class="hidden absolute items-center left-1/2 top-1/2 -translate-y-1/2 flex-col -translate-x-1/2 border-red-500 bg-neutral-50 border p-6 z-50">
            <button class="absolute right-2 top-2 text-red-500" id="closeAdd">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x"
                    viewBox="0 0 16 16">
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                </svg>
            </button>
            <img src="./public/images/black_transparent.png" alt="myLogo" class="w-24" class=" border-2 border-red-500">
            <h1>Please select a date to mark <span class="italic text-center text-red-500">Unavailable</span></h1>
            <form action="" class="mt-4 flex flex-col gap-1 md:flex-row">
                <input type="text" name="id" value="<?= $id ?>" class="hidden">
                <input type="date" class="border-2 border-red-500 rounded-md p-1 ">
                <button
                    class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-200">Add</button>
            </form>
        </div>
        <!-- Image Section -->
        <div
            class="h-[380px] object-cover overflow-hidden order-1 md:order-2 md:h-[1000px] relative max-h-[600px] max-w-[1000px]">
            <div class="absolute top-0 w-full h-full">
                <button onclick="window.history.back()" class="absolute text-red-500 right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-x"
                        viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </button>
            </div>
            <img src="<?= $property['image'] ?>" alt="Property Image" class="w-full h-full">
        </div>

        <!-- Edit Form Section -->
        <form
            class="flex flex-col bg-neutral-200 p-6 pt-4 gap-1 text-neutral-800 order-2 md:order-1 overflow-y-hidden h-full">
            <div class="flex flex-col gap-1 ">
                <h1 class="text-center font-semibold">EDIT PROPERTY</h1>
                <div class="flex items-center justify-between w-full gap-1 text-sm">
                    <label for="property_name ">Property Name:</label>
                    <input type="text" class="flex-1 truncate px-1 rounded-sm" value="<?= $property['property_name'] ?>"
                        id="property_name" name="property_name">
                </div>

                <div class="flex items-center gap-1 text-sm">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" class=" flex-1 rounded-sm px-1"
                        value="<?= $property['price'] ?>">
                </div>

                <div class="flex gap-1 items-center w-full text-sm">
                    <label for="location">Location:</label>
                    <input id="location" name="location" type="text" class="px-1 flex-1 rounded-sm "
                        value="<?= $property['location'] ?>">
                </div>

                <div class="flex flex-col w-full text-sm">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class=" px-1 resize-none"><?= htmlspecialchars($property['description']) ?></textarea>
                </div>

                <div class="flex flex-col w-full text-sm">
                    <label for="amenities">Amenities</label>
                    <textarea id="amenities" name="amenities" rows="2" class="px-1 resize-none text-left"><?php
                    $amenities = json_decode($property['amenities'], true);
                    if (is_array($amenities) && !empty($amenities)) {
                        // Convert array to a comma-separated string and trim any excess spaces
                        $amenitiesString = implode(', ', array_map(function ($value) {
                            return trim(htmlspecialchars($value));
                        }, $amenities));
                        echo trim($amenitiesString);
                    }
                    ?></textarea>
                </div>
            </div>

            <!-- Table and Add Button -->
            <div class="flex flex-col border border-neutral-700 h-full my-2 bg-neutral-50 rounded-lg overflow-hidden">
                <span class="flex items-center justify-between px-4 py-2">
                    <h1 class="text-center font-semibold">Dates Unavailable</h1>
                    <button id="adddateTrigger"
                        class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition duration-200">Add</button>
                </span>


                <div class="h-full flex-grow rounded-md shadow-lg">
                    <table class="w-full table-auto ">
                        <thead class="font-semibold">
                            <tr>
                                <th class="text-center p-2">Date</th>
                                <th class="p-2">Action</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="overflow-y-auto h-24 md:h-36"> <!-- Set the max height and allow vertical scrolling -->
                        <table class="w-full table-auto ">
                            <tbody>
                                <!-- <tr class="hover:bg-gray-100  text-center transition-colors duration-200">
                                    <td class="p-2 border-b">2024-10-04</td>
                                    <td class="p-2 border-b flex justify-center space-x-2">
                                        <button
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition duration-200">Edit</button>
                                        <button
                                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-200">Delete</button>
                                    </td>
                                </tr> -->
                                <!-- More rows can be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Proceed To Payment Button -->
            <div class="mt-auto flex flex-col w-full">
                <input type="submit" value="Save Changes" class="bg-neutral-900 text-neutral-100 py-2 rounded-lg">
            </div>
        </form>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addButton = document.getElementById('adddateTrigger');
            const popover = document.getElementById('addDate');
            const closeAdd = document.getElementById('closeAdd');

            addButton.addEventListener('click', function (event) {
                event.preventDefault();
                popover.classList.add('flex');
                popover.classList.remove('hidden');
            });

            closeAdd.addEventListener('click', function (event) {
                event.preventDefault();
                popover.classList.add('hidden');
                popover.classList.remove('flex');
            });

        });
    </script>
</body>

</html>