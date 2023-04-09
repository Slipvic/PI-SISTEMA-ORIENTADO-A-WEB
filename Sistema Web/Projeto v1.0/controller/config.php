<?php


// Dados de conexão com o banco de dados
$host = "localhost"; // endereço do servidor MySQL
$user = "root"; // nome de usuário do MySQL
$password = ""; // senha do MySQL
$database = "artgallery"; // nome do banco de dados

// Conexão com o banco de dados
$conexao = new mysqli($host, $user, $password, $database);

// Verifica se ocorreu algum erro na conexão
//if ($conexao ->connect_errno) {
//   echo "Erro";
//}
//else {
//  echo "Conexão estabelecida.";
//}

?>