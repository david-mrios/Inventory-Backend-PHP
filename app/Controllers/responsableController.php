<?php

namespace App\Controllers;

use App\Models\Responsable;

class responsableController extends BaseController
{
    private $responsableModel;

    public function __construct()
    {
        $this->responsableModel = model(Responsable::class);
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

        if ($this->responsableModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->responsableModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $inss = $request->getPost("inss");

        $existingResponsable = $this->responsableModel->find($inss);
        if (!$existingResponsable) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }
        $newCedula = $request->getPost("cedula");


        if ($newCedula !== $existingResponsable['cedula'] && !$this->isCedulaUnique($newCedula)) {
            echo json_encode(["mensaje" => "El nuevo número de cedula debe ser unico. Por favor, elige otro."]);
            return;
        }
        $data = [
            "nombres" =>  $request->getPost("nombres") ?? $existingResponsable['nombres'], // ?? Si los datos no se dan , se envian los que ya estan.
            "apellidos" => $request->getPost("apellidos") ?? $existingResponsable['apellidos'],
            "telefono" => $request->getPost("telefono") ?? $existingResponsable['telefono'],
            "cedula" =>  $newCedula ?? $existingResponsable['cedula']
        ];

        // Eliminar el campo cedula del array si no se proporciona
        if (!$newCedula) {
            unset($data['cedula']);
        }


        if ($this->responsableModel->update($inss, $data) === false) {
            echo json_encode(["mensaje error" => $this->responsableModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Actualizado"]);
        }
    }
    private function isCedulaUnique($cedula)
    {
        $role = $this->responsableModel->where('cedula', $cedula)->first();
        return ($role === null); // Si $cedula es null el numero es único
    }


    public function getAll()
    {
        try {
            $resonsable = $this->responsableModel->findAll();

            if (empty($resonsable)) {
                echo json_encode(["mensaje" => "No se encontraron responsable"]);
            } else {
                echo json_encode($resonsable);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }

    public function deleteLogic()
    {

        $request = \Config\Services::request();
        $inss = $request->getPost("inss");


        $existingResponsable = $this->responsableModel->find($inss);
        if (!$existingResponsable) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }


        $this->responsableModel->delete($inss);
        echo json_encode(["mensaje" => "El registro ha sido eliminado"]);
    }


    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("inss");
        $responsable = $this->responsableModel->find($id);

        if ($responsable != null) {
            echo json_encode($responsable);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
