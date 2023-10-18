<?php

use Model\usuario;
use Controllers\controller;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class authController extends controller
{

    public $USUARIO;

    function __construct()
    {
        $this->USUARIO = new usuario();
    }

    public function index()
    {
        return $this->page('auth/login');
    }

    public function login($usuario)
    {

        $response = $this->USUARIO->new_session($usuario);

        switch ($response['estatus']) {

            case '0':
                session_destroy();
                $this->redirect('invalid');
                break;
            case '1':
                $_SESSION['response'] = $response;
                $this->redirect('/home');
                break;
            case '2':
                session_destroy();
                $this->redirect('inactive');
                break;

            default:
                $this->redirect('501');
                break;
        }
    }

    public function loginApi($usuario)
    {

        $response = $this->USUARIO->new_session($usuario);

        switch ($response['estatus']) {

            case '0':
                echo json_encode([
                    'estatus' => 0,
                    'title' => 'Usuario Invalido',
                    'message' => 'No pudimos encontrar tus credenciales, verifica e intenta de nuevo',
                ]);
                session_destroy();
                return 0;
                break;
            case '1':
                echo json_encode([
                    'estatus' => 1,
                    'title' => 'Bienvenid@ ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellido'],
                    'message' => '',
                ]);

                return 0;
                break;
            case '2':
                echo json_encode([
                    'estatus' => 2,
                    'title' => 'Usuario inactivo',
                    'message' => 'Estimado usuario, tu cuenta se encuentra temporalmente inactiva',
                ]);
                session_destroy();

                return 0;
                break;
            default:
                $this->redirect('501');
                break;
        }
    }
    public function logout()
    {

        $end_session =   $this->USUARIO->end_session();
        if ($end_session) {
            session_destroy();
        }
        return  $this->redirect('/');
    }

    public function inactive()
    {
        return $this->page('auth/inactive');
    }

    public function invalid()
    {
        return $this->page('auth/invalid');
    }


    public function forgot()
    {
        return $this->page('auth/forgot-password');
    }


    public function verification($usuario)
    {

        $response = $this->USUARIO->veificationDates($usuario);
        if (isset($response['estatus'])) {
            switch ($response['estatus']) {
                case '0':
                    $this->redirect('invalid');
                    break;
                case '2':
                    $this->redirect('inactive');
                    break;
                default:
                    $this->redirect('501');
                    break;
            }
        } else {
            $email = $usuario->request->get('email');
            return $this->page('auth/reset-password', ['usuario_id' => $response[0]['usuario_id'], 'email' => $email]);
        }
    }

    public function actualizarContrasena($usuario)
    {
        $usuario_id = $usuario->request->get('usuario_id');

        if (!$usuarioAct = $this->USUARIO->findById($usuario_id)) {
            return $this->page('errors/404');
        }
        $contrasena = password_hash($usuario->request->get('contrasena'), PASSWORD_DEFAULT);

        $usuarioAct->actualizarPassword([
            'contrasena' => '"' . $contrasena . '"',
        ]);

        return $this->redirect(APP_URL);
    }
}
