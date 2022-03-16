<?php

// Database Settings
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "urlshortener");

// Application Settings
define("SITE_URL", "http://short.local/"); // Example: http://localhost/UrlShortener
define("APP_PATH", dirname(__FILE__, 2) . DIRECTORY_SEPARATOR); // ( Don't Change );
define("LOGS_PATH", APP_PATH . "php_logs.log"); // ( Don't Change );

$st = [
    "website_name" => "UrlShortner",
    "description" => "Simple Url Shortener",
    "keywords" => "url, short, url shortener, shortenrt",
    "theme_name" => "flatly",
    "owner_name" => "FarisCode"
];

require_once 'environment.php';

// Autoload Composer
require_once APP_PATH . 'vendor/autoload.php';
