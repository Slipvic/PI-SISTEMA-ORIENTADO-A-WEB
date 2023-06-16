<?php
include('protectAdmin.php');
include('../controller/config.php');

$id = $_GET['id'];
$status = $_GET['status'];


// Atualiza o status no banco de dados
$sql = "UPDATE funcionarios SET ativo=$status WHERE idfuncionarios=$id";
$result = $conexao->query($sql);

// Redireciona para a página de listagem de usuários
header('Location: listarUsuarios.php');
$conexao->close();
?>
