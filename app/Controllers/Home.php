<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {   
        if(!auth()->user()) {
            echo "<p>Usuario logueado: <b>-</b></p>";
        } else {
            echo "<p>Usuario logueado: <b>" . auth()->user()->username . "</b></p>";
        }
        return view('welcome_message');
    }
}
