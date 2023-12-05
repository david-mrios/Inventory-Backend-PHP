<?php

namespace App\Controllers;

use App\Models\application_user;
use App\Models\userRole;


class application_user_controller extends BaseController
{
    protected $session = null;
    private $UserAplicactionModel;
    private $RoleModel;


    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->UserAplicactionModel = model(application_user::class);
        $this->RoleModel = model(userRole::class);
    }
    public function create()
    {
        $request = \Config\Services::request();

        $idrole = $request->getPost("idrole");
        $existingRole = $this->RoleModel->find($idrole);


        if (!$existingRole) {
            echo json_encode(["mensaje" => "Rol no encontrado"]);
            return;
        }

        $password = trim($request->getPost("password"));

        $data = [
            "idrole" => $idrole,
            "userName" => $request->getPost("userName"),
            "names" => $request->getPost("names"),
            "surNames" => $request->getPost("surNames"),
            // Cifrar la contraseña antes de almacenarla en la base de datos
            "password" => password_hash($password, PASSWORD_DEFAULT)
        ];

        if ($this->UserAplicactionModel->insert($data) === false) {
            echo json_encode(["mensaje error" => $this->UserAplicactionModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Registro Guardado"]);
        }
    }

    public function update()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("id_application_user");

        // Verificar si el registro existe
        $existingUser = $this->UserAplicactionModel->find($id);
        if (!$existingUser) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }

        // Verificar rol nuevo
        $newRole = $request->getPost("idrole");
        $existingRole = $this->RoleModel->find($newRole);

        if (!$existingRole) {
            echo json_encode(["mensaje" => "Rol no encontrado"]);
            return;
        }

        $newUserName = $request->getPost("userName");

        if ($newUserName !== $existingUser['userName'] && !$this->isUserNameUnique($newUserName)) {
            echo json_encode(["mensaje" => "El nuevo nombre de usuario debe ser unico. Por favor, elige otro."]);
            return;
        }
        $data = [
            "idrole" => $newRole ?? $existingUser['idrole'],
            "userName" => $request->getPost("userName") ?? $existingUser['userName'],
            "names" => $request->getPost("names") ?? $existingUser['names'],
            "surNames" =>  $newUserName ?? $existingUser['surNames'],
        ];

        $newPassword = trim($request->getPost("password"));
        if (!empty($newPassword)) {
            $data["password"] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        // Eliminar el campo surName del array si no se proporciona
        if (!$newUserName) {
            unset($data['surNames']);
        }

        // Realizar la actualización en la base de datos
        if ($this->UserAplicactionModel->update($id, $data) === false) {
            echo json_encode(["mensaje error" => $this->UserAplicactionModel->errors()]);
        } else {
            echo json_encode(["mensaje" => "Los datos se han actualizado"]);
        }
    }
    private function isUserNameUnique($cedula)
    {
        $userName = $this->UserAplicactionModel->where('userName', $cedula)->first();
        return ($userName === null); // Si $username es null el numero es único
    }


    public function getAll()
    {
        try {
            $user = $this->UserAplicactionModel->findAll();

            if (empty($user)) {
                echo json_encode(["mensaje" => "No se encontraron usuarios"]);
            } else {
                echo json_encode($user);
            }
        } catch (\Exception $e) {
            echo json_encode(["mensaje error" => $e->getMessage()]);
        }
    }
    public function deleteLogic()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("id_application_user");

        // Verificar si el registro existe
        $existingUser = $this->UserAplicactionModel->find($id);
        if (!$existingUser) {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
            return;
        }


        $this->UserAplicactionModel->delete($id);
        echo json_encode(["mensaje" => "El rol ha sido eliminado"]);
    }

    public function search()
    {

        $request = \Config\Services::request();
        $id = $request->getPost("id_application_user");

        $user = $this->UserAplicactionModel->find($id);

        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(["mensaje" => "Registro no encontrado"]);
        }
    }

    public function login()
    {
        $request = \Config\Services::request();

        $user = $request->getPost("user");
        $pass =  $request->getPost("pass");


        $data = $this->UserAplicactionModel->getUser(['userName' => $user]);

        if (count($data) > 0 && password_verify($pass, $data[0]['password'])) {

            $newdata = [
                'username'  => $user,
                'logged_in' => true,
            ];

            $this->session->set($newdata);
            // Si se utiliza en php spark serve la direccion va a funcionar 
            return redirect()->to(base_url('Inventory/public'))->with('mensaje', '1');
            // sin php spark serve
            // return redirect()->to(base_url('/Inventory/public/'))->with('mensaje', '1');

        } else {
            echo json_encode(['mensaje de error' => 'Usuario invalido, verifique sus credenciales']);

        }
    }


    public function getSession()
    {
        $userData = $this->session->get();
        echo json_encode($userData);
    }
}
