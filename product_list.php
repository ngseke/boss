<?php session_start(); ?>
<?php include('connection.php'); ?>
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
<div class="container">
  <div class="row">
    <div class="col-12">
      <table class="table mt-5 d-none d-lg-table ">
        <thead>
          <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">名稱</th>
            <th scope="col">狀態</th>
            <th scope="col">庫存數量</th>
            <th scope="col">價錢</th>
            <th scope="col">圖片</th>
            <th scope="col">資訊</th>
            <th scope="col">修改</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM product";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()){
                  echo
                  '<tr>
                  <td>' . $row["ID"] . '</td>
                  <td>' . $row["Name"] . '</td>
                  <td>' . $row["State"] . '</td>
                  <td style="width:100px;">' . $row["Stock"] . '</td>
                  <td style="width:75px;">' . $row["Price"] . '</td>
                  <td style="width:10rem;" class="text-center"> <img src ="' .$row['Img'] . '" class="img-fluid" style="max-height:5rem;"></td>
                  <td>' . $row["Info"] . '</td>
                  <td> <button type="button" class="btn btn-primary" onclick="location.href=\'product_list_detail.php?ID=' .$row["ID"].'\'"> 改爆 </button> </td>

                </tr>';
            }
          }
          ?>
        </tbody>
      </table>
      <div class="row">
        <div class="col-12 col-lg-2 offset-lg-10 mb-3">
          <a href="product_list_new.php" class="btn btn-primary btn-block btn-lg" role="button">新增一波</a>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>
<html>
