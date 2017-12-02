DROP DATABASE IF EXISTS BOSS;

CREATE DATABASE BOSS default character set utf8mb4 collate utf8mb4_general_ci;
SET NAMES utf8mb4;
USE BOSS;

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
  ID VARCHAR(8) PRIMARY KEY,
  CID VARCHAR(30),
  DID INT(7) UNSIGNED
);

-- 購物車和商品的特殊性關係;
CREATE TABLE CART_RECORD (
  ID VARCHAR(8),
  PID INT(7) UNSIGNED,
  Quantity INT(5) UNSIGNED NOT NULL,
  PRIMARY KEY(ID,PID)
);

-- 評論;
CREATE TABLE COMMENT (
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  CID VARCHAR(20) NOT NULL,
  PID INT(7) UNSIGNED NOT NULL,
  Star INT(1) NOT NULL,
  Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Comment VARCHAR(100) NOT NULL
);

-- 折扣;
CREATE TABLE DISCOUNT (
  ID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  Type ENUM('shipping', 'seasoning', 'event'),
  PeriodFrom DATE NOT NULL,
  PeriodTo DATE NOT NULL,
  Requirement INT(7) UNSIGNED,
  Rate DOUBLE(3,3) NOT NULL,
  Info VARCHAR(100) NOT NULL,
  EventType ENUM('BOGO', 'discount')
);

-- 插入測試用範例資料;
-- 插入 純喫茶;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('純喫茶綠茶', 25, 'in_stock', 999, NULL, 1, '採集新鮮茶葉進行炒菁，呈現茶葉鮮綠與清香，搭配柔和的茉莉綠茶，口味清爽不甜膩，新鮮暢飲最過癮!', 'http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg'),
      ('純喫茶紅茶', 25, 'in_stock', 999, NULL, 2, '以焙炒大麥搭配紅茶，調製出濃香十足的台灣味紅茶，滿足你對新鮮的期望！', 'http://www.pecos.com.tw/tmp/image/20140409/20140409202109_56209.jpg'),
      ('純喫茶檸檬紅茶', 25, 'in_stock', 999, NULL, 2, '以冰析鮮萃工法，保留檸檬的香氣，搭配濃郁甘醇的紅茶，調和出新鮮的酸甜好滋味！', 'http://www.pecos.com.tw/tmp/image/20140417/20140417192522_66698.jpg'),
      ('純喫茶烏龍青茶', 25, 'in_stock', 999, NULL, 3, '添加焙火烏龍茶，釋放豐富香氣與醇厚原味，多層次的獨特茶感，甘潤無窮！', 'http://www.pecos.com.tw/tmp/image/20140409/20140409202049_34108.jpg'),
      ('純喫茶鮮柚綠茶', 25, 'in_stock', 999, NULL, 1, '以冰析鮮萃工法，保留葡萄柚香氣，調和清爽甘醇的茉莉綠茶，激盪出酸甜清香的新鮮果茶風味！', 'http://www.pecos.com.tw/tmp/image/20150105/20150105090925_79899.jpg'),
      ('純喫茶無糖綠茶', 25, 'in_stock', 999, NULL, 1, '採集新鮮茶葉，以冰析鮮萃工法保留新鮮茶香及兒茶素，茶感清香回韻，讓原味更新鮮！', 'http://www.pecos.com.tw/tmp/image/20160130/20160130103658_89475.jpg');

-- 插入 高級酒;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('袋鼠山雪多利白葡萄酒', 6000, 'in_stock', 999, NULL, 16, '澳洲袋鼠山雪多利白葡萄酒是典型的澳洲葡萄酒，所擁有的高品質葡萄園在理想環境中生長，由南澳洲袋鼠守護著，以現代化方法釀造。', 'http://www.filgifts.com/images/product/small/Kangaroo-ridge-chardonnay.jpg'),
      ('西班牙彩鑽蝶戀白酒', 2399, 'in_stock', 999, NULL, 15, '具有清新花果香，爽口宜人，入口時柔滑圓潤，佐餐搭配性高。', 'http://www.my9.com.tw/image/product/pro_4e1a71a4279af50d11df1414841b6aa0.jpg'),
      ('美國摩根灣夏多內白酒', 6960, 'in_stock', 999, NULL, 15, '摩根灣夏多內白葡萄酒帶有迷人酸度及清新果香，單飲或搭餐都讓人感受無比魅力。', 'http://www.my9.com.tw/image/product/pro_611f8ba8856f27ef98dbf93c349131ee.png'),
      ('法國茱麗葉紅酒14/15', 6960, 'in_stock', 999, NULL, 14, '入口柔滑圓潤，具有成熟櫻桃味道；後段則顯現圓滑如絲絨般的單寧口感。', 'http://www.my9.com.tw/image/product/pro_3f5d25d7828cd2d23d8665c4c64f979a.jpg'),
      ('義大利山之巔黃標紅酒', 4999, 'in_stock', 999, NULL, 14, '典型的巴貝拉品種，有優雅的花香味，和諧清新，柔軟，且富有豐富的層次。', 'http://www.my9.com.tw/image/product/pro_9808ef97108c22b0c378d33836dc7413.jpg'),
      ('美國鶴湖卡本內蘇維翁紅酒 ', 3999, 'in_stock', 999, NULL, 14, '是一支酒體柔順、果香奔放的一支紅酒，橡木、桑椹及黑莓之香氣更為此酒的特色，非常適合現在即時飲用。', 'http://my9.ehosting.com.tw/image/product/pro_c164182ffb6849b39715d9983ceaa2cd.jpg');

