<?php
  // 印出cart.php的各個商品
  function EchoCartItem($img, $PName, $PDEvent, $cost, $CRQ, $CountQuantity, $CartID, $PID){
    return '<tr class="text-lg-center" >
            <th>
              <img src="'.$img.'" class="img-fluid " style="max-height:5rem;">
            </th>
            <th scope="row" class="text-left align-middle">'.$PName.'</br>'.$PDEvent.'</th>
            <th class="align-middle">NT$ '.number_format($cost).'</th>
            <th class="align-middle">'.$CRQ.'</th>
            <th class="align-middle">NT$ '.number_format($cost * $CountQuantity).'</th>
            <th class="align-middle">
              <a class="btn btn-outline-dark" href="cart_del.php?CartID='.$CartID.'&PID='.$PID.'"><i class="material-icons">delete</i></a>
            </th>
          </tr>';
  }

  // 印出order.php的各個商品
  function EchoOrderItem($img, $PName, $PDEvent, $cost, $CRQ, $CountQuantity, $CartID, $PID){
    return '<tr class="text-lg-center" >
            <th>
              <img src="'.$img.'" class="img-fluid " style="max-height:5rem;">
            </th>
            <th scope="row" class="text-left align-middle">'.$PName.'</br>'.$PDEvent.'</th>
            <th class="align-middle">NT$ '.number_format($cost).'</th>
            <th class="align-middle">'.$CRQ.'</th>
            <th class="align-middle">NT$ '.number_format($cost * $CountQuantity).'</th>
          </tr>';
  }

  $Total = 0;
  $SelectCount = 0;
  $Fare = 60;
  // 資料庫指令
  $sql = "SELECT P.PID PID, P.PImg PIMG, P.PName PName, P.PPrice PPrice,
          CR.Quantity CRQ, P.PPriceDiscount PPriceD, P.DID PDID, P.DEvent PDEvent
          FROM CART C
          JOIN CART_RECORD CR ON C.ID = CR.ID
          JOIN PRODUCT_VIEW P ON CR.PID = P.PID
          WHERE C.ID='".$CartID."'";
  $result = $conn->query($sql);

  if(mysqli_num_rows($result) == 0) {
    $Fare = 0;
    echo'
      <tr>
        <td colspan="6">您尚未選購產品</td>
      </tr>';
  }
  else if(mysqli_num_rows($result) > 0){
    while($rows = mysqli_fetch_array($result)){
      // 針對bogo計算商品數量
      $CountQuantity = ($rows['PDEvent'] == 'BOGO') ? ceil((float)($rows['CRQ'] / 2)) : $rows['CRQ'];
      // 針對discount計算價格
      $cost = ($rows['PDEvent'] == 'discount') ? round($rows['PPriceD']) : $rows['PPrice'];
      $Total += $cost * $CountQuantity; // 總金額
      $SelectCount += $rows['CRQ']; // 總商品數量
      if($this_page == "cart")
        echo EchoCartItem($rows['PIMG'], $rows['PName'], $rows['PDEvent'], $cost, $rows['CRQ'], $CountQuantity, $CartID, $rows['PID']);
      else if($this_page == "order")
        echo EchoOrderItem($rows['PIMG'], $rows['PName'], $rows['PDEvent'], $cost, $rows['CRQ'], $CountQuantity, $CartID, $rows['PID']);

    }
  }
