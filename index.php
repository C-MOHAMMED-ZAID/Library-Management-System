<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-container">
            <a href="index.php" class="navbar-brand">Library App</a>
            <ul class="navbar-menu">
                <li><a href="view_books.php">Books</a></li>
                <li><a href="view_transactions.php">Transactions</a></li>
                <li><a href="add_book.php">Add Book</a></li>
                <li><a href="add_author.php">Add Author</a></li>
                <li><a href="add_patron.php">Add Patron</a></li>
                <li><a href="borrow_book.php">Borrow Book</a></li>
                <li><a href="return_book.php">Return Book</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-container">
            <h1 class="hero-title">Discover a World of Knowledge</h1>
            <p class="hero-subtitle">Your all-in-one solution for library management.</p>
            <p class="hero-description">
                Explore a vast collection of books, manage your library's resources efficiently,
                and connect with readers. Our system helps you keep track of books, authors, patrons,
                and transactions, all in one place.
            </p>
        </div>
    </section>

    <section class="main-content about-section">
        <div class="content-container">
            <h2>About Our Library App</h2>
            <p>
                Our Library App is designed to streamline the operations of your library.
                Whether you're a small local library or a large institution, our app provides
                the tools you need to manage your resources effectively. From cataloging books
                to tracking borrowing activities, we've got you covered.
            </p>
            <ul>
                <li>Easily add and manage books and authors</li>
                <li>Keep track of patrons and their borrowing history</li>
                <li>Efficiently manage transactions and generate reports</li>
                <li>Provide a seamless experience for your library staff and patrons</li>
            </ul>
        </div>
    </section>

    <section class="contact-section">
        <div class="content-container">
            <h2>Contact Us</h2>
            <p>Have questions or need assistance? Reach out to us!</p>
            <form class="contact-form">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <input type="submit" value="Send Message">
            </form>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <p>&copy; <?php echo date("Y"); ?> Library App. All rights reserved.</p>
            <p>Contact: info@libraryapp.com</p>
        </div>
    </footer>

</body>
</html>
