<?php

require_once './core/Router.php';
use app\core\Router;

// Dosen Pembimbing Akademik 
Router::get("/dpa", function () {
    return Router::view("dosen/dpa/dashboard");
});

Router::get("/dpa/form", function () {
    return Router::view("dosen/dpa/form");
});

Router::get("/dpa/class", function () {
    return Router::view("dosen/dpa/class");
});

Router::get("/dpa/profile", function () {
    return Router::view("dosen/dpa/profile");
});


// Admin
Router::get("/admin", function () {
    return Router::view("admin/dashboard");
});

Router::get("/admin/data-dosen", function () {
    return Router::view("admin/data-dosen");
});

Router::get("/admin/data-mahasiswa", function () {
    return Router::view("admin/data-mahasiswa");
});

Router::get("/admin/data-pelanggaran", function () {
    return Router::view("admin/data-pelanggaran");
});


// Mahasiswa
Router::get("/mahasiswa", function () {
    return Router::view("mahasiswa/dashboard");
});

Router::get("/mahasiswa/message", function () {
    return Router::view("mahasiswa/message");
});

Router::get("/mahasiswa/profile", function () {
    return Router::view("mahasiswa/profile");
});


// Auth
Router::get("/register", function() {
    return Router::view("auth/register");
});

Router::get("/login", function() {
    return Router::view("auth/login");
});


// Komisi Disiplin
Router::get("/komdis", function () {
    return Router::view("dosen/komdis/dashboard");
});

Router::get("/komdis/evaluate", function () {
    return Router::view("dosen/komdis/evaluate");
});

Router::get("/komdis/profile", function () {
    return Router::view("dosen/komdis/profile");
});


Router::run();