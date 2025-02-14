<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patron</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add New Patron</h2>
    <form action="add_patron_process.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="3"></textarea><br>

        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number"><br>

        <input type="submit" value="Add Patron">
    </form>
    <br>
<a href="index.php" class="back-to-home">Back to Home</a>

</body>
</html>
