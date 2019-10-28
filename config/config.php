<?php
//$baseName = $_SERVER['DOCUMENT_ROOT'];

require dirname(__DIR__) . '/vendor/autoload.php';

//Affichage des erreurs
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

use App\Cart\Cart;
use App\Products\Products;
use App\Users\Users;

// Transformation du get
$get = makeGet($_SERVER['REQUEST_URI']);

$products = new Products();
$cart = new Cart([
// Can add unlimited number of item to cart
    'cartMaxItem' => 0,

// Set maximum quantity allowed per item to 99
    'itemMaxQuantity' => 40,

// Do not use cookie, cart data will lost when browser is closed
    'useCookie' => true,
]);

$allProducts = $products->selectAll('*');
$allItems = $cart->getItems();

if (isset($_GET['page']) && $_GET['page'] == 'goodbye') {
    if (isset($_POST['_validForm'])) {
        $secret = '********';
        $response = $_POST['g-recaptcha-response'];

        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $response;
        $decode = json_decode(file_get_contents($api_url), true);

        if ($decode['success'] == true) {

            $users = new Users;

            $fileName = '';

            if (!empty($_FILES['userfile']['name'])) {

                $tmp = explode('.', $_FILES['userfile']['name']);
                $extension = end($tmp);

                $uploaddir = dirname(__DIR__, 2) . '/DATAFTP/';
                $uploadfile = $uploaddir . date('Y-m-d_His') . '-' . $tmp[0] . '.' . $extension;

                $fileName = date('Y-m-d_His') . '-' . $tmp[0] . '.' . $extension;
                move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            }

            $totalPrice = $products->sumAllPrices($allItems);

            // ajouter le student 1 return ID Student 1
            $insertFirstStudent = $users->insertFirstUser($_POST, $totalPrice, $fileName);

            // ajouter les autres students
            if ($_POST['_NumberOfSeat'] > 1) {
                for ($i = 2; $i <= $_POST['_NumberOfSeat']; $i++) {
                    $insertStudents = $users->insertUsers($i, $_POST, $insertFirstStudent);
                }
            }
            // ajouter les items du panier
            foreach ($allItems as $items) {
                foreach ($items as $item) {
                    $infosProduct = $products->selectOneById($item['id']);
                    $priceProduct = $products->calcPrice($item['quantity'], $infosProduct[$products->getGoodPrice($item)]);
                    $insertProduct = $users->insertProduct($item, $insertFirstStudent, $infosProduct, $_POST, $priceProduct);
                }
            }

            // envoyer le mail
            $users->sendMailStudent($insertFirstStudent, $allItems, $totalPrice, $_POST['_email1']);

            // vider le panier
            $cart->destroy();
        } else {
            echo 'Error Captcha ! Try again';
        }

    }
}
