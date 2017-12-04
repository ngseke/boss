<?php

  // 印出ALERT提示信息

  if(isset($_SESSION['AlertMsg'])){
    if(!$_SESSION['AlertMsg'][2]){
      $_SESSION['AlertMsg'][2]=true;
      echo '<div id="alert-ani" class="alert text-center alert-'. $_SESSION['AlertMsg'][0] .'" >';
      echo $_SESSION['AlertMsg'][1];
      echo '</div>';
    }else unset($_SESSION['AlertMsg']);
  }
