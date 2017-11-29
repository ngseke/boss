<!-- 導覽列 -->
<?php
// 取得當前頁面的檔名
$this_page = pathinfo($_SERVER['PHP_SELF'])['filename']
?>
<?php
  include('verification.php');
  $login_display = isset($_SESSION['ID'])?'d-none ':''; // 登入按鈕display
  $reg_display   = isset($_SESSION['ID'])?'d-none ':''; // 註冊按鈕display
  $user_display  = isset($_SESSION['ID'])?'':'d-none '; // 用戶按鈕display

  $customer_display  = ($user_position=='C'||$user_position=='G')?'':'d-none '; // Customer和Guest的Display
  $admin_display  = ($user_position=='A'||$user_position=='S')?'':'d-none '; // Admin和Staff的Display
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">BOSS茶店</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- 靠左 -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php echo ($this_page =='product')?'active':''; ?>">
          <a class="nav-link " href="product.php">商品</a>
        </li>
        <form class="form-inline mx-0 mx-lg-2 my-2 my-lg-0" method="get" action="product.php">
          <input class="form-control mr-sm-2" type="search" placeholder="搜尋" name="search" required>
          <button class="btn btn-outline-success my-2 my-sm-0 d-none" type="submit">Search</button>
        </form>
      </ul>

      <!-- DEBUG MODE 時顯示之選單 -->
      <?php
      if(debug_mode){
        echo '<ul class="navbar-nav border border-info rounded ">
        <li class="nav-item">
        <a class="nav-link text-info" href="db.php">一鍵生成DB</a>
        </li>
        <li class="nav-item">
        <a class="nav-link text-info" target="_blank" href="http://localhost/phpmyadmin/">phpmyadmin</a>
        </li>
        </ul>';
      }
      ?>

      <!-- 靠右 -->
      <ul class="navbar-nav ml-auto">
        <!-- Customer -->
        <li class="nav-item <?php echo ($this_page =='cart')?'active ':'' ?> <?php echo $customer_display; ?>">
          <a class="nav-link" href="cart.php"><i class="material-icons">shopping_cart</i> 購物車</a>
        </li>
        <li class="nav-item <?php echo ($this_page =='login')?'active ':'' ?> <?php echo $login_display ?>">
          <a class="nav-link" href="login.php">登入</a>
        </li>
        <li class="nav-item <?php echo ($this_page =='reg')?'active ':'' ?> <?php echo $reg_display ?>">
          <a class="nav-link" href="reg.php">註冊</a>
        </li>
        <!-- Admin & Staff  -->
        <li class="nav-item <?php echo ($this_page =='order')?'active ':'' ?> <?php echo $admin_display ?>">
          <a class="nav-link" href="order_list.php">管理訂單</a>
        </li>
        <li class="nav-item <?php echo ($this_page =='product_list')?'active ':'' ?> <?php echo $admin_display ?>">
          <a class="nav-link" href="product_list.php">管理商品</a>
        </li>
        <li class="nav-item <?php echo ($this_page =='discount_list')?'active ':'' ?> <?php echo $admin_display ?>">
          <a class="nav-link" href=" discount_list.php">管理折扣</a>
        </li>
        <li class="nav-item <?php echo ($this_page =='user_list')?'active ':'' ?> <?php echo $admin_display ?>">
          <a class="nav-link" href="user_list.php">管理會員</a>
        </li>

        <li class="nav-item <?php echo ($this_page =='logout')?'active ':'' ?> d-none">
          <a class="nav-link" href="logout.php">
            <i class="material-icons">exit_to_app</i>
            登出 <?php echo $user_id ?>
          </a>
        </li>
        <li class="nav-item dropdown <?php echo isset($_SESSION['ID'])?'':'d-none' ?>">
          <a class="nav-link dropdown-toggle" href="#" id="user" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">account_circle</i>
            <?php echo $user_name ?>
            <?php
            if($user_position=='A'){
              echo '<span class="badge badge-pill badge-warning">管理員</span>';
            }else if($user_position=='S'){
              echo '<span class="badge badge-pill badge-info">店員</span>';
            }
            ?>

          </a>
          <div class="dropdown-menu" >
            <h6 class="dropdown-header">ID: <?php echo $user_id ?></h6>
            <a class="dropdown-item <?php echo $customer_display ?>" href="#">訂單</a>
            <a class="dropdown-item" href="#">會員資料</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">
              <i class="material-icons">exit_to_app</i>登出
            </a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
