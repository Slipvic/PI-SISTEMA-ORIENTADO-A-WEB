<?php
session_start();
include('../controller/config.php');
 $id = $_SESSION['idusers'];

if (isset($_POST['submit'])) { // verifique se o formulário foi submetido


  $cep = $conexao->real_escape_string($_POST['cep']);
  $numero = $conexao->real_escape_string($_POST['numero']);
  $complemento = $conexao->real_escape_string($_POST['complemento']);
  $bairro = $conexao->real_escape_string($_POST['bairro']);
  $cidade = $conexao->real_escape_string($_POST['cidade']);
  $uf = $conexao->real_escape_string($_POST['uf']);
  $faturamento = $conexao->real_escape_string($_POST['faturamento']);
  $entrega = $conexao->real_escape_string($_POST['entrega']);

  $result = "INSERT INTO endereco (idusers, logradouro, numero, complemento, bairro, cidade, uf, faturamento, entrega) 
  VALUES ('$id', '$cep', '$numero', '$complemento', '$bairro', '$cidade', '$uf', '$faturamento', '$entrega')";
  $conexao->query($result);

  header("Location: enderecoCliente.php");
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Cadastro de Endereço</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="..\js\script.js"></script>

  <style>
    label {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="mt-5">Cadastro de Endereço</h1>
    <form id="formulario" action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="cep">CEP:</label>
        <input type="text" class="form-control" id="cep" placeholder="12345-678" name="cep" maxlength="9" required>
      </div>

      <div class="form-group">
        <label for="numero">Número:</label>
        <input type="text" class="form-control" id="numero" name="numero" required>
      </div>

      <div class="form-group">
        <label for="complemento">Complemento:</label>
        <input type="text" class="form-control" id="complemento" name="complemento" required>
      </div>

      <div class="form-group">
        <label for="bairro">Bairro:</label>
        <input type="text" class="form-control" id="bairro" name="bairro" required>
      </div>

      <div class="form-group">
        <label for="cidade">Cidade:</label>
        <input type="text" class="form-control" id="cidade" name="cidade" required>
      </div>

      <div class="form-group">
        <label for="estado">Estado:</label>
        <input type="text" class="form-control" id="uf" name="uf" required>
      </div>

      <div class="form-group">
        <label for="faturamento">Faturamento:</label>
        <input type="text" class="form-control" id="faturamento" name="faturamento" required>
      </div>

      <div class="form-group">
        <label for="entrega">Entrega:</label>
        <input type="text" class="form-control" id="entrega" name="entrega" required>
      </div>

      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="meuScript.js"></script>
  <script>
    meuCadastroDeEndereco();
  </script>
</body>

</html>