<?php
session_start();
include('../controller/config.php');

// Executa a consulta SQL dos usuários
$id = $_SESSION['idusers'];
$sql = "SELECT id, logradouro, numero, bairro, uf FROM endereco WHERE idusers = $id";
$result = $conexao->query($sql);

// Verifica se o formulário de exclusão foi enviado
if(isset($_POST['excluir'])){
  $enderecoId = $_POST['endereco_id'];
  // Executa a consulta SQL para excluir o endereço
  $sqlExcluir = "DELETE FROM endereco WHERE id = $enderecoId";
  $conexao->query($sqlExcluir);
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Endereços</title>
  <link rel="stylesheet" href="../styles/style-enderecoCliente.css" />
  <link rel="stylesheet" href="../styles/style-table.css" />
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    .excluir-cell {
      text-align: center;
      padding-left: 10px; 
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

  <header>
    <h1>Endereços</h1>
    <div class="actions">
      <button class="add-user" style="background-color: #1E90FF; color: white;">
        <a href="cadastroEndereco.php" style="text-decoration: none; color: inherit;">Novo Endereço</a>
      </button>
      <div class="search">
        <input type="text" placeholder="Endereços Cadastrados">
        <button class="search-button">Buscar</button>
      </div>
    </div>
  </header>
  <main>
    <table>
      <thead>
        <tr>
          <th>Logradouro</th>
          <th>Numero</th>
          <th>Bairro</th>
          <th>UF</th>
          <th></th>
          <th class="excluir-cell">Excluir</th> <!-- Nova coluna com classe CSS -->
        </tr>
        </tr>
      </thead>
      <tbody>
        <?php
        // Itera sobre os resultados da consulta
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
              <td><?php echo $row["logradouro"]; ?></td>
              <td><?php echo $row["numero"]; ?></td>
              <td><?php echo $row["bairro"]; ?></td>
              <td><?php echo $row["uf"]; ?></td>
              <td>
                <!-- Código das ações existentes -->
              </td>
              <td>
                <form method="POST" action="excluirEndereco.php">
                  <input type="hidden" name="endereco_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
                </form>
              </td>
            </tr>
        <?php
          }
        } else {
          echo "Não foram encontrados endereços.";
        }
        ?>
      </tbody>

    </table>
  </main>
</body>

</html>
