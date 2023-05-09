<!DOCTYPE html>
<html>

<head>
  <title>Carrinho</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <h1>Carrinho</h1>

    <?php
    session_start();

    // Verifica se o carrinho está vazio
    if(empty($_SESSION['carrinho'])) {
      echo "<p>O carrinho está vazio.</p>";
    } else {
      $total_carrinho = 0;
      // Itera sobre os produtos no carrinho
      foreach($_SESSION['carrinho'] as $id_produto => $produto) {
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
    if(isset($_POST['diminuir_quantidade'])) {
      $id_produto = $_POST['id_produto'];

      // Diminui a quantidade do produto no carrinho em 1
      $_SESSION['carrinho'][$id_produto]['quantidade']--;

      // Remove o produto do carrinho se a quantidade ficar menor ou igual a 0
      if($_SESSION['carrinho'][$id_produto]['quantidade'] <= 0) {
        unset($_SESSION['carrinho'][$id_produto]);
      }

      // Redireciona para a página do carrinho
      header('Location: carrinho.php');
      exit;
    }

    // Verifica se foi clicado o botão para aumentar a quantidade de um produto
    if(isset($_POST['aumentar_quantidade'])) {
      $id_produto = $_POST['id_produto'];

      // Aumenta a quantidade do produto no carrinho em 1
$_SESSION['carrinho'][$id_produto]['quantidade']++;

// Redireciona para a página do carrinho
header('Location: carrinho.php');
exit;
}

// Verifica se foi clicado o botão para remover um produto do carrinho
if(isset($_POST['remover_produto'])) {
$id_produto = $_POST['id_produto'];

// Remove o produto do carrinho
unset($_SESSION['carrinho'][$id_produto]);

// Redireciona para a página do carrinho
header('Location: carrinho.php');
exit;
}

// Calcula o total de cada item e o total do carrinho
$total_carrinho = 0;



?>

</div>
</body>
</html>
