<?php
include('connection.php');

//基本查詢指令
$sql = "SELECT CID, CName, COUNT(*) CNum
FROM PRODUCT_VIEW GROUP BY CID
ORDER BY CID";

$result = $conn->query($sql);  // $result 存放查詢到的所有物件



$data = array();
while ($rows = mysqli_fetch_assoc($result)) {
  $data[] = $rows;
}
echo json_encode($data,JSON_UNESCAPED_UNICODE);
