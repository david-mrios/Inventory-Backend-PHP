<?php

namespace App\Models;

use CodeIgniter\Model;

class detalleMovEqTec extends Model
{
    protected $table = 'detalleMovEqTec';
    protected $primaryKey = 'idDetalleMovEqTec';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['noMovimiento', 'idEquipoTecnologico'];


    // Validation
    protected $validationRules = [
        'noMovimiento' => 'required',
        'idEquipoTecnologico' => 'required|is_natural_no_zero',
    ];

    protected $validationMessages = [
        'noMovimiento' => [
            'required' => 'Por favor ingresar número de movimiento',
        ],

        'idEquipoTecnologico' => [
            'is_natural_no_zero' => 'El ID es nulo',
            'required' => 'Por favor ingresar un ID'
        ]
    ];

    protected $skipValidation = false;
}
