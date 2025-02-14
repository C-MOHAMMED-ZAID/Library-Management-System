<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $biography = $_POST['biography'];

    $sql = "INSERT INTO Authors (Name, Biography) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $biography);

    if ($stmt->execute()) {
        $author_id = $conn->insert_id;  
        echo "New author added successfully. Author ID: " . htmlspecialchars($author_id);
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

