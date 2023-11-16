<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use App\Models\ProductoModel;

class Producto extends BaseController
{
    public function index()
    {
        $session = session();
        $categories = new CategoriesModel();
        $db = \Config\Database::connect();

        if ($session->get('logged_in')) {
            $productos = $db->query('select * from info_product')->getResultArray();
            $data = [
                'title' => 'Administrar productos',
                'categories' => $categories->findAll(),
                'productos' => $productos,
            ];

            return view('producto/productos', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    public function agregar()
    {

        $session = session();

        if ($session->get('logged_in')) {

            $productos = new ProductoModel();

            // El campo 'imagen' existe y no está vacío.
            $imagenFile = $this->request->getFile('imagen');
            if ($imagenFile && $imagenFile->getSize() > 0) {
                //si la imagen tiene el mismo nombre de otra ya existente
                if ($img = $this->request->getFile('imagen')) {
                    // se crea un nuevo nombre
                    $nombre_img = $img->getRandomName();
                    //en la carpeta tal, ponemos la imagen
                    $img->move('../public/uploads/', $nombre_img);
                    $rutaIMG = 'uploads/' . $nombre_img;
                }
            } else {
                $rutaIMG = null;
            }

            $admin = $session->get('idAdmin');

            //recepción de datos del formulario
            $data = [
                'name' => $_POST['name'],
                'weight' => $_POST['peso'],
                'expiration_date' => $_POST['caducidad'],
                'cost' => $_POST['cost'],
                'price_sale' => $_POST['precio'],
                'stock' => $_POST['stock'],
                'status' => $_POST['status'],
                'category' => $_POST['category'],
                'image' => $rutaIMG,
                'added_by' => $admin,
                'description' => $_POST['description']
            ];

            $productos->insert($data);

            return redirect('producto');
        } else {
            return redirect()->to('/login');
        }
    }

    public function buscar()
    {
        $session = session();
        $categories = new CategoriesModel();
        $db = \Config\Database::connect();

        if ($session->get('logged_in')) {
            $nombre = $this->request->getPost('name');

            $productos = $db->query("CALL art_SearchProduct('{$nombre}') ")->getResultArray();
            $data = [
                'title' => 'Administrar productos',
                'categories' => $categories->findAll(),
                'productos' => $productos,
            ];

            return view('producto/productos', $data);
        } else {
            redirect()->to('/login');
        }

    }
    public function filtrado()
    {
        $session = session();
        $categories = new CategoriesModel();
        $db = \Config\Database::connect();

        if ($session->get('logged_in')) {
            $filtro = $this->request->getPost('filtro');


            if ($filtro == '1' || $filtro == '0') {
                $productos = $db->query("CALL art_SearchProductStatus('{$filtro}')")->getResultArray();
            } else {
                $productos = $db->query("CALL art_CategoryFilter('{$filtro}') ")->getResultArray();
            }

            $data = [
                'title' => 'Administrar productos',
                'categories' => $categories->findAll(),
                'productos' => $productos,
            ];

            return view('producto/productos', $data);
        } else {
            redirect()->to('/login');
        }
    }
    public function editar($id)
    {
        $session = session();
        $categories = new CategoriesModel();
        $db = \Config\Database::connect();

        if ($session->get('logged_in')) {
            $productos = $db->query("select * from info_product")->getResultArray();
            $product = $db->query("select * from info_product where id = $id")->getResultArray();
            $data = [
                'title' => 'Administrar productos',
                'categories' => $categories->findAll(),
                'productos' => $productos,
                'product' => $product
            ];

            return view('producto/editar', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    public function actualizar($id)
    {
        $session = session();

        if ($session->get('logged_in')) {

            $productos = new ProductoModel();

            // El campo 'imagen' existe y no está vacío.
            $imagenFile = $this->request->getFile('imagen');
            if ($imagenFile && $imagenFile->getSize() > 0) {
                //si la imagen tiene el mismo nombre de otra ya existente
                if ($img = $this->request->getFile('imagen')) {
                    // se crea un nuevo nombre
                    $nombre_img = $img->getRandomName();
                    //en la carpeta tal, ponemos la imagen
                    $img->move('../public/uploads/', $nombre_img);
                    $rutaIMG = 'uploads/' . $nombre_img;
                }
            } else {
                $rutaIMG = $_POST['copia_img'];
            }

            //recepción de datos del formulario
            $data = [
                'name' => $_POST['name'],
                'weight' => $_POST['peso'],
                'expiration_date' => $_POST['caducidad'],
                'cost' => $_POST['cost'],
                'price_sale' => $_POST['precio'],
                'stock' => $_POST['stock'],
                'status' => $_POST['status'],
                'category' => $_POST['category'],
                'image' => $rutaIMG,
                'description' => $_POST['description']
            ];

            $productos->update($id, $data);

            return redirect('producto');
        } else {
            return redirect()->to('/login');
        }
    }
    public function eliminar($id)
    {
        $session = session();
        if ($session->get('logged_in')) {

            $productos = new ProductoModel();

            $productos->delete($id);

            return redirect('producto');
        } else {
            return redirect()->to('/login');
        }
    }
}