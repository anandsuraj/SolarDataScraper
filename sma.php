<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="300">
    <title>SMA Data Logger</title>
</head>
<body>
<?php
include_once 'simple_html_dom.php';
include_once 'config.php';

$targetUrl = 'http://192.168.0.186/2017/06/Soreva-Spot.xml';
$html = file_get_html($targetUrl);

// Mapping the target data fields to a more organized array
$dataFields = [
    'DC_Power_1' => 'SMA_DC_Power_1_V',
    'DC_Current_1' => 'SMA_DC_Current_1_A',
    'DC_Voltage_1' => 'SMA_DC_Voltage_1_V',
    'AC_Power_1' => 'SMA_AC_Power_1_W',
    'AC_Current_1' => 'SMA_AC_Current_1_A',
    'AC_Voltage_1' => 'SMA_AC_Voltage_1_V',
    'DC_TotalPower' => 'SMA_DC_TotalPower_W',
    'AC_TotalPower' => 'SMA_AC_TotalPower_W',
    'EnergyToday' => 'SMA_EnergyToday_kWh',
    'EnergyCumulative' => 'SMA_EnergyCumulative_kWh',
    'Temperature' => 'SMA_Temperature_C'
];

$parsedData = [];

foreach ($dataFields as $htmlId => $dbColumn) {
    foreach ($html->find("td#$htmlId") as $element) {
        $parsedData[$dbColumn] = $element->plaintext;
        echo "$dbColumn: " . $element->plaintext . '<br>';
    }
}

$sql = "INSERT INTO sma_tb (" . implode(',', array_keys($parsedData)) . ") VALUES ('" . implode("','", array_values($parsedData)) . "')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully in the SMA database.<br>";
    date_default_timezone_set("Asia/Kolkata");
    echo "The time is " . date("d-m-Y h:i:sa") . "<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
</body>
</html>
