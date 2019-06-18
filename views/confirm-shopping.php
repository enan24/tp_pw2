<?php
  require_once("../controllers/confirm-shopping.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Confirmar compra</title>
    <?php
      include_once "../resources/templates/css.html";
      include_once "../resources/templates/javascript.html";
    ?>
    <link rel="stylesheet" href="../resources/css/confirm.css">
  </head>
  <body>
    <?php
      include_once "../resources/templates/navbar.php";
    ?>
    <br>
    <div class="container">
      <div class="order_box">
        <h2>Su compra</h2>
        <ul class="list">
          <li><a>Producto <span>Total</span></a></li>
          <?php
            foreach ($products as $product) {
              echo "
                <li><a>".$product['title']." <span class='middle'>x ".$product['cant']."</span> <span class='last'>".$product['price'] * $product['cant']."</span></a></li>
              ";
            }
          ?>
        </ul>
        <ul class="list list_2">
          <li><a>Subtotal <span class="last">$<?php echo $total; ?></span></a></li>
          <li><a>Envio <span class="last">$150.00</span></a></li>
          <li><a>Total <span class="last">$<?php echo $total + 150; ?></span></a></li>
        </ul>
        <div class="payment_item">
          <div class="radion_btn">
            <input type="radio" id="f-option5" name="selector" value="card">
            <label for="f-option5">Pagar con Tarjeta</label>
            <div class="check"></div>
          </div>
          <p>Se puede pagar con tarjeta hasta 12 cuotas sin interes.</p>
        </div>
        <div class="payment_item">
          <div class="radion_btn">
            <input type="radio" id="f-option6" name="selector" value="paypal">
            <label for="f-option6">Paypal </label>
            <div class="check"></div>
          </div>
          <p>Pagar por Paypal.</p>
        </div>
        <div class="payment_item">
          <div class="radion_btn">
            <input type="radio" id="f-option7" name="selector" value="other">
            <label for="f-option7">PagoFacil o Rapipago</label>
            <div class="check"></div>
          </div>
          <p>Pagar con PagoFacil o Rapipago</p>
        </div>
        <div class="creat_account">
          <input type="checkbox" id="f-option4" name="selector">
          <label for="f-option4">Usted tiene que leer y aceptar los </label>
          <a href="#">terminos y condiciones*</a>
        </div>
        <p id="error"></p>
        <a class="primary-btn" onclick="payment()">Proceder al pago</a>
      </div>
    </div>
    <br>

    <script type="text/javascript">
      function sendPayment() {
          $.ajax({
              type: 'POST',
              url: '../controllers/payment.php',
              data: {
                  'idProduct': idProduct,
                  'redirect': redirect,
              },
              dataType: 'json',
              success: function (data) {
                console.log('Data: ', data);
              }
          });
      };

      //Falto terminar la verificacion
      function payment() {
        let inputs = document.getElementsByTagName('input');
        if (document.getElementById('f-option4').checked) {
          for(let i = 0; i <= inputs.length; i++) {
            if (inputs[i].type && inputs[i].type === 'radio') {
              if (inputs[i].checked) {
                var methodPay = input.value;
              }
            }
          }
        } else {
          document.getElementById('error').innerHTML = "Debe aceptar los terminos y condiciones para continuar.";
        }
      }
    </script>
  </body>
</html>
