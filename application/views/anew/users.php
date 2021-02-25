<main>
<div class="flex items-center justify-between p-4 rounded-md hidden">
    <form action="" class="w-full">
        <h1 class="text-2xl font-bold my-4 text-center">Add Category</h1>
        <input type="text" placeholder="Name" class="w-full rounded mb-5 shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
        <input type="text" placeholder="Title" class="w-full rounded mb-5 shadow p-3 text-grey-600 mr-2 focus:outline-none w-full dark:bg-darker">
        <textarea class="w-full mb-5 rounded shadow p-3 text-gray-600 focus:outline-none dark:bg-darker" placeholder="description"></textarea>
        <button class="bg-primary text-white text-base font-semibold tracking-wide uppercase p-3 rounded shadow hover:bg-indigo-light min-w-full">Add Category</button>
    </form>
</div>
    <div class="flex p-4 ounded-md overflow-auto"> 
        <div class="grid grid-cols-1 gap-2 w-full">
          <?php foreach ($users->result() as $key => $value): ?>
            <div class="flex p-3 text-center bg-white rounded-md dark:bg-darker shadow hover:shadow-lg justify-between">
              <div class="flex item-center">
                 <div class="mr-4">
                     <a href="" class="shadow-sm block float-left">
                         <img  class="rounded h-10 w-10" src="<?=$value->u_img?>" alt="">
                     </a>
                 </div>
                 <div class="mt-1.5">
                     <a href="" class="text-gray-600 fontt hover:text-primary-50 hover:underline"><?=$value->u_name?></a>
                     <a href="" class="bg-blue-50 shadow-sm p-1 px-2 rounded text-blue-600 text-xs ml-2 fontt">4</a>
                 </div>
               </div>
              <div class="">
                 <a href="#" class="text-primary-lighter font-bold py-1 px-3 rounded text-xs bg-primary-50 hover:bg-blue-100">Edit</a>
                 <a href="#" class="text-red-400 font-bold py-1 px-3 rounded text-xs bg-red-50 h-10 hover:bg-red-100">Delete</a>
                 <?php if ($value->u_role == 1): ?>
                   <a href="#" class="text-green-400 font-bold py-1 px-3 rounded text-xs bg-green-50 h-10 hover:bg-green-100">Super User</a>
                  <?php else: ?>
                    <a href="#" class="text-yellow-400 font-bold py-1 px-3 rounded text-xs bg-yellow-50 h-10 hover:bg-yellow-100">Visitor</a>
                 <?php endif; ?>
               </div>
            </div>
          <?php endforeach; ?>
         </div>
    </div>
</main>