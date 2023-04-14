<?php
include('../controller/config.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

      $email = $conexao->real_escape_string($_POST['email']);
      $senha =  md5($conexao->real_escape_string($_POST['senha']));

        $sql_code = "SELECT * FROM funcionarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: ");

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['idfuncionarios'] = $usuario['idfuncionarios'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: paginaInicial.php");

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tela de Login Funcionario</title>
    <link rel="stylesheet" href="../styles/style-login.css" />
  </head>
  <body>
    <form action="" method="POST">
      <h2>LOGIN FUNCIONARIO</h2>
      <label for="email">Email</label>
      <input
        type="email"
        id="email"
        name="email"
        placeholder="Digite seu email"
        required
      />
      <label for="password">Senha</label>
      <input
        type="password"
        id="senha"
        name="senha"
        placeholder="Digite sua senha"
        required
      />
      <button type="submit" onclick="logar()">Entrar</button>

      <div class="forgot"><a href="#">Esqueceu a senha?</a></div>
    </form>
  </body>
</html>