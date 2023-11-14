<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Inscripción / <?= $materia->nombre_trayecto ?> </span>/ <?= $materia->nombre_materia ?></div>
        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white"><b>Inscripciones</b> - <?= $periodo->fecha_inicio ?> / <?= $periodo->fecha_cierre ?></h6>
    
    <div class="card-body px-3 pt-3">
      <table id="example" class="display" style="width:100%">
        <thead>
          <tr>
            <th>id</th>
            <th>Sección</th>
            <th>estudiante_id</th>
            <th>cedula</th>
            <th>Nombre</th>
            <th>Código de Materia</th>
            <th>Nombre de Materia</th>
            <th>calificacion</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!-- MODAL CREAR -->
  <div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
           <h5 class="modal-title" id="crearLabel">Inscripcion</h5> 
          </div>
            <div class="card-body">
            
            <div class="form-group">
            <table id="datatable_t" class="table table-hover display">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre y apellido</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    <?php foreach($estudiantes as $dato): ?>
                    <tr>
                        <td><?= $dato->cedula ?></td>
                        <td><?= $dato->nombre ?> <?= $dato->apellido ?></td>
                        <td><?= $dato->direccion ?></td>
                        <td><?= $dato->telefono ?></td>
                        <td>Inscribir</td>
                    </tr>
                <?php endforeach; ?>
                    </tbody>
                </table>            
                             
             </div>
        
                 
                    <!-- <div class="col-lg-5">
                      <label class="form-label" for="nombreItem">Nombre *</label>
                      <input type="text" class="form-control mb-1" placeholder="Jose" id="nombreItem">
                    </div> -->
                  <div class="row form-group align-items-end">
                    <div class="col-lg-3 align-middle">
                      <button class="btn btn-primary" id="anadirItem">Añadir</button>
                    </div>
                  </div>


         <!--div class="row form-group justify-content-center">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Sección</th>
                          <th scope="col">Cedula</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Remover</th>
                        </tr>
                      </thead>
                      <tbody id="cuerpoTablaItems">

                      </tbody>
                    </table>
                  </div>
            </div-->
          

           <!-- footer de acciones -->
           <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Guardar" id="guardarSubmit">
            <div id="guardarLoading">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only"></span>
              </div>
            </div>
          </div>

        </div>
      </div>
  </div>
