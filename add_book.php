<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add New Book</h2>
    <form action="add_book_process.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="author_id">Author:</label>
        <select id="author_id" name="author_id" required>
            <?php
            include 'db_connection.php';

            $sql = "SELECT AuthorID, Name FROM Authors";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row["AuthorID"]) . "'>" . htmlspecialchars($row["Name"]) . " (ID: " . htmlspecialchars($row["AuthorID"]) . ")</option>";
                }
            } else {
                echo "<option value=''>No authors available</option>";
            }

            $conn->close();
            ?>
        </select><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre"><br>

        <label for="published_year">Published Year:</label>
        <input type="number" id="published_year" name="published_year"><br>

        <input type="submit" value="Add Book">
    </form>
    <br>
<a href="index.php" class="back-to-home">Back to Home</a>

</body>
</html>
