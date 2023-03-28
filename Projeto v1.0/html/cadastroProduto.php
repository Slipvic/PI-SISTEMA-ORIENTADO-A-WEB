<?php
// Conexão com o banco de dados
$conexao = new mysqli('localhost', 'root', '', 'artgallery');

// Verifica se a conexão foi bem sucedida
if ($conexao->connect_error) {
  die('Erro de conexão: ' . $conexao->connect_error);
}

// Recupera as imagens já cadastradas
$sql_imagens = "SELECT * FROM imagem";
$resultado_imagens = $conexao->query($sql_imagens);
$imagens = [];
if ($resultado_imagens->num_rows > 0) {
  while ($linha = $resultado_imagens->fetch_assoc()) {
    $imagens[] = $linha;
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome_produto = $_POST['nome_produto'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];
  $qtd_estoque = $_POST['qtd_estoque'];
  $imagens = $_FILES['imagens'];
  $imagem_principal = $_POST['imagem_principal'];

  // Insere os dados na tabela produto
  $sql_produto = "INSERT INTO produto (nome, descricao, preco, qtd_estoque) VALUES ('$nome_produto', '$descricao', '$preco', '$qtd_estoque')";
  $conexao->query($sql_produto);

  // Recupera o id do produto recém inserido
  $id_produto = $conexao->insert_id;

  // Insere as imagens na tabela imagem
  for ($i = 0; $i < count($imagens['name']); $i++) {
    $caminho_imagem = '../images/' . uniqid() . '-' . $imagens['name'][$i];
    move_uploaded_file($imagens['tmp_name'][$i], $caminho_imagem);
    $eh_padrao = ($imagem_principal == $i + 1) ? 1 : 0;
    $sql_imagem = "INSERT INTO imagem (id_produto, caminho, eh_padrao) VALUES ('$id_produto', '$caminho_imagem', '$eh_padrao')";
    $conexao->query($sql_imagem);
  }

  // Redireciona para a página de listagem de produtos
  header('Location: listaProdutos.php');
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Cadastro de Produto</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="cadastro">
    <h1>Cadastro de Produto</h1>
    <form id="formulario" action="" method="POST" enctype="multipart/form-data">
      
      <label for="nome_produto">Nome do Produto:</label>
  <input type="text" name="nome_produto" id="nome_produto" required>
  <label for="descricao">Descrição:</label>
  <textarea name="descricao" id="descricao" required></textarea>
  <label for="preco">Preço:</label>
  <input type="number" name="preco" id="preco" step="0.01" required>
  <label for="qtd_estoque">Quantidade em Estoque:</label>
  <input type="number" name="qtd_estoque" id="qtd_estoque" required>
  <label for="imagens">Imagens:</label>
  <input type="file" name="imagens[]" id="imagens" multiple required>
  <label for="imagem_principal">Imagem Principal:</label>
  <select name="imagem_principal" id="imagem_principal">
    <?php foreach ($imagens as $key => $imagem) { ?>
      <option value="<?php echo $key + 1; ?>"><?php echo $imagem['caminho']; ?></option>
    <?php } ?>
  </select>
  <button type="submit">Cadastrar Produto</button>
</form>
</div>
</body>
</html>
