<?php


$web = [

//********************  A U T H  **************************** 
    'login' => [
        'name' => 'Login',
        'type' => 'POST',
        'controller' => 'authController',
        'method' => 'index',
        'middlewares' => [
            'logged_in',
        ]
    ],

    'logear' => [
        'type' => 'POST',
        'controller' => 'authController',
        'method' => 'login',
    ],

    'logear/api' => [
        'type' => 'POST',
        'controller' => 'authController',
        'method' => 'loginApi',
    ],

    'logout' => [
        'type' => 'POST',
        'name' => 'Saliendo del sitio',
        'controller' => 'authController',
        'method' => 'logout',
    ],

    'inactive' => [
        'name' => 'Inactive User',
        'controller' => 'authController',
        'method' => 'inactive',
    ],

    'invalid' => [
        'name' => 'Invalid User',
        'controller' => 'authController',
        'method' => 'invalid',
    ],
// ********************************************************+


// ********************* H O M E ****************************+
    'home' => [
        'type' => 'POST',
        'name' => 'home',
        'controller' => 'homeController',
        'method' => 'index',
        'middlewares' => [
            'logged_out',
        ],
    ],
// ********************************************************+


// ********************* E R R O R S *********************+
    '501' => [
        'name' => '501',
        'controller' => 'homeController',
        'method' => 'E501',
    ],
// ********************************************************+

// ************  U S U A R I O S *************+
   
    'usuario/crear' => [    
        'type' => 'POST',
        'name' => 'Nuevo usuario',
        'controller' => 'userController',
        'method' => 'create',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],



    'usuario/editar' => [
        'type' => 'GET',
        'controller' => 'userController',
        'method' => 'edit',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],

    'usuario/guardar' => [
        'type' => 'POST',
        'controller' => 'userController',
        'method' => 'store',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],
    'usuario/actualizar' => [
        'type' => 'POST',
        'controller' => 'userController',
        'method' => 'update',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],

   'usuario/permisos' => [
        'type' => 'GET',
        'controller' => 'userController',
        'name' => 'Permisos',
        'method' => 'asignar',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],


    'perfil' => [
        'type' => 'GET',
        'controller' => 'userController',
        'name' => 'Perfil',
        'method' => 'perfil',
        'middlewares' => [
            'logged_out',
        ],
    ],


    /* *************BITACORA******** */
    'bitacora' => [
        'type' => 'GET',
        'name' => 'IS Bitacora',
        'controller' => 'bitacoraController',
        'method' => 'index',   
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],

    /* ******************  MODULO  ************************* */

    'modulo' => [
        'type' => 'GET',
        'controller' => 'moduloController',
        'method' => 'index',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],
        
    'modulo/crear' => [
        'type' => 'GET',
        'controller' => 'moduloController',
        'method' => 'create',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],

    'modulo/guardar' => [
        'type' => 'POST',
        'controller' => 'moduloController',
        'method' => 'store',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],  
    ],

    'modulo/editar' => [
        'type' => 'GET',
        'controller' => 'moduloController',
        'method' => 'edit',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],  
    ],

    'modulo/actualizar' => [
        'type' => 'POST',
        'controller' => 'moduloController',
        'method' => 'update',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],

    'modulo/eliminar' => [
        'type' => 'GET',
        'controller' => 'moduloController',
        'method' => 'delete',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
        
    ],
// ************************** FIN MODULO******************************//
    
     /* ******************  PERMISOS  ************************* */

    'permisos' => [
        'type' => 'GET',
        'controller' => 'permisosController',
        'method' => 'index',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],
        
    'permisos/crear' => [
        'type' => 'GET',
        'controller' => 'permisosController',
        'method' => 'create',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],

    'permisos/guardar' => [
        'type' => 'POST',
        'controller' => 'permisosController',
        'method' => 'store',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],  
    ],

    'permisos/editar' => [
        'type' => 'GET',
        'controller' => 'permisosController',
        'method' => 'edit',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],  
    ],

    'permisos/actualizar' => [
        'type' => 'POST',
        'controller' => 'permisosController',
        'method' => 'update',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
    ],

    'permisos/eliminar' => [
        'type' => 'GET',
        'controller' => 'permisosController',
        'method' => 'delete',
        'middlewares' => [
            'logged_out',
            'root_access',
        ],
        
    ],
// ************************** FIN MODULO******************************//

 /* ******************  MATERIA  ************************* */

 'materia' => [
    'type' => 'GET',
    'controller' => 'materiaController',
    'method' => 'index',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],
],
    
'materia/crear' => [
    'type' => 'GET',
    'controller' => 'materiaController',
    'method' => 'create',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],
],

'materia/guardar' => [
    'type' => 'POST',
    'controller' => 'materiaController',
    'method' => 'store',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],  
],

'materia/editar' => [
    'type' => 'GET',
    'controller' => 'materiaController',
    'method' => 'edit',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],  
],

'materia/actualizar' => [
    'type' => 'POST',
    'controller' => 'materiasController',
    'method' => 'update',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],
],

'materia/eliminar' => [
    'type' => 'GET',
    'controller' => 'materiaController',
    'method' => 'delete',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],
    
],
// ************************** FIN MODULO******************************//

 /* ******************  ESTUDIANTES  ************************* */

 'estudiantes' => [
    'type' => 'GET',
    'controller' => 'estudiantesController',
    'method' => 'index',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],
],
    
'estudiantes/crear' => [
    'type' => 'GET',
    'controller' => 'estudiantesController',
    'method' => 'create',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],
],

'estudiantes/guardar' => [
    'type' => 'POST',
    'controller' => 'estudiantesController',
    'method' => 'store',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],  
],

'estudiantes/editar' => [
    'type' => 'GET',
    'controller' => 'estudiantesController',
    'method' => 'edit',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],  
],

'estudiantes/actualizar' => [
    'type' => 'POST',
    'controller' => 'estudiantesController',
    'method' => 'update',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],
],

'estudiantes/eliminar' => [
    'type' => 'GET',
    'controller' => 'estudiantesController',
    'method' => 'delete',
    'middlewares' => [
        'logged_out',
        'root_access',
    ],
    
],
// ************************** FIN MODULO******************************//



// ************************** FIN MODULO******************************//

];