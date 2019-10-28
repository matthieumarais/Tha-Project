<?php

//Affichage des erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../functions/functions.php';
include_once '../config/config.php';

/* use App\FicheProduit\FicheProduit; */

// Add item
if (isset($_POST['event']) && $_POST['event'] === 'add') {

    if ($cart->isItemExists($_POST['id_product'], [
        'color' => $_POST['color_product'],
        'size' => $_POST['size_product'],
    ])) {

        $cart->update($_POST['id_product'], $_POST['qty_product'], [
            'color' => $_POST['color_product'],
            'size' => $_POST['size_product'],
        ]);
    } else {
        $cart->add($_POST['id_product'], $_POST['qty_product'], [
            'color' => $_POST['color_product'],
            'size' => $_POST['size_product'],
        ]);

    }

}

// Add seat
if (isset($_POST['event']) && $_POST['event'] === 'addSeat') {

    if ($cart->isItemExists($_POST['id_product'])) {

        $cart->update($_POST['id_product'], $_POST['qty_product']);

    } else {

        $cart->add($_POST['id_product'], $_POST['qty_product']);
    }

}

if (isset($_POST['event']) && $_POST['event'] === 'del') {

    // Del item
    $cart->remove($_POST['id_del'], [
        'color' => $_POST['color_del'],
        'size' => $_POST['size_del'],
    ]);
}

if (isset($_POST['event']) && $_POST['event'] === 'delSeatOnLoad') {

    // Del item
    if ($cart->isItemExists($_POST['id_del_seat'])) {
        $cart->remove($_POST['id_del_seat']);
        echo 'true';
    } else {
        echo 'false';
    }

}

// Clear Cart
if (isset($_POST['event']) && $_POST['event'] === 'clear') {
    $cart->clear();
}
