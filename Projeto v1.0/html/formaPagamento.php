<?php
include('../controller/config.php');
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['idusers'])) {
    // Redireciona o usuário para a página de login ou exibe uma mensagem de erro
    // Aqui você pode adicionar o código apropriado para a sua aplicação
    exit('Usuário não está logado. Redirecionando para a página de login...');
}

// Executa a consulta SQL dos usuários
$id = $_SESSION['idusers'];
$sql = "SELECT logradouro, numero, uf FROM endereco WHERE idusers = $id";
$result = $conexao->query($sql);
$row = $result->fetch_assoc(); // obtém a primeira linha do resultado da consulta

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pagamento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .payment-option {
            cursor: pointer;
        }

        .selected {
            border: 2px solid blue;
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card p-4">
                    <h4>Endereços de Entrega</h4>
                    <hr>
                    <?php
                    // Verifica se a consulta SQL retornou algum resultado
                    if ($result->num_rows > 0) {
                        // Exibe os endereços do usuário
                        while ($row = $result->fetch_assoc()) {
                            $logradouro = $row['logradouro'];
                            $numero = $row['numero'];
                            $uf = $row['uf'];

                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="radio" name="endereco" id="endereco' . $numero . '">';
                            echo '<label class="form-check-label" for="endereco' . $numero . '">';
                            echo $logradouro . ', ' . $numero . ' - ' . $uf;
                            echo '</label>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4">
                    <h4>Opções de Pagamento</h4>
                    <hr>
                    <div class="payment-option" id="option1">
                        <h5>Cartão de Crédito</h5>
                        <p>Informe os detalhes do cartão de crédito.</p>
                    </div>
                    <div class="payment-option mt-3" id="option2">
                        <h5>Boleto Bancário</h5>
                        <p>Selecione essa opção para gerar um boleto bancário.</p>
                    </div>
                    <div class="payment-option mt-3" id="option3">
                        <h5>Pix</h5>
                        <p>Realize um pix através do nosso QR Code e efetue o pagamento em instantes.</p>
                    </div>
                    <button class="btn btn-primary mt-4" id="payButton">Pagar</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-5">
                    <h4>Resumo da Compra</h4>
                    <hr>
                    <p>Produtos:</p>
                    <ul>
                        <?php
                        // Verifica se os detalhes do carrinho estão armazenados na sessão
                        if (isset($_SESSION['detalhes_carrinho'])) {
                            $detalhes_carrinho = $_SESSION['detalhes_carrinho'];

                            // Acessa os dados gerais do carrinho
                            $total_carrinho = $detalhes_carrinho['total_carrinho'];
                            $itens_carrinho = $detalhes_carrinho['itens_carrinho'];

                            // Exibe os detalhes de cada item do carrinho
                            foreach ($itens_carrinho as $item) {
                                $nome_produto = $item['nome_produto'];
                                $valor_sem_frete = $item['valor_sem_frete'];
                                $frete = $item['frete'];
                                $quantidade = $item['quantidade'];

                                echo "<p>Nome do quadro: $nome_produto</p>";
                                echo "<p>Valor unitário: R$ $valor_sem_frete</p>";
                                echo "<p>Frete: $frete</p>";
                                echo "<p>Quantidade: $quantidade</p>"; // Exibe a quantidade selecionada do item
                                echo "<hr>"; // Adicione uma linha para separar cada item do carrinho
                            }
                        }
                        ?>
                    </ul>
                    <p>
                        <?php
                        // Exibe o total do carrinho
                        echo "<h3>Valor total: R$ $total_carrinho</h3>";
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.payment-option').click(function () {
                $('.payment-option').removeClass('selected');
                $(this).addClass('selected');
            });

            $('#payButton').click(function () {
                var selectedOption = $('.payment-option.selected').attr('id');
                // Faça algo com a opção selecionada, como enviar para o servidor PHP para processar o pagamento
                console.log('Opção selecionada: ' + selectedOption);

                // Redireciona para a página correspondente à opção selecionada
                switch (selectedOption) {
                    case 'option1':
                        window.location.href = 'pagamento_cartao.php';
                        break;
                    case 'option2':
                        window.location.href = 'pagamento_boleto.php';
                        break;
                    case 'option3':
                        window.location.href = 'pagamento_pix.php';
                        break;
                    default:
                        break;
                }
            });
        });
    </script>
</body>

</html>
