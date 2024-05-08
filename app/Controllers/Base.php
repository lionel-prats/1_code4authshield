<?php

namespace App\Controllers;

class Base extends BaseController
{
    protected $title = "Base";
    protected $content = "Base";
    
    // GET http://localhost:8080/$resource/
    public function index()     
    {
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
        $data = [
            "title" => "New " . $this->title,
            "content" => $this->content
        ];
        return view('base/new', $data);
    }

    // POST http://localhost:8080/$resource/create
    public function create()    
    {
        return "created...";
    }

    // GET http://localhost:8080/$resource/edit/$1
    public function edit()      
    {
        $data = [
            "title" => "Edit " . $this->title,
            "content" => $this->content
        ];
        return view('base/edit', $data);
    }

     // POST http://localhost:8080/$resource/update/$1
     public function update()    
     {
        return "updated...";
     }
    
    // GET http://localhost:8080/$resource/remove/$1
    public function remove(){
        $data = [
            "title" => "Remove " . $this->title,
            "content" => $this->content
        ];
        return view('base/remove', $data);
    }

    // POST http://localhost:8080/$resource/delete/$1
    public function delete()    
    {
        return "deelted...";
    }
}