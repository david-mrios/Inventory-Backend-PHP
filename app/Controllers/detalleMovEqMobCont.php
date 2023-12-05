<?php

namespace App\Controllers;

use App\Models\detalleMovEqMob;
use App\Models\Movimiento;
use App\Models\EquipoMobiliario;

class detalleMovEqMobCont extends BaseController
{

    private $detalleMovEqMobModel;
    private $EquipoMobiliarioModel;
    private $MovimientoModel;


    public function __construct()
    {
        $this->detalleMovEqMobModel = model(detalleMovEqMob::class);
        $this->EquipoMobiliarioModel = model(EquipoMobiliario::class);
        $this->MovimientoModel = model(Movimiento::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $noMovimiento = $request->getPost("noMovimiento");
        $idEquipoMobiliario = $request->getPost("idEquipoMobiliario");

        // Verificar la existencia del movmiento y Equipo mobiliario
        $existingMovmiento = $this->MovimientoModel->find($noMovimiento);
        $existingEquipoMobiliario = $this->EquipoMobiliarioModel->find($idEquipoMobiliario);

        if (!$existingMovmiento) {
            echo json_encode(["mensaje" => "Movimiento no encontrado"]);
            return;
        }

        if (!$existingEquipoMobiliario) {
            echo json_encode(["mensaje" => "Equipo mobiliario no encontrado"]);
            return;
        }
        // Verificar si ya existe la relación en Detalle_Inv_EqMobiliario
        $existingRelation = $this->detalleMovEqMobModel->where([
            'noMovimiento' => $noMovimiento,
            'idEquipoMobiliario' => $idEquipoMobiliario
        ])->first();

        if ($existingRelation) {
            echo json_encode(["mensaje" => "La relación ya existe"]);
            return;
        }

        $data = [
            "noMovimiento" => $noMovimiento,
            "idEquipoMobiliario" => $idEquipoMobiliario
        ];

        if ($this->detalleMovEqMobModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->detalleMovEqMobModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost("idDetalleMovEqMob");

        
        // Verificar si el registro existe
        $existingDetalle = $this->detalleMovEqMobModel->find($id);
        if (!$existingDetalle) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        $noMovimiento = $request->getPost("noMovimiento");
        $idEquipoMobiliario = $request->getPost("idEquipoMobiliario");

        // Verificar la existencia del movmiento y Equipo mobiliario
        $existingMovmiento = $this->MovimientoModel->find($noMovimiento);
        $existingEquipoMobiliario = $this->EquipoMobiliarioModel->find($idEquipoMobiliario);

        if (!$existingMovmiento) {
            echo json_encode(["mensaje" => "Movimiento no encontrado"]);
            return;
        }

        if (!$existingEquipoMobiliario) {
            echo json_encode(["mensaje" => "Equipo mobiliario no encontrado"]);
            return;
        }

        $data = [
            "noMovimiento" => $noMovimiento,
            "idEquipoMobiliario" => $idEquipoMobiliario
        ];



        if ($this->detalleMovEqMobModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->detalleMovEqMobModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

    public function getAll()
    {
        try {
            $detail = $this->detalleMovEqMobModel->findAll();

            if (empty($detail)) {
                echo json_encode(["mensaje" => "No se encontraron detalles de movimiento  de equipos Mobiliarios"]);
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
        $id = $request->getPost("idDetalleMovEqMob");


        $existingDetalle = $this->detalleMovEqMobModel->find($id);
        if (!$existingDetalle) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }
        $this->detalleMovEqMobModel->delete($id);
        echo json_encode(["mensaje" => "El detalle de movimientos de equipo mobiliario ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idDetalleMovEqMob");
        $detail = $this->detalleMovEqMobModel->find($id);
        if ($detail != null) {
            echo json_encode($detail);
        } else {
            echo json_encode(["mensaje" => "El registro no ha sido encontrado"]);
        }
    }
} // Fin de la clase
