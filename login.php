<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '登入' ?>
<?php $login = isset($_SESSION['ID']) ? true : false ; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <?php if($login) die ('<meta http-equiv="refresh" content="0;URL=index.php">'); ?>
  <?php include('js.php') ?>
</head>
<body>
  <?php include('nav.php'); ?>
  <div class="container my-3">
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <div class="card">
          <div class="card-header text-center"><span class="oi oi-account-login"></span> 登入</div>
          <div class="card-body">
            <?php include('echo_alert.php') ?>
            <div id="LoginAlert" class="alert text-center d-none"></div>
            <div class="row" action="" method="post">
              <div class="col-12 form-group">
                <label for="">帳號</label>
                <input id="LoginID" value="admin" type="text" name="ID" placeholder="帳號" class="form-control" required>
                <small id="NoSuchID" class="text-warning d-none"></small>
              </div>
              <div class="col-12 form-group">
                <label for="">密碼</label>
                <input id="LoginPW" value="pw" type="password" name="Password" placeholder="密碼" class="form-control" required>
                <small class="text-muted">萬用密碼'pw'</small>
              </div>
              <div class="col-12 form-group">
                <button id="login" class="btn btn-primary btn-block" type="button">LOGIN</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  // AJAX登入
  $("#login").click(function(){
    $.post("login_user.php",
    {
      ID: $('#LoginID').val(),
      Password: $('#LoginPW').val()
    },
    function(data,status){
      $('#LoginAlert').removeClass('d-none').removeClass('alert-success').removeClass('alert-danger').removeClass('alert-warning');
      if(data=='success'){
        $('#LoginAlert').addClass('alert-success').html('已成功登入!');
        window.location.href='index.php'; // 跳轉
      }else {
        $('#LoginAlert').addClass('alert-danger').html('帳號或密碼錯誤!');
      }
    });
  });

  // 提示帳號不存在
  $("#LoginID").change(function(){
    $.post("login_user.php",
    {
      ID: $('#LoginID').val(),
      Password: ''
    },
    function(data,status){
      if(data=='iderr'){
        $('#NoSuchID').html('查無此帳號').removeClass('d-none');
      }else{
        $('#NoSuchID').html('').addClass('d-none')
      }
    });
  });

  // 按下ENTER鍵觸發事件
  $(function(){
    document.onkeydown = function(e){
      var ev = document.all ? window.event : e;
      if(ev.keyCode==13) $('#login').click();
    }
  });
  </script>
  <?php include('footer.php') ?>
</body>

</html>
