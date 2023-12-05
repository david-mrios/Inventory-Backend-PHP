<?php

namespace App\Models;

use CodeIgniter\Model;

class Tipo_Movimiento extends Model
{
    protected $table = 'Tipo_Movimiento';
    protected $primaryKey = 'idTipoMovimiento';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['tipoMovimiento'];

    // Dates

    // Validation
    protected $validationRules = [
        'tipoMovimiento' => 'required|min_length[3]|alpha_numeric_space'
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'tipoMovimiento' => [
            'alpha_numeric_space' => 'Por favor ingresar un tipo de movimiento válido',
            'required' => 'El tipo de movimiento es requerido',
            'min_length' => 'Tipo de movimiento no válido'
        ]
    ];

    protected $skipValidation = false;
}
