# BOSS茶店
## 簡介

![](https://i.imgur.com/QeqNrjF.png)

這是一個**在線飲料購物系統** (Beverage Online Shop System)，簡稱**BOSS**，是一個簡單易用，介面時尚清爽的飲料購物平台。  

本專案後端以PHP語言撰寫，前端以Bootstrap的架構搭配HTML5和CSS3作為基礎進行版型設計。

## 使用軟體
### 安裝
使用 [XAMPP](https://www.apachefriends.org/d) 架設Apache Web伺服器。  
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

![](https://i.imgur.com/vPQogHz.jpg)


開啟 `config.php`，設定mysql伺服器資訊，若使用預設值則不需修改。
```
define('db_host',    'localhost', false); // 資料庫host
define('db_username', 'root',     false); // 資料庫用戶名
define('db_password', '',         false); // 資料庫密碼
define('db_name',     'BOSS',     false); // 資料庫名稱
```
輸入網址 <http://localhost/boss/db.php> 一鍵生成資料庫。  

亦可打開 `db.sql`，全選內容後，進入<http://localhost/phpmyadmin>並手動貼上console進行查詢。

## 主要功能
### 首頁
`index.php` 為主頁面，使用具視覺衝擊的巨大廣告看板Jumbotron，搭配強而有力的廣告標語，讓主頁投射入眼簾的瞬間即深刻的烙印在腦海中。頁面會隨機挑選出數個**熱銷商品**作為宣傳，以及當前進行中的活動。

### 導覽列 (Navbar)
導覽列包含以下：
 - 形象LOGO：連接至首頁
 - 商品
 - 快速搜尋框
 - 購物車：僅在 **G(Guest)** 或 **C(Customer)** 身份顯示
 - 登入/註冊 [未登入時顯示]
 - 會員 [登入後顯示]
   - 會員資訊
   - 訂單資訊
   - 登出

以**A(Admin)** 或 **S(Staff)** 身份登入後，會有以下額外操作功能：
**管理訂單、管理商品、管理折扣、管理會員。**


### 瀏覽商品
`product.php` 可瀏覽所有商品列表，在頁面左側可根據商品的種類篩選。

### 進階搜尋功能
`product.php` 選擇右側選單的**搜尋**，提供根據**關鍵字**、 **價格**或**類別**進行查詢，亦可將這三種條件疊加使用搜尋。
### 會員系統
`login.php` 簡潔的登入介面。  
`reg.php`   簡潔的註冊介面。

會員(MEMBER)分成以下三種：
 - A (Admin) : 管理員
 - S (Staff) : 員工
 - C (Customer) : 顧客

登入用戶後在Navbar的右方會顯示用戶名，若身份為 **A(Admin)** 或 **S(Staff)** 會以特別標籤提示。

### 管理訂單
`order_list.php` 一目瞭然的顯示所有訂單，**Staff**或**Admin**可以設定訂單的狀態，或選擇接管該訂單。
### 管理商品
`product_list.php` 一目瞭然的顯示所有商品，可新增商品、上傳商品圖片，或針對各個商品修改內容。
### 管理折扣
`discount_list.php` 一目瞭然的顯示所有折扣，可新增折扣項目、設定折扣期區間，或是修改現有折扣內容。
```
折扣類型
┣ shipping [Requirement]        :達特定金額享“訂單免運費”。
┣ seasoning [Requirement, Rate] :達特定金額享“訂單打折”。
┗ event
  ┣ BOGO [x]                    :特定商品買一送一。
  ┗ discount [Rate]             :特定商品打折。
```
### 管理會員
`user_list.php` 一目瞭然的顯示所有已註冊的會員，可手動新增會員，或是修改現有會員資料。



## 資料表(Table)說明

### CART
購物車。
### CART_RECORD
購物車與商品之間的關聯。
### CATEGORY
商品種類。
### COMMENT
商品評論和評分。
### DISCOUNT
折扣優惠。
### MEMBER
會員。
### ORDER_LIST
訂單。
### ORDER_LIST_RECORD
訂單和商品之間的關聯。
### PRODUCT
商品。
