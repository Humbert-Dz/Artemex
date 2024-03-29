<?= view('USUARIOS/commons/head') ?>

<div class="w-full grid grid-cols-4 gap-2">
    
    <?php foreach($productos as $producto): ?>
        

    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <figure>
            <img class="p-8 mx-auto h-[300px] rounded-lg" src="<?= base_url("{$producto['image']}")?>" alt="product image" />
        </figure>
        <div class="px-5 pb-5">
            <div class="mb-4">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"><?php echo $producto['name'] ?></h5>
                <p class="text-sm text-gray-400"><?php echo $producto['description'] ?></p>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-cyan-400">$<?php echo $producto['price_sale'] ?></span>
                <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Agregar a carrito</a>
            </div>
        </div>
    </div>

    <?php endforeach; ?>        

</div>

<?= view('USUARIOS/commons/end') ?>