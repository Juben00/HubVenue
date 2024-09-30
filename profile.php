<?php

require_once './authmiddleware.php';
require_once './classes/profile.class.php';

$profileobj = new Profile();

$profileinfo = $profileobj->fetchprofile();

checkAuth();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="./public/images/white_transparent.png">
    <link rel="stylesheet" href="./output.css?v=1.14">
</head>

<body
    class="bg-neutral-100 text-neutral-700 flex relative justify-center items-center box-border lg:h-screen lg:overflow-hidden">

    <div
        class="p-4 w-full lg:w-[1000px] bg-neutral-200 flex flex-col relative h-screen lg:grid lg:grid-cols-2 gap-4 lg:h-[600px] rounded-md ">

        <!-- upload_property_for -->
        <div class="absolute left-1/2 top-1/2 bg-neutral-700/80 -translate-y-1/2 hidden -translate-x-1/2 h-screen w-screen z-50 "
            id="upload_property_form">
            <form action="upload_property.php"
                class="absolute bg-neutral-100  z-50 w-[80%] lg:w-[60%] text-neutral-800 gap-2 left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 p-4 rounded-md flex-col"
                method="POST" enctype="multipart/form-data">
                <h1 class="font-bold text-lg md:text-2xl text-center">PROPERTY UPLOAD FORM</h1>

                <span class="text-red-500 absolute top-2 right-3 cursor-pointer" id="close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x"
                        viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </span>

                <!-- image -->
                <div class="lg:grid lg:grid-cols-2 lg:gap-2 lg:mt-2 overflow-hidden lg:h-[500px] ">
                    <!-- Image placeholder -->
                    <div class="flex flex-col relative">
                        <img id="property_pic_preview"
                            class="mb-2 h-56 object-cover w-full lg:h-full lg:mb-0 overflow-hidden" />
                        <button class="left-1/2 top-1/2 absolute -translate-y-1/2 -translate-x-1/2" id="imgtrigg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                                class="bi bi-plus-square" viewBox="0 0 16 16">
                                <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                            </svg>
                        </button>
                        <input type="file" name="property_pic" id="property_pic" accept="image/*" required
                            class="hidden">
                    </div>

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
                                placeholder="Enter property description"></textarea>
                        </div>

                        <!-- amenities (JSON format) -->
                        <div class="flex flex-col flex-1">
                            <label for="property_amenities" class="font-semibold">Amenities (Separated by
                                commas)</label>
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



        <!-- Profile section -->
        <div class="flex flex-col relative items-center justify-start p-6 space-y-4 lg:h-full pb-0">
            <div
                class="fixed left-0 top-0 p-7 bg-neutral-600 lg:p-0 z-40 lg:absolute lg:left-[2px] lg:top-[2px] w-full h-fit">
                <button onclick="window.location.href = './dashboard.php';"
                    class="fixed left-[5px] top-[14px] lg:absolute lg:left-[2px] lg:top-[2px] hover:text-red-500 duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>
                </button>
            </div>

            <div class="flex flex-col items-center h-full justify-center gap-4 relative  w-full ">

                <!-- image placeholder -->
                <div class="relative w-52 h-52 cursor-pointer border border-gray-300 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center"
                    id="uploadbtn">
                    <img src="<?= isset($profileinfo['profile_pic_url']) && $profileinfo['profile_pic_url'] ? $profileinfo['profile_pic_url'] : './public/others/placeholder-400x400.jpg'; ?>"
                        alt="Profile Picture" class="object-cover w-full h-full" id="profilePicture">
                </div>

                <!-- upload_profile_picture_form -->
                <form action="profile_upload.php"
                    class="absolute bg-neutral-100 text-neutral-800 gap-2 left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 p-4 rounded-md hidden"
                    id="upload_form" method="POST" enctype="multipart/form-data">
                    <label for="profile_pic" class="font-semibold">Upload Profile Picture</label>
                    <input type="file" name="profile_pic" accept="image/*" required>
                    <input type="submit" class="bg-neutral-700 text-neutral-100 p-2 rounded-md"
                        value="Upload Image"></input>
                </form>


                <div class="text-center">
                    <div class="text-lg font-bold capitalize leading-[.50rem]">
                        <p><?= $profileinfo['first_name'] ?> <?= $profileinfo['last_name'] ?> </p>
                        <br>
                        <span class="capitalize text-sm font-normal"
                            id="usertype"><?= $profileinfo['usertype'] ?></span>
                    </div>
                </div>

                <div class="property-item shadow-sm border md:max-w-[500px] ease-out overflow-hidden rounded-lg mt-2 w-[93%] mx-auto relative shadow-neutral-50 group hidden h-[50px] bg-neutral-400"
                    id="post_trigger">
                    <div class="w-full relative overflow-hidden flex items-center group justify-center">
                        <button
                            class="duration-200 cursor-pointer group-hover:scale-105 group-hover:text-neutral-200 flex items-center gap-2 p-2 rounded-md"
                            id="post_trigger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-plus-square" viewBox="0 0 16 16">
                                <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                            </svg>
                            <p class="font-semibold">Post New Property</p>
                        </button>
                    </div>
                </div>
                <div class="w-full border border-gray-400 rounded-md flex justify-evenly relative md:max-w-[500px]">
                    <!-- Posted -->
                    <?php
                    if ($profileinfo['usertype'] == 'client'): ?>
                        <span class="text-center leading-3 mt-1 mb-2">
                            <h1 class="font-semibold text-lg"><?= $profileinfo["posted"] ?></h1>
                            <p class="text-sm">Posted</p>
                        </span>
                        <div class="w-px bg-gray-400 h-full"></div>
                    <?php endif;
                    ?>

                    <!-- Divider -->


                    <!-- Booked -->
                    <span class="text-center leading-3 mt-1 mb-2">
                        <h1 class="font-semibold text-lg"><?= $profileinfo['booked'] ?></h1>
                        <p class="text-sm">Booked</p>
                    </span>

                    <!-- Divider -->
                    <div class="w-px bg-gray-400 h-full"></div>

                    <!-- Saved -->
                    <span class="text-center leading-3 mt-1 mb-2">
                        <h1 class="font-semibold text-lg"><?= $profileinfo['saved'] ?></h1>
                        <p class="text-sm">Saved</p>
                    </span>
                </div>


            </div>

            <!-- 
            <form action="upload.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center space-y-2">
                <input type="file" name="profilePicture" id="profilePictureInput" class="hidden">
                <button type="button" id="uploadButton" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors">Upload</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">Submit</button>
            </form>
            -->
        </div>

        <!-- Rents and Saved section -->
        <div>
            <div class="bg-neutral-300 rounded-md overflow-hidden flex justify-center max-w-[500px] mx-auto">
                <button id="posted" class="text-lg text-center flex-1 w-full h-full">Posted</button>
                <button id="rents" class="text-lg text-center flex-1 w-full h-full">Rents</button>
                <button id="saved" class="text-lg text-center flex-1 w-full h-full">Saved</button>
            </div>

            <div class="flex flex-col lg:h-[530px] lg:overflow-y-auto ">

                <!-- Inner container without fixed height -->
                <div id="profiledisp"
                    class="mt-2 flex flex-col items-center max-w-[500px] mx-auto gap-4 text-neutral-700">

                </div>

            </div>
        </div>



    </div>

    <script src="./profile.js"></script>
    <script>
        // JavaScript to trigger file upload and change button opacity
        document.getElementById('imgtrigg').addEventListener('click', (e) => {
            e.preventDefault();  // Prevent the default button behavior
            e.target.classList.add('opacity-0');  // Add the 'opacity-0' class to the button
            document.getElementById('property_pic').click();  // Trigger file input click
        });

        // JavaScript to display the image when a file is selected
        document.getElementById('property_pic').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('property_pic_preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    preview.classList.add('block');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
            }
        });
    </script>


</body>

</html>