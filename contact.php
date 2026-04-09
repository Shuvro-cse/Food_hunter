<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if ($name != "" && $email != "" && $message != "") {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "Message sent successfully.";
        } else {
            echo "Error saving message.";
        }

        $stmt->close();
    } else {
        echo "Please fill all fields.";
    }
}
?>