<?php
  require_once 'connection.php';
  // 好手氣：隨機跳至某商品
  $sql="SELECT * FROM PRODUCT ORDER BY RAND() LIMIT 1";
  $luckyID=mysqli_fetch_array($conn->query($sql))['ID'];
?>

<meta http-equiv="refresh" content="<?php echo 0 ?>;URL=product_detail.php?ID=<?=$luckyID ?>">
