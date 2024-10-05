<?php

// Start the session if it hasn't been started already
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//  * Checks if the user is logged in. If not, logs the user out and redirects to the login page.
function checkAuth()
{
    // Check if the user session variables are set
    if (!isset($_SESSION['id'])) {
        // If not logged in, log the user out and redirect to the login page
        logout();
    }
}

//  * Logs out the user by destroying the session and redirects to the login page.
function logout()
{
    // Destroy all session data
    session_unset();
    session_destroy();
    
    // Redirect to the login page
    header("Location: ./login.php");
    exit();
}

//  * Redirects the user to the dashboard if they are already logged in.
function redirectIfAuth()
{
    // Check if the user session variables are set
    if (isset($_SESSION['id'])) {
        // If logged in, redirect to the dashboard
        header("Location: ./index.php");
        exit();
    }
}