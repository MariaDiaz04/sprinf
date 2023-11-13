<?php

use Controllers\controller;
use Model\permisos;
use Model\usuario;
use Model\rol;
use Symfony\Component\HttpFoundation\Request;


class userController extends controller
{

    public $USUARIO;
    public $PROCEDENCIA;
    public $ROL;
    public $PERMISOS;

    function __construct()
    {


        $this->USUARIO = new usuario();
        $this->ROL = new rol();
        // $this->PERMISOS = new permisos();
    }


    public function profesor()
    {


        /*  $permisos = $this->PERMISOS->consult(2, $_SESSION['usuario_id']);

        $permisos = $this->PERMISOS->consult(7, $_SESSION['usuario_id']); */

        /*  if ($permisos != null) {
            $newpermisos = $permisos->fillable;
        } elseif ($permisos == null) {
            $newpermisos = $permisos;
        } */

        $usuarios = $this->USUARIO->profesor();

        return $this->view('usuario/usuario', ['persona' => $usuarios, 'rol' => '2']);
    }

    public function estudiante()
    {

        $usuarios = $this->USUARIO->estudiante();

        return $this->view('usuario/usuario', ['persona' => $usuarios, 'rol' => '4']);
    }



    public function perfil($request)
    {

        $this->USUARIO = new usuario();

        if ($_SESSION) {
            $this->view('usuario/perfil', ['usuario' => $_SESSION]);
        } else {

            return $this->page('errors/404');
        }
    }

    public function create($request)
    {
        return $this->view('usuario/crear', ['rol' => $request->request->get('rol')]);
    }


    public function store(Request $usuario)
    {
        //return var_dump(1);
        // return $usuario;
        if ($usuario['rol'] == '2') {

            $nombre = substr($usuario['nombre'], 0, 2);
            $apellido = substr($usuario['apellido'], 0, 3);
            $acronimo = $nombre . $apellido;
            $concatenado = strtolower($acronimo);

            $this->USUARIO->create([
                'email' => $usuario['email'],
                'contrasena' => md5($usuario['contrasena']),
                'rol_id' => $usuario['rol'],
                'procedencia_id' => $usuario['procedencia'],
                'nombre' => $usuario['nombre'],
                'apellido' => $usuario['apellido'],
                'cedula' => $usuario['cedula'],
                'telefono' => $usuario['telefono'],
                'nacimiento' => $usuario['nacimiento'],
                'direccion' => $usuario['direccion'],
                'estatus' => 1,




            ])->save();
        } else {
            $contrasena = password_hash($usuario->request->get('contrasena'), PASSWORD_DEFAULT);

            $user =  $this->USUARIO->create([
                'email' => $usuario->request->get('email'),
                'contrasena' => $contrasena,
                'rol_id' => $usuario->request->get('rol'),
                'nombre' => $usuario->request->get('nombre'),
                'apellido' => $usuario->request->get('apellido'),
                'cedula' => $usuario->request->get('cedula'),
                'telefono' => $usuario->request->get('telefono'),
                'nacimiento' =>  $usuario->request->get('nacimiento'),
                'direccion' => $usuario->request->get('direccion'),
                'estatus' => 1,
            ])->save();
        }

        switch ($usuario->request->get('rol')) {
            case '2':
                return $this->redirect('profesor');
                break;
            case '4':
                return $this->redirect('estudiante');
                break;
            default:
                return $this->redirect('home');
                break;
        }
        return var_dump($user);
    }


    public function edit(Request $request, $id)
    {

        $usuario = $this->USUARIO->find($id);
        // return var_dump($usuario);
        if ($usuario) {
            return $this->view('usuario/editar', ['usuario' => $usuario->fillable]);
        } else {
            return $this->page('errors/404');
        }
    }

    public function update($response, $id)
    {

        $usuario = $this->USUARIO->find($id);

        if ($usuario) {
            $usuario->actualizar($response->request);
            switch ($usuario->fillable['rol_id']) {
                case '2':
                    return $this->redirect(APP_URL . 'profesor');
                    break;
                case '3':
                    return $this->redirect('analista');
                    break;
                default:
                    return  $this->redirect('home');
                    break;
            }
        } else {
            return $this->page('errors/404');
        }
    }


    public function delete($request)
    {

        $usuario = $this->USUARIO->find($request['id']);
        return $usuario ? $usuario->eliminar() : $this->page('errors/404');
    }

    public function destroy($request)
    {

        $usuario = $this->USUARIO->find($request['id']);
        return $usuario ? $usuario->eliminarAgente() : $this->page('errors/404');
    }


    public function asignar($request)
    {
        $usuario = $this->USUARIO->find($request['usuario']);
        if ($usuario) {
            return $this->view('usuario/permisos', ['usuario' => $usuario->fillable]);
        } else {

            return $this->page('errors/404');
        }
    }
}
