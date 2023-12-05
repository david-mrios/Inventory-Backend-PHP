<?php

namespace App\Models;

use CodeIgniter\Model;

class userRole extends Model
{
    protected $table = 'user_rol';
    protected $primaryKey       = 'id_role';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['role_name', 'role_description'];


    // Validation
    protected $validationRules = [
        'role_name'  => 'required|max_length[30]|alpha_space|is_unique[user_rol.role_name]',
        'role_description' => 'required|max_length[254]'
    ];
    protected $validationMessages = [
        'role_name' => [
            'required' => 'El campo nombre del rol es obligatorio.',
            'max_length' => 'El campo nombre del rol no debe exceder los 30 caracteres.',
            'alpha_space' => 'El campo nombre del rol solo puede contener caracteres alfanuméricos y espacios.',
            'is_unique' => 'El nombre del rol  ya está en uso. Por favor, elige otro.',
        ],
        'role_description' => [
            'required' => 'El campo descripción del rol es obligatorio.',
            'max_length' => 'El campo descripción del rol no debe exceder los 254 caracteres.',
        ],
    ];
    protected $skipValidation = false;
}
