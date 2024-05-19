<?php

namespace App\Controllers;

class Base extends BaseController
{
    protected $title = "Base";
    protected $content = "Base";
    protected $permiso = "";
    protected $userTieneQueEstarAuth = false;
    
    /*
    // v196 -> el profesor intento crear esta funcion para invocarla desde cada uno de los metodos de este controlador y escribir menos codigo pero no funcionaron las redirecciones vvv
    private function checkPermiso() 
    {
        if($this->userTieneQueEstarAuth) {
            if(auth()->loggedIn()) {
                if(!auth()->user()->can($this->permiso)){
                    return redirect()->to("/"); 
                }
            } 
            return redirect()->to("/"); 
        }
    } 
    */

    // GET http://localhost:8080/$resource/
    public function index()     
    {
        // bloque para comprobar autenticacion y permisos en los casos que corresponda (v196)
        if($this->userTieneQueEstarAuth) { 
            if(auth()->loggedIn()) { // valido si el usuario esta autenticado 
                if(!auth()->user()->can($this->permiso)){ // valido si el usuario tiene el permiso requerido
                    return redirect()->route("/"); 
                }
            } else {
                return redirect()->route("/"); 
            }
        }
        // fin bloque 

        $data = [
            "title" => "Index " . $this->title,
            "content" => $this->content
        ];
        return view('base/index', $data);
    }

    // GET http://localhost:8080/$resource/show/$1
    // public function show(){}

    // GET http://localhost:8080/$resource/new
    public function new()       
    {
        // bloque para comprobar autenticacion y permisos en los casos que corresponda (v196)
        if($this->userTieneQueEstarAuth) { 
            if(auth()->loggedIn()) {
                if(!auth()->user()->can($this->permiso)){ 
                    return redirect()->route("/"); 
                }
            } else {
                return redirect()->route("/"); 
            } 
        }
        // fin bloque 

        $data = [
            "title" => "New " . $this->title,
            "content" => $this->content
        ];
        return view('base/new', $data);
    }

    // POST http://localhost:8080/$resource/create
    public function create()    
    {
        // bloque para comprobar autenticacion y permisos en los casos que corresponda (v196)
        if($this->userTieneQueEstarAuth) { 
            if(auth()->loggedIn()) {
                if(!auth()->user()->can($this->permiso)){ 
                    return redirect()->route("/"); 
                }
            } else {
                return redirect()->route("/"); 
            }
        }
        // fin bloque 

        return "created...";
    }

    // GET http://localhost:8080/$resource/edit/$1
    public function edit()      
    {
        // bloque para comprobar autenticacion y permisos en los casos que corresponda (v196)
        if($this->userTieneQueEstarAuth) { 
            if(auth()->loggedIn()) {
                if(!auth()->user()->can($this->permiso)){ 
                    return redirect()->route("/"); 
                }
            } else {
                return redirect()->route("/"); 
            } 
        }
        // fin bloque 

        $data = [
            "title" => "Edit " . $this->title,
            "content" => $this->content
        ];
        return view('base/edit', $data);
    }

     // POST http://localhost:8080/$resource/update/$1
     public function update()    
     {
        // bloque para comprobar autenticacion y permisos en los casos que corresponda (v196)
        if($this->userTieneQueEstarAuth) { 
            if(auth()->loggedIn()) {
                if(!auth()->user()->can($this->permiso)){ 
                    return redirect()->route("/"); 
                }
            } else {
                return redirect()->route("/"); 
            } 
        }
        // fin bloque 

        return "updated...";
     }
    
    // GET http://localhost:8080/$resource/remove/$1
    public function remove(){
        // bloque para comprobar autenticacion y permisos en los casos que corresponda (v196)
        if($this->userTieneQueEstarAuth) { 
            if(auth()->loggedIn()) {
                if(!auth()->user()->can($this->permiso)){ 
                    return redirect()->route("/"); 
                }
            } else {
                return redirect()->route("/"); 
            } 
        }
        // fin bloque 

        $data = [
            "title" => "Remove " . $this->title,
            "content" => $this->content
        ];
        return view('base/remove', $data);
    }

    // POST http://localhost:8080/$resource/delete/$1
    public function delete()    
    {
        // bloque para comprobar autenticacion y permisos en los casos que corresponda (v196)
        if($this->userTieneQueEstarAuth) { 
            if(auth()->loggedIn()) {
                if(!auth()->user()->can($this->permiso)){ 
                    return redirect()->route("/"); 
                }
            } else {
                return redirect()->route("/"); 
            } 
        }
        // fin bloque 

        return "deleted...";
    }
}