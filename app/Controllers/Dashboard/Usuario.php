<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

// v181
class Usuario extends BaseController
{
    public function index() 
    {
        $user_model = auth()->getProvider();
        // $user_model = model("UserModel");
        $usuarios = $user_model->find();
        $data = [
            "title" => "Usuario",
            "usuarios" => $usuarios,
        ];
        return view("dashboard/usuario/index", $data);
    }

}
