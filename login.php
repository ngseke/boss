<?php session_start(); ?>
<?php
$login = isset($_SESSION['username']) ? true : false ;
?>
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
    <div class="row">
      <div class="col-md-4 offset-md-4">
      <div class="card">
        <div class="card-header text-center"><span class="oi oi-account-login"></span> 登入</div>
        <div class="card-body">

          <div class="col-12 <?php if(!$login)echo 'd-none'; ?>">
            <div class="alert alert-info" >請先登出後再執行動作。</div>
          </div>
          <form class="row" action="login_user.php" method="post">
            <div class="col-12 form-group">
              <label for="">帳號</label>
              <input <?php if($login)echo 'disabled'; ?> type="text" name="username" placeholder="帳號" class="form-control" required>
            </div>
            <div class="col-12 form-group">
              <label for="">密碼</label>
              <input <?php if($login)echo 'disabled'; ?> type="password" name="password" placeholder="密碼" class="form-control" required>
            </div>
            <div class="col-12 form-group">
              <button <?php if($login)echo 'disabled'; ?> class="btn btn-primary btn-block <?php if($login)echo 'btn-secondary'; ?>" type="submit" >LOGIN</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>  
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>
</html>