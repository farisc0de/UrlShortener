<?php
$db = new Framework\Database();

// Initialize Shortener class and pass PDO object
$shortener = new Framework\Shortener($db);

// Long URL
$longURL = $utils->sanitize($_POST['long_url']);
// Custom Code
$custom_code = !empty($_POST['short_code']) ? $utils->sanitize($_POST['short_code']) : false;
// Custom Password
$custom_password = !empty($_POST['password']) ? $utils->sanitize($_POST['password']) : false;

$shortener->setCheckUrlExists(true);

// Prefix of the short URL
$shortURL_Prefix = $utils->siteUrl(); // with URL rewrite

try {
    if ($custom_code != false) {
        $shortener->use_custom_code = true;
        $shortener->custom_code = $custom_code;
    }

    if ($custom_password != false) {
        $shortener->link_protected = true;
        $shortener->password = $custom_password;
    }

    $shortCode = $shortener->urlToShortCode($longURL);
    // Create short URL
    $shortURL = $utils->siteUrl("/" . $shortCode);

    // Display short URL
} catch (Exception $e) {
    $shortURL = "";
    $err = $e->getMessage();
}
