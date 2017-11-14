<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $result = $conn->query('SELECT * FROM PRODUCT');
  while ($rows= mysqli_fetch_array($result)) {
    echo $rows['id'] . '<br>';
  }

?>
<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="bootstrap.min.css">
  <title>BOSS</title>
</head>
<body>
  <div class="container">
    <div class="alert alert-primary text-center" role="alert">

    </div>

  </div>
</body>
</html>
