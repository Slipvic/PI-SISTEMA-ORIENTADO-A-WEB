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

        .center-div {
            text-align: left;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
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
        <div class="row">

            <!-- Painel de endereço -->
            <div class="col-md-6">
                <div class="card p-4">
                    <h4>Selecione o Endereço de Entrega</h4>
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
                </div>
            </div>
            <div class="center-div">
                <button class="btn btn-primary mt-4" id="payButton">Confirmar Pagamento e Endereço</button>
            </div>
        </div>
    </div>

    <!-- Modal para preencher informações do cartão de crédito -->
    <div class="modal fade" id="cartaoModal" tabindex="-1" role="dialog" aria-labelledby="cartaoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartaoModalLabel">Preencha as informações do cartão de crédito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cartaoForm" action="processar_pagamento.php" method="POST">
                        <div class="form-group">
                            <label for="nomeCartao">Nome no cartão</label>
                            <input type="text" class="form-control" id="nomeCartao" name="nomeCartao" required>
                        </div>
                        <div class="form-group">
                            <label for="numCartao">Número do cartão</label>
                            <input type="text" class="form-control" id="numCartao" name="numCartao" required>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="validade">Validade</label>
                                <input type="text" class="form-control" id="validade" name="validade" required>
                            </div>
                            <div class="col">
                                <label for="cvv">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" required>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="parcelas">Número de parcelas</label>
                            <select class="form-control" id="parcelas" name="parcelas">
                                <option value="1">À vista</option>
                                <option value="2">2 vezes</option>
                                <option value="3">3 vezes</option>
                                <option value="4">4 vezes</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Pagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Adiciona a classe "selected" ao clicar na opção de pagamento
            $('.payment-option').click(function() {
                $('.payment-option').removeClass('selected');
                $(this).addClass('selected');
            });

            // Abre o modal de preenchimento do cartão de crédito ao clicar no botão "Pagar"
            $('#payButton').click(function() {
                var selectedOption = $('.payment-option.selected').attr('id');

                switch (selectedOption) {
                    case 'option1':
                        $('#cartaoModal').modal('show');
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

            // Envia o formulário do cartão de crédito para processar o pagamento
            $('#cartaoForm').submit(function(event) {
                event.preventDefault(); // Impede o envio do formulário por padrão

                // Aqui você pode adicionar o código para processar o pagamento com as informações do cartão de crédito

                // Fecha o modal após o envio do formulário
                $('#cartaoModal').modal('hide');
                alert('Pagamento sendo processado. Aguarde..');

                // Redireciona para a página de pagamento com cartão de crédito
                window.location.href = 'pagamento_cartao.php';
            });
        });
    </script>


</body>

</html>