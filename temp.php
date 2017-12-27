<?php session_start(); ?>
<?php include('connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>
  <title><?php echo title_name ?></title>
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-3">
        xxx
      </div>
      <div class="col-9">
        <div class="card mb-3">
          <h5 class="card-header">
            <strong>2017/12/12</strong>
            訂單編號 : ABCDEFGH
          </h5>
          <div class="card-body">
            <div class="row">
              <div class="col-2 text-center d-none">
                <h4><span class="badge badge-pill badge-secondary">已提交</span></h4>
                <h4><span class="badge badge-pill badge-dark">處理中</span></h4>
                <h4><span class="badge badge-pill badge-info">運輸中</span></h4>
                <h4><span class="badge badge-pill badge-success">已完成</span></h4>
              </div>
              <div class="col-12 mb-3">
                <div class="progress" style="height: 2rem;">
                  <div class="progress-bar bg-primary text-light " style="width: 25%; ">已提交</div>
                  <div class="progress-bar bg-secondary text-light " style="width: 25%; ">處理中</div>
                  <div class="progress-bar bg-secondary text-light " style="width: 25%; ">運輸中</div>
                  <div class="progress-bar bg-secondary text-light " style="width: 25%; ">已完成</div>
                </div>
              </div>

              <div class="col-4"><strong>收件人:</strong> 黃省喬</div>
              <div class="col-6"><strong>收件人電話:</strong> 099999999</div>
              <div class="col-6"><strong>收件地址:</strong> 台北市台北市台北市台北市台北市</div>

              <div class="col-12">
                <table class="table table-hover table-sm mt-3">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col" style="width:2rem;">#</th>
                      <th scope="col" style="width:4rem;"></th>
                      <th scope="col">商品名稱</th>
                      <th scope="col">單價</th>
                      <th scope="col">數量</th>
                    </tr>

                  </thead>
                  <tbody>
                    <tr>
                      <th class="align-middle" scope="row">1</th>
                      <td class="text-center"><img src="http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg" class="img-fluid rounded d-block" style="max-height: 3rem; width: auto;"></td>
                      <td class="align-middle">純喫茶綠茶 </td>
                      <td class="align-middle">$ 199</td>
                      <td class="align-middle">99</td>
                    </tr>
                    <?php
                    for ($i=0; $i < 5; $i++) {
                      echo '                        <tr>
                      <th class="align-middle" scope="row">1</th>
                      <td class="text-center"><img src="http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg" class="img-fluid rounded d-block" style="max-height: 3rem; width: auto;"></td>
                      <td class="align-middle">純喫茶綠茶 </td>
                      <td class="align-middle">$ 199</td>
                      <td class="align-middle">99</td>
                      </tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="col-12 text-right">
                總金額:  <h3 class="d-inline-block"><strong class="text-danger">NT$ 9990</strong></h3>
              </div>
            </div>
          </div>

        </div><div class="card mb-3">
          <h5 class="card-header">
            <strong>2017/12/12</strong>
            訂單編號 : ABCDEFGH
          </h5>
          <div class="card-body">
            <div class="row">
              <div class="col-2 text-center d-none">
                <h4><span class="badge badge-pill badge-secondary">已提交</span></h4>
                <h4><span class="badge badge-pill badge-dark">處理中</span></h4>
                <h4><span class="badge badge-pill badge-info">運輸中</span></h4>
                <h4><span class="badge badge-pill badge-success">已完成</span></h4>
              </div>
              <div class="col-12 mb-3">
                <div class="progress" style="height: 2rem;">
                  <div class="progress-bar bg-primary text-light " style="width: 25%; ">已提交</div>
                  <div class="progress-bar bg-secondary text-light " style="width: 25%; ">處理中</div>
                  <div class="progress-bar bg-secondary text-light " style="width: 25%; ">運輸中</div>
                  <div class="progress-bar bg-secondary text-light " style="width: 25%; ">已完成</div>
                </div>
              </div>

              <div class="col-4"><strong>收件人:</strong> 黃省喬</div>
              <div class="col-6"><strong>收件人電話:</strong> 099999999</div>
              <div class="col-6"><strong>收件地址:</strong> 台北市台北市台北市台北市台北市</div>

              <div class="col-12">
                <table class="table table-hover table-sm mt-3">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col" style="width:2rem;">#</th>
                      <th scope="col" style="width:4rem;"></th>
                      <th scope="col">商品名稱</th>
                      <th scope="col">單價</th>
                      <th scope="col">數量</th>
                    </tr>

                  </thead>
                  <tbody>
                    <tr>
                      <th class="align-middle" scope="row">1</th>
                      <td class="text-center"><img src="http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg" class="img-fluid rounded d-block" style="max-height: 3rem; width: auto;"></td>
                      <td class="align-middle">純喫茶綠茶 </td>
                      <td class="align-middle">$ 199</td>
                      <td class="align-middle">99</td>
                    </tr>
                    <?php
                    for ($i=0; $i < 5; $i++) {
                      echo '                        <tr>
                      <th class="align-middle" scope="row">1</th>
                      <td class="text-center"><img src="http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg" class="img-fluid rounded d-block" style="max-height: 3rem; width: auto;"></td>
                      <td class="align-middle">純喫茶綠茶 </td>
                      <td class="align-middle">$ 199</td>
                      <td class="align-middle">99</td>
                      </tr>';
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="col-12 text-right">
                總金額:  <h3 class="d-inline-block"><strong class="text-danger">NT$ 9990</strong></h3>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

</body>
<!-- 引入JS -->
<?php include('js.php') ?>

</html>
