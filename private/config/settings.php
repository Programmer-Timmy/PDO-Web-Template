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
 * Page titles wil automatically be defined by url.
 * You can change a page title by adding this:
 * '<file name here>' => '<Your custom Title>',
 *
 * optional:
 *  You can use @siteName to add your site name to it!
 * it wil look like this:
 *  '<file name here>' => '<Your custom Title> - ' . $site['siteName'],
 **/
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

