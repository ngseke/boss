<!-- 本頁僅用於回傳當前商品的評分星星 -->
<?php
  $sql_star = 'SELECT AVG(Star) Star FROM Comment WHERE PID='.$_GET['ID'];
  $result_star = $conn->query($sql_star);
  $rows_star = mysqli_fetch_array($result_star);
  $star_num=round($rows_star['Star'],1);

  $star_geweishu= floor($star_num); // 取得平均星的 “整數”
  $star_xiaoshudian= $star_num - floor($star_num); // 取得平均星的 “小數”
?>

<span class="badge badge-dark star my-3">
  <?php
    if($star_num=='0')
      echo '暫無評分';
    else{
      echo "<h6 class='my-0'><strong>$star_num</strong></h6>";

      $star_counter=0;
      // 印出填滿星星
      for ($i=0; $i < $star_geweishu; $i++) {
        echo '<i class="material-icons">star</i>';
        $star_counter++;
      }
      // 印出一半星星
      if($star_xiaoshudian>0.5){
        echo '<i class="material-icons">star_half</i>';
          $star_counter++;
      }
      // 印出空星星
      for(;$star_counter<5;$star_counter++){
        echo '<i class="material-icons">star_border</i>';
      }
      //echo ' '.$star_num;
    }
  ?>

</span>
