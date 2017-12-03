<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '刪除留言' ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <meta http-equiv="refresh" content="<?php echo 0 ?>;URL=product_detail.php?ID=<?php echo $_GET['PID'] ?>">
</head>
<body>
  <?php include('nav.php'); ?>

  <div class="container my-3">

    <div class="row">
      <div class="col-12 text-center">
        <?php
        $sql = "DELETE FROM COMMENT WHERE ID=" . $_GET['CommentID'];
        $result = $conn->query($sql);
        $_SESSION['AlertMsg'] =
        array('success','<i class="material-icons">check</i> 成功刪除評論',false);
        $conn->close();
        ?>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
