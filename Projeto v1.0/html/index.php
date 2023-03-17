<!DOCTYPE html>
<html>
  <head>
    <title>Minha Página</title>
    <link rel="stylesheet" href="../styles/style.css" />
  </head>
  <body>
    <header>
      <h1>Bem-vindo à galeria</h1>
    </header>
    <nav>
      <ul>
        <li><a href="#">Página Inicial</a></li>
        <li><a href="#">Contato</a></li>
        <li><a href="login-client.php">Login</a></li>
        <li><a href="#">Sobre</a></li>
      </ul>
    </nav>
    <main>
      <section>
        <h2>Sobre nós</h2>
        <p>
          Somos o grupo cibernéticos, buscando construir uma pagina de
          comercialização artistica.
        </p>
      </section>
      <section>
        <h2>Contato</h2>
        <form>
          <label for="nome">Nome:</label>
          <input type="text" id="nome" name="nome" /><br />
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" /><br />

          <label for="mensagem">Mensagem:</label>
          <textarea id="mensagem" name="mensagem"></textarea><br />

          <input type="submit" value="Enviar" />
        </form>
      </section>
    </main>
    <footer>
      <p>&copy; 2023 Victor H Moreira</p>
    </footer>
  </body>
</html>
