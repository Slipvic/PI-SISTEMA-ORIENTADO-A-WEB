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
          <a class="nav-link" href="#">Baixe o App</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Quadros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Login</a>
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
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="../img/amelie.jpg" class="card-img-top" alt="Arte 4" />
          <div class="card-body">
            <h5 class="card-title">QUADRO AMELIE</h5>
            <p class="card-text">R$ 99,99</p>
            <a href="#" class="btn btn-primary">Comprar</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="../img/monalisa.jpg" class="card-img-top" alt="Arte 5" />
          <div class="card-body">
            <h5 class="card-title">QUADRO MONALISA</h5>
            <p class="card-text">R$ 129,99</p>
            <a href="#" class="btn btn-primary">Comprar</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="../img/vermelho.jpg" class="card-img-top" alt="Arte 6" />
          <div class="card-body">
            <h5 class="card-title">QUADRO THE HANDMAIDS</h5>
            <p class="card-text">R$ 129,99</p>
            <a href="#" class="btn btn-primary">Comprar</a>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>