<div class="row">
  <?php
  $sql="SELECT * FROM PRODUCT ORDER BY RAND() LIMIT 3";
  $result=$conn->query($sql)
  ?>
  <div class="col-12 my-3 my-lg-5 text-center">
    <div class="row">
      <div class="col-12 mb-4">
        <h1 class="d-inline " style="border-bottom:5px #333 solid;">熱銷商品</h1>
      </div>
      <?php
      while($rows=mysqli_fetch_array($result)){
        echo '<div class="col-12 col-lg-4 text-center my-3">
          <img src="' . $rows['Img'] . '" class="img-fluid mx-auto d-block mb-2">
          <h5>'. $rows['Name'] . '</h5>
        </div>';
      }
      ?>
    </div>
  </div>
  <div class="col-12 col-lg-7">
    <?php $bg_url='https://c.pxhere.com/photos/e3/78/mug_coffee_cup_drink-98978.jpg!s' ; ?>
    <div class="jumbotron link text-center bg-dark text-light" style="background:url('<?php echo $bg_url ?>');background-size: cover; background-position:center center; background-attachment:fixedX;" onclick="location.href='login.php'">
      <button type="button" class="btn btn-outline-light">登入</button>
    </div>
  </div>
  <div class="col-12 col-lg-5">
    <?php $bg_url='https://c.pxhere.com/photos/39/a8/coffee_cafe_mug_decorative_drink_beverage_latte_cappuccino-847370.jpg!d' ; ?>
    <div class="jumbotron link text-center bg-light text-dark" style="background:url('<?php echo $bg_url ?>');background-size: cover; background-position:center center; background-attachment:fixedX;" onclick="location.href='reg.php'">
      <button type="button" class="btn btn-dark">註冊</button>
    </div>
  </div>
</div>
