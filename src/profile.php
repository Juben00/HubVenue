<?php

require_once './authmiddleware.php';

checkAuth();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="../public/images/white_transparent.png">
    <link rel="stylesheet" href="../output.css?v=1.9">
</head>

<body
    class="bg-neutral-700/80 text-neutral-100 flex justify-center items-center box-border lg:h-screen lg:overflow-hidden">

    <div class="p-4 w-full lg:w-[1000px] flex flex-col lg:grid lg:grid-cols-2 gap-4 lg:h-[600px] ">

        <!-- Profile section -->
        <div class="flex flex-col relative items-center justify-center p-6 space-y-4 lg:h-full">
            <div
                class="fixed left-0 top-0 p-7 bg-neutral-600 lg:p-0 z-50 lg:absolute lg:left-[2px] lg:top-[2px] w-full h-fit">
                <button onclick="window.history.back()"
                    class="fixed left-[5px] top-[10px] lg:absolute lg:left-[2px] lg:top-[2px] hover:text-red-500 duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                        class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>
                </button>
            </div>
            <div
                class="relative w-32 h-32 border border-gray-300 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                <img src=".././public/others/placeholder-400x400.jpg" alt="Profile Picture"
                    class="object-cover w-full h-full" id="profilePicture">
            </div>
            <div class="text-center">
                <p class="text-lg font-bold">Sample Name</p>
                <p class="text-neutral-200">User</p>
            </div>
            <div class="flex flex-col w-full items-center">
                <p class="w-[90%] text-center text-neutral-200">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Ad, officia cupiditate voluptas saepe id fugiat.</p>
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
            <div class="bg-neutral-500 px-2 py-1 flex justify-center space-x-2">
                <h1 class="text-lg font-semibold text-center flex-1">Posted</h1>
                <h1 class="text-lg font-semibold text-center flex-1">Rents</h1>
                <h1 class="text-lg font-semibold text-center flex-1">Saved</h1>
            </div>
            <div class="flex flex-col lg:h-[530px] lg:overflow-y-auto">

                <!-- Inner container without fixed height -->
                <div class="mt-2 flex flex-col gap-2  px-4">
                    <div class="border-2 flex justify-center items-center rounded-md h-[250px]">
                        <p>Item 1</p>
                    </div>
                    <div class="border-2 flex justify-center items-center rounded-md h-[250px]">
                        <p>Item 2</p>
                    </div>
                    <div class="border-2 flex justify-center items-center rounded-md h-[250px]">
                        <p>Item 3</p>
                    </div>
                    <div class="border-2 flex justify-center items-center rounded-md h-[250px]">
                        <p>Item 3</p>
                    </div>
                    <div class="border-2 flex justify-center items-center rounded-md h-[250px]">
                        <p>Item 3</p>
                    </div>
                    <div class="border-2 flex justify-center items-center rounded-md h-[250px]">
                        <p>Item 3</p>
                    </div>
                    <div class="border-2 flex justify-center items-center rounded-md h-[250px]">
                        <p>Item 3</p>
                    </div>
                    <div class="border-2 flex justify-center items-center rounded-md h-[250px]">
                        <p>Item 3</p>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script>
        // Trigger file input on button click
        // document.getElementById('uploadButton').addEventListener('click', function () {
        //     document.getElementById('profilePictureInput').click();
        // });
    </script>
</body>

</html>