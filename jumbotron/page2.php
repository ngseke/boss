<!-- 隨機顯示折扣內容 -->
<?php
$sql="SELECT * FROM DISCOUNT ORDER BY RAND() LIMIT 1";
$result=$conn->query($sql);
$rows=mysqli_fetch_array($result);
$info=$rows['Info'];

// 取得折扣的文字
if($rows['Type']=='seasoning'){
  $discount='結帳打'.($rows['Rate']*100).'折';
} else if($rows['Type']=='shipping'){
  $discount= '全館免運';
} else if($rows['Type']=='event'){
  if($rows['EventType']=='BOGO')
  $discount= '指定商品買一送一';
  if($rows['EventType']=='discount')
  $discount= '指定商品打'.($rows['Rate']*100).'折';
}
?>
<div class="discount" style="background-image: linear-gradient(-225deg, #FFE29F 0%, #FFA99F 48%, #FF719A 100%);">
  <div class="container">
    <div class="row" style="cursor:pointer" onclick="location.href='product.php'">
      <div class="col-12 my-3 my-lg-5 text-center">
        <div class="row">
          <div class="col-12">
            <i class="material-icons text-light animated infinite rubberBand" style="font-size:5rem;">redeem</i>
          </div>
          <div class="col-12 my-3 text-center">
            <h3 class="text-light d-block " >
              <?php echo $info ?>
            </h3>
            <h5 class="text-light my-3" style="opacity: .9">
              <?php echo $discount ?>
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
