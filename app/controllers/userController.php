<?php
use App\controllers\controller;
use App\permisos;
use App\usuario;
use App\rol;
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


       /*  $permisos = $this->PERMISOS->consult(2, $_SESSION['usuarios_id']);

        $permisos = $this->PERMISOS->consult(7, $_SESSION['usuarios_id']); */

       /*  if ($permisos != null) {
            $newpermisos = $permisos->fillable;
        } elseif ($permisos == null) {
            $newpermisos = $permisos;
        } */

        $usuarios = $this->USUARIO->profesor();

        return $this->view('usuario/usuario', ['persona' => $usuarios, 'rol' => '2']);
    } 

  public function estudiantes()
  {

     $usuarios = $this->USUARIO->estudiantes();

     return $this->view('usuario/usuario', ['persona' => $usuarios, 'rol' => '3']);
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
    /*     if ($usuario['rol'] == '2') {

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
        } else { */
          $user=  $this->USUARIO->create([
                'email' => $usuario->request->get('email'),
                'contrasena' => md5($usuario->request->get('contrasena')),
                'rol_id' => $usuario->request->get('rol'),
                'nombre' => $usuario->request->get('nombre'),
                'apellido' => $usuario->request->get('apellido'),
                'cedula' => $usuario->request->get('cedula'),
                'telefono' => $usuario->request->get('telefono'),
                'nacimiento' =>  $usuario->request->get('nacimiento'),
                'direccion' => $usuario->request->get('direccion'),
                'estatus' => 1,
            ])->save();
      /*   } */

      //return var_dump($user);

        switch ($usuario->request->get('rol')) {
            case '2':
                return $this->redirect('profesor');
                break;
            case '3':
                return $this->redirect('estudiante');
                break;
            default:
                return $this->redirect('home');
                break;
        }
    }


    public function edit($request)
    {

        $usuario = $this->USUARIO->find($request['usuario']);

        if ($usuario) {


            return $this->view('usuario/editar', ['usuario' => $usuario->fillable]);
        } else {

            return $this->page('errors/404');
        }
    }
    public function update($response)
    {

        $usuario = $this->USUARIO->find($_GET['usuario']);

        if ($usuario) {
            $usuario->actualizar($response);

            switch ($usuario->fillable['rol_id']) {
                case '2':
                    return $this->redirect('agente');
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
