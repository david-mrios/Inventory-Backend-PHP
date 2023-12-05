<?php

namespace App\Controllers;

use App\Models\Tipo_Movimiento;

class tipoMovimientoController extends BaseController
{
    private $tipo_MvmModel;


    public function __construct()
    {
        $this->tipo_MvmModel = model(Tipo_Movimiento::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $data = [
            "tipoMovimiento" => $request->getPost("tipoMovimiento")
        ];

        if ($this->tipo_MvmModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->tipo_MvmModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idTipoMovimiento");

        $existingTipoMov = $this->tipo_MvmModel->find($id);
        if (!$existingTipoMov) {
            echo json_encode(["mensaje" => "Tipo de movimiento no definido"]);
            return;
        }

        $data = [
            "tipoMovimiento" => $request->getPost("tipoMovimiento")
        ];


        if ($this->tipo_MvmModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->tipo_MvmModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

    public function getAll()
    {
        try {
            $TipoMov = $this->tipo_MvmModel->findAll();

            if (empty($TipoMov)) {
                echo json_encode(["mensaje" => "No se han encontrado ningun tipo de movimiento"]);
            } else {
                echo json_encode($TipoMov);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function delete()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idTipoMovimiento");

        $existingTipoMov = $this->tipo_MvmModel->find($id);
        if (!$existingTipoMov) {
            echo json_encode(["mensaje" => "Tipo de movimiento no se ha encontrado"]);
            return;
        }


        $this->tipo_MvmModel->delete($id);
        echo json_encode(["mensaje" => "El registro ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idTipoMovimiento");
        $tipoMov = $this->tipo_MvmModel->find($id);

        if ($tipoMov != null) {
            echo json_encode($tipoMov);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
