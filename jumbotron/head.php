<?php $bg_url='img/bg'. rand(1,6) .'.jpg' ?>

<div class="jumbotron-fluid text-center bg-dark text-white" style="background:url('<?=$bg_url ?>');
  background-size: cover; background-position:center center; background-attachment:fixed;">
  <div class="container"><?php include('echo_alert.php') ?></div>
  <div class="container" style="padding:5rem 0;">
    <h1 id="head1" class="display-2 my-0 text-shadow-dark" >BOSS</h1>
    <p  id="head2" class="lead text-shadow-dark" >Beverage Online Shop System</p>
    <h5 id="head3" class="text-shadow-dark " style="letter-spacing:.5rem" >時尚の線上飲料購物系統</h5>
    <div id="head4">
      <button onclick="location.href='product.php'" class="btn btn-light mt-3 mr-1">去喝茶</button>
      <button onclick="location.href='https://hackmd.io/s/BJoNIgH-z'" class="btn btn-primary mt-3 mr-1">Readme</button>
      <button onclick="location.href='https://github.com/a92304a92304/boss'" class="btn btn-info mt-3 mr-1">GitHub</button>
    </div>
  </div>
</div>
