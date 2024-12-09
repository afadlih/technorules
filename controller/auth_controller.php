<?php
require_once '../model/user.php';
require_once '../controller/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use the $conn variable from connection.php
    $user = new User($conn); // Pass the $conn connection to the User constructor
    $user->login($username, $password);
}