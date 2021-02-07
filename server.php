<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-3649015344178173-020421-ba67929b3b99b88dade5625f1b874d58-711079897');

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch ($path) {
    case '':
    case '/':
        require __DIR__ . '/index.php';
        break;
    case '/create_preference':
        //$json = file_get_contents("php://input");
        $data = json_decode($json);
        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->id = "1234";
        $item->title = $_POST['title'];
        $item->description = "Dispositivo móvil de Tienda e-commerce";
        $item->picture_url = $_POST['img'];
        $item->quantity = $_POST['unit'];
        $item->currency_id = "ARS";
        $item->unit_price = $_POST['price'];

        $preference->items = array($item);

        $preference->payment_methods = array(
            "excluded_payment_methods" => array(
              array("id" => "amex")
            ),
            "excluded_payment_types" => array(
              array("id" => "atm")
            ),
            "installments" => 6
          );

        $preference->back_urls = array(
            "success" => "https://hefes10-mp-commerce-php.herokuapp.com/feedback",
            "failure" => "https://hefes10-mp-commerce-php.herokuapp.com/feedback",
            "pending" => "https://hefes10-mp-commerce-php.herokuapp.com/feedback"
        );
        $preference->auto_return = "approved";

        $preference->save();

        $response = array(
            'id' => $preference->id,
        );
        echo json_encode($response);
        break;
    case '/feedback':
        $respuesta = array(
            'Payment' => $_GET['payment_id'],
            'Status' => $_GET['status'],
            'MerchantOrder' => $_GET['merchant_order_id']
        );
        echo json_encode($respuesta);
        break;
        //Server static resources
    default:
        $file = __DIR__ . '/../../client' . $path;
        $extension = end(explode('.', $path));
        $content = 'text/html';
        switch ($extension) {
            case 'js':
                $content = 'application/javascript';
                break;
            case 'css':
                $content = 'text/css';
                break;
            case 'png':
                $content = 'image/png';
                break;
        }
        header('Content-Type: ' . $content);
        readfile($file);
}
