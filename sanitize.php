<?php

function sanitizeInput($input)
{
    $input = trim($input);

    $input = stripslashes($input);

    $input = htmlspecialchars($input);

    return $input;
}

function verifyEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

