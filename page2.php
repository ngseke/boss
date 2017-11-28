<!-- 隨機展示熱銷商品 -->
<div class="row">
  <?php
  $sql="SELECT * FROM DISCOUNT ORDER BY RAND() LIMIT 1";
  $result=$conn->query($sql)
  ?>
  <div class="col-12 my-3 my-lg-5 text-center">
    <div class="row">
      <div class="col-12 mb-4">
        <h2 class="d-inline " style="border-bottom:5px #333 solid;">折扣開催中</h2>
      </div>
      <div class="col-12 mb-4">
        <h3 class="text-warning"><?php echo mysqli_fetch_array($result)['Info'] ?></h3>
      </div>
    </div>
  </div>
</div>
