<?php
// Include the autoloader
require_once __DIR__ . '/../private/autoload.php';

// Include the settings
require_once __DIR__ . '/../private/config/settings.php';

// Include the common header
include __DIR__ . '/../private/Views/templates/header.php';

// Include the common navbar
include __DIR__ . '/../private/Views/templates/navbar.php';

// Determine which page to display based on the request
$requestedPage = $_SERVER['REQUEST_URI'];
if($requestedPage == "/"){
    $requestedPage = 'home';
}

// Include the specific page content
$pageTemplate = __DIR__ . "/../private/Views/pages/$requestedPage.php";
if (file_exists($pageTemplate)) {
    include $pageTemplate;
} else {
    // Handle 404 or display a default page
    header('location:404');
}

// Include the common footer
include __DIR__ . '/../private/Views/templates/footer.php';

global $database;

database::connect($database['host'], $database['user'], $database['password'], $database['database']);