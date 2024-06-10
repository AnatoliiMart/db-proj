<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Download</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-2 d-flex flex-md-column justify-content-md-center align-items-md-center">
    <h1 class="mb-4">Download XLSX</h1>
    <form action="index.php" method="post" class="d-flex flex-lg-column align-items-md-center justify-content-md-center">
      <div class="form-group d-flex flex-lg-row align-items-md-center justify-content-md-center">
        <label for="filename">File name:</label>
        <input type="text" class="form-control ml-3 mb-2" style="width: 70%;" name="filename" placeholder="Enter the file name">
      </div>
      <button type="submit" class="btn btn-primary pl-5 pr-5" name="download_file">Download</button>
    </form>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>