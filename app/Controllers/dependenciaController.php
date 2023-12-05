<?php

namespace App\Controllers;

use App\Models\Dependencia;

class dependenciaController extends BaseController
{

    private $dependenceModel;

    public function __construct()
    {
        $this->dependenceModel = model(Dependencia::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $data = [
            "Departamento" => $request->getPost("Departamento")
        ];

        if ($this->dependenceModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->dependenceModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("IdDependencia");

        $existingDependence = $this->dependenceModel->find($id);
        if (!$existingDependence) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }


        $data = [
            "Departamento" => $request->getPost("Departamento")
        ];

        if ($this->dependenceModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->dependenceModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }


    public function getAll()
    {
        try {
            $dependence = $this->dependenceModel->findAll();

            if (empty($dependence)) {
                echo json_encode(["mensaje" => "No se encontraron departamentos"]);
            } else {
                echo json_encode($dependence);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }

    public function delete()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("IdDependencia");

        $existingDependence = $this->dependenceModel->find($id);
        if (!$existingDependence) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        $this->dependenceModel->delete($id);
        echo json_encode(["mensaje" => "El departamento ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("IdDependencia");
        $record = $this->dependenceModel->find($id);

        if ($record) {
            echo json_encode($record);
        } else {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
        }
    }
} // Fin de la clase
