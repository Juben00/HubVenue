<?php
require_once './authmiddleware.php';
require_once './classes/property.class.php';
require_once './classes/saved.property.class.php';

$propertyObj = new Property();
$saveobj = new Save();

checkAuth();

// Initialize variables for the form data
$location = '';
$price = '';
$search = '';
$properties = []; // Initialize an empty array for properties

// Fetch properties based on user input
$properties = $propertyObj->viewProp($location, $price, $search);

//initailize the saved properties variable
$savedProperties = [];
$savedProperties = $saveobj->fetchSavedProperties();

// Remove numeric keys from the array
$filteredProperties = array_map(function ($property) {
    return [
        'propertyId' => $property['propertyId']
    ];
}, $savedProperties);

// echo json_encode($filteredProperties);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HubVenue</title>
    <link rel="icon" href="../public/images/white_transparent.png">
    <link rel="stylesheet" href="../output.css?v=1.5">

    <style>
        .custom-gradient {
            background: linear-gradient(to top, rgba(71, 69, 69, 0.9), rgba(75, 85, 99, 0));
        }
    </style>
</head>

<body class="bg-neutral-700 text-neutral-100 box-border">
    <?php require_once './components/Navbar.php'; ?>

    <section
        class="mx-auto flex flex-col items-center mb-4 md:mb-8 min-h-[800px] lg:min-h-0 lg:h-[85vh] overflow-hidden">
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 shadow-lg shadow-neutral-200/5 flex-1">
            <div class="relative overflow-hidden w-full sm:mt-0 mx-auto z-30 lg:h-[85vh]">
                <!-- Image Container -->
                <div id="carousel" class="flex transition-transform duration-500 h-full ">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/Inside Weddings.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/Modern And Minimalistic Museo Casa de la Bola Wedding.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/Red and white rustic wedding venue  decor with lanterns.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/marc-babin-aQWmCH_b3MU-unsplash.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/Rent Party & Event Items Portland OR.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/Black Plates & Red Roses at Head Table.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/elegant black tablescape with red roses; Ralph Lauren dinner.jpg"
                        alt="">
                </div>

                <!-- Dots Navigation -->
                <div class="absolute bottom-4 left-1/2 transform z-30 -translate-x-1/2 flex space-x-2">
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                </div>
            </div>
            <div class="flex flex-col items-center bg-neutral-200/20 p-2">
                <span class="text-center my-auto flex flex-col gap-2 ">
                    <h1 class="text-3xl font-semibold md:text-4xl ">Welcome to <span
                            class="text-red-500 italic">HubVenue!</span></h1>
                    <h3 class="sm:text-xl">"Discover Our Venue: A Perfect Setting <br> for Every Occasion"</h3>
                    <p class="sm:block hidden md:text-lg md:px-4">Discover the perfect setting for your most
                        memorable
                        events.
                        At HubVenue, we believe every occasion deserves a beautiful backdrop, whether it's a
                        wedding,
                        corporate gathering, or an intimate celebration. Nestled in a picturesque location. With
                        customizable spaces, state-of-the-art facilities, and a dedicated team to assist you,
                        HubVenue
                        is more than just a place—it's where your dreams come to life. Come explore our versatile
                        venue
                        and let us be the host to your next cherished moment.</p>
                </span>
            </div>
        </div>
    </section>

    <section class="container mx-auto flex flex-col items-center mb-4 md:mb-8 ">
        <h2 class="text-3xl lg:text-5xl font-bold mt-4">Our Services</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
            <div class="flex flex-col items-center bg-neutral-200/20 p-4 rounded-lg shadow-lg m-4">
                <img src="../public/serviceimages/pexels-pixabay-267569.jpg" alt="Rent Space" class="w-full">
                <h3 class="text-xl font-semibold mt-2 text-center">Space Rentals</h3>
                <p class="text-center">Discover unique spaces for any event, from intimate gatherings to large-scale
                    functions.</p>
            </div>
            <div class="flex flex-col items-center bg-neutral-200/20 p-4 rounded-lg shadow-lg m-4">
                <img src="../public/serviceimages/pexels-rdne-7414284.jpg" alt="Post Listings" class="w-full">
                <h3 class="text-xl font-semibold mt-2 text-center">Post Your Space</h3>
                <p class="text-center">Earn money by listing your home or commercial space for event rentals.</p>
            </div>
            <div class="flex flex-col items-center bg-neutral-200/20 p-4 rounded-lg shadow-lg m-4">
                <img src="../public/serviceimages/pexels-tima-miroshnichenko-6694575.jpg" alt="Book Event"
                    class="w-full">
                <h3 class="text-xl font-semibold mt-2 text-center">Book an Event Space</h3>
                <p class="text-center">Easily browse and book spaces for weddings, meetings, parties, and more.</p>
            </div>
        </div>
    </section>

    <section class="properties-list container mx-auto flex flex-col items-center mb-4 md:mb-8">
        <h2 class="text-3xl lg:text-5xl font-bold mt-4 mb-2">Rental Properties</h2>


        <div class="flex flex-col gap-4 md:gap-8 bg-neutral-200/20 p-4 lg:p-8 m-4 rounded-lg w-full min-h-30">

            <!-- HTML form to search properties -->
            <form id="searchForm" class="text-neutral-900 flex gap-2 justify-center w-full">
                <div class="flex">
                    <select class="p-1 py-2 w-20 lg:w-36 bg-neutral-300 rounded-lg text-neutral-900" name="location"
                        id="location">
                        <option value="">Select Location</option>
                        <?php
                        $locationlist = $propertyObj->fetchlocation();
                        foreach ($locationlist as $loc) {
                            ?>
                            <option value="<?= $loc['location'] ?>" <?= ($location == $loc['location']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($loc['location']) ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="flex">
                    <select class="p-1 py-2 w-20 md:w-36 bg-neutral-300 rounded-lg text-neutral-900" name="price"
                        id="price">
                        <option value="">Select Price</option>
                        <?php
                        $pricelist = $propertyObj->fetchprice();
                        foreach ($pricelist as $pri) {
                            ?>
                            <option value="<?= $pri['price'] ?>" <?= ($price == $pri['price']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($pri['price']) ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="flex w-1/2 relative">
                    <input placeholder="Search for a Unit" class="outline-0 p-1 py-2 bg-neutral-300 rounded-lg w-full"
                        type="text" id="search" name="search" value="<?= htmlspecialchars($search) ?>">
                    <button id="submit" type="submit" value="Search"
                        class="absolute top-1/2 -translate-y-1/2 right-2 cursor-pointer"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg></button>
                </div>

            </form>


            <hr>

            <div id="result" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6  rounded-xl">

                <?php if (!empty($properties)): ?>
                    <?php foreach ($properties as $property): ?>
                        <div
                            class="property-item shadow-sm hover:-translate-y-2 ease-out overflow-hidden rounded-lg relative shadow-neutral-50 duration-500">
                            <div class="w-full relative overflow-hidden flex items-center h-[350px]" style="height: 350px;">
                                <img class="" src="<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image">

                                <div class="cursor-pointer flex gap-2 flex-col items-start p-4 absolute custom-gradient h-full top-0 w-full justify-between"
                                    style="background: linear-gradient(to top, rgba(75, 85, 99, 0.5), rgba(75, 85, 99, 0));">

                                    <div class="flex justify-between items-center w-full">
                                        <div class="bg-neutral-200 rounded-full flex items-center p-1">
                                            <div class="bg-neutral-700 rounded-full p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                </svg>
                                            </div>
                                            <p class="font-semibold text-neutral-600/70 text-sm p-1">
                                                Starts at ₱<?php echo htmlspecialchars($property['price']); ?>
                                            </p>
                                        </div>
                                        <!-- bookmark -->

                                        <form id="bookmark-<?php echo $property['p_id']; ?>">
                                            <input type="hidden" name="propertyId" value="<?php echo $property['p_id']; ?>">
                                            <button type="submit"
                                                class="<?php echo in_array($property['p_id'], array_column($filteredProperties, "propertyId")) ? 'text-red-500' : 'text-neutral-100' ?> ">
                                                <svg xmlns=" http://www.w3.org/2000/svg" width="25" height="25"
                                                    fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2" />
                                                </svg>
                                            </button>
                                        </form>


                                    </div>

                                    <div class="w-full">
                                        <div class="flex justify-center items-center ">
                                            <div class="flex-1 flex flex-col">
                                                <h2 class="text-3xl font-semibold text-red-500">
                                                    <?php echo htmlspecialchars($property['property_name']); ?>
                                                </h2>
                                                <p class="text-neutral-200 flex-1">
                                                    <?php echo htmlspecialchars($property['location']); ?>
                                                </p>
                                            </div>

                                            <a class="bg-neutral-500/50 rounded-full border p-3 hover:text-red-600/80 duration-200 text-neutral-200"
                                                href="./property.php?id=<?php echo $property['p_id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-red-500">No properties found.</p>
                <?php endif; ?>

            </div>

        </div>


    </section>



    <section class="container mx-auto flex flex-col items-center mb-8 ">
        <h2 class="text-3xl lg:text-5xl font-semibold mt-8 mb-2">About Us</h2>

        <div class="flex flex-col gap-4 m-4">

            <div class="flex flex-col items-center bg-neutral-200/20 p-4 lg:p-8 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold  text-red-500 italic">Our Story</h3>
                <p>
                    Hubvenue was born out of the need to streamline the often complex and time-consuming process of
                    f event
                    planning. The journey began when our founders, faced with the daunting task of organizing
                    multiple
                    events, realized how fragmented the venue and catering service industry was. From endless phone
                    calls to
                    lengthy negotiations, the process was anything but easy. Inspired by the vision of a one-stop
                    platform,
                    Hubvenue was developed to centralize and simplify these interactions, allowing users to focus on
                    creating memorable experiences instead of logistics.
                </p>
                <br>
                <p>Throughout our journey, we faced challenges, such as integrating diverse services and building
                    trust
                    within the community. However, these obstacles only strengthened our commitment to innovation.
                    Hubvenue
                    continues to grow, expanding our network of partners and refining our platform based on user
                    feedback,
                    making it the ultimate event planning tool for everyone.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- mission -->
                <div class="flex flex-col items-center bg-neutral-200/20 p-4 lg:p-8 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold  text-red-500 italic">Our Mission</h3>
                    <p class="text-center">
                        Our mission is to revolutionize the way people find and book event spaces by providing a
                        dynamic
                        platform that seamlessly connects event organizers with unique venues. We aim to empower
                        property
                        owners to maximize their earning potential by offering their homes, commercial spaces, and
                        creative
                        environments as venues for a diverse range of events. Whether it's a wedding, corporate
                        meeting,
                        or
                        a casual gathering, we strive to offer a variety of spaces that cater to every occasion,
                        helping
                        make each event truly memorable.
                    </p>
                </div>
                <!-- vission -->
                <div class="flex flex-col items-center bg-neutral-200/20 p-4 lg:p-8 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold  text-red-500 italic">Our Vision</h3>
                    <p class="text-center">
                        Our vision is to be the leading platform that bridges the gap between event organizers and
                        space
                        owners, creating a global community where finding the perfect venue is as easy as a few
                        clicks.
                        We
                        envision a future where every space, from cozy homes to grand commercial venues, is
                        accessible
                        to
                        those looking to create extraordinary experiences. By fostering a collaborative environment,
                        we
                        aim
                        to inspire creativity and enable hosts and organizers to come together, turning any space
                        into a
                        potential stage for unforgettable moments.
                    </p>
                </div>
            </div>

            <!-- FAQ -->
            <div class="flex flex-col bg-neutral-200/20 p-4 lg:p-8 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-red-500 italic text-center">FAQs</h3>
                <div class="w-full ">
                    <div class="faq-item mb-4">
                        <button class="faq-header text-neutral-200 w-full text-left">
                            1. How do I book a space?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300 text-xs">To book a space, simply look for your desired
                                location
                                and
                                date on our platform. Browse
                                through the available options, select the space that suits your needs, and follow
                                the
                                booking process to confirm your reservation.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header text-neutral-200 w-full text-left">
                            2. Can I list my own space on HubVenue?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300 text-xs">Yes, you can list your space on HubVenue. Create an
                                account,
                                provide details about your
                                space, upload photos, and set your availability and pricing. Once your listing is
                                approved, it will be visible to potential renters.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header text-neutral-200 w-full text-left">
                            3. What types of spaces can I list?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300 text-xs">You can list a variety of spaces including
                                residential
                                homes,
                                commercial venues, event
                                halls, and more. The platform is designed to accommodate all types of spaces that
                                can be
                                used for events and gatherings.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header text-neutral-200 w-full text-left">
                            4. Are there any fees associated with booking or listing a space?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300 text-xs">Yes, there may be fees associated with both booking
                                and
                                listing
                                spaces. Booking fees are
                                typically a percentage of the total rental cost, while listing fees may vary based
                                on
                                the type of space and duration of the listing. Detailed information about fees will
                                be
                                provided during the booking or listing process.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header text-neutral-200 w-full text-left">
                            5. How can I contact customer support?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300 text-xs">If you need assistance, you can contact our customer
                                support
                                team via the contact form on
                                our website, or by email at info@hubvenue.com. Our team is available to help you
                                with
                                any questions or issues you may have.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <?php require_once './components/Footer.php' ?>

    <script src="./submit.js"></script>
</body>

</html>