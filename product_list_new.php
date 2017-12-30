<div class="col-12 col-lg-6 offset-lg-3 my-3">
  <?php
    // for discount
    $sql = "SELECT * FROM DISCOUNT WHERE Type = 'event'";
    $result = $conn->query($sql);

    // for CATEGORY
    $sql3 = "SELECT * FROM CATEGORY";
    $result3 = $conn -> query($sql3);
  ?>
  <div class="card">
    <div class="card-header text-center">新增商品</div>
    <div class="card-body">
      <form class="row" action="product_list_new_add.php" method="post" enctype="multipart/form-data" >
        <div class="col-12 form-group">
          <label>商品名稱 <span class="text-info">*</span></label>
          <input value="測試商品" type="text" name="Name" placeholder="商品名稱" maxlength="20" class="form-control" required>
        </div>
        <div class="col-12 col-lg-6 form-group">
          <label>商品狀態 <span class="text-info">*</span></label>
          <select class="form-control" name="State" required>
            <option value="in_stock">現貨</option>
            <option value="out_of_stock">缺貨</option>
            <option value="removed_from_shelves">已下架</option>
          </select>
        </div>
        <div class="col-12 col-lg-6 form-group">
          <label>商品分類 <span class="text-info">*</span></label>
          <select class="form-control" name="Type" required>
            <?php
            if($result3->num_rows > 0) {
              while($row3 = $result3->fetch_assoc()){
                echo "<option value = " . $row3["ID"] . ">" . $row3["Name"] . "</option>";
              }
            }
            ?>
          </select>
        </div>
        <div class="col-12 col-lg-6 form-group">
          <label>庫存 <span class="text-info">*</span></label>
          <input type="number" value="99" name="Stock" placeholder="" maxlength="12" class="form-control" required>
        </div>
        <div class="col-12 col-lg-6 form-group">
          <label>價格 <span class="text-info">*</span></label>
          <input type="number" value="29" name="Price" placeholder="" maxlength="5" class="form-control" required>
        </div>

        <div class="col-12 form-group">
          <label>商品介紹 <span class="text-info">*</span></label>
          <textarea type="text" name="Info" placeholder="" maxlength="100" class="form-control" rows="5" required>這個是測試商品的介紹。</textarea>
        </div>
        <div class="col-12 col-lg-6 form-group">
          <label>Event折扣方式</label>
          <select class="form-control " name="Event">
            <?php
            echo '<option value= "">-</option>';
            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc())
              echo "<option value = " . $row["ID"] . ">" . $row["Info"] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-12 col-lg-6 form-group">
          <label for="exampleFormControlFile1">上傳圖片</label>
          <input type="file" class="form-control-file" name="file">
        </div>
        <div class="col-12 form-group mt-3">
          <button class="btn btn-success btn-block" type="submit" >確認新增</button>
        </div>
      </form>
    </div>
  </div>
</div>
