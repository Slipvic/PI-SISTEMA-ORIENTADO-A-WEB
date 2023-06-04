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





CREATE TABLE `artgallery`.`funcionarios` (
  `idfuncionarios` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(110) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `grupo` VARCHAR(45) NOT NULL,
  `ativo` BIT NOT NULL DEFAULT 1,
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

CREATE TABLE PEDIDO (
    id INT PRIMARY KEY AUTO_INCREMENT,
    data DATE NOT NULL,
    cliente_id INT NOT NULL,
    frete  DECIMAL(10,2) NOT NULL,
    total  DECIMAL(10,2) NOT NULL,
    endereco_id INT NOT NULL,
    forma_pgto VARCHAR(255) NOT NULL,
    status VARCHAR(255),
    FOREIGN KEY (cliente_id) REFERENCES CLIENTE(id),
    FOREIGN KEY (endereco_id) REFERENCES ENDERECO(id)
);

CREATE TABLE ITENS_PEDIDO (
    id INT PRIMARY KEY AUTO_INCREMENT,
    produto VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL,
    pedido_id INT NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES PEDIDO(id)
);


SELECT * FROM artgallery.funcionarios;
SELECT * FROM artgallery.users;
SELECT * FROM artgallery.imagem;
SELECT * FROM artgallery.endereco;
SELECT * FROM artgallery.produto;
/*drop database loja;
/*ALTER TABLE users ADD COLUMN data_nascimento DATE NOT NULL DEFAULT '1970-01-01' AFTER sexo;
