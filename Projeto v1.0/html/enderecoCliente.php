<?php
session_start();
include('../controller/config.php');

// Executa a consulta SQL dos usuários
$id = $_SESSION['idusers'];
$sql = "SELECT nome, email, cpf, sexo FROM users WHERE idusers = $id";
$result = $conexao->query($sql);
$row = $result->fetch_assoc(); // obtém a primeira linha do resultado da consulta

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
					<th>numero</th>
					<th>Complemento</th>
					<th>Bairro</th>
					<th>Cidade</th>
                    <th>UF</th>
                    <th>Entrega</th>
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
							<td><?php echo $row["grupo"]; ?></td>
							<td><?php echo $status; ?></td>
							<td><?php echo $row["idfuncionarios"]; ?></td>
							<td>
								<button class="edit"><a href="alterarUsuarios.php?id=<?php echo $row["idfuncionarios"]; ?>">Alterar</a></button>
								<?php if ($row['ativo'] == 1) { ?>
									<a href="inativarFuncionario.php?id=<?php echo $row['idfuncionarios']; ?>&status=0">
										<button class="disable">Inativar</button>
									</a>
								<?php } else { ?>
									<a href="inativarFuncionario.php?id=<?php echo $row['idfuncionarios']; ?>&status=1">
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