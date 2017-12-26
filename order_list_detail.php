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
  $sql = "SELECT * FROM order_list WHERE ID = '" . $_GET['ID'] . "'";
  $result = $conn->query($sql);
  $row = mysqli_fetch_array($result);

  $ID = $row['ID'];
  $Date = $row['Date'];
  $FinalCost = $row['FinalCost'];
  $State = $row['State'];

  //---------------------From member----------------
  $sqlName = "SELECT * FROM member WHERE position != \"C\"";
  $resultName = $conn->query($sqlName);

  //----------------------From member assign name----------------
  $sqlNameAssign = "SELECT Name FROM member WHERE ID IN (SELECT SID FROM order_list WHERE ID = '" . $_GET['ID'] . "')";
  $resultNameAssign = $conn->query($sqlNameAssign);
  $rowNameAssign = mysqli_fetch_array($resultNameAssign);

  $NameAssign = $rowNameAssign['Name'];

  $stateArr = array("submitted", "processed", "delivered", "completed");
  ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="card bg-light mt-3">
          <div class="card-header text-center">訂單資訊</div>
          <div class="card-body">
            <form class="" action="order_list_detail_edit.php" method="post">
              <div class="form-group row">
                <label class="col-2 col-form-label font-weight-bold">ID</label>
                <div class="col-10">
                  <input type="text" readonly class="form-control-plaintext" value="<?php echo $ID ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-2 col-form-label font-weight-bold">時間</label>
                <div class="col-10">
                  <input type="text" readonly class="form-control-plaintext" value="<?php echo $Date ?>">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-2 col-form-label font-weight-bold">金額</label>
                <div class="col-10">
                  <input type="text" readonly class="form-control-plaintext" value="<?php echo $FinalCost ?>">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-6">
                  <label for="inputState">State</label>
                  <select class="form-control" name="state">
                    <?php
                    foreach ($stateArr as $value){
                      if($value !== $state){
                        echo "<option>$value</option>";
                      }else{
                        echo "<option selected>$value</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-6">
                  <label for="inputState">接管成員</label>
                  <select class="form-control" name="manageName">
                    <?php
                      while($rowName = $resultName->fetch_assoc()){
                        $Name = $rowName['Name'];
                        if($Name !== $NameAssign){
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
