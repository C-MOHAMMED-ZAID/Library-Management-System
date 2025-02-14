<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO Patrons (Name, Email, Address, PhoneNumber) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $address, $phone_number);

    if ($stmt->execute()) {
        $user_id = $conn->insert_id;  
        echo "New patron added successfully. User ID: " . htmlspecialchars($user_id);
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "This script should only be accessed via POST request.";
}
?>
<br>
<a href="index.php" class="back-to-home">Back to Home</a>
