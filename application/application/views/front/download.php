<?php $controller =& get_instance();?>
<?php
  $ex = explode('_', $_GET['t'])[0];
  if (time() - $ex > 7200) {
      $Expire = FALSE;
  }elseif($_GET['ex'] == 'zip'){
      if ($controller->isUser() == FALSE) {
        $Expire = FALSE;
      }else{
        $Expire = TRUE;
      }
  }else{
      $Expire = TRUE;
  }
 ?>
<!-- Searchbar -->
<section class="containerp fwsearch">
    <form action="<?=base_url('search')?>" method="GET">
        <div class="flex searchform" style="height: 43px;margin:20px auto">
            <div class="item">
                <select name="in">
                    <option value="">PNG Images</option>
                    <option value="1">backgrounds</option>
                    <option value="2">illustrations</option>
                    <option value="3">Vectors</option>
                    <option value="3">Templates</option>
                </select>
            </div>
            <div class="item searchbox srcht" style="width:100%">
                <input name="q" placeholder="Search PNG Images" style="padding:13px 10px;" type="text" class="browser-default">
                <i class="material-icons" style="font-size: 32px;">search</i>
                <button type="submit" hidden ></button>
            </div>
        </div>
    </form>
</section>

<section class="containerp deeman">
   <div class="row" style="padding:20px">
      <div class="col s12 m5 l4 center-align">
        <span class="maincc">
          <img class="prevdimg" src="<?=base_url('uploads/x24/'.$_GET['pre'] .'.'. $_GET['dx'])?>" alt="">
        </span>
      </div>
      <div class="col s12 m7 l8 center-align">
         <div class="ttdd">
           <?php if ($Expire == TRUE): ?>
             <?php $tsec = rand(5,15); ?>
             <p>Your download will start in <span id="countdown" class="chere"><?$tsec?></span> seconds.</p>
             <p>If your download doesn't start automatically please <a href="#" class="chere" onclick="deedoo()">click here</a> .</p>
           <?php else: ?>
             <p>this link has been expired <a href="<?=base_url('freepng/'.$_GET['slt'])?>">try again</a></p>
             <p>every link has been automatically expired in 2 hours</p>
           <?php endif; ?>
         </div>
      </div>
   </div>
</section>
<section>
  <div class="clearfix img-list-box  png_tag_list" id="masList">
  <?php foreach ($Related->result() as $key => $value): ?>
    <?php $Info = json_decode($value->fdata);?>
    <div class="list-item img-list">
      <div class="img-list-pd">
        <div class="img-show" style="height: auto;	background: url(./assets/imgshow_bg.png) repeat">
          <a href="<?=base_url('freepng/'.$value->slug)?>"
            class="img-part">
            <img class="lazy2"
              src="<?='./'.$value->image_path?>"
              data-original="<?='.'.$value->image_path?>">
            <div class="img-bg"></div>
          </a>
          <div class="img-btn-box flex">
            <?php if ($value->workWith != ''): ?>
              <a href="<?=base_url('freepng/'.$value->slug)?>"
              style="background: #707070;"><span><?=$value->workWith?></span></a>
            <?php endif; ?>
            <a href="<?=base_url('freepng/'.$value->slug)?>"
              style="background: #11ACEF;"><span class="uppercase"><?=ltrim($Info->file_ext, '.')?></span></a>
          </div>
        </div>
        <div class="img-detail">
          <h3 class="img-detail-title">
            <a href="<?=$value->slug?>" style="text-transform:capitalize"><?=$value->title?></a></h3>
          <div class="pic-info clearfix">
            <p class="info-title fl" style="margin: 0px;padding: 0px;"><?=$Info->image_width .'*'. $Info->image_height?></p>
            <div class="download-info fr">
              <p class="fl download-info-p">
                <img src="./assets/icon-see.png" style="width:16px; height: 16px;">
                <span><?=$value->views?></span>
              </p>
              <p class="fl download-info-p">
                <img src="./assets/icon-pctdown.png" style="width:16px; height: 16px;">
                <span><?=$value->downloads?></span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</section>
<?php if ($Expire == TRUE): ?>
  <script>
  var timeleft = <?=$tsec?>;
  var downloadTimer = setInterval(function(){
    if(timeleft <= 0){
      clearInterval(downloadTimer);
      document.getElementById("countdown").innerHTML = ":)";
      deedoo();
    } else {
      document.getElementById("countdown").innerHTML = timeleft;
    }
    timeleft -= 1;
  }, 1000);
  
    // Download uri
    function downloadURI(uri, name){
      var link = document.createElement("a");
      // If you don't know the name or want to use
      // the webserver default set name = ''
      link.setAttribute('download', name);
      link.href = uri;
      document.body.appendChild(link);
      link.click();
      link.remove();
  }
    function deedoo(){
      var name = "www.pnghill.com_" + "<?=$_GET['tt']?>" + ".<?=$_GET['ex']?>";
      downloadURI("<?=$dlink?>",name);
    }
  </script>

<?php endif; ?>











