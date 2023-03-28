<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome_produto = $_POST["nome_produto"];
        $descricao = $_POST["descricao"];
        $preco = $_POST["preco"];
        $estoque = $_POST["estoque"];

        $img_dir = "../img/";
        $img_name = "img_" . uniqid() . ".png";
        $img_file = $img_dir . $img_name;

        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $img_file)) {
            $conexao = mysqli_connect("localhost", "root", "", "artgallery");
            if (!$conexao) {
                die("Erro de conexão: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO produto (nome, descricao, preco, qtd_estoque) VALUES ('$nome_produto', '$descricao', $preco, $estoque)";

            if (mysqli_query($conexao, $sql)) {
                $id_produto = mysqli_insert_id($conexao);
                $sql = "INSERT INTO imagem (id_produto, caminho, eh_padrao) VALUES ($id_produto, '$img_name', true)";

                if (mysqli_query($conexao, $sql)) {
                    echo "<p>Produto cadastrado com sucesso!</p>";
                } else {
                    echo "<p>Erro ao cadastrar imagem.</p>";
                }
            } else {
                echo "<p>Erro ao cadastrar produto.</p>";
            }

            mysqli_close($conexao);
        } else {
            echo "<p>Erro ao fazer upload da imagem.</p>";
        }
    }
    ?>

    <div class="cadastro">
        <h1>Cadastro de Produto</h1>
        <form id="formulario" action="" method="POST" enctype="multipart/form-data">
            <label for="nome_produto">Nome do Produto:</label>
            <input type="text" id="nome_produto" name="nome_produto" required />
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" required />
            <label for="estoque">Quantidade em Estoque:</label>
            <input type="number" id="estoque" name="estoque" min="0" required />
            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem" accept="image/png, image/jpeg" required />
            <br /><br />
            <input type="submit" value="Cadastrar" />
        </form>
    </div>
</body>
</html>
