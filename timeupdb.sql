CREATE DATABASE TimeupDB;

CREATE TABLE Cliente (
    ID INT NOT NULL auto_increment,
    Nome VARCHAR (50) NOT NULL,
    Data_Nascimento DATE NOT NULL,
    CPF VARCHAR (11) NOT NULL,
    Telefone VARCHAR (11) NOT NULL,
    Email VARCHAR (50) NOT NULL,
    Senha VARCHAR (20) NOT NULL,
    Rua VARCHAR (30) NOT NULL,
    Numero INT NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE Vendedor (
    ID INT NOT NULL auto_increment,
    Nome VARCHAR (50) NOT NULL,
    CNPJ VARCHAR (14) NOT NULL,
    Email VARCHAR (50) NOT NULL,
    Senha VARCHAR (20) NOT NULL,
    Rua VARCHAR (30) NOT NULL,
    Numero INT NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE Produto (
    ID INT NOT NULL auto_increment,
    Nome VARCHAR(50) NOT NULL,
    Codigo VARCHAR(10) NOT NULL,
    Categoria VARCHAR(20) NOT NULL,
    Quantidade INT NOT NULL,
    Vendedor_ID INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Vendedor_ID) REFERENCES Vendedor (ID)
);

CREATE TABLE Carrinho (
    ID INT NOT NULL auto_increment,
    Cliente_ID INT NOT NULL,
    Data_Compra DATE,
    PRIMARY KEY (ID),
    FOREIGN KEY (Cliente_ID) REFERENCES Cliente (ID)
);

CREATE TABLE CarrinhoXProduto (
    ID INT NOT NULL auto_increment,
    Carrinho_ID INT NOT NULL,
    Produto_ID INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Carrinho_ID) REFERENCES Carrinho (ID),
    FOREIGN KEY (Produto_ID) REFERENCES Produto (ID)
);

INSERT INTO Cliente (Nome, Data_Nascimento, CPF, Telefone, Email, Senha, Rua, Numero)
VALUES ("Jorge", "2000-04-20", "11111111111", "11111111111", "jorge@gmail.com", "jorge123", "Rua Jorge", "1"),
    ("Marcos", "1990-08-15", "22222222222", "22222222222", "marcos@gmail.com", "marcos123", "Rua Marcos", "2"),
    ("Maria", "2001-03-25", "33333333333", "33333333333", "maria@gmail.com", "maria123", "Rua Maria", "3"),
    ("Ana", "1997-11-05", "44444444444", "44444444444", "ana@gmail.com", "ana123", "Rua Ana", "4");

INSERT INTO Vendedor (Nome, CNPJ, Email, Senha, Rua, Numero)
VALUES ("123 Construções", "11111111111111", "123construcoes@gmail.com", "constru123", "Rua Construções", "111"),
    ("123 Materiais", "22222222222222", "123materiais@gmail.com", "materiais123", "Rua Construções", "222");

INSERT INTO Produto (Nome, Codigo, Categoria, Quantidade, Vendedor_ID)
VALUES ("Telha", "00000001", "Ceramicas", "500", "1"),
    ("Piso1", "00000002", "Ceramicas", "700", "2"),
    ("Piso2", "00000003", "Ceramicas", "300", "1");

INSERT INTO Carrinho (Cliente_ID, Data_Compra)
VALUES ("1", "2020-11-05"),
    ("2", "2021-02-15"),
    ("3", "2018-09-28");

INSERT INTO CarrinhoXProduto (Carrinho_ID, Produto_ID)
VALUES ("1", "1"),
    ("1", "2"),
    ("1", "3"),
    ("2", "2"),
    ("3", "1");

SELECT * FROM Cliente;
SELECT * FROM Vendedor;
SELECT * FROM Produto;
SELECT * FROM Compra;
