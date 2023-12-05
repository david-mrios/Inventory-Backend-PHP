<?php

namespace App\Controllers;

use App\Models\Custodio;

class custodioController extends BaseController
{
    private $CusModel;

    public function __construct()
    {
        $this->CusModel = model(Custodio::class);
    }   
    public function create()
    {
        $request = \Config\Services::request();

        $data = [
            "inss" => $request->getPost("inss"),
            "nombres" => $request->getPost("nombres"),
            "apellidos" => $request->getPost("apellidos"),
            "telefono" => $request->getPost("telefono"),
            "cedula" => $request->getPost("cedula")
        ];

        if ($this->CusModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->CusModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Custodio Guardado"]);
        }
    }
    public function update()
    {
        $request = \Config\Services::request();
        $inss = $request->getPost("inss");

        $existingCustodio = $this->CusModel->find($inss);
        if (!$existingCustodio) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }
        $newCedula = $request->getPost("cedula");


        if ($newCedula !== $existingCustodio['cedula'] && !$this->isCedulaUnique($newCedula)) {
            echo json_encode(["mensaje" => "El nuevo número de cedula debe ser unico. Por favor, elige otro."]);
            return;
        }
        $data = [
            "nombres" =>  $request->getPost("nombres") ?? $existingCustodio['nombres'], // ?? Si los datos no se dan , se envian los que ya estan.
            "apellidos" => $request->getPost("apellidos") ?? $existingCustodio['apellidos'],
            "telefono" => $request->getPost("telefono") ?? $existingCustodio['telefono'],
            "cedula" =>  $newCedula ?? $existingCustodio['cedula']
        ];

       // Eliminar el campo cedula del array si no se proporciona
       if (!$newCedula) {
        unset($data['cedula']);
    }


        if ($this->CusModel->update($inss, $data) === false) {
            echo json_encode(["mensaje error" => $this->CusModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Actualizado"]);
        }
    }
    private function isCedulaUnique($cedula)
    {
        $cedula = $this->CusModel->where('cedula', $cedula)->first();
        return ($cedula === null); // Si $cedula es null el numero es único
    }


    public function getAll()
    {
        try {
            $custodios = $this->CusModel->findAll();

            if (empty($custodios)) {
                echo json_encode(["mensaje" => "No se encontraron custodios"]);
            } else {
                echo json_encode($custodios);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }


    public function deleteLogic()
    {

        $request = \Config\Services::request();
        $inss = $request->getPost("inss");

        $existingCustodio = $this->CusModel->find($inss);
        if (!$existingCustodio) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        $this->CusModel->delete($inss);
        echo json_encode(["mensaje" => "El registro ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $inss = $request->getPost("inss");

        $record = $this->CusModel->find($inss);

        if ($record) {
            echo json_encode($record);
        } else {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
        }
    }
} // Fin de la clase
