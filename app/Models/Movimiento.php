<?php

namespace App\Models;

use CodeIgniter\Model;

class Movimiento extends Model
{
    protected $table = 'Movimiento';
    protected $primaryKey = 'noMovimiento';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = ['inss', 'idLab', 'idTpMovimiento', 'Fecha', 'LocacionNueva', 'Observacion'];

    // Dates

    // Validation
    protected $validationRules = [
        'inss' => 'required|min_length[8]|alpha_numeric_space',
        'idLab' => 'required|is_natural_no_zero',
        'idTpMovimiento' => 'required|is_natural_no_zero',
        'Fecha' => 'required|valid_date[Y-m-d H:i:s]',
        'LocacionNueva' => 'required|alpha_numeric_space',
        'Observacion' => 'required|alpha_numeric_space'
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'inss' => [
            'alpha_numeric_space' => 'El INSS ingresado no es válido',
            'required' => 'Por favor ingresar su número de INSS',
            'min_length' => 'Ingresar un INSS válido, por favor'
        ],

        'idLab' => [
            'is_natural_no_zero' => 'El ID es nulo',
            'required' => 'Por favor ingresar el ID del laboratorio'
        ],

        'idTpMovimiento' => [
            'is_natural_no_zero' => 'El ID es nulo',
            'required' => 'Por favor ingresar el ID del tipo de movimiento'
        ],

        'Fecha' => [
            'required' => 'Por favor ingrese la fecha',
            'valid_date' => 'Formato de fecha no válido, formato válido [Y-m-d H:i:s]'

        ],

        'LocacionNueva' => [
            'required' => 'La locación nueva es requerida',
            'alpha_numeric_space' => 'La locación no es válida'
        ],

        'Observacion' => [
            'required' => 'Por favor ingresar una observación',
            'alpha_numeric_space' => 'La observación no es válida'
        ],
    ];

    protected $skipValidation = false;
}
