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
    $id_produto = $linha['id'];
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
            <td><?php echo $produto['id'] ?></td>
            <td><?php echo $produto['nome'] ?></td>
            <td><?php echo $produto['descricao'] ?></td>
            <td><?php echo $produto['preco'] ?></td>
            <td><?php echo $produto['qtd_estoque'] ?></td>
            <td>
              <?php foreach ($produto['imagens'] as $imagem) : ?>
                <img src="<?php echo $imagem ?>" alt="Imagem do Produto">
              <?php endforeach ?>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</body>

</html>
