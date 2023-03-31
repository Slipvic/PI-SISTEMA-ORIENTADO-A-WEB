<?php

include('protectAdmin.php');
include('../controller/config.php');


// Executa a consulta SQL dos produtos
$sql = "SELECT p.nome, p.avaliacao, p.preco, p.qtd_estoque, i.caminho FROM produto p LEFT JOIN imagem i ON p.id_produto = i.id_produto";
$result = $conexao->query($sql);


?>
<!DOCTYPE html>
<html>

<head>
    <title>Listagem de Produtos</title>
    <link rel="stylesheet" href="../styles/style-listausuario.css" />
    <link rel="stylesheet" href="../styles/style-table.css" />

</head>

<body>
    Bem vindo ao Painel,
    <?php echo $_SESSION['nome']; ?>.
    <header>
        <h1>Produtos em Estoque</h1>
        <div class="actions">
            <button class="add-user"><a href="cadastroProduto.php">Incluir Produto</a></button>
            <div class="search">
                <input type="text" placeholder="Buscar Usuários">
                <button class="search-button">Buscar</button>
            </div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Nome do Produto</th>
                    <th>Avaliação</th>
                    <th>preço</th>
                    <th>Quantidade</th>
                    <th>Imagem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Itera sobre os resultados da consulta
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row["nome"]; ?>
                            </td>
                            <td>
                                <?php echo $row["avaliacao"]; ?>
                            </td>
                            <td>
                                <?php echo $row["preco"]; ?>
                            </td>
                            <td>
                                <?php echo $row["qtd_estoque"]; ?>
                            </td>
                            <td class="thumbnail">
                            <img src="<?php echo $row["caminho"]; ?>" width="100" />
                            </td>
                            <td>
                                <button class="edit">Alterar</button>
                                <button class="disable">Inativar</button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "Não foram encontrados usuários.";
                }
                ?>
            </tbody>
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