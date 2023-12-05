<?php

namespace App\Controllers;

use App\Models\detalleMovEqTec;
use App\Models\Movimiento;
use App\Models\EquipoTecnologico;

class detalleMovEqTecCont extends BaseController
{
    private $detalleMovEqTec;
    private $EquipoTecnologicoModel;
    private $MovimientoModel;


    public function __construct()
    {
        $this->detalleMovEqTec = model(detalleMovEqTec::class);
        $this->EquipoTecnologicoModel = model(EquipoTecnologico::class);
        $this->MovimientoModel = model(Movimiento::class);
    }
    public function create()
    {

        $request = \Config\Services::request();

        $noMovimiento = $request->getPost("noMovimiento");
        $idEquipoTecnologico = $request->getPost("idEquipoTecnologico");

        // Verificar la existencia del movmiento y Equipo mobiliario
        $existingMovmiento = $this->MovimientoModel->find($noMovimiento);
        $existingEquipoTecnologico = $this->EquipoTecnologicoModel->find($idEquipoTecnologico);

        if (!$existingMovmiento) {
            echo json_encode(["mensaje" => "Movimiento no encontrado"]);
            return;
        }

        if (!$existingEquipoTecnologico) {
            echo json_encode(["mensaje" => "Equipo tecnologico no encontrado"]);
            return;
        }
        // Verificar si ya existe la relación en los detalles
        $existingRelation = $this->detalleMovEqTec->where([
            'noMovimiento' => $noMovimiento,
            'idEquipoTecnologico' => $idEquipoTecnologico
        ])->first();

        if ($existingRelation) {
            echo json_encode(["mensaje" => "La relación ya existe"]);
            return;
        }

        $data = [
            "noMovimiento" => $noMovimiento,
            "idEquipoTecnologico" => $idEquipoTecnologico
        ];

        if ($this->detalleMovEqTec->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->detalleMovEqTec->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost("idDetalleMovEqTec");

        // Verificar si el registro existe
        $existingDetalle = $this->detalleMovEqTec->find($id);
        if (!$existingDetalle) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        $noMovimiento = $request->getPost("noMovimiento");
        $idEquipoTecnologico = $request->getPost("idEquipoTecnologico");

        // Verificar la existencia del movmiento y Equipo mobiliario
        $existingMovmiento = $this->MovimientoModel->find($noMovimiento);
        $existingEquipoTecnologico = $this->EquipoTecnologicoModel->find($idEquipoTecnologico);

        if (!$existingMovmiento) {
            echo json_encode(["mensaje" => "Movimiento no encontrado"]);
            return;
        }

        if (!$existingEquipoTecnologico) {
            echo json_encode(["mensaje" => "Equipo tecnologico no encontrado"]);
            return;
        }

        $data = [
            "noMovimiento" => $noMovimiento,
            "idEquipoTecnologico" => $idEquipoTecnologico
        ];

        if ($this->detalleMovEqTec->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->detalleMovEqTec->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }
    public function getAll()
    {
        try {
            $detail = $this->detalleMovEqTec->findAll();

            if (empty($detail)) {
                echo json_encode(["mensaje" => "No se encontraron detalles de movimiento  de equipos tecnologicos"]);
            } else {
                echo json_encode($detail);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function delete()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idDetalleMovEqTec");

        $existingDetalle = $this->detalleMovEqTec->find($id);
        if (!$existingDetalle) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        $this->detalleMovEqTec->delete($id);
        echo json_encode(["mensaje" => "El detalle de movimientos de equipo tecnologico ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idDetalleMovEqTec");
        $detail = $this->detalleMovEqTec->find($id);

        if ($detail != null) {
            echo json_encode($detail);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