</div>


  <script>
    
    let deleteUrl = "<?= APP_URL . $this->Route('inscripcion/delete') ?>";
    
    $(document).ready(() => {
    

      toggleLoading(false)
      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('ssp/' . $idMateria) ?>',
        processing: true,
        serverSide: true,
        pageLength: 30,

        columnDefs: [{
            visible: false,
            targets: [0, 2, 5, 6]
          },
          {
            data: null,
            render: function(data, type, row, meta) {
              return (row[7]) ? row[7] : 'No evaluado';
            }, // combino los botons de acción
            targets: 7 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
          }
        ]


        
        // columnDefs: [{
        //   data: null,
        //   render: function(data, type, row, meta) {
        //     return `<div class="dropdown show">
        //               <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        //               <i class="bx bx-dots-vertical-rounded"></i>
        //               </button>
        //               <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
        //                 ${(row[5] ? `<a class="dropdown-item" onClick="edit('${row[0]}')" href="#">Gestionar Inscripciones</a>`:'' )}
        //                 <a class="dropdown-item" onClick="edit('${row[0]}')" href="#">Editar</a>
        //                 <a class="dropdown-item text-danger" onClick="remove('${row[0]}')" href="#">Eliminar</a>
        //               </div>
        //             </div>`;
        //   }, // combino los botons de acción
        //   targets: 5 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        // }]
      });
        ///////INICIO
        const spanish = {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"}}
 var pensum_table = $('#datatable_t').DataTable({
      "responsive": {
      "pagingType": "simple_numbers"
    },
     language: spanish,
 "autoWidth":true,
    "oLanguage": {
      "oPaginate": {
        "sNext": '<i class="icon-angle-double-right"></i>',
        "sPrevious": '<i class="icon-angle-double-left"></i>'
              }
         },
         columns: [
        { data: 'cedula' ,"width": "50%"},
        { data: 'nombre' ,"width": "50%"},
        { data: 'direccion' ,"width": "50%"},
        { data: 'telefono' ,"width": "50%"},
        {data: 'Inscribir',
          "render":
                  function ( data, type, row ) {
            data =  `<input type="button" class="btn btn-sm btn-outline-success save" name="save" value="<?= $dato->cedula ?>">`;
      
        return data;     
              },"width": "10%",
            },
         ],

         "fnInitComplete": function () { jQuery('.dataTables_scrollHeadInner').css('width', '98%')}, //changing the width }, 
         "pagingType": "simple_numbers",
         "processing": true,
         "responsive": true,
         "pagination":true,   
 } ); 

 $('.save').on('click', function() {
    // var opc = $('#tipo').val()
    var array = new Array();
    console.log($(this).val())
    let cedula = $(this).val()
    let url = "inscripcionController/store";
    //Debo crear ruta hacia controlador para la función donde se guardará la inscripción y en la funcion usar el save para guardar

    });

        //////////FIN

      $('#guardar').submit(function(e) {
        e.preventDefault()

        toggleLoading(true, '#guardar');


        url = $(this).attr('action');
        data = $(this).serializeArray();

        $.ajax({
          type: "POST",
          url: url,
          data: data,
          error: function(error, status) {
            toggleLoading(false, '#guardar')
            Swal.fire({
              position: 'bottom-end',
              icon: 'error',
              title: error.responseText,
              showConfirmButton: false,
              toast: true,
              timer: 2000
            })

          },
          success: function(data, status) {
            table.ajax.reload();
            // usar sweetalerts
            document.getElementById("guardar").reset();
            // actualizar tabla
            toggleLoading(false, '#guardar')
          },
        });

      })

      $('#actualizar').submit(function(e) {
        e.preventDefault()

        toggleLoading(true, '#actualizar');


        url = $(this).attr('action');
        data = $(this).serializeArray();

        $.ajax({
          type: "POST",
          url: url,
          data: data,
          error: function(error, status) {
            toggleLoading(false, '#actualizar')
            Swal.fire({
              position: 'bottom-end',
              icon: 'error',
              title: error.responseText,
              showConfirmButton: false,
              toast: true,
              timer: 2000
            })

          },
          success: function(data, status) {
            table.ajax.reload();
            // actualizar tabla
            toggleLoading(false, '#actualizar')

            $('#editar').modal('hide')
          },
        });

      })

      // TOGGLE BUTTON AND SPINNER
      function toggleLoading(show, form = '') {
        if (show) {
          $(`${form} #loading`).show();
          $(`${form} #submit`).hide();
        } else {
          $(`${form} #loading`).hide();
          $(`${form} #submit`).show();
        }

      }

      $(function() { 
        $('#input-estudiante').on('change', function() {
        let val  = $(this).val();
        console.log(val);
        //$('#buscarCarreras').attr('href','/inscribir_nuevo/'+val);
        //$('#buscarCarreras').attr('href','/inscribir_nuevo/'+val);
    });
    });

    })

    function edit(id) {
      $.ajax({
        type: "POST",
        url: updateUrl,
        data: {
          'codigo': id
        },
        error: function(error, status) {
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: error.responseText,
            showConfirmButton: false,
            toast: true,
            timer: 2000
          })

        },
        success: function(data, status) {

          renderUpdateForm(JSON.parse(data))
        },
      });
    }

    function renderUpdateForm(data) {

      $('#editar').modal('show')

      // seleccionar trayecto
      $(`#actualizar #trayecto_id option[value='${data.materia.trayecto_id}']`).attr("selected", true);
      // seleccionar periodo
      $(`#actualizar #periodo option[value='${data.materia.periodo}']`).attr("selected", true);

      $(`#actualizar #codigo`).val(data.materia.materia_id);
      $(`#actualizar #nombre`).val(data.materia.nombre);
      $(`#actualizar #eje`).val(data.materia.eje);

      $(`#actualizar #htasist`).val(data.materia.htasist);
      $(`#actualizar #htind`).val(data.materia.htind);
      $(`#actualizar #ucredito`).val(data.materia.ucredito);
      $(`#actualizar #hrs_acad`).val(data.materia.hrs_acad);

    }


    $('#anadirItem').click(function(e) {
        e.preventDefault();

        let length = document.getElementById("cuerpoTablaItems").children.length;


        let nombreItem = $('#nombreItem').val();
        let ponderacionItem = $('#ponderacionItem').val()
        console.log(nombreItem)
        console.log(ponderacionItem)
        let fila = `<tr id="appenedItem-${length}">
                    <th scope="row">
                    <input type="text" name="indicadores[${length}][nombre]" class="form-control-plaintext" value="${nombreItem}" hidden>     
                    ${nombreItem}
                    </th>
                    
                    <td><a href="#" class="btn btn-secondary" onClick="removeItem(${length})">Eliminar</a href="javascript:void(0)"></td>
                  </tr>`;
        $('#cuerpoTablaItems').append(fila);

      })

    function remove(id) {
      $.ajax({
        type: "POST",
        url: deleteUrl,
        data: {
          'codigo': id
        },
        error: function(error, status) {
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: error.responseText,
            showConfirmButton: false,
            toast: true,
            timer: 2000
          })

        },
        success: function(data, status) {
          alert('Materia borrada exitosamente')
          $('#example').DataTable().ajax.reload();
        },
      });

      /*input_estudiante.on('input', function() {
      
        let filtro = input_estudiante.val();
        console.log(filtro)
        $.each(resultados, function(index, resultado) {
                selectResultados.append($('<option>', {
                    value: resultado.id,
                    text: resultado.nombre
                }));
            });
      }*/
    }
  </script>