<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Transactions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>View Transactions</h2>

    <table>
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Patron Name</th>
                <th>Book Title</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db_connection.php';

            $sql = "SELECT T.TransactionID, P.Name AS PatronName, B.Title AS BookTitle, T.BorrowDate, T.ReturnDate
                    FROM Transactions T
                    JOIN Patrons P ON T.UserID = P.UserID
                    JOIN Books B ON T.BookID = B.BookID
                    ORDER BY T.TransactionID DESC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["TransactionID"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["PatronName"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["BookTitle"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["BorrowDate"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["ReturnDate"]) . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<a href='edit_transaction.php?transaction_id=" . htmlspecialchars($row["TransactionID"]) . "'>Edit</a>";
                    echo "<button onclick='deleteTransaction(" . htmlspecialchars($row["TransactionID"]) . ")'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No transactions found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
    <br>
    <a href="index.php" class="back-to-home">Back to Home</a>


    <script>
        function deleteTransaction(transactionId) {
            if (confirm('Are you sure you want to delete this transaction?')) {
                window.location.href = 'delete_transaction.php?transaction_id=' + transactionId;
            }
        }
    </script>
</body>
</html>
