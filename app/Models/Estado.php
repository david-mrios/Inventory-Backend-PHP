<?php

namespace App\Models;

use CodeIgniter\Model;

class Estado extends Model
{
    protected $table = 'Estado';
    protected $primaryKey = 'idEstado';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['estado'];

    // Dates

    // Validation
    protected $validationRules = [
        'estado' => 'required|min_length[3]|alpha_numeric_space'
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'estado' => [
            'alpha_numeric_space' => 'Estado no válido',
            'required' => 'Por favor ingresar el estado del equipo'
        ]
    ];

    protected $skipValidation = false;
}
