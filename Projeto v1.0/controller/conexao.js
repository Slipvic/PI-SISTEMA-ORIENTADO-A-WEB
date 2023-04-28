// conexão com o Banco
import { createConnection } from 'mysql';
const mysql = require('mysql');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'artgallery',
});

function criaUsuario(nome, email, senha, sexo) {
  const query = `INSERT INTO users (nome, email, senha, sexo) VALUES (?, ?, ?, ?)`;
  const values = [nome, email, senha, sexo];
  connection.query(query, values, (error, results, fields) => {
    if (error) throw error;
    console.log('Usuário criado com sucesso!');
  });
}

function listaUsuarios() {
  const query = `SELECT * FROM users`;
  connection.query(query, (error, results, fields) => {
    if (error) throw error;
    console.log('Usuários cadastrados:');
    results.forEach((usuario) => {
      console.log(
        `Nome: ${usuario.nome}, Email: ${usuario.email}, Senha: ${usuario.senha}, Sexo: ${usuario.sexo}`
      );
    });
  });
}

module.exports = { criaUsuario, listaUsuarios };
