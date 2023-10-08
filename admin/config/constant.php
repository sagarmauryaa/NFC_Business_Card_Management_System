<?php
// SECURITY HEADERS
header("X-Frame-Options: DENY");

header("X-XSS-Protection: 1; mode=block");

header("Strict-Transport-Security:max-age=63072000");

header('X-Content-Type-Options: nosniff');

// DEFINING PATH CONSTANTS FOR SITE USE
define('BASE_PATH', realpath(dirname(__FILE__)));

define('SERVER_PATH', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/Business Management/');

define('DOMAIN', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']);


define('IMAGE_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[SERVER_NAME]/Business Management/assets/images/");

$access_key = "19012022";
// echo BASE_PATH."<br>";
// echo SERVER_PATH."<br>";
// echo IMAGE_URL."<br>";
// echo PUBLIC_IMAGE_URL."<br>";

// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";