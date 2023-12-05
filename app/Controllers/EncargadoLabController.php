<?php

namespace App\Controllers;

use App\Models\EncargadoLlab;
use App\Models\Laboratorio;
use App\Models\Instructor;



class EncargadoLabController extends BaseController
{
    private $EncargadoLlab;
    private $LaboratorioModel;
    private $instructorModel;


    public function __construct()
    {
        $this->EncargadoLlab = model(EncargadoLlab::class);
        $this->LaboratorioModel = model(Laboratorio::class);
        $this->instructorModel = model(Instructor::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $idLab = $request->getPost("idLab");
        $noCarnetInstructor = $request->getPost("noCarnet");

        // Verificar la existencia del laboratorio y instructor
        $existingLaboratorio = $this->EncargadoLlab->find($idLab);
        $existingInstructor = $this->instructorModel->find($noCarnetInstructor);

        if (!$existingLaboratorio) {
            echo json_encode(["mensaje" => "Laboratorio no encontrado"]);
            return;
        }

        if (!$existingInstructor) {
            echo json_encode(["mensaje" => "Instructir no encontrado"]);
            return;
        }

        $data = [
            "idLab" => $idLab,
            "noCarnet" => $noCarnetInstructor,
            "fechaEntrada" => $request->getPost("fechaEntrada"),
            "fechaSalida" => $request->getPost("fechaSalida")
        ];

        if ($this->EncargadoLlab->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->EncargadoLlab->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost("idEncargado");

        // Verificar si el registro existe
        $existingInCharger = $this->EncargadoLlab->find($id);
        if (!$existingInCharger) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }
        $idLab = $request->getPost("idLab");
        $noCarnetInstructor = $request->getPost("noCarnet");

        // Verificar la existencia del laboratorio y instructor
        $existingLaboratorio = $this->EncargadoLlab->find($idLab);
        $existingInstructor = $this->instructorModel->find($noCarnetInstructor);

        if (!$existingLaboratorio) {
            echo json_encode(["mensaje" => "Laboratorio no encontrado"]);
            return;
        }

        if (!$existingInstructor) {
            echo json_encode(["mensaje" => "Instructir no encontrado"]);
            return;
        }

        $data = [
            "idLab" => $idLab ?? $existingInCharger['idLab'],
            "noCarnet" => $noCarnetInstructor ?? $existingInCharger['noCarnet'],
            "fechaEntrada" => $request->getPost("fechaEntrada") ?? $existingInCharger['fechaEntrada'],
            "fechaSalida" => $request->getPost("fechaSalida") ?? $existingInCharger['fechaSalida'] 
        ];


        if ($this->EncargadoLlab->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->EncargadoLlab->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }


    public function getAll()
    {
        try {
            $inCharge = $this->EncargadoLlab->findAll();

            if (empty($inCharge)) {
                echo json_encode(["mensaje" => "No se encontraron encargados de los laboratorios"]);
            } else {
                echo json_encode($inCharge);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function delete()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idEncargado");


        $existingInCharge = $this->EncargadoLlab->find($id);
        if (!$existingInCharge) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }
        $this->EncargadoLlab->delete($id);
        echo json_encode(["mensaje" => "el registro ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idEncargado");
        $inCharge = $this->EncargadoLlab->find($id);

        if ($inCharge != null) {
            echo json_encode($inCharge);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
