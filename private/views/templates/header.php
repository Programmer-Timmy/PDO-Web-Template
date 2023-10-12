<?php
// A function to generate a responsive title based on the URL
function getPageTitle() {
    global $titles;
    $url = $_SERVER['REQUEST_URI'];

    $pageTitle = ucfirst($titles['default']);

    // Find the corresponding title based on URL
    foreach ($titles as $urlPattern => $title) {
        if (strpos($url, $urlPattern) !== false) {
            $pageTitle = $title;
            break;
        }
    }
    return $pageTitle;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getPageTitle(); ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>


