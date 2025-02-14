# Library Management System

## Overview

The Library Management System is a web-based solution designed to streamline and automate the operations of a library. It provides an intuitive interface for managing books, authors, patrons, and transactions, making it easier for library staff to keep track of resources and activities. The system supports adding, editing, and deleting books, authors, and patrons.

## Features

-   **Book Management**: Add, edit, and delete book records, including title, author, genre, publication year, and availability status.
-   **Author Management**: Maintain a database of authors with names and biographies.
-   **Patron Management**: Add and manage patron details, including name, contact information, and borrowing history.
-   **Transaction Tracking**: Track borrowing and return transactions, including borrow date and return date.
-   **User-Friendly Interface**: An intuitive and responsive design ensures ease of use for library staff.
-   **Reporting**: Basic reporting features to monitor library operations.
-   **Search Functionality**: Quickly find books, authors, and patrons using search queries.

## Technologies Used

-   **Frontend**:
    -   HTML5
    -   CSS3
-   **Backend**:
    -   PHP
    -   MySQL

## Database Schema

The system uses the following database tables:

-   **Books**:
    -   `BookID` (INT, Primary Key)
    -   `Title` (VARCHAR)
    -   `AuthorID` (INT, Foreign Key to `Authors`)
    -   `Genre` (VARCHAR)
    -   `PublishedYear` (INT)
    -   `IsAvailable` (BOOLEAN)
-   **Authors**:
    -   `AuthorID` (INT, Primary Key)
    -   `Name` (VARCHAR)
    -   `Biography` (TEXT)
-   **Patrons**:
    -   `UserID` (INT, Primary Key)
    -   `Name` (VARCHAR)
    -   `Email` (VARCHAR)
    -   `Address` (VARCHAR)
    -   `PhoneNumber` (VARCHAR)
-   **Transactions**:
    -   `TransactionID` (INT, Primary Key)
    -   `UserID` (INT, Foreign Key to `Patrons`)
    -   `BookID` (INT, Foreign Key to `Books`)
    -   `BorrowDate` (DATE)
    -   `ReturnDate` (DATE, NULLABLE)

## Installation Instructions

1.  **Clone the Repository**:

    ```
    git clone https://github.com/C-MOHAMMED-ZAID/Library-Management-System.git
    ```
2.  **Set Up Local Server**:

    -   Install XAMPP or MAMP to create a local server environment.
    -   Place the project folder in the `htdocs` directory (XAMPP) or the `www` directory (MAMP).
3.  **Create Database**:

    -   Open phpMyAdmin and create a new database named `library_db`.
    -   Import the database schema (if a `.sql` file is provided) or manually create the tables as described in the Database Schema section.
4.  **Configure Database Connection**:

    -   Edit `db_connection.php` to update the database connection settings:

        ```
        <?php
        $servername = "localhost";
        $username = "your_mysql_username";
        $password = "your_mysql_password";
        $dbname = "library_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        ?>
        ```
5.  **Run the Application**:

    -   Open your web browser and navigate to `http://localhost/library-management-system`.

## Contribution

Contributions are welcome! If you'd like to contribute, please follow these guidelines:

1.  Fork the repository.
2.  Create a new branch for your feature or bug fix:

    ```
    git checkout -b feature/your-feature-name
    ```
3.  Implement your changes, ensuring code quality and proper testing.
4.  Commit your changes with a descriptive message:

    ```
    git commit -m "Add your descriptive commit message"
    ```
5.  Push your branch to GitHub:

    ```
    git push origin feature/your-feature-name
    ```
6.  Submit a pull request to the main branch.

## Notes

-   Ensure that your database user has the necessary privileges to create, modify, and delete tables.
-   The system assumes a basic understanding of PHP and MySQL.

## License

This project is open-source and available under the [MIT License](LICENSE).
