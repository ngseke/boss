<div class="card">
  <div class="card-body">
    <h2 class="card-title mb-3">查詢商品</h2>
    <form method="get" action="product.php">
      <div class="form-group">
        <label>關鍵字</label>
        <input type="search" class="form-control" name="keyword" placeholder="Keyword">
      </div>
      <div class="form-group">
        <label>價格</label>
        <div class="row">
          <div class="input-group col-5 col-lg-3">
            <span class="input-group-addon">$</span>
            <input type="number" min="0" class="form-control" name="price_from" placeholder="">
          </div>
          <label for="staticEmail" class="col-auto col-form-label px-0">~</label>
          <div class="input-group col-5 col-lg-3">
            <span class="input-group-addon">$</span>
            <input type="number" min="0" class="form-control" name="price_to" placeholder="">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label>類別</label>
        <select class="form-control" name="category" >
          <option value=""></option>
          <?php
          $sql = "SELECT ID, Name FROM CATEGORY";
          $result= $conn->query($sql);
          while($rows = mysqli_fetch_array($result)){
            echo "<option value=" . $rows["ID"] . ">" . $rows["Name"] . "</option>";
          }
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">查詢</button>
      <button type="reset" class="btn btn-secondary">清空</button>
    </form>
  </div>
</div>
