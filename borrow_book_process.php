<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = $_POST['return_date'];

    $check_user_sql = "SELECT UserID FROM Patrons WHERE UserID = ?";
    $check_user_stmt = $conn->prepare($check_user_sql);
    $check_user_stmt->bind_param("i", $user_id);
    $check_user_stmt->execute();
    $check_user_stmt->store_result();

    if ($check_user_stmt->num_rows == 0) {
        echo "<p style='color:red;'>Error: UserID " . htmlspecialchars($user_id) . " does not exist. Please register the patron first.</p>";
        $check_user_stmt->close();
        $conn->close();
        echo "<br><a href='index.php'>Back to Home</a>";
        exit;
    }

    $check_user_stmt->close();

    $check_book_sql = "SELECT BookID FROM Books WHERE BookID = ?";
    $check_book_stmt = $conn->prepare($check_book_sql);
    $check_book_stmt->bind_param("i", $book_id);
    $check_book_stmt->execute();
    $check_book_stmt->store_result();

    if ($check_book_stmt->num_rows == 0) {
        echo "<p style='color:red;'>Error: BookID " . htmlspecialchars($book_id) . " does not exist. Please add the book first.</p>";
        $check_book_stmt->close();
        $conn->close();
        echo "<br><a href='index.php'>Back to Home</a>";
        exit;
    }

    $check_book_stmt->close();

     $check_available_sql = "SELECT IsAvailable FROM Books WHERE BookID = ? AND IsAvailable = TRUE";
     $check_available_stmt = $conn->prepare($check_available_sql);
     $check_available_stmt->bind_param("i", $book_id);
     $check_available_stmt->execute();
     $check_available_stmt->store_result();

     if ($check_available_stmt->num_rows == 0) {
         echo "<p style='color:red;'>Error: Book with BookID " . htmlspecialchars($book_id) . " is not available for borrowing.</p>";
         $check_available_stmt->close();
         $conn->close();
         echo "<br><a href='index.php'>Back to Home</a>";
         exit;
     }

     $check_available_stmt->close();

    $conn->begin_transaction();

    try {
        $sql = "INSERT INTO Transactions (UserID, BookID, BorrowDate, ReturnDate) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiss", $user_id, $book_id, $borrow_date, $return_date);
        $stmt->execute();

        $transaction_id = $conn->insert_id;

        $update_book_sql = "UPDATE Books SET IsAvailable = FALSE WHERE BookID = ?";
        $update_book_stmt = $conn->prepare($update_book_sql);
        $update_book_stmt->bind_param("i", $book_id);
        $update_book_stmt->execute();

        $update_book_stmt->close();

        $conn->commit();

        echo "Book borrowed successfully. Transaction ID: " . htmlspecialchars($transaction_id);
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Error: " . $exception->getMessage();
    }


    $stmt->close();
    $conn->close();
} else {
    echo "This script should only be accessed via POST request.";
}
?>
<br>
<a href="index.php" class="back-to-home">Back to Home</a>

