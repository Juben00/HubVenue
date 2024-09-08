<?php
require_once './authmiddleware.php';
// session_start(); // Start the session

checkAuth(); // Check if the user is logged in

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../output.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.getElementById('carousel');
            const dots = Array.from(document.querySelectorAll('.dot'));
            let currentIndex = 0;

            // Function to update the slide position
            function updateCarousel() {
                const slideWidth = carousel.children[0].clientWidth;
                carousel.style.transform = `translateX(-${currentIndex * slideWidth}px)`;

                // Update active dot
                dots.forEach((dot, index) => {
                    dot.classList.toggle('bg-red-500', index === currentIndex);
                });
            }

            // Function to move to the next slide
            function nextSlide() {
                if (currentIndex < carousel.children.length - 1) {
                    currentIndex++;
                } else {
                    currentIndex = 0; // Loop back to first slide
                }
                updateCarousel();
            }

            setInterval(nextSlide, 4000);

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentIndex = index;
                    updateCarousel();
                });
            });

            // Initialize the carousel position
            updateCarousel();
        });

        document.addEventListener('DOMContentLoaded', function () {
            const faqHeaders = document.querySelectorAll('.faq-header');

            faqHeaders.forEach(header => {
                header.addEventListener('click', function () {
                    const faqContent = this.nextElementSibling;

                    if (faqContent.classList.contains('hidden')) {
                        faqContent.classList.remove('hidden');
                    } else {
                        faqContent.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</head>

<body class="bg-neutral-700 text-neutral-100">
    <?php require_once './components/Navbar.php'; ?>
    <section class="container mx-auto flex flex-col items-center h-[90vh] md:h-[85vh] mb-4 md:mb-8">
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 h-screen sm:h-fit shadow-lg shadow-neutral-200/5">
            <div
                class=" relative overflow-hidden w-full mt-2 sm:mt-0 mx-auto border-2 sm:border-0 z-30 h-full md:h-[85vh]">
                <!-- Image Container -->
                <div id="carousel" class="flex transition-transform duration-500 h-full md:h-[85vh]">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/anusree-mohan-D3G2_dIS6q0-unsplash.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/evelina-friman-hw_sKmjb0ns-unsplash.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/jeremy-wong-weddings-K8KiCHh4WU4-unsplash.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/marc-babin-aQWmCH_b3MU-unsplash.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="../public/bgimages/ronny-rondon-UY30xVtVrqQ-unsplash.jpg" alt="">
                </div>

                <!-- Dots Navigation -->
                <div class="absolute bottom-4 left-1/2 transform z-30 -translate-x-1/2 flex space-x-2">
                    <div class="dot w-4 h-4 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-4 h-4 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-4 h-4 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-4 h-4 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-4 h-4 bg-neutral-800 rounded-full cursor-pointer"></div>
                </div>
            </div>
            <div class="flex flex-col items-center bg-neutral-200/20 p-4">
                <span class="text-center my-auto flex flex-col gap-2">
                    <h1 class="text-3xl font-semibold md:text-4xl ">Welcome to <span
                            class="text-red-500 italic">HubVenue!</span></h1>
                    <h3 class="sm:text-xl">"Discover Our Venue: A Perfect Setting <br> for Every Occasion"</h3>
                    <p class="sm:block hidden md:text-lg md:px-4">Discover the perfect setting for your most memorable
                        events.
                        At HubVenue, we believe every occasion deserves a beautiful backdrop, whether it's a wedding,
                        corporate gathering, or an intimate celebration. Nestled in a picturesque location. With
                        customizable spaces, state-of-the-art facilities, and a dedicated team to assist you, HubVenue
                        is more than just a place—it's where your dreams come to life. Come explore our versatile venue
                        and let us be the host to your next cherished moment.</p>
                </span>
            </div>
        </div>
    </section>

    <section class="container mx-auto flex flex-col items-center mb-4 md:mb-8">
        <h2 class="text-3xl font-semibold mt-8">Our Services</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
            <div class="flex flex-col items-center bg-neutral-200/20 p-4 rounded-lg shadow-lg">
                <img src="../public/serviceimages/pexels-pixabay-267569.jpg" alt="Rent Space" class="w-full">
                <h3 class="text-xl font-semibold mt-2">Space Rentals</h3>
                <p class="text-center">Discover unique spaces for any event, from intimate gatherings to large-scale
                    functions.</p>
            </div>
            <div class="flex flex-col items-center bg-neutral-200/20 p-4 rounded-lg shadow-lg">
                <img src="../public/serviceimages/pexels-rdne-7414284.jpg" alt="Post Listings" class="w-full">
                <h3 class="text-xl font-semibold mt-2">Post Your Space</h3>
                <p class="text-center">Earn money by listing your home or commercial space for event rentals.</p>
            </div>
            <div class="flex flex-col items-center bg-neutral-200/20 p-4 rounded-lg shadow-lg">
                <img src="../public/serviceimages/pexels-tima-miroshnichenko-6694575.jpg" alt="Book Event"
                    class="w-full">
                <h3 class="text-xl font-semibold mt-2">Book an Event Space</h3>
                <p class="text-center">Easily browse and book spaces for weddings, meetings, parties, and more.</p>
            </div>
        </div>
    </section>

    <section class="container mx-auto flex flex-col items-center mb-8 ">
        <h2 class="text-3xl font-semibold mt-8">About Us</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            <div class="flex flex-col items-center bg-neutral-200/20 p-4 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold  text-red-500 italic">Our Mission</h3>
                <p class="text-center">
                    Our mission is to revolutionize the way people find and book event spaces by providing a dynamic
                    platform that seamlessly connects event organizers with unique venues. We aim to empower property
                    owners to maximize their earning potential by offering their homes, commercial spaces, and creative
                    environments as venues for a diverse range of events. Whether it's a wedding, corporate meeting, or
                    a casual gathering, we strive to offer a variety of spaces that cater to every occasion, helping
                    make each event truly memorable.
                </p>
            </div>
            <div class="flex flex-col items-center bg-neutral-200/20 p-4 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold  text-red-500 italic">Our Vision</h3>
                <p class="text-center">
                    Our vision is to be the leading platform that bridges the gap between event organizers and space
                    owners, creating a global community where finding the perfect venue is as easy as a few clicks. We
                    envision a future where every space, from cozy homes to grand commercial venues, is accessible to
                    those looking to create extraordinary experiences. By fostering a collaborative environment, we aim
                    to inspire creativity and enable hosts and organizers to come together, turning any space into a
                    potential stage for unforgettable moments.
                </p>
            </div>
            <div class="flex flex-col  bg-neutral-200/20 p-4 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-red-500 italic text-center">FAQs</h3>
                <div class="w-full ">
                    <div class="faq-item mb-4">
                        <button class="faq-header text-lg font-semibold text-neutral-200 w-full text-left">
                            1. How do I book a space?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300">To book a space, simply look for your desired location and
                                date on our platform. Browse
                                through the available options, select the space that suits your needs, and follow the
                                booking process to confirm your reservation.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header text-lg font-semibold text-neutral-200 w-full text-left">
                            2. Can I list my own space on HubVenue?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300">Yes, you can list your space on HubVenue. Create an account,
                                provide details about your
                                space, upload photos, and set your availability and pricing. Once your listing is
                                approved, it will be visible to potential renters.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header text-lg font-semibold text-neutral-200 w-full text-left">
                            3. What types of spaces can I list?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300">You can list a variety of spaces including residential homes,
                                commercial venues, event
                                halls, and more. The platform is designed to accommodate all types of spaces that can be
                                used for events and gatherings.</p>
                        </div>
                    </div>
                    <!-- <div class="faq-item mb-4">
                        <button class="faq-header text-lg font-semibold text-neutral-200 w-full text-left">
                            4. How do I cancel a booking?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300">To cancel a booking, log in to your account and navigate to your
                                bookings. Select the
                                booking you wish to cancel and follow the instructions provided. Note that cancellation
                                policies may vary depending on the space owner's terms.</p>
                        </div>
                    </div> -->
                    <div class="faq-item mb-4">
                        <button class="faq-header text-lg font-semibold text-neutral-200 w-full text-left">
                            4. Are there any fees associated with booking or listing a space?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300">Yes, there may be fees associated with both booking and listing
                                spaces. Booking fees are
                                typically a percentage of the total rental cost, while listing fees may vary based on
                                the type of space and duration of the listing. Detailed information about fees will be
                                provided during the booking or listing process.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header text-lg font-semibold text-neutral-200 w-full text-left">
                            5. How can I contact customer support?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-neutral-300">If you need assistance, you can contact our customer support
                                team via the contact form on
                                our website, or by email at info@hubvenue.com. Our team is available to help you with
                                any questions or issues you may have.</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <?php require_once './components/Footer.php' ?>

</body>

</html>