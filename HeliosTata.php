<html>
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="refresh" content="300">
</head>
<body>
<?php
include_once 'simple_html_dom.php';
include_once 'config.php';

$html = file_get_html('http://192.168.0.189/heliosInverterData');

$AC_ActivePower = $html->find('td#AC_ActivePower', 0)->plaintext ?? null;
$AC_ReactivePower = $html->find('td#AC_ReactivePower', 0)->plaintext ?? null;
$DC_Power = $html->find('td#DC_Power', 0)->plaintext ?? null;

if ($AC_ActivePower && $AC_ReactivePower && $DC_Power) {
    $stmt = $conn->prepare("INSERT INTO helios_tata (HeliosTata_PkW, HeliosTata_SkVA, HeliosTata_PdckW) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $AC_ActivePower, $AC_ReactivePower, $DC_Power);

    if ($stmt->execute()) {
        echo "New record created successfully into Helios Tata db.<br>";
        echo "The time is " . date("d-m-Y h:i:sa", time()) . "<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
    $stmt->close();
} else {
    echo "Failed to retrieve data.<br>";
}

mysqli_close($conn);
?>
</body>
</html>
