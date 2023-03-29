<?php
// Conexão com o banco de dados
$conexao = new mysqli('localhost', 'root', '', 'artgallery');

// Verifica se a conexão foi bem sucedida
if ($conexao->connect_error) {
  die('Erro de conexão: ' . $conexao->connect_error);
}

// Recupera os produtos já cadastrados
$sql_produtos = "SELECT * FROM produto";
$resultado_produtos = $conexao->query($sql_produtos);
$produtos = [];
if ($resultado_produtos->num_rows > 0) {
  while ($linha = $resultado_produtos->fetch_assoc()) {
    $id_produto = $linha['id_produto'];
    $sql_imagens = "SELECT * FROM imagem WHERE id_produto = $id_produto";
    $resultado_imagens = $conexao->query($sql_imagens);
    $imagens = [];
    if ($resultado_imagens->num_rows > 0) {
      while ($linha_imagem = $resultado_imagens->fetch_assoc()) {
        $imagens[] = $linha_imagem['caminho'];
      }
    }
    $linha['imagens'] = $imagens;
    $produtos[] = $linha;
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_produto = $_POST['id_produto'];

  // Deleta o produto e suas imagens
  $sql_imagens = "SELECT * FROM imagem WHERE id_produto = $id_produto";
  $resultado_imagens = $conexao->query($sql_imagens);
  if ($resultado_imagens->num_rows > 0) {
    while ($linha = $resultado_imagens->fetch_assoc()) {
      unlink($linha['caminho']);
    }
  }
  
  $sql_deletar_imagens = "DELETE FROM imagem WHERE id_produto = $id_produto";
  $conexao->query($sql_deletar_imagens);

  $sql_deletar_produto = "DELETE FROM produto WHERE id_produto = $id_produto";
 
  $conexao->query($sql_deletar_produto);

  // Redireciona para a página de listagem de produtos
  header('Location: listaProdutos.php');


  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Lista de Produtos</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="listagem">
    <h1>Lista de Produtos</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Preço</th>
          <th>Quantidade em Estoque</th>
          <th>Imagens</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($produtos as $produto) : ?>
          <tr>
            <td><?php echo $produto['id_produto'] ?></td>
            <td><?php echo $produto['nome'] ?></td>
            <td><?php echo $produto['descricao'] ?></td>
            <td><?php echo $produto['preco'] ?></td>
            <td><?php echo $produto['qtd_estoque'] ?></td>
            <td>
              <?php foreach ($produto['imagens'] as $imagem) : ?>
                <img src="<?php echo $imagem ?>" alt="Imagem do Produto">
              <?php endforeach ?>
            </td>
            <td>
              <form action="" method="POST">
                <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                <button type="submit">Deletar</button>
              </form>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</body>

</html>
