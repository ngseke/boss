<!-- 放footer的地方 -->
<?php
$authorList= array( "FBID"=>array('100002864697459','100000427402468', "100000221900785",  "100000577680481") ,
"name"=>array("吳品頤", "余鎧企","黃省喬","趙振廷"),
"num"=>array("104590020", "104590025","104590029","104590036"),
"t"=>array("87", "87","帥","87"));
?>
<?php
$FirstDay = date('Y-m-d H:i:s',mktime(11, 43, 58, 11, 14, 2017)); // GIT創建日
$Deadline = date('Y-m-d H:i:s',mktime(00, 00, 00, 01, 02, 2018)); // 死線日
$Today = date('Y-m-d H:i:s');
$FirstDayDiff = floor((strtotime($Today) - strtotime($FirstDay))/3600/24);
$DeadlineDiff = -(floor((strtotime($Today) - strtotime($Deadline))/3600/24));
?>
<div class="container mt-3">
  <div class="row">
    <div class="col-12">
      <small>
        <p class="text-muted text-center">© Copyright <span id="aboutUsSwitch">BOSS</span> 2017 - <?php echo date('Y',time()); ?>
        <?php
          if ($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']== '127.0.0.1'){
            echo '';
          }else {
            echo 'on '.$_SERVER['HTTP_HOST'];
          }
        ?>
        </p>
      </small>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<button type="button" id="aboutUsSwitchHidden" class="btn btn-primary d-none" data-toggle="modal" data-target="#aboutUs">
</button>

<!-- Modal -->
<div class="modal fade" id="aboutUs" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><a class="text-dark" href="http://www.ntut.edu.tw/~cliu/courses/db/db.htm"><i class="material-icons" style="font-size:1.5rem;">storage</i> CSIE4105 Database Systems</a></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 d-none">
              <p class="text-center rounded bg-hover">已開幕第 <?= $FirstDayDiff ?> 天</p>
            </div>
            <div class="col-12">
              <h4 class="text-center mt-3"><em>NTUT-CSIE</em></h4>
            </div>
            <?php
            for ($i=0; $i < 4 ; $i++) {
              // Tooltip
              $tooltip='data-toggle="tooltip" data-placement="bottom" title="'. $authorList['num'][$i]  .'"';
              //
              echo '<div class="col-6 col-lg-3 text-center my-3 rounded bg-hover">';
              echo '<img class="img-fluid rounded-circle" style="width:2rem" '.$tooltip.' src="https://graph.facebook.com/'. $authorList['FBID'][$i] . '/picture">
              <span class="ml-1">
                <a class="text-info" target="_blank" href="https://www.facebook.com/'. $authorList['FBID'][$i]  .'">'. $authorList['name'][$i] .'</a>
              </span>';
              echo '</div>';
            }
            ?>
            <div class="col-12">
              <h4 class="text-center mt-3"><em>指導教授</em></h4>
            </div>
            <div class="col-12 text-center my-3 rounded bg-hover">
              <div class="rounded-circle d-inline-block align-middle" style="width:2rem; height:2rem; background:url(http://www.cc.ntut.edu.tw/~cliu/DSC00288%20cliu.jpg); background-size:contain; background-position:center;"></div>
              <span class="ml-1"><a class="text-info" target="_blank" href="http://www.cc.ntut.edu.tw/~cliu/">Chien-Hung Liu</a></span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<script type="text/javascript">
  $('#aboutUsSwitch').click(function(){
    $("#aboutUsSwitchHidden").trigger("click");
  });
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
