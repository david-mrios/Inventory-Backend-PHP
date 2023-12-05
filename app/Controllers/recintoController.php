<?php

namespace App\Controllers;

use App\Models\Recinto;

class recintoController extends BaseController
{
    private $RecintoModel;
    public function __construct()
    {
        $this->RecintoModel = model(Recinto::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $data = [
            "Recinto" => $request->getPost("Recinto")
        ];

        if ($this->RecintoModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->RecintoModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost("idRecinto");

        $existingRecinto = $this->RecintoModel->find($id);
        if (!$existingRecinto) {
            echo json_encode(["mensaje" => "Recinto no agregada"]);
            return;
        }

        $data = [
            "Recinto" => $request->getPost("Recinto")
        ];


        if ($this->RecintoModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->RecintoModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

        public function getAll()
    {
        try {
            $recinto = $this->RecintoModel->findAll();

            if (empty($recinto)) {
                echo json_encode(["mensaje" => "No se han encontrado ninguna facultadd"]);
            } else {
                echo json_encode($recinto);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function delete()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idRecinto");

        $existingRecinto = $this->RecintoModel->find($id);
        if (!$existingRecinto) {
            echo json_encode(["mensaje" => "Recinto no agregada"]);
            return;
        }

        $this->RecintoModel->delete($id);
        echo json_encode(["mensaje" => "el recinto ha sido eliminado"]);
    }


    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idRecinto");
        $recinto = $this->RecintoModel->find($id);

        if ($recinto != null) {
            echo json_encode($recinto);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
