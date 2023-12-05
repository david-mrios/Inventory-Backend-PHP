<?php

namespace App\Models;

use CodeIgniter\Model;

class Responsable extends Model
{
    protected $table = 'Responsable';
    protected $primaryKey = 'inss';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['inss', 'nombres', 'apellidos', 'telefono', 'cedula'];
    // Validation
    protected $validationRules = [
        'inss' => 'required|min_length[8]|numeric|max_length[8]|is_unique[Responsable.inss]',
        'nombres' => 'required|min_length[3]|alpha_numeric_space',
        'apellidos' => 'required|min_length[4]|alpha_numeric_space',
        'telefono' => 'required|min_length[8]',
        'cedula' => 'required|min_length[14]|is_unique[Responsable.cedula]',
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'inss' => [
            'min_length' => 'Para que el número inss sea válido se necesita al menos 8 digitos',
            'max_length' => 'Para que el número inss sea válido se necesita un maximo de 8 digitos',
            'required' => 'Por favor ingresar su número de inss'
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
            'min_length' => 'Número de cedula no válido',
            'required' => 'Por favor ingrese su número de cedula',
            'is_unique' => 'Este número de cedula ya está en uso'
        ]
    ];

    protected $skipValidation = false;
}
