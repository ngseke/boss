<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '管理訂單' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>
<body>
  <?php include('nav.php');
    $sql = "SELECT * FROM order_list_view";
    $result = $conn->query($sql);
  ?>
  <div class="container mt-3"><?php include('echo_alert.php') ?></div>
  <div class="container">
    <div class="row">
      <table class="table mt-5 d-none d-lg-table ">
        <thead>
          <tr class="text-center">
            <th scope="col">ID</th>
            <th scope="col">Date</th>
            <th scope="col">總金額</th>
            <th scope="col">狀態</th>
            <th scope="col">收件人</th>
            <th scope="col">折扣</th>
            <th scope="col">管理人</th>
            <th scope="col">查閱</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
              echo
              '<tr>
              <td>' . $row["ID"] . '</td>
              <td>' . $row["Date"] . '</td>
              <td>' . $row["FinalCost"] . '</td>
              <td>' . $row["State"] . '</td>
              <td>' . $row['memName'] . '</td>
              <td>' . $row['Info'] . '</td>
              <td>' .  $row['stfName'] . '</td>
              <td> <button type="button" class="btn btn-primary" onclick="location.href=\'order_list_detail.php?ID=' .$row["ID"].'\'"> 查閱 </button> </td>
              </tr>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>
<html>
