<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Books</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>View All Books</h2>

    <a href="add_book.php" class="add-new-book-button">Add New Book</a>

    <table>
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Published Year</th>
                <th>Is Available</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db_connection.php';

            $sql = "SELECT B.BookID, B.Title, A.Name AS AuthorName, B.Genre, B.PublishedYear, B.IsAvailable
                    FROM Books B
                    JOIN Authors A ON B.AuthorID = A.AuthorID
                    ORDER BY B.Title";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["BookID"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["Title"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["AuthorName"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["Genre"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["PublishedYear"]) . "</td>";
                    echo "<td>" . ($row["IsAvailable"] ? "Yes" : "No") . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<a href='edit_book.php?book_id=" . htmlspecialchars($row["BookID"]) . "'>Edit</a>";
                    echo "<button onclick='deleteBook(" . htmlspecialchars($row["BookID"]) . ")'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No books found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
    <br>
    <a href="index.php" class="back-to-home">Back to Home</a>


    <script>
        function deleteBook(bookId) {
            if (confirm('Are you sure you want to delete this book?')) {
                window.location.href = 'delete_book.php?book_id=' + bookId;
            }
        }
    </script>
</body>
</html>
