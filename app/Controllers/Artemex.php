<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Artemex extends BaseController
{

    // Login
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

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to("/login");
    }

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