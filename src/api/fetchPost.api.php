<?php
require_once '../authmiddleware.php';
require_once '../classes/profile.class.php';
require_once '../sanitize.php';

$profileobj = new Profile();

checkAuth();

$properties = $profileobj->fetchpost();

header('Content-Type: text/html');


if ($properties) {
    foreach ($properties as $property) {
        echo '
        <div class="property-item shadow-sm border-2 ease-out overflow-hidden rounded-lg relative shadow-neutral-50 group">
        <div class="w-full relative overflow-hidden flex items-center group justify-center" style="height: 150px; width: 100%;">
            <button class="duration-200 group-hover:scale-105 flex items-center gap-2 p-2 rounded-md ">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg> <p class="text-2xl font-bold">Post</p>
            </button>
        </div>
        </div>
        <div class="property-item shadow-sm hover:-translate-y-2 border-2 ease-out overflow-hidden rounded-lg relative shadow-neutral-50 duration-500">
                <div class="w-full relative overflow-hidden flex items-center"  style="height: 150px; width: 100%;">
                    <img class="" src="' . htmlspecialchars($property['image']) . '" alt="Property Image">
                    <div class="cursor-pointer flex gap-2 flex-col items-start p-4 absolute custom-gradient h-full top-0 w-full justify-between" style="background: linear-gradient(to top, rgba(75, 85, 99, 0.5), rgba(75, 85, 99, 0));">
                        <div class="flex justify-between items-center w-full">
                            <div class="bg-neutral-200 rounded-full flex items-center p-1">
                                <div class="bg-neutral-700 rounded-full p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg>
                                </div>
                                <p class="font-semibold text-neutral-600/70 text-sm p-1">Starts at ₱' . htmlspecialchars($property['price']) . '</p>
                            </div>
                            
                        </div>
                        <div class="w-full">
                            <div class="flex justify-center items-center ">
                                <div class="flex-1 flex flex-col">
                                    <h2 class="text-xl font-semibold text-red-500">' . htmlspecialchars($property['property_name']) . '</h2>
                                    <p class="text-neutral-200 flex-1">' . htmlspecialchars($property['location']) . '</p>
                                </div>
                                <a class="bg-neutral-500/50 rounded-full border p-3 hover:text-red-600/80 duration-200 text-neutral-200" href="./property.php?id=' . $property['p_id'] . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

    }
} else {
    echo '<p class="text-red-500">No Saved Properties found.</p>';
}
