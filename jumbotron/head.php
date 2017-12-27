<?php $bg_url='img/bg'. rand(1,5) .'.jpg' ?>
<?php //$bg_url='img/bg5.jpg' ?>
<?php
$FirstDay = date('Y-m-d H:i:s',mktime(11, 43, 58, 11, 14, 2017)); // GIT創建日
$Deadline = date('Y-m-d H:i:s',mktime(00, 00, 00, 01, 02, 2018)); // 死線日
$Today = date('Y-m-d H:i:s');
$FirstDayDiff = floor((strtotime($Today) - strtotime($FirstDay))/3600/24);
$DeadlineDiff = -(floor((strtotime($Today) - strtotime($Deadline))/3600/24));
?>
<div class="jumbotron-fluid text-center bg-dark text-white" style="background:url('<?=$bg_url ?>');background-size: cover; background-position:center center; background-attachment:fixed;">
  <div class="container"><?php include('echo_alert.php') ?></div>
  <div class="container" style="padding:5rem 0;">
    <h1 id="head1" class="display-2 my-0 text-shadow-dark" >BOSS</h1>
    <p  id="head2" class="lead text-shadow-dark" >Beverage Online Shop System</p>
    <h5 id="head3" class="text-shadow-dark" style="letter-spacing:1rem" >已盛大開幕<strong><?=$FirstDayDiff ?></strong>天</h5>
    <p id="head3" class="text-shadow-dark" style="letter-spacing:.2rem" >Deadline倒數 <span class="badge badge-light mr-1 pr-0" style="text-shadow:0 0 0rem #fff"><?=$DeadlineDiff ?>天</span></p>
    <div id="head4">
      <!-- <button onclick="location.href='product.php'" class="btn btn-light mt-3 mr-1">去喝茶</button> -->
      <button onclick="location.href='https://hackmd.io/s/BJoNIgH-z'" class="btn btn-primary mt-3 mr-1">Readme</button>
      <button onclick="location.href='https://github.com/a92304a92304/boss'" class="btn btn-info mt-3 mr-1">GitHub</button>
    </div>
  </div>
</div>