-- 插入 日本茶;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('午後の紅茶ミルクティー', 55, 'in_stock', 999, NULL, 5, 'かつてシンハラ王朝の都があったセイロン紅茶発祥の地、キャンディの茶葉を使用。キャンディ茶葉のコクのある香りとミルクの濃厚な味わいで心ほどける本格アイスミルクティー。', 'http://www.kirin.co.jp/products/softdrink/gogo/products/images/modal/m_item_milk.png');

INSERT INTO CATEGORY(Name) Value('綠茶'), ('紅茶'), ('烏龍茶'), ('健康茶'), ('奶茶'),
('碳酸飲料'), ('乳酸飲料') , ('果汁'), ('乳飲品'), ('咖啡'), ('運動飲料'),
('啤酒'), ('燒酒'), ('紅酒'), ('白酒'), ('葡萄酒'), ('水');

INSERT INTO MEMBER(ID, Password, Name, Email, Phone, Birth, Gender, Position, Address)
            VALUE('admin', '21232f297a57a5a743894a0e4a801fc3', '管理員大大', 'admin@gmail.com', '0912345678', '1911-10-10', 'M', 'A','台北市中正區重慶南路一段122號'),
            ('staff', '1253208465b1efa876f982d8a9e73eef', '廢物員工', 'staff@gmail.com', '0912345678', '1911-10-10', 'M', 'S', '台北市中正區忠孝東路一段1號'),
            ('customer', '91ec1f9324753048c0096d036a694f86', '奧客', 'customer@gmail.com', '0912345678', '1911-10-10', 'M', 'C', '台北市中正區中山南路1號'),
            ('a92304a92304', '0104b52e470130135013a7a87a42b609', '黃省喬', 'a92304a92304@gmail.com', '0983333804', '1997-08-23', 'M', 'C', '台北市大同區延平北路三段14號'),
            ('wupinyi', '5de7bb3c232741f461f3ccd13c1ba7a0', '吳品頤', 'wupinyi@gmail.com', '0975276741', '1997-08-19', 'F', 'C' ,'台北車站Y區地下街'),
            ('tim', '5de7bb3c232741f461f3ccd13c1ba7a0', '吳品YEE', 'wupinyi@gmail.com', '0975276741', '1997-08-19', 'F', 'C' ,'台北車站Y區地下街');

INSERT INTO COMMENT (CID, PID, Star, Comment)
  VALUES ('admin', '1', '4', 'I am Admin!'),
  ('staff', '1', '4', 'I am staff!'),
  ('customer', '1', '3','I am customer!'),
  ('customer', '1', '5', '樓下金城武'),
  ('customer', '1', '5', '好茶好茶'),
  ('a92304a92304', '1', '1', '樓上自肥')
;

INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('shipping','2017-11-28','2017-11-29',500,0.1,'老闆出差之員工亂來😈','');
INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('seasoning','2017-11-28','2017-11-29',500,0.1,'起秋季特賣﹣秋季大折扣','');
INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('Event','2017-11-28','2017-11-29',500,0.9,'不小心進太多貨之再不銷出去倉庫就要滿了特賣','BOGO');
INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('Event','2017-11-28','2017-11-29',500,0.87,'❄️飲涼卡好節','discount');
INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('seasoning','2017-12-20','2017-12-27',123,0.90,'Xmas🎄耶誕優惠','');
INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('seasoning','2017-12-28','2018-1-10', 112,0.88,'1/12週年慶','');


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
