<?php
include('../controller/config.php');

if (isset($_POST['submit'])) { // verifique se o formulário foi submetido

  $id = $conexao->real_escape_string($_GET['id']); // Recupera o ID da URL
  $nome = $conexao->real_escape_string($_POST['nome']);
  $email = $conexao->real_escape_string($_POST['email']);
  $CPF = $conexao->real_escape_string($_POST['CPF']);
  $grupo = $conexao->real_escape_string($_POST['grupo']);

  $result = mysqli_query($conexao, "UPDATE funcionarios SET nome='$nome', email='$email', cpf='$CPF', grupo='$grupo' WHERE idfuncionarios='$id'");

  header("Location: listarUsuarios.php");
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Editar Cadastro</title>
  <link rel="stylesheet" href="../styles/style-cadastro.css" />
  <script src="..\js\script.js"></script>
</head>

<body>
  <div class="cadastro">
    <h1>Editar Cadastro</h1>
    <form id="formulario" action="" method="POST">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required pattern="[A-Za-z\s]+" title="O campo Nome deve conter apenas letras e espaços. Este campo é obrigatório." />
      <label for="email">E-mail:</label>
      <input type="email" id="email" name="email" required title="Por favor, insira um endereço de e-mail válido." />
      <label for="CPF">CPF:</label>
      <input type="text" name="CPF" id="CPF" placeholder="123.456.789-00" maxlength="14" required title="Digite um CPF válido no formato xxx.xxx.xxx-xx" />
      <select id="grupo" name="grupo">
        <option value="Admin">Administrador</option>
        <option value="Estoq">Estoquista</option>
      </select>
      <br>
      <input type="submit" name="submit" value="Editar">
    </form>
  </div>
</body>

</html>