<?php
$conn = sqlsrv_connect("", array("Database" => "tatib", "UID" => "", "PWD" => ""));
if (!$conn) die(print_r(sqlsrv_errors(), true));