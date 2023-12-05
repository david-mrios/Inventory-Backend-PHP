<?php

namespace App\Models;

use CodeIgniter\Model;

class EncargadoLlab extends Model
{
    protected $table = 'EncargadoLab';
    protected $primaryKey = 'idEncargado';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['idLab', 'noCarnet', 'fechaEntrada', 'fechaSalida'];

    // Validation
    protected $validationRules = [
        'idLab' => 'required|is_natural_no_zero',
        'noCarnet' => 'required',
        'fechaEntrada' => 'required|valid_date[Y-m-d H:i:s]',
        'fechaSalida' => 'required|valid_date[Y-m-d H:i:s]'
    ];

    // Validation Messages
    protected $validationMessages = [
        'idLab' => [
            'is_natural_no_zero' => 'El ID es nulo',
            'required' => 'Por favor ingresar el ID del laboratorio'
        ],

        'noCarnet' => [
            'required' => 'Por favor ingresar su número de carnet'
        ],

        'fechaEntrada' => [
            'required' => 'Por favor ingresar la fecha de entrada',
            'valid_date' => 'Formato de fecha no válido, formato válido [Y-m-d H:i:s]'
        ],

        'fechaSalida' => [
            'required' => 'Por favor ingrese la fecha de salida',
            'valid_date' => 'Formato de fecha no válido, formato válido [Y-m-d H:i:s]'
        ]
    ];

    protected $skipValidation = false;
}
