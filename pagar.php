<?php

if (!isset($_POST['submit'])) {
  exit("hubo un error");
}

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;


require 'includes/paypal.php';

if (isset($_POST['submit'])) :
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $regalo = $_POST['regalo'];
  $total = $_POST['total_pedido'];
  $fecha = date('Y-m-d H:i:s');


  //Pedidos
  $boletos = $_POST['boletos'];
  $numeroBoletos = $boletos;
  $pedidoExtra = $_POST['pedido_extra'];
  $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
  $precioCamisas = $_POST['pedido_extra']['camisas']['precio'];
  $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
  $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];



  include_once 'includes/functions/funciones.php';
  $pedido = productosJson($boletos, $camisas, $etiquetas);

  //Eventos
  $eventos = $_POST['registro'];
  $registro = eventosJson($eventos);
  $pagado = 0;





  try {
    require_once('includes/functions/bd_connection.php');
    $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado, pagado) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssisi", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total, $pagado);
    $stmt->execute();
    $id_registro = $stmt->insert_id;
    $stmt->close();
    $conn->close();
    //header('Location: validar_registro.php?exitoso=1');
  } catch (\Exception $_e) {
    echo $e->getMessage();
  }

endif;



$compra = new Payer();
$compra->setPaymentMethod('paypal');


$i = 0;
$arreglo_pedido = array();
foreach ($numeroBoletos as $key => $value) {
  if ($value['cantidad'] > 0) {

    ${"articulo$i"} = new Item();
    ${"articulo$i"}->setName('Pase: ' . $key)
      ->setCurrency('USD')
      ->setQuantity((int) $value['cantidad'])
      ->setPrice((int) $value['precio']);
    $arreglo_pedido[] = ${"articulo$i"};
    $i++;
  }
}

foreach ($pedidoExtra as $key => $value) {
  if ($value['cantidad'] > 0) {

    if ($key == 'camisas') {
      $precio = (float) $value['precio'] * .93;
    } else {
      $precio = (int) $value['precio'];
    }

    ${"articulo$i"} = new Item();
    ${"articulo$i"}->setName('Extras: ' . $key)
      ->setCurrency('USD')
      ->setQuantity((int) $value['cantidad'])
      ->setPrice($precio);
    $arreglo_pedido[] = ${"articulo$i"};
    $i++;
  }
}




$listaArticulos = new ItemList();
$listaArticulos->setItems($arreglo_pedido);




$cantidad = new Amount();
$cantidad->setCurrency('USD')
  ->setTotal($total);


$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
  ->setItemList($listaArticulos)
  ->setDescription('Pago GDLWebCamp')
  ->setInvoiceNumber($id_registro);
  
  
  $redireccionar = new RedirectUrls();
  $redireccionar->setReturnUrl(URL_SITIO . "/pago_finalizado.php?id_pago={$id_registro}")
  ->setCancelUrl(URL_SITIO . "/pago_finalizado.php?id_pago={$id_registro}");
  
  
  $pago = new Payment();
  $pago->setIntent("sale")
  ->setPayer($compra)
  ->setRedirectUrls($redireccionar)
  ->setTransactions(array($transaccion));
  
  try {
    $pago->create($apiContext);
     } catch (PayPal\Exception\PayPalConnectionException $pce) {
       // Don't spit out errors or use "exit" like this in production code
       echo '<pre>';print_r(json_decode($pce->getData()));exit;
      }
      
$aprobado = $pago->getApprovalLink();


header("Location: {$aprobado}");
/*
*/