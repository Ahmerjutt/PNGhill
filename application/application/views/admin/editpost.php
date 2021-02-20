<?php 
if ($post->num_rows() == 0) {
  redirect(base_url('admin-panel/posts'));
}
   $chain =array();
   foreach ($cats->result() as $key => $value) {
     if($value->parent != ''){
       array_push($chain,$value->parent);
     }
   }
   $parents = array_unique($chain);
   if ($post->result() > 1) {
     $epost = $post->result()[0];
   }else{
     $epost = '';
   }
   ?>
<main>
   <div id="test"></div>
   <h3 class="center-align">Edit Post <a href="<?=base_url('freepng/'.$epost->slug)?>">View Post</a> </h3>
   <div class="container z-depth-1 white" style="width:95%">
      <div class="row">
         <div class="col s8">
            <div class="input-field col s12">
               <input id="title" type="text" class="validate" placeholder="Post Title" value="<?=$epost->title?>">
            </div>
            <div class="col s6" style="overflow:hidden">
               <input type="file" id="imgee" hidden did="<?=$epost->ID?>" x24="<?=$epost->image_path?>" orignal="<?=$epost->dlink_image?>">
               <label for="imgee">
               <div class="uprev">
                  <img src="<?=base_url(ltrim($epost->image_path, '.'))?>" id="prevImage" alt="" style="width:100%">
                  <i class="material-icons white-text">insert_photo</i>                  
               </div>
               </label>
            </div>
            <div class="left-align cats col s6" id="category" style="height:300px;">
               <?php foreach ($parents as $key => $value): ?>
               <?php $this->db->where('parent',$value); ?>
               <?php $data = $this->db->get('categories'); ?>
               <?php $this->db->where('CID',$value); ?>
               <?php $main = $this->db->get('categories')->result(); ?>
               <?php $EditID = $main[0]->CID?>
               <?php $ViewSlug = $main[0]->cslug?>
               <p>
                  <label>
                  <input type="checkbox" value="<?=$EditID?>" class="filled-in" <?=($EditID == $epost->category)?'checked':''?>/><span><?=$main[0]->cname?></span>
                  </label>
               </p>
               <?php foreach ($data->result() as $keye => $child): ?>
               <?php $EditID = $child->CID?>
               <?php $ViewSlug = $child->cslug?>
               <p>
                  <label>
                  <i class="material-icons" style="font-size:19px;position:relative;top:0px;">subdirectory_arrow_right</i> <input type="checkbox" value="<?=$EditID?>" class="filled-in"/><span><?=$child->cname?></span>
                  </label>
               </p>
               <?php endforeach; ?>
               <?php endforeach; ?> 
               <?php foreach ($singlec->result() as $key => $value): ?>
               <?php if ($value->parent == ''): ?>
               <?php $EditID = $value->CID?>
               <?php $ViewSlug = $value->cslug?>
               <p>
                  <label>
                  <input type="checkbox" value="<?=$EditID?>" class="filled-in" <?=($EditID == $epost->category)?'checked':''?>/><span><?=$value->cname?></span>
                  </label>
               </p>
               <?php endif; ?>
               <?php endforeach; ?>      
            </div>
            <div class="input-field col s12">
              <textarea id="about" class="materialize-textarea"><?=$epost->description?></textarea>
              <label for="about">About Image</label>
            </div>
            <div class="input-field col s12">
               <input id="mTitle" type="text" placeholder="Meta Title" value="<?=$epost->mTitle?>">
            </div>
            <div class="input-field col s12">
               <input id="mDesc" type="text" placeholder="Meta Desc" value="<?=$epost->mDesc?>">
            </div>
            <div class="input-field col s12">
               <input id="mTags" type="text" placeholder="Meta Tags" value="<?=$epost->mTags?>">
            </div>            
         </div>
         <div class="col s4 center-align">
            <div class="input-field col s12">
               <p id="d_link" style="overflow:auto">
                 <?=base_url()?><span><?=$epost->dlink_zip?></span>
               </p><br>
               <!-- Modal Trigger -->
               <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Change Zip</a>
               <br><br>  
               <!-- Modal Structure -->
               <div id="modal1" class="modal">
                  <div class="modal-content">
                     <form id='changezip'>
                       <span id="dataup" did="<?=$epost->ID?>" zip="<?=$epost->dlink_zip?>"></span>
                        <label style="display: block;">
                           <div class="success"></div>
                           <img id="uploadimage2" src="<?=base_url('assets/uploadicon.png')?>" style="
                              height: 100px;
                              cursor: pointer;
                              object-fit: cover;
                              object-position: center top;
                              padding: 6px;
                              border-radius: 13xp;
                              border: 1px solid;
                              border-radius: 6px;
                              margin: 11px;">
                           <input type="file" name="filename" style="display: none;" id="uploadimage_src">
                        </label>
                        <div class="container w-50 mx-auto" id="progress" style="display: none;">
                           <div class="progress blue lighten-4 tooltipped" data-position="top" data-tooltip="Progress was at 50% when tested" style="height:20px">
                              <span>Progress</span>
                              <div class="determinate blue progress-bar" style="width: 0%; animation: grow 2s;">0%</div>
                           </div>
                        </div>
                        <div class="form-group">
                           <input type="submit" did="<?=$epost->ID?>" value="Upload" class="btn btn-primary">
                        </div>
                     </form>
                  </div>
                  <div class="modal-footer">
                     <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
                  </div>
               </div>
            </div>
            <a href="#" did="<?=$epost->ID?>" class="btn waves-effect" style="margin-bottom:20px;" id="Update" did="<?=$epost->ID?>">Update</a>
            <a id="dpost" did="<?=$epost->ID?>" class="btn waves-effect red darken-1" style="margin-bottom:20px;" id="Draft">Delete</a>
            <div class="left-align cats col s12" id="workWith">
               <label>
               <input type="checkbox" value="EPS" class="filled-in" <?=($epost->workWith == 'EPS')?'checked':''?>/><span>EPS</span>
               </label><br>
               <label>
               <input type="checkbox" value="AI" class="filled-in" <?=($epost->workWith == 'AI')?'checked':''?>/>
               <span>AI</span>
               </label><br>
               <label>
               <input type="checkbox" value="PSD" class="filled-in" <?=($epost->workWith == 'PSD')?'checked':''?>/><span>PSD</span>
               </label><br>
               <label>
               <input type="checkbox" value="SVG" class="filled-in" <?=($epost->workWith == 'SVG')?'checked':''?>/>
               <span>SVG</span>
               </label><br>          
            </div>
            <div class="col s12" style="margin-top:20px;">
               <div class="chips chdata">
                 <?php if ($epost->tags != ''): ?>
                   <?php $tag = explode(',',$epost->tags); ?>
                   <?php foreach ($tag as $key => $value): ?>
                     <div class="chip" tabindex=""><?=$value?><i class="material-icons close">close</i></div>
                   <?php endforeach; ?>
                 <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>