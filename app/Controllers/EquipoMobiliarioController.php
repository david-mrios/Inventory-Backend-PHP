<?php

namespace App\Controllers;

use App\Models\EquipoMobiliario;
use App\Models\Custodio;


class EquipoMobiliarioController extends BaseController
{
    private $custidioInss;
    private $EquipoMobiliarioModel;


    public function __construct()
    {
        $this->custidioInss = model(Custodio::class);

        $this->EquipoMobiliarioModel = model(EquipoMobiliario::class);
    }
    public function create()
    {
        $request = \Config\Services::request();


        $inssCustodio = $request->getPost("inss");

        $existingCustodio = $this->custidioInss->find($inssCustodio);

        if (!$existingCustodio) {
            echo json_encode(["mensaje" => "Custodio no encontrado"]);
            return;
        }



        $data = [
            "inss" => $inssCustodio,
            "numeroArticulo" => $request->getPost("numeroArticulo"),
            "etiqueta" => $request->getPost("etiqueta"),
            "codigo" => $request->getPost("codigo"),
            "cantidad" => $request->getPost("cantidad"),
            "descripcion" => $request->getPost("descripcion"),
            "costo" => $request->getPost("costo"),
            "idEstado" => $request->getPost("idEstado"),
            "observacion" => $request->getPost("observacion")
        ];

        if ($this->EquipoMobiliarioModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->EquipoMobiliarioModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost("idEquipoMobiliario");

        // Verificar si el registro existe
        $existingEquipoMobiliario = $this->EquipoMobiliarioModel->find($id);
        if (!$existingEquipoMobiliario) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }


        $inssCustodio = $request->getPost("inss");

        $existingCustodio = $this->custidioInss->find($inssCustodio);

        if (!$existingCustodio) {
            echo json_encode(["mensaje" => "Custodio no encontrado"]);
            return;
        }


        // El codigo, etiqueta no se actualizan ya que deben ser unicos.
        $data = [
            "inss" => $inssCustodio ??  $existingEquipoMobiliario['inss'], // Por si los datos no se envian
            "cantidad" => $request->getPost("cantidad") ?? $existingEquipoMobiliario ['cantidad'],
            "descripcion" => $request->getPost("descripcion")?? $existingEquipoMobiliario ['descripcion'],
            "costo" => $request->getPost("costo")?? $existingEquipoMobiliario ['costo'],
            "idEstado" => $request->getPost("idEstado")?? $existingEquipoMobiliario ['idEstado'],
            "observacion" => $request->getPost("observacion") ?? $existingEquipoMobiliario ['observacion']
        ];


        if ($this->EquipoMobiliarioModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->EquipoMobiliarioModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizados"]);
        }
    }

    public function getAll()
    {
        try {
            $Equipo = $this->EquipoMobiliarioModel->findAll();

            if (empty($Equipo)) {
                echo json_encode(["mensaje" => "No se encontraron Equipos mobiliarios"]);
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
        $id = $request->getPost("idEquipoMobiliario");

        $existingEquipoMobiliario = $this->EquipoMobiliarioModel->find($id);
        if (!$existingEquipoMobiliario) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }
        $this->EquipoMobiliarioModel->delete($id);
        echo json_encode(["mensaje" => "el registro ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("idEquipoMobiliario");
        $EquipoMobiliario = $this->EquipoMobiliarioModel->find($id);

        if ($EquipoMobiliario != null) {
            echo json_encode($EquipoMobiliario);
        } else {
            echo json_encode(['mensaje' => 'Registro no encontrado']);
        }
    }
} // Fin de la clase
