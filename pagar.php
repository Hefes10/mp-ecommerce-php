
<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-3649015344178173-020421-ba67929b3b99b88dade5625f1b874d58-711079897');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Pantalon';
$item->quantity = 1;
$item->unit_price = 12;
$preference->items = array($item);
$preference->save();
?>


  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
  </head>
  <body>
      
<form action="insertarpago.php" method="post">
<script
  src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
  data-preference-id="<?php echo $preference->id; ?>">
</script>
</form>
  </body>
  </html>

  <!-- curl -X POST -H "Content-Type: application/json" -H 'Authorization: Bearer TEST-1371304897199119-020420-a6437db78b3173cdaa998f3e4de1d45b-187689351' "https://api.mercadopago.com/users/test_user" -d '{"site_id":"MLA"}' -->

  <!-- {
    "id":711079897,
    "nickname":"TETE84500",
    "password":"qatest6814",
    "site_status":"active",
    "email":"test_user_50359375@testuser.com"
    } 
    vendedor -->
  <!-- {
    "id":711081245,
    "nickname":"TESTNBLOYBJC",
    "password":"qatest8241",
    "site_status":"active",
    "email":"test_user_36869933@testuser.com"
    } 
    comprador -->