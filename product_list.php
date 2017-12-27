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
  <?php // 若無權限
  if(!($user_position=='A'||$user_position=='S'))
    die ('<meta http-equiv="refresh" content="0;URL=index.php">');
  if(!(isset($_GET['show'])&&isset($_GET['page'])))
    die ('<meta http-equiv="refresh" content="0;URL=product_list.php?show=list&page=0">'); ?>
  <!-- 根據所在頁面 印出對應的標題 -->
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>
<body>

  <?php include('nav.php'); ?>

  <div class="container mt-3">
    <?php include('echo_alert.php') ?>

    <div class="row">
      <div class="col-12 btn-group">
        <button class="btn btn-outline-primary btn-lg <?php if($_GET['show']=='list')echo 'active '?>" onclick="location.href='?show=list'">管理商品</button>
        <button class="btn btn-outline-primary btn-lg <?php if($_GET['show']=='new')echo 'active '?>" onclick="location.href='?show=new'">新增</button>
      </div>
      <!-- 管理商品 -->
      <div class="col-12 <?=($_GET['show']!='list')?'d-none ':''; ?> ">
        <?php
          if(isset($_GET['page'])){
            $total = mysqli_num_rows($conn->query("SELECT * FROM product")); // 共幾筆資料
            $limit = 10; // 每頁5筆
            $start = $_GET['page'] * $limit;
            $currentPage=$_GET['page'];
            $maxPage= ceil($total/$limit);
          }
        ?>

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
            if(isset($_GET['page'])) // 若有GET到頁數
               $sql .= " ORDER BY ID ASC LIMIT $start, $limit";

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
                <td><a class="text-dark" href="product_detail.php?ID='.  $row["ID"] .'">' . $row["Name"] . '</a></td>
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
        <!-- 翻頁 -->
        <div class="btn-toolbar mt-3">
          <div class="d-inline-block mx-auto">
            <div class="btn-group mr-2">
              <?php $goPageURL = 'onclick="location.href=\'?show=list&page='. ($currentPage-1) .'\'" '; ?>
              <button type="button" <?=$goPageURL?> class="btn btn-secondary" <?=($currentPage==0)?'disabled':''?>>&laquo;</button>
            </div>
            <div class="btn-group mr-2" >
              <?php
                if(isset($_GET['page'])){
                  for ($i=0; $i < $maxPage ; $i++) {
                    $goPageURL = 'onclick="location.href=\'?show=list&page='. $i .'\'" ';
                    $isActive = ($currentPage==$i)?'active ':'';
                    echo '<button type="button" '. $goPageURL.' class="btn btn-secondary '. $isActive .' " >'. ($i+1) .'</button>';
                  }
                }
              ?>
            </div>
            <div class="btn-group" >
              <?php $goPageURL = 'onclick="location.href=\'?show=list&page='. ($currentPage+1) .'\'" '; ?>
              <button type="button" <?=$goPageURL?> class="btn btn-secondary" <?=($currentPage>=$maxPage-1)?'disabled':''?> >&raquo;</button>
            </div>
          </div>
        </div>
      </div>
      <!-- 新增 -->
      <?php if($_GET['show']=='new') include 'product_list_new.php' ?>

    </div>
  </div>

  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>
<html>
