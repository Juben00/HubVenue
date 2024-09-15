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
    <link rel="stylesheet" href="../output.css?v=1.4">
</head>

<body class="bg-neutral-700 text-neutral-100 flex justify-center items-center box-border">

    <div class="border p-4 h-screen w-full flex flex-col">
        <div class="border border-green-500 h-[40%] p-4 flex flex-col items-center justify-center space-y-4">
            <div
                class="relative w-32 h-32 border border-gray-300 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                <img src="" alt="Profile Picture" class="object-cover w-full h-full" id="profilePicture">
            </div>
            <form action="upload.php" method="post" enctype="multipart/form-data"
                class="flex flex-col items-center space-y-2">
                <!-- Hidden file input -->
                <input type="file" name="profilePicture" id="profilePictureInput" class="hidden">
                <!-- Upload button -->
                <button type="button" id="uploadButton"
                    class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors">
                    Upload
                </button>
                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                    Submit
                </button>
            </form>
        </div>

        <div class="border border-red-500 h-full"></div>
    </div>

    <script>
        // Trigger file input on button click
        document.getElementById('uploadButton').addEventListener('click', function () {
            document.getElementById('profilePictureInput').click();
        });
    </script>
</body>

</html>