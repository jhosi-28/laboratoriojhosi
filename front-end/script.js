document.addEventListener("DOMContentLoaded", function () {
  $("#guardarComputadora").on("click", function () {
    let datos = {
      nombre_modelo: $("#nombre_modelo").val(),
      fabricante: $("#fabricante").val(),
      precio: $("#precio").val(),
      procesador: $("#procesador").val(),
    };
    if ($("#id-computadora").val() === "") {
      crearComputadora(datos);
    } else {
      datos.id = $("#id-computadora").val();
      editarComputadora(datos);
    }
  });

  $("#agregarComputadora").on("click", function () {
    $("#id-computadora").val("");
  });
  $(".btn-warning").on("click", function () {
    let idComputadora = $(this).data("id");
    $("#id-computadora").val(idComputadora);
  });

  $(".btnEliminar").on("click", function () {
    let idComputadora = $(this).data("id");
    $("#id-computadora").val(idComputadora);
  });

  $("#btnEliminarComputadora").click(function () {
    let id = $("#id-computadora").val();
    eliminar(id);
  });
});
//al abrir el modalverifica si hay un id valido si lo hay lo rellena para un actualizar
$("#computadora").on("shown.bs.modal", function () {


  if ($("#id-computadora").val() !== "") {
    $.ajax({
      type: "GET",
      url: "http://localhost/laboratorio/apirestJhose/get_id_computadoras.php",
      dataType: "JSON",
      data: { id: $("#id-computadora").val() },
      success: function (respuesta) {
        $("#nombre_modelo").val(respuesta[0].nombre_modelo);
        $("#fabricante").val(respuesta[0].fabricante);
        $("#precio").val(respuesta[0].precio);
        $("#procesador").val(respuesta[0].procesador);
      },
      error: function (error) {
        // Manejar errores
        console.error("Error en la solicitud AJAX:", error);
        Swal.fire({
          title: "Error",
          text: "error:" + error,
          icon: "error",
        });
      },
    });
  }else{
    $("#nombre_modelo").val("");
        $("#fabricante").val("");
        $("#precio").val("");
        $("#procesador").val("");
  }
  
});

function crearComputadora(datos = {}) {
  let errores = false;

  for (let campo in datos) {
    if (datos[campo].trim() == "") {
      $("#" + campo)
        .removeClass("is-valid")
        .addClass("is-invalid");
      errores = true;
    } else {
      $("#" + campo)
        .removeClass("is-invalid")
        .addClass("is-valid");
    }
  }
  if (errores) {
    Swal.fire({
      title: "Error",
      text: "error: porfavor llene todos los campos",
      icon: "error",
    });
    return;
  }

  $.ajax({
    type: "POST",
    url: "http://localhost/laboratorio/apirestJhose/create_computadoras.php",
    data: datos,
    dataType: "json",
    success: function (respuesta) {
      $("#computadora").modal("hide");

      $("#nombre_modelo").val(""),
        $("#fabricante").val(""),
        $("#precio").val(""),
        $("#procesador").val("")
        console.log(respuesta);
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    }
  });
  location.reload();
}

function editarComputadora(datos = {}) {
  let errores = false;

  for (let campo in datos) {
    if (datos[campo].trim() === "") {
      $("#" + campo)
        .removeClass("is-valid")
        .addClass("is-invalid");
      errores = true;
    } else {
      $("#" + campo)
        .removeClass("is-invalid")
        .addClass("is-valid");
    }
  }
  if (errores) {
    Swal.fire({
      title: "Error",
      text: "error: porfavor llene todos los campos",
      icon: "error",
    });
    return;
  }

  $.ajax({
    type: "PUT",
    url: "http://localhost/laboratorio/apirestJhose/update_computadoras.php",
    data: datos,
    dataType: "json",
    success: function (respuesta) {
      $("#computadora").modal("hide");

      $("#nombre_modelo").val(""),
        $("#fabricante").val(""),
        $("#precio").val(""),
        $("#procesador").val(""),
        console.log(respuesta);
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    },
  });
  location.reload();
}

function eliminar(id) {
  console.log(id);
  $.ajax({
    type: "DELETE",
    url: "http://localhost/laboratorio/apirestJhose/delete_computadoras.php?id=" + id,
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      $('modalEliminar').modal('hide')
      Swal.fire({
        title: "Exito",
        text: respuesta.message,
        icon: "success",
        timer: 5000,
      }).then(() => {
        location.reload();
      });
    },
  });
  location.reload();
}
