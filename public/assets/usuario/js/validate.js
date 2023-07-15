
$(function() {
    $( "#usuarioguardar" ).validate({
        rules: {
            nombre: {
                    minlength: 3,                    
                    required: true,
                    alpha: true,
                    },
            apellido:{
                    minlength: 5,                    
                    required: true,
                    alpha: true,
                },
            cedula:{ 
                    minlength: 7,                
                    required: true,
                    number:true,
                    },
            email:{
                    minlength: 3,                    
                    required: true,

                },
                telefono:{
                    minlength: 3,                    
                    number:true,
                    required: true,

                },
                nacimiento:{
                    minlength: 3,                    
                    required: true,
                },
                contrasena:{
                    minlength: 3,                    
                    required: true,
                },

        },
        messages: {
            nombre: { 
                minlength: $.format("Necesitamos por lo menos {0} caracteres"),               
                required: 'Complete este campo porfavor',
                },
            apellido: {
                minlength: $.format("Necesitamos por lo menos {0} caracteres"),                
                required: 'Complete este campo porfavor',
                },
            cedula: {
                minlength: $.format("Necesitamos por lo menos {0} caracteres"),                
                required: 'Complete este campo porfavor',
                },
            email:{
                minlength: $.format("Necesitamos por lo menos {0} caracteres"),                
                required: 'Complete este campo porfavor',
            },
            telefono:{
                required: 'Complete este campo porfavor',
                minlength: $.format("Necesitamos por lo menos {0} caracteres"),                
                number:'Solo numeros porfavor',
            },
            nacimiento:{
                required: 'Complete este campo porfavor',
                minlength: $.format("Necesitamos por lo menos {0} caracteres"),                
            },
            contrasena:{
                required: 'Complete este campo porfavor',
                minlength: $.format("Necesitamos por lo menos {0} caracteres"),                
            },
        }
});

$( "#usuarioeditar" ).validate({
    rules: {
        first_name: {
                minlength: 3,              
                required: true,
                alpha: true,    
                },
        last_name:{
                minlength: 5,               
                required: true,
                alpha: true,
            },
        dni:{ 
                minlength: 7,               
                required: true,
                },
        email:{
                minlength: 3,              
                required: true,

            },
            phone:{
                minlength: 3,               
                number:true,
                required: true,

            },
            birthdate:{
                minlength: 3,               
                required: true,
            },
            password:{
                minlength: 3,              
                required: true,
            },

    },
    messages: {
        first_name: { 
            minlength: $.format("Necesitamos por lo menos {0} caracteres"),          
            required: 'Complete este campo porfavor',
            },
        last_name: {
            minlength: $.format("Necesitamos por lo menos {0} caracteres"),          
            required: 'Complete este campo porfavor',
            },
        dni: {
            minlength: $.format("Necesitamos por lo menos {0} caracteres"),         
            required: 'Complete este campo porfavor',
            },
        email:{
            minlength: $.format("Necesitamos por lo menos {0} caracteres"),          
            required: 'Complete este campo porfavor',
        },
        phone:{
            required: 'Complete este campo porfavor',
            minlength: $.format("Necesitamos por lo menos {0} caracteres"),         
            number:'Solo numeros porfavor',
        },
        birthdate:{
            required: 'Complete este campo porfavor',
            minlength: $.format("Necesitamos por lo menos {0} caracteres"),          
        },
        password:{
            required: 'Complete este campo porfavor',
            minlength: $.format("Necesitamos por lo menos {0} caracteres"),           
        },
    }
});
 });
 

jQuery.validator.addMethod("number",
           function(value, element) {
                   return /^[0-9\d=#$%@_ -]+$/.test(value);
           },
   "Debe ingresar solo números"
);
jQuery.validator.addMethod("alpha", function(value, element) {
    return /^[A-Za-zñÑ\d=#$%@_ -]+$/.test(value);
   },
"Use solo letras"
);

 
 