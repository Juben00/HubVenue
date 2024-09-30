<?php
require_once '../authmiddleware.php';
require_once '../classes/property.class.php';
require_once '../sanitize.php';

// Initialize the Property object
$propertyObj = new Property();

// Check if the user is logged in
// checkAuth();

// Initialize variables for the form data
$location = '';
$price = '';
$search = '';
$properties = []; // Initialize an empty array for properties

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and assign form input values
    $location = sanitizeInput($_POST['location'] ?? '');
    $price = sanitizeInput($_POST['price'] ?? '');
    $search = sanitizeInput($_POST['search'] ?? '');

    // Fetch properties based on user input
    $properties = $propertyObj->viewProp($location, $price, $search);

    // Output the result as HTML
    if ($properties) {
        foreach ($properties as $property) {
            echo '<a class="property-item shadow-sm hover:-translate-y-2 group ease-out overflow-hidden rounded-lg relative shadow-neutral-50 duration-500" href="./property.php?id=' . $property['p_id'] . '">
                <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-40 absolute left-1/2 top-1/2 text-red-500 -translate-y-1/2 -translate-x-1/2"
                    xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                    <path
                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                </svg>
                <div class="w-full relative overflow-hidden flex items-center" style="height: 350px;">
                    <img class="" src="' . htmlspecialchars($property['image']) . '" alt="Property Image">
                    <div class="cursor-pointer flex gap-2 flex-col items-start p-4 absolute custom-gradient h-full top-0 w-full justify-between">
                        <div class="flex justify-between items-center w-full">
                            <div class="bg-neutral-200 rounded-full flex items-center p-1">
                                <div class="bg-red-500 rounded-full p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" class="text-neutral-100" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg>
                                </div>
                                <p class="font-semibold text-neutral-600/70 text-sm p-1">Starts at ₱' . htmlspecialchars($property['price']) . '</p>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="flex justify-center items-center ">
                                <div class="flex-1 flex flex-col">
                                    <h2 class="text-3xl font-semibold text-red-500">' . htmlspecialchars($property['property_name']) . '</h2>
                                    <p class="text-neutral-200 flex-1">' . htmlspecialchars($property['location']) . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>';

        }
    } else {
        echo '<p class="text-red-500">No properties found.</p>';
    }
} else {
    // Handle non-POST requests
    http_response_code(405); // Method Not Allowed
    echo '<p class="text-red-500">Invalid request method. Only POST requests are allowed.</p>';
}
