
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Cadastro de Endereço</title>
  <link rel="stylesheet" href="../styles/style-cadastroEndereco.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="..\js\script.js"></script>

</head>

<body>
    <h1>Cadastro de Endereço</h1>
    <form id="cadastro">
      <label for="nome">Nome do Recebedor:</label>
      <input type="text" id="nome" name="nome" required><br>
  
      <label for="cep">CEP:</label>
      <input type="text" id="cep" placeholder="12345-678" name="cep" maxlength="9" required><br>
  
      <label for="logradouro">Logradouro:</label>
      <input type="text" id="logradouro" name="logradouro" required><br>
  
      <label for="numero">Número:</label>
      <input type="text" id="numero" name="numero" required><br>
  
      <label for="complemento">Complemento:</label>
      <input type="text" id="complemento" name="complemento" required><br>
  
      <label for="bairro">Bairro:</label>
      <input type="text" id="bairro" name="bairro" required><br>
  
      <label for="cidade">Cidade:</label>
      <input type="text" id="cidade" name="cidade" required><br>
  
      <label for="estado">Estado:</label>
      <input type="text" id="estado" name="estado" required><br>
  
      <label for="faturamento">Faturamento:</label>
      <input type="text" id="faturamento" name="faturamento" required><br>
  
      <label for="entrega">Entrega:</label>
      <input type="text" id="entrega" name="entrega" required><br>
  
      <button type="submit">Cadastrar</button>
    </form>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="meuScript.js"></script>
    <script>
      meuCadastroDeEndereco();
    </script>
  </body>