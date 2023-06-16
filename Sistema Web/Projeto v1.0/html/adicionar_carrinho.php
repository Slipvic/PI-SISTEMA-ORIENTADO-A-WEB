<?php
session_start();
$id_produto = $_GET['id_produto'];
$nome = $_GET['nome'];
$preco = $_GET['preco'];
$quantidade = 1;

/* $id_produto = $_POST['id_produto'];
$quantidade = $_POST['quantidade'];
$nome = $_POST['nome'];
$preco = $_POST['preco']; */

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

if (isset($_SESSION['carrinho'][$id_produto]) && is_array($_SESSION['carrinho'][$id_produto])) {
    $_SESSION['carrinho'][$id_produto]['quantidade'] += $quantidade;
} else {
    $_SESSION['carrinho'][$id_produto] = array(
        'quantidade' => $quantidade,
        'nome' => $nome,
        'preco' => $preco
    );
}

header('Location: carrinho.php');
exit;
?>