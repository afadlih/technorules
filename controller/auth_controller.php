<?php
require_once '../model/user.php';
require_once '../controller/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new user();
    $user->login($username, $password);
}
?>