<?php
include('../controller/config.php');

// Recupera o ID da URL
$id = $conexao->real_escape_string($_GET['id']);

// Faz a consulta a tabela de produtos
$resultado = mysqli_query($conexao, "SELECT * FROM produto WHERE id_produto='$id'");
$produto = mysqli_fetch_assoc($resultado);

if (isset($_POST['submit'])) { // verifique se o formulário foi submetido

  $nome = $conexao->real_escape_string($_POST['nome']);
  $avaliacao = $conexao->real_escape_string($_POST['avaliacao']);
  $descricao = $conexao->real_escape_string($_POST['descricao']);
  $preco = $conexao->real_escape_string($_POST['preco']);
  $qtd = $conexao->real_escape_string($_POST['qtd']);
  $imagens = $_FILES['imagens'];
  $imagem_principal = $_FILES['imagemPrincipal'];

  // Altera as informações do produto
  $result = mysqli_query($conexao, "UPDATE produto SET nome='$nome', avaliacao='$avaliacao', descricao='$descricao', preco='$preco', qtd_estoque='$qtd' WHERE id_produto='$id'");

  // Cadastra a imagem padrão nova
  $caminho_imagem = '../img/' . uniqid() . '-' . $imagem_principal['name'];
  move_uploaded_file($imagem_principal['tmp_name'], $caminho_imagem);
  $sql_imagem = "UPDATE imagem SET caminho = '$caminho_imagem' WHERE id_produto = $id AND eh_padrao = '0'";
  $conexao->query($sql_imagem);


  //Cadastra as demais imagens
  for ($i = 0; $i < count($imagens['name']); $i++) {
    $caminho_imagem = '../img/' . uniqid() . '-' . $imagens['name'][$i];
    move_uploaded_file($imagens['tmp_name'][$i], $caminho_imagem);
    $sql_imagem = "UPDATE imagem SET caminho = '$caminho_imagem' WHERE id_produto = $id AND eh_padrao = '1'";
    $conexao->query($sql_imagem);
  }


  header("Location: listarProdutos.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Editar Produto</title>
  <link rel="stylesheet" href="../styles/style-alterarProdutos.css" />
  <script src="..\js\script.js"></script>
</head>

<body>
  <div class="cadastro">
    <h1>Editar Produto</h1>
    <form id="formulario" action="" method="POST" enctype="multipart/form-data">
      <label for="nome">Nome da Obra:</label>
      <input type="text" id="nome" name="nome"
        title="O campo Nome deve conter apenas letras e espaços. Este campo é obrigatório."
        value="<?php echo $produto['nome'] ?>" />
      <label for="avaliacao">Avaliação da Obra:</label>
      <input type="text" id="avaliacao" placeholder="4.5" name="avaliacao" required
        title="Por favor, informe um numero de avaliação" value="<?php echo $produto['avaliacao'] ?>" />
      <label for="descricao">Descrição:</label>
      <input type="text" name="descricao" id="descricao" maxlength="10000" required
        title="Informe uma descrição nova do produto:" value="<?php echo $produto['descricao'] ?>" />
      <label for="qtd">Quantidade em estoque:</label>
      <input type="text" name="qtd" id="qtd" placeholder="12" maxlength="15" required title="Informe a quantidade:"
        value="<?php echo $produto['qtd_estoque'] ?>" />
      <label for="preco">Preço Unitário:</label>
      <input type="text" name="preco" id="preco" placeholder="3.325,00" maxlength="15" required
        title="Informe o preço do produto:" value="<?php echo $produto['preco'] ?>" />

      <!-- campo de upload de imagens -->
      <label for="imagens" class="form-label">Imagem Principal:</label>
      <input type="file" class="form-control" name="imagemPrincipal" id="imagens" multiple required>

      <label for="imagens" class="form-label">Outras Imagens:</label>
      <input type="file" class="form-control" name="imagens[]" id="imagens" multiple required>

      <button type="submit" name="submit"> Editar</button>
    </form>
  </div>
</body>

</html>