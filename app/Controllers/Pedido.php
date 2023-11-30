<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PedidoModel;

class Pedido extends BaseController
{
    public function index()
    {

        $session = session();
        if ($session->get('logged_in')) {

            $db = \Config\Database::connect();

            $pedidos = $db->query('select * from detalles_orders;')->getResultArray();

            $data = [
                'title' => 'Pedidos',
                'pedidos' => $pedidos,
            ];

            return view("pedidos/pedido", $data);
        } else {
            return redirect()->to('/login');
        }
    }

    public function confirmar($id)
    {

        $session = session();

        if ($session->get('logged_in')) {

            $data = ['confirmed' => 1];

            $pedidoModel = new PedidoModel();

            $pedidoModel->update($id, $data);

            return redirect()->to('/pedido');

        } else {
            return redirect()->to('/login');
        }
    }

    public function cancelar($id)
    {
        $session = session();

        if ($session->get('logged_in')) {

            $data = ['canceled_at' => date('Y-m-d H:i:s')];

            $pedidoModel = new PedidoModel();

            $pedidoModel->update($id, $data);

            return redirect()->to('/pedido');

        } else {
            return redirect()->to('/login');
        }
    }

    public function enviar($id)
    {
        $session = session();

        if ($session->get('logged_in')) {

            $data = ['delivery' => 1];

            $pedidoModel = new PedidoModel();

            $pedidoModel->update($id, $data);

            return redirect()->to('/pedido');

        } else {
            return redirect()->to('/login');
        }
    }

    
}