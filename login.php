<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '登入' ?>
<?php
$login = isset($_SESSION['ID']) ? true : false ;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <?php if($login) echo '<meta http-equiv="refresh" content="0;URL=index.php">'; ?>
</head>
<body>
  <?php include('nav.php'); ?>
  <div class="container my-3">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <div class="card">
          <div class="card-header text-center"><span class="oi oi-account-login"></span> 登入</div>
          <div class="card-body">
            <form class="row" action="login_user.php" method="post">
              <div class="col-12 form-group">
                <label for="">帳號</label>
                <input <?php if($login)echo 'disabled'; ?> value="admin" type="text" name="ID" placeholder="帳號" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">密碼</label>
                <input <?php if($login)echo 'disabled'; ?> value="admin" type="password" name="Password" placeholder="密碼" class="form-control" required>
                <small class="text-muted">萬用密碼'pw'</small>
              </div>
              <div class="col-12 form-group">
                <button <?php if($login)echo 'disabled'; ?> class="btn btn-primary btn-block <?php if($login)echo 'btn-secondary'; ?>" type="submit" >LOGIN</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
