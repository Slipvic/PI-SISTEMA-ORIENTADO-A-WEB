<?php
include('../controller/config.php');
// Iniciar a sessão caso ainda esteja offline
if (!isset($_SESSION)) {
  session_start();
}

$id_produto = $_GET['id_produto'];
// Executa a consulta SQL dos produtos
$sql = "SELECT p.nome, p.avaliacao, p.descricao, p.preco, i.caminho, i.eh_padrao FROM produto p 
        INNER JOIN imagem i ON p.id_produto = i.id_produto WHERE p.id_produto = $id_produto";
$resultado = mysqli_query($conexao, $sql);
$produto = mysqli_fetch_assoc($resultado);

// Executa a consulta SQL das imagens do produto
$sql_imagens = "SELECT caminho, eh_padrao FROM imagem WHERE id_produto = $id_produto";
$resultado_imagens = mysqli_query($conexao, $sql_imagens);
$imagens = mysqli_fetch_all($resultado_imagens, MYSQLI_ASSOC);
?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Ecommerce de Artes</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../styles/style-detalhesProduto.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Ecommerce de Artes</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Meus Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="carrinho.php">Carrinho</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Quadros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"
              href="<?php echo isset($_SESSION['idusers']) ? 'perfilCliente.php' : 'login-client.php'; ?>">
              <?php echo isset($_SESSION['idusers']) ? 'Perfil' : 'Login'; ?>
            </a>
          </li>

        </ul>
      </div>
    </nav>

    <!-- Conteúdo principal -->
    <main class="container my-5">
      <h1 class="text-center mb-5">Detalhes do Produto</h1>

      <!-- Grid de produtos -->
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <h5 class="card-title">
              <?php echo $produto['nome']; ?>
            </h5>
            <?php foreach ($imagens as $imagem) {
              if ($imagem['eh_padrao'] == 0) { ?>
                <div class="col-md-20 mb-20">
                  <div class="card h-100">
                    <img src="<?php echo $imagem['caminho']; ?>" class="card-img-top" alt="Imagem do Produto">
                  </div>
                </div>
              <?php }
            } ?>
            <p class="float-left">Avaliação:
              <?php echo $produto['avaliacao']; ?>
            </p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <br>
          <p>
            <?php echo $produto['descricao']; ?>
          </p>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card-body float-right">
            <br>
            <p class="card-text">Preço: R$
              <?php echo number_format($produto['preco'], 2, ',', '.') ?>
            </p>
            <a href="carrinho.php" class="btn btn-primary btn-comprar" data-id="<?php echo $id_produto; ?>">Comprar</a>
            <br>
          </div>
        </div>
      </div>

      <!-- Grade de imagens -->
      <div class="row mt-5">
        <?php foreach ($imagens as $imagem) {
          if ($imagem['eh_padrao'] == 1) { ?>
            <div class="col-md-3 mb-4">
              <div class="card">
                <img src="<?php echo $imagem['caminho']; ?>" class="card-img-top" alt="Imagem do Produto">
              </div>
            </div>
          <?php }
        } ?>
      </div>
    </main>
    <script>
  const btnComprar = document.querySelector('.btn-comprar');
  btnComprar.addEventListener('click', function(e) {
    e.preventDefault();
    const idProduto = this.dataset.id;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'adicionarAoCarrinho.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      // Exibir uma mensagem para o cliente que o produto foi adicionado ao carrinho
      alert('O produto foi adicionado ao carrinho!');
    }
    xhr.send('id_produto=' + idProduto);
  });
</script>

  </body>

  </html>