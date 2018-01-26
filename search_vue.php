<div class="card">
  <div class="card-body">
    <h2 class="card-title mb-3">查詢商品</h2>
    <form class="row" method="" action="">
      <div class="form-group col-4">
        <label>關鍵字</label>
        <input v-model="search.keyword" id="keyword" type="search" class="form-control " name="keyword" placeholder="Keyword">
      </div>
      <div class="form-group col-4">
        <label>價格</label>
        <div class="row">
          <div class="input-group input-group-sm col-5">
            <span class="input-group-addon">$</span>
            <input v-model="search.priceFrom" type="number" min="0" class="form-control form-control-sm" name="price_from" placeholder="">
          </div>
          <label for="staticEmail" class="col-auto col-form-label px-0">~</label>
          <div class="input-group input-group-sm col-5">
            <span class="input-group-addon">$</span>
            <input v-model="search.priceTo"  type="number" min="0" class="form-control" name="price_to" placeholder="">
          </div>
        </div>
      </div>
      <div class="form-group col-4">
        <label>類別</label>
        <select v-model="search.category"  class="form-control" name="category" >
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

    </form>
  </div>
</div>
