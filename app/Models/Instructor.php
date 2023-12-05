<?php

namespace App\Models;

use CodeIgniter\Model;

class Instructor extends Model
{
    protected $table = 'Instructor';
    protected $primaryKey = 'noCarnet';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['noCarnet','nombres', 'apellidos', 'telefono', 'cedula'];

    // Dates

    // Validation
    protected $validationRules = [
        'noCarnet' => 'required|integer|exact_length[8]|is_unique[Instructor.noCarnet]',
        'nombres' => 'required|min_length[3]|alpha_numeric_space',
        'apellidos' => 'required|min_length[4]|alpha_numeric_space',
        'telefono' => 'required|min_length[8]',
        'cedula' => 'required|min_length[14]|is_unique[Instructor.cedula]',
    ];

    protected $validationMessages = [
        'noCarnet' => [
            'exact_length' => 'Para que el número de carnet sea válido se necesita al menos 8digitos',
            'integer' => 'Solo son valido números enteros.',
            'required' => 'Por favor ingresar su nombre'
        ],
        'nombres' => [ 
            'alpha_numeric_space' => 'Nombre no válido',
            'required' => 'Por favor ingresar su nombre'
        ],

        'apellidos' => [
            'alpha_numeric_space' => 'Apellido no válido',
            'required' => 'Por favor ingresar su apellidos'
        ],

        'telefono' => [
            'min_length' => 'Número de teléfono no válido',
            'required' => 'Por favor ingresar su número de teléfono'
        ],

        'cedula' => [
            'min_length' => 'Número de cédula no válido',
            'required' => 'Por favor ingrese su número de cédula',
            'is_unique' => 'Este número de cédula ya existe'
        ]
    ];

    protected $skipValidation = false;
}
