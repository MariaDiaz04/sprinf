function validarkeypress(er,e){
    
    key = e.keyCode;
    
    tecla = String.fromCharCode(key);
    a = er.test(tecla);
    if(!a){
        e.preventDefault();
    } 
}

//Función para validar por keyup
function validarkeyup(er,etiqueta,etiquetamensaje,
mensaje){
    a = er.test(etiqueta.val());
    if(a){
        etiquetamensaje.text("");
        return 1;
    }
    else{
        etiquetamensaje.text(mensaje);
        return 0;
    }
}
    $(document).ready(function(){

//VALIDAR CATEGORIA

    $("#nombre").on("keypress",function(e){
        validarkeypress(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]*$/,e);
    });
    
    $("#nombre").on("keyup",function(){
        validarkeyup(/^[A-Za-z\b\s\u00f1\u00d1\u00E0-\u00FC]{3,20}$/,
        $(this),$("#snombre"),"Solo letras entre 3 y 20 caracteres");
    });





}); 