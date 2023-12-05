<?php

namespace App\Controllers;

use App\Models\MarcaEquipo;

class marcaEquipoController extends BaseController
{
    private $marcaModel;


    public function __construct()
    {
        $this->marcaModel = model(MarcaEquipo::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $data = [
            "marca" => $request->getPost("marca")
        ];

        if ($this->marcaModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->marcaModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idMarca");

        $existingMarca = $this->marcaModel->find($id);
        if (!$existingMarca) {
            echo json_encode(["mensaje" => "Marca no agregada"]);
            return;
        }


        $data = [
            "marca" => $request->getPost("marca")
        ];


        if ($this->marcaModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->marcaModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

    public function getAll()
    {
        try {
            $marca = $this->marcaModel->findAll();

            if (empty($marca)) {
                echo json_encode(["mensaje" => "No se han encontrado ninguna marca"]);
            } else {
                echo json_encode($marca);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function delete()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idMarca");

        $existingMarca = $this->marcaModel->find($id);
        if (!$existingMarca) {
            echo json_encode(["mensaje" => "Marca no agregada"]);
            return;
        }

        $this->marcaModel->delete($id);
        echo json_encode(["mensaje" => "El registro ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idMarca");
        $marca = $this->marcaModel->find($id);

        if ($marca != null) {
            echo json_encode($marca);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);

        }
    }
} // Fin de la clase
