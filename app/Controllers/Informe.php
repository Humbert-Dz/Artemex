<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Informe extends BaseController
{
    public function index()
    {
        $session = session();

        if ($session->get('logged_in')) {

            if (strtolower($this->request->getMethod()) === 'get') {

                $data = [
                    'title' => 'Generar informe',
                    'informeGenerado' => false,
                ];

                return view('informes/informe', $data);
            } else {
                return $this->generar();
            }

        } else {
            return redirect()->to('/login');
        }
    }

    private function generar()
    {
        $session = session();
        $db = \Config\Database::connect();

        if ($session->get('logged_in')) {


            //recepción de información de post y formateo de fechas
            $fechaInicio = $_POST['start'];
            $startPOST = \DateTime::createFromFormat('m/d/Y', $fechaInicio);
            $start = $startPOST->format('Y/m/d');

            $fechaFin = $_POST['end'];
            $endPOST = \DateTime::createFromFormat('m/d/Y', $fechaFin);
            $end = $endPOST->format('Y/m/d');

            $rutaBase = 'informes/Highcharts/';

            $data = [
                'title' => 'Informe generado',
                'informeGenerado' => true,
                'fechaInicio' => $fechaInicio,
                'fechaFin' => $fechaFin
            ];

            $tipo = $_POST['tipo'];

            if ($tipo == 0 || $tipo == 1) {

                $tituloInforme = ($tipo == 1) ? 'más vendidos' : 'menos vendidos';

                // conexión y ejecución de procedimiento almacenado que retorna los productos más o menos vendidos según sea el caso
                $productos = $db->query("CALL art_ProductosVendidos(?, ?, ?)", array($start, $end, $tipo))->getResultArray();
                
                
                $data['productos'] = $productos;
                $data['tituloInforme'] = "Productos {$tituloInforme} entre el periodo {$fechaInicio} y {$fechaFin}";
                $data['subtitulo'] = "A continuación, se muestran los 10 productos {$tituloInforme} entre el rango de fechas indicado.";
                $data['grafico'] = "{$rutaBase}EstadoVentasProductos/ventas";
                
            }else if($tipo == 'utilidades'){
                // conexión y ejecución de procedimiento almacenado que retorna las utilidades por categoria
                $categorias = $db->query("CALL  art_Utilidades(?, ?)", array($start, $end))->getResultArray();
                
                $data['categorias'] = $categorias;
                $data['tituloInforme'] = "Utilidades por categorias entre el periodo {$fechaInicio} y {$fechaFin}";
                $data['subtitulo'] = "A continuación, se muestra la utilidad resultante de las ventas por categorias entre el rango de fechas indicado.";
                $data['grafico'] = "{$rutaBase}UtilidadesCategorias/utilidades";
            }
            
            
            return view('informes/informe', $data);
            
        } else {
            return redirect()->to('/login');
        }
    }
}