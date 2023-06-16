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
$sql = "SELECT id, logradouro, numero, uf FROM endereco WHERE idusers = $id";
$result = $conexao->query($sql);
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

        .navbar {
            background-color: #7c4dff;
            color: #fff;
            font-weight: bold;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .nav-link {
            color: #fff;
            font-size: 1.2rem;
            margin-right: 1rem;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="indexClientes.php">Ecommerce de Artes</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="carrinho.php">Carrinho</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo isset($_SESSION['idusers']) ? 'meusPedidos.php' : 'carrinho.php'; ?>">
                        <?php echo isset($_SESSION['idusers']) ? 'Meus Pedidos' : 'Meus Pedidos'; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="indexClientes.php">Quadros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo isset($_SESSION['idusers']) ? 'perfilCliente.php' : 'login-client.php'; ?>">
                        <?php echo isset($_SESSION['idusers']) ? 'Perfil' : 'Login'; ?>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card p-5">
            <h4 class="text-center">Resumo da Compra</h4>
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
            <p class="text-center">
                <?php
                // Exibe o total do carrinho
                echo "<h3>Valor total: R$ $total_carrinho</h3>";
                ?>
            </p>
            <div class="text-center mt-4">
                <a href="formaPagamentoEndereco.php" class="btn btn-primary">Selecionar Endereço e Pagamento</a>
            </div>
            <div class="text-center mt-4">
                <a href="carrinho.php" class="btn btn-primary">Modificar Pedido</a>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
