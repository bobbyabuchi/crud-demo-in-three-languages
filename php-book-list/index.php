<!DOCTYPE html>
<html>
<head>
    <title>Book List App</title>
</head>
<body>
    <?php
    require_once 'Book.php';

    $book = new Book();

    // Handle Create
    if(isset($_POST['create'])) {
        $book->createBook($_POST['title'], $_POST['author']);
    }

    // Handle Update
    if(isset($_POST['update'])) {
        $book->updateBook($_POST['id'], $_POST['title'], $_POST['author']);
    }

    // Handle Delete
    if(isset($_GET['delete'])) {
        $book->deleteBook($_GET['delete']);
    }
    ?>

    <h2>Book List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Action</th>
        </tr>
        <?php
        $books = $book->getBooks();
        foreach ($books as $row) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['author']}</td>";
            echo "<td><a href='edit.php?id={$row['id']}'>Edit</a> | <a href='index.php?delete={$row['id']}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Add New Book</h2>
    <form method="post">
        <label>Title: <input type="text" name="title"></label>
        <label>Author: <input type="text" name="author"></label>
        <button type="submit" name="create">Add Book</button>
    </form>
</body>
</html>
