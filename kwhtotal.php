<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="300">
</head>
<body>
<?php
include_once 'simple_html_dom.php';
include_once 'config.php';

date_default_timezone_set("Asia/Kolkata");

// Prepare the SQL statement
$sql = "
    INSERT IGNORE INTO kwh (kwh)
    SELECT SUM(`PkWACSUMtwelve`) AS kwh
    FROM total_kw
    WHERE `Date_Time` <= CONCAT(CURDATE(), ' 17:30:00 PM')
      AND `Date_Time` >= CONCAT(CURDATE(), ' 07:00:00 AM')
";

// Execute and handle potential errors
if ($conn->query($sql) === TRUE) {
    echo "Inserted kWh total successfully.<br>";
} else {
    echo "Error: " . $conn->error . "<br>";
}

// Display the current time
echo "The time is " . date("d-m-Y h:i:sa") . "<br>";

$conn->close();
?>
</body>
</html>
