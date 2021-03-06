<main>
   <div class="grid grid-cols-1 gap-4 p-4 md:grid-cols-2 xl:grid-cols-4 2xl:grid-cols-6">
      <template x-for="i in 20" x-key="i">
         <div class="p-2 text-center bg-white rounded-md shadow dark:bg-darker">
           <article class="overflow-hidden">
              <a href="#"> <img alt="Placeholder" class="block h-auto w-full" src="https://picsum.photos/600/400/?random"> </a> 
              <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                 <h1 class="text-lg"> <a class="no-underline hover:underline text-black" href="#"> Article Title </a> </h1>
                 <p class="text-grey-darker text-sm"> 14/4/19 </p>
              </header>
              <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                 <a class="flex items-center no-underline hover:underline text-black" href="#">
                    <img alt="Placeholder" class="block rounded-full" src="https://picsum.photos/32/32/?random"> 
                    <p class="ml-2 text-sm"> Author Name </p>
                 </a>
                 <a class="no-underline text-grey-darker hover:text-red-dark" href="#"> <span class="hidden">Like</span> <i class="fa fa-heart"></i> </a> 
              </footer>
           </article>
         </div>
      </template>
   </div>
</main>