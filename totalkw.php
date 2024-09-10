<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="300">
    <title>Insert PKW Values from All Plants</title>
</head>
<body>
<?php
include_once 'simple_html_dom.php';
include_once 'config.php';

function getLatestPowerValue($table, $column, $startTime, $endTime, $conn) {
    $sql = "SELECT $column 
            FROM $table 
            WHERE Date_Time <= '$endTime' 
              AND Date_Time >= '$startTime' 
            ORDER BY Date_Time DESC 
            LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row[$column] ?? 0;
}

$startTime = date("Y-m-d") . ' 07:00:00 AM';
$endTime = date("Y-m-d") . ' 17:30:00 PM';

// Fetch latest power values from each plant
$heliosLeftPower = getLatestPowerValue('helios_left', 'HeliosLeft_PkW', $startTime, $endTime, $conn);
$heliosRightPower = getLatestPowerValue('helios_right', 'HeliosRight_PkW', $startTime, $endTime, $conn);
$heliosTataPower = getLatestPowerValue('helios_tata', 'HeliosTata_PkW', $startTime, $endTime, $conn);
$sunnyWebboxPower = getLatestPowerValue('sunnywebbox_tb', 'Sunnywebbox_kW', $startTime, $endTime, $conn);
$workshopPower = $sunnyWebboxPower / 1.8;
$smaPower = getLatestPowerValue('sma_tb', 'SMA_AC_Power_1_W', $startTime, $endTime, $conn) / 1000;

// Calculate total power sum
$pkWACSUM = $heliosLeftPower + $heliosRightPower + $heliosTataPower + $sunnyWebboxPower + $workshopPower + $smaPower;
$pkWACSUMtwelve = $pkWACSUM / 12;

// Insert the total power sum into the database
$sql = "INSERT IGNORE INTO total_kw (PkWACSUM, PkWACSUMtwelve) 
        VALUES ('$pkWACSUM', '$pkWACSUMtwelve')";

if (mysqli_query($conn, $sql)) {
    echo "Inserted PkW SUM successfully.<br>";
} else {
    echo "Error: " . mysqli_error($conn) . "<br>";
}

date_default_timezone_set("Asia/Kolkata");
echo "The time is " . date("d-m-Y h:i:sa") . "<br>";

mysqli_close($conn);
?>
</body>
</html>