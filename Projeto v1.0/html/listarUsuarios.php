<?php
include('protectAdmin.php');
include('../controller/config.php');

// Executa a consulta SQL
$sql = "SELECT idfuncionarios, nome, grupo, ativo FROM funcionarios";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Listagem de Usuários</title>
	<link rel="stylesheet" href="../styles/style-listausuario.css" />
	<link rel="stylesheet" href="../styles/style-table.css" />
</head>

<body>
	Bem vindo ao Painel, <?php echo $_SESSION['nome']; ?>.
	<header>
		<h1>Listagem de Usuários</h1>
		<div class="actions">
			<button class="add-user"><a href="cadastroFuncionario.php">Incluir Usuário</a></button>
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
					<th>Nome do Usuário</th>
					<th>Tipo de Usuário</th>
					<th>Status</th>
					<th>ID</th>
					<th>Ações</th>
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