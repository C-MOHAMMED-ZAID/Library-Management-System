<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $genre = $_POST['genre'];
    $published_year = $_POST['published_year'];

    $check_author_sql = "SELECT AuthorID FROM Authors WHERE AuthorID = ?";
    $check_author_stmt = $conn->prepare($check_author_sql);
    $check_author_stmt->bind_param("i", $author_id);
    $check_author_stmt->execute();
    $check_author_stmt->store_result();

    if ($check_author_stmt->num_rows == 0) {
        echo "<p style='color:red;'>Error: AuthorID " . htmlspecialchars($author_id) . " does not exist. Please add the author first.</p>";
        $check_author_stmt->close();
        $conn->close();
        echo "<br><a href='index.php'>Back to Home</a>";
        exit;
    }

    $check_author_stmt->close();

    $sql = "INSERT INTO Books (Title, AuthorID, Genre, PublishedYear) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $title, $author_id, $genre, $published_year);

    if ($stmt->execute()) {
        $book_id = $conn->insert_id; 
        echo "New book added successfully. Book ID: " . htmlspecialchars($book_id);
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

