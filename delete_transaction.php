<?php
include 'db_connection.php';

if (isset($_GET['transaction_id']) && is_numeric($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];

    $sql = "DELETE FROM Transactions WHERE TransactionID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $transaction_id);

    if ($stmt->execute()) {
        echo "Transaction deleted successfully.";
    } else {
        echo "Error deleting transaction: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid Transaction ID.";
}

$conn->close();
?>
<br>
<a href="view_transactions.php">Back to View Transactions</a>
