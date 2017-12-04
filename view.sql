DROP VIEW IF EXISTS PRODUCT_FULL;

CREATE VIEW PRODUCT_FULL
AS SELECT P.ID PID ,P.Name PName, P.Info PInfo, P.Price Price, P.Img PImg ,C.Name CName,
           FORMAT(Price,0) PPrice, FORMAT(P.Price * D.Rate,0) PPriceDiscount FROM PRODUCT P
           INNER JOIN CATEGORY C ON P.CategoryID = C.ID
           LEFT JOIN DISCOUNT D ON P.DID = D.ID
           WHERE P.CategoryID = C.ID
           ORDER BY PID;
