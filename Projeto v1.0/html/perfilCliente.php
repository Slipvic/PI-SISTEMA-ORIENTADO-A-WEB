<?php
session_start();
include('../controller/config.php');

// Executa a consulta SQL dos usuários
$id = $_SESSION['idusers'];
$sql = "SELECT nome, email, cpf, sexo FROM users WHERE idusers = $id";
$result = $conexao->query($sql);
$row = $result->fetch_assoc(); // obtém a primeira linha do resultado da consulta

// Verifica se o botão "Salvar" foi clicado
if(isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];

    // Atualiza os dados na tabela
    $sql = "UPDATE users SET nome='$nome', email='$email', cpf='$cpf', sexo='$sexo' WHERE idusers=$id";
    $result = $conexao->query($sql);

    // Redireciona para a página do perfil com os dados atualizados
    header('Location: perfilCliente.php');
    exit();
}
// Verificar se o botão de logoff foi pressionado
if (isset($_POST['logoff'])) {
  // Destruir a sessão atual
  session_destroy();
  
    // Redirecionar o usuário para a página de login
    header("Location: indexClientes.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"> 
      <?php if(isset($_SESSION['nome'])){
        echo '<a class="navbar-brand" href="#"> Olá, ' . explode(" ", $_SESSION['nome'])[0] . '</a>';
      }?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Baixe o App</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Meus Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="indexClientes.php">Quadros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo isset($_SESSION['idusers']) ? 'perfilCliente.php' : 'login-client.php'; ?>">
            <?php echo isset($_SESSION['idusers']) ? 'Perfil' : 'Login'; ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="enderecoCliente.php">Endereços</a>
        </li>
      </ul>
    </div>
  </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Meu Perfil</div>
                    <div class="card-body">
                        <form id="formulario" action="" method="POST">
                            <div class="form-group">
                                <label for="nome">Nome Completo:</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome"
                                    value="<?php echo $row['nome']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email"
                                    value="<?php echo $row['email']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="CPF">CPF:</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF"
                                    value="<?php echo $row['cpf']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                <input type="text" class="form-control" id="sexo" name="sexo" placeholder="Digite seu sexo"
                                    value="<?php echo $row['sexo']; ?>" readonly>
                            </div>
                        
                            <button id="editar" class="btn btn-primary" type="button">Editar</button>
                            <button id="submit" class="btn btn-primary" type="submit" name="salvar">Salvar</button>
                            <button id="Logoff" class="btn btn-primary" type="submit" name="logoff">Fazer Log off</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("editar").addEventListener("click", function () {
            document.getElementById("nome").removeAttribute("readonly");
            document.getElementById("email").removeAttribute("readonly");
            document.getElementById("cpf").removeAttribute("readonly");
            document.getElementById("sexo").removeAttribute("readonly");

        });
    </script>
    <script>
        function salvarForm() {
            document.getElementById("nome").setAttribute("readonly", true);
            document.getElementById("email").setAttribute("readonly", true);
            document.getElementById("cpf").setAttribute("readonly", true);
            document.getElementById("sexo").setAttribute("readonly", true);

        }
    </script>
</body>

</html>