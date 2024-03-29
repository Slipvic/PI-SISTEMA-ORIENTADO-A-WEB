<?php
include('../controller/config.php');

if (isset($_POST['submit'])) { // verifique se o formulário foi submetido

    $nome = $conexao->real_escape_string($_POST['nome']);
    $cpf = $conexao->real_escape_string($_POST['cpf']);
    $email = $conexao->real_escape_string($_POST['email']);
    $senha = $conexao->real_escape_string($_POST['senha']);
    $sexo = $conexao->real_escape_string($_POST['sexo']);
    $data_nascimento = $conexao->real_escape_string($_POST['data_nascimento']);

    $result = mysqli_query($conexao, "INSERT INTO users(nome,email,cpf,senha,sexo,data_nascimento) 
    VALUES ('$nome','$email','$cpf','$senha','$sexo','$data_nascimento')");


    header("Location: login-client.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Tela de Cadastro</title>
    <link rel="stylesheet" href="../styles/style-cadastroClienteNovo.css" />
    <script src="../js/scriptNovo.js"></script>
</head>

<body>
    <div class="cadastro">
        <h1>Cadastro</h1>
        <form id="formulario" action="" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required pattern="[A-Za-z\s]+" title="O campo Nome deve conter apenas letras e espaços. Este campo é obrigatório." />
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" placeholder="123.456.789-00" maxlength="14" required title="Digite um CPF válido no formato xxx.xxx.xxx-xx" oninput="validarCPF()" />
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required title="Por favor, insira um endereço de e-mail válido." />
            <label for="data_nascimento">Data de nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required minlength="6" title="A senha deve ter no mínimo 6 caracteres. Este campo é obrigatório." />
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="" selected disabled hidden>Selecione uma opção</option>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="outro">Outro</option>
            </select>
            <br>
            <input type="submit" name="submit" value="Cadastrar">
        </form>
    </div>
</body>

</html>