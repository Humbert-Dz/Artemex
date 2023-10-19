<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Producto extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Administrar productos',
        ];
        
        return view('Artemex/productos', $data);
    }
}