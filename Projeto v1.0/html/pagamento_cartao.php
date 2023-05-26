<?php 
include('../controller/config.php');
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pedido Realizado com Sucesso!</title>
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
          <a class="nav-link" href="indexCLientes.php">Quadros</a>
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
    <h4>Por favor, preencha os dados do seu cartão de crédito abaixo para finalizar a transação:</h4>
    <form class="mt-4">
      <div class="form-group">
        <label for="cardNumber">Número do Cartão de Crédito</label>
        <input type="text" class="form-control" id="cardNumber" placeholder="Insira o número do cartão">
      </div>
      <div class="form-group">
        <label for="expiryDate">Data de Validade</label>
        <input type="text" class="form-control" id="expiryDate" placeholder="MM/AA">
      </div>
      <div class="form-group">
        <label for="cvv">CVV</label>
        <input type="text" class="form-control" id="cvv" placeholder="Insira o código de segurança">
      </div>
      <button type="submit" class="btn btn-primary">Confirmar Pagamento</button>
    </form>
  </div>
</body>
</html>