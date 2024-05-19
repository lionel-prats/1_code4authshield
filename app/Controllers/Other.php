<?php

namespace App\Controllers;

// v179
class Other extends Base
{
    protected $title = "Other";
    protected $content = 'contenido atributo Other->content';

    public function contacto()
    {
        // bloque para comprobar autenticacion del usuario (v196)
        if(!auth()->loggedIn()) {
            return redirect()->route("/"); 
        }
        // fin bloque 
        echo "<h1>contacto!</h1>";
    }
}