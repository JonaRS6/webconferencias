$(document).ready(function () {
  var tipo = $('#tipo').attr("data-tipo");
  //Crear un registro
  $("#crear-registro").on("submit", function (e) {
    e.preventDefault();

    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr("method"),
      data: datos,
      url: $(this).attr("action"),
      dataType: "json",
      success: function (data) {
        var resultado = data;
        console.log(resultado);
        if (resultado.respuesta === "exito") {
          Swal.fire({
            title: "Bien!",
            text: "Registro creado correctamente",
            icon: "success",
            confirmButtonText: "Cool",
          });
        } else {
          Swal.fire({
            title: "Error!",
            text: "No se pudo crear el registro",
            icon: "error",
            confirmButtonText: "Ok",
          });
        }
      },
    });
    console.log("click!!");
  });
  $("#editar-registro").on("submit", function (e) {
    e.preventDefault();
    
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr("method"),
      data: datos,
      url: $(this).attr("action"),
      dataType: "json",
      success: function (data) {
        var resultado = data;
        console.log(resultado);
        if (resultado.respuesta === "exito") {
          Swal.fire({
            title: "Bien!",
            text: "Registro modificado correctamente",
            icon: "success",
            confirmButtonText: "Cool",
          });
        } else {
          Swal.fire({
            title: "Error!",
            text: "No se pudo modificar el registro",
            icon: "error",
            confirmButtonText: "Ok",
          });
        }
      },
    });
    console.log("click!!");
  });

  //Eliminar un registro
  $(".borrar-registro").on("click", function (e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    var tipo = $(this).attr("data-tipo");
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Un registro no se puede racuperar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, eliminar!",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "post",
          data: {
            id: id,
            registro: "eliminar",
          },
          url: "modelo-" + tipo + ".php",
          success: function (data) {
            console.log(data);
            var resultado = JSON.parse(data);
            jQuery('[data-id="' + resultado.id_eliminado + '"]')
              .parents("tr")
              .remove();
            if (resultado.respuesta === "exito") {
              Swal.fire({
                title: "Bien!",
                text: "registro borrado exitosamente",
                icon: "success",
                confirmButtonText: "Cool",
              });
              jQuery('[data-id="' + resultado.id_eliminado + '"]')
                .parents("tr")
                .remove();
              } else {
              Swal.fire({
                title: "Error!",
                text: "No se pudo borrar el registro",
                icon: "error",
                confirmButtonText: "Ok",
              });
            }
          },
        });
      }
    });
  });

  //Cuear un registro con archivos 
  $("#crear-registro-file").on("submit", function (e) {
    e.preventDefault();

    var datos = new FormData(this);
    $.ajax({
      type: $(this).attr("method"),
      data: datos,
      url: $(this).attr("action"),
      dataType: "json",
      contentType: false,
      processData: false,
      async: true,
      cache: false,
      success: function (data) {
        var resultado = data;
        console.log(resultado);
        if (resultado.respuesta === "exito") {
          Swal.fire({
            title: "Bien!",
            text: "Registro creado correctamente",
            icon: "success",
            confirmButtonText: "Cool",
          });
        } else {
          Swal.fire({
            title: "Error!",
            text: "No se pudo crear el registro",
            icon: "error",
            confirmButtonText: "Ok",
          });
        }
      },
    });
    console.log("click!!");
  });
  $("#editar-registro-file").on("submit", function (e) {
    e.preventDefault();
    
    var datos = new FormData(this);
    $.ajax({
      type: $(this).attr("method"),
      data: datos,
      url: $(this).attr("action"),
      dataType: "json",
      contentType: false,
      processData: false,
      async: true,
      cache: false,
      success: function (data) {
        var resultado = data;
        console.log(resultado);
        if (resultado.respuesta === "exito") {
          Swal.fire({
            title: "Bien!",
            text: "Registro modificado correctamente",
            icon: "success",
            confirmButtonText: "Cool",
          });
        } else {
          Swal.fire({
            title: "Error!",
            text: "No se pudo modificar el registro",
            icon: "error",
            confirmButtonText: "Ok",
          });
        }
      },
    });
    console.log("click!!");
  });
  //Login de admins
  $("#login-admin").on("submit", function (e) {
    e.preventDefault();
  
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr("method"),
      data: datos,
      url: $(this).attr("action"),
      dataType: "json",
      success: function (data) {
        console.log(data);
        var resultado = data;
        if (resultado.respuesta == "exitoso") {
          Swal.fire({
            title: "Login correcto!",
            text: "Bienvenido " + resultado.usuario + "!!!",
            icon: "success",
            confirmButtonText: "Cool",
          });
          setTimeout(function () {
            window.location.href = "admin-area.php";
          }, 1500);
        } else {
          Swal.fire({
            title: "Error!",
            text: "Usuario o password incorrectos",
            icon: "error",
            confirmButtonText: "Ok",
          });
        }
      },
    });
    console.log("click!!");
  });
});
