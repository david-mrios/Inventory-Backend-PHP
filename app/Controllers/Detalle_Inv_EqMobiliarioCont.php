<?php

namespace App\Controllers;

use App\Models\Detalle_Inv_EqMobiliario;
use App\Models\Inventario;
use App\Models\EquipoMobiliario;


class Detalle_Inv_EqMobiliarioCont extends BaseController
{

    private $Detalle_Inv_EqMobiliarioModel;
    private $EquipoMobiliarioModel;
    private $InventarioModel;


    public function __construct()
    {
        $this->Detalle_Inv_EqMobiliarioModel = model(Detalle_Inv_EqMobiliario::class);
        $this->EquipoMobiliarioModel = model(EquipoMobiliario::class);
        $this->InventarioModel = model(Inventario::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $idInventario = $request->getPost("idInventario");
        $idEquipoMobiliario = $request->getPost("idEquipoMobiliario");

        // Verificar la existencia de Inventario y EquipoMobiliario
        $existingInventario = $this->InventarioModel->find($idInventario);
        $existingEquipoMobiliario = $this->EquipoMobiliarioModel->find($idEquipoMobiliario);

        if (!$existingInventario) {
            echo json_encode(["mensaje" => "Inventario no encontrado"]);
            return;
        }

        if (!$existingEquipoMobiliario) {
            echo json_encode(["mensaje" => "Equipo mobiliario no encontrado"]);
            return;
        }

        // Verificar si ya existe la relación en Detalle_Inv_EqMobiliario
        $existingRelation = $this->Detalle_Inv_EqMobiliarioModel->where([
            'idInventario' => $idInventario,
            'idEquipoMobiliario' => $idEquipoMobiliario
        ])->first();

        if ($existingRelation) {
            echo json_encode(["mensaje" => "La relación ya existe"]);
            return;
        }

        // Si todo está bien realizar la inserción
        $data = [
            "idInventario" => $idInventario,
            "idEquipoMobiliario" => $idEquipoMobiliario
        ];

        if ($this->Detalle_Inv_EqMobiliarioModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->Detalle_Inv_EqMobiliarioModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }


    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost("idDetalleInv");
    
        // Verificar si el registro existe
        $existingDetalle = $this->Detalle_Inv_EqMobiliarioModel->find($id);
        if (!$existingDetalle) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }
    
        // Obtener datos de la solicitud
        $idInventario = $request->getPost("idInventario");
        $idEquipoMobiliario = $request->getPost("idEquipoMobiliario");
    
        // Verificar la existencia de Inventario y EquipoMobiliario
        $existingInventario = $this->InventarioModel->find($idInventario);
        $existingEquipoMobiliario = $this->EquipoMobiliarioModel->find($idEquipoMobiliario);
    
        if (!$existingInventario) {
            echo json_encode(["mensaje" => "Inventario no encontrado"]);
            return;
        }
    
        if (!$existingEquipoMobiliario) {
            echo json_encode(["mensaje" => "Equipo mobiliario no encontrado"]);
            return;
        }
    
    
        // Si todo está bien, realizar la actualización
        $data = [
            "idInventario" => $idInventario,
            "idEquipoMobiliario" => $idEquipoMobiliario
        ];
    
        if ($this->Detalle_Inv_EqMobiliarioModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->Detalle_Inv_EqMobiliarioModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizado"]);
        }
    }
    
    public function getAll()
    {
        try {
            $detail = $this->Detalle_Inv_EqMobiliarioModel->findAll();

            if (empty($detail)) {
                echo json_encode(["mensaje" => "No se encontraron detalles de inventario  de equipos mobiliarios"]);
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

        $existingDetalle = $this->Detalle_Inv_EqMobiliarioModel->find($id);
        if (!$existingDetalle) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        $this->Detalle_Inv_EqMobiliarioModel->delete($id);
        echo json_encode(["mensaje" => "El registro ha sido eliminado"]);
    }
    public function search()

    {
        $request = \Config\Services::request();
        $id = $request->getPost("idDetalleInv");
        $detail = $this->Detalle_Inv_EqMobiliarioModel->find($id);
        if ($detail != null) {
            echo json_encode($detail);
        } else {
            echo json_encode(["mensaje" => "El custodio no ha sido encontrado"]);
        }
    }
} // Fin de la clase
