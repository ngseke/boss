<!-- 放footer的地方 -->
<?php
$authorList= array( "FBID"=>array("100000577680481", "100000221900785", '100000427402468','100002864697459') ,
                    "name"=>array("趙振廷","黃省喬", "余鎧企","吳品頤"));
?>
<div class="container mt-3">
  <div class="row">
    <div class="col-12">
      <div class="collapse" id="aboutUs">
        <div class="card border-info card-body my-3">
          <h2 class="text-center text-info">製作團隊</h2>
          <div class="row">
            <?php
              for ($i=0; $i < 4 ; $i++) {
                echo '<div class="col-6 col-lg text-center my-3">';
                echo '<img class="img-fluid rounded-circle" style="width:2rem" src="https://graph.facebook.com/'. $authorList['FBID'][$i] .'/picture">
                <span class="ml-1">'.$authorList['name'][$i].'</span>';
                echo '</div>';
              }
            ?>
          </div>
        </div>
      </div>
      <small>
        <button class="d-none" type="button" id="aboutUsSwitchHidden" data-toggle="collapse" data-target="#aboutUs" >
        </button>
        <p class="text-muted text-center">© Copyright <span id="aboutUsSwitch">BOSS</span> 2017 - <?php echo date('Y',time()); ?></p>
      </small>
    </div>
  </div>
</div>
