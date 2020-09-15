(function () {
  "use strict";

  var regalo = document.getElementById("regalo");
  document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("map")) {
      // aquí debe ir todo tu código del mapa
      var map = L.map("map").setView([20.67511, -103.387506], 16);

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
          '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      }).addTo(map);

      L.marker([20.67511, -103.387506])
        .addTo(map)
        .bindPopup("GDLWEBCAMP 2018<br> Boletos ya dispoibles.")
        .openPopup();
    }

    //Campos datos usuario
    var nombre = document.getElementById("nombre");
    var apellido = document.getElementById("apellido");
    var email = document.getElementById("email");
    //Campos pases
    var pase_dia = document.getElementById("pase_dia");
    var pase_completo = document.getElementById("pase_completo");
    var pase_dosdias = document.getElementById("pase_dosdias");
    //Botones y divs
    var calcular = document.getElementById("calcular");
    var errorDiv = document.getElementById("error");
    var botonRegistro = document.getElementById("btnRegistro");
    var lista_productos = document.getElementById("lista-productos");
    var suma = document.getElementById("suma-total");
    //Extras
    var camisas = document.getElementById("camisa_evento");
    var etiquetas = document.getElementById("etiquetas");
    botonRegistro.disabled = true;

    calcular.addEventListener("click", calcularMontos);
    pase_dia.addEventListener("change", mostrarDias);
    pase_dosdias.addEventListener("change", mostrarDias);
    pase_completo.addEventListener("change", mostrarDias);

    function calcularMontos(event) {
      event.preventDefault();
      if (regalo.value === "") {
        alert("Debes elegir un regalo");
        regalo.focus();
      } else {
        var boletosDia = parseInt(pase_dia.value, 10) || 0,
          boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
          boletosCompleto = parseInt(pase_completo.value, 10) || 0,
          cantCamisas = parseInt(camisas.value, 10) || 0,
          cantEtiquetas = parseInt(etiquetas.value, 10) || 0;

        var totalPagar =
          boletosDia * 30 +
          boletos2Dias * 45 +
          boletosCompleto * 50 +
          cantCamisas * 10 * 0.93 +
          cantEtiquetas * 2;
        console.log(totalPagar);
        var listadoProductos = [];
        if (boletosDia >= 1) {
          listadoProductos.push(boletosDia + " Pases por día");
        }
        if (boletos2Dias >= 1) {
          listadoProductos.push(boletos2Dias + " Pases por 2 días");
        }
        if (boletosCompleto >= 1) {
          listadoProductos.push(boletosCompleto + " Pases completos");
        }
        if (cantCamisas >= 1) {
          listadoProductos.push(cantCamisas + " Camisas");
        }
        if (cantEtiquetas >= 1) {
          listadoProductos.push(cantEtiquetas + " Etiquetas");
        }
        console.log(listadoProductos);
        lista_productos.style.display = "block";
        lista_productos.innerHTML = "";
        for (var i = 0; i < listadoProductos.length; i++) {
          lista_productos.innerHTML += listadoProductos[i] + "</br>";
        }
        suma.style.display = "block";
        suma.innerHTML = "$ " + totalPagar.toFixed(2);

        botonRegistro.disabled = false;
        document.getElementById('total_pedido').value = totalPagar.toFixed(2);
      }
    }

    function mostrarDias() {
      var boletosDia = parseInt(pase_dia.value, 10) || 0,
        boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
        boletosCompleto = parseInt(pase_completo.value, 10) || 0;
      let viernes = document.getElementById("viernes"),
        sabado = document.getElementById("sabado"),
        domingo = document.getElementById("domingo");

      var diasElegidos = [];
      if (boletosDia > 0) {
        diasElegidos.push("viernes");
      } else {
        viernes.style.display = "none";
      }
      if (boletos2Dias > 0) {
        diasElegidos.push("viernes", "sabado");
      } else {
        sabado.style.display = "none";
      }
      if (boletosCompleto > 0) {
        diasElegidos.push("viernes", "sabado", "domingo");
      } else {
        domingo.style.display = "none";
      }

      for (var i = 0; i < diasElegidos.length; i++) {
        document.getElementById(diasElegidos[i]).style.display = "block";
      }
    }
  }); //DOM Content Loaded
})();

$(function() { 

  //Programa conferencias
  $('.program__content .program__tabs__content:first').show();
  $('.program__tabs a:first').addClass('program__tabs--active');
  $('.program__tabs a').on('click', function(){
    $('.program__tabs a').removeClass('program__tabs--active');
    $(this).addClass('program__tabs--active');
    $('.hide').hide();
    var enlace = $(this).attr('href');
    $(enlace).fadeIn(1000);
    return false;
  });

  //Lettering
  $('.hero__info__tittle').lettering();


  //Link activo 
  $('body.conferencia .menu__links a:contains("Conferencias")').addClass('activo');
  $('body.calendario .menu__links a:contains("Calendario")').addClass('activo');
  $('body.invitados .menu__links a:contains("Invitados")').addClass('activo');
  $('body.registro .menu__links a:contains("Reservaciones")').addClass('activo');

  //Menu fijo
  var windowHeight = $(window).height();
  var navHeight = $('.menu').innerHeight();
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if(scroll > windowHeight) {
      $('.menu').addClass('fixed');
      $('body').css({'margin-top': navHeight+'px'})
    } else {
      $('.menu').removeClass('fixed');
      $('body').css({'margin-top': 0})
    }
  });

  //Menu Responsive
  $('.menu__bars').on('click', function(){
    $('.menu__links').slideToggle();
  });

  //cuenta regresiva
  $('#cuenta-regresiva').countdown('2020/12/10 09:00:00', function(event){
    $('#dias .counter__number').html(event.strftime('%D'));
    $('#horas .counter__number').html(event.strftime('%H'));
    $('#minutos .counter__number').html(event.strftime('%M'));
    $('#segundos .counter__number').html(event.strftime('%S'));
  });

  //Colorbox

  $('.invitado-info').colorbox({inline:true, width:"50%"});
  $('#btn_newsletter').colorbox({inline:true, width:"50%"});
});