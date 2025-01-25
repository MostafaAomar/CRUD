<?php
session_start();

// File to store user data
$usersFile = 'users.json';

// Initialize users file if it doesn't exist
if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([]));
}

// Function to get all users
function getUsers()
{
    global $usersFile;
    return json_decode(file_get_contents($usersFile), true);
}

// Function to save users
function saveUsers($users)
{
    global $usersFile;
    file_put_contents($usersFile, json_encode($users));
}
