<?php
include('../controller/config.php');
session_start();

$detalhes_carrinho = $_SESSION['detalhes_carrinho'];
$total_carrinho = $detalhes_carrinho['total_carrinho'];
$nome_produto = $detalhes_carrinho['itens_carrinho'][0]['nome_produto'];
//$nome_produto = $itens_carrinho['nome_produto'];
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <title>Pagamento Realizado com Sucesso</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 20px;
    }

    css Copy code h1 {
      color: #00cc66;
    }

    p {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .logo {
      width: 150px;
      margin-bottom: 20px;
    }

    .success-message {
      color: #00cc66;
      font-weight: bold;
      margin-bottom: 30px;
    }

    .transaction-details {
      border: 1px solid #ccc;
      padding: 20px;
      text-align: left;
      margin: 0 auto;
      max-width: 500px;
    }
  </style>
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

  <h1>Pagamento Realizado com Sucesso</h1>
  <p class="success-message">O seu pagamento foi concluído com sucesso!</p>
  <div class="transaction-details">
    <p><strong>ID da Transação:</strong> 1234567890</p>
    <p><strong>Data:</strong> 05 de junho de 2023</p>
    <p><strong>Valor:</strong>
      <?php
      // Exibe o total do carrinho
      echo "R$ $total_carrinho";
      ?>
    </p>
   <?php echo "<p><strong>Descrição:</strong> $nome_produto</p>" ?>
    <p><strong>Forma de Pagamento:</strong> Cartão de Crédito</p>
  </div>
  <p>Obrigado por escolher os nossos serviços. Se você tiver alguma dúvida, entre em contato conosco.</p>
  <p>Atenciosamente,</p>
  <p>Art Gallery</p>
</body>

</html>