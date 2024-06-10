<?php
require 'vendor/autoload.php';
require_once('./connect.php');
require_once('./Book.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <?php

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\IOFactory;


  if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];

    // $stmt = $pdo->prepare("INSERT INTO books (title, price) VALUES (?, ?)");
    // $stmt->execute([$title, $price]);

    $stmt = $pdo->prepare("INSERT INTO books (title, price) VALUES (:title, :price)");
    $stmt->execute(['title' => $title, 'price' => $price]);

    header('Location: index.php');
    exit;
  }
  if (isset($_POST['upadate'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("UPDATE books SET title = :title, price = :price WHERE id = :id");
    $stmt->execute(['title' => $title, 'price' => $price, 'id' => $id]);

    header('Location: index.php');
    exit;
  }
  if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header('Location: index.php');
    exit;
  }
  if (isset($_POST['download_file'])) {
    $stmt = $pdo->query('SELECT * FROM books');
    $books = $stmt->fetchAll(PDO::FETCH_CLASS, 'Book');
    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'Title')
      ->setCellValue('B1', 'Price')
      ->setCellValue('C1', 'Created At');

    foreach ($books as $index => $book) {

      $spreadsheet->getActiveSheet()
        ->setCellValue('A' . ($index + 2), $book->title)
        ->setCellValue('B' . ($index + 2), $book->getPrice())
        ->setCellValue('C' . ($index + 2), $book->created_at);
    }
    if (file_exists($_POST['filename'] . ".xlsx")) {
      unlink($_POST['filename'] . ".xlsx");
    }
    $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
    $writer->save($_POST['filename'] . ".xlsx");
    unset($_POST['filename']);
    header('Location: index.php');
    exit;
  }
  $stmt = $pdo->query('SELECT * FROM books');
  $books = $stmt->fetchAll(PDO::FETCH_CLASS, 'Book');
  ?>

  <div class="container mt-4">
    <a href="create.php" class="btn btn-primary mb-3">Add New Book</a>
    <a href="download_xlsx.php" class="btn btn-warning mb-3 ml-2">Download as XLSX file</a>
    <table class="table table-hover table-striped">
      <thead class="thead-dark">
        <tr>
          <th>id</th>
          <th>Title</th>
          <th>Price</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php foreach ($books as $book) :
          $id = $book->id;
          $title = $book->title;
          $price = $book->getPrice();
          $created_at = $book->created_at;
        ?>
          <tr>
            <td class="align-middle"><?= $id ?></td>
            <td class="align-middle"><?= $title ?></td>
            <td class="align-middle"><?= $price ?></td>
            <td class="align-middle"><?= $created_at ?></td>
            <td>
              <a href="edit.php?id=<?= $id ?>" class="btn btn-success">Edit</a>
              <form action="index.php" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button name="delete" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>