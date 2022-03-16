<?php

$code = $utils->sanitize($_GET['c']);

$db = new Framework\Database();

$shortener = new Framework\Shortener($db);

$stats = $shortener->getUrlInfoFromDb($code);;
