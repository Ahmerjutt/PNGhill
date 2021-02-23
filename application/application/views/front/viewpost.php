<?php $value = $post->result()[0]; ?> 
<?php $Info = json_decode($value->fdata);?>
<?php $controller =& get_instance();?>
<?php 
$ex = explode(',',$cats);
$this->load->model('checks');
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
<!-- Breadcrumbs -->
<section class="containerp breadcrums">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col s12">
            <a href="<?=base_url()?>" class="breadcrumb black_tp">Home</a>
            <?php if ($ex != ''): ?>
              <?php foreach ($ex as $key => $ce): ?>
                <?php if ($ce != ''): ?>
                  <?php if ($this->checks->Fetch('categories',array('CID'=>$ce),'ID')->num_rows() > 0 ): ?>
                    <?php $res = $this->checks->Fetch('categories',array('CID'=>$ce),'ID')->result()[0] ?>
                    <a href="<?=base_url() .'c/'.$res->cslug?>" class="breadcrumb black_tp"><?=$res->cname?></a>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
            <a href="<?=$value->slug?>" class="breadcrumb black_tp"><?=$value->title?></a>
        </div>
    </div>
</section>
<!-- View Post -->
<section class="containerp">
    <div class="row">
        <div class="col s12 m7 l8">
            <div class="mainView white">
                <div class="pngheading">
                    <p style="margin: 0px;"><?=$value->title?> <span style="color: #b5b0b0;">Free <?=strtoupper(ltrim($Info->file_ext, '.'))?> <?=($value->workWith == '')?'':'and '.strtoupper($value->workWith)?></span> </p>
                </div>
                <div class="mainImage" style="background: #F5F5F5;position:relative;overflow:hidden">
                    <div class="overlayee" style="background:url('/assets/pnghillmark.png')"></div>
                    <img src="<?='.'.$value->image_path?>" alt="<?=$value->title?>">
                </div>
                <div class="mainFooter"><br>
                  <?php if ($value->tags != ''): ?>
                    <blockquote class="headfp">Tags</blockquote>
                    <div class="tags" style="padding:0px;overflow:auto;max-height:120px"><p style="margin:0px;">
                      <?php $variable = explode(',',$value->tags) ?>
                      <?php foreach ($variable as $key => $tag): ?>
                        <a href="<?=base_url('search?q='). $tag?>" class="hover-effect"><?=$tag?></a>
                      <?php endforeach; ?></p>
                    </div>  
                  <?php endif; ?>
                  <?php if ($value->description != ''): ?>
                    <blockquote class="headfp">Tags</blockquote>
                    <div class="ones aboutImage">
                        <span><?=$value->description?></span>
                    </div>
                  <?php endif; ?>
                    <blockquote class="headfp">Share Link</blockquote>
                    <div class="ones aboutImage">
                        <textarea style="height: 31px;overflow: auto;"
                            class="embedcode"><?=base_url('freepng/'.$value->slug)?></textarea>
                    </div>
                    <blockquote class="headfp">Embed</blockquote>
                    <div class="ones aboutImage">
                        <textarea class="embedcode"><a href="<?=base_url('freepng/'.$value->slug)?>" target="_blank"><img src="<?=base_url(ltrim($value->image_path,'.'))?>" alt="<?=$value->title?>" style="max-width:400px;width:100%"/></a></textarea>
                    </div><br>
                </div>
            </div>
        </div>
        <div class="col s12 m5 l4">
            <div class="mainDownlaod">
              <?php $pi = pathinfo($value->image_path) ?>
              <?php $zi = pathinfo($value->dlink_zip) ?>
                <div class="downbtns">
                    <a target="_blank" href="<?=base_url('download?go='.$pngcode.'&slt='.$value->slug.'&ct='.$value->category.'&t='.time().'_'.$value->ID.'&pre='.$pi['filename'].'&ex='.$pi['extension'].'&dx='.$pi['extension'].'&tt='.$value->title)?>" class="waves-effect waves-brown btn lightbtn"><i class="material-icons left">cloud_download</i>Download <?=ltrim($Info->file_ext, '.')?></a>
                </div>
                <?php if ($value->dlink_zip != ''): ?>
                  <?php if ($controller->isUser()): ?>
                    <div class="downbtns">
                        <a target="_blank" href="<?=base_url('download?go='.$zipcode.'&slt='.$value->slug.'&ct='.$value->category.'&t='.time().'_'.$value->ID.'&pre='.$pi['filename'].'&ex='.$zi['extension'].'&dx='.$pi['extension'].'&tt='.$value->title)?>" class="waves-effect waves-teal btn lightbtn lbbtn"><i class="material-icons left">cloud_download</i>Download <?=$value->workWith?></a>
                    </div>
                  <?php else: ?>
                    <div class="downbtns">
                        <a href="#login" class="waves-effect waves-teal btn lightbtn lbbtn modal-trigger"><i class="material-icons left">cloud_download</i>Download <?=$value->workWith?></a>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="viewsCenter">
                <div class="extras">
                    <div class="flex">
                        <div class="ssh">
                            <p class="flex"><?=$Info->image_width .'*'. $Info->image_height?></p>
                        </div>
                        <div class="ssh">
                            <p class="flex"><i class="material-icons">get_app</i><?=$value->downloads?></p>
                        </div>
                        <div class="ssh">
                            <p class="flex"><i class="material-icons">visibility</i><?=$value->views?></p>
                        </div>
                        <div class="ssh" style="text-align:right;margin-right:5px;">
                            <a href="#modal1"class="btn-floating shrw btn-large waves-effect waves-light blue modal-trigger btn-small"><i class="material-icons">share</i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ImageInfo">
                <div class="collection">
                    <a href="#!" class="collection-item"><span class="badge"><?=byte_format($value->image_size);?></span>File Size: </a>
                    <a href="#!" class="collection-item"><span class="badge">Personal Use</span>License: </a>
                    <a href="#!" class="collection-item"><span class="badge uppercase"><?=ltrim($Info->file_ext, '.')?></span>File Format: </a>
                    <a href="#!" class="collection-item"><span class="badge"><?=$value->workWith?></span>Work With: </a>
                    <a href="#!" class="collection-item"><span class="badge"><?=$value->date?></span>Created: </a>
                </div>
            </div>
            <div class="youMayAlsoLike">
              <strong>Recently Uploaded</strong>
                <div class="row">
                    <?php foreach ($recent->result() as $key => $value): ?>
                      <div class="col s4 ymal"><a href="<?=base_url('freepng/'.$value->slug)?>"><img class="recc" src="<?='.'.$value->image_path?>" alt=""></a></div>
                    <?php endforeach; ?>
                </div>
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
        <div class="img-show" style="min-height:200px;height:auto;height: auto;	background: url(../assets/imgshow_bg.png) repeat">
          <a href="<?=base_url('freepng/'.$value->slug)?>"
            class="img-part">
            <img class="lazy2"
              src="<?='.'.$value->image_path?>"
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
            <a href="<?=$value->slug?>" style="text-transform:capitalize" class="truncate"><?=$value->title?></a></h3>
          <div class="pic-info clearfix">
            <p class="info-title fl" style="margin: 0px;padding: 0px;"><?=$Info->image_width .'*'. $Info->image_height?></p>
            <div class="download-info fr">
              <p class="fl download-info-p">
                <img src="../assets/icon-see.png" style="width:16px; height: 16px;">
                <span><?=$value->views?></span>
              </p>
              <p class="fl download-info-p">
                <img src="../assets/icon-pctdown.png" style="width:16px; height: 16px;">
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
<div style="clear:both;height:20px"></div>
<!-- Bottom Model Sharing -->
<section class="bottom popup">

    <!-- Modal Structure -->
    <div id="modal1" class="modal bottom-sheet">
        <div class="modal-content">

            <div id="share-buttons">

                <!-- Facebook -->
                <a href="http://www.facebook.com/sharer.php?u=https://materializecss.com" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                </a>

                <!-- Twitter -->
                <a href="https://twitter.com/share?url=https://materializecss.com&amp;text=Materialize%20Framework&amp;hashtags=css"
                    target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                </a>

                <!-- Google+ -->
                <a href="https://plus.google.com/share?url=https://materializecss.com" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
                </a>

                <!-- Pinterest -->
                <a
                    href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                    <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
                </a>

                <!-- LinkedIn -->
                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https://materializecss.com"
                    target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
                </a>

                <!-- Buffer -->
                <a href="https://bufferapp.com/add?url=https://materializecss.com&amp;text=Simple Share Buttons"
                    target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/buffer.png" alt="Buffer" />
                </a>

                <!-- Digg -->
                <a href="http://www.digg.com/submit?url=https://materializecss.com" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/diggit.png" alt="Digg" />
                </a>

                <!-- Email -->
                <a
                    href="mailto:?Subject=Simple Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 https://materializecss.com">
                    <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
                </a>

                <!-- Print -->
                <a href="javascript:;" onclick="window.print()">
                    <img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />
                </a>

                <!-- Reddit -->
                <a href="http://reddit.com/submit?url=https://materializecss.com&amp;title=Materialize Framework"
                    target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
                </a>

                <!-- StumbleUpon-->
                <a href="http://www.stumbleupon.com/submit?url=https://materializecss.com&amp;title=Materialize Framework"
                    target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/stumbleupon.png" alt="StumbleUpon" />
                </a>

                <!-- Tumblr-->
                <a href="http://www.tumblr.com/share/link?url=https://materializecss.com&amp;title=Materialize Framework"
                    target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/tumblr.png" alt="Tumblr" />
                </a>

                <!-- VK -->
                <a href="http://vkontakte.ru/share.php?url=https://materializecss.com" target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/vk.png" alt="VK" />
                </a>

                <!-- Yummly -->
                <a href="http://www.yummly.com/urb/verify?url=https://materializecss.com&amp;title=Materialize Framework"
                    target="_blank">
                    <img src="https://simplesharebuttons.com/images/somacro/yummly.png" alt="Yummly" />
                </a>

            </div>


        </div>
    </div>    
</section>
