<?php

namespace App\Models;

use CodeIgniter\Model;

class Detalle_Inv_EqTecnologico extends Model
{
    protected $table = 'Detalle_Inv_EqTecnologico';
    protected $primaryKey = 'idDetalleInv';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['idInventario', 'idEquipoTecnologico'];

    // Validation
    protected $validationRules = [
        'idInventario' => 'required|is_natural_no_zero',
        '   ' => 'required|is_natural_no_zero'
    ];

    protected $validationMessages = [
        'idInventario' => [
            'required' => 'Por favor ingresar el ID del inventario',
            'is_natural_no_zero' => 'El ID es nulo'
        ],

        'idEquipoTecnologico' => [
            'is_natural_no_zero' => 'El ID es nulo',
            'required' => 'Por favor ingresar un ID'
        ]
    ];

    protected $skipValidation = false;
}
