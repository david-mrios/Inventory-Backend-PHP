<?php

namespace App\Models;

use CodeIgniter\Model;

class detalleMovEqMob extends Model
{
    protected $table = 'detalleMovEqMob';
    protected $primaryKey = 'idDetalleMovEqMob';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['noMovimiento', 'idEquipoMobiliario'];

    // Dates

    // Validation
    protected $validationRules = [
        'noMovimiento' => 'required',
        'idEquipoMobiliario' => 'required|is_natural_no_zero',
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'noMovimiento' => [
            'required' => 'Por favor ingresar el número de movimiento',
        ],

        'idEquipoMobiliario' => [
            'is_natural_no_zero' => 'El ID es nulo',
            'required' => 'Por favor ingresar un ID'
        ]
    ];

    protected $skipValidation = false;
}
