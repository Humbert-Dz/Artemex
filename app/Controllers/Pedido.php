<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PedidoModel;

class Pedido extends BaseController
{
    /**
     * La función index en CodeIgniter muestra la lista de pedidos si el usuario está autenticado,
     *  obteniendo los detalles de la base de datos y cargando la vista 'pedidos/pedido'. 
     * Si no está autenticado, redirige a la página de inicio de sesión.
     */
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

    /**
     * La función confirmar en CodeIgniter confirma un pedido cambiando su estado a confirmado. 
     * Si el usuario está autenticado, actualiza el estado del pedido y redirige a la página de pedidos. 
     * Si no está autenticado, redirige a la página de inicio de sesión.
     */
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

    /**
     * La función cancelar en CodeIgniter cancela un pedido específico registrando la marca de tiempo de cancelación. 
     * Si el usuario está autenticado, actualiza el pedido con la nueva información y redirige a la página de pedidos. 
     * Si no está autenticado, redirige a la página de inicio de sesión.
     */
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

    /**
     * La función enviar en CodeIgniter marca como enviado un pedido específico mediante la actualización del campo 'delivery'. 
     * Si el usuario está autenticado, actualiza el pedido con la nueva información y redirige a la página de pedidos. 
     * Si no está autenticado, redirige a la página de inicio de sesión.
     */
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

    /**
     * obtiene el filtro de la solicitud POST. Dependiendo del filtro, 
     * realiza consultas a la base de datos utilizando procedimientos 
     * almacenados específicos. 
     */
    public function filtrado()
    {
        $session = session();


        if ($session->get('logged_in')) {
            $db = \Config\Database::connect();

            $filtro = $this->request->getPost('filtro');

            $pedidos = $db->query('CALL art_filterOrders(?)', array($filtro))->getResultArray();

            $data = [
                'title' => 'Pedidos',
                'pedidos' => $pedidos,
            ];

            return view('pedidos/pedido', $data);
        } else {
            redirect()->to('/login');
        }
    }

    // Busca un pedido de acuerdo a su id
    public function buscar()
    {
        $session = session();
        if ($session->get('logged_in')) {

            $db = \Config\Database::connect();
            $idPedido = $this->request->getPost('idPedido');

            $pedidos = $db->query('select * from detalles_orders where id = ? ;', array($idPedido))->getResultArray();

            $data = [
                'title' => 'Administrar productos',

                'pedidos' => $pedidos,
            ];

            return view('pedidos/pedido', $data);
        } else {
            redirect()->to('/login');
        }
    }

}