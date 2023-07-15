$('.eliminar').on('click', function() {
    var id = this.id;
    console.log(id);
    swal({
        title: "¿Estas seguro?",
        text: "¡No podras revertir este paso!!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ca3333",
        cancelButtonColor: "#1c2730",
        confirmButtonText: "¡Si, eliminar!",
        cancelButtonText: "¡No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: false,
        },
        function (isConfirm) {
            if (isConfirm) {
                $.get('?r=usuario/eliminar&id='+id, function(data) {
                    console.log(data);
                    $('#i'+id).attr({ hidden: '', });
                    swal("Hecho!", "El usuario ha eliminado ", "success");
                });
            } else { 
                    swal("¡Cancelado!", "El usuario no se ha podido eliminar ", "error");
            }
        });
});

$('#search').on('submit', function(event) {
    event.preventDefault();
    if ($("#dni").val().length!=0) {
        $('.CUser').attr({hidden:''});
        $('.CU'+$("#dni").val()).removeAttr('hidden');
        $("#dni").val('');
    }else{swal('Ayuda?','Debes ingrsar un DNI para buscarlo','info'); }

});

$("#dni").on('keyup', function(e) {
    if (e.keyCode==8 && $("#dni").val().length==0) {
        $('.CUser').removeAttr('hidden');
    }
});

$(document).ready(function() {
    $('#tableUser').DataTable();
} );