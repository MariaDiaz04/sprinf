<?php

namespace Model;

use Model\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class usuario extends model
{

    public $fillable = [
        'rol_id',
        'email',
        'contrasena',
        'token',
    ];

    private int $id;
    public int $rol_id;
    private string $email;
    private string $contrasena;
    private string $token;


    public function all()
    {
        try {
            $usuarios = $this->select('usuario');
            return $usuarios ? $usuarios : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function setUsuario(array $data)
    {
        foreach ($data as $prof => $value) {

            if (property_exists($this, $prof) && in_array($prof, $this->fillable)) {
                $this->{$prof} = $value;
            }
        }
    }

    public function save($id = null)
    {
        $data = [];

        foreach ($this->fillable as $key => $value) {
            if (isset($this->{$value})) {
                if (is_string($this->{$value})) {
                    $data[$value] = '"' . $this->{$value} . '"';
                } else {
                    $data[$value] =  $this->{$value};
                }
            }
        }

        if ($id) {
            $this->update('usuario', $data, [['id', '=', $id]]);
        } else {
            $this->set('usuario', $data);
            $this->id = $this->lastInsertId();
            return $this->id;
        }
    }

    public function new_session(Request $request)
    {
        $email = $request->request->get('email');
        $contrasena = $request->request->get('contrasena');

        $credenciales = $this->selectOne('usuario', [
            ['email', '=', '"' . $email . '"']
        ]);

        if (!password_verify($contrasena, $credenciales['contrasena'])) {
            return [
                'estatus' => '0',
            ];
        }

        if (isset($credenciales)) {

            $usuariopersona = $this->select('persona', [['usuario_id', '=', $credenciales['id']]])[0];

            $_SESSION = $usuariopersona;

            if (!$usuariopersona['estatus']) {
                return [
                    'estatus' => '2',
                ];
            } else {
                $_SESSION = $usuariopersona;

                $token = bin2hex(openssl_random_pseudo_bytes(32));

                $this->update('usuario', ['token' => "'" . $token . "'"], [['id', '=', $usuariopersona['usuario_id']]]);
                $_SESSION['token'] = $token;

                $navegador = $_SERVER['HTTP_USER_AGENT'] . "\n\n";
                $hora = new \DateTimeZone("America/Caracas");
                $guardar_hora = new \DateTime("now", $hora);
                $this->set('bitacora', [
                    'fecha' => '"' . Date('Y-m-d') . '"',
                    'navegador' => '"' . $navegador . '"',
                    'hora_inicio' => '"' . $guardar_hora->format("H:i:s") . '"',
                    'nombre' => '"' . $_SESSION['nombre']  . '"',
                    'apellido' => '"' . $_SESSION['apellido'] . '"',
                    'token' => '"' . $_SESSION['token'] . '"',
                    'usuario_id' => '"' . $_SESSION['usuario_id'] . '"',
                ]);

                return [
                    'estatus' => '1',
                ];
            }
        } else {
            return [
                'estatus' => '0',
            ];
        }
    }

    public function end_session()
    {
        $hora = new \DateTimeZone("America/Caracas");
        $guardar_hora = new \DateTime("now", $hora);
        $hora_cierre  = $guardar_hora->format("H:i:s");
        $idusuario = $_SESSION['usuario_id'];
        $bitacora = $this->query(
            'UPDATE bitacora SET 
            bitacora.hora_cierre="' . $hora_cierre . '"  
            WHERE 
            bitacora.usuario_id  = "' . $idusuario  . '" AND bitacora.fecha  = "' . Date('Y-m-d') . '"  AND bitacora.token= "' . $_SESSION['token'] . '"'
        );

        foreach ($bitacora as $key => $value) {
            $this->fillable[$key] = $value;
        }
        return $this;
    }
    // ======================== G E T S =======================

    public function profesor()
    {
        $profesor = $this->querys(
            'SELECT
                persona.*
            FROM
                profesor,   
                `persona`
            WHERE
                profesor.persona_id = persona.cedula'
        );
        return $profesor;
    }

    public function estudiante()
    {
        $estudiante = $this->querys(
            'SELECT
                persona.*
            FROM
                `persona`,
                `estudiante`
            WHERE
                estudiante.persona_id = persona.cedula'
        );
        return $estudiante;
    }


    public function users_activos()
    {
        $users_activos = $this->querys(
            'SELECT
                persona.*,
                usuario.email
            FROM
                `usuario`,
                `persona`
            WHERE
                usuario.id = persona.usuario_id AND persona.estatus = 1'
        );

        return $users_activos;
    }

    public function users_inactivos()
    {
        $users_activos = $this->querys(
            'SELECT
                persona.*,
                usuario.email
            FROM
                `usuario`,
                `persona`
            WHERE
                usuario.id = persona.usuario_id AND persona.estatus = 0'
        );

        return $users_activos;
    }


    // ======================== / G E T S =====================

    /**
     * Retorna los datos del usuario
     *
     * @param [type] $id
     * @return array es vacio si no consigue el usuario
     */
    public function find($id): array
    {
        $usuario = $this->selectOne("usuario", [['id', '=', $id]]);
        return !$usuario ? [] : $usuario;
    }

    function findByEmail($correo): array
    {
        $usuario = $this->selectOne("usuario", [['email', '=', "'$correo'"]]);
        return !$usuario ? [] : $usuario;
    }

    //=========================/FIND==========================

    // ======================== S E T S =======================

    public function create($usuario)
    {
        foreach ($usuario as $key => $value) {
            $this->fillable[$key] = $value;
        }
        return $this;
    }

    // public function save()
    // {
    //     try {

    //         $this->set('usuario', [
    //             'email' => '"' . $this->fillable['email'] . '"',
    //             'contrasena' => '"' . $this->fillable['contrasena'] . '"',
    //             'rol_id' => '"' . $this->fillable['rol_id'] . '"',
    //         ]);

    //         $usuario = $this->select('usuario', [['email', '=', "'" . $this->fillable['email'] . "'"]])[0]['id'];

    //         $this->set('persona', [
    //             'usuario_id' => $usuario,
    //             'nombre' => '"' . $this->fillable['nombre'] . '"',
    //             'apellido' => '"' . $this->fillable['apellido'] . '"',
    //             'cedula' => '"' . $this->fillable['cedula'] . '"',
    //             'telefono' => '"' . $this->fillable['telefono'] . '"',
    //             'nacimiento' => '"' . $this->fillable['nacimiento'] . '"',
    //             'direccion' => '"' . $this->fillable['direccion'] . '"',
    //             'estatus' => '"' . $this->fillable['estatus'] . '"',
    //         ]);

    //         $persona_id = $this->lastInsertId();

    //         if ($this->fillable['rol_id'] == 2) {

    //             $this->set('profesor', [
    //                 'persona_id' => $persona_id,
    //             ]);
    //         } elseif ($this->fillable['rol_id'] == 4) {
    //             $this->set('estudiante', [
    //                 'persona_id' => $persona_id,
    //             ]);
    //         }

    //         // return $this->fillable;

    //     } catch (\PDOException $th) {
    //         return $th;
    //     }
    // }




    public function eliminar()
    {

        try {

            $this->delete('usuario', [['id', '=',  $this->fillable['usuario_id']]]);
            $this->delete('persona', [['usuario_id', '=', $this->fillable['usuario_id']]]);
            return $this;
        } catch (\PDOException $th) {
            return $th;
        }
    }



    // ======================== / UPDATE=========================
    public function actualizar($usuario)
    {

        $this->update('persona', [
            'nombre' => '"' . $usuario->get('nombre') . '"',
            'apellido' => '"' . $usuario->get('apellido') . '"',
            'cedula' => '"' .  $usuario->get('cedula') . '"',
            'telefono' => '"' .  $usuario->get('telefono') . '"',
            'nacimiento' => '"' . $usuario->get('nacimiento') . '"',
            'direccion' => '"' . $usuario->get('direccion') . '"',
            'estatus' => '"' . $usuario->get('estatus') . '"',
        ], [['id', '=', $this->fillable['id']]]);

        $this->create($usuario);
        return $this;
    }


    public function usersname()
    {
        try {
            $usuarios = $this->query('SELECT persona.nombre, persona.apellido, usuario.id, usuario.email FROM persona INNER JOIN usuarios ON persona.usuario_id = usuario.id WHERE persona.estatus = 1');
            return $usuarios ? $usuarios : null;
        } catch (\PDOException $th) {
            return $th;
        }
    }
}
