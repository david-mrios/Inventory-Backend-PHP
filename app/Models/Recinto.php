<?php

namespace App\Models;

use CodeIgniter\Model;

class Recinto extends Model
{
    protected $table = 'Recinto';
    protected $primaryKey = 'idRecinto';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['Recinto'];


    // Validation
    protected $validationRules = [
        'Recinto' => 'required|min_length[3]|alpha_numeric_space'
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'Recinto' => [
            'alpha_numeric_space' => 'Recinto universitario no válido',
            'required' => 'Por favor ingresar el recinto universitario'
        ]
    ];

    protected $skipValidation = false;
}
