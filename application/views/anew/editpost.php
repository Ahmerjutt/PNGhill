<?php
function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 
    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 
?>
<?php $value = $post->result()[0];
$ww = explode(',',$value->workWith);?>
<main>
  <!-- State cards --> 
  <div class="flex justify-between mx-0 p-4">
    <div class="flex w-full">
        <input id="d_link" value="<?=$value->dlink_zip?>" placeholder="zip file url" class="w-full rounded shadow p-2 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
        <button id="zipbtn" type="submit" style="width:200px;" class="mr-2 bg-blue-500 text-blue-200 text-base font-semibold tracking-wide uppercase p-1 px-3 rounded shadow hover:bg-indigo-light">Upload Zip</button>
    </div>
    <div class="flex w-full">
        <input id="title" value="<?=$value->title?>" type="text" placeholder="Post Title" class="w-full rounded shadow p-2 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
        <button id="Update" did="<?=$value->ID?>" type="submit" class="flex items-center mr-2 bg-primary text-white text-base font-semibold tracking-wide uppercase p-1 px-7 rounded shadow hover:bg-indigo-light">Update</button>
    </div>
  </div>
  <div class="flex w-full mx-0 p-4">
    <input id="tagss" value="<?=$value->tags?>" placeholder="post tags" class="w-full rounded shadow p-2 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
  </div>
  <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-3 xl:grid-cols-3">
     <!-- Value card --> 
     <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
        <label for="imgee">
         <div>
            <img id="prevImage" src="<?=base_url(ltrim($value->image_path, '.'))?>" alt="" class="prev w-full h-64 object-contain" style="height:200px">
         </div>
        </label>
        <input type="file" id="imgee" hidden did="<?=$value->ID?>" x24="<?=$value->image_path?>" orignal="<?=$value->dlink_image?>">
     </div>
     <!-- Users card --> 
     <div class="p-4 bg-white rounded-md dark:bg-darker overflow-auto box-border px-10" style="height:270px">
         <h1 class="text-xl font-semibold">Category</h1>
         <?php $c = explode(',',$value->category) ?>
         <?php foreach ($cats->result() as $key => $category): ?>
           <label class="inline-flex items-center mt-3 w-full box-border" id="category">
                 <input type="checkbox" value="<?=$category->CID?>" class="form-checkbox h-5 w-5 text-gray-600 dark:text-light" <?=in_array($category->CID,$c)?'checked':''?>>
                 <span class="ml-2 text-gray-700"><?=$category->cname?></span>
           </label>
         <?php endforeach; ?>
     </div>
     <!-- Orders card --> 
     <div class="p-4 bg-white rounded-md dark:bg-darker overflow-auto box-border px-10" style="height:270px">
         <h1 class="text-xl font-semibold">Work With</h1>
         <label class="inline-flex items-center mt-3 w-full box-border" id="workWith">
               <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="EPS" <?=in_array('EPS',$ww)?'checked':''?>><span class="ml-2 text-gray-700">EPS</span>
         </label>
         <label class="inline-flex items-center mt-3 w-full box-border" id="workWith">
               <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="AI" <?=in_array('AI',$ww)?'checked':''?>><span class="ml-2 text-gray-700">AI</span>
         </label>
         <label class="inline-flex items-center mt-3 w-full box-border" id="workWith">
               <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="PSD" <?=in_array('PSD',$ww)?'checked':''?>><span class="ml-2 text-gray-700">PSD</span>
         </label>
         <label class="inline-flex items-center mt-3 w-full box-border" id="workWith">
               <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="SVG" <?=in_array('SVG',$ww)?'checked':''?>><span class="ml-2 text-gray-700">SVG</span>
         </label>
     </div>
  </div>
  <div class="mx-0 p-4">
      <div class="w-full mr-6 mb-5"><input value="<?=$value->mTitle?>" id="mTitle" placeholder="Meta Title" class="w-full rounded shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker"></div>
      <div class="w-full mr-6 mb-5"><input value="<?=$value->mDesc?>" id="mDesc" placeholder="Meta Desc" class="w-full rounded shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker"></div>
      <div class="w-full mr-6 mb-5"><input value="<?=$value->mTags?>" id="mTags" placeholder="Meta Tags" class="w-full rounded shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker"></div>
  </div>
  <div class="flex justify-between mx-1 p-4">
    <p class="text-gray-400 text-sm text-left fontt dark:text-light-400" style="text-align:left"><?=$value->date?></p>
    <p class="text-gray-400 text-sm text-left fontt dark:text-light-400" style="text-align:left">Views • <?=$value->views?></p>
    <p class="text-gray-400 text-sm text-left fontt dark:text-light-400" style="text-align:left">Downlaods • <?=$value->downloads?></p>
    <p class="text-gray-400 text-sm text-left fontt dark:text-light-400" style="text-align:left">Size • <?=formatBytes($value->image_size);?></p>
    <p class="text-gray-400 text-sm text-left fontt dark:text-light-400" style="text-align:left"> <a target="_blank" href="<?=base_url($value->dlink_image)?>">Original Image</a> </p>
    <p class="text-gray-400 text-sm text-left fontt dark:text-light-400" style="text-align:left"><a target="_blank" href="<?=$value->post_clink?>">Source</a> </p>
    <p class="text-gray-400 text-sm text-left fontt dark:text-light-400" style="text-align:left"><a target="_blank" href="<?=base_url('freepng/'.$value->slug)?>">View Post</a> </p>
  </div>
</main>