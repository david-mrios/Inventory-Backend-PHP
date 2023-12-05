<?php

namespace App\Models;

use CodeIgniter\Model;

class Dependencia extends Model
{
    protected $table      = 'Dependencia';
    protected $primaryKey = 'IdDependencia';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['Departamento'];

    // Validation   
    protected $validationRules      = [
        'Departamento' => 'required|min_length[3]|alpha_numeric_space'

    ];
    protected $validationMessages   = [
        'Departamento' => [
            'alpha_numeric_space' => 'Departamento no válido',
            'required' => 'Por favor ingresar el departamento'
        ]
    ];
    protected $skipValidation = false;
}
