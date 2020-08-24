<?php
include_once 'includes/templates/header.php';

use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payment;

require 'includes/paypal.php';
?>
<section class="container">
  <h2 class="text-center">Registro de usuarios</h2>
  <div class="tittle-decorator">
    <i class="fas fa-ellipsis-h"></i>
  </div>
  <?php


  if (isset($_GET['paymentId'])) {
    $paymentId = $_GET['paymentId'];
  }
  if (isset($_GET['id_pago'])) {
    $id_pago = $_GET['id_pago'];
  }

  //Peticion REST API

  $pago = Payment::get($paymentId, $apiContext);
  $execution = new PaymentExecution();
  $execution->setPayerId($_GET['PayerID']);
  $resultado = $pago->execute($execution, $apiContext);
  $respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;


  if ($respuesta == "completed") {
    echo "<div class='resultado correcto'>";
    echo "El pago se realizo correctamente! ";
    echo "El id es {$paymentId} ";
    echo "</div>";
    require_once('includes/functions/bd_connection.php');
    $stmt = $conn->prepare('UPDATE registrados SET pagado = ? WHERE id_registrado = ?');
    $pagado = 1;
    $stmt->bind_param('ii', $pagado, $id_pago);
    $stmt->execute();
    $stmt->close();
    $conn->close();
  } else {
    echo "<div class='resultado error'>";

    echo "El pago no se realizo! ";

    echo "</div>";
  }

  ?>
</section>


<?php include_once 'includes/templates/footer.php'; ?>