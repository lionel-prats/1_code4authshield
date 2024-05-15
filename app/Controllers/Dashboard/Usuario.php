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
        // instancia de GroupModel (/vendor/codeigniter4/shield/src/Models/GroupModel.php)
        $group_model = model("GroupModel");
        // obtenemos todos los registros de auth_groups_users (por default en formato array de arrays) (v183)
        $registros_tabla_auth_groups_users = $group_model->find();
        // utilizando el metodo asObject() recibimos la informacion en formato array de objetos (v183)
        $registros_tabla_auth_groups_users = $group_model->asObject()->find();

        $user_model = model("UserModel");

        // accedo al contenido del archivo de configuracion /app/config/AuthGroups.php (creado cuando ejecutamos el comando "php spark shield:setup" en el v176) (v183)
        $AuthGroups_content = config("AuthGroups");
        // ddl($AuthGroups_content->groups);
        // ddl($AuthGroups_content->permissions);
        // ddl($AuthGroups_content->matrix);

        $usuario = $user_model->find($id_usuario);
        $data = [
            "title" => "Detalle usuario",
            "usuario" => $usuario,
            "groups" => $AuthGroups_content->groups,
            "permissions" => $AuthGroups_content->permissions,
        ];
        return view("dashboard/usuario/show", $data);
    }

    //v186
    // este metodo lo creé en el video 186 para hacer la demo de como gestionar permisos de un usuario ("CRUD" tabla auth_permissions_users) vvv
    // GET http://localhost:8080/dashboard/usuario/gestionar_permisos/$id_usuario
    public function gestionar_permisos($id_usuario) {
        $user_model = model("UserModel");

        $action = "eliminó";
        $permission = "users.create";
        
        if($action == "agregó") {
            $user_model->find($id_usuario)->addPermission($permission);
            echo "Se $action el permiso \"$permission\" al usuario $id_usuario";
        } elseif($action == "eliminó") {
            $user_model->find($id_usuario)->removePermission($permission);
            echo "Se $action el permiso \"$permission\" al usuario $id_usuario";
        } else {
            echo "error";
        }
    }
    
    //v186
    // este metodo lo creé en el video 186 para hacer la demo de como gestionar grupos de un usuario ("CRUD" tabla auth_groups_users) vvv
    // GET http://localhost:8080/dashboard/usuario/gestionar_grupos/$id_usuario
    public function gestionar_grupos($id_usuario) {
        $user_model = model("UserModel");

        $action = "eliminado";
        $group = "beta";
        
        if($action == "agregado") {
            $user_model->find($id_usuario)->addGroup($group);
        } elseif($action == "eliminado") {
            $user_model->find($id_usuario)->removeGroup($group);
        }
        echo "El usuario $id_usuario ha sido $action al grupo \"$group\"";
    }

    // v187
    // POST http://localhost:8080/dashboard/usuario/$id_usuario/manejar_permisos
    public function manejar_permisos($id_usuario) {
        $user_model = model("UserModel");
        $usuario = $user_model->find($id_usuario);
        $permiso = $this->request->getPost("permiso");
        if($usuario->can($permiso)) {
            $usuario->removePermission($permiso);
            $resulatdo = "se quitó el permiso";
        } else {
            $usuario->addPermission($permiso);
            $resulatdo = "se agragó el permiso";
        }
        echo json_encode([
            "id_usuario" => $id_usuario,
            "permiso" => $permiso,
            "resultado" => $resulatdo
        ]);
        exit;
    }
}
