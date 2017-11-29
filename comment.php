<?php
  $sqlnone = 'SELECT COUNT(*) COUNT_NUM FROM Comment
  WHERE PID='.$_GET['ID'];
  $comment_num=mysqli_fetch_array($conn->query($sqlnone))['COUNT_NUM'];
?>
<h6>商品評論 (<?php echo $comment_num; ?>)</h6>
<div class="list-group ">
  <?php

  if($comment_num==0)
  echo '<a href="#" class="list-group-item list-group-item-action flex-column">
  <i class="text-muted">目前尚無評論</i>
  </a>';
  $sql = 'SELECT * FROM COMMENT
          INNER JOIN MEMBER ON MEMBER.ID = COMMENT.CID
          WHERE Comment.PID=' . $_GET['ID'];
  $result = $conn->query($sql);

  // 印出評論
  while($rows=mysqli_fetch_array($result)){
    $CID=$rows['CID'];
    $CName=$rows['Name'];
    $Date=$rows['Date'];
    $Comment=$rows['Comment'];
    $Star=$rows['Star'];
    $Position=$rows['Position'];
    $comment_by_me=($CID==$user_id)?'list-group-item-secondary':'';
    if($Position=='A') $comment_color= 'text-danger';
    else if($Position=='S') $comment_color= 'text-warning';
    else $comment_color='';
    $star_text='<span class="badge badge-light star mx-2">
                  <i class="material-icons">star</i>'. $Star .'
                </span>';
    echo '<a href="#" class="list-group-item list-group-item-action flex-column '. $comment_by_me .'">
            <div class="d-flex w-100 justify-content-between">
              <h6 class="mb-2 '. $comment_color . '">
              <i class="material-icons">account_circle</i> '. $CName .' <span class="text-muted">('. $CID .')</span>' . $star_text .'</h6>
              <small>'. $Date .'</small>
            </div>
            <p class="mb-0">'. $Comment .'</p>
          </a>';
  }
  ?>
</div>
<form class="row mt-3 <?php if($user_position == 'G') echo'd-none' ?>" action="comment_post.php" method="post" >
  <div class="col-auto">
    <span class="badge badge-info"><?php echo $user_id ?></span>
  </div>
  <div class="col">
    <div class="row">
      <div class="col-12 ">
        <input type="text" name="Comment" class="form-control form-control-sm"  placeholder="輸入對此商品的評論..." <?php if($user_position == 'G') echo'disabled' ;?> required>
      </div>
      <div class="col-12 my-2 <?php if($user_position == 'G') echo'd-none' ?> ">
        <span class="badge badge-pill badge-warning mr-2"><i class="material-icons" style="font-size:1rem;">star</i> 評分</span>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Star" id="inlineRadio5" value="5" checked>5
          </label>
        </div>
        <?php
          for ($i=4; $i > 0 ; $i--) {
            echo '<div class="form-check form-check-inline">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="Star" id="inlineRadio'.$i.'" value="'.$i.'" >'. $i .'
                     </label>
                  </div>';
          }
        ?>
      </div>
    </div>
  </div>
  <div class="col-3 col-lg-2">
    <button type="submit" class="btn btn-primary btn-block btn-sm "<?php if($user_position == 'G') echo'disabled' ;?>>發表</button>
  </div>

  <div class="form-group d-none">
    <input type="text" name="PID" value="<?php echo $_GET['ID']?>" placeholder="" >
  </div>
</form>
