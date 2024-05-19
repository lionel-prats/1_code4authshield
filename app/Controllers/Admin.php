<?php

namespace App\Controllers;

// v179
class Admin extends Base
{
    protected $title = "Admin";
    protected $content = 'contenido atributo Admin->content';
    protected $permiso = "admin.admin";
    protected $userTieneQueEstarAuth = true;
}
