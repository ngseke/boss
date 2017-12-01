
//取得今天的日期（格式：2018/01/01，會自動補零，才可正常丟入input中）
function GetTodayDate(){
  var TimeNow = new Date();
  var yyyy = TimeNow.toLocaleDateString().slice(0,4)
  var MM = (TimeNow.getMonth()+1<10 ? '0' : '')+(TimeNow.getMonth()+1);
  var dd = (TimeNow.getDate()<10 ? '0' : '')+TimeNow.getDate();
  return yyyy + '-' + MM + '-' + dd;
}

$(document).ready(function(){
  console.log(GetTodayDate());
  // input中預設值為今天日期，對.date-today的元素作用而已。
  $('.date-today').val(GetTodayDate());
});
