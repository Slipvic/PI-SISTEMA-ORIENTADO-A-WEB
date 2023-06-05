<?php
session_start();
include('../controller/config.php');

// Executa a consulta SQL dos usuários
$id = $_SESSION['idusers'];
$sql = "SELECT id_pedido, nome_pedido, opcao_pagamento, total, estado FROM pedido WHERE idusers = $id";
$result = $conexao->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Meus Pedidos</title>
    <link rel="stylesheet" href="../styles/style-enderecoCliente.css" />
    <link rel="stylesheet" href="../styles/style-table.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
    <header>
        <h1>Meus Pedidos</h1>
        
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>C. Pedido</th>
                    <th>Nome do Pedido</th>
                    <th>Opção de Pagamento</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Itera sobre os resultados da consulta
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row["id_pedido"]; ?></td>
                            <td><?php echo $row["nome_pedido"]; ?></td>
                            <td><?php echo $row["opcao_pagamento"]; ?></td>
                            <td><?php echo $row["total"]; ?></td>
                            <td><?php echo $row["estado"]; ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "Não foram encontrados pedidos.";
                }
                ?>
            </tbody>

        </table>
    </main>
</body>

		</table>
		<!-- <nav>
            <ul>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                Outras páginas aqui
            </ul>
        </nav> -->
	</main>
</body>

</html>