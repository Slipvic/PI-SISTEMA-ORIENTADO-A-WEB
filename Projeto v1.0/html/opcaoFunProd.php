<?php

include('protectAdmin.php');
Include('../controller/config.php');


// Executa a consulta SQL
$sql = "SELECT nome, grupo, idfuncionarios FROM funcionarios";
$result = $conexao->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>cadastro de produtos ou funcionario</title>
    <link rel="stylesheet" href="../styles/style-login.css" />
    <style>
        .btn-container {
            text-align: center;
        }
    </style>
</head>

<body>
    <form>
        <h2>Escolha uma das opções abaixo</h2>
        <br>
        <div class="btn-container">
            <button type="submit">Cadastrar produto</button>
            <button type="submit">Cadastrar Funcionário</button>
            <br>
            <br>
            <button type="submit">Voltar<a href="login-backoffice.html"></a></button>
        </div>
    </form>
</body>
</html>