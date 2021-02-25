<main>
<div class="grid grid-cols-1 gap-8 p-4 lg:grid-cols-2 xl:grid-cols-2">
    <div class="flex items-center justify-between p-4 rounded-md ">
        <?php if ($edit): ?>
          <?php foreach ($category->result() as $key => $value): ?>
            <form class="w-full" action="<?=base_url('Welcome/ecat')?>" method="POST">
                <h1 class="text-2xl font-bold my-4 text-center">Edit <?=$value->cname?></h1>
                <input id="cname"  name="cname" value="<?=$value->cname?>" type="text" placeholder="Name" class="w-full rounded mb-5 shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
                <input id="cslug"  name="cslug" value="<?=$value->cslug?>" placeholder="slug" class="w-full rounded mb-5 shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
                <input name="ctitle" type="text" value="<?=$value->m_title?>" placeholder="Title" class="w-full rounded mb-5 shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
                <textarea id="cdesc" name="desc" class="w-full mb-5 rounded shadow p-3 text-gray-600 focus:outline-none dark:bg-darker" placeholder="description"><?=$value->desce?></textarea>
                <button type="submit" name="button" class="bg-primary text-white text-base font-semibold tracking-wide uppercase p-3 rounded shadow hover:bg-indigo-light min-w-full">Update Category</button>
                <input type="text" name="id" value="<?=$value->CID?>" hidden>
            </form>
          <?php endforeach; ?>
        <?php else: ?>
          <form class="w-full" action="<?=base_url('Welcome/publish')?>" method="POST">
              <h1 class="text-2xl font-bold my-4 text-center">Add Category</h1>
              <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
                <div class="bg-green-lightest border-l-4 border-green text-green-dark p-2 mb-3" role="alert">
                  <p>Category has been updated.</p>
                </div>    
              <?php endif; ?>
              <?php if (isset($_GET['msg']) && $_GET['msg'] == 'error'): ?>
                <div class="bg-orange-lightest border-l-4 border-orange text-orange-dark p-2 mb-3" role="alert">
                  <p>Something went wrong.</p>
                </div>
              <?php endif; ?>
              <input id="cname"  name="cname" type="text" placeholder="Name" class="w-full rounded mb-5 shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
              <input id="cslug"  name="cslug" type="text" placeholder="slug" class="w-full rounded mb-5 shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
              <input name="ctitle" type="text" placeholder="Title" class="w-full rounded mb-5 shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
              <textarea id="cdesc" name="desc" class="w-full mb-5 rounded shadow p-3 text-gray-600 focus:outline-none dark:bg-darker" placeholder="description"></textarea>
              <button type="submit" name="button" class="bg-primary text-white text-base font-semibold tracking-wide uppercase p-3 rounded shadow hover:bg-indigo-light min-w-full">Add Category</button>
              <input type="text" name="action" value="category" hidden>
          </form>
        <?php endif; ?>
    </div>
    <div class="flex p-4 ounded-md overflow-auto" style="max-height: 75vh;"> 
        <div class="grid grid-cols-1 gap-2 w-full">
          <?php foreach ($cats->result() as $key => $valuee): ?>
            <div class="m-0 mb-0 pb-0">
              <div class="flex p-4 text-center bg-white rounded-md dark:bg-darker shadow hover:shadow-lg justify-between">
                <div class="flex">
                   <a href="" class="text-gray-600 fontt hover:text-primary-50 hover:underline"><?=$valuee->cname?></a>
                   <a href="" class="bg-blue-50 shadow-sm p-1 px-2 rounded text-blue-600 text-xs ml-2">4</a>
                 </div>
                <div class="">
                   <a href="<?=base_url('admin-panel/add/category?edit='.$valuee->CID)?>" class="text-primary-lighter font-bold py-1 px-3 rounded text-xs bg-primary-50 hover:bg-blue-100">Edit</a>
                   <a href="<?=base_url('admin-panel/edit?action=category&task=delete&id='.$valuee->CID)?>" class="text-red-400 font-bold py-1 px-3 rounded text-xs bg-red-50 hover:bg-red-100">Delete</a>
                 </div>
              </div>
            </div>
          <?php endforeach; ?>
         </div>
    </div>
</div>
</main>