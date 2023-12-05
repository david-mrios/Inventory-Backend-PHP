<?php

namespace App\Controllers;

use App\Models\Inventario;
use App\Models\Facultad;
use App\Models\Recinto;
use App\Models\Dependencia;
use App\Models\Responsable;
use App\Models\Custodio;


class inventarioController extends BaseController
{
    private $InventarioModel;
    private $FacultadModel;
    private $RecintoModel;
    private $DependenciaModel;
    private $ResponsableModel;
    private $CustodioModel;



    public function __construct()
    {
        $this->InventarioModel = model(Inventario::class);
        $this->FacultadModel = model(Facultad::class);
        $this->RecintoModel = model(Recinto::class);
        $this->DependenciaModel = model(Dependencia::class);
        $this->ResponsableModel = model(Responsable::class);
        $this->CustodioModel = model(Custodio::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $idFacultad = $request->getPost("idFacultad");
        $idRecinto = $request->getPost("idRecinto");
        $idDependencia = $request->getPost("idDependencia");
        $ResponsableInss = $request->getPost("ResponsableInss");
        $CustodioInss = $request->getPost("CustodioInss");

        // Compronbar si existe las llaves foreaneas
        $existingFaculdad = $this->FacultadModel->find($idFacultad);
        $existingRecinto = $this->RecintoModel->find($idRecinto);
        $existingDependencia = $this->DependenciaModel->find($idDependencia);
        $existingResposanble = $this->ResponsableModel->find($ResponsableInss);
        $existingCustodio = $this->CustodioModel->find($CustodioInss);

        if (!$existingFaculdad) {
            echo json_encode(["mensaje" => "Facultdad no encontrado"]);
            return;
        }

        if (!$existingRecinto) {
            echo json_encode(["mensaje" => "Recinto no encontrado"]);
            return;
        }

        if (!$existingDependencia) {
            echo json_encode(["mensaje" => "Departamento no encontrado"]);
            return;
        }

        if (!$existingResposanble) {
            echo json_encode(["mensaje" => "Responsable no encontrado"]);
            return;
        }

        if (!$existingCustodio) {
            echo json_encode(["mensaje" => "Custodio no encontrado"]);
            return;
        }

        $data = [
            "NumInventario" => $request->getPost("NumInventario"),
            "idFacultad" => $idFacultad,
            "idRecinto" => $idRecinto,
            "idDependencia" => $idDependencia,
            "ResponsableInss" => $ResponsableInss,
            "CustodioInss" => $CustodioInss,
            "FechaIngreso" => $request->getPost("FechaIngreso")
        ];

        if ($this->InventarioModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->InventarioModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idInventario");

        // Verificar si el registro existe
        $existingInventory = $this->InventarioModel->find($id);
        if (!$existingInventory) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        $idFacultad = $request->getPost("idFacultad");
        $idRecinto = $request->getPost("idRecinto");
        $idDependencia = $request->getPost("idDependencia");
        $ResponsableInss = $request->getPost("ResponsableInss");
        $CustodioInss = $request->getPost("CustodioInss");

        // Compronbar si existe las llaves foreaneas
        $existingFaculdad = $this->FacultadModel->find($idFacultad);
        $existingRecinto = $this->RecintoModel->find($idRecinto);
        $existingDependencia = $this->DependenciaModel->find($idDependencia);
        $existingResposanble = $this->ResponsableModel->find($ResponsableInss);
        $existingCustodio = $this->CustodioModel->find($CustodioInss);

        if (!$existingFaculdad) {
            echo json_encode(["mensaje" => "Facultdad no encontrado"]);
            return;
        }

        if (!$existingRecinto) {
            echo json_encode(["mensaje" => "Recinto no encontrado"]);
            return;
        }

        if (!$existingDependencia) {
            echo json_encode(["mensaje" => "Departamento no encontrado"]);
            return;
        }

        if (!$existingResposanble) {
            echo json_encode(["mensaje" => "Responsable no encontrado"]);
            return;
        }

        if (!$existingCustodio) {
            echo json_encode(["mensaje" => "Custodio no encontrado"]);
            return;
        }

        $data = [
            "idFacultad" => $idFacultad ?? $existingInventory['idFacultad'] ,
            "idRecinto" => $idRecinto ?? $existingInventory['idRecinto'],
            "idDependencia" => $idDependencia ?? $existingInventory['idDependencia'],
            "ResponsableInss" => $ResponsableInss ?? $existingInventory['ResponsableInss'],
            "CustodioInss" => $CustodioInss ?? $existingInventory['FechaIngreso'],
            "FechaIngreso" => $request->getPost("FechaIngreso") ?? $existingInventory['FechaIngreso']
        ];

        if ($this->InventarioModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->InventarioModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

    public function getAll()
    {

        try {
            $Inventory = $this->InventarioModel->findAll();

            if (empty($Inventory)) {
                echo json_encode(["mensaje" => "No se encontraron inventarios"]);
            } else {
                echo json_encode($Inventory);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function delete()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idInventario");

        // Verificar si el registro existe
        $existingInventory = $this->InventarioModel->find($id);
        if (!$existingInventory) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        $this->InventarioModel->delete($id);
        echo json_encode(["mensaje" => "El registro ha sido eliminado"]);
    }
    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idInventario");
        $Inventory = $this->InventarioModel->find($id);

        if ($Inventory != null) {
            echo json_encode($Inventory);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
