<?php
include('../controller/config.php');

if (isset($_POST['submit'])) { // verifique se o formulário foi submetido

  $id = $conexao->real_escape_string($_GET['id']); // Recupera o ID da URL
  $nome = $conexao->real_escape_string($_POST['nome']);
  $avaliacao = $conexao->real_escape_string($_POST['avaliacao']);
  $descricao = $conexao->real_escape_string($_POST['descricao']);
  $preco = $conexao->real_escape_string($_POST['preco']);
  $qtd = $conexao->real_escape_string($_POST['qtd']);

  $result = mysqli_query($conexao, "UPDATE produto SET nome='$nome', avaliacao='$avaliacao', descricao='$descricao', preco='$preco', qtd_estoque='$qtd' WHERE id_produto='$id'");

  header("Location: listarProdutos.php");
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
    <h1>Editar Produto</h1>
    <form id="formulario" action="" method="POST">
      <label for="nome">Nome da Obra:</label>
      <input type="text" id="nome" name="nome" required pattern="[A-Za-z\s]+" title="O campo Nome deve conter apenas letras e espaços. Este campo é obrigatório." />
      <label for="avaliacao">Avaliação da Obra:</label>
      <input type="text" id="avaliacao" placeholder="4.5" name="avaliacao" required title="Por favor, informe um numero de avaliação"/>
      <label for="descricao">Descrição:</label>
      <input type="text" name="descricao" id="descricao" maxlength="80" required title="Informe uma descrição nova do produto:"/>
      <label for="qtd">Quantidade em estoque:</label>
      <input type="text" name="qtd" id="qtd" placeholder="12" maxlength="15" required title="Informe a quantidade:"/>
      <label for="preco">Preço Unitário:</label>
      <input type="text" name="preco" id="preco" placeholder="3.325,00" maxlength="15" required title="Informe o preço do produto:"/>
      <br>
      <input type="submit" name="submit" value="Editar">
    </form>
  </div>
</body>

</html>