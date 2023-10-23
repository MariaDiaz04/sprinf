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

    const {
      nombre,
      tutor_in,
      tutor_ex,
      direccion,
      resumen,
      parroquiaId,
      tlf_tex,
      comunidad,
      codigoSiguienteTrayecto,
    } = proyectoSeleccionado;
    id = $("#proyectoGuardarHistorico .transfer-double-list-search input").attr(
      "id"
    );

    $(`#${id}`).val(nombre);
    transfer.manualSearch();

    $(`#${id}`).trigger("keyup");

    $("#historico #nombre").val(nombre);

    $(
      `#proyectoGuardarHistorico #selectParroquia option[value="${parroquiaId}"]`
    )
      .prop("selected", "selected")
      .change();

    $(
      `#proyectoGuardarHistorico #selectTrayecto option[value="${codigoSiguienteTrayecto}"]`
    )
      .prop("selected", "selected")
      .change();

    $(`#proyectoGuardarHistorico #selectTutorIn option[value="${tutor_in}"]`)
      .prop("selected", "selected")
      .change();
    // $("#historico #motor_productivo").val(motor_productivo);
    // $("#historico #parroquia").val(parroquia);
    // $("#historico #municipio").val(municipio);
    $("#proyectoGuardarHistorico #direccion").val(direccion);
    $("#proyectoGuardarHistorico #resumen").val(resumen);
    $("#proyectoGuardarHistorico #comunidad").val(comunidad);
    $("#proyectoGuardarHistorico #tlf_tex").val(tlf_tex);
    // $("#historico #tutor_in").val(tutor_in);
    $("#proyectoGuardarHistorico #tutor_ex").val(tutor_ex);
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
        targets: [0, 5, 7],
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
                          }">Evaluar</a><a class="dropdown-item" onClick="editarIntegrantes('${
                            row[0]
                          }')" href="#">Editar</a>
                          <a class="dropdown-item" href="${
                            noteUrl + "/" + row[0]
                          }" target="_blank">Notas</a>
                        ${
                          row[7].includes("_1")
                            ? `
                        
                        <a class="dropdown-item text-danger" onClick="removeProject('${row[0]}')" href="#">Eliminar</a>`
                            : ``
                        } `
                        : ``
                    }
                      
                    </div>
                  </div>`;
        }, // combino los botons de acción
        targets: 8, // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 8va
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

    if (items.length <= 0) {
      Swal.fire({
        position: "bottom-end",
        icon: "error",
        title: "Debe añadir integrantes",
        showConfirmButton: false,
        toast: true,
        timer: 2000,
      });
      toggleLoading(false);
    } else {
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
            timer: 1000,
          }).then(function () {
            location.reload();
          });

          // $("#historico").modal("hide");
          table.ajax.reload();
          // usar sweetalerts
          document.getElementById("guardar").reset();
          // actualizar tabla
          toggleLoading(false, "#proyectoGuardarHistorico");
        },
      });
    }
  });

  $("#proyectoGuardar").submit(function (e) {
    e.preventDefault();

    toggleLoading(true, "#proyectoGuardar");

    formData = $(this).serializeArray();

    items = transfer2.getSelectedItems();
    data = [...formData];
    counter = 0;
    if (items.length <= 0) {
      Swal.fire({
        position: "bottom-end",
        icon: "error",
        title: "Debe añadir integrantes",
        showConfirmButton: false,
        toast: true,
        timer: 2000,
      });
      toggleLoading(false);
    } else {
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
            timer: 1000,
          }).then(() => location.reload());
          document.getElementById("proyectoGuardar").reset();
          // $("#crear").modal("hide");
        },
      });
    }
  });

  $("#proyectoActualizar").submit(function (e) {
    e.preventDefault();

    formData = $(this).serializeArray();
    if ($("#cuerpoTablaActualizarEstudiante").children("tr").length <= 0) {
      Swal.fire({
        position: "bottom-end",
        icon: "error",
        title: "Debe ingresar integrantes",
        showConfirmButton: false,
        toast: true,
        timer: 2000,
      });
    } else {
      url = $(this).attr("action");

      $.ajax({
        type: "POST",
        url: url,
        data: formData,
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
            title: "Actualización Exitosa",
            showConfirmButton: false,
            toast: true,
            timer: 1000,
          });
          document.getElementById("proyectoGuardar").reset();
          $("#actualizar").modal("hide");
        },
      });
    }
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
  $("#cuerpoTablaActualizarEstudiante tr").remove();
  console.log($("#actualizar #selectEstudiante option"));
  console.log($("#cuerpoTablaActualizarEstudiante tr"));

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

  const {
    estatus,
    fase_id,
    cerrado,
    nombre,
    municipio,
    parroquia,
    parroquia_id,
    direccion,
    tutor_in,
    tutor_ex,
    tlf_tex,
    comunidad,
    motor_productivo,
    resumen,
  } = proyecto.proyecto;

  if (!fase_id.includes("_1")) {
    $("#actualizar #selectEstudiante").prop("disabled", "disabled");
    $("#actualizar #anadirEstudiante").prop("disabled", "disabled");
  } else {
    $("#actualizar #selectEstudiante").removeAttr("disabled");
    $("#actualizar #anadirEstudiante").removeAttr("disabled");
  }

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
  $("#actualizar #tlf_tex").val(tlf_tex);
  $("#actualizar #motor_productivo").val(motor_productivo);
  $("#actualizar #resumen").val(resumen);
  $("#actualizar #cerrado").val(cerrado);

  $(`#proyectoActualizar #selectParroquia option[value="${parroquia_id}"]`)
    .prop("selected", "selected")
    .change();

  $(`#proyectoActualizar #selectTutorIn option[value="${tutor_in}"]`)
    .prop("selected", "selected")
    .change();

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

    let fila = `<tr id="appenedStudent-${studentId}">
                <th scope="row">
                <input type="text" name="integrantes[]" class="form-control-plaintext" value="${studentId}" hidden>
                ${$(selectedStudent).data("cedula")}
                </th>
                <td>${$(selectedStudent).data("nombre")}</td>
                <td>${$(selectedStudent).data("apellido")}</td>
                <td><button class="btn btn-secondary eliminarEstudiante" onClick="removeStudent(${studentId}); return false" data-id="${studentId}">Eliminar</button></td>
              </tr>`;
    $("#cuerpoTablaActualizarEstudiante").append(fila);
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

async function editarInformacionProyecto(id) {
  let proyecto = await obtenerProyecto(id);
  console.log("Editando integrantes, ");
  console.log(proyecto);
}

function removeProject(id) {
  Swal.fire({
    title:
      "Se eliminará el proyecto indicado, ¿está seguro de realizar la acción?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Continuar",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: "POST",
        url: deleteUrl,
        data: {
          id: id,
        },
        error: function (error, status) {
          error = JSON.parse(error.responseText);
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: status + ": " + error.error.message,
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
        },
        success: function (data, status) {
          // actualizar tabla
          Swal.fire({
            position: "bottom-end",
            icon: "success",
            title: "Proyecto Eliminado Exitosamente",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          }).then(() => location.reload());
        },
      });
    }
  });
}
