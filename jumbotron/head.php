<?php $bg_url='img/cafe.jpg' ?>
<?php
$FirstDay = date('Y-m-d H:i:s',mktime(11, 43, 58, 11, 14, 2017)); // GIT創建日
$Today= date('Y-m-d H:i:s');
$FirstDayDiff = floor((strtotime($Today) - strtotime($FirstDay))/3600/24);
?>
<div class="jumbotron-fluid text-center bg-dark text-white" style="background:url('<?php echo $bg_url ?>');background-size: cover; background-position:center center; background-attachment:fixed;">
  <div class="container"><?php include('echo_alert.php') ?></div>
  <div class="container" style="padding:5rem 0;">
    <h1 id="head1" class="display-2 my-0 text-shadow-dark" >BOSS</h1>
    <p  id="head2" class="lead text-shadow-dark" >Beverage Online Shop System</p>
    <h5 id="head3" class="text-shadow-dark" style="letter-spacing:1rem" >已盛大開幕<span class="text-success"><?php echo $FirstDayDiff ?></span>天</h5>
    <div id="head4">
      <button onclick="location.href='product.php'" class="btn btn-outline-light mt-3">去喝茶 🍵</button>
    </div>
  </div>
</div>
