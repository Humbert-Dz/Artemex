<?= view('commons/head') ?>

<div class="w-full mb-7">
    <h2 class="mb-7 dark:text-white">En esta sección tienes control total sobre las cuentas con las que administradores pueden acceder al sistema.</h2>
    <a href="<?= base_url('cuentas') ?>" class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Regresar</a>
</div>
<?php $session = session() ?>
    <!-- Tabla admins -->
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 text-center">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
                <tr>
                    <th scope="col" class="px-4 py-4">
                        ID
                    </th>
                    <th scope="col" class="p-1 py-4">
                        nombre
                    </th>
                    <th scope="col" class="px-1 py-4">
                        apellido paterno
                    </th>
                    <th scope="col" class="px-1 py-4">
                        apellido materno
                    </th>
                    <th scope="col" class="px-2 py-4">
                        fecha nacimiento
                    </th>
                    <th scope="col" class="px-2 py-4">
                        teléfono
                    </th>
                    <th scope="col" class="px-2 py-4">
                        correo
                    </th>
                    <th scope="col" class="px-2 py-4">
                        contraseña
                    </th>
                    <th scope="col" class="px-2 py-4">
                        cód. postal
                    </th>
                    <th scope="col" class="px-2 py-4">
                        estado
                    </th>
                    <th scope="col" class="px-2 py-4">
                        Municipio
                    </th>
                    <th scope="col" class="px-2 py-4">
                        calle
                    </th>
                    <th scope="col" class="px-2 py-4">
                        núm. casa
                    </th>
                    <th scope="col" class="px-2 py-4">
                        referencias
                    </th>
                    <th scope="col" class="px-2 py-4">
                        Jornada laboral
                    </th>
                    <th scope="col" class="px-1 py-4">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($admins as $admin): ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <?php $clase = ($session->get('idAdmin') == $admin['id']) ? 'text-green-300' : ''; ?>
                        <th scope="row" class=" <?php echo $clase ?> px-4 py-4 font-medium whitespace-nowrap">
                            <?php echo $admin['id'] ?>
                        </th>
                        <td class="p-1 py-4 <?php echo $clase ?>">
                            <?php echo $admin['name'] ?>
                        </td>
                        <td class="px-1 py-4 <?php echo $clase ?>">
                            <?php echo $admin['lastname'] ?>
                        </td>
                        <td class="px-1 py-4 <?php echo $clase ?>">
                            <?php echo $admin['second_lastname'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['birthday'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['phone'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['email'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['password'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['postal_code'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['state'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['town'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['street'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['house_number'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['reference'] ?>
                        </td>
                        <td class="px-2 py-4 <?php echo $clase ?>">
                            <?php echo $admin['work_schedule_start'] . ' - ' . $admin['work_schedule_end'] ?>
                        </td>
                        <td class="px-1 py-4">
                            <div class="min-h-max flex flex-col justify-center items-between">
                                <a href="<?= base_url('cuentas/administradores/editar/' . $admin['id']) ?>" class="active:scale-95 text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" title="Actualiza este producto!">Editar</a>
                                <a data-modal-target="popup-modal" data-modal-toggle="popup-modal" onclick="eliminar('<?php echo $admin['id']?>')"  class="active:scale-95 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 cursor-pointer" title="Elimina este producto!">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <div>


<?= view('commons/end') ?>