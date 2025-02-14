<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Book</h2>

    <?php
    include 'db_connection.php';

    $book_id = isset($_GET['book_id']) ? $_GET['book_id'] : 0;

    $sql = "SELECT B.BookID, B.Title, B.AuthorID, B.Genre, B.PublishedYear FROM Books B WHERE B.BookID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row['Title'];
        $author_id = $row['AuthorID'];
        $genre = $row['Genre'];
        $published_year = $row['PublishedYear'];
    ?>

    <form action="edit_book_process.php" method="POST">
        <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book_id); ?>">

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required><br>

        <label for="author_id">Author:</label>
        <select id="author_id" name="author_id" required>
            <?php
            $sql_authors = "SELECT AuthorID, Name FROM Authors";
            $result_authors = $conn->query($sql_authors);

            if ($result_authors->num_rows > 0) {
                while ($author = $result_authors->fetch_assoc()) {
                    $selected = ($author['AuthorID'] == $author_id) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($author['AuthorID']) . "' " . $selected . ">" . htmlspecialchars($author['Name']) . " (ID: " . htmlspecialchars($author['AuthorID']) . ")</option>";
                }
            } else {
                echo "<option value=''>No authors available</option>";
            }
            ?>
        </select><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($genre); ?>"><br>

        <label for="published_year">Published Year:</label>
        <input type="number" id="published_year" name="published_year" value="<?php echo htmlspecialchars($published_year); ?>"><br>

        <input type="submit" value="Update Book">
    </form>

    <?php
    } else {
        echo "<p class='error'>Book not found.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
    <br>
    <a href="view_books.php">Back to View Books</a>
</body>
</html>
