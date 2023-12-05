<?php

namespace App\Controllers;

use App\Models\Movimiento;
use App\Models\Responsable;
use App\Models\Laboratorio;
use App\Models\Tipo_Movimiento;





class movimientoController extends BaseController
{
    private $MovimientoModel;
    private $ResponsableModel;
    private $LabModel;
    private $TipoMovimiento;

    public function __construct()
    {
        $this->MovimientoModel = model(Movimiento::class);
        $this->ResponsableModel = model(Responsable::class);
        $this->LabModel = model(Laboratorio::class);
        $this->TipoMovimiento = model(Tipo_Movimiento::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $inss = $request->getPost("inss");
        $idLab = $request->getPost("idLab");
        $idTpMovimiento = $request->getPost("idTpMovimiento");


        // Comprobar si existe las llaves foreaneas
        $existingResposanble = $this->ResponsableModel->find($inss);
        $existingaboratorio = $this->LabModel->find($idLab);
        $existingTipoMovmiento  = $this->TipoMovimiento->find($idTpMovimiento);

        if (!$existingResposanble) {
            echo json_encode(["mensaje" => "Responsable no encontrado"]);
            return;
        }

        if (!$existingaboratorio) {
            echo json_encode(["mensaje" => "Laboratorio no encontrado"]);
            return;
        }

        if (!$existingTipoMovmiento) {
            echo json_encode(["mensaje" => "Tipo de movmiento no encontrado"]);
            return;
        }



        $data = [
            "inss" => $inss,
            "idLab" =>  $idLab,
            "idTpMovimiento" => $idTpMovimiento ,
            "Fecha" => $request->getPost("Fecha"),
            "LocacionNueva" => $request->getPost("LocacionNueva"),
            "Observacion" => $request->getPost("Observacion")
        ];

        if ($this->MovimientoModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->MovimientoModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {

        $request = \Config\Services::request();
        $noMovimiento = $request->getPost("noMovimiento");

        // Verificar si el registro existe
        $existingMovimiento = $this->MovimientoModel->find($noMovimiento);
        if (!$existingMovimiento) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }


        $inss = $request->getPost("inss");
        $idLab = $request->getPost("idLab");
        $idTpMovimiento = $request->getPost("idTpMovimiento");


        // Compronbar si existe las llaves foreaneas
        $existingResposanble = $this->ResponsableModel->find($inss);
        $existingaboratorio = $this->LabModel->find($idLab);
        $existingTipoMovmiento  = $this->TipoMovimiento->find($idTpMovimiento);

        if (!$existingResposanble) {
            echo json_encode(["mensaje" => "Responsable no encontrado"]);
            return;
        }

        if (!$existingaboratorio) {
            echo json_encode(["mensaje" => "Laboratorio no encontrado"]);
            return;
        }

        if (!$existingTipoMovmiento) {
            echo json_encode(["mensaje" => "Tipo de movmiento no encontrado"]);
            return;
        }

        $data = [
            "inss" => $inss  ?? $existingMovimiento['inss'],
            "idLab" => $idLab ?? $existingMovimiento['idLab'],
            "idTpMovimiento" =>  $idTpMovimiento  ?? $existingMovimiento['idTpMovimiento'],
            "Fecha" => $request->getPost("Fecha") ?? $existingMovimiento['Fecha'],
            "LocacionNueva" => $request->getPost("LocacionNueva") ?? $existingMovimiento['LocacionNueva'],
            "Observacion" => $request->getPost("Observacion") ?? $existingMovimiento['Observacion']
        ];


        if ($this->MovimientoModel->update($noMovimiento, $data) === false) {
            echo json_encode(["mensaje error" => $this->MovimientoModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

    public function getAll()
    {

        try {
            $Movmiento = $this->MovimientoModel->findAll();

            if (empty($Movmiento)) {
                echo json_encode(["mensaje" => "No se encontraron movimientos"]);
            } else {
                echo json_encode($Movmiento);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function delete()
    {

        $request = \Config\Services::request();
        $noMovimiento = $request->getPost("noMovimiento");


        // Verificar si el registro existe
        $existingMovimiento = $this->MovimientoModel->find($noMovimiento);
        if (!$existingMovimiento) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }


        $this->MovimientoModel->delete($noMovimiento);
        echo json_encode(["mensaje" => "El registro ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("noMovimiento");
        $Movimiento = $this->MovimientoModel->find($id);

        if ($Movimiento != null) {
            echo json_encode($Movimiento);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
