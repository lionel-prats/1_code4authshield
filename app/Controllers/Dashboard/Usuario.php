<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

// v181
class Usuario extends BaseController
{
    // GET http://localhost:8080/dashboard/usuario
    public function index() 
    {
        // 2 formas de instanciar el modelo Usuario (definido internamente por Shield) // v181
        $user_model = auth()->getProvider();
        // $user_model = model("UserModel");

        $usuarios = $user_model->find();
        $data = [
            "title" => "Listado usuarios",
            "usuarios" => $usuarios,
        ];
        return view("dashboard/usuario/index", $data);
    }
    // GET http://localhost:8080/dashboard/usuario/$id_usuario
    public function show($id_usuario) 
    {
        $user_model = model("UserModel");
        $usuario = $user_model->find($id_usuario);
        $data = [
            "title" => "Detalle usuario",
            "usuario" => $usuario,
        ];
        return view("dashboard/usuario/show", $data);
    }

}
