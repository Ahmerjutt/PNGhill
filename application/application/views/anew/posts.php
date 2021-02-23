<main>
   <div class="grid grid-cols-1 gap-4 p-4">
     <?php foreach ($posts->result() as $key => $post): ?>
         <div class="p-4 text-center bg-white rounded-md dark:bg-darker shadow hover:shadow-lg" id="viewp" post-id="<?=$post->ID?>" xs-data="<?=$post->ID?>" onclick="editpost(<?=$post->ID?>)">
           <div class="overflow-hidden flex justify-between">
              <div class="flex">
                <a href="#"> 
                  <img alt="Placeholder" class="block" style="height:64px;width:72px;object-fit:cover;border-radius: 9px;" src="../<?=$post->image_path?>"> 
                </a> 
                <header class="leading-tight p-2 md:p-4 align-middle">
                   <h1 class="text-lg text-left" x-data="<?=$post->ID?>" id="blockonhover"> <a class="no-underline hover:underline text-black fontt text-gray-600 m-0 dark:text-light" target="_blank" href="<?=base_url('freepng/'.$post->slug)?>"><?=$post->title?></a> </h1>
                   <p class="text-gray-400 text-sm text-left fontt dark:text-light-400" style="text-align:left">Published • <?=$post->date?>
                     <?php $ex = explode(',',$post->category); ?>
                     <?php if ($ex != ''): ?>
                       <?php foreach ($ex as $key => $ce): ?>
                         <?php if ($ce != ''): ?>
                           <?php if ($this->checks->Fetch('categories',array('CID'=>$ce),'ID')->num_rows() > 0 ): ?>
                             <?php $res = $this->checks->Fetch('categories',array('CID'=>$ce),'ID')->result()[0] ?>
                             <a href="<?=base_url() .'c/'.$res->cslug?>"><span style="margin-left:10px" class="text-sm font-medium bg-green-100 py-0.5 px-2 rounded text-green-500 align-middle"><?=$res->cname?></span></a>
                           <?php endif; ?>
                         <?php endif; ?>
                       <?php endforeach; ?>
                     <?php endif; ?>
                   </p>
                </header>
              </div>
              <div class="">
                <footer class="items-right leading-none p-2 mt-1 md:p-4 text-right">
                   <a class="flex items-right no-underline hover:underline text-black text-right" href="#">
                      <img alt="Placeholder" class="block rounded-full w-5" src="<?=$post->u_img?>"> 
                      <p class="ml-2 mt-0.5 text-gray bold text-gray-600 dark:text-light text-right"> <?=$post->u_name?></p>
                   </a>
                   <div class="flex items-center mt-2 no-underline text-gray-400 hover:text-red-dark justify-between text-right block float-right" href="#"> 
                     <span class="text-gray-400 text-sm mr-2 mt-0.5 fontt dark:text-light-400"><?=$post->views?></span>
                     <span class="block"><svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"> <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" /> </svg> </span>
                     <span><a id="dpost" did="<?=$post->ID?>" x-data="<?=$post->ID?>" class="flex items-center ml-2"><span style="margin-left:3px" class="text-sm font-medium bg-red-100 py-0 px-2 rounded text-red-500 align-middle cursor-pointer hover:bg-red-200">Delete</span></a></span>
                   </div> 
                </footer>
              </div>
           </div>
         </div>
       <?php endforeach; ?>
   </div>
</main>
<script type="text/javascript">
  function editpost(id) {
    var url = "<?=base_url('admin-panel/edit?action=post&task=edit&id=')?>" + id;
    window.location.replace(url);
  }
</script>