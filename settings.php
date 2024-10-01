<?php
require_once './authmiddleware.php';
require_once './classes/user.class.php';

checkAuth();

$user = new User();

$settings = $user->fetchprofile();

$first_name = $last_name = $email = $password = "";
$first_nameErr = $last_nameErr = $emailErr = $passwordErr = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->usertype = $_POST['usertype'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    //update
    // if ($user->register()) {
    //     header('Location: login.php');
    // }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="icon" href="./public/images/white_transparent.png">
    <link rel="stylesheet" href="./output.css?v=1.14">
</head>

<body
    class="bg-neutral-100 text-neutral-700 flex relative justify-center items-center box-border lg:h-screen lg:overflow-hidden">

    <div class="p-4 w-full lg:w-[1000px] bg-neutral-200 flex flex-col relative h-screen gap-4 lg:h-[600px] rounded-md ">
        <div class="flex items-center w-full gap-2">
            <button onclick="window.location.href = './index.php';"
                class="left-[5px] top-[14px] lg:left-[2px] lg:top-[2px] hover:text-red-500 duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                </svg>
            </button>
            <h1 class="font-bold text-lg md:text-xl text-center">SETTINGS</h1>

        </div>

        <div
            class="flex flex-col bg-neutral-200/20 text-neutral-700 p-4 rounded-lg overflow-x-hidden overflow-y-scroll h-full">
            <div class="w-full ">
                <div class="faq-item mb-4">
                    <button
                        class="faq-header w-full flex items-center bg-neutral-100 justify-between text-left border  py-2 px-3 shadow-md rounded-full">
                        Personal Information
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path
                                d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659" />
                        </svg>
                    </button>
                    <div class="faq-content hidden">
                        <form action="" class="text-sm p-4">
                            <div class="flex flex-col gap-2">
                                <div class="flex flex-col gap-1">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="p-2 rounded-md" required
                                        value="<?php echo $settings['first_name']; ?>">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="p-2 rounded-md" required
                                        value="<?php echo $settings['last_name']; ?>">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="p-2 rounded-md" required
                                        value="<?php echo $settings['email']; ?>">
                                </div>
                                <h1 class="text-center mt-2">Change Password?</h1>
                                <div class="flex flex-col gap-1">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="p-2 rounded-md" required
                                        value="" placeholder="********">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" name="password" id="password" class="p-2 rounded-md" required
                                        value="" placeholder="********">
                                </div>
                                <div class="flex flex-col items-center mt-2">
                                    <button type="submit"
                                        class="border-2 text-neutral-200 bg-red-500 w-fit px-3 py-2 rounded-2xl">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="faq-item mb-4">
                    <button
                        class="faq-header w-full flex items-center bg-neutral-100 justify-between text-left border  py-2 px-3 shadow-md rounded-full">
                        Upgrade Account
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path
                                d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659" />
                        </svg>
                    </button>
                    <div class="faq-content hidden">
                        <form action="" class="text-sm p-4">
                            <div class="flex flex-col gap-2">
                                <h1 class="text-center text-lg">Application for Host Account</h1>
                                <div class="flex flex-col gap-1">
                                    <label for="first_name">Type of Identification Card</label>
                                    <select name="" id="" class="p-2 rounded-md" required>
                                        <option value="">Please select an option</option>
                                        <option value="National ID">National ID</option>
                                        <option value="Passport">Passport</option>
                                        <option value="Driver's License">Driver’s License</option>
                                        <option value="Voter's ID">Voter’s ID</option>
                                        <option value="Senior Citizen ID">Senior Citizen ID</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="first_name">Upload Identification Card</label>
                                    <input type="file" name="file" id="file" class="p-2 rounded-md" required>
                                </div>

                                <div class="flex flex-col items-center mt-2">
                                    <button type="submit"
                                        class="border-2 text-neutral-200 bg-red-500 w-fit px-3 py-2 rounded-2xl">Apply</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="faq-item mb-4">
                    <button
                        class="faq-header w-full flex items-center justify-between text-left border bg-neutral-100 py-2 px-3 shadow-md rounded-full">
                        Delete My Account
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path
                                d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659" />
                        </svg>
                    </button>
                    <div class="faq-content hidden ">
                        <form action="" class="text-sm p-4">
                            <div class="flex flex-col gap-2">
                                <h1 class="text-center text-lg">Form for Deletion of Account</h1>
                                <div class="flex flex-col gap-1">
                                    <label for="first_name">Reason for account deletion</label>
                                    <select name="deletionReason" id="deletionReason" class="p-2 rounded-md" required>
                                        <option value="">Please select an option</option>
                                        <option value="no_longer_using">No Longer Using the Service</option>
                                        <option value="found_alternative">Found an Alternative Service</option>
                                        <option value="privacy_concerns">Privacy Concerns</option>
                                        <option value="user_experience_issues">User Experience Issues</option>
                                        <option value="lack_of_features">Lack of Features</option>
                                        <option value="account_security_concerns">Account Security Concerns</option>
                                        <option value="poor_customer_support">Poor Customer Support</option>
                                        <option value="no_properties_or_matches">No Properties or Matches</option>
                                        <option value="financial_reasons">Financial Reasons</option>
                                        <option value="duplicate_account">Duplicate Account</option>
                                        <option value="temporary_deactivation">Temporary Deactivation</option>
                                        <option value="changing_needs">Changing Business/Personal Needs</option>
                                        <option value="data_breaches">Concerns Over Data Breaches</option>
                                        <option value="scams_or_fraud">Concerns About Scams or Fraud</option>
                                        <option value="overwhelmed">Overwhelmed by the Platform</option>
                                        <option value="no_longer_in_market">No Longer in the Market</option>
                                        <option value="data_export">Data Export or Migration</option>
                                    </select>

                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="first_name">Are you sure you want to continue? Enter you <span
                                            class="text-red-500 italic">PASSWORD</span> for
                                        confirmation</label>
                                    <input type="password" name="delpass" id="delpass" placeholder="********"
                                        class="p-2 rounded-md">
                                </div>

                                <div class="flex flex-col items-center mt-2">
                                    <button type="submit"
                                        class="border-2 text-neutral-200 bg-red-500 w-fit px-3 py-2 rounded-2xl">DELETE</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="faq-item mb-4">
                    <button
                        class="faq-header w-full flex items-center justify-between text-left border bg-neutral-100 py-2 px-3 shadow-md rounded-full">
                        Legal & Compliance
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path
                                d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659" />
                        </svg>
                    </button>
                    <div class="faq-content hidden text-center">
                        <p class=" text-sm">Yes, you can list your space on HubVenue. Create an
                            account,
                            provide details about your
                            space, upload photos, and set your availability and pricing. Once your listing is
                            approved, it will be visible to potential renters.</p>
                    </div>
                </div>
                <div class="faq-item mb-4">
                    <button
                        class="faq-header w-full flex items-center justify-between text-left border bg-neutral-100 py-2 px-3 shadow-md rounded-full">
                        Help and Support
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path
                                d="M3.204 5h9.592L8 10.481zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659" />
                        </svg>
                    </button>
                    <div class="faq-content hidden text-center">
                        <p class=" text-sm">Yes, you can list your space on HubVenue. Create an
                            account,
                            provide details about your
                            space, upload photos, and set your availability and pricing. Once your listing is
                            approved, it will be visible to potential renters.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/submit.js"></script>
</body>

</html>