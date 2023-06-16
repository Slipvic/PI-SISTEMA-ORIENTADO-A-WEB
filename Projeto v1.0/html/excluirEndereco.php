<?php
session_start();
include('../controller/config.php');

// Verifica se o formulário de exclusão foi enviado
if(isset($_POST['excluir'])){
  $enderecoId = $_POST['endereco_id'];
  
  // Executa a consulta SQL para excluir o endereço
  $sqlExcluir = "DELETE FROM endereco WHERE id = $enderecoId";
  $conexao->query($sqlExcluir);
  
  // Redireciona de volta para a página de endereços
  header("Location: enderecoCliente.php");
  exit();
} else {
  // Caso o formulário não tenha sido enviado, redireciona de volta para a página de endereços
  header("Location: enderecoCliente.php");
  exit();
}
?>
