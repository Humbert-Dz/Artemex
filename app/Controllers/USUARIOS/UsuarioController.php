<?php

namespace App\Controllers\USUARIOS;

use App\Controllers\BaseController;

class UsuarioController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $productos = $db->query('select * from info_product where status = 1;')->getResultArray();

        $data = [
            'title' => 'Artemex, tu tienda de confianza',
            'productos' => $productos
        ];
        return view('USUARIOS/inicio', $data);
    }
}
