<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transaction_id = $_POST['transaction_id'];
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = $_POST['return_date'];

    if (empty($user_id) || empty($book_id) || empty($borrow_date) || empty($return_date)) {
        echo "<p style='color:red;'>Error: All fields are required.</p>";
        echo "<br><a href='edit_transaction.php?transaction_id=" . htmlspecialchars($transaction_id) . "'>Back to Edit Transaction</a>";
        exit;
    }

    $sql = "UPDATE Transactions SET UserID = ?, BookID = ?, BorrowDate = ?, ReturnDate = ? WHERE TransactionID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi", $user_id, $book_id, $borrow_date, $return_date, $transaction_id);

    if ($stmt->execute()) {
        echo "Transaction updated successfully.";
    } else {
        echo "Error updating transaction: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: view_transactions.php");
    exit;
} else {
    echo "This script should only be accessed via POST request.";
}
?>
