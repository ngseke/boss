// 動態設定欄位的顯示
function SetDiscountDisplay() {
  if($("select[name='Type']").val()=='shipping'){
    $("input[name='Rate']").parent().addClass('d-none');
    $("select[name='EventType']").parent().addClass('d-none');
    $("input[name='Requirement']").parent().parent().removeClass('d-none');
    $('#TypeDescribe').html('運費：達特定金額享“訂單免運費”。');
  } else if($("select[name='Type']").val()=='seasoning'){
    $("input[name='Rate']").parent().removeClass('d-none');
    $("select[name='EventType']").parent().addClass('d-none');
    $("input[name='Requirement']").parent().parent().removeClass('d-none');
    $('#TypeDescribe').html('季節：達特定金額享“訂單打折”。');
  } else if($("select[name='Type']").val()=='event'){
    $("input[name='Rate']").parent().removeClass('d-none');
    $("select[name='EventType']").parent().removeClass('d-none');
    $("select[name='Rate']").addClass('d-none');
    $('#TypeDescribe').html('活動：特定商品買一送一(BOGO)或打折(Discount)。');
  }
}

function SetEventTypeDisplay(){
  if($("select[name='Type']").val()=='event'){
    if($("select[name='EventType']").val()=='BOGO'){
      $("input[name='Rate']").parent().addClass('d-none');
      $("input[name='Requirement']").parent().parent().addClass('d-none');
    } else if($("select[name='EventType']").val()=='discount'){
      $("input[name='Rate']").parent().removeClass('d-none');
      $("input[name='Requirement']").parent().parent().addClass('d-none');
    }
  }
}

$(document).ready(function(){
  SetEventTypeDisplay();
  SetDiscountDisplay();
});
$("select[name='Type']").change(function(){
  SetDiscountDisplay();
  SetEventTypeDisplay();
});
$("select[name='EventType']").change(function(){
  SetEventTypeDisplay();
});
