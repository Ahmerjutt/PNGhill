<main>
  <!-- State cards --> 
<div class="flex justify-between mx-0 p-4">
    <div class="flex w-full">
        <input type="text"id="linkww" placeholder="url.." class="w-full rounded shadow p-2 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
        <button type="button" id="checkit" class="flex items-center mr-2 bg-primary text-white text-base font-semibold tracking-wide uppercase p-1 px-4 rounded shadow hover:bg-indigo-light">
        <span>Fetch</span></button>
    </div>
    <div class="flex w-full">
        <input type="text" id="title" placeholder="Post Title" class="w-full rounded shadow p-2 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
        <button type="submit" class="flex items-center mr-2 bg-primary text-white text-base font-semibold tracking-wide uppercase p-1 px-4 rounded shadow hover:bg-indigo-light" id="qPublish">Publish</button>
    </div>
</div>
<div class="flex justify-between mx-0 p-4">
    <div class="flex w-full">
        <input type="text" id="imgeww" placeholder="image url" class="w-full rounded shadow p-2 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
    </div>
    <div class="flex w-full">
        <input id="d_link" type="text" placeholder="zip file url" class="w-full rounded shadow p-2 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
        <button id="zipbtn" type="submit" style="width:250px;" class="mr-2 bg-blue-500 text-blue-200 text-base font-semibold tracking-wide uppercase p-1 px-3 rounded shadow hover:bg-indigo-light" >Zip</button>
        <input type="text" id="tagsw" placeholder="post tags" class="w-full rounded shadow p-2 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
    </div>
</div>
  <div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-3 xl:grid-cols-3">
     <!-- Value card --> 
     <div class="flex items-center justify-between p-4 bg-white rounded-md dark:bg-darker">
        <label for="upid">
         <div>
            <img src="<?=base_url('assets/anew/images/upload.png')?>" alt="" id="prevImage" class="prev w-full h-64 object-contain" style="height:200px">
         </div>
        </label>
        <input type="file" id="prevImage" hidden>
     </div>
     <!-- Users card --> 
     <div class="p-4 bg-white rounded-md dark:bg-darker overflow-auto box-border px-10" style="height:270px">
         <h1 class="text-xl font-semibold">Category</h1>
         <?php foreach ($cats->result() as $key => $cat): ?>
           <label class="inline-flex items-center mt-3 w-full box-border" id="category">
                 <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600 dark:text-light" value="<?=$cat->CID?>">
                 <span class="ml-2 text-gray-700"><?=$cat->cname?></span>
           </label>
         <?php endforeach; ?>
     </div>
     <!-- Orders card --> 
     <div class="p-4 bg-white rounded-md dark:bg-darker overflow-auto box-border px-10" style="height:270px">
         <h1 class="text-xl font-semibold">Work With</h1>
          <label class="inline-flex items-center mt-3 w-full box-border" id="workWith">
                <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="EPS"><span class="ml-2 text-gray-700">EPS</span>
          </label>
          <label class="inline-flex items-center mt-3 w-full box-border" id="workWith">
                <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="AI"><span class="ml-2 text-gray-700">AI</span>
          </label>
          <label class="inline-flex items-center mt-3 w-full box-border" id="workWith">
                <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="PSD"><span class="ml-2 text-gray-700">PSD</span>
          </label>
          <label class="inline-flex items-center mt-3 w-full box-border" id="workWith">
                <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="SVG"><span class="ml-2 text-gray-700">SVG</span>
          </label>
     </div>
  </div>
  <div class="mx-0 p-4">
      <div class="w-full mr-6 mb-5"><input type="text" id="mTitle" placeholder="Meta Title" class="w-full rounded shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker" value="{title} Free Download - PNGhill"></div>
      <div class="w-full mr-6 mb-5"><input type="text" id="mDesc" placeholder="Meta Desc" class="w-full rounded shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker" value="Download this {title} - PNGhill, PNGhill has millions of free png, vectors and psd graphic resources for designers."></div>
      <div class="w-full mr-6 mb-5"><input type="text" id="mTags" placeholder="Meta Tags" class="w-full rounded shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker" value="{title} {tags} , download millions of free png, vectors and psd graphic resources for designers."></div>
  </div>
</main>