<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '註冊' ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-6 offset-lg-3">
        <div class="card">
          <div class="card-header text-center">註冊</div>
          <div class="card-body">

            <form class="row" action="reg_user.php" method="post" enctype="multipart/form-data" >
              <div class="col-12 form-group">
                <label for="">帳號 <span class="text-info">*</span></label>
                <input type="text" value="asdf" name="ID" placeholder="Username" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">密碼 <span class="text-info">*</span></label>
                <input type="password" value="asdf" name="Password" placeholder="Password" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">Email <span class="text-info">*</span></label>
                <input type="email" value="asdf@gmail.com" name="Email" placeholder="Email" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">電話 <span class="text-info">*</span></label>
                <input type="text" value="0987654321" name="Phone" placeholder="Phone" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">生日</label>
                <input type="date" value="2017-11-26" name="Birth" placeholder="Birth" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <label for="">性別</label>
                <select class="form-control" name="Gender" required>
                  <option value="M">男</option>
                  <option value="F">女</option>
                  <option value="N">不明</option>
                </select>
              </div>
              <div class="col-12 form-group">
                <label for="">地址</label>
                <input type="text" value="taipei" name="Address" placeholder="Address" class="form-control" >
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
