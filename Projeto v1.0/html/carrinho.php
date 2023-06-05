<?php 
include('../controller/config.php');
  session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Carrinho</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="indexClientes.php">Ecommerce de Artes</a>

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
        <a class="nav-link"
            href="<?php echo isset($_SESSION['idusers']) ? 'meusPedidos.php' : 'carrinho.php'; ?>">
            <?php echo isset($_SESSION['idusers']) ? 'Meus Pedidos' : 'Meus Pedidos'; ?>
        </a>
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

  <div class="container mt-5">
    <h1>Carrinho</h1>

    <!-- Formulário para digitar o CEP -->
    <form method="get" action="">
      <div class="form-group">
        <label for="cep">CEP:</label>
        <input type="text" class="form-control" id="cep" name="cep" placeholder="Digite o CEP" required>
      </div>
      <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <?php
  

    // Função para obter as informações do CEP usando uma API
    function obterInformacoesCEP($cep)
    {
      // URL da API para consulta de CEP (exemplo usando a API ViaCEP)
      $url = "https://viacep.com.br/ws/{$cep}/json/";

      // Faz a requisição à API
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      curl_close($ch);

      // Decodifica a resposta JSON
      $data = json_decode($response, true);

      // Retorna as informações do CEP
      return $data;
    }

    // Verifica se o CEP foi enviado
    if (isset($_GET['cep'])) {
      $cep = $_GET['cep'];

      // Remove caracteres não numéricos do CEP
      $cep = preg_replace("/[^0-9]/", "", $cep);

      // Verifica se o CEP tem 8 dígitos
      if (strlen($cep) === 8) {
        // Obtém as informações do CEP
        $endereco = obterInformacoesCEP($cep);

        // Verifica se as informações foram obtidas com sucesso
        if (isset($endereco['logradouro'])) {
          $_SESSION['endereco'] = $endereco; // Salva as informações do endereço na sessão
        } else {
          echo "<p>CEP não encontrado.</p>";
        }
      } else {
        echo "<p>CEP inválido.</p>";
      }
    }
    // Verifica se as informações do endereço estão armazenadas na sessão
    if (isset($_SESSION['endereco'])) {
      $endereco = $_SESSION['endereco'];
      echo "<p>Endereço de entrega: " . $endereco['logradouro'] . "</p>";

      // Exibe os botões de frete
      echo '<h3>Opções de Frete:</h3>';
      echo '<form method="post">';
      echo '<button type="submit" name="frete1" value="frete1" class="btn btn-primary mr-2">DHL</button>';
      echo '<button type="submit" name="frete2" value="frete2" class="btn btn-primary mr-2">JadLog</button>';
      echo '<button type="submit" name="frete3" value="frete3" class="btn btn-primary">Loggi</button>';
      echo '</form>';
    }
    // Verifica se o carrinho está vazio
    if (empty($_SESSION['carrinho'])) {
      echo "<p>O carrinho está vazio.</p>";
    } else {
      $total_carrinho = 0;
      // Itera sobre os produtos no carrinho
      foreach ($_SESSION['carrinho'] as $id_produto => $produto) {
        // Calcula o total do item
        $total_item = $produto['preco'] * $produto['quantidade'];
        $total_carrinho += $total_item;

        // Exibe as informações do produto e o total do item
        echo "<p>" . $produto['nome'] . " - R$ " . $produto['preco'] . " - Quantidade: " . $produto['quantidade'] . " - Total: R$ " . $total_item . "</p>";

        // Adiciona botões para diminuir e aumentar a quantidade e remover o produto do carrinho
        echo '<form method="post">';
        echo '<input type="hidden" name="id_produto" value="' . $id_produto . '">';
        echo '<button type="submit" name="diminuir_quantidade" class="btn btn-primary mr-2">-</button>';
        echo '<button type="submit" name="aumentar_quantidade" class="btn btn-primary mr-2">+</button>';
        echo '<button type="submit" name="remover_produto" class="btn btn-danger">Remover</button>';
        echo '</form>';

        // Adiciona um separador
        echo "<hr>";
      }

      // Exibe o total do carrinho
      echo "<h3>Total do carrinho: R$ " . $total_carrinho . "</h3>";
    }
    ?>

    <p><a href="indexClientes.php">Voltar para a página inicial</a></p>

    <?php
    // Verifica se foi clicado o botão para diminuir a quantidade de um produto
    if (isset($_POST['diminuir_quantidade'])) {
      $id_produto = $_POST['id_produto'];

      // Diminui a quantidade do produto no carrinho em 1
      $_SESSION['carrinho'][$id_produto]['quantidade']--;

      // Remove o produto do carrinho se a quantidade ficar menor ou igual a 0
      if ($_SESSION['carrinho'][$id_produto]['quantidade'] <= 0) {
        unset($_SESSION['carrinho'][$id_produto]);
      }

      // Redireciona para a página do carrinho
      header('Location: carrinho.php');
      exit;
    }

    // Verifica se foi clicado o botão para aumentar a quantidade de um produto
    if (isset($_POST['aumentar_quantidade'])) {
      $id_produto = $_POST['id_produto'];

      // Aumenta a quantidade do produto no carrinho em 1
      $_SESSION['carrinho'][$id_produto]['quantidade']++;
      // Redireciona para a página do carrinho
      header('Location: carrinho.php');
      exit;
    }

    // Verifica se foi clicado o botão para remover um produto do carrinho
    if (isset($_POST['remover_produto'])) {
      $id_produto = $_POST['id_produto'];

      // Remove o produto do carrinho
      unset($_SESSION['carrinho'][$id_produto]);

      // Redireciona para a página do carrinho
      header('Location: carrinho.php');
      exit;
    }
  // Verifica se foi selecionado o frete
  if (isset($_POST['frete1'])) {
    $frete = "DHL";
    $valor_frete = 10;
  } elseif (isset($_POST['frete2'])) {
    $frete = "JadLog";
    $valor_frete = 20;
  } elseif (isset($_POST['frete3'])) {
    $frete = "Loggi";
    $valor_frete = 30;
  } else {
    $frete = "Nenhum frete selecionado";
    $valor_frete = 0;
  }

  // Calcula o total do carrinho com o valor do frete
  $total_carrinho += $valor_frete;

  echo "<p>Opção de frete selecionada: $frete</p>";
  echo "<h3>Total do carrinho (com frete): R$ $total_carrinho</h3>";

  // Cria um array para armazenar os detalhes de cada item do carrinho
  $detalhes_carrinho = array();

  // Itera sobre os produtos no carrinho
  foreach ($_SESSION['carrinho'] as $id_produto => $produto) {
  // Adiciona os detalhes de cada item ao array $detalhes_carrinho
  $detalhes_item = array(
    'nome_produto' => $produto['nome'],
    'valor_sem_frete' => $produto['preco'],
    'frete' => $frete,
    'quantidade' => $produto['quantidade'] // Adiciona a quantidade selecionada do item
  );
  $detalhes_carrinho[] = $detalhes_item;
  }

// Adiciona o array $detalhes_carrinho à sessão
$_SESSION['detalhes_carrinho'] = array(
  'total_carrinho' => $total_carrinho,
  'itens_carrinho' => $detalhes_carrinho
);


?>
      <button class="btn btn-primary mr-2"
      onclick="location.href='<?php echo isset($_SESSION['idusers']) ? 'formaPagamento.php' : 'login-client.php'; ?>'">
      <?php echo isset($_SESSION['idusers']) ? 'Finalizar Compra' : 'Login'; ?>
    </button>
  </div>
</body>

</html>