<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="300">
    <title>Execute All Pages</title>
</head>
<body>
<?php
// Include all necessary scripts
$includes = [
    'SunnyWebBox.php',
    'HeliosLeft.php',
    'HeliosRight.php',
    'sma.php',
    'HeliosTata.php',
    'totalkw.php',
    'kwhtotal.php'
];

foreach ($includes as $file) {
    if (file_exists($file)) {
        include $file;
    } else {
        echo "Error: Unable to include '$file'.<br>";
    }
}

date_default_timezone_set("Asia/Kolkata");
echo "All scripts executed. Current time: " . date("d-m-Y h:i:sa") . "<br>";
?>
</body>
</html>
