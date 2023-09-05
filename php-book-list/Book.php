<?php
class Book {
    private $conn;

    public function __construct() {
        // Establish database connection
        $this->conn = new mysqli('localhost', 'root', '', 'books');
        if($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getBooks() {
        $query = "SELECT * FROM books";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createBook($title, $author) {
        $query = "INSERT INTO books (title, author) VALUES ('$title', '$author')";
        $this->conn->query($query);
        header('Location: index.php');
    }

    public function updateBook($id, $title, $author) {
        $query = "UPDATE books SET title='$title', author='$author' WHERE id=$id";
        $this->conn->query($query);
        header('Location: index.php');
    }

    public function deleteBook($id) {
        $query = "DELETE FROM books WHERE id=$id";
        $this->conn->query($query);
        header('Location: index.php');
    }
}
?>
