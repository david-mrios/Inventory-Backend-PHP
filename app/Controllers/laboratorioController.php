<?php

namespace App\Controllers;

use App\Models\Laboratorio;

class laboratorioController extends BaseController
{
    private $labModel;


    public function __construct()
    {
        $this->labModel = model(Laboratorio::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $data = [
            "numeroLab" => $request->getPost("numeroLab")
        ];

        if ($this->labModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->labModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idLab");

        $existingLab = $this->labModel->find($id);
        if (!$existingLab) {
            echo json_encode(["mensaje" => "Laboratorio no encontrado"]);
            return;
        }

        $data = [
            "numeroLab" => $request->getPost("numeroLab")
        ];


        if ($this->labModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->labModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }
    public function getAll()
    {
        try {
            $lab = $this->labModel->findAll();

            if (empty($lab)) {
                echo json_encode(["mensaje" => "No se ha encontrado ningun laboratorio"]);
            } else {
                echo json_encode($lab);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function deleteLogic()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idLab");

        $existingLab = $this->labModel->find($id);
        if (!$existingLab) {
            echo json_encode(["mensaje" => "Laboratorio no encontrado"]);
            return;
        }

        $this->labModel->delete($id);
        echo json_encode(["mensaje" => "El registro ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idLab");
        $lab = $this->labModel->find($id);

        if ($lab != null) {
            echo json_encode($lab);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);

        }
    }
} // Fin de la clase
