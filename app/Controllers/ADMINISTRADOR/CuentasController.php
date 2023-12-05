<?php

namespace App\Controllers\ADMINISTRADOR;

use App\Controllers\BaseController;

class CuentasController extends BaseController
{
    // Muestra un menú a elegir entre ver cuentas de administradores o clientes
    public function index()
    {
        $session = session();

        if ($session->get('logged_in')) {

            $data = [
                'title' => 'Cuentas',

            ];

            return view('cuentas/cuentas', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    // Muestra las cuentas de administradores
    public function administradores()
    {
        $session = session();

        if ($session->get('logged_in')) {
            $db = \Config\Database::connect();

            $admins = $db->query('select * from info_admins')->getResultArray();

            $data = [
                'title' => 'Cuentas de administradores',
                'admins' => $admins
            ];

            return view('cuentas/administradores', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    // Muestra las cuentas de clientes
    public function clientes()
    {
        $session = session();

        if ($session->get('logged_in')) {
            $db = \Config\Database::connect();

            $users = $db->query('select * from info_users')->getResultArray();

            $data = [
                'title' => 'Cuentas de clientes',
                'users' => $users
            ];

            return view('cuentas/clientes', $data);
        } else {
            return redirect()->to('/login');
        }
    }
}
