<!-- 放footer的地方 -->

<div class="container mt-3">
  <div class="row">
    <div class="col-12">
      <small>
        <p class="text-muted text-center">© Copyright BOSS</p>
      </small>
      <div class="alert alert-info text-center" >
      <?php
      if(debug_mode){
        echo '$user_name: ' .$user_name.
        ' / $user_position: '.$user_position.
        ' / $user_email: '. $user_email.
        ' / $user_phone: '.$user_phone.
        ' / $user_reg_date: '.$user_reg_date.
        ' / $user_birth: '. $user_birth .
        ' / $user_gender: ' . $user_gender.
        ' / $user_address: '.$user_address ;
      }
      ?>
      </div>
    </div>
  </div>
</div>
