create database artgallery;
use artgallery;
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
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
  logradouro varchar(140) NOT NULL,
  numero INT NOT NULL,
  complemento varchar(140) NOT NULL,
  bairro varchar(140) NOT NULL,
  cidade varchar(20) NOT NULL,
  uf varchar(20) NOT NULL,
  faturamento varchar(44) NOT NULL,
  entrega varchar(44) NOT NULL,
  FOREIGN KEY (idusers) REFERENCES users(idusers) ON DELETE CASCADE
);


CREATE TABLE `artgallery`.`funcionarios` (
  `idfuncionarios` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(110) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `grupo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idfuncionarios`));

  
CREATE TABLE produto (
  id_produto INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(200) NOT NULL,
  avaliacao DECIMAL(2,1) NOT NULL,
  descricao TEXT NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  qtd_estoque INT NOT NULL,
  ativo BIT NOT NULL DEFAULT 1
  
);


CREATE TABLE imagem (
  id_imagem INT PRIMARY KEY AUTO_INCREMENT,
  id_produto INT NOT NULL,
  caminho VARCHAR(200) NOT NULL,
  eh_padrao BOOLEAN NOT NULL,
  FOREIGN KEY (id_produto) REFERENCES produto(id_produto) ON DELETE CASCADE
);


SELECT * FROM artgallery.users;
SELECT * FROM artgallery.imagem;
SELECT * FROM artgallery.endereco;
/*drop database loja;
/*ALTER TABLE users ADD COLUMN data_nascimento DATE NOT NULL DEFAULT '1970-01-01' AFTER sexo;
