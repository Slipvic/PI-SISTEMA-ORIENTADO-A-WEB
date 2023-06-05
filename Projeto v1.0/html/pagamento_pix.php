<?php
include('../controller/config.php');
session_start();

$detalhes_carrinho = $_SESSION['detalhes_carrinho'];
$total_carrinho = $detalhes_carrinho['total_carrinho'];

?>

<!DOCTYPE html>
<html>
<head>
  <title>Pagamento Pendente</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
          <a class="nav-link" href="meusPedidos.php">Meus Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="indexClientes.php">Quadros</a>
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

  <div class="container">
  <h1 class="mt-4">Aguardando Pagamento</h1>
    <p>O seu pedido foi processado falta apenas uma etapa para que seu pedido seja processado.</p>
    <h4>Escaneie o QR Code abaixo, o pagamento é feito em instantes</h4>
    <div class="card mt-4">
      <div class="card-body">
        <h5 class="card-title">QR Code PIX</h5>
        <div class="row">
          <div class="col-md-6">
            <img src="../img/QRCode.png" alt="Código de Barras" width="300">
          </div>
          <div class="col-md-6">
            <p><strong>Informações:</strong></p>
            <ul>
            <li><strong>Valor:
                  <?php
                  // Exibe o total do carrinho
                  echo "R$ $total_carrinho";
                  ?>
              </li>
              <li><strong>Vencimento:</strong> 07/05/2023</li>
              <li><strong>Banco:</strong> Bradesco</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="text-right">
  <a class="btn btn-primary mt-4" href="meusPedidos.php">Meus Pedidos</a>
</div>
  </div>


</body>
</html>