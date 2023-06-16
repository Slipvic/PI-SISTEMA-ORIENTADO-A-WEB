<?php
include('../controller/config.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

      $email = $conexao->real_escape_string($_POST['email']);
      $senha = $conexao->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: ");

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['idusers'] = $usuario['idusers'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: indexClientes.php");

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tela de Login</title>
  <link rel="stylesheet" href="../styles/loginClienteNovoteste.css" />
</head>
<body>
  <form action="" method="POST">
    <h2>LOGIN</h2>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Digite seu email" required />
    <label for="password">Senha</label>
    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required />

    <button type="submit" onclick="logar()">Entrar</button>
    <div class="signup">Não tem uma conta? <a href="cadastroUser.php">Cadastre-se</a></div>
    <br>
    <div class="forgot"><a href="#">Esqueceu a senha?</a></div>
  </form>
  <script>

    function logar() {
      const emailInput = document.querySelector('#email');
      const passwordInput = document.querySelector('#password');
      const email = emailInput.value.trim();
      const password = passwordInput.value.trim();

      // Verifica se os campos foram preenchidos
      if (!email || !password) {
        alert('Por favor, preencha todos os campos.');
        return false;
      }

      // Verifica se o e-mail possui um formato válido
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        alert('Por favor, digite um e-mail válido.');
        return false;
      }

      // Se chegou até aqui, os campos estão preenchidos corretamente
      alert('Validação concluida!');
      return true;
    }
  </script>
</body>

</html>