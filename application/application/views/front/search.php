<?php $controller =& get_instance();?>
<!-- Searchbar -->
<section class="containerp fwsearch">
   <form action="<?=base_url('search')?>" method="GET">
      <div class="flex searchform" style="height: 43px;margin:20px auto">
         <div class="item">
            <select name="in">
               <option value="0">PNG Images</option>
               <option value="1">backgrounds</option>
               <option value="2">illustrations</option>
               <option value="3">Vectors</option>
               <option value="3">Templates</option>
            </select>
         </div>
         <div class="item searchbox srcht" style="width:100%">
            <input name="q" placeholder="Search PNG Images" style="padding:13px 10px;" type="text" class="browser-default" value="<?=$_GET['q']?>">
            <i class="material-icons" style="font-size: 32px;">search</i>
            <button type="submit" hidden></button>
         </div>
      </div>
   </form>
</section>
<section>
  <div class="clearfix img-list-box  png_tag_list" id="masList">
  <?php foreach ($posts->result() as $key => $value): ?>
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
<div style="height:20px;"></div>
<div class="pg"><?=$pagination ?></div>
<div style="height:20px;"></div>
