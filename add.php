<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "jothihospital"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $age = intval($_POST["age"]);
    $number = mysqli_real_escape_string($conn, $_POST["number"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $time = mysqli_real_escape_string($conn, $_POST["time"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    
    $sql = "INSERT INTO appointment (name, age, number, gender, email, time, date, city)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssss", $name, $age, $number, $gender, $email, $time, $date, $city);
    
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close();
}

$conn->close();
?>
