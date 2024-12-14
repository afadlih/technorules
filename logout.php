<?php
session_start();
session_destroy();
header("Location: /technorules/login");
exit();
?>