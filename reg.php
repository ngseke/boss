<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '註冊' ?>
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
  <?php require_once ('js.php') ?>
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="container my-3">
    <div class="row">
      <div class="col-12 col-lg-6 offset-lg-3">
        <div class="card">
          <div class="card-header text-center">註冊</div>
          <div class="card-body">
            <?php include('echo_alert.php') ?>
            <form class="row reg-panel" method="post" enctype="multipart/form-data" >
              <div class="col-12">
                <div id="RegAlert" class="alert text-center d-none"></div>
              </div>
              <div class="col-12 form-group">
                <label>帳號 <span class="text-info">*</span></label>
                <input type="text" value="newbie" name="ID" placeholder="Username" maxlength="20" class="form-control" required>
                <small id="IDIsDuplicate" class="text-warning d-none"></small>
              </div>
              <div class="col-12 form-group">
                <label>密碼 <span class="text-info">*</span></label>
                <input type="password" value="newbie" name="Password" placeholder="Password" maxlength="20" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label>姓名 <span class="text-info">*</span></label>
                <input type="text" value="新鮮人" name="Name" placeholder="Name" maxlength="12" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label>Email <span class="text-info">*</span></label>
                <input type="email" value="newbie@gmail.com" name="Email" placeholder="Email" maxlength="30" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6  form-group">
                <label>電話 <span class="text-info">*</span></label>
                <input type="text" value="0912345678" name="Phone" placeholder="Phone" maxlength="10" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label>生日</label>
                <input type="date" value="1911-10-10" name="Birth" placeholder="Birth" class="form-control" >
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label>性別</label>
                <select class="form-control" name="Gender" required>
                  <option value="M">男</option>
                  <option value="F">女</option>
                  <option value="N">不明</option>
                </select>
              </div>
              <div class="col-12 form-group">
                <label>地址</label>
                <input type="text" value="台北市大安區忠孝東路三段一號" name="Address" placeholder="Address" maxlength="100" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <button id="reg" class="btn btn-success btn-block" type="button" >立即註冊</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php include('footer.php') ?>
</body>


<!-- 註冊JQ -->
<script type="text/javascript">
// AJAX
$("#reg").click(function(){
  $.post("reg_user.php",
  {
    ID: $("input[name='ID']").val(),
    Password: $("input[name='Password']").val(),
    Name: $("input[name='Name']").val(),
    Email: $("input[name='Email']").val(),
    Phone: $("input[name='Phone']").val(),
    Birth: $("input[name='Birth']").val(),
    Gender: $("select[name='Gender']").val(),
    Address: $("input[name='Address']").val()
  },
  function(data,status){
    $('#RegAlert').removeClass('d-none').removeClass('alert-success').removeClass('alert-danger');
    if(data=='success'){
      $('.reg-panel').empty().html('<div class="col-12 text-center my-3 text-info"><i class="material-icons" style="font-size:5rem">done</i><h5>成功註冊!</h5></div>');
      // 等待一秒後刷新頁面
      setTimeout(function(){location.reload();}, 1000);
    }else {
      $('#RegAlert').addClass('alert-danger').html('<i class="material-icons">block</i> 註冊失敗! 請重新確認輸入資料。');
    }
  });
});

// 提示帳號已被使用
$("input[name='ID']").change(function(){
  $.post("login_user.php",
  {
    ID: $("input[name='ID']").val(),
    Password: ''
  },
  function(data,status){
    if(data=='pwerr'){
      $('#IDIsDuplicate').html('<i class="material-icons" style="font-size:.8rem">clear</i> 帳號已被使用!').removeClass('d-none');
    }else{
      $('#IDIsDuplicate').html('').addClass('d-none')
    }
  });
});

</script>
</html>
