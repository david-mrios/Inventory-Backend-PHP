<?php

namespace App\Models;

use CodeIgniter\Model;

class Laboratorio extends Model
{
    protected $table = 'Laboratorio';
    protected $primaryKey = 'idLab';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['numeroLab'];


    // Validation
    protected $validationRules = [
        'numeroLab' => 'required'
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'numeroLab' => [
            'required' => 'Por favor ingresar el número de laboratorio'
        ]
    ];

    protected $skipValidation = false;
}
