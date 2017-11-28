
<?php
$bg_url='https://c.pxhere.com/photos/66/ad/dark_fireworks_hands_lights_macro_sparklers_sparks-1177911.jpg!d';
$slogan=array('喝啦!','飲落去!','Drink It!','飲もう!', '마쎠!');

?>
<div class="jumbotron-fluid text-center bg-dark <?php echo 'text-'.$slogan_color ?>" style="background:url('<?php echo $bg_url ?>');background-size: cover; background-position:center center; background-attachment:fixed;">
  <div class="container" style="padding:10rem 0;">
  <h1 class="display-2 text-light"><strong><?php echo $slogan[rand(0,sizeof($slogan)-1)]; ?></strong></h1>
  </div>
</div>
