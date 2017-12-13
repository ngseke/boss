<?php $bg_url='img/cafe.jpg' ?>
<?php
$FirstDay = date('Y-m-d H:i:s',mktime(11, 43, 58, 11, 14, 2017)); // GIT創建日
$Deadline = date('Y-m-d H:i:s',mktime(00, 00, 00, 01, 02, 2018)); // 死線日
$Today= date('Y-m-d H:i:s');
$FirstDayDiff = floor((strtotime($Today) - strtotime($FirstDay))/3600/24);
$DeadlineDiff = -(floor((strtotime($Today) - strtotime($Deadline))/3600/24));
?>
<div class="jumbotron-fluid text-center bg-dark text-white" style="background:url('<?php echo $bg_url ?>');background-size: cover; background-position:center center; background-attachment:fixed;">
  <div class="container"><?php include('echo_alert.php') ?></div>
  <div class="container" style="padding:5rem 0;">
    <h1 id="head1" class="display-2 my-0 text-shadow-dark" >BOSS</h1>
    <p  id="head2" class="lead text-shadow-dark" >Beverage Online Shop System</p>
    <h5 id="head3" class="text-shadow-dark" style="letter-spacing:1rem" >已盛大開幕第<strong><?php echo $FirstDayDiff ?></strong>天</h5>
    <p id="head3" class="text-shadow-dark" style="letter-spacing:.2rem" >距離Deadline還有<span class="badge badge-danger mr-1 pr-1"> <?php echo $DeadlineDiff ?> </span>天</p>
    <div id="head4">
      <button onclick="location.href='product.php'" class="btn btn-light mt-3">去喝茶 🍵</button>
      <button onclick="location.href='https://hackmd.io/s/BJoNIgH-z'" class="btn btn-dark mt-3">Readme</button>
      <button onclick="location.href='https://github.com/a92304a92304/boss'" class="btn btn-info mt-3">GitHub</button>
    </div>
  </div>
</div>
