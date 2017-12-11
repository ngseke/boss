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
            <form class="row" action="reg_user.php" method="post" enctype="multipart/form-data" >
              <div class="col-12 form-group">
                <label for="">帳號 <span class="text-info">*</span></label>
                <input type="text" value="admin" name="ID" placeholder="Username" maxlength="20" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">密碼 <span class="text-info">*</span></label>
                <input type="password" value="admin" name="Password" placeholder="Password" maxlength="20" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">姓名 <span class="text-info">*</span></label>
                <input type="text" value="管理員大大" name="Name" placeholder="Name" maxlength="12" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">Email <span class="text-info">*</span></label>
                <input type="email" value="admin@gmail.com" name="Email" placeholder="Email" maxlength="30" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6  form-group">
                <label for="">電話 <span class="text-info">*</span></label>
                <input type="text" value="0912345678" name="Phone" placeholder="Phone" maxlength="10" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">生日</label>
                <input type="date" value="1911-10-10" name="Birth" placeholder="Birth" class="form-control" >
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">性別</label>
                <select class="form-control" name="Gender" required>
                  <option value="M">男</option>
                  <option value="F">女</option>
                  <option value="N">不明</option>
                </select>
              </div>
              <div class="col-12 form-group">
                <label for="">地址</label>
                <input type="text" value="台北市大安區忠孝東路三段一號" name="Address" placeholder="Address" maxlength="100" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <button class="btn btn-success btn-block" type="submit" >立即註冊</button>
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
