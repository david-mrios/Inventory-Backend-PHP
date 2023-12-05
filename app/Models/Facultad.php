<?php

namespace App\Models;

use CodeIgniter\Model;

class Facultad extends Model
{
    protected $table = 'Facultad';
    protected $primaryKey = 'idFacultad';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['Facultdad'];

    // Dates

    // Validation
    protected $validationRules = [
        'Facultdad' => 'required|min_length[3]|alpha_numeric_space'
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'Facultdad' => [
            'alpha_numeric_space' => 'Facultad no válida',
            'required' => 'Por favor ingresar la facultad'
        ]
    ];

    protected $skipValidation = false;
}
