<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow a Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Borrow a Book</h2>

    <form action="borrow_book_process.php" method="POST">
        <label for="user_id">Patron:</label>
        <select id="user_id" name="user_id" required>
            <?php
            include 'db_connection.php';

            $sql = "SELECT UserID, Name FROM Patrons";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row["UserID"]) . "'>" . htmlspecialchars($row["Name"]) . " (ID: " . htmlspecialchars($row["UserID"]) . ")</option>";
                }
            } else {
                echo "<option value=''>No patrons available</option>";
            }

            $conn->close();
            ?>
        </select><br>

        <label for="book_id">Book:</label>
        <select id="book_id" name="book_id" required>
            <?php
            include 'db_connection.php';

            $sql = "SELECT BookID, Title FROM Books";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row["BookID"]) . "'>" . htmlspecialchars($row["Title"]) . " (ID: " . htmlspecialchars($row["BookID"]) . ")</option>";
                }
            } else {
                echo "<option value=''>No books available</option>";
            }

            $conn->close();
            ?>
        </select><br>

        <label for="borrow_date">Borrow Date:</label>
        <input type="date" id="borrow_date" name="borrow_date" required><br>

        <label for="return_date">Return Date:</label>
        <input type="date" id="return_date" name="return_date" required><br>

        <input type="submit" value="Borrow Book">
    </form>
    <br>
<a href="index.php" class="back-to-home">Back to Home</a>

</body>
</html>
