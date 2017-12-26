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
  State ENUM('in_stock', 'out_of_stock', 'removed_from_shelves'),
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
  ID VARCHAR(8) PRIMARY KEY,
  Date DATETIME NOT NULL,
  FinalCost INT(7) UNSIGNED NOT NULL,
  State ENUM('submitted', 'processed', 'delivered', 'completed') NOT NULL DEFAULT 'submitted',
  CID VARCHAR(20) NOT NULL,
  DID INT(7) UNSIGNED NOT NULL,
  SID VARCHAR(20)
);

-- 訂單和商品的特殊性關係;
CREATE TABLE ORDER_LIST_RECORD (
  OID VARCHAR(8) NOT NULL,
  PID INT(7) UNSIGNED NOT NULL,
  Quantity INT(7) UNSIGNED NOT NULL,
  PRIMARY KEY (OID, PID)
);

-- 購物車;
CREATE TABLE CART (
  ID VARCHAR(8) PRIMARY KEY,
  Date DATETIME NOT NULL
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
VALUE('純喫茶綠茶', 25, 'in_stock', 999, 4, 1, '採集新鮮茶葉進行炒菁，呈現茶葉鮮綠與清香，搭配柔和的茉莉綠茶，口味清爽不甜膩，新鮮暢飲最過癮!', 'http://www.pecos.com.tw/tmp/image/20140409/20140409202153_39623.jpg'),
      ('純喫茶紅茶', 25, 'in_stock', 999, 3, 2, '以焙炒大麥搭配紅茶，調製出濃香十足的台灣味紅茶，滿足你對新鮮的期望！', 'http://www.pecos.com.tw/tmp/image/20140409/20140409202109_56209.jpg'),
      ('純喫茶檸檬紅茶', 25, 'in_stock', 999, NULL, 2, '以冰析鮮萃工法，保留檸檬的香氣，搭配濃郁甘醇的紅茶，調和出新鮮的酸甜好滋味！', 'http://www.pecos.com.tw/tmp/image/20140417/20140417192522_66698.jpg'),
      ('純喫茶烏龍青茶', 25, 'in_stock', 999, NULL, 3, '添加焙火烏龍茶，釋放豐富香氣與醇厚原味，多層次的獨特茶感，甘潤無窮！', 'http://www.pecos.com.tw/tmp/image/20140409/20140409202049_34108.jpg'),
      ('純喫茶鮮柚綠茶', 25, 'in_stock', 999, NULL, 1, '以冰析鮮萃工法，保留葡萄柚香氣，調和清爽甘醇的茉莉綠茶，激盪出酸甜清香的新鮮果茶風味！', 'http://www.pecos.com.tw/tmp/image/20150105/20150105090925_79899.jpg'),
      ('純喫茶無糖綠茶', 25, 'in_stock', 999, NULL, 1, '採集新鮮茶葉，以冰析鮮萃工法保留新鮮茶香及兒茶素，茶感清香回韻，讓原味更新鮮！', 'http://www.pecos.com.tw/tmp/image/20160130/20160130103658_89475.jpg');

-- 插入 高級酒;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('袋鼠山雪多利白葡萄酒', 6000, 'in_stock', 999, 4, 14, '澳洲袋鼠山雪多利白葡萄酒是典型的澳洲葡萄酒，所擁有的高品質葡萄園在理想環境中生長，由南澳洲袋鼠守護著，以現代化方法釀造。', 'http://www.filgifts.com/images/product/small/Kangaroo-ridge-chardonnay.jpg'),
      ('西班牙彩鑽蝶戀白酒', 2399, 'in_stock', 999, 4, 14, '具有清新花果香，爽口宜人，入口時柔滑圓潤，佐餐搭配性高。', 'http://www.my9.com.tw/image/product/pro_4e1a71a4279af50d11df1414841b6aa0.jpg'),
      ('美國摩根灣夏多內白酒', 6960, 'in_stock', 999, 4, 14, '摩根灣夏多內白葡萄酒帶有迷人酸度及清新果香，單飲或搭餐都讓人感受無比魅力。', 'http://www.my9.com.tw/image/product/pro_611f8ba8856f27ef98dbf93c349131ee.png'),
      ('法國茱麗葉紅酒14/15', 6960, 'in_stock', 999, 4, 14, '入口柔滑圓潤，具有成熟櫻桃味道；後段則顯現圓滑如絲絨般的單寧口感。', 'http://www.my9.com.tw/image/product/pro_3f5d25d7828cd2d23d8665c4c64f979a.jpg'),
      ('義大利山之巔黃標紅酒', 4999, 'in_stock', 999, 4, 14, '典型的巴貝拉品種，有優雅的花香味，和諧清新，柔軟，且富有豐富的層次。', 'http://www.my9.com.tw/image/product/pro_9808ef97108c22b0c378d33836dc7413.jpg'),
      ('美國鶴湖卡本內蘇維翁紅酒 ', 3999, 'in_stock', 999, 4, 14, '是一支酒體柔順、果香奔放的一支紅酒，橡木、桑椹及黑莓之香氣更為此酒的特色，非常適合現在即時飲用。', 'http://my9.ehosting.com.tw/image/product/pro_c164182ffb6849b39715d9983ceaa2cd.jpg');

-- 插入 日本茶;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('午後の紅茶ミルクティー', 55, 'in_stock', 999, 3, 5, 'かつてシンハラ王朝の都があったセイロン紅茶発祥の地、キャンディの茶葉を使用。キャンディ茶葉のコクのある香りとミルクの濃厚な味わいで心ほどける本格アイスミルクティー。', 'http://www.kirin.co.jp/products/softdrink/gogo/products/images/modal/m_item_milk.png');

-- 插入 乳酸飲料;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('養樂多活菌發酵乳', 8, 'in_stock', 999, NULL, 7, '代田菌能通過胃酸膽鹽考驗，在腸道中生存繁殖，維護腸道的健康。', 'https://carrefoureccdn.azureedge.net/content/images/thumbs/0005446_800.jpeg'),
      ('養樂多300LIGHT活菌發酵乳', 8, 'in_stock', 999, NULL, 7, '代田菌能通過胃酸膽鹽考驗，在腸道中生存繁殖，維護腸道的健康。', 'https://carrefoureccdn.azureedge.net/content/images/thumbs/0005450_300light_800.jpeg'),
      ('比菲多原味', 28, 'in_stock', 999, NULL, 7, '堅持48小時黃金發酵，醞釀最美麗的風味，隨時補充身體天然益菌。', 'http://www.bifido.com.tw/DB/FileUpLoad/340%20fiber.jpg'),
      ('比菲多綠茶多酚', 30, 'in_stock', 999, NULL, 7, '堅持48小時黃金發酵，醞釀最美麗的風味，隨時補充身體天然益菌。', 'http://www.bifido.com.tw/DB/FileUpLoad/340%20green%20tea.jpg');

-- 插入燒酒;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('初飲初樂燒酒', 160, 'in_stock', 999, NULL, 13, '乾果韓國最初100%用礦物質釀製的燒酒', 'https://cdn.ztore.com/images/ztore/production/product/640px/1003084_1.jpg?1475573773'),
      ('初飲初樂柚子燒酒', 180, 'in_stock', 999, NULL, 13, '淡淡的酒香中泛著清香的柚子味，口感較普通燒酒更加柔和、清甜爽口', 'https://img.alicdn.com/tfscom/i2/725677994/TB1WMJFby0TMKJjSZFNXXa_1FXa_!!2-item_pic.png_196x196Q50s50.jpg'),
      ('初飲初樂水蜜桃燒酒', 180, 'in_stock', 999, NULL, 13, '淡淡的酒香中泛著濃濃的水蜜桃味，與柚子味燒酒不同的是，此次新上市的水蜜桃酒甜味更加濃郁。 ', 'http://www.cn-kr.net/upload/newsimg/20150725/1437806225310689.jpg'),
      ('初飲初樂蘋果燒酒', 180, 'in_stock', 999, NULL, 13, '淡淡的酒香中泛著清香的蘋果味，口感較普通燒酒更加柔和、清甜爽口', 'https://www.dj9.com.tw/images/201608/goods_img/1256_P_1471836842299.jpg');

-- 插入碳酸飲料;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('黑松沙士', 25, 'in_stock', 999, NULL, 6, '歡樂時光一直倒~黑松汽水', 'https://s.yimg.com/wb/images/7AFE3D71067C3B77792A97650BB6B20066F91BAC'),
      ('黑松沙士-加鹽', 25, 'in_stock', 999, NULL, 6, '享受清涼快意!', 'http://static.blog.sina.com.tw/myimages/108/126316/images/20120511181348325.jpg'),
      ('可口可樂', 29, 'in_stock', 999, NULL, 6, '擋不住的暢快口感', 'http://img.udn.com/image/product/S0001126/APPROVED/U001359050/20130415174850924_300.jpg?t=20150603115750'),
      ('百事可樂', 32, 'in_stock', 999, NULL, 6, '引領時尚潮流，創造快樂，要你把快樂帶回家', 'http://www.vedan.com.tw/thumbnail.aspx?h=200&f=/upload/Product/P000174/PEPSI-500_445x440.jpg'),
      ('雪碧汽水', 29, 'in_stock', 999, NULL, 6, '擋不住的暢快口感給您前所未有的滿足', 'https://img1.e-payless.com.tw/content/images/thumbs/0462543_1200600ml24.jpeg');

-- 插入 麥香;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('麥香紅茶', 10, 'in_stock', 999, NULL, 2, '醇厚紅茶結合焙炒大麥，成就獨特大麥風味、暢銷全台的紅茶飲料。', 'http://www.pecos.com.tw/tmp/image/20161201/20161201104624_26964.jpg'),
('麥香奶茶', 10, 'in_stock', 999, 3, 5, '醇厚紅茶結合大麥香氣與乳粉調配，呈現具獨特大麥及焦糖風味的奶茶。', 'http://www.pecos.com.tw/tmp/image/20161201/20161201110407_73845.jpg'),
('麥香綠茶', 10, 'in_stock', 999, NULL, 2, '選用甜香特色的焙香綠茶葉，萃取醇厚茶汁，搭配焙炒大麥，呈現獨特大麥風味的綠茶。', 'http://www.pecos.com.tw/tmp/image/20161201/20161201110522_79817.jpg'),
('麥香阿薩姆紅茶', 25, 'in_stock', 999, NULL, 2, '選用花甜香與渾厚飽滿特性的阿薩姆紅茶葉，結合焙炒大麥，呈現茶香甜香交織的阿薩姆紅茶。', 'http://www.pecos.com.tw/tmp/image/20150910/20150910082855_85509.jpg'),
('麥香阿薩姆奶茶', 25, 'in_stock', 999, 3, 5, '選用麥芽甜香與渾厚飽滿特性的阿薩姆紅茶葉，結合焙炒大麥、乳粉與煉乳調配，呈現濃郁甜香的阿薩姆奶茶。', 'http://www.pecos.com.tw/tmp/image/20150909/20150909113155_53978.jpg'),
('麥香錫蘭奶茶', 25, 'in_stock', 999, 3, 5, '選用芬芳香氣與口感渾厚的錫蘭紅茶葉，結合焙炒大麥與乳粉，呈現香滑醇順的錫蘭奶茶。', 'http://www.pecos.com.tw/tmp/image/20150909/20150909113347_48359.jpg');

-- 插入 水;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('UNI water', 20, 'in_stock', 999, NULL, 15, 'UNI water為國內首創「簡約時尚」包裝水！如水晶般完美六角透明瓶身，襯托出水的純淨無暇。 簡約設計融合彩虹七色，為您的生活帶來絢爛繽紛的幸福。不論是個人飲用或是朋友聚會，絕對是您品味生活不可或缺的最佳選擇！', 'http://www.pecos.com.tw/tmp/image/20170907/20170907141846_14406.jpg'),
('統一PH9.0鹼性離子水', 25, 'in_stock', 999, NULL, 15, '【體質加鹼顧，健康好鹼單】現代人應酬頻繁、外食攝取率過高，常常容易造成身體過多的負擔；吃完美食別忘了顧體質，天天喝統一 PH9.0鹼性離子水，補充人體所需的水份。', 'http://www.pecos.com.tw/tmp/image/20140402/20140402195619_58489.jpg');

-- 插入 健康茶;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('爽健美茶', 25, 'in_stock', 999, NULL, 4, '生活的壓力與瑣事總讓自己感到煩躁，多希望能有一個天然的純淨茶飲，讓身心靈釋放，得到片刻的舒緩，以再次擁有清爽愉快的心情，朝著健康的生活積極邁進。風行日本多年的『爽健美茶』是大自然恩賜的完美組合，由薏仁、玄米、綠茶、月見草等15種100%日本進口、有益健康的天然素材調和而成，散發獨特香氣與純淨清新的口感。喝一口，就能感受到大自然所帶來清爽、健康、美麗的全新愉快感受。喝一口爽健美茶，讓身體沉浸在15種天然成分調和的大自然恩賜中，由內而外，為你帶來清爽、健康、美麗的全新愉快感受。', 'https://mart.ibon.com.tw/mdz_file/item/21/20/01/1005/10050009143G_char_5_170217093152.jpg');

-- 插入 果汁;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('美粒果柳橙汁', 23, 'in_stock', 999, NULL, 8, '加入了陽光果肉，含有果肉纖維、營養更完整，讓您在飲用時可以喝到滿口的果肉，並享有咀嚼果肉的驚奇口感，帶給您全新體驗、愛不釋手。', 'http://www.savesafe.com.tw/ProdImg/1001/659/00/1001659_00_main.jpg?t=20130628101622'),
      ('美粒果白葡萄汁', 23, 'in_stock', 999, NULL, 8, '添加入清新蘆薈粒、營養更完整，讓您在飲用時可以喝到滿口的蘆薈粒，並享有咀嚼蘆薈粒的驚奇口感，帶給您全新體驗、愛不釋手。', 'https://mart.ibon.com.tw/mdz_file/item/21/20/01/1012/10120011634G_char_65_160929104900.jpg');

-- 插入 乳飲品;
INSERT INTO PRODUCT (Name, Price, State, Stock, DID, CategoryID, Info, Img)
VALUE('光泉杯裝麥芽調味乳玉米片', 35, 'in_stock', 999, NULL, 9, '對生活步調匆忙的學生族而言，是最便利、營養的早餐飲品,精選進口麥芽粉溶入香純牛乳中,喝下滿口自然香甜的麥芽風味， 也喝下了好健康', 'https://www.savesafe.com.tw/ProdImg/1007/857/00/1007857_00_main.jpg');


-- ('x', 25, 'in_stock', 999, NULL, 5, 'x', 'x'),   ;
INSERT INTO CATEGORY(Name) Value('綠茶'), ('紅茶'), ('烏龍茶'), ('健康茶'), ('奶茶'),
('碳酸飲料'), ('乳酸飲料') , ('果汁'), ('乳飲品'), ('咖啡'), ('運動飲料'),
('啤酒'), ('燒酒'), ('洋酒'), ('水');

INSERT INTO MEMBER(ID, Password, Name, Email, Phone, Birth, Gender, Position, Address)
            VALUE('admin', '21232f297a57a5a743894a0e4a801fc3', '管理員大大', 'admin@gmail.com', '0912345678', '1911-10-10', 'M', 'A','台北市中正區重慶南路一段122號'),
            ('staff', '1253208465b1efa876f982d8a9e73eef', '廢物員工', 'staff@gmail.com', '0912345678', '1911-10-10', 'M', 'S', '台北市中正區忠孝東路一段1號'),
            ('customer', '91ec1f9324753048c0096d036a694f86', '奧客', 'customer@gmail.com', '0912345678', '1911-10-10', 'M', 'C', '台北市中正區中山南路1號'),
            ('a92304a92304', '0104b52e470130135013a7a87a42b609', '黃省喬', 'a92304a92304@gmail.com', '0983333804', '1997-08-23', 'M', 'C', '台北市大同區延平北路三段14號'),
            ('kr80737', '5de7bb3c232741f461f3ccd13c1ba7a0', '吳品頤', 'kr80737@gmail.com', '0975276741', '1997-08-19', 'F', 'C' ,'台北車站Y區地下街'),
            ('zhaozhenting', '0104b52e470130135013a7a87a42b609', '趙振廷', 'zhaozhenting@gmail.com', '0912345678', '1911-10-10', 'M', 'C', '台北市'),
            ('mdyu1000', '0104b52e470130135013a7a87a42b609', '余鎧企', 'mdyu1000@gmail.com', '0912345678', '1911-10-10', 'M', 'C', '台北市');

INSERT INTO MEMBER(ID, Password, Name, Email, Phone, Birth, Gender, Position, Address)
            VALUE('kimjongun', '21232f297a57a5a743894a0e4a801fc3', '金政恩', 'kimjongun@gmail.com', '0912345678', '1911-10-10', 'M', 'C','北朝鮮'),
            ('caiyingwen', '1253208465b1efa876f982d8a9e73eef', '蔡央乂', 'caiyingwen@gmail.com', '0912345678', '1911-10-10', 'F', 'C', '台北市總統府');

INSERT INTO COMMENT (CID, PID, Star, Comment)
  VALUES ('admin', '1', '4', 'I am Admin!'),
  ('staff', '1', '4', 'I am staff!'),
  ('customer', '1', '3','I am customer!'),
  ('customer', '1', '5', '樓下金城武'),
  ('customer', '1', '5', '好茶好茶🍵'),
  ('a92304a92304', '1', '1', '樓上自肥');

INSERT INTO COMMENT (CID, PID, Star, Comment) VALUES ('kr80737', '1', '1', '聞起來很奶茶，喝起來濃濃化工味。。。出來面對啦！');
INSERT INTO COMMENT (CID, PID, Star, Comment) VALUES ('staff', '1', '5', '請樓上的客人息怒，我們將不會退錢給你');
INSERT INTO COMMENT (CID, PID, Star, Comment) VALUES ('a92304a92304', '5', '5', '大推 不錯喝👍！有點酸酸甜甜的像是初戀的滋味 不知道是不是臭酸');
INSERT INTO COMMENT (CID, PID, Star, Comment) VALUES ('mdyu1000', '2', '4', '最近也看到這家，是下次要購買的口袋清單 >///<');
INSERT INTO COMMENT (CID, PID, Star, Comment) VALUES ('mdyu1000', '13', '4', '覺得可以嘗試自己做, 買茶包加牛奶');
INSERT INTO COMMENT (CID, PID, Star, Comment) VALUES ('kimjongun', '13', '1', '雖然濃醇香但是打倒日本鬼子！！🇰🇵🇰🇵🇰🇵');

INSERT INTO ORDER_LIST(ID,DATE,FinalCost,State,CID,DID,SID) VALUES('f7cbe6b6','2017-12-25 17:28:04',22,'completed','customer',3,'staff');
INSERT INTO ORDER_LIST(ID,DATE,FinalCost,State,CID,DID,SID) VALUES('f7cbe6b7','2017-12-25 17:28:04',22,'submitted','customer',3,'staff');
INSERT INTO ORDER_LIST(ID,DATE,FinalCost,State,CID,DID,SID) VALUES('a0000001','2017-12-25 17:28:04',22,'processed','customer',3,'staff');
INSERT INTO ORDER_LIST(ID,DATE,FinalCost,State,CID,DID,SID) VALUES('a0000002','2017-12-25 17:28:04',22,'delivered','customer',3,'staff');

INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('shipping','2017-11-28','2017-11-29',500,0.1,'老闆出差之員工亂來','');
INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('seasoning','2017-11-28','2017-11-29',500,0.1,'起秋季大折扣','');
INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('Event','2017-11-28','2018-2-10',500,0.9,'不小心進太多貨GG','BOGO');
INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('Event','2017-11-28','2018-2-10',500,0.87,'飲涼卡好節','discount');
INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('seasoning','2017-12-20','2017-12-27',123,0.90,'Xmas耶誕優惠','');
INSERT INTO DISCOUNT (Type,PeriodFrom,PeriodTo,Requirement,Rate,Info,EventType) VALUES('seasoning','2017-12-2','2018-1-10', 112,0.88,'1/12週年慶','');


-- FOREIGN KEY;
ALTER TABLE PRODUCT ADD FOREIGN KEY (DID) REFERENCES DISCOUNT (ID);
ALTER TABLE PRODUCT ADD FOREIGN KEY (CategoryID) REFERENCES CATEGORY(ID);
ALTER TABLE ORDER_LIST ADD FOREIGN KEY (CID) REFERENCES MEMBER(ID);
ALTER TABLE ORDER_LIST ADD FOREIGN KEY (DID) REFERENCES DISCOUNT(ID);
ALTER TABLE ORDER_LIST_RECORD ADD FOREIGN KEY (OID) REFERENCES ORDER_LIST(ID);
ALTER TABLE CART_RECORD ADD FOREIGN KEY (ID) REFERENCES CART(ID);
ALTER TABLE CART_RECORD ADD FOREIGN KEY (PID) REFERENCES PRODUCT(ID);
ALTER TABLE COMMENT ADD FOREIGN KEY (CID) REFERENCES MEMBER(ID);


-- VIEW 視界;

DROP VIEW IF EXISTS PRODUCT_VIEW;

-- 為了簡化在php中的查詢指令，建此VIEW把 PRODUCT, CATEGORY, DISCOUNT 合併成一表。;
-- PPrice: 原始價格 / PPriceDiscount: 折扣後價格，如果沒有折扣或者在期限外則為NULL;
-- PPriceF: 加入逗號的原始價格 / PPriceDiscount: 加入逗號的折扣後價格，同上。;

CREATE VIEW PRODUCT_VIEW
AS SELECT P.ID PID ,P.Name PName, P.Info PInfo, P.Img PImg, P.Stock PStock, P.State PState,
          C.Name CName, C.ID CID, D.ID DID, D.Rate DRate, D.EventType DEvent,
          (CASE WHEN ((D.PeriodTo >= NOW() AND D.PeriodFrom <= NOW()) AND D.EventType='BOGO')
                THEN 'BOGO'
                WHEN ((D.PeriodTo >= NOW() AND D.PeriodFrom <= NOW()) AND D.EventType='Discount')
                THEN 'Discount'
                ELSE NULL END) DEventType,
          P.Price PPrice,
          (CASE WHEN ((D.PeriodTo >= NOW() AND D.PeriodFrom <= NOW()) AND D.EventType='Discount')
                THEN (P.Price * D.Rate)
                ELSE NULL END) PPriceDiscount,
          FORMAT(P.Price,0) PPriceF,
          FORMAT((CASE WHEN ((D.PeriodTo >= NOW() AND D.PeriodFrom <= NOW()) AND D.EventType='Discount')
                THEN (P.Price * D.Rate)
                ELSE NULL END),0) PPriceDiscountF
           FROM PRODUCT P
           INNER JOIN CATEGORY C ON P.CategoryID = C.ID
           LEFT JOIN DISCOUNT D ON P.DID = D.ID
           WHERE P.CategoryID = C.ID
           ORDER BY PID
