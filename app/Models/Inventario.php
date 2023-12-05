<?php

namespace App\Models;

use CodeIgniter\Model;

class Inventario extends Model
{
    protected $table = 'Inventario';
    protected $primaryKey = 'idInventario';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'NumInventario', 'idFacultad', 'idRecinto', 'idDependencia',
        'ResponsableInss', 'CustodioInss', 'FechaIngreso'
    ];

    // Validation
    protected $validationRules = [
        'NumInventario' => 'required|is_unique[Inventario.NumInventario]',
        'idFacultad' => 'required|is_natural_no_zero',
        'idRecinto' => 'required|is_natural_no_zero',
        'idDependencia' => 'required|is_natural_no_zero',
        'ResponsableInss' => 'required|min_length[8]',
        'CustodioInss' => 'required|min_length[8]',
        'FechaIngreso' =>  'required|valid_date[Y-m-d H:i:s]'
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'NumInventario' => [
            'required' => 'Por favor ingresar el numero de inventario',
            'is_unique' => 'Este número de inventario ya existe'
        ],

        'idFacultad' => [
            'required' => 'Por favor ingresar el id de la facultad',
            'is_natural_no_zero' => 'Ingrese un ID válido'
        ],

        'idRecinto' => [
            'is_natural_no_zero' => 'ID no válido',
            'required' => 'Por favor ingresar un ID de recinto'
        ],

        'idDependencia' => [
            'is_natural_no_zero' => 'Número de etiqueta no válido',
            'required' => 'Por favor ingrese la etiqueta del equipo'
        ],

        'ResponsableInss' => [
            'required' => 'Se requiere el INSS del responsable',
            'min_length' => 'Número de INSS no válido'
        ],

        'CustodioInss' => [
            'required' => 'Se requiere el INSS del custodio',
            'min_length' => 'Ingrese un número de INSS válido',
        ],

        'FechaIngreso' => [
            'required' => 'La fecha es requerida',
            'valid_date' => 'Formato de fecha no válido, formato válido [Y-m-d H:i:s]'

        ]
    ];

    protected $skipValidation = false;
}
