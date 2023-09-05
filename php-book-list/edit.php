<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>
    <?php
    require_once 'Book.php';

    $book = new Book();

    if(isset($_GET['id'])) {
        $bookId = $_GET['id'];
        $bookData = $book->getBooks();
        foreach ($bookData as $row) {
            if($row['id'] == $bookId) {
                $title = $row['title'];
                $author = $row['author'];
                break;
            }
        }
    }

    // Handle Update
    if(isset($_POST['update'])) {
        $book->updateBook($_POST['id'], $_POST['title'], $_POST['author']);
    }
    ?>

    <h2>Edit Book</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $bookId; ?>">
        <label>Title: <input type="text" name="title" value="<?php echo $title; ?>"></label>
        <label>Author: <input type="text" name="author" value="<?php echo $author; ?>"></label>
        <button type="submit" name="update">Update Book</button>
    </form>
</body>
</html>
