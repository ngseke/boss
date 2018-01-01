<!--
  登入介面改為modal顯示。
  此頁放的是‘modal彈出視窗’ 和 ‘AJAX語法’， 同時處理登入和登出。
-->
<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">登入BOSS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row login-panel" method="post">
            <div class="col-12">
              <div id="LoginAlert" class="alert text-center d-none"></div>
            </div>
            <div class="col-12 form-group">
              <label for="">帳號</label>
              <input id="LoginID" value="admin" type="text" placeholder="帳號" class="form-control" required>
              <small id="NoSuchID" class="text-warning d-none"></small>
            </div>
            <div class="col-12 form-group">
              <label for="">密碼</label>
              <input id="LoginPW" value="pw" type="password" placeholder="密碼" class="form-control" required>
              <small class="text-muted">萬用密碼'pw'</small>
            </div>
            <div class="col-12 form-group">
              <button id="login" class="btn btn-primary btn-block" type="button">LOGIN</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 登入JQ -->
<script type="text/javascript">
// AJAX登入
$("#login").click(function(){
  $.post("login_user.php",
  {
    ID: $('#LoginID').val(),
    Password: $('#LoginPW').val()
  },
  function(data,status){
    $('#LoginAlert').removeClass('d-none').removeClass('alert-success').removeClass('alert-danger');
    if(data=='success'){
      $('.login-panel').empty().html('<div class="col-12 text-center my-3 text-success"><i class="material-icons text-success" style="font-size:5rem">done</i><h5>成功登入!</h5></div>');
      // 等待一秒後刷新頁面
      setTimeout(function(){location.reload();}, 500);
    }else {
      $('#LoginAlert').addClass('alert-danger').html('<i class="material-icons">block</i> 帳號或密碼錯誤!');
    }
  });
});

// 提示帳號不存在
$("#LoginID").change(function(){
  $.post("login_user.php",
  {
    ID: $('#LoginID').val(),
    Password: ''
  },
  function(data,status){
    if(data=='iderr'){
      $('#NoSuchID').html('<i class="material-icons" style="font-size:.8rem">help_outline</i> 查無此帳號').removeClass('d-none');
    }else{
      $('#NoSuchID').html('').addClass('d-none')
    }
  });
});

// 當焦點在LoginID時，按下ENTER鍵送出
$("#LoginID").keypress(function(e){
  code = (e.keyCode ? e.keyCode : e.which);
  if (code == 13) $("#login").click();
});
// 當焦點在LoginPW時，按下ENTER鍵送出
$("#LoginPW").keypress(function(e){
  code = (e.keyCode ? e.keyCode : e.which);
  if (code == 13) $("#login").click();
});
</script>
