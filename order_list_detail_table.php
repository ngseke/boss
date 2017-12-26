<?php
//---------------------From order_list_record_view----------------
$sqlOrderView = "SELECT * FROM order_list_record_view WHERE OID = '" . $_GET['ID'] . "'";
$resultOrderView = $conn->query($sqlOrderView);

?>
<div class="form-group col-12">
  <table class="table mt-3">
    <thead>
      <tr class="text-center">
        <th scope="col">商品編號</th>
        <th scope="col">商品名稱</th>
        <th scope="col">商品數量</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while($rowOrderView = $resultOrderView->fetch_assoc()){

      echo
      '<tr>
      <td class="text-center">' . $rowOrderView['PID'] . '</td>
      <td class="text-center">' . $rowOrderView['Name'] . '</td>
      <td class="text-center">' . $rowOrderView['Quantity'] . '</td>
      </tr>';
    }
      ?>
    </tbody>
  </table>
</div>
<div class="col-12 form-group">
  <input type="hidden" name="ID" value="<?php echo $_GET['ID'] ?>">
<button class="btn btn-success btn-block" type="submit" >立即修改</button>
</div>
