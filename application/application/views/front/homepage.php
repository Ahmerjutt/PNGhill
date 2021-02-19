<!-- header -->
<header class="headerbg" style="background:url('assets/header.png')">
  <div class="container">
    <div class="headc">
      <div style="height:80px;"></div>
      <h1 class="center-align">Millions of free Graphics with source</h1>
      <p class="center-align">Royalty Free PNG Images, Vectors, Backgrounds, Templates, Text Effect</p>
      <form action="<?=base_url('search')?>" method="GET">
        <div class="flex searchform">
          <div class="item">
            <select>
              <option value="">PNG Images</option>
              <option value="1">backgrounds</option>
              <option value="2">illustrations</option>
              <option value="3">Vectors</option>
              <option value="3">Templates</option>
            </select>
          </div>
          <div class="item searchbox" style="width:100%">
            <input placeholder="Search PNG Images" name="q" type="text" class="browser-default">
            <i class="material-icons">search</i>
            <button type="submit" hidden></button>
          </div>
        </div>
      </form>
      <div class="tags">
        <a href="<?=base_url('search?q=New Year')?>" class="hover-effect">New Year</a>
        <a href="<?=base_url('search?q=Valentines Day')?>" class="hover-effect">Valentines Day</a>
        <a href="<?=base_url('search?q=Love')?>" class="hover-effect">Love</a>
        <a href="<?=base_url('search?q=Heart')?>" class="hover-effect">Heart</a>
        <a href="<?=base_url('search?q=Png')?>" class="hover-effect">PNG</a>
      </div>
    </div>
  </div>
</header>
<div class="clearfix img-list-box  png_tag_list" id="masList">
<?php foreach ($posts->result() as $key => $value): ?>
  <?php $Info = json_decode($value->fdata);?>
  <div class="list-item img-list">
    <div class="img-list-pd">
      <div class="img-show" style="min-height:200px;height: auto;background:url(./assets/imgshow_bg.png) repeat">
        <a href="<?=base_url('freepng/'.$value->slug)?>"class="img-part">
          <img class="lazy2 imgmain" src="<?=$value->image_path?>" data-original="<?=$value->image_path?>">
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
          <a href="<?=base_url('freepng/'.$value->slug)?>" style="text-transform:capitalize"><?=$value->title?></a></h3>
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
<div style="height:20px;"></div>
<div class="pg"><?=$pagination ?></div>
<div style="height:20px;"></div>












