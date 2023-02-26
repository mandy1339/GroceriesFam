<?php

require_once('Template/Initialization.php');
require_once(BASEDIR . '/Template/SecurityCheck.php');
require_once(BASEDIR . '/Template/NavigationHeader.php');
require_once(BASEDIR . '/View/Styling/StyleManager.php');

$StyleGPT1 = StyleManager::IncludeGTPStyle01();
$StyleGPT2 = StyleManager::IncludeGTPStyle02();

echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>    
    <title>Grocery Fam</title>
    $StyleGPT1
    $StyleGPT2
</head>
<body>
HTML;


# User is logged in so we can show this page
# add links to other pages
Navigation::get_navigation_header();
echo "<h1>Home</h1>";





echo <<<HTML
</body>
</html>
HTML
?>