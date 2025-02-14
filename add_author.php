<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Author</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add New Author</h2>
    <form action="add_author_process.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="biography">Biography:</label>
        <textarea id="biography" name="biography" rows="4" cols="50"></textarea><br>

        <input type="submit" value="Add Author">
    </form>
    <br>
<a href="index.php" class="back-to-home">Back to Home</a>

</body>
</html>
