CREATE TABLE Foto(
    ID INT NOT NULL auto_increment,
    Nome VARCHAR (255) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE Cliente (
    ID INT NOT NULL auto_increment,
    Foto INT NOT NULL,
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
    Foto INT NOT NULL,
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
    Foto INT NOT NULL,
    Nome VARCHAR(50) NOT NULL,
    Codigo VARCHAR(10) NOT NULL,
    Categoria VARCHAR(20) NOT NULL,
    Quantidade INT NOT NULL,
    Vendedor_ID INT NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE Compra (
    ID INT NOT NULL auto_increment,
    Cliente_ID INT NOT NULL,
    Data_Compra DATE,
    PRIMARY KEY (ID),
    FOREIGN KEY (Cliente_ID) REFERENCES Cliente (ID)
);

CREATE TABLE CompraXProduto (
    ID INT NOT NULL auto_increment,
    Compra_ID INT NOT NULL,
    Produto_ID INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Compra_ID) REFERENCES Compra (ID),
    FOREIGN KEY (Produto_ID) REFERENCES Produto (ID)
);

SELECT * FROM Foto;
SELECT * FROM Cliente;
SELECT * FROM Vendedor;
SELECT * FROM Produto;
SELECT * FROM Compra;
