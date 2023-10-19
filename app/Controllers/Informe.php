<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Informe extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Generar informe',
        ];
        
        return view('Artemex/informe', $data);
    }
}