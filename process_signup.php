<?php

include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (name,email,password)
VALUES ('$name','$email','$password')";

if($conn->query($sql) === TRUE){
echo "Account created successfully";
}else{
echo "Error: " . $conn->error;
}

$conn->close();

?>