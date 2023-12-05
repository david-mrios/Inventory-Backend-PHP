<?php

namespace App\Controllers;

use App\Models\Estado;

class estadoController extends BaseController
{
    private $stateModel;


    public function __construct()
    {
        $this->stateModel = model(Estado::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $data = [
            "estado" => $request->getPost("estado")
        ];

        if ($this->stateModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->stateModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost("idEstado");

        $existingState = $this->stateModel->find($id);
        if (!$existingState) {
            echo json_encode(["mensaje" => "Estado no definido"]);
            return;
        }

        $data = [
            "estado" => $request->getPost("estado")
        ];


        if ($this->stateModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->stateModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

    public function getAll()
    {
        try {
            $state = $this->stateModel->findAll();

            if (empty($state)) {
                echo json_encode(["mensaje" => "No se han encontrado ningun estado"]);
            } else {
                echo json_encode($state);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function delete()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idEstado");

        $existingState = $this->stateModel->find($id);
        if (!$existingState) {
            echo json_encode(["mensaje" => "Estado no definido"]);
            return;
        }
        $this->stateModel->delete($id);
        echo json_encode(["mensaje" => "el registro ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idEstado");
        $state = $this->stateModel->find($id);

        if ($state != null) {
            echo json_encode($state);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
