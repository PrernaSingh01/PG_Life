<?php
require_once("../includes/database_connect.php");

// Check if all required fields are filled
if(empty($_POST['full_name']) || empty($_POST['phone']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['college_name']) || empty($_POST['gender'])){
    echo "All fields are required!";
    exit;
}

$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$password = sha1($password);
$college_name = mysqli_real_escape_string($conn, $_POST['college_name']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "This email id is already registered with us!";
    exit;
}

$sql = "INSERT INTO users (email, password, full_name, phone, gender, college_name) VALUES ('$email', '$password', '$full_name', '$phone', '$gender', '$college_name')";

if (mysqli_query($conn, $sql)) {
    echo "Your account has been created successfully!";
} else {
    echo "Something went wrong!";
    exit;
}

mysqli_close($conn);
?>
Click <a href="../index.php">here</a> to continue.
