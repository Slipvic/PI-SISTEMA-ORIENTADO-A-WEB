<?php

include('protectAdmin.php');
include('../controller/config.php');


// Executa a consulta SQL dos produtos
$sql = "SELECT p.id_produto, p.nome, p.avaliacao, p.preco, p.qtd_estoque, p.ativo, MAX(i.caminho) AS caminho FROM produto p LEFT JOIN imagem i ON p.id_produto = i.id_produto GROUP BY p.id_produto";
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
    Editor atual:
    <?php echo $_SESSION['nome']; ?>
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
                    <th>Status</th>
                    <th>Detalhes</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Itera sobre os resultados da consulta
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $status = ($row['ativo'] == 1) ? "Ativo" : "Inativo";
                ?>
                        <tr>
                            <td><?php echo $row["nome"]; ?></td>
                            <td><?php echo $row["avaliacao"]; ?></td>
                            <td><?php echo "R$" . $row["preco"]; ?></td>
                            <td><?php echo $row["qtd_estoque"]; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><button class="edit"><a href="detalheProduto.php?id_produto=<?php echo $row["id_produto"]; ?>">ver mais..</a></button></td>
                            <td>
                                <button class="edit"><a href="alterarProdutos.php?id=<?php echo $row["id_produto"]; ?>">Alterar</a></button>
                                <?php if ($row['ativo'] == 1) { ?>
                                    <a href="inativarProduto.php?id=<?php echo $row['id_produto']; ?>&status=0">
                                        <button class="disable">Inativar</button>
                                    </a>
                                <?php } else { ?>
                                    <a href="inativarProduto.php?id=<?php echo $row['id_produto']; ?>&status=1">
                                        <button class="disable">Ativar</button>
                                    </a>
                                <?php } ?>
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