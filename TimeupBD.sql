CREATE TABLE Foto(
    ID INT NOT NULL auto_increment,
    Nome VARCHAR (255) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE Cliente (
    ID INT NOT NULL auto_increment,
    Foto_ID INT NOT NULL,
    Nome VARCHAR (50) NOT NULL,
    Data_Nascimento DATE NOT NULL,
    CPF VARCHAR (11) NOT NULL,
    Telefone VARCHAR (11) NOT NULL,
    Email VARCHAR (50) NOT NULL,
    Senha VARCHAR (20) NOT NULL,
    Rua VARCHAR (100) NOT NULL,
    Numero INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Foto_ID) REFERENCES Foto (ID)
);

CREATE TABLE Vendedor (
    ID INT NOT NULL auto_increment,
    Foto_ID INT NOT NULL,
    Nome VARCHAR (50) NOT NULL,
    CNPJ VARCHAR (14) NOT NULL,
    Email VARCHAR (50) NOT NULL,
    Senha VARCHAR (20) NOT NULL,
    Rua VARCHAR (50) NOT NULL,
    Numero INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Foto_ID) REFERENCES Foto (ID)
);

CREATE TABLE Produto (
    ID INT NOT NULL auto_increment,
    Foto_ID INT NOT NULL,
    Nome VARCHAR(50) NOT NULL,
    Valor INT NOT NULL,
    Categoria VARCHAR(20) NOT NULL,
    Vendedor_ID INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Foto_ID) REFERENCES Foto (ID)
);

CREATE TABLE Orcamento (
    ID INT NOT NULL auto_increment,
    Nome VARCHAR (50) NOT NULL,
    Cliente_ID INT NOT NULL,
    Produto_ID INT NOT NULL,
    Quantidade INT NOT NULL,
    Data_Orcamento DATE NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (Cliente_ID) REFERENCES Cliente (ID),
    FOREIGN KEY (Produto_ID) REFERENCES Produto (ID)
);

SELECT * FROM Foto;
SELECT * FROM Cliente;
SELECT * FROM Vendedor;
SELECT * FROM Produto;
SELECT * FROM Orcamento;
