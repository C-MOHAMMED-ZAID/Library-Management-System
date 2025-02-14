<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $genre = $_POST['genre'];
    $published_year = $_POST['published_year'];

    if (!is_numeric($book_id)) {
        echo "<p style='color:red;'>Error: Invalid Book ID.</p>";
        echo "<br><a href='view_books.php'>Back to View Books</a>";
        exit;
    }

    $check_author_sql = "SELECT AuthorID FROM Authors WHERE AuthorID = ?";
    $check_author_stmt = $conn->prepare($check_author_sql);
    $check_author_stmt->bind_param("i", $author_id);
    $check_author_stmt->execute();
    $check_author_stmt->store_result();

    if ($check_author_stmt->num_rows == 0) {
        echo "<p style='color:red;'>Error: AuthorID " . htmlspecialchars($author_id) . " does not exist. Please add the author first.</p>";
        $check_author_stmt->close();
        $conn->close();
        echo "<br><a href='view_books.php'>Back to View Books</a>";
        exit;
    }

    $check_author_stmt->close();

    $sql = "UPDATE Books SET Title = ?, AuthorID = ?, Genre = ?, PublishedYear = ? WHERE BookID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissi", $title, $author_id, $genre, $published_year, $book_id);

    if ($stmt->execute()) {
        echo "Book updated successfully.";
    } else {
        echo "Error updating book: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: view_books.php"); 
    exit;
} else {
    echo "This script should only be accessed via POST request.";
}
?>
