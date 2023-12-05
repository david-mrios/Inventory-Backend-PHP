<?php

namespace App\Models;

use CodeIgniter\Model;

class application_user extends Model
{
    protected $table = 'application_user';
    protected $primaryKey       = 'id_application_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['idrole', 'userName', 'names', 'surNames', 'password'];

    protected $validationRules = [
        'idrole' => 'required',
        'userName' => 'required|max_length[30]|alpha_numeric|is_unique[application_user.userName]',
        'names' => 'required|max_length[30]|alpha_space',
        'surNames' => 'required|max_length[30]|alpha_space',
        'password' => 'required|min_length[8]'
    ];

    protected $validationMessages = [
        'idrole' => [
            'required' => 'El campo rol es obligatorio.',
        ],
        'userName' => [
            'required' => 'El campo nombre de usuario es obligatorio.',
            'max_length' => 'El campo nombre de usuario no debe exceder los 30 caracteres.',
            'alpha_numeric' => 'El campo nombre de usuario solo puede contener caracteres alfanuméricos.',
            'is_unique' => 'El nombre de usuario "{userName}" ya está en uso. Por favor, elige otro.'
        ],
        'names' => [
            'required' => 'El campo nombres es obligatorio.',
            'max_length' => 'El campo nombres no debe exceder los 30 caracteres.',
            'alpha_space' => 'El campo nombres solo puede contener caracteres alfabéticos y espacios.'
        ],
        'surNames' => [
            'required' => 'El campo apellidos es obligatorio.',
            'max_length' => 'El campo apellidos no debe exceder los 30 caracteres.',
            'alpha_space' => 'El campo apellidos solo puede contener caracteres alfabéticos y espacios.'
        ],
        'password' => [
            'required' => 'El campo contraseña es obligatorio.',
            'min_length' => 'La contraseña debe tener al menos 8 caracteres.'
        ],
    ];
    protected $skipValidation = false;

    public function getUser($data)
    {
        $user = $this->db->table("application_user");
       $user->where($data);
        return $user->get()->getResultArray();
    }
    

}
