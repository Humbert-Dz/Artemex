<?php

namespace App\Controllers\ADMINISTRADOR;

use App\Controllers\BaseController;

class Artemex extends BaseController
{

    // Login
    /**
     * maneja la autenticación de administradores. 
     * Verifica si se envió un formulario de inicio de sesión, realiza la autenticación en la base de 
     * datos usando una consulta almacenada y si son válidas, inicia una sesión y
     * redirige al usuario a una página de inicio.
     */
    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $db = \Config\Database::connect();

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $query = $db->query("CALL art_LoginAdmin(?, ?)", array($email, $password))->getResult();

            if (count($query) > 0) {
                $session = session();
                $idAdmin = $query[0]->id;
                $name = $query[0]->name;

                $newdata = [
                    'idAdmin' => $idAdmin,
                    'name' => $name,
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'logged_in' => true,
                ];

                $session->set($newdata);

                return $this->inicio();

            } else {
                return redirect()->to("/login");
            }

        } else {
            return view('artemex/login');
        }
    }

    // Cierra la sesión, destruye las variables de sesión
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to("/login");
    }

    // Si el usuario está autenticado, se carga la vista de inicio
    public function inicio()
    {
        $session = session();

        if ($session->get('logged_in')) {
            $data = [
                'title' => 'Inicio',
                'name' => $session->get('name'),
            ];

            return view('Artemex/inicio', $data);
        } else {
            return redirect()->to("/login");
        }
    }
}