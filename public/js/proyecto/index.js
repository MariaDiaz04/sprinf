const Toast = Swal.mixin({
  toast: true,
  position: "bottom-start",
  showConfirmButton: false,
});

$(document).ready(function (e) {
  // cargar informacion en formulario de registro historico
  $("#cargarInformacion").click(function (e) {
    e.preventDefault();

    let proyectoSeleccionado = $("#selectProyecto option:selected").data();

    $("#historico #nombre").val(proyectoSeleccionado.nombre);
    $("#historico #motor_productivo").val(
      proyectoSeleccionado.motor_productivo
    );
    $("#historico #parroquia").val(proyectoSeleccionado.parroquia);
    $("#historico #municipio").val(proyectoSeleccionado.municipio);
    $("#historico #direccion").val(proyectoSeleccionado.direccion);
    $("#historico #resumen").val(proyectoSeleccionado.resumen);
    $("#historico #comunidad").val(proyectoSeleccionado.comunidad);
    $("#historico #tutor_in").val(proyectoSeleccionado.tutor_in);
    $("#historico #tutor_ex").val(proyectoSeleccionado.tutor_ex);
  });

  toggleLoading(false);
  // DATATABLE CRUD

  // las acciones son definidas en la clase que contiene el botón, es decir,
  // si necesito editar, le añado la clase "edit"
  // luego en la función table.on(). verifico si la clase del boton en el que hice click
  // contiene el nombre de alguna acción que haya definido

  let table = new DataTable("#example", {
    ajax: proyectosSSP,
    processing: true,
    serverSide: true,
    pageLength: 30,

    columnDefs: [
      {
        visible: false,
        targets: [0, 5],
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return row[6] == 1
            ? `<span class="badge rounded-pill bg-success">Evaluado</span>`
            : `<span class="badge rounded-pill bg-secondary">Pendiente a Evaluar</span>`;
        },
        targets: 6,
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          return `<div class="dropdown show">
                    <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${
                      row[0]
                    }" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-${
                      row[0]
                    }">
                    ${
                      row[6] == 0
                        ? ` <a class="dropdown-item" href="${
                            urlEvaluar + row[0]
                          }">Evaluar</a>
                        <a class="dropdown-item" onClick="editarInformacionProyecto('${
                          row[0]
                        }')" href="#">Editar Proyecto</a>
                        <a class="dropdown-item" onClick="editarIntegrantes('${
                          row[0]
                        }')" href="#">Editar Integrantes</a>
                        <a class="dropdown-item" " href="${
                          noteUrl + "/" + row[0]
                        }" target="_blank">Notas</a>
                        <a class="dropdown-item text-danger" onClick="remove('${
                          row[0]
                        }') href="#">Eliminar</a>`
                        : ``
                    }
                      
                    </div>
                  </div>`;
        }, // combino los botons de acción
        targets: 7, // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
      },
    ],
  });

  $("#proyectoGuardarHistorico").submit(function (e) {
    e.preventDefault();
    toggleLoading(true, "#proyectoGuardarHistorico");
    formData = $(this).serializeArray();
    items = transfer.getSelectedItems();
    data = [...formData];
    counter = 0;
    for (const idIntegrante in items) {
      integrante = {};
      if (Object.hasOwnProperty.call(items, idIntegrante)) {
        const element = items[idIntegrante];
        integrante.name = `integrantes[${counter}]`;
        integrante.value = element.value;
        counter++;
        data.push(integrante);
      }
    }

    url = $(this).attr("action");

    $.ajax({
      type: "POST",
      url: url,
      data: data,
      error: function (error, status) {
        toggleLoading(false, "#proyectoGuardarHistorico");
        Swal.fire({
          position: "bottom-end",
          icon: "error",
          title: error.responseText,
          showConfirmButton: false,
          toast: true,
          timer: 2000,
        });
      },
      success: function (data, status) {
        Swal.fire({
          position: "bottom-end",
          icon: "success",
          title: "Creación Exitosa",
          showConfirmButton: false,
          toast: true,
          timer: 2000,
        });

        $("#historico").modal("hide");
        table.ajax.reload();
        // usar sweetalerts
        document.getElementById("guardar").reset();
        // actualizar tabla
        toggleLoading(false, "#proyectoGuardarHistorico");
      },
    });
  });

  $("#proyectoGuardar").submit(function (e) {
    e.preventDefault();

    toggleLoading(true, "#proyectoGuardar");

    formData = $(this).serializeArray();
    items = transfer2.getSelectedItems();
    data = [...formData];
    counter = 0;
    for (const idIntegrante in items) {
      integrante = {};
      if (Object.hasOwnProperty.call(items, idIntegrante)) {
        const element = items[idIntegrante];
        integrante.name = `integrantes[${counter}]`;
        integrante.value = element.value;
        counter++;
        data.push(integrante);
      }
    }

    url = $(this).attr("action");

    toggleLoading(false);

    $.ajax({
      type: "POST",
      url: url,
      data: data,
      error: function (error, status) {
        toggleLoading(false);
        Swal.fire({
          position: "bottom-end",
          icon: "error",
          title: error.responseText,
          showConfirmButton: false,
          toast: true,
          timer: 2000,
        });
      },
      success: function (data, status) {
        table.ajax.reload();
        // actualizar tabla
        toggleLoading(false);
        Swal.fire({
          position: "bottom-end",
          icon: "success",
          title: "Creación Exitosa",
          showConfirmButton: false,
          toast: true,
          timer: 2000,
        });
        document.getElementById("proyectoGuardar").reset();
        $("#crear").modal("hide");
      },
    });
  });

  // TOGGLE BUTTON AND SPINNER
  function toggleLoading(show, form = "") {
    if (show) {
      $(`${form} #loading`).show();
      $(`${form} #submit`).hide();
    } else {
      $(`${form} #loading`).hide();
      $(`${form} #submit`).show();
    }
  }
});

