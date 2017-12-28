<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name = '訂單資訊' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>
<body>
  <?php include('nav.php');
  //----------------------From order_list----------------
  $sql = "SELECT * FROM order_list_view WHERE ID = '" . $_GET['ID'] . "'";
  $result = $conn->query($sql);
  $row = mysqli_fetch_array($result);

  $ID = $row['ID'];
  $memName = $row['memName'];
  $Date = $row['Date'];
  $Phone = $row['Phone'];
  $mail = $row['Email'];
  $FinalCost = $row['FinalCost'];
  $State = $row['State'];
  $stfName = $row['stfName'];
  $Address = $row['Address'];

  //---------------------From member----------------
  $sqlName = "SELECT * FROM member WHERE position != \"C\"";
  $resultName = $conn->query($sqlName);

  //----------------------From member assign name----------------


  $stateStr = array("submitted", "processed", "delivered", "completed");
  $attr = array("ID", "收件人", "mail", "電話", "地址", "訂單時間", "金額", "接管成員");
  $attrValue = array("$ID", "$memName", "$mail", "$Phone", "$Address", "$Date", "$FinalCost", "$stfName");
  $attrSize = count($attr);
  $isDisplay = '';
  $idColSize = '';
  if($user_position == "A"){
    $attrSize = count($attr) - 1;
    $idColSize = 'col-6';
  }else{
    $isDisplay = 'd-none';
    $idColSize = 'col-12';
}

  ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="card bg-light mt-3">
          <div class="card-header text-center">訂單資訊</div>
          <div class="card-body">
            <form class="" action="order_list_detail_edit.php" method="post">
              <?php
              for ($x = 0 ; $x < $attrSize ; $x++) {
                echo '
                <div class="form-group row">
                  <label class="col-2 col-form-label font-weight-bold">' .$attr[$x]. '</label>
                  <div class="col-10">
                    <input type="text" size="70" readonly class="form-control-plaintext" value="' . $attrValue[$x] . '">
                  </div>
                </div>';
              }
               ?>
              <div class="row">
                <div class="form-group <?php echo $idColSize ?>">
                  <label for="inputState" class="font-weight-bold">State</label>
                  <select class="form-control" name="state">
                    <?php
                    foreach ($stateStr as $value){
                      if($value !== $State){
                        echo "<option>$value</option>";
                      }else{
                        echo "<option selected>$value</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-6 <?php echo $isDisplay ?>">
                  <label for="inputState">接管成員</label>
                  <select class="form-control" name="manageName">
                    <?php
                      echo "<option></option>";
                      while($rowName = $resultName->fetch_assoc()){
                        $Name = $rowName['Name'];
                        if($Name !== $stfName){
                          echo "<option>" . $Name . "</option>";
                        }else{
                          echo "<option selected>" . $Name . "</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <?php include('order_list_detail_table.php'); ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('footer.php') ?>
</body>
<!-- 引入JS -->
<?php include('js.php') ?>
<html>
