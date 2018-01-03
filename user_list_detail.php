<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '修改會員' ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <?php require_once ('js.php') ?>
  <?php 
  if(!($user_position=='A'||$user_position=='S'))
    die ('<meta http-equiv="refresh" content="0;URL=index.php">');
   ?>
</head>
<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>

  <div class="container my-3">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="d-inline-block my-3" style="border-bottom:5px #333 solid;">修改會員</h2>
      </div>

      <?php
        $sql = "SELECT * FROM MEMBER
                WHERE ID ='" . $_GET['ID']."'";
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
        $Position=$row['Position'];
       ?>

      <div class="col-12 col-lg-6 offset-lg-3 mt-3">
        <div class="card">
          <div class="card-header text-center">修改會員</div>
          <div class="card-body">
            <form class="row" action="user_list_detail_edit.php" method="post" enctype="multipart/form-data" >
              <div class="col-12 form-group">
                <label for="">帳號<span class="text-info">*</span></label>
                <input type="text" value="<?php echo $ID;?>" name="ID" class="form-control" readonly>
              </div>
              <div class="col-12 form-group">
                <label for="">姓名<span class="text-info">*</span></label>
                <input type="text" value="<?php echo $Name;?>" name="Name" placeholder="" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">密碼<span class="text-info">*</span></label>
                <input type="text" name="Password" placeholder = "若不修改請留白" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <label for="">E-mail<span class="text-info">*</span></label>
                <input type="email" value="<?php echo $Email;?>" name="Email" maxlength="30" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">電話<span class="text-info">*</span></label>
                <input type="text" name="Phone" value="<?php echo $Phone;?>" placeholder="0987654321" maxlength="10" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">生日<span class="text-info">*</span></label>
                <input type="date" value="<?php echo $Birth;?>" name="Birth" placeholder="Birth" class="form-control" >
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">性別<span class="text-info">*</span></label>
                <select class="form-control" value="<?php echo $Gender;?>" name="Gender" required>
                  <?php
                    // 如果直接對select標籤預設value是不管用der
                    // 所以改以PHP生成下拉式選單的選項，為了個別設置原來選項的selected
                    $genderList= array('M','F','N');
                    $genderTextList= array('男(M)','女(F)','未知(N)');
                    foreach ($genderList as $key => $ppap) {
                      $isThisSelected = ($Gender==$ppap)?'selected ':'';
                      echo '<option value="'.$ppap.'" '. $isThisSelected .' >'.$genderTextList[$key].'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">職位<span class="text-info">*</span></label>
                <select class="form-control" value="<?php echo $Position;?>" name="Position" required>
                  <?php
                    // 以PHP生成下拉式選單的選項，為了個別設置原來選項的selected
                    
                    if ($Position=='A'){
                      $positionList= array('A');
                      $positionTextList = array('管理員 (Admin)');
                    }
                    else{
                      $positionList= array('C','S');
                      $positionTextList = array('顧客 (Customer)','員工 (Staff)');
                    }
                    
                    foreach ($positionList as $key => $ppap) {
                      $isThisSelected = ($Position==$ppap)?'selected ':'';
                      echo '<option value="'.$ppap.'" '. $isThisSelected .' >'.$positionTextList[$key].'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="col-12 form-group">
                <label for="">地址<span class="text-info">*</span></label>
                <input type="text" name="Address" value="<?php echo $Address;?>" maxlength="100" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <button class="btn btn-success btn-block" type="submit" >立即修改</button>
              </div>
              <div class="col-12 form-group">
                <a class="btn btn-danger btn-block" href="user_list_new_del.php?ID=<?php echo $ID;?>" >刪除此用戶</a>
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
