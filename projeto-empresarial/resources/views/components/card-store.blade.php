<div class="max-w-xs bg-slate-300 border-2 rounded-lg shadow-m grid justify-items-center">
    <a href="#">
        <img class="p-6 rounded-t-lg w-64 invisible" src="https://flowbite.com/docs/images/products/product-1.png" alt="product image">
    </a>
    <div class="px-5 pb-5 rounded-sm bg-slate-500">
        <a href="#">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Descrição</h5>
        </a>
        <div class="flex items-center mt-2.5 mb-5">
            @for ($i = 0; $i < 5; $i++) 
                <!-- Stars -->
                <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            @endfor
        <!-- Rate -->
        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">5.0</span>
        </div>
        <!-- Price & Button -->
        <div class="flex justify-between items-center">
            <span class="text-2xl font-bold text-white">R$ 15,00</span>
            <a href="#" class="text-white bg-indigo-600 hover:bg-indigo-700 outline-none font-medium rounded-md text-sm ml-2 px-2 py-2.5 text-center">Adicionar ao carrinho</a>
        </div>
    </div>
</div>