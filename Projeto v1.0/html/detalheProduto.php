<?php
// Obtém o id do produto a ser exibido
$id_produto = $_GET['id_produto'];

// Conexão com o banco de dados
$conexao = new mysqli('localhost', 'root', '', 'artgallery');

// Verifica se a conexão foi bem sucedida
if ($conexao->connect_error) {
    die('Erro de conexão: ' . $conexao->connect_error);
}

// Recupera o produto pelo id
$sql_produto = "SELECT * FROM produto WHERE id_produto = $id_produto";
$resultado_produto = $conexao->query($sql_produto);

if ($resultado_produto->num_rows == 0) {
    die('Produto não encontrado');
}

$produto = $resultado_produto->fetch_assoc();

// Recupera as imagens do produto
$sql_imagens = "SELECT * FROM imagem WHERE id_produto = $id_produto";
$resultado_imagens = $conexao->query($sql_imagens);
$imagens = [];
if ($resultado_imagens->num_rows > 0) {
    while ($linha_imagem = $resultado_imagens->fetch_assoc()) {
        $imagens[] = $linha_imagem['caminho'];
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $produto['nome'] ?>
    </title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="detalhe-produto">
        <h1>
            <?php echo $produto['nome'] ?>
        </h1>
        <div class="imagens">
            <?php foreach ($imagens as $imagem): ?>
                <img src="<?php echo $imagem ?>" alt="Imagem do Produto">
            <?php endforeach ?>
        </div>
        <div class="descricao">
            <h2>Descrição</h2>
            <p>
                <?php echo $produto['descricao'] ?>
            </p>
        </div>
        <div class="descricao-detalhada">
            <h2>Descrição Detalhada</h2>
            <p>
                <?php echo $produto['descricao'] ?>
            </p>
        </div>
     
        <div class="preco">
            <h2>Preço</h2>
            <p>
                <?php echo number_format($produto['preco'], 2, ',', '.') ?>
            </p>
        </div>
        <div class="comprar">
            <button disabled>Comprar</button>
        </div>

    </div>
    <script src="js/carousel.js"></script>
</body>

</html>