<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '管理商品' ?>
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

  <div class="container mt-3"><?php include('echo_alert.php') ?></div>

  <div class="container">

    <div class="row">
      <div class="col-12 col-lg-2 mb-3">
        <a href="product_list_new.php" class="btn btn-primary btn-block btn-lg" role="button">新增商品</a>
      </div>
      <div class="col-12">
        <table class="table mt-3 d-none d-lg-table ">
          <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col" style="width:8rem">名稱</th>
              <th scope="col" style="width:5rem">狀態</th>
              <th scope="col" style="width:5rem">庫存數量</th>
              <th scope="col" style="width:4rem">價錢</th>
              <th scope="col" style="width:10rem" >圖片</th>
              <th scope="col">商品介紹</th>
              <th scope="col">修改</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM product";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()){
                switch ($row["State"]) {
                  case 'in_stock': $state = '<span class="badge badge-success">現貨</span>'; break;
                  case 'out_of_stock': $state = '<span class="badge badge-warning">缺貨</span>'; break;
                  case 'removed_from_shelves': $state = '<span class="badge badge-secondary">已下架</span>'; break;
                  default: $state = $row["State"]; break;
                }

                echo
                '<tr>
                <td>' . $row["ID"] . '</td>
                <td><a href="product_detail.php?ID='.  $row["ID"] .'">' . $row["Name"] . '</a></td>
                <td>' . $state . '</td>
                <td>' . $row["Stock"] . '</td>
                <td>' . $row["Price"] . '</td>
                <td class="text-center"> <img src ="' .$row['Img'] . '" class="img-fluid" style="max-height:5rem"></td>
                <td>' . $row["Info"] . '</td>
                <td> <button type="button" class="btn btn-primary" onclick="location.href=\'product_list_detail.php?ID=' .$row["ID"].'\'"> 改爆 </button> </td>
                </tr>';
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>
<html>
