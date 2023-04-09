<?php
include('protectAdmin.php');
include('../controller/config.php');

$id = $_GET['id'];
$status = $_GET['status'];


// Atualiza o status no banco de dados
$sql = "UPDATE produto SET ativo=$status WHERE id_produto=$id";
$result = $conexao->query($sql);

// Redireciona para a página de listagem de usuários
header('Location: listarProdutos.php');
$conexao->close();
?>
