<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pedido extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Pedidos',
        ];

        return view("artemex/pedido", $data);
    }
}