<!-- This file will fetch car details and show them in a table -->
<!-- We can integrate different tables to a comprehensive report -->
<?php
include_once "db.php";
include_once "user.php";

$con = new DBConnector();
$pdo = $con->connectToDB();

$user = new User();

$user->carDetails($pdo);

$carid = $user->getCarid();
$numberplate = $user->getNumberPlate();
$car_type = $user->getCarType();
$car_colour = $user->getCarColour();
$timestamp = $user->getTimestamp();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Report</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Car ID</th>
            <th>NumberPlate</th>
            <th>Type</th>
            <th>Colour</th>
            <th>Time In</th>
        </tr>
        <tr>
            <td><?php echo $carid; ?></td>
            <td><?php echo $numberplate; ?></td>
            <td><?php echo $car_type; ?></td>
            <td><?php echo $car_colour; ?></td>
            <td><?php echo $timestamp; ?></td>
        </tr>
    </table>
</body>
</html>