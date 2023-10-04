<?php

use Model\usuario;
use Controllers\controller;
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
}
