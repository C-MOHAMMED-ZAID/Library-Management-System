<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Return Book</h2>

    <form action="return_book_process.php" method="POST">
        <label for="transaction_id">Transaction ID:</label>
        <input type="text" id="transaction_id" name="transaction_id" required><br>

        <input type="submit" value="Return Book">
    </form>
    <br>

    <a href="index.php" class="back-to-home">Back to Home</a>

</body>
</html>
