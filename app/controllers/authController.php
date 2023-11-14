<?php

use Model\usuario;
use Model\respuesta;
use Controllers\controller;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class authController extends controller
{

    public $USUARIO;
    public $RESPUESTA;

    function __construct()
    {
        $this->USUARIO = new usuario();
        $this->RESPUESTA = new respuesta();
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
            case '3':
                return $this->page('auth/question', ['usuario_id' => $_SESSION['usuario_id']]);
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


    public function questions()
    {
        return $this->page('auth/question');
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
            if (!is_null($response) && count($response) == 3) {
                $email = $usuario->request->get('email');
                return $this->page('auth/reset-password', ['usuario_id' => $response[0]['usuario_id'], 'email' => $email]);
            } else {
                echo '
                <script> 
                window.alert("Alguna de su respuesta está equivocada, verifique e intente nuevamente")
                </script>';
                return $this->page('auth/forgot-password');
            }
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
        echo '
        <script> 
        window.alert("Contraseña actualizada con exito")
        </script>';
        return $this->redirect(APP_URL);
    }

    public function saveQuestions($questions)
    {
        $respuestas =  $questions->request->all();
        $usuario_id =  $questions->request->get('usuario_id');
        $Newrespuestas = [];
        try {
            foreach ($respuestas['respuestas']['respuesta'] as $key => $respuesta) {
                $respuestasObject = new \stdClass();
                $respuestasObject->respuesta = strtolower($respuesta);
                $respuestasObject->usuario_id = $usuario_id;
                $respuestasObject->pregunta_id = $key + 1;
                $Newrespuestas[] = $respuestasObject;
            }
            foreach ($Newrespuestas as $respuestaObj) {
                $this->RESPUESTA->create([
                    'respuesta' => $respuestaObj->respuesta,
                    'pregunta_id' => $respuestaObj->pregunta_id,
                    'usuario_id' => $respuestaObj->usuario_id,
                ])->save();
            }
             return $this->redirect(APP_URL . 'home');
            http_response_code(200);
            echo json_encode($this->RESPUESTA);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode($e->getMessage());
        }
    }
}
