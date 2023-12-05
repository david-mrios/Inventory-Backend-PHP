<?php

namespace App\Controllers;

use App\Models\EquipoTecnologico;
use App\Models\Custodio;
use App\Models\MarcaEquipo;



class EquipoTecnologicoController extends BaseController
{
    private $custidioInss;
    private $EquipoTecnologicoModel;
    private $MarcaEquipoModel;



    public function __construct()
    {
        $this->custidioInss = model(Custodio::class);
        $this->MarcaEquipoModel = model(MarcaEquipo::class);

        $this->EquipoTecnologicoModel = model(EquipoTecnologico::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $inssCustodio = $request->getPost("inss");
        $idMarca = $request->getPost("idMarca");

        $existingCustodio = $this->custidioInss->find($inssCustodio);
        $existingMarca = $this->MarcaEquipoModel->find($idMarca);

        if (!$existingCustodio) {
            echo json_encode(["mensaje" => "Custodio no encontrado"]);
            return;
        }

        if (!$existingMarca) {
            echo json_encode(["mensaje" => "Marca de equipo no encontrada"]);
            return;
        }

        $data = [
            "inss" => $inssCustodio,
            "numeroArt" => $request->getPost("numeroArticulo"),
            "etiqueta" => $request->getPost("etiqueta"),
            "codigo" => $request->getPost("codigo"),
            "cantidad" => $request->getPost("cantidad"),
            "descripcion" => $request->getPost("descripcion"),
            "modelo" => $request->getPost("modelo"),
            "idMarca" => $idMarca,
            "serie" => $request->getPost("serie"),
            "costo" => $request->getPost("costo"),
            "idEstado" => $request->getPost("idEstado"),
            "observacion" => $request->getPost("observacion")

        ];

        if ($this->EquipoTecnologicoModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->EquipoTecnologicoModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost("idEquipoTecnologico");

        
        // Verificar si el registro existe
        $existingEquipoTecnologico = $this->EquipoTecnologicoModel->find($id);
        if (!$existingEquipoTecnologico) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        $inssCustodio = $request->getPost("inss");
        $idMarca = $request->getPost("idMarca");

        $existingCustodio = $this->custidioInss->find($inssCustodio);
        $existingMarca = $this->MarcaEquipoModel->find($idMarca);

        if (!$existingCustodio) {
            echo json_encode(["mensaje" => "Custodio no encontrado"]);
            return;
        }

        if (!$existingMarca) {
            echo json_encode(["mensaje" => "Marca de equipo no encontrada"]);
            return;
        }


        $data = [
            "inss" => $inssCustodio ??  $existingEquipoTecnologico['inss'],
            "cantidad" => $request->getPost("cantidad") ??  $existingEquipoTecnologico['cantidad'],
            "descripcion" => $request->getPost("descripcion") ??  $existingEquipoTecnologico['descripcion'],
            "modelo" => $request->getPost("modelo") ??  $existingEquipoTecnologico['modelo'],
            "idMarca" => $idMarca ??  $existingEquipoTecnologico['idMarca'],
            "serie" => $request->getPost("serie") ??  $existingEquipoTecnologico['serie'],
            "costo" => $request->getPost("costo") ??  $existingEquipoTecnologico['costo'],
            "idEstado" => $request->getPost("idEstado") ??  $existingEquipoTecnologico['idEstado'],
            "observacion" => $request->getPost("observacion") ??  $existingEquipoTecnologico['observacion']

        ];


        if ($this->EquipoTecnologicoModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->EquipoTecnologicoModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

    public function getAll()
    {
        try {
            $Equipo = $this->EquipoTecnologicoModel->findAll();

            if (empty($Equipo)) {
                echo json_encode(["mensaje" => "No se encontraron Equipos tecnologicos"]);
            } else {
                echo json_encode($Equipo);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function deleteLogic()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idEquipoTecnologico");

        $existingEquipoTecnologico = $this->EquipoTecnologicoModel->find($id);
        if (!$existingEquipoTecnologico) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }
        $this->EquipoTecnologicoModel->delete($id);
        echo json_encode(["mensaje" => "el registro ha sido eliminado"]);
    }
    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idEquipoTecnologico");
        $EquipoTecnologico = $this->EquipoTecnologicoModel->find($id);

        if ($EquipoTecnologico != null) {
            echo json_encode($EquipoTecnologico);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
