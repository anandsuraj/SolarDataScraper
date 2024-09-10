<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="300">
    <title>Weather Data</title>
</head>
<body>
<?php
include_once 'simple_html_dom.php';

function fetchWeatherData($url) {
    $html = file_get_html($url);
    if ($html === false) {
        return "Error fetching weather data.";
    }

    $weatherData = [];
    foreach ($html->find('div.panel') as $panel) {
        $weatherData[] = $panel->plaintext;
    }

    return implode('<br>', $weatherData);
}

$url = 'https://weather.com/en-IN/weather/today/l/INXX0038:1:IN';
echo fetchWeatherData($url);
?>
</body>
</html>