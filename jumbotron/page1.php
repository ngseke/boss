<!-- 隨機展示熱銷商品 -->
<div class="row">
  <?php
  $sql="SELECT * FROM PRODUCT_VIEW ORDER BY RAND() LIMIT 4";
  $result=$conn->query($sql)
  ?>
  <div class="col-12 my-3 my-lg-5 text-center">
    <div class="row">
      <div class="col-12 mb-4">
        <h2 class="d-inline " style="border-bottom:5px #333 solid;">熱銷商品</h2>
      </div>
      <?php
      while($rows=mysqli_fetch_array($result)){
        if($rows['DEventType']=='Discount'){
          $price_text='<span class="badge badge-danger ">NT$ ' . $rows['PPriceDiscountF'] . '</span> ';
          $price_text.='<span class="badge badge-info">Event</span> ';
        } else if($rows['DEventType']=='BOGO'){
            $price_text='<span class="badge badge-primary ">NT$ ' . $rows['PPriceF'] . '</span> ';
            $price_text.='<span class="badge badge-info">買一送一</span> ';
        } else{
          $price_text='<span class="badge badge-primary ">NT$ ' . $rows['PPriceF'] . '</span> ';
        }

        echo '<div class="col-12 col-lg-3 text-center my-3 link" onclick="location.href=\'product_detail.php?ID=' . $rows['PID'].'\'">
          <img src="' . $rows['PImg'] . '" class="img-fluid mx-auto d-block mb-2" style="height:8rem;width:auto;">
          <h5>'. $rows['PName'] . '</h5>'
          . $price_text .
        '</div>';
      }
      ?>
    </div>
  </div>
</div>

<!-- 巨大登入按鈕 -->
<div class="row  <?php if(isset($_SESSION['ID']))echo'd-none ' ?>">
  <div class="col-12 col-lg-7">
    <?php $bg_url='https://c.pxhere.com/photos/e3/78/mug_coffee_cup_drink-98978.jpg!s' ; ?>
    <div class="jumbotron link text-center bg-dark text-light" style="background:url('<?php echo $bg_url ?>');background-size: cover; background-position:center center;" onclick="location.href='login.php'">
      <button type="button" class="btn btn-outline-light">登入</button>
    </div>
  </div>
  <div class="col-12 col-lg-5">
    <?php $bg_url='https://c.pxhere.com/photos/39/a8/coffee_cafe_mug_decorative_drink_beverage_latte_cappuccino-847370.jpg!d' ; ?>
    <div class="jumbotron link text-center bg-light text-dark" style="background:url('<?php echo $bg_url ?>');background-size: cover; background-position:center center; " onclick="location.href='reg.php'">
      <button type="button" class="btn btn-dark">註冊</button>
    </div>
  </div>
</div>
