<!-- 導覽列 -->

<?php
  // 取得當前頁面的檔名
  $this_page = pathinfo($_SERVER['PHP_SELF'])['filename']
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
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
        <form class="form-inline mx-0 mx-lg-2 my-2 my-lg-0" method="get" >
          <input class="form-control mr-sm-2" type="search" placeholder="搜尋" name="search">
          <button class="btn btn-outline-success my-2 my-sm-0 d-none" type="submit">Search</button>
        </form>
        <li class="nav-item dropdown d-none">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
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
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="material-icons">shopping_cart</i> 購物車</a>
        </li>
        <li class="nav-item <?php echo ($this_page =='login')?'active':''; ?>">
          <a class="nav-link" href="login.php">登入</a>
        </li>
        <li class="nav-item <?php echo ($this_page =='reg')?'active':''; ?>">
          <a class="nav-link" href="reg.php">註冊</a>
        </li>
        <li class="nav-item <?php echo ($this_page =='logout')?'active':''; ?>">
          <a class="nav-link" href="logout.php">登出</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
