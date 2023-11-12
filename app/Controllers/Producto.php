<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductoModel;

class Producto extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Administrar productos',
        ];

        return view('Artemex/productos', $data);
    }

    public function agregar()
    {

        $productos = new ProductoModel();

        //si la imagen tiene el mismo nombre de otra ya existente
        if ($img = $this->request->getFile('imagen')) {
            // se crea un nuevo nombre
            $nuevoNombre = $img->getRandomName();
            //en la carpeta tal, ponemos la imagen
            $img->move('../public/uploads/', $nuevoNombre);
            
            //recepción de datos del formulario
            $data = [
                'name' => $_POST['name'],
                'weight' => $_POST['weight'],
                'expiration_date' => $_POST['expiration_date'],
                'cost' => $_POST['cost'],
                'price sale' => $_POST['price'],
                'stock' => $_POST['stock'],
                'status' => $_POST['status'],
                'category' => $_POST['category'],
                'image' => $img,
                'added_by' => $_POST['added_by']
            ];
            
            $productos->insert($data);
        }

        return;
    }
}