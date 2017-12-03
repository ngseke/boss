<?php

function PrintProductDetailDiscountBadge($info, $discount, $color){
  $full_discount_text = '<' .$info . '> ' . $discount;
  echo '<span class="badge badge-pill badge-'.$color.'">'. $full_discount_text .'</span> ';
}

$sql = 'SELECT * FROM DISCOUNT';
$result = $conn->query($sql);

while($rows = mysqli_fetch_array($result))
{
  // 判斷今天是否在折扣期內
  if((date('Y-m-d')>=$rows['PeriodFrom']) && (date('Y-m-d')<=$rows['PeriodTo'])){
    switch ($rows['Type']) {
      case 'seasoning':
        $discount='結帳訂單滿'. $rows['Requirement'] .'打'.($rows['Rate']*100).'折';
        $color='danger';
        PrintProductDetailDiscountBadge($rows['Info'], $discount, $color);
        break;
      case 'shipping':
        $discount= '全館結帳訂單滿'. $rows['Requirement'] .'免運';
        $color='warning';
        PrintProductDetailDiscountBadge($rows['Info'], $discount, $color);
        break;
      case 'event':
        $sql = "SELECT * FROM PRODUCT P , DISCOUNT D
         WHERE P.ID = ".$_GET['ID'].
         " AND D.ID = P.DID AND D.ID=". $rows['ID'];
        $result_this_product=$conn->query($sql);

        if(mysqli_num_rows($result_this_product)>=1){
          $rows_this_product = mysqli_fetch_array($result_this_product);
          if($rows_this_product['EventType']=='BOGO'){
            $discount= '此品買一送一';
          } else if($rows_this_product['EventType']=='discount'){
            $discount= '此品項'.($rows['Rate']*100).'折';
          }
          $color='info';
          PrintProductDetailDiscountBadge($rows['Info'], $discount, $color);
        }
        break;
      default: $discount=$color='';
    }
  }
}
