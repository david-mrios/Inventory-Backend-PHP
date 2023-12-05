<?php

namespace App\Controllers;

use App\Models\Detalle_Inv_EqTecnologico;
use App\Models\Inventario;
use App\Models\EquipoTecnologico;

class Detalle_Inv_EqTecnologicoCont extends BaseController
{

    private $Detalle_Inv_EqTecnologicoModel;
    private $EquipoTecnologicoModel;
    private $InventarioModel;


    public function __construct()
    {
        $this->Detalle_Inv_EqTecnologicoModel = model(Detalle_Inv_EqTecnologico::class);
        $this->EquipoTecnologicoModel = model(EquipoTecnologico::class);
        $this->InventarioModel = model(Inventario::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $idInventario = $request->getPost("idInventario");
        $idEquipoTecnologico = $request->getPost("idEquipoTecnologico");

        // Verificar la existencia de Inventario y Equipo tecnologico
        $existingInventario = $this->InventarioModel->find($idInventario);
        $existingEquipoTecnologico = $this->EquipoTecnologicoModel->find($idEquipoTecnologico);

        if (!$existingInventario) {
            echo json_encode(["mensaje" => "Inventario no encontrado"]);
            return;
        }

        if (!$existingEquipoTecnologico) {
            echo json_encode(["mensaje" => "Equipo tecnologico no encontrado"]);
            return;
        }
        // Verificar si ya existe la relación en Detalle_Inv_EqMobiliario
        $existingRelation = $this->Detalle_Inv_EqTecnologicoModel->where([
            'idInventario' => $idInventario,
            'idEquipoTecnologico' => $idEquipoTecnologico
        ])->first();

        if ($existingRelation) {
            echo json_encode(["mensaje" => "La relación ya existe"]);
            return;
        }

        $data = [
            "idInventario" => $idInventario,
            "idEquipoTecnologico" => $idEquipoTecnologico
        ];

        if ($this->Detalle_Inv_EqTecnologicoModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->Detalle_Inv_EqTecnologicoModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idDetalleInv");

        // Verificar si el registro existe
        $existingDetalle = $this->Detalle_Inv_EqTecnologicoModel->find($id);
        if (!$existingDetalle) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        $idInventario = $request->getPost("idInventario");
        $idEquipoTecnologico = $request->getPost("idEquipoTecnologico");

        // Verificar la existencia de Inventario y Equipo tecnologico
        $existingInventario = $this->InventarioModel->find($idInventario);
        $existingEquipoTecnologico = $this->EquipoTecnologicoModel->find($idEquipoTecnologico);

        if (!$existingInventario) {
            echo json_encode(["mensaje" => "Inventario no encontrado"]);
            return;
        }

        if (!$existingEquipoTecnologico) {
            echo json_encode(["mensaje" => "Equipo tecnologico no encontrado"]);
            return;
        }

        $data = [
            "idInventario" => $idInventario,
            "idEquipoTecnologico" => $idEquipoTecnologico
        ];


        if ($this->Detalle_Inv_EqTecnologicoModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->Detalle_Inv_EqTecnologicoModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }


    public function getAll()
    {
        try {
            $detail = $this->Detalle_Inv_EqTecnologicoModel->findAll();

            if (empty($detail)) {
                echo json_encode(["mensaje" => "No se encontraron detalles de inventario  de equipos tecnologicos"]);
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
        $id = $request->getPost("idDetalleInv");

        $existingDetalle = $this->Detalle_Inv_EqTecnologicoModel->find($id);
        if (!$existingDetalle) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }


        $this->Detalle_Inv_EqTecnologicoModel->delete($id);
        echo json_encode(["mensaje" => "El detalle de equipo tecnologico ha sido eliminado"]);
    }
    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idDetalleInv");
        $detail = $this->Detalle_Inv_EqTecnologicoModel->find($id);
        if ($detail != null) {
            echo json_encode($detail);
        } else {
            echo json_encode(["mensaje" => "El registro no se ha encontrado no ha sido encontrado"]);
        }
    }
} // Fin de la clase
