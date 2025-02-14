<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST['transaction_id'];

    $check_transaction_sql = "SELECT TransactionID, BookID FROM Transactions WHERE TransactionID = ? AND ReturnDate IS NOT NULL";
    $check_transaction_stmt = $conn->prepare($check_transaction_sql);
    $check_transaction_stmt->bind_param("i", $transaction_id);
    $check_transaction_stmt->execute();
    $check_transaction_stmt->store_result();

    if ($check_transaction_stmt->num_rows == 0) {
        $check_transaction_stmt->close();

        $check_transaction_sql = "SELECT TransactionID FROM Transactions WHERE TransactionID = ?";
        $check_transaction_stmt = $conn->prepare($check_transaction_sql);
        $check_transaction_stmt->bind_param("i", $transaction_id);
        $check_transaction_stmt->execute();
        $check_transaction_stmt->store_result();

        if ($check_transaction_stmt->num_rows == 0) {
            echo "<p style='color:red;'>Error: Transaction ID " . htmlspecialchars($transaction_id) . " does not exist.</p>";
        } else {
            echo "<p style='color:red;'>Error: Transaction ID " . htmlspecialchars($transaction_id) . " has already been processed.</p>";
        }

        $check_transaction_stmt->close();
        $conn->close();
        echo "<br><a href='index.php'>Back to Home</a>";
        exit;
    }

    $check_transaction_stmt->bind_result($transaction_id, $book_id);
    $check_transaction_stmt->fetch();
    $check_transaction_stmt->close();

    $conn->begin_transaction();

    try {
        $return_date = date("Y-m-d"); 
        $update_transaction_sql = "UPDATE Transactions SET ReturnDate = ? WHERE TransactionID = ?";
        $update_transaction_stmt = $conn->prepare($update_transaction_sql);
        $update_transaction_stmt->bind_param("si", $return_date, $transaction_id);
        $update_transaction_stmt->execute();

        $update_book_sql = "UPDATE Books SET IsAvailable = TRUE WHERE BookID = ?";
        $update_book_stmt = $conn->prepare($update_book_sql);
        $update_book_stmt->bind_param("i", $book_id);
        $update_book_stmt->execute();
        $update_book_stmt->close();

        $conn->commit();

        echo "Book returned successfully. Transaction ID: " . htmlspecialchars($transaction_id);
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Error: " . $exception->getMessage();
    }

    $update_transaction_stmt->close();
    $conn->close();
} else {
    echo "This script should only be accessed via POST request.";
}
?>
<br>
<a href="index.php" class="back-to-home">Back to Home</a>

