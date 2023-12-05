<?php

namespace App\Models;

use CodeIgniter\Model;

class Custodio extends Model
{
    protected $table      = 'custodio';
    protected $primaryKey = 'inss';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['inss','nombres', 'apellidos', 'telefono', 'cedula'];

    // Validation
    protected $validationRules      = [
        'inss' => 'required|min_length[8]|integer|max_length[8]|is_unique[Custodio.inss]',
        'nombres' => 'required|min_length[3]|alpha_numeric_space',
        'apellidos' => 'required|min_length[4]|alpha_numeric_space',
        'telefono' => 'required|min_length[8]',
        'cedula' => 'required|min_length[14]|is_unique[Custodio.cedula]'

    ];
    protected $validationMessages   = [
        'inss' => [
            'min_length' => 'Para que el número inss sea válido se necesita al menos 8 digitos',
            'integer' => 'Solo son valido números enteros.',
            'max_length' => 'Para que el número inss sea válido se necesita un maximo de 8 digitos',
            'required' => 'Por favor ingresar su número  de carnet',
            'is_unique' => 'Este número de inss ya existe'

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
            'min_length' => 'Número de telefono no válido',
            'required' => 'Por favor ingresar su número de teléfono'
        ],

        'cedula' => [
            'min_length' => 'Número de cedula no válido',
            'required' => 'Por favor ingrese su número de cedula',
            'is_unique' => 'Este número de cedula ya existe'
        ]

    ];
    protected $skipValidation = false;
}
