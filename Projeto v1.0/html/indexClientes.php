<?php
include('../controller/config.php');
// Iniciar a sessão
if (!isset($_SESSION)) {
  session_start();
}

// Executa a consulta SQL dos produtos
$sql = "SELECT p.id_produto, p.nome, p.avaliacao, p.preco, MAX(i.caminho) AS caminho
FROM produto p
LEFT JOIN imagem i ON p.id_produto = i.id_produto
WHERE i.eh_padrao = 0
GROUP BY p.id_produto";
$result = $conexao->query($sql);


?>
<!DOCTYPE html>
<html>

<head>
  <title>Ecommerce de Artes</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../styles/landingpage.css" />
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
          <a class="nav-link" href="carrinho.php">Carrinho</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Meus Pedidos</a>
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

  <!-- Carrossel -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="../img/arte.jpg" alt="Primeiro Slide" />
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://picsum.photos/id/238/1280/500" alt="Segundo Slide" />
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://picsum.photos/id/239/1280/500" alt="Terceiro Slide" />
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Próximo</span>
    </a>
  </div>

  <!-- Conteúdo principal -->
  <main class="container my-5">
    <h1 class="text-center mb-5">Bem-vindo à nossa loja de artes!</h1>

    <!-- Carrossel -->
    <div id="carouselExampleIndicators" class="carousel slide mb-5" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../img/arte.jpg" class="d-block w-100" alt="Arte 1" />
        </div>
        <div class="carousel-item">
          <img src="https://via.placeholder.com/1500x500" class="d-block w-100" alt="Arte 2" />
        </div>
        <div class="carousel-item">
          <img src="https://via.placeholder.com/1500x500" class="d-block w-100" alt="Arte 3" />
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
      </a>
    </div>

    <!-- Grid de produtos -->
    <div class="row">
      <?php while ($produto = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-3">
          <div class="card">
            <img class="card-img-top" src="<?php echo $produto['caminho'] ?>" alt="<?php echo $produto['nome'] ?>">
            <div class="card-body">
              <h5 class="card-title">
                <?php echo $produto['nome'] ?>
              </h5>
              <p class="card-text">Avaliação:
                <?php echo $produto['avaliacao'] ?>
              </p>
              <p class="card-text">Preço: R$
                <?php echo number_format($produto['preco'], 2, ',', '.') ?>
              </p>
              <a href="adicionar_carrinho.php?id_produto=<?php echo $produto['id_produto']; 
              ?>&nome=<?php echo $produto['nome']; ?>&preco=<?php echo $produto['preco']; 
              ?>" class="btn btn-primary">Comprar</a>

            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </main>
</body>


 <!-- <form method="POST" action="adicionar_carrinho.php">
  <input type="hidden" name="id_produto" value="1">
  <input type="hidden" name="nome" value="QUADRO AMELIE">
  <input type="hidden" name="preco" value="99.99">
  <input type="number" name="quantidade" value="1" min="1">
  <button type="submit">Adicionar ao carrinho</button>
</form>
<a href="adicionar_carrinho.php?id_produto=1&quantidade=1" class="btn btn-primary">Comprar</a> -->

</html>