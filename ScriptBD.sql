

create database artgallery;
use artgallery;
CREATE TABLE users (
  idusers INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  cpf VARCHAR(14) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  sexo VARCHAR(10) NOT NULL,
  data_nascimento DATE NOT NULL
);


CREATE TABLE endereco (
  id INT PRIMARY KEY AUTO_INCREMENT,
  idusers INT NOT NULL,
  cep VARCHAR(9) NOT NULL,
  logradouro VARCHAR(255) NOT NULL,
  numero INT NOT NULL,
  complemento VARCHAR(140) NOT NULL,
  bairro VARCHAR(140) NOT NULL,
  cidade VARCHAR(20) NOT NULL,
  uf VARCHAR(20) NOT NULL,
  faturamento VARCHAR(44) NOT NULL,
  entrega VARCHAR(44) NOT NULL,
  FOREIGN KEY (idusers) REFERENCES users(idusers) ON DELETE CASCADE
);

-- Inserção de um cliente e endereço de exemplo
INSERT INTO users (nome, email, cpf, senha, sexo, data_nascimento)
VALUES ('João Silva', 'joao.silva@example.com', '12345678900', 'senha123', 'Masculino', '2000-01-01');

 

SET @idCliente = LAST_INSERT_ID();

 

INSERT INTO endereco (idusers, logradouro, numero, complemento, bairro, cidade, uf, cep, faturamento, entrega)
VALUES (@idCliente, 'Rua Exemplo', 123, 'Apto 456', 'Centro', 'Cidade Exemplo', 'UF', '12345-678', 'Endereço de Faturamento', 'Endereço de Entrega');


CREATE TABLE `artgallery`.`funcionarios` (
  `idfuncionarios` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(110) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `grupo` VARCHAR(45) NOT NULL,
  `ativo` BIT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idfuncionarios`));

INSERT INTO funcionarios (nome, email, cpf, senha, grupo, ativo) 
VALUES ('Administrador', 'adm@gmail.com', '12345678900', 'e10adc3949ba59abbe56e057f20f883e', 'Administrador', 1);
  
CREATE TABLE produto (
  id_produto INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(200) NOT NULL,
  avaliacao DECIMAL(2,1) NOT NULL,
  descricao TEXT NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  qtd_estoque INT NOT NULL,
  ativo BIT NOT NULL DEFAULT 1
);

INSERT INTO produto (nome, avaliacao, descricao, preco, qtd_estoque, ativo)
VALUES
  ('Quadro Futurista', 4.5, 'Descrição do Quadro Futurista', 149.99, 10, 1),
  ('Quadro Color', 4.2, 'Descrição do Quadro Color', 129.99, 8, 1),
  ('Quadros Deus', 4.8, 'Descrição dos Quadros Deus', 179.99, 5, 1),
  ('Quadros Star Wars', 4.6, 'Descrição dos Quadros Star Wars', 199.99, 12, 1),
  ('Quadro Noite Estrelada', 4.4, 'Descrição do Quadro Noite Estrelada', 249.99, 3, 1),
  ('Quadro Amelie', 4.1, 'Descrição do Quadro Amelie', 159.99, 6, 1),
  ('Quadro Paisagem', 4.3, 'Descrição do Quadro Paisagem', 189.99, 9, 1),
  ('Quadro Abstrato', 4.7, 'Descrição do Quadro Abstrato', 169.99, 7, 1);

CREATE TABLE imagem (
  id_imagem INT PRIMARY KEY AUTO_INCREMENT,
  id_produto INT NOT NULL,
  caminho VARCHAR(200) NOT NULL,
  eh_padrao BOOLEAN NOT NULL,
  FOREIGN KEY (id_produto) REFERENCES produto(id_produto) ON DELETE CASCADE
);


INSERT INTO imagem (id_produto, caminho, eh_padrao)
VALUES
  (1, '../img/6432185011e9a-cambg_2 (Grande).jpg', TRUE),
  (2, '../img/644968e9b176e-girl-2696947_1280 (Grande).jpg', TRUE),
  (3, '../img/645571ed58b69-deus.jpg', TRUE),
  (4, '../img/645571ed594ba-kit3 (Grande).jpg', TRUE),
  (5, '../img/645bd240ebd04-art1 (Grande).jpg', TRUE),
  (6, '../img/645bd955cb964-amelie (Grande).jpg', TRUE),
  (7, '../img/645bdacf53f0c-art2 (Grande).jpg', TRUE),
  (8, '../img/645bdb65535b3-art3 (Grande).jpg', TRUE);
  
  
CREATE TABLE pedido (
  id_pedido INT PRIMARY KEY AUTO_INCREMENT,
  idusers INT NOT NULL,
  id_endereco INT NOT NULL,
nome_pedido VARCHAR(100),
  opcao_pagamento VARCHAR(50),
  total  DECIMAL(10,2) NOT NULL,
  estado VARCHAR(44),
  FOREIGN KEY (idusers) REFERENCES users(idusers) ON DELETE CASCADE,
  FOREIGN KEY (id_endereco) REFERENCES endereco(id)
);

SELECT * FROM artgallery.funcionarios;
SELECT * FROM artgallery.users;
SELECT * FROM artgallery.imagem;
SELECT * FROM artgallery.endereco;
SELECT * FROM artgallery.produto;
SELECT * FROM artgallery.pedido;
