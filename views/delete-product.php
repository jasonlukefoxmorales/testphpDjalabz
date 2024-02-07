<?php
session_start();
// Page tunnel qui nous permet de supprimer un produit 

// On récupère dans l'URL l'id du produit à supprimer du panier 
// Puis on le retire de nos variables de Session avec unset 

if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];

    unset($_SESSION['user']['cart'][$product_id]);
    header('Location: cart.view.php');
    // var_dump($_SESSION);
}

?>