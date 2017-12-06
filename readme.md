## 簡介

![](https://i.imgur.com/V7SlfVy.png)

這是一個**在線飲料購物系統** (Beverage Online Shop System)，簡稱**BOSS**。旨在提供一個簡單易用，介面時尚清爽的飲料購物平台。  

本專案後端以PHP語言撰寫，前端以Bootstrap的架構搭配HTML5和CSS3作為基礎進行版型設計。

## 安裝
推薦使用 [XAMPP](https://www.apachefriends.org/d) 架設Apache Web伺服器。  
![](https://i.imgur.com/DGi0VUB.png)

將本專案Clone至本機後，把專案目錄建立連結(替身)至XAMPP的 `/htdocs` 目錄下。  
#### Windows
```
mklink /D [XAMPP目的路徑] [專案來源]
```
#### MAC
```
ln -s [專案來源] [XAMPP目的路徑]
```
範例
```
ln -s /Users/[用戶名]/boss /Applications/XAMPP/xamppfiles/htdocs/boss
```

接著開啟瀏覽器輸入網址 <http://localhost/boss>，即可瀏覽BOSS首頁。

開啟 `config.php`，設定mysql伺服器資訊，若使用預設值則不需修改。
```
define('db_host',    'localhost', false); // 資料庫host
define('db_username', 'root',     false); // 資料庫用戶名
define('db_password', '',         false); // 資料庫密碼
define('db_name',     'BOSS',     false); // 資料庫名稱
```
輸入網址 <http://localhost/boss/db.php> 即可一鍵生成資料庫。  

亦可打開 `db.sql`，全選內容進入<http://localhost/phpmyadmin>手動貼入Console進行查詢。

看吧！是不是很簡單呢？👌


## 主要功能
### 首頁
`index.php` 為主頁面，使用具視覺衝擊的巨大廣告看板Jumbotron，搭配強而有力的廣告標語，讓主頁投射入眼簾的瞬間即深刻的烙印在腦海中。頁面會隨機挑選出數**熱銷商品**作為宣傳，以及當前進行中的活動。

### 導覽列 (Navbar)
導覽列包含以下：
 - **BOSS茶店**形象LOGO：連結至首頁
 - 商品
 - 搜尋框
 - 購物車：僅在 **G(Guest)** 或 **C(Customer)** 身份顯示
 - 登入/註冊：未登入時顯示。
 - 會員：在登入後顯示。
   - 會員資訊
   - 登出

以**A(Admin)** 或 **S(Staff)** 身份登入後，會有以下額外操作功能：
 - 管理訂單
 - 管理商品
 - 管理折扣
 - 管理會員


### 瀏覽商品
`product.php` 可瀏覽所有商品列表，在頁面左側可根據商品的種類篩選。

### 會員系統
`login.php` 簡潔的登入介面。  
`reg.php`   簡潔的註冊介面。

會員(MEMBER)分成以下三種：
 - A (Admin) : 管理員
 - S (Staff) : 員工
 - C (Customer) : 顧客

登入用戶後在Navbar的右方會顯示用戶名，若身份為 **A(Admin)** 或 **S(Staff)** 會特別顯示標籤提示。

## 檔案說明
```
管理商品( product_list_*.php )
    product_list                 列出所有商品(後台)
      product_list_detail        該商品的詳情，顯示在input裡面，按下button可以送出修改
        product_list_detail_edit (UPDATE)
      product_list_new           INSERT新商品，提供input和上傳檔案欄位
        product_list_new_add     (INSERT)

管理折扣(discount_list_*.php)
     discount_list                列出所有折扣(後台)
      discount_list_detail        該折扣的詳情，顯示在input裡面，按下button可以送出修改
        discount_list_detail_edit (UPDATE)
      discount_list_new           INSERT新折扣，提供input和上傳欄位
        discount_list_new_add     (INSERT)   
```
