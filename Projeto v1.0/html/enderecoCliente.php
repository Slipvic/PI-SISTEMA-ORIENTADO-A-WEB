<?php
session_start();
include('../controller/config.php');

// Executa a consulta SQL dos usuários
$id = $_SESSION['idusers'];
$sql = "SELECT logradouro, numero, bairro, uf FROM endereco WHERE idusers = $id";
$result = $conexao->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Endereços</title>
    <link rel="stylesheet" href="../styles/style-enderecoCliente.css" />
    <link rel="stylesheet" href="../styles/style-table.css" />
</head>

<body>
    <header>
        <h1>Endereços</h1>
        <div class="actions">
            <button class="add-user"><a href="cadastroEndereco.php">Novo Endereço</a></button>
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
                    <th>Ações</th>
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