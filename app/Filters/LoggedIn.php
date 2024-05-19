<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoggedIn implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // implementacion del profesor (v195)
        // por ahora la comento porque entiendo que es insuficente, ya que no valida los permisos de un usuario logueado
        // if(!auth()->loggedIn()) { 
        //     return redirect()->to("/");
        // }
        
        // implementacion mia (v195) ya que a diferencia de la del profesor, si valida los permisos de un usuario logueado
        if(!auth()->loggedIn()) { 
            // true si no hay usuario logueado (v195)

            // echo json_encode("Acceso denegado. Debes iniciar sesión - desde LoggedIn->before()");
            return redirect()->route("/"); 
        } elseif(!auth()->user()->can('users.detail')) { 
            // true si el usuario esta logueado pero no tiene los permisos indicados (v195)

            // echo json_encode(auth()->user()->username . ", estás logueado pero no tienes permisos para acceder a este modulo - desde LoggedIn->before()");
            return redirect()->to("/");
        } else {
            echo auth()->user()->username . ", estás logueado y tienes permisos para acceder al listado de usuarios del sistema - desde LoggedIn->before()";
        }
    }
    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
