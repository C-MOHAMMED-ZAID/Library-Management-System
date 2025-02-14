<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Transaction</h2>

    <?php
    include 'db_connection.php';

    $transaction_id = isset($_GET['transaction_id']) ? $_GET['transaction_id'] : 0;

    $sql = "SELECT T.TransactionID, T.UserID, T.BookID, T.BorrowDate, T.ReturnDate
            FROM Transactions T
            WHERE T.TransactionID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['UserID'];
        $book_id = $row['BookID'];
        $borrow_date = $row['BorrowDate'];
        $return_date = $row['ReturnDate'];
    ?>

    <form action="edit_transaction_process.php" method="POST">
        <input type="hidden" name="transaction_id" value="<?php echo htmlspecialchars($transaction_id); ?>">

        <label for="user_id">Patron:</label>
        <select id="user_id" name="user_id" required>
            <?php
            $sql_patrons = "SELECT UserID, Name FROM Patrons";
            $result_patrons = $conn->query($sql_patrons);
            if ($result_patrons->num_rows > 0) {
                while ($patron = $result_patrons->fetch_assoc()) {
                    $selected = ($patron['UserID'] == $user_id) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($patron['UserID']) . "' " . $selected . ">" . htmlspecialchars($patron['Name']) . " (ID: " . htmlspecialchars($patron['UserID']) . ")</option>";
                }
            }
            ?>
        </select><br>

        <label for="book_id">Book:</label>
        <select id="book_id" name="book_id" required>
            <?php
            $sql_books = "SELECT BookID, Title FROM Books";
            $result_books = $conn->query($sql_books);
            if ($result_books->num_rows > 0) {
                while ($book = $result_books->fetch_assoc()) {
                    $selected = ($book['BookID'] == $book_id) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($book['BookID']) . "' " . $selected . ">" . htmlspecialchars($book['Title']) . " (ID: " . htmlspecialchars($book['BookID']) . ")</option>";
                }
            }
            ?>
        </select><br>

        <label for="borrow_date">Borrow Date:</label>
        <input type="date" id="borrow_date" name="borrow_date" value="<?php echo htmlspecialchars($borrow_date); ?>" required><br>

        <label for="return_date">Return Date:</label>
        <input type="date" id="return_date" name="return_date" value="<?php echo htmlspecialchars($return_date); ?>" required><br>

        <input type="submit" value="Update Transaction">
    </form>

    <?php
    } else {
        echo "<p class='error'>Transaction not found.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
    <br>
    <a href="view_transactions.php">Back to View Transactions</a>
</body>
</html>
