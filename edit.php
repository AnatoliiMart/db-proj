<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Book</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <?php
    require_once('./connect.php');
    $stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
    $stmt->execute(['id' => $_GET['id']]);
    $book = $stmt->fetch(PDO::FETCH_OBJ);
    ?>
    <h1 class="mb-4">Edit Book</h1>
    <form action="index.php" method="post">
      <div class="form-group">
        <input type="hidden" name="id" value="<?= $book->id ?>">
        <label for="title">Title:</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title" value="<?= $book->title ?>">
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control" name="price" id="price" value="<?= $book->price ?>">
      </div>
      <button type="submit" class="btn btn-primary" name="upadate">Save Changes</button>
    </form>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>