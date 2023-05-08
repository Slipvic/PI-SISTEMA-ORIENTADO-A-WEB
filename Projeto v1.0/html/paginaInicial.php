<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['idfuncionarios'])) {
    die("Você não pode acessar esta página porque não está logado.<p><a href=\"login-backoffice.php\">Entrar</a></p>");
}
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
        <h2>Bem vindo, <?php echo $_SESSION['nome']; ?></h2>
        <br>
        <div class="btn-container">
        <button type="submit"><a href="listarProdutos.php">Produtos</a></button>
        <button type="submit"><a href="listarUsuarios.php">Funcionarios</a></button>
            <br>
            <br>
            <button type="submit">Voltar<a href="login-backoffice.html"></a></button>
        </div>
    </form>
</body>

</html>
