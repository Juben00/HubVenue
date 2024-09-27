<?php
require_once __DIR__ . '/authmiddleware.php';
require_once __DIR__ . '/classes/property.class.php';
require_once __DIR__ . '/classes/booking.class.php';
require_once __DIR__ . '/classes/saved.property.class.php';

$property = new Property();
$bookedobj = new Booking();

$item = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET['id'];
    $item = $property->fetchfocus($id);

}
$savedProperties = [];
$savedProperties = $saveobj->fetchSavedProperties();

// Remove numeric keys from the array
$filteredProperties = array_map(function ($property) {
    return [
        'propertyId' => $property['propertyId']
    ];
}, $savedProperties);

checkAuth(); // Check if the user is logged in

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus</title>
    <link rel="icon" href="../public/images/white_transparent.png">
    <link rel="stylesheet" href="../output.css?v=1.4"> <!-- Increment version number -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> <!-- Leaflet CSS -->
</head>

<body class="bg-neutral-700 text-neutral-100 relative h-screen box-border">
    <div
        class="absolute left-1/2 rounded-md max-h-[800px] max-w-[1000px] top-1/2 -translate-x-1/2 -translate-y-1/2 container mx-auto md:min-h-0 flex flex-col md:grid grid-cols-2 w-full border-2 overflow-hidden">

        <div
            class="h-[380px] object-cover overflow-hidden order-1 md:order-2 md:h-[1000px] relative max-h-[600px] max-w-[1000px]">
            <div class="absolute top-0 w-full h-full bg-gradient-to-b from-transparent to-neutral-900 opacity-50">
                <button onclick="window.history.back()" class="absolute right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-x"
                        viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </button>
            </div>
            <img src="<?= $item['image'] ?>" alt="Property Image" class="w-full h-full">
        </div>

        <div class="flex flex-col bg-neutral-100 p-6 pt-4 text-neutral-800 order-2 md:order-1 overflow-y-scroll flex-1">
            <div class="flex flex-col gap-1 h-full">
                <div>
                    <!-- Map container -->
                    <div id="map" class="h-[200px] w-full rounded-md border-2 mb-2 hidden md:block"
                        style="height: 180px;">
                    </div>

                    <div class="flex items-center justify-between w-full">
                        <span class="flex items-center gap-2">
                            <p class="text-red-500 flex-1 text-2xl truncate">
                                <?= $item['property_name'] ?>
                            </p>
                        </span>

                        <!-- bookmark -->
                        <form id="bookmark-<?php echo $item['p_id']; ?>">
                            <input type="hidden" name="propertyId" value="<?php echo $item['p_id']; ?>">

                            <?php echo in_array($item['p_id'], array_column($filteredProperties, "propertyId")) ?
                                '<input type="submit" class="text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
</svg>
                                </input>'
                                :
                                '<input type="submit" class="" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                                </svg>
                            </input>';
                            ?>


                        </form>
                    </div>

                    <div class="flex items-center gap-1">
                        <p class="text-sm font-semibold p-1 border bg-neutral-200 rounded-full px-2">Php
                            <?= $item['price'] ?>
                        </p>
                        <p class="text-green-500 p-1 rounded-md">Available</p>
                    </div>

                    <div class="flex gap-1 items-center my-1 w-[90%]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                            class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                        </svg>
                        <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($item['location']) ?>"
                            target="_blank" class="text-neutral-600 underline underline-offset-1 text-sm truncate">
                            <?= $item['location'] ?>
                        </a>
                    </div>

                    <div class="mt-2 flex flex-col w-full">
                        <p class="text-sm"><?= $item['description'] ?></p>
                    </div>

                    <div class="my-2  flex flex-col w-full">
                        <h1 class="text-center font-semibold">AMENITIES</h1>
                        <?php
                        $amenities = json_decode($item['amenities'], true);

                        if (is_array($amenities)) {
                            echo '<ul class="list-disc list-inside">';
                            foreach ($amenities as $key => $value) {
                                echo '<li>' . htmlspecialchars($value) . '</li>';
                            }
                            echo '</ul>';
                        } else {
                            echo '<p class="text-center">No amenities listed.</p>';
                        }
                        ?>
                    </div>


                </div>
            </div>
            <div class="mt-auto flex flex-col w-full">
                <a href="./payment.php?id=<?php echo $item['p_id']; ?>"
                    class="bg-neutral-900 text-neutral-50 px-2 py-3 rounded-md text-center">Proceed To
                    Payment</a>
            </div>
        </div>

    </div>

</body>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Initialize i map
    const map = L.map('map').setView([6.9121, 122.0790], 13); // Default center: Zamboanga City Hall


    // Add the OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Fetch the address from the PHP variable
    const address = `<?= $item['location'] ?>`;

    // Use Nominatim API to geocode the address
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                const lat = parseFloat(data[0].lat);
                const lon = parseFloat(data[0].lon);

                // Center the map on the searched location
                map.setView([lat, lon], 15);

                // Add a marker at the searched location
                L.marker([lat, lon]).addTo(map)
                    .bindPopup(address)
                    .openPopup();
            } else {
                console.log('Address not found!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to fetch location. Please try again.');
        });

</script>
<script src="./submit.js"></script>

</html>