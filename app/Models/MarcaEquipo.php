<?php

namespace App\Models;

use CodeIgniter\Model;

class MarcaEquipo extends Model
{
    protected $table = 'marca_equipo';
    protected $primaryKey = 'idMarca';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['marca'];

    // Validation
    protected $validationRules = [
        'marca' => 'required|alpha_numeric_space'
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'marca' => [
            'alpha_numeric_space' => 'Marca no válida',
            'required' => 'Por favor ingresar la marca'
        ]
    ];

    protected $skipValidation = false;
}
