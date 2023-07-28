<?php

namespace App;

use App\model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Bcrypt\Bcrypt;

use Exception;

class usuario extends model
{

    public $fillable = [
        'email',
        'contrasena',
        'rol_id',
        'nombre',
        'apellido',
        'cedula',
        'direccion',
        'telefono',
        'nacimiento',
        'estatus',
    ];

    public function all()
    {
        try {
            $usuarios = $this->select('usuarios');
            return $usuarios ? $usuarios : null;
        } catch (Exception $th) {
            return $th;
        }
    }

    public function new_session(Request $request)
    {
        $email = $request->request->get('email');
        $contrasena = $request->request->get('contrasena');

        $credenciales = $this->selectOne('usuarios', [
            ['email', '=', '"' . $email . '"']
        ]);

        if (!password_verify($contrasena, $credenciales['contrasena'])) {
            return [
                'estatus' => '0',
            ];
        }

        if (isset($credenciales)) {

            $usuariopersona = $this->select('persona', [['usuarios_id', '=', $credenciales['id']]])[0];

            $_SESSION = $usuariopersona;

            if (!$usuariopersona['estatus']) {
                return [
                    'estatus' => '2',
                ];
            } else {
                $_SESSION = $usuariopersona;

                $token = bin2hex(openssl_random_pseudo_bytes(32));

                $this->update('usuarios', ['token' => "'" . $token . "'"], [['id', '=', $usuariopersona['id']]]);
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
                    'usuario_id' => '"' . $_SESSION['usuarios_id'] . '"',
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
        $idusuario = $_SESSION['usuarios_id'];
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
                persona.*,
                usuarios.email
            FROM
                `usuarios`,
                `persona`
            WHERE
                usuarios.id = persona.usuarios_id AND usuarios.rol_id = 2'
        );
        return $profesor;
    }

    public function estudiante()
    {
        $estudiante = $this->query(
            'SELECT
                persona.*,
                usuarios.email
            FROM
                `usuarios`,
                `persona`
            WHERE
                usuarios.id = persona.usuarios_id AND persona.rol_id = 4'
        );
        return $estudiante;
    }

    public function analista()
    {
        $analista = $this->query(
            'SELECT
                persona.*,
                usuarios.email
            FROM
                `usuarios`,
                `persona`
            WHERE
                usuarios.id = persona.usuarios_id AND persona.rol_id = 3'
        );

        return $analista;
    }

    public function vendedor_comprador()
    {
        $users_activos = $this->query(
            'SELECT
            persona.*,
            usuarios.email
            FROM
            `usuarios`,
            `persona`
            WHERE
            (usuarios.id = persona.usuarios_id AND persona.rol_id = 4) OR (usuarios.id = persona.usuarios_id AND persona.rol_id = 5)'
        );

        return $users_activos;
    }

    public function users_activos()
    {
        $users_activos = $this->querys(
            'SELECT
                persona.*,
                usuarios.email
            FROM
                `usuarios`,
                `persona`
            WHERE
                usuarios.id = persona.usuarios_id AND persona.estatus = 1'
        );

        return $users_activos;
    }

    public function users_inactivos()
    {
        $users_activos = $this->querys(
            'SELECT
                persona.*,
                usuarios.email
            FROM
                `usuarios`,
                `persona`
            WHERE
                usuarios.id = persona.usuarios_id AND persona.estatus = 0'
        );

        return $users_activos;
    }


    // ======================== / G E T S =====================

    //=========================FIND==========================
    public function find($id)
    {
        try {
            $usuarios = $this->querys(
                'SELECT
                        persona.*,
                        usuarios.email
                    FROM
                        `usuarios`,
                        `persona`
                    WHERE
                        usuarios.id = persona.usuarios_id AND usuarios.id = ' . $id . ';'
            );
            if ($usuarios) {
                foreach ($usuarios[0] as $key => $value) {
                    $this->fillable[$key] = $value;
                }
                return $this;
            } else {
                return null;
            }
        } catch (\PDOException $th) {
            return $th;
        }
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

    public function save()
    {
        try {

            $this->set('usuarios', [
                'email' => '"' . $this->fillable['email'] . '"',
                'contrasena' => '"' . $this->fillable['contrasena'] . '"',
                'rol_id' => '"' . $this->fillable['rol_id'] . '"',
            ]);

            $usuario = $this->select('usuarios', [['email', '=', "'" . $this->fillable['email'] . "'"]])[0]['id'];

            $this->set('persona', [
                'usuarios_id' => $usuario,
                'nombre' => '"' . $this->fillable['nombre'] . '"',
                'apellido' => '"' . $this->fillable['apellido'] . '"',
                'cedula' => '"' . $this->fillable['cedula'] . '"',
                'telefono' => '"' . $this->fillable['telefono'] . '"',
                'nacimiento' => '"' . $this->fillable['nacimiento'] . '"',
                'direccion' => '"' . $this->fillable['direccion'] . '"',
                'estatus' => '"' . $this->fillable['estatus'] . '"',
            ]);

            $persona_id = $this->lastInsertId();

            if ($this->fillable['rol_id'] == 2) {

                $this->set('profesor', [
                    'persona_id' => $persona_id,
                ]);
            } elseif ($this->fillable['rol_id'] == 4) {
                $this->set('estudiante', [
                    'persona_id' => $persona_id,
                ]);
            }

            // return $this->fillable;

        } catch (\PDOException $th) {
            return $th;
        }
    }


    // ======================== / S E T S =====================

    public function eliminarAgente()
    {

        try {
            $analista = $this->query(
                '
            DELETE usuarios.* FROM usuarios INNER JOIN persona ON usuarios.id = persona.usuarios_id INNER JOIN agentes ON agentes.persona_id = persona.id WHERE usuarios.id = "' . $this->fillable['usuarios_id'] . '" AND persona.rol_id = 2'
            );

            return $this;
        } catch (\PDOException $th) {
            return $th;
        }
    }


    public function eliminar()
    {

        try {

            $this->delete('usuarios', [['id', '=',  $this->fillable['usuarios_id']]]);
            $this->delete('persona', [['usuarios_id', '=', $this->fillable['usuarios_id']]]);
            return $this;
        } catch (\PDOException $th) {
            return $th;
        }
    }


    /* 
   DELETE usuarios.* FROM usuarios INNER JOIN persona ON usuarios.id = persona.usuarios_id INNER JOIN agentes ON agentes.persona_id = persona.id WHERE usuarios.id = 4 AND persona.rol_id = 2;
   
   */


    // ======================== / UPDATE=========================
    public function actualizar($usuario)
    {

        $this->update('persona', [
            'procedencia_id' => '"' . $usuario['procedencia_id'] . '"',
            'nombre' => '"' . $usuario['nombre'] . '"',
            'apellido' => '"' . $usuario['apellido'] . '"',
            'cedula' => '"' . $usuario['cedula'] . '"',
            'telefono' => '"' . $usuario['telefono'] . '"',
            'nacimiento' => '"' . $usuario['nacimiento'] . '"',
            'direccion' => '"' . $usuario['direccion'] . '"',
            'estatus' => '"' . $usuario['estatus'] . '"',
        ], [['id', '=', $this->fillable['id']]]);

        $this->create($usuario);
        return $this;
    }

    public function selectAgentesexepto($id)
    {
        $tip = $this->query(
            'SELECT persona.id as i, persona.nombre as n, persona.rol_id, roles.id
                FROM persona INNER JOIN roles ON persona.rol_id = roles.id
                WHERE persona.rol_id = 2 AND persona.id !=' . $id
        );
        if ($tip) {
            foreach ($tip as $key => $value) {
                echo '<option value="' . $value['i'] . '">' . $value['n'] . '</option>';
            }
            return $this;
        } else {
            $N = '<option style="display:none" value="0">VACIO</option>';
            return $N;
        }
    }

    public function selectAgentes()
    {
        $tip = $this->query(
            'SELECT persona.id as i, persona.nombre as n, persona.rol_id, roles.id
                FROM persona INNER JOIN roles ON persona.rol_id = roles.id
                WHERE persona.rol_id = 2'
        );
        if ($tip) {
            foreach ($tip as $key => $value) {
                echo '<option value="' . $value['i'] . '">' . $value['n'] . '</option>';
            }
            return $this;
        } else {
            $N = '<option style="display:none" value="0">VACIO</option>';
            return $N;
        }
    }

    public function ClienteVendedores()
    {
        $sql = $this->query('SELECT inmueble.idinmueble AS idinm, inmueble.nombre_inmueble AS nombinm, (SELECT persona.id FROM persona INNER JOIN vendedor_inmueble ON persona.id = vendedor_inmueble.vendedor_id INNER JOIN inmueble ON vendedor_inmueble.inmueble_id = inmueble.idinmueble WHERE inmueble.idinmueble = idinm AND persona.estatus >= 1) AS idclientev, (SELECT persona.nombre FROM persona INNER JOIN vendedor_inmueble ON persona.id = vendedor_inmueble.vendedor_id INNER JOIN inmueble ON vendedor_inmueble.inmueble_id = inmueble.idinmueble WHERE inmueble.idinmueble = idinm AND persona.estatus >= 1) AS nombagentev FROM inmueble WHERE inmueble.estatus >= 1');
        if ($sql) {
            foreach ($sql as $key => $value) {
                echo '<option value="' . $value['idclientev'] . '">' . $value['idinm'] . ' | ' . $value['nombinm'] . '</option>';
            }
            return $this;
        } else {
            $N = '<option style="display:none" value="0">VACIO</option>';
            return $N;
        }
    }


    public function selectclientsvende($id)
    {
        $tip = $this->query(
            'SELECT inmueble.idinmueble AS idinm,
                    (SELECT persona.id FROM persona INNER JOIN persona_inmueble ON persona_id = persona_inmueble.persona_id INNER JOIN inmueble ON inmueble.idinmueble = persona_inmueble.inmueble_idinmueble WHERE persona.rol_id = 2 AND inmueble.idinmueble = idinm) AS agid,
                    (SELECT persona.id FROM persona INNER JOIN persona_inmueble ON persona_id = persona_inmueble.persona_id INNER JOIN inmueble ON inmueble.idinmueble = persona_inmueble.inmueble_idinmueble WHERE persona.rol_id = 3 AND inmueble.idinmueble = idinm) AS cliid,
                    (SELECT persona.nombre FROM persona WHERE persona.id = agid) AS agnombre,
                    (SELECT persona.nombre FROM persona WHERE persona.id = cliid) AS clinombre
                FROM inmueble WHERE inmueble.idinmueble =' . $id
        );
        if ($tip) {
            foreach ($tip as $key => $value) {
                echo '<option value="' . $value['cliid'] . '">' . $value['clinombre'] . '</option>';
            }
            return $this;
        } else {
            $N = '<option style="display:none" value="0">VACIO</option>';
            return $N;
        }
    }

    public function selectclientscompra()
    {
        $tip = $this->query(
            'SELECT persona.id AS id, persona.nombre AS nombre, persona.cedula AS cedula FROM persona INNER JOIN cliente_comprador ON persona.id = cliente_comprador.persona_id'
        );
        if ($tip) {
            foreach ($tip as $key => $value) {
                echo '<option value="' . $value['id'] . '">' . $value['nombre'] . ' - ' . $value['cedula'] . '</option>';
            }
            return $this;
        } else {
            $N = '<option style="display:none" value="0">VACIO</option>';
            return $N;
        }
    }

    public function clientven($id)
    {
        $cli = $this->query(
            'SELECT inmueble.idinmueble AS idinm,
                    (SELECT persona.id FROM persona INNER JOIN persona_inmueble ON persona_id = persona_inmueble.persona_id INNER JOIN inmueble ON inmueble.idinmueble = persona_inmueble.inmueble_idinmueble WHERE persona.rol_id = 2 AND inmueble.idinmueble = idinm) AS agid,
                    (SELECT persona.id FROM persona INNER JOIN persona_inmueble ON persona_id = persona_inmueble.persona_id INNER JOIN inmueble ON inmueble.idinmueble = persona_inmueble.inmueble_idinmueble WHERE persona.rol_id = 3 AND inmueble.idinmueble = idinm) AS cliid,
                    (SELECT persona.nombre FROM persona WHERE persona.id = agid) AS agnombre,
                    (SELECT persona.nombre FROM persona WHERE persona.id = cliid) AS clinombre
                FROM inmueble WHERE inmueble.idinmueble =' . $id
        );
        if ($cli) {
            foreach ($cli as $key => $value) {
                $c = $this->find($value['cliid']);
            }
            return $c;
        } else {
            $N = '<option style="display:none" value="0">VACIO</option>';
            return $N;
        }
    }

    /*     public function clientvend($id){
        $cli = $this->query(
                'SELECT persona.id as cliid, inmueble.idinmueble FROM persona INNER JOIN persona_inmueble ON persona.id = persona_inmueble.persona_id INNER JOIN roles ON persona.rol_id = roles.id INNER JOIN inmueble ON persona_inmueble.inmueble_idinmueble = inmueble.idinmueble WHERE persona.rol_id = 3 AND inmueble.idinmueble = '.$id);
        if ($cli != "") {
                
            $c = $value['cliid'];
                
            return $c;
        }
    } */


    /*     public function Agent(){
        try {
             $ag = $this->query('SELECT persona.id AS idpersona, persona.cedula AS cedula, persona.nombre AS nombre, persona.apellido AS apellido, persona.rol_id AS rol, persona.estatus AS estatus FROM persona INNER JOIN roles ON persona.rol_id = roles.id WHERE persona.rol_id = 2 AND persona.estatus = 1;');
            return $ag ? $ag : null;
        } catch (\PDOException $e) {
            return $e;
        }
    } */

    /*  public function Comprador(){
        try {
             $ven = $this->query('SELECT persona.id AS idpersona, persona.cedula AS cedula, persona.nombre AS nombre, persona.apellido AS apellido, persona.rol_id AS rol, persona.estatus AS estatus FROM persona INNER JOIN roles ON persona.rol_id = roles.id WHERE persona.rol_id = 5 AND persona.estatus = 1;');
            return $ven ? $ven : null;
        } catch (\PDOException $e) {
            return $e;
        }
    }

    public function Vendedor(){
        try {
             $com = $this->query('SELECT persona.id AS idpersona, persona.cedula AS cedula, persona.nombre AS nombre, persona.apellido AS apellido, persona.rol_id AS rol, persona.estatus AS estatus FROM persona INNER JOIN roles ON persona.rol_id = roles.id WHERE persona.rol_id = 4 AND persona.estatus = 1;');
            return $com ? $com : null;
        } catch (\PDOException $e) {
            return $e;
        }
    } */

    public function usersname()
    {
        try {
            $usuarios = $this->query('SELECT persona.nombre, persona.apellido, usuarios.id, usuarios.email FROM persona INNER JOIN usuarios ON persona.usuarios_id = usuarios.id WHERE persona.estatus = 1');
            return $usuarios ? $usuarios : null;
        } catch (\PDOException $th) {
            return $th;
        }
    }
}
