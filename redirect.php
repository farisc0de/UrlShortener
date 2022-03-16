<?php

require_once 'config/config.php';

$db = new Framework\Database();

$shortener = new Framework\Shortener($db);

$utils = new Framework\Utils();

try {
    $shortCode = rtrim($utils->sanitize($_GET["c"]), "/");

    if ($shortener->is_protected($shortCode)) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($shortener->checkPassword($shortCode, $utils->sanitize($_POST['password']))) {
                $utils->redirect(
                    $shortener->shortCodeToUrl($shortCode)
                );
            } else {
                $msg = "Incorrect Password";
            }
        }
        include_once 'password_form.php';
    } else {
        $utils->redirect(
            $shortener->shortCodeToUrl($shortCode)
        );
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
