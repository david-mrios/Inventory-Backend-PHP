<?php

namespace App\Controllers;

use App\Models\Instructor;

class instructorController extends BaseController
{
    private $InsModel;

    public function __construct()
    {
        $this->InsModel = model(Instructor::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $data = [
            "noCarnet" => $request->getPost("noCarnet"),
            "nombres" => $request->getPost("nombres"),
            "apellidos" => $request->getPost("apellidos"),
            "telefono" => $request->getPost("telefono"),
            "cedula" => $request->getPost("cedula")
        ];

        if ($this->InsModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->InsModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {

        $request = \Config\Services::request();
        $noCarnet = $request->getPost("noCarnet");

        $existingInstructir = $this->InsModel->find($noCarnet);
        if (!$existingInstructir) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }
        $newCedula = $request->getPost("cedula");


        if ($newCedula !== $existingInstructir['cedula'] && !$this->isCedulaUnique($newCedula)) {
            echo json_encode(["mensaje" => "El nuevo número de cedula debe ser unico. Por favor, elige otro."]);
            return;
        }
        $data = [
            "nombres" =>  $request->getPost("nombres") ?? $existingInstructir['nombres'], // ?? Si los datos no se dan , se envian los que ya estan.
            "apellidos" => $request->getPost("apellidos") ?? $existingInstructir['apellidos'],
            "telefono" => $request->getPost("telefono") ?? $existingInstructir['telefono'],
            "cedula" =>  $newCedula ?? $existingInstructir['cedula']
        ];

        // Eliminar el campo cedula del array si no se proporciona
        if (!$newCedula) {
            unset($data['cedula']);
        }


        if ($this->InsModel->update($noCarnet, $data) === false) {
            echo json_encode(["mensaje error" => $this->InsModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

    private function isCedulaUnique($cedula)
    {
        $cedula = $this->InsModel->where('cedula', $cedula)->first();
        return ($cedula === null); // Si $cedula es null el numero es único
    }
   
    public function getAll()
    {
        try {
            $instructor = $this->InsModel->findAll();

            if (empty($instructor)) {
                echo json_encode(["mensaje" => "No se encontraron instructores"]);
            } else {
                echo json_encode($instructor);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }

    public function deleteLogic()
    {

        $request = \Config\Services::request();
        $noCarnet = $request->getPost("noCarnet");


        $existingInstructor = $this->InsModel->find($noCarnet);
        if (!$existingInstructor) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }


        $this->InsModel->delete($noCarnet);
        echo json_encode(["mensaje" => "El registro ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $noCarnet = $request->getPost("noCarnet");
        $instructor = $this->InsModel->find($noCarnet);

        if ($instructor != null) {
            echo json_encode($instructor);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