async function obtenerEstudiantesPendientes() {
  let result;
  try {
    result = await $.ajax({
      url: fetchStudentsUrl,
      type: "POST",
    });
    return JSON.parse(result);
  } catch (error) {
    console.error(error);
    return false;
  }
}

async function obtenerProyecto(id) {
  let result;
  try {
    result = await $.ajax({
      url: obtenerProyectosURL + id,
      type: "POST",
      data: { id: id },
    });
    return JSON.parse(result);
  } catch (error) {
    console.error(error);
    return false;
  }
}

async function editarIntegrantes(id) {
  let proyecto = await obtenerProyecto(id);
  let estudiantesPendientes = await obtenerEstudiantesPendientes();

  $("#actualizar #selectEstudiante option").remove();
  console.log($("#actualizar #selectEstudiante"));
  $("cuerpoTablaActualizarEstudiante").empty();
  console.log($("cuerpoTablaActualizarEstudiante"));

  estudiantesPendientes.forEach((estudiante) => {
    let option = `<option value="${estudiante.cedula}" data-cedula="${
      estudiante.cedula
    }" data-nombre="${estudiante.nombre}" data-apellido="${
      estudiante.apellido
    }">${
      estudiante.cedula + " " + estudiante.nombre + " " + estudiante.apellido
    }</option>`;

    $("#actualizar #selectEstudiante").append(option);
  });
  console.log(estudiantesPendientes);
  console.log("Editando integrantes, ");
  console.log(proyecto);
  const {
    estatus,
    fase_id,
    cerrado,
    nombre,
    municipio,
    parroquia,
    direccion,
    tutor_in,
    tutor_ex,
    comunidad,
    motor_productivo,
    resumen,
  } = proyecto.proyecto;

  const integrantes = proyecto.integrantes;

  $("#actualizar").modal("show");

  $("#actualizar #id").val(id);
  $("#actualizar #fase_id").val(fase_id);
  $("#actualizar #nombre").val(nombre);
  $("#actualizar #municipio").val(municipio);
  $("#actualizar #parroquia").val(parroquia);
  $("#actualizar #direccion").val(direccion);
  $("#actualizar #comunidad").val(comunidad);
  $("#actualizar #tutor_in").val(tutor_in);
  $("#actualizar #tutor_ex").val(tutor_ex);
  $("#actualizar #motor_productivo").val(motor_productivo);
  $("#actualizar #resumen").val(resumen);
  $("#actualizar #cerrado").val(cerrado);

  integrantes.forEach((integrante) => {
    // imprimir tabla
    let row = `<tr id="appenedStudent-${integrante.cedula}">
    <th scope="row">
      <input type="text" name="integrantes[]" class="form-control-plaintext" value="${
        integrante.cedula
      }" hidden>
      ${integrante.cedula}
    </th>
    <td>${integrante.nombre}</td>
    <td>${integrante.apellido}</td>
    ${
      integrante.calificaciones == null
        ? `<td><button class="btn btn-secondary eliminarEstudiante" onClick="removeStudent(${integrante.cedula}); return false" data-id="${integrante.cedula}">Eliminar</button></td>`
        : '<td><button class="btn btn-secondary" disabled >Eliminar</button></td>'
    }
    
  </tr>`;

    $("#cuerpoTablaActualizarEstudiante").append(row);
  });

  console.log(nombre);
}

$("#anadirEstudiante").click(function (e) {
  e.preventDefault();

  let studentsAlreadyAppened = document.getElementById(
    "cuerpoTablaActualizarEstudiante"
  ).children.length;

  if (studentsAlreadyAppened >= 5) {
    alert("limite de estudiantes alcanzado");
  } else {
    let selectedStudent = $("#selectEstudiante option:selected");

    let studentId = $(selectedStudent).val();

    if (
      $("#cuerpoTablaActualizarEstudiante").find(`#appenedStudent-${studentId}`)
        .length > 0
    ) {
      alert("Estudiante ya ha sido añadido");
      return false;
    }

    console.log($(selectedStudent).data("nombre"));
    let fila = `<tr id="appenedStudent-${studentId}">
                <th scope="row">
                <input type="text" name="integrantes[]" class="form-control-plaintext" value="${studentId}" hidden>
                ${$(selectedStudent).data("cedula")}
                </th>
                <td>${$(selectedStudent).data("nombre")}</td>
                <td>${$(selectedStudent).data("apellido")}</td>
                <td><button class="btn btn-secondary eliminarEstudiante" data-id="${studentId}">Eliminar</button></td>
              </tr>`;
    $("#cuerpoTablaActualizarEstudiante").append(fila);

    //$(`#selectEstudiante option[value='${studentId}']`).remove();
  }
});
function removeStudent(id) {
  Swal.fire({
    title: "¿Seguro que desea eliminar integrante de equipo de proyecto?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Continuar",
  }).then((result) => {
    if (result.value) {
      $(`#appenedStudent-${id}`).remove();
    }
  });
}

$(".eliminarEstudiante").click(function (e) {
  e.preventDefault;
});
async function editarInformacionProyecto(id) {
  let proyecto = await obtenerProyecto(id);
  console.log("Editando integrantes, ");
  console.log(proyecto);
}

function remove(id) {
  alert(`Removing ${id}`);
}
