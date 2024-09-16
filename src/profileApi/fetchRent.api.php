<?php
require_once '../authmiddleware.php';
require_once '../classes/profile.class.php';
require_once '../sanitize.php';

$profileobj = new Profile();

checkAuth();

$rented = $profileobj->fetchrent();

header('Content-Type: text/html');

if (!empty($rented)) {
    foreach ($rented as $rent) {

        echo '
            <div class="property-item shadow-sm hover:-translate-y-2 ease-out overflow-hidden rounded-lg relative shadow-neutral-50 duration-500 border-2  flex">
                <div class="w-full relative overflow-hidden flex items-center" style="height: 150px; width: 150px;">
                    <img class="" src="' . htmlspecialchars($rent['image']) . '" alt="Property Image">
                    <div class="cursor-pointer flex gap-2 flex-col items-start p-4 absolute custom-gradient h-full top-0 w-full justify-between" style="background: linear-gradient(to top, rgba(75, 85, 99, 0.5), rgba(75, 85, 99, 0));">
                        <div class="w-full h-full flex justify-center items-center">
                            <div class="flex justify-center items-center opacity-0 hover:opacity-100">
                                <a class="bg-neutral-500/50 rounded-full border p-3 hover:text-red-600/80 duration-200 text-neutral-200" href="./property.php?id=' . $rent['p_id'] . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="p-2">
                        <p class="text-lg font-bold">' . htmlspecialchars($rent['property_name']) . '</p>
                        <p class="text-neutral-200 text-xs">Location: ' . htmlspecialchars($rent['location']) . '</p>
                        <p class="text-neutral-200 text-xs">Amount: Php ' . htmlspecialchars($rent['amount']) . '</p>
                        <p class="text-neutral-200 text-xs">Payment Method: ' . htmlspecialchars($rent['payment_method']) . '</p>
                        <p class="text-neutral-200 text-xs">Date and Time: ' . htmlspecialchars($rent['start_date']) . " at " . date("h:i A", strtotime($rent['check_in'])) . '</p>
                        <p class="text-neutral-200 text-xs"><span class="text-red-500">Ends On</span>: ' . htmlspecialchars($rent['end_date']) . " at " . date("h:i A", strtotime($rent['check_out'])) . '</p>
                    </div>
                </div>
            </div>';


        // '<div class="border-2 flex justify-center items-center rounded-md h-[250px]">
        //         <p>item 1</p>
        //         </div>';
        // <p>Booking ID: ' . htmlspecialchars($rent['booking_id']) . '</p>
        // <p>Amount: ' . htmlspecialchars($rent['amount']) . '</p>
        // <p>Payment Method: ' . htmlspecialchars($rent['payment_method']) . '</p>
    }
} else {
    echo '<p class="text-red-500">No Rents found.</p>';
}
