<?php

/*
  NAV 內容

  訪客
  商品 [搜尋列] 購物車 登入 註冊

  CUSTOMER
  商品 [搜尋列] 購物車 {訂單 會員資料 登出}

  STAFF
  商品 [搜尋列] 管理訂單 管理商品 管理會員(C) 登出

  ADMIN
  商品 [搜尋列] 管理訂單 管理商品 管理會員(可以管S C A) 登出
*/

// 1秒後自動跳轉
<meta http-equiv="refresh" content="1;url=index.php" />

// https://pxhere.com/
// 背景圖素材


/*

  管理商品( product_list_*.php )
    product_list                 列出所有商品(後台)
      product_list_detail        該商品的詳情，顯示在input裡面，按下button可以送出修改
        product_list_detail_edit (UPDATE)
      product_list_new           INSERT新商品，提供input和上傳檔案欄位
        product_list_new_add     (INSERT)

*/

/*

  管理折扣(discount_list_*.php)
     discount_list                列出所有折扣(後台)
      discount_list_detail        該折扣的詳情，顯示在input裡面，按下button可以送出修改
        discount_list_detail_edit (UPDATE)
      discount_list_new           INSERT新折扣，提供input和上傳欄位
        discount_list_new_add     (INSERT)
*/       
