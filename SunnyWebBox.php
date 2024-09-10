<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="300">
    <title>Sunny WebBox Data Logger</title>
</head>
<body>
<?php
include_once 'simple_html_dom.php';
include_once 'config.php';

$targetUrl = 'http://192.168.10.100/home.htm';
$html = file_get_html($targetUrl);

$power = $html->find('td#Power', 0)->innertext ?? null;
$dailyYield = $html->find('td#DailyYield', 0)->innertext ?? null;

if ($power && $dailyYield) {
    $sql = "INSERT INTO sunnywebbox_tb (Sunnywebbox_kW, Sunnywebbox_kWh) VALUES ('$power', '$dailyYield')";

    if (mysqli_query($conn, $sql)) {
        echo "New record inserted successfully into SunnyWebBox.<br>";
        date_default_timezone_set("Asia/Kolkata");
        echo "The time is " . date("d-m-Y h:i:sa") . "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Failed to retrieve data from the source.<br>";
}

mysqli_close($conn);
?>
</body>
</html>