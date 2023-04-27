<?php
include('../controller/config.php');

// Verifica se a conexão foi bem sucedida
if ($conexao->connect_errno) {
  die('Erro de conexão: ' . $conexao->connect_errno);
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
    $caminho_imagem = '../img/' . uniqid() . '-' . $imagens['name'][$i];
    move_uploaded_file($imagens['tmp_name'][$i], $caminho_imagem);
    $eh_padrao = ($imagem_principal == $i + 1) ? 1 : 0;
    $sql_imagem = "INSERT INTO imagem (id_produto, caminho, eh_padrao) VALUES ('$id_produto', '$caminho_imagem', '$eh_padrao')";
    $conexao->query($sql_imagem);
  }

  // Redireciona para a página de listagem de produtos
  header('Location: listarProdutos.php');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Produto</title>
  <!-- Inclui o arquivo CSS do Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Cadastro de Produto</h1>
    <form id="formulario" action="" method="POST" enctype="multipart/form-data">
      
      <div class="mb-3">
        <label for="nome_produto" class="form-label">Nome do Produto:</label>
        <input type="text" class="form-control" name="nome_produto" id="nome_produto" required>
      </div>
      
      <div class="mb-3">
        <label for="descricao" class="form-label">Descrição:</label>
        <textarea class="form-control" name="descricao" id="descricao" required></textarea>
      </div>
      
      <div class="mb-3">
        <label for="preco" class="form-label">Preço:</label>
        <input type="number" class="form-control" name="preco" id="preco" step="0.01" required>
      </div>
      
      <div class="mb-3">
        <label for="qtd_estoque" class="form-label">Quantidade em Estoque:</label>
        <input type="number" class="form-control" name="qtd_estoque" id="qtd_estoque" required>
      </div>
      
      <div class="mb-3">
        <label for="imagens" class="form-label">Imagens:</label>
        <input type="file" class="form-control" name="imagens[]" id="imagens" multiple required>
      </div>
      
      <div class="mb-3">
        <label for="imagem_principal" class="form-label">Imagem Principal:</label>
        <select class="form-select" name="imagem_principal" id="imagem_principal">
          <?php foreach ($imagens as $key => $imagem) { ?>
            <option value="<?php echo $key + 1; ?>"><?php echo $imagem['caminho']; ?></option>
          <?php } ?>
        </select>
      </div>
      
      <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
      
    </form>
  </div>
  
  <!-- Inclui o arquivo JavaScript do Bootstrap (opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
