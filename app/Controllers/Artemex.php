<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Artemex extends BaseController
{
    // Login
    public function index()
    {
        return view('Artemex/login');
    }

    public function inicio()
    {
        $data = [
            'title' => 'Inicio',
        ];
        return view('Artemex/inicio', $data);
    }
    public function productos()
    {
        $data = [
            'title' => 'Administrar productos',
        ];
        return view('Artemex/productos', $data);
    }
}