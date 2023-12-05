<?php

namespace App\Controllers;

use App\Models\userRole;

class user_role_Controller extends BaseController

{
    private $userRoleModel;

    public function __construct()
    {
        $this->userRoleModel = model(UserRole::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $data = [
            "role_name" => $request->getPost("rol_name"),
            "role_description" => $request->getPost("role_description")
        ];


        if ($this->userRoleModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->userRoleModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Rol creado"]);
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost("id_role");

        $existingRole = $this->userRoleModel->find($id);
        if (!$existingRole) {
            echo json_encode(["mensaje" => "Rol no encontrado"]);
            return;
        }

        $newRoleName = $request->getPost("rol_name");
        $newRoleDescription = $request->getPost("role_description");

        // Verificar si es unico solo si se proporciona un nuevo nombre de rol
        if ($newRoleName !== $existingRole['role_name'] && !$this->isRoleNameUnique($newRoleName)) {
            echo json_encode(["mensaje" => "El nuevo nombre del rol ya está en uso. Por favor, elige otro."]);
            return;
        }

        $data = [
            "role_name" => $newRoleName ?? $existingRole['role_name'],
            "role_description" => $newRoleDescription ?? $existingRole['role_description'],
        ];

        // Eliminar el campo role_name del array si no se proporciona
        if (!$newRoleName) {
            unset($data['role_name']);
        }

        if ($this->userRoleModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->userRoleModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizado"]);
        }
    }

    private function isRoleNameUnique($roleName)
    {
        $role = $this->userRoleModel->where('role_name', $roleName)->first();
        return ($role === null); // Si $role es null el nombre es único
    }



    public function getAll()
    {
        try {
            $roles = $this->userRoleModel->findAll();

            if (empty($roles)) {
                echo json_encode(["mensaje" => "No se encontraron roles"]);
            } else {
                echo json_encode($roles);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }

    public function deleteLogic()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("id_role");

        $existingRole = $this->userRoleModel->find($id);
        if (!$existingRole) {
            echo json_encode(["mensaje" => "Rol no encontrado"]);
            return;
        }

        $this->userRoleModel->delete($id);
        echo json_encode(["mensaje" => "El rol ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("id_role");

        $role = $this->userRoleModel->find($id);

        if ($role) {
            echo json_encode($role);
        } else {
            echo json_encode(["mensaje" => "Rol no encontrado"]);
        }
    }
} // Fin de la clase
