<?php
include_once 'db.php';
include_once 'user.php';

if(!isset($_SESSION)){
    session_start();
}

//PDO Handle

$con = new DBConnector();
$pdo = $con->connectToDB();

if (isset($_POST["register"])){
    $userName = $_POST["name"];
    $userToken = $_POST["token"];
    $userPass = password_hash($_POST["password"], PASSWORD_DEFAULT);

    //user object
    $user = new User();
    $user->setFullName($userName);
    $user->setuser_token($userToken);
    $user->setinputPass($userPass);

    $message = $user->register($pdo);
    echo $message;
    
    header("Location: index.php");
    die();
}

if (isset($_POST['login'])) {
    $userToken = $_POST["token"];
    $userPass = $_POST["password"];

    $user = new User();
    $user->setuser_token($userToken);
    $user->setinputPass($userPass);
    $user_details = $user->login($pdo);
    $user_type= $user->getUserType();

    if($user_type == "Admin"){
        header("Location: admin/admin.php");
    }
    else if($user_type == "Master"){
        header("Location: employee.php");
    }
    die();
}

if (isset($_POST['car_reg_details'])) {
    $numberPlate = $_POST["numberPlate"];
    $Colour = $_POST["carcolour"];
    $Type = $_POST["type"];
    $phoneno = $_POST["phoneNo"];

    $user = new User();
    $user->setNumberPlate($numberPlate);
    $user->setCarColour($Colour);
    $user->setCarType($Type);
    $user->setPhoneNo($phoneno);

    $car_details = $user->carReg($pdo);
    die();
}

if (isset($_POST['checkout'])){
    $numberPlate = $_POST["numberplate"];

    $user = new User();
    $time_in = $user->getTimestamp();
    $time_out = date('h:m:s');
    die();
}
?>