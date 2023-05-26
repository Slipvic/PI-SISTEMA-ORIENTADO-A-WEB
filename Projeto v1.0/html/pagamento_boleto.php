<?php 
include('../controller/config.php');
  session_start();
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

  <div class="container">
  <h1 class="mt-4">Aguardando Pagamento</h1>
    <p>O seu pedido foi processado falta apenas uma etapa para que seu pedido seja processado.</p>
    <h4>Por favor, realize o pagamento do boleto (Compensação em até 3 dias úteis)</h4>
    <div class="card mt-4">
      <div class="card-body">
        <h5 class="card-title">Boleto para Pagamento</h5>
        <div class="row">
          <div class="col-md-6">
            <img src="../img/boleto.jpg" alt="Código de Barras" width="300">
          </div>
          <div class="col-md-6">
            <p><strong>Informações:</strong></p>
            <ul>
              <li><strong>Valor:</strong> R$ 149,00</li>
              <li><strong>Vencimento:</strong> 30/05/2023</li>
              <li><strong>Banco:</strong> Bradesco</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</body>
</html>