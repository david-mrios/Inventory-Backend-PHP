<?php

namespace App\Controllers;

use App\Models\Facultad;

class facultadController extends BaseController
{
    
    private $FacultyModel;


    public function __construct()
    {
        $this->FacultyModel = model(Facultad::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $data = [
            "Facultdad" => $request->getPost("Facultdad")
            
        ];

        if ($this->FacultyModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->FacultyModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost("idFacultad");

        $existinFaculty = $this->FacultyModel->find($id);
        if (!$existinFaculty) {
            echo json_encode(["mensaje" => "Facultadad no agregada"]);
            return;
        }
       
        $data = [
            "Facultdad" => $request->getPost("Facultdad")
            
        ];

        if ($this->FacultyModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->FacultyModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

    public function getAll()
    {
        try {
            $Faculty = $this->FacultyModel->findAll();

            if (empty($Faculty)) {
                echo json_encode(["mensaje" => "No se han encontrado ninguna facultadd"]);
            } else {
                echo json_encode($Faculty);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function delete()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idFacultad");

        $existingFaculty = $this->FacultyModel->find($id);
        if (!$existingFaculty) {
            echo json_encode(["mensaje" => "Registro no encontrada"]);
            return;
        }
        $this->FacultyModel->delete($id);
        echo json_encode(["mensaje" => "el registro ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idFacultad");
        $Faculty = $this->FacultyModel->find($id);

        if ($Faculty != null) {
            echo json_encode($Faculty);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);

        }
    }
} // Fin de la clase
