<?php
/**
 * Database Settings
 */
$database = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'cs',
];

/**
 * Site Settings
 */
$site = [
    // General settings
    'siteName' => 'PDO Template',
    'debug' => true,
    'maintenance' => false,

    // Ajax settings
    'ajax' => true,

    // Admin settings
    'admin' => [
        'enabled' => false,
        'saveUrl' => true, // save the url in the session so you can redirect the user back to the page he was before he logged in
        'sessionName' => 'admin', // the session name that will be used to store that the user is a admin check by isset function
        'redirect' => 'login', // redirect to this page if the user is not logged in
        'filterInUrl' => 'admin', // empty string means no filter
    ],

    // Accounts settings
    'accounts'=>[
        'enabled' => false,
        'saveUrl' => true, // save the url in the session so you can redirect the user back to the page he was before he logged in
        'sessionName' => 'userId', // the session name that will be used to store that the user is logged in check by isset function
        'redirect' => 'login', // redirect to this page if the user is not logged in
        'filterInUrl' => '', // empty string means no filter
    ],

    // popup settings
    'showPopup' => true,
    'popupTitle' => 'Note',
    'popupMessage' => 'This is a popup you can change it in the settings!',
    'popupButtons' => [
        [
            'label' => 'Change button',
            'action' => ''
        ],
        // Add more buttons as needed
    ]

];

/**
 * Allowed IPs That can bypass the maintenance
 */
$allowedIPs = ['::0'];

/**
 * Page Title Settings
 */
$url = $_SERVER['REQUEST_URI'];

// If the URL is the root path, set it to '/home'
if ($url == '/') {
    $url = '/home';
}

$titles = [
    'default' => substr($url, 1) . ' - ' . $site['siteName'],
    'maintenance' => 'Under Maintenance - ' . $site['siteName'],
    'home' => 'Home Page - ' . $site['siteName'],
    'about' => 'About Us - ' . $site['siteName'],
    'contact' => 'Contact Us - ' . $site['siteName'],
    '404' => '404 - Oops page not found!',
];

// Disable errors if debug is set to false
if (!$site['debug']) {
    error_reporting(0);

}