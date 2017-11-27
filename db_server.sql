-- ！不要改這個 這個是伺服器用的版本辣 要改請改db.php 婊子！;

DROP DATABASE IF EXISTS b24_21029138_BOSS;

CREATE DATABASE b24_21029138_BOSS default character set utf8mb4 collate utf8mb4_general_ci;
SET NAMES utf8mb4;
USE b24_21029138_BOSS;

-- 會員資料;
CREATE TABLE MEMBER(
  ID VARCHAR(20) PRIMARY KEY,
  Password VARCHAR(128) NOT NULL,
  Name VARCHAR(12) NOT NULL,
  Email VARCHAR(30) NOT NULL,
  Phone VARCHAR(10) NOT NULL,
  RegDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Birth DATE,
  Gender ENUM('M', 'F', 'N'),
  Address VARCHAR(100),
  Position ENUM('S', 'A', 'C') NOT NULL
);

-- 商品;
CREATE TABLE PRODUCT(
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(30) NOT NULL,
  State ENUM('in_stock', 'out_of_stock'),
  Stock INT(7) UNSIGNED NOT NULL,
  Price INT(10) UNSIGNED NOT NULL,
  Img VARCHAR(100) NOT NULL,
  Info VARCHAR(300),
  DID INT(7) UNSIGNED,
  CategoryID INT(7) UNSIGNED NOT NULL
);

-- 商品類型;
CREATE TABLE CATEGORY(
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(10) NOT NULL UNIQUE
);

-- 訂單;
CREATE TABLE ORDER_LIST (
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  Date DATETIME NOT NULL,
  Final_Cost INT(7) UNSIGNED NOT NULL,
  State ENUM('submitted', 'processed', 'delivered', 'completed'),
  CID VARCHAR(30) NOT NULL,
  DID INT(7) UNSIGNED NOT NULL,
  SID INT(7) UNSIGNED NOT NULL,
  PID INT(7) UNSIGNED NOT NULL
);

-- 訂單和商品的特殊性關係;
CREATE TABLE ORDER_LIST_RECORD (
  OID INT(7) UNSIGNED NOT NULL,
  PID INT(7) UNSIGNED NOT NULL,
  Quantity INT(7) UNSIGNED NOT NULL,
  PRIMARY KEY (OID, PID)
);

-- 購物車;
CREATE TABLE CART (
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  CID VARCHAR(30) NOT NULL,
  PID INT(7) UNSIGNED NOT NULL
);

-- 購物車和商品的特殊性關係;
CREATE TABLE CART_RECORD (
  ID INT(7) UNSIGNED,
  PID INT(7) UNSIGNED,
  Quantity INT(5) UNSIGNED NOT NULL,
  PRIMARY KEY(ID,PID)
);

-- 評論;
CREATE TABLE COMMENT (
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  CID VARCHAR(30) NOT NULL,
  PID INT(7) UNSIGNED NOT NULL,
  Star INT(1) NOT NULL,
  Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Comment VARCHAR(100) NOT NULL
);

-- 折扣;
CREATE TABLE DISCOUNT (
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  Type ENUM('shipping', 'seasoning', 'event'),
  PeriodFrom DATETIME NOT NULL,
  PeriodTo DATETIME NOT NULL,
  Requirement INT(7) UNSIGNED,
  Rate DOUBLE(3,3) NOT NULL,
  EventType ENUM('BOGO', 'discount')
);

-- 插入測試用範例資料;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('純喫茶綠茶', 25, 'in_stock', 999, NULL, 1, '採集新鮮茶葉進行炒菁，呈現茶葉鮮綠與清香，搭配柔和的茉莉綠茶，口味清爽不甜膩，新鮮暢飲最過癮!', 'http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg'),
      ('純喫茶紅茶', 25, 'in_stock', 999, NULL, 1, '以焙炒大麥搭配紅茶，調製出濃香十足的台灣味紅茶，滿足你對新鮮的期望！', 'http://www.pecos.com.tw/tmp/image/20140409/20140409202109_56209.jpg'),
      ('純喫茶檸檬紅茶', 25, 'in_stock', 999, NULL, 1, '以冰析鮮萃工法，保留檸檬的香氣，搭配濃郁甘醇的紅茶，調和出新鮮的酸甜好滋味！', 'http://www.pecos.com.tw/tmp/image/20140417/20140417192522_66698.jpg'),
      ('純喫茶烏龍青茶', 25, 'in_stock', 999, NULL, 1, '添加焙火烏龍茶，釋放豐富香氣與醇厚原味，多層次的獨特茶感，甘潤無窮！', 'http://www.pecos.com.tw/tmp/image/20140409/20140409202049_34108.jpg'),
      ('純喫茶鮮柚綠茶', 25, 'in_stock', 999, NULL, 1, '以冰析鮮萃工法，保留葡萄柚香氣，調和清爽甘醇的茉莉綠茶，激盪出酸甜清香的新鮮果茶風味！', 'http://www.pecos.com.tw/tmp/image/20150105/20150105090925_79899.jpg'),
      ('純喫茶無糖綠茶', 25, 'in_stock', 999, NULL, 1, '採集新鮮茶葉，以冰析鮮萃工法保留新鮮茶香及兒茶素，茶感清香回韻，讓原味更新鮮！', 'http://www.pecos.com.tw/tmp/image/20160130/20160130103658_89475.jpg'),
      ('袋鼠山雪多利白葡萄酒', 25, 'in_stock', 999, NULL, 2, '澳洲袋鼠山雪多利白葡萄酒是典型的澳洲葡萄酒，所擁有的高品質葡萄園在理想環境中生長，由南澳洲袋鼠守護著，以現代化方法釀造。', 'http://www.filgifts.com/images/product/small/Kangaroo-ridge-chardonnay.jpg'),
      ('西班牙 彩鑽蝶戀白酒', 25, 'in_stock', 999, NULL, 2, '具有清新花果香，爽口宜人，入口時柔滑圓潤，佐餐搭配性高。', 'http://www.my9.com.tw/image/product/pro_4e1a71a4279af50d11df1414841b6aa0.jpg'),
      ('美國 摩根灣夏多內白酒 ', 25, 'in_stock', 999, NULL, 2, '摩根灣夏多內白葡萄酒帶有迷人酸度及清新果香，單飲或搭餐都讓人感受無比魅力。', 'http://www.my9.com.tw/image/product/pro_611f8ba8856f27ef98dbf93c349131ee.png'),
      ('法國 茱麗葉紅酒14/15 ', 25, 'in_stock', 999, NULL, 2, '入口柔滑圓潤，具有成熟櫻桃味道；後段則顯現圓滑如絲絨般的單寧口感。', 'http://www.my9.com.tw/image/product/pro_3f5d25d7828cd2d23d8665c4c64f979a.jpg'),
      ('義大利 山之巔黃標紅酒 ', 25, 'in_stock', 999, NULL, 2, '典型的巴貝拉品種，有優雅的花香味，和諧清新，柔軟，且富有豐富的層次。', 'http://www.my9.com.tw/image/product/pro_9808ef97108c22b0c378d33836dc7413.jpg'),
      ('美國 鶴湖卡本內蘇維翁紅酒 ', 25, 'in_stock', 999, NULL, 2, '是一支酒體柔順、果香奔放的一支紅酒，橡木、桑椹及黑莓之香氣更為此酒的特色，非常適合現在即時飲用。', 'http://my9.ehosting.com.tw/image/product/pro_c164182ffb6849b39715d9983ceaa2cd.jpg');

INSERT INTO CATEGORY(Name) Value('茶'), ('酒');
INSERT INTO MEMBER(ID, Password, Name, Email, Phone, Birth, Gender, Position)
            VALUE('admin', '21232f297a57a5a743894a0e4a801fc3', '管理員大大', 'admin@gmail.com', '0912345678', '1911-10-10', 'M', 'A'),
            ('staff', '1253208465b1efa876f982d8a9e73eef', '廢物員工', 'staff@gmail.com', '0912345678', '1911-10-10', 'M', 'S'),
            ('customer', '91ec1f9324753048c0096d036a694f86', '奧克', 'customer@gmail.com', '0912345678', '1911-10-10', 'M', 'C');

INSERT INTO COMMENT (`CID`, `PID`, `Star`, `Date`, `Comment`) VALUES ('admin', '1', '3', CURRENT_TIMESTAMP, 'I am Admin!');
INSERT INTO COMMENT (`CID`, `PID`, `Star`, `Date`, `Comment`) VALUES ('staff', '1', '3', CURRENT_TIMESTAMP, 'I am staff!');
INSERT INTO COMMENT (`CID`, `PID`, `Star`, `Date`, `Comment`) VALUES ('customer', '1', '3', CURRENT_TIMESTAMP, 'I am customer!');
INSERT INTO COMMENT (`CID`, `PID`, `Star`, `Date`, `Comment`) VALUES ('admin', '1', '3', CURRENT_TIMESTAMP, 'asdf');

-- FOREIGN KEY;
ALTER TABLE PRODUCT ADD FOREIGN KEY (DID) REFERENCES DISCOUNT (ID);
ALTER TABLE PRODUCT ADD FOREIGN KEY (CategoryID) REFERENCES CATEGORY(ID);
ALTER TABLE ORDER_LIST ADD FOREIGN KEY (CID) REFERENCES MEMBER(ID);
ALTER TABLE ORDER_LIST ADD FOREIGN KEY (DID) REFERENCES DISCOUNT(ID);
ALTER TABLE ORDER_LIST_RECORD ADD FOREIGN KEY (OID) REFERENCES ORDER_LIST(ID);
ALTER TABLE ORDER_LIST_RECORD ADD FOREIGN KEY (PID) REFERENCES PRODUCT(ID);
ALTER TABLE CART ADD FOREIGN KEY (CID) REFERENCES MEMBER(ID);
ALTER TABLE CART_RECORD ADD FOREIGN KEY (ID) REFERENCES CART(ID);
ALTER TABLE CART_RECORD ADD FOREIGN KEY (PID) REFERENCES PRODUCT(ID);
ALTER TABLE COMMENT ADD FOREIGN KEY (CID) REFERENCES MEMBER(ID)
