<?php
session_start();
include('../controller/config.php');
$id = $_SESSION['idusers'];

if (isset($_POST['submit'])) {
  $cep = $conexao->real_escape_string($_POST['cep']);
  $logradouro = $conexao->real_escape_string($_POST['logradouro']);
  $numero = $conexao->real_escape_string($_POST['numero']);
  $complemento = $conexao->real_escape_string($_POST['complemento']);
  $bairro = $conexao->real_escape_string($_POST['bairro']);
  $cidade = $conexao->real_escape_string($_POST['cidade']);
  $uf = $conexao->real_escape_string($_POST['uf']);
  $faturamento = $conexao->real_escape_string($_POST['faturamento']);
  $entrega = $conexao->real_escape_string($_POST['entrega']);

  $result = "INSERT INTO endereco (idusers, cep, logradouro, numero, complemento, bairro, cidade, uf, faturamento, entrega) 
  VALUES ('$id', '$cep','$logradouro','$numero', '$complemento', '$bairro', '$cidade', '$uf', '$faturamento', '$entrega')";
  if ($conexao->query($result) === TRUE) {
    header("Location: enderecoCliente.php");
    exit();
  } else {
    echo "Erro ao inserir os dados no banco de dados: ";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Cadastro de Endereço</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <label for="logradouro">Logradouro:</label>
        <input type="text" class="form-control" id="logradouro" name="logradouro" readonly>
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
        <input type="text" class="form-control" id="bairro" name="bairro" readonly>
      </div>

      <div class="form-group">
        <label for="cidade">Cidade:</label>
        <input type="text" class="form-control" id="cidade" name="cidade" readonly>
      </div>

      <div class="form-group">
        <label for="estado">Estado:</label>
        <input type="text" class="form-control" id="uf" name="uf" readonly>
      </div>

      <div class="form-group">
        <label for="faturamento">Faturamento:</label>
        <input type="text" class="form-control" id="faturamento" name="faturamento" required>
      </div>

      <div class="form-group">
        <label for="entrega">Entrega:</label>
        <input type="text" class="form-control" id="entrega" name="entrega" required>
      </div>

      <button type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#cep").blur(function() {
        var cep = $(this).val();
        if (cep.length === 9) {
          buscarCEP(cep);
        }
      });

      function buscarCEP(cep) {
        axios.get("https://viacep.com.br/ws/" + cep + "/json/")
          .then(function(response) {
            if (response.data.erro) {
              console.log("CEP não encontrado");
            } else {
              $("#logradouro").val(response.data.logradouro);
              $("#bairro").val(response.data.bairro);
              $("#cidade").val(response.data.localidade);
              $("#uf").val(response.data.uf);
            }
          })
          .catch(function(error) {
            console.log(error);
          });
      }

      $(document).ready(function() {
        $("#cep").blur(function() {
          var cep = $(this).val().replace("-", "");
          if (cep.length === 8) {
            buscarCEP(cep);
          }
        });
      });

    });
  </script>
</body>

</html>