<?php
/**
 * Database Settings
 */
$database = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => '',
];

/**
 * Site Settings
 */
$site = [
    'siteName' => 'PDO Template',
    ];

/**
 * Page Title Settings
 */
$url = $_SERVER['REQUEST_URI'];
if ($url == '/') {
    $url = '/home';
}
$titles = [
    'default' => substr($url, 1) . ' - ' . $site['siteName'],
    'home' => 'Home Page - ' . $site['siteName'],
    'about' => 'About Us - ' . $site['siteName'],
    'contact' => 'Contact Us - ' . $site['siteName'],
    '404' => '404 - Oops page not found!',
];

