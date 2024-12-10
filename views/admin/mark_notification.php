
<?php
require_once "../../model/admin.php";
require_once "../../controller/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notification_id = $_POST['notification_id'];
    $admin = new Admin($conn);
    $admin->markNotificationAsRead($notification_id);
    header("Location: dashboard.php");
}