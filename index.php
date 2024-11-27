<?php

require_once './core/Router.php';
use app\core\Router;

Router::get("/", function () {
    return Router::view("dosen/dashboard");
});

Router::get("/form", function () {
    return Router::view("dosen/form");
});

Router::get("/class", function () {
    return Router::view("dosen/class");
});

Router::get("/register", function() {
    return Router::view("auth/register");
});

Router::get("/login", function() {
    return Router::view("auth/login");
});

Router::run();