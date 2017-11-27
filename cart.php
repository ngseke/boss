<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php $page_name="購物車"?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include('style.php') ?>
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
</head>

<body>
  <?php include('nav.php'); ?>
  <div class="container my-3">

    <div class="row" >
      <div class="col-12 text-center";>
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">商品名稱</th>
              <th scope="col">單價</th>
              <th scope="col">數量</th>
              <th scope="col">小計</th>
              <th scope="col">刪除</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" class="text-left"><img src="http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg" alt="">
                純喫茶綠茶
              </th>
              <td>25</td>
              <td>1</td>
              <td>
                <!--<form class="text-center"><input type="int" size="1" value="1"> </form>-->
                <select multiple="multiple" size="1">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </td>
              <td><img src="https://image.freepik.com/free-icon/trash-can_318-81009.jpg" height="25"><?php?>
              </td>
            </tr>
            <tr>
              <td colspan="5">您尚未選購產品</td>
            </tr>
            <tr class="text-right">
              <td colspan="5">
                共　件商品　商品金額：</br>
                運費小計：</br>
                <font size="+2">總金額：</font>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
  <?php include('footer.php') ?>
</body>
<?php include('js.php') ?>
</html>
