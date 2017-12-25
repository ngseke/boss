<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '會員列表' ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <?php // 若無權限
  if(!($user_position=='A'||$user_position=='S'))
    die ('<meta http-equiv="refresh" content="0;URL=index.php">');
  if(!isset($_GET['page']))
    die ('<meta http-equiv="refresh" content="0;URL=user_list.php?page=1">'); ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>

<body>

  <?php include('nav.php') ?>

  <div class="container my-3">
    <?php include('echo_alert.php') ?>
    <div class="row">
      <div class="col-12 btn-group">
        <button class="btn btn-outline-primary btn-lg <?php if($_GET['page']==1)echo 'active '?>" onclick="location.href='?page=1'">管理會員</button>
        <button class="btn btn-outline-primary btn-lg <?php if($_GET['page']==2)echo 'active '?>" onclick="location.href='?page=2'">新增</button>
      </div>
      
      <div class="col-12 text-center <?php if($_GET['page']!=1)echo 'd-none ' ?>">
        <h2 class=" my-3 d-none" style="border-bottom:5px #333 solid;">管理會員</h2>
        <table class="table table-hover table-dark my-3 ">
          <thead>
            <tr>
              <th scope="col" style="">ID</th>
              <th scope="col" style="">名稱</th>
              <th scope="col" style="">Email</th>
              <th scope="col" style="">電話</th>
              <th scope="col" style="">生日</th>
              <th scope="col" style="">性別</th>
              <th scope="col" style="">地址</th>
              <th scope="col" style="">註冊日</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = 'SELECT * FROM MEMBER ORDER BY RegDate DESC';
            $result = $conn->query($sql);
            while($rows = mysqli_fetch_array($result))
            {
              if($rows['Position']=='A'){
              $positionName= '<span class="badge badge-pill badge-warning">管理員</span>';
              } else if($rows['Position']=='S'){
               $positionName='<span class="badge badge-pill badge-info">店員</span>';
              } else{
                $positionName='<span class="badge badge-pill badge-secondary">顧客</span>';
              }

              echo '<tr style="cursor: pointer;" onclick="location.href=\'user_list_detail.php?ID=' . $rows['ID'].'\'">';

              echo '<td class="align-middle">'.$positionName.' '.$rows['ID'].'</td>';
              echo '<td class="align-middle">'.$rows['Name'].'</td>';
              echo '<td class="align-middle">'.$rows['Email'].'</td>';
              echo '<td class="align-middle">'.$rows['Phone'].'</td>';
              echo '<td class="align-middle">'.$rows['Birth'].'</td>';
              echo '<td class="align-middle">'.$rows['Gender'].'</td>';
              echo '<td class="align-middle">'.$rows['Address'].'</td>';
              echo '<td class="align-middle">'.$rows['RegDate'].'</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
      <div class="col-12 col-lg-6 offset-lg-3 my-3 <?php if($_GET['page']!=2)echo 'd-none ' ?>">
        <div class="card">
          <div class="card-header text-center">新增會員</div>
          <div class="card-body">
            <form class="row" action="user_list_new_add.php" method="post" enctype="multipart/form-data" >
              <div class="col-12 form-group">
                <label for="">姓名<span class="text-info">*</span></label>
                <input type="text" name="Name" placeholder="" class="form-control" required>
              </div>
              <div class="col-12 form-group">
                <label for="">帳號<span class="text-info">*</span></label>
                <input type="text" name="ID" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <label for="">密碼<span class="text-info">*</span></label>
                <input type="text" name="Password" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <label for="">E-mail<span class="text-info">*</span></label>
                <input type="email" name="Email" placeholder="asdf@gmail.com" maxlength="30" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">電話<span class="text-info">*</span></label>
                <input type="text" name="Phone" placeholder="0987654321" maxlength="10" class="form-control" required>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">生日<span class="text-info">*</span></label>
                <input type="date" value="1911-10-10" name="Birth" placeholder="Birth" class="form-control" >
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">性別<span class="text-info">*</span></label>
                <select class="form-control" name="Gender" required>
                  <option value="M">男</option>
                  <option value="F">女</option>
                  <option value="N">不明</option>
                </select>
              </div>
              <div class="col-12 col-lg-6 form-group">
                <label for="">職位<span class="text-info">*</span></label>
                <select class="form-control" name="Position" required>
                  <option value="C">Customer</option>
                  <option value="S">Staff</option>
                  <option value="A">Admin</option>
                </select>
              </div>
              <div class="col-12 form-group">
                <label for="">地址<span class="text-info">*</span></label>
                <input type="text" name="Address" placeholder="台北市大安區忠孝東路三段一號" maxlength="100" class="form-control" >
              </div>
              <div class="col-12 form-group">
                <button class="btn btn-success btn-block" type="submit" >立即新增</button>
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
