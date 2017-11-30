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
</head>
<?php $sql= "DELETE FROM MEMBER
               WHERE ID ='" .$_GET['ID']."'"; ?>
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

      <div class="col-12 col-lg-6 offset-lg-3 mt-5">
        <div class="card">
          <div class="card-header text-center">修改會員</div>
          <div class="card-body">
            <form class="row" action="user_list_new_add.php" method="post" enctype="multipart/form-data" >
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
                  <option value="M">男</option>
                  <option value="F">女</option>
                  <option value="N">不明</option>
                </select>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">職位<span class="text-info">*</span></label>
                <select class="form-control" value="<?php echo $Position;?>" name="Position" required>
                  <option value="C">Customer</option>
                  <option value="S">Staff</option>
                  <option value="A">Admin</option>
                </select>
              </div>
              <div class="col-12 form-group">
                <label for="">地址<span class="text-info">*</span></label>
                <input type="text" name="Address" value="<?php echo $Address;?>" maxlength="100" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <button class="btn btn-success btn-block" type="submit" name="update" >立即修改</button>
              </div>
              <div class="col-12 form-group">
                <button class="btn btn-danger btn-block" type="submit" name="delete">刪除此用戶</button>
              </div>
            </form>
            
          </div>
        </div>

      </div>
    </div>
  </div>
  
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
