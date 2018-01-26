<?php session_start(); ?>
<?php include('connection.php'); ?>
<?php
// 本頁的標題
$page_name = '商品';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- 引入CSS等樣式內容 -->
  <?php include('style.php') ?>
  <!-- 根據所在頁面 印出對應的標題 -->
  <title><?php echo  $page_name. ' - ' .title_name ?></title>
  <?php require_once ('js.php') ?>
</head>

<body>
  <!-- 引入導覽列 -->
  <?php include('nav.php') ?>
  <div id="product" class="container my-3">
    <div class="row">
      <!-- 左側選單 -->
      <div class="col-12 col-lg-3 mb-3" style="max-height:30rem; overflow-y: scroll; overflow-x: hidden;">
        <div class="list-group">
          <a href="product.php?page=search" class="list-group-item list-group-item-action" ><i class="material-icons" >search</i> 搜尋</a>
          <a href="#" class="list-group-item list-group-item-action " @click.prevent="SetURL('')"><i class="material-icons" >view_list</i> 所有商品</a>
          <a href="#" class="list-group-item list-group-item-action text-danger"
           @click.prevent="SetURL('?discount')"><i class="material-icons">card_giftcard</i> 優惠項目</a>
          <!-- 動態生成所有商品類型按鈕 -->
          <template v-for="cat in cats">
            <a @click="SetCat(cat.CID)" href="#"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" >{{cat.CName}}<span class="badge badge-dark badge-pill">{{cat.CNum}}</span></a>
          </template>
        </div>
      </div>

      <!-- 右側商品列表 -->
      <div class="col-12 col-lg-9">
        <div class="row">
          <div class="col-12 mb-2" >
            <?php include('search_vue.php')  ?>
          </div>
          <?php
          $search_keyword=$search_category=$price_from=$price_to=NULL;

          // 查看所有DISCOUNT中的項目
          if(isset($_GET['discount'])){
            $sql.= "AND (DEventType IS NOT NULL)";
          }

          $sql .= "ORDER BY CID,PID"; // 令查詢到的項目按類別->PID排序
          $result = $conn->query($sql);  // $result 存放查詢到的所有物件

          if(isset($_GET['discount'])){
            echo '<div class="col-12">
            <div class="alert alert- text-danger text-center border-danger">
            <em><strong>優惠活動中，售完為止！</strong></em>';
            echo '</div></div>';
          }

          if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
          echo '<div class="col-12">
          <div class="alert alert-info">
          <i class="material-icons">search</i>
          查到 <strong>'. mysqli_num_rows($result) .'</strong> 項商品。 搜尋條件：';
          if($search_keyword!=NULL)
          echo '<span class="badge badge-light">“'. $search_keyword .'”</span> ';
          if($search_category!=NULL)
          echo '<span class="badge badge-light">'. mysqli_fetch_array($conn->query("SELECT Name FROM CATEGORY WHERE ID=$search_category"))['Name'] .'</span> ';
          if($price_from!=NULL && $price_to!=NULL)
          echo '<span class="badge badge-light"> $'. $price_from .' ~ $'. $price_to .'</span> ';

          if($search_keyword!=NULL || $search_category!=NULL || $price_from!=NULL || $price_to!=NULL)
          echo '</div></div>';

          ?>
          <!-- 各商品CARD -->

          <div class="col-12 col-lg-4 mb-2" v-for="item in items" v-bind:key="item.PID">
            <a v-bind:href="GetItemURL(item.PID)" class="text-dark product-item">
              <div class="card">
                <div class="card-body position-relative">
                  <div class="row no-gutters text-left text-lg-center">
                    <div class="col-4 col-lg-12 text-center">
                      <img v-bind:src="item.PImg" class="img-fluid mb-3" style="max-height:6rem; width:auto;">
                    </div>
                    <div class="col-8 col-lg-12">
                      <h5 class="card-title mb-1 text-truncate">{{item.PName}}</h5>
                      <p class="card-text mb-2 text-truncate">{{item.PInfo}}</p>
                      <span class="badge badge-primary"
                      :class="GetPriceStyle(item)" >NT$ {{GetPrice(item)}}</span>
                      <span class="badge"
                      v-bind:class="GetDiscount(item).style"
                      v-if="GetDiscount(item).text!=''"
                      >{{GetDiscount(item).text}}</span>
                      <span class="badge badge-dark ">{{item.CName}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>

        </div>
        <hr>
      </div>
    </div>
  </div>
  <?php include('jumbotron/page2.php') ?>
  <?php include('footer.php') ?>
  <script src="https://vuejs.org/js/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lodash@4.13.1/lodash.min.js"></script>
  <script type="text/javascript">
      var vm = new Vue({
        el:'#product',
        data:{
          basicurl: 'product_vue_get.php',
          url: 'product_vue_get.php',  // api網址
          items: null,                 // 存放商品物件的array
          typing: false,
          search: {
            event: false,
            keyword: '',
            priceFrom: '',
            priceTo: '',
            category: ''
          },
          cats: null
        },

        created: function(){  // $data已可取得，但$el還未被建立
          this.done = true;
          this.GetItems();    // 呼叫 GetItems()
          this.GetCats();
        },

        watch:{
          url: function () {　// 當url發生變動時，呼叫GetItems() **是簡寫**
            this.items=[];
            this.GetItems();
          },
          search: {     // 因為要watch的對象是obj，所以必須使用深度watch才觀察的到obj內元素
            deep: true,
            handler: function(){
              this.ComputeURL;
            }
          }
        },

        computed:{
          ComputeURL:function(){
            this.url= this.basicurl + '?';
            this.url+=(this.search.keyword!="")?'keyword='+this.search.keyword+'&' : '';
            this.url+=(this.search.category!="")?'category='+this.search.category+'&' :'';
            this.url+=(this.search.priceFrom!="")?'price_from='+this.search.priceFrom+'&' :'';
            this.url+=(this.search.priceTo!="")?'price_to='+this.search.priceTo+'&' :'';
          },
        },

        methods: {
          GetItems: _.debounce(function(){     // 利用AJAX取得“商品物件的Array”
            var self = this;                   // ** 令self等於“vue實例” **
            $.get(self.url ,{ID: ''},
              function(data){
                self.items = JSON.parse(data)  // JSON.parse() 轉換JSON格式string成物件
            });
          },
          0),
          GetCats: function(){     // 取得“商品類別Array”
            var self = this;
            $.get('product_vue_get_cats.php' ,{ID: ''},
              function(data){
                self.cats = JSON.parse(data)
            });
          },
          SetURL: function(value) {  // 設定API的URL
            this.url= 'product_vue_get.php' + value;
          },
          GetItemURL: function(PID){  // 取得各商品網址(For 各商品連結)
            return 'product_detail.php?ID='+PID;
          },
          SetCat: function(CID){
            this.search.category = CID;
          },
          GetPrice: function(item){  // 取得各商品價格
            if(item.DEventType=='Discount')
            return (item.PPriceDiscountF)
            else if(item.DEventType=='BOGO')
            return (item.PPriceF)
            else return (item.PPriceF);
          },
          GetDiscount:function(item) {  // 取得各折扣內容文字
            if(item.DEventType=='Discount'){
              return {
                style: {'badge-info':true},
                text: "Event"
              }
            } else if(item.DEventType=='BOGO'){
              return {
                style: {'badge-info':true},
                text: "買一送一"
              }
            } else return {style:'',text:''};
          },
          GetPriceStyle: function(item) {  // 取得各商品價格badge的樣式
            if(item.DEventType=='Discount'){
              return {'badge-danger':true};
            }
          }
        }

      });

</script>
</body>
</html>
