<?php
  $slogan_list= array( "img"=>array("https://c.pxhere.com/photos/c7/d2/cocktail_drink_refreshment_glass_delicious_pool_summer-1238441.jpg!d",
                                  "https://c.pxhere.com/photos/61/ff/da_hong_pao_chinese_tea_traditional-735282.jpg!d") ,
                  "slogan"=>array("飲涼卡好。","回甘就像現泡。"),
                  "slogan_color"=>array("dark","light"),
                  "slogan_shadow_color"=>array("light","dark"),
                  "auther"=>array("徐志摩","北科茶裏王"));
  $rand_index=rand(0,1); // 隨機挑選slogan
  $bg_url= $slogan_list['img'][$rand_index];
  $slogan= $slogan_list['slogan'][$rand_index];
  $slogan_color= $slogan_list['slogan_color'][$rand_index];
  $slogan_shadow_color= $slogan_list['slogan_shadow_color'][$rand_index];
  $auther= $slogan_list['auther'][$rand_index];
?>

<div class="jumbotron-fluid text-center bg-dark <?php echo 'text-'.$slogan_color ?>" style="background:url('<?php echo $bg_url ?>');background-size: cover; background-position:center center; background-attachment:fixed;">
  <div class="container" style="padding:10rem 0;">
    <blockquote class="blockquote">
      <h4 class="<?php echo 'text-shadow-'.$slogan_shadow_color ?>" style="opacity: .9"><?php echo $slogan ?></h4>
      <footer class="blockquote-footer text-shadow-dark"><?php echo $auther ?></footer>
    </blockquote>
  </div>
</div>
