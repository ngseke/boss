<?php session_start(); ?>
<?php include('connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>

  <!-- 根據所在頁面 印出對應的標題 -->
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>
<body>
  <?php include('nav.php'); ?>

  <div class="container mt-3">
    <form method="post">
      <div class="row">
        <div class="col-12 text-center">
          <?php
          $sql = "SELECT ID, Password FROM MEMBER WHERE ID='" . $_POST['ID']."'";
          $result = $conn->query($sql);
          $rows = mysqli_fetch_array($result);
          if(mysqli_num_rows($result) >= 1){ 
            if (md5($_POST['Password']) == $rows['Password']) { 
              $_SESSION['ID'] = $_POST['ID']; 
              echo '<div class="alert alert-success">';
              echo "登入成功";
              echo '</div>';
            } else {
              echo '<div class="alert alert-danger">';
              echo "密碼錯誤！";
              echo '</div>';
            }
          } else {
            echo '<div class="alert alert-danger">';
            echo "查無此帳號！";
            echo '</div>';
          }
          $conn->close();
          ?>
        </div>
      </div>
    </form>
  </div>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>
</html>