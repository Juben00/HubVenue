<?php
require_once __DIR__ . '/authmiddleware.php';
require_once __DIR__ . '/classes/profile.class.php';

checkAuth();
$profileObj = new Profile();
$property = null;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $property = $profileObj->fetchpostandclient($_GET['id']);

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
        class="absolute left-1/2 bg-neutral-200 rounded-md max-h-[800px] max-w-[1000px] top-1/2 -translate-x-1/2 -translate-y-1/2 container mx-auto md:min-h-0 flex flex-col md:grid grid-cols-2 w-full border-2 overflow-hidden">

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
            <div class="flex flex-col gap-1 flex-grow ">
                <h1 class="text-center font-semibold">EDIT PROPERTY</h1>
                <div class="flex items-center justify-between w-full gap-1">
                    <label for="property_name">Property Name:</label>
                    <input type="text" class="flex-1 truncate px-1 rounded-sm" value="<?= $property['property_name'] ?>"
                        id="property_name" name="property_name">
                </div>

                <div class="flex items-center gap-1">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" class="text-sm p-1 flex-1 rounded-sm px-2"
                        value="<?= $property['price'] ?>">
                </div>

                <div class="flex gap-1 items-center w-full">
                    <label for="location">Location:</label>
                    <input id="location" name="location" type="text" class="p-1 flex-1 rounded-sm text-sm truncate"
                        value="<?= $property['location'] ?>">
                </div>

                <div class="flex flex-col w-full">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="text-sm px-2 py-1 resize-none"><?= htmlspecialchars($property['description']) ?></textarea>
                </div>

                <div class="flex flex-col w-full">
                    <label for="amenities">Amenities</label>
                    <textarea id="amenities" name="amenities" rows="2" class="text-sm px-2 py-1 resize-none">
                        <?php
                        $amenities = json_decode($property['amenities'], true);
                        if (is_array($amenities) && !empty($amenities)) {
                            // Convert array to a comma-separated string and trim any excess spaces
                            $amenitiesString = implode(', ', array_map(function ($value) {
                                return trim(htmlspecialchars($value));
                            }, $amenities));
                            echo trim($amenitiesString);
                        }
                        ?>
                    </textarea>
                </div>
            </div>

            <!-- Table and Add Button -->
            <div class="flex flex-col ">
                <h1>Dates Unavailable</h1>
                <div class="border-2 border-red-500 h-full flex-grow rounded-md shadow-lg">
                    <table class="w-full table-auto">
                        <thead class="bg-red-500 text-white">
                            <tr>
                                <th class="text-left p-2">Date</th>
                                <th class="p-2">Action</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="overflow-y-auto h-24"> <!-- Set the max height and allow vertical scrolling -->
                        <table class="w-full table-auto">
                            <tbody>
                                <tr class="hover:bg-gray-100 transition-colors duration-200">
                                    <td class="p-2 border-b">2024-10-04</td>
                                    <td class="p-2 border-b flex justify-center space-x-2">
                                        <button
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition duration-200">Edit</button>
                                        <button
                                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-200">Delete</button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-100 transition-colors duration-200">
                                    <td class="p-2 border-b">2024-10-04</td>
                                    <td class="p-2 border-b flex justify-center space-x-2">
                                        <button
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition duration-200">Edit</button>
                                        <button
                                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-200">Delete</button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-100 transition-colors duration-200">
                                    <td class="p-2 border-b">2024-10-04</td>
                                    <td class="p-2 border-b flex justify-center space-x-2">
                                        <button
                                            class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition duration-200">Edit</button>
                                        <button
                                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-200">Delete</button>
                                    </td>
                                </tr>
                                <!-- More rows can be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <button
                class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition duration-200">Add</button>



            <!-- Proceed To Payment Button -->
            <div class="mt-auto flex flex-col w-full">
                <input type="submit" value="Save Changes" class="bg-neutral-900 text-neutral-100 py-2 rounded-lg">
            </div>
        </form>

    </div>
</body>

</html>