<?php

namespace App\Models;

use CodeIgniter\Model;

class Detalle_Inv_EqMobiliario extends Model
{
    protected $table = 'Detalle_Inv_EqMobiliario';
    protected $primaryKey = 'idDetalleInv';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['idInventario', 'idEquipoMobiliario'];


    // Validation
    protected $validationRules = [
        'idInventario' => 'required|is_natural_no_zero',
        'idEquipoMobiliario' => 'required|is_natural_no_zero',
    ];

    protected $validationMessages = [
        'idInventario' => [
            'required' => 'Por favor ingresar un ID de inventario',
            'is_natural_no_zero' => 'El ID no puede ser nulo'
        ],

        'idEquipoMobiliario' => [
            'is_natural_no_zero' => 'El ID no puede ser nulo',
            'required' => 'Por favor ingresar un ID'
        ]
    ];

    protected $skipValidation = false;
}
