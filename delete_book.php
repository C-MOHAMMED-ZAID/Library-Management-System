<?php
include 'db_connection.php';

if (isset($_GET['book_id']) && is_numeric($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    $conn->begin_transaction();

    try {
        $sql_delete_transactions = "DELETE FROM Transactions WHERE BookID = ?";
        $stmt_delete_transactions = $conn->prepare($sql_delete_transactions);
        $stmt_delete_transactions->bind_param("i", $book_id);
        $stmt_delete_transactions->execute();
        $stmt_delete_transactions->close();

        $sql_delete_book = "DELETE FROM Books WHERE BookID = ?";
        $stmt_delete_book = $conn->prepare($sql_delete_book);
        $stmt_delete_book->bind_param("i", $book_id);
        $stmt_delete_book->execute();
        $stmt_delete_book->close();

        $conn->commit();

        echo "Book and related transactions deleted successfully.";
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Error deleting book: " . $exception->getMessage();
    }

    $conn->close();
} else {
    echo "Invalid Book ID.";
}
?>
<br>
<a href="view_books.php">Back to View Books</a>
