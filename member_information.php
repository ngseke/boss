<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '修改會員資料' ?>
<?php $login = isset($_SESSION['ID']) ? true : false ; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <?php // 若無權限
  if(!isset($_SESSION['ID']))
    die ('<meta http-equiv="refresh" content="0;URL=index.php">');
  ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <?php require_once ('js.php') ?>
</head>

<body>
  <?php include('nav.php'); ?>
  <?php
        $sql = "SELECT * FROM MEMBER
                WHERE ID = '$user_id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_array($result);
        $ID=$row['ID'];
        $Password=$row['Password'];
        $Name=$row['Name'];
        $Email=$row['Email'];
        $Phone=$row['Phone'];
        $RegDate=$row['RegDate'];
        $Birth=$row['Birth'];
        $Gender=$row['Gender'];
        $Address=$row['Address'];
       ?>
  <div class="container my-3">
    <?php include('echo_alert.php') ?>
    <div class="row">
      <div class="col-12 col-lg-6 offset-lg-3">
        <div class="card">
          <div class="card-header text-center">修改資料</div>
          <div class="card-body">
            <form class="row" action="member_information_edit.php" method="post" enctype="multipart/form-data" >
              <div class="col-12">
                <div id="LoginAlert" class="alert text-center d-none">123</div>
              </div>
              <div class="col-12 form-group">
                <label for="">帳號<span class="text-info">*</span></label>
                <input type="text" value="<?php echo $ID;?>" name="ID" class="form-control" readonly>
              </div>
              <div class="col-12 form-group">
                <label for="">密碼<span class="text-info">*</span></label>
                <input type="password" name="Password" placeholder = "若不修改請留白" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <label for="">姓名<span class="text-info">*</span></label>
                <input type="text" value="<?php echo $Name;?>" name="Name" placeholder="" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">E-mail<span class="text-info">*</span></label>
                <input type="email" value="<?php echo $Email;?>" name="Email" maxlength="30" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">電話<span class="text-info">*</span></label>
                <input type="text" name="Phone" value="<?php echo $Phone;?>" placeholder="0987654321" maxlength="10" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">生日</label>
                <input type="date" value="<?php echo $Birth;?>" name="Birth" placeholder="Birth" class="form-control" >
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">性別</label>
                <select class="form-control" value="<?php echo $Gender;?>" name="Gender" required>
                  <?php
                    $genderList= array('M','F','N');
                    $genderTextList= array('男(M)','女(F)','未知(N)');
                    foreach ($genderList as $key => $ppap) {
                      $isThisSelected = ($Gender==$ppap)?'selected ':'';
                      echo '<option value="'.$ppap.'" '. $isThisSelected .' >'.$genderTextList[$key].'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="col-12 form-group">
                <label for="">地址</label>
                <input type="text" name="Address" value="<?php echo $Address;?>" maxlength="100" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <button class="btn btn-success btn-block" type="submit" >立即修改</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php include('footer.php') ?>
</body>

</html>
