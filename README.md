# TCC-Timeup

Link para o site: https://tcctimeup.000webhostapp.com

<details>
<summary>Dicionário de Dados</summary><br>

| Tabelas   | Relacionamento                          | Descrição                                                            |
|:---------:|:---------------------------------------:|:--------------------------------------------------------------------:|
| Foto      | Pertence a Cliente, Vendedor ou Produto | Armazena o nome dos arquivos de imagem armazenados no host do site   |
| Cliente   | Possui Foto e Orçamentos                | Armazena os dados referentes a um cliente                            |
| Vendedor  | Possui Foto e Produtos                  | Armazena os dados referentes a um vendedor                           |
| Produto   | Pertence a Vendedor                     | Armazena os dados referentes a um produto cadastrado por um vendedor |
| Orçamento | Pertence a Cliente                      | Armazena os dados referentes a um orçamento feito por um cliente     |

<details>
<summary>Foto</summary><br>

| Nome dos dados | Tipo de dados | Comprimento | Restrições   | Valor padrão   | Descrição                                            |
|:--------------:|:-------------:|:-----------:|:------------:|:--------------:|:----------------------------------------------------:|
| ID             | INT           | Default     | PK, NOT NULL | auto_increment | Número de identificação da foto                      |
| Nome           | INT           | 255         | NOT NULL     | N/A            | Nome do arquivo de imagem armazenado no host do site |

</details>

<details>
<summary>Cliente</summary><br>

| Nome dos dados  | Tipo de dados | Comprimento | Restrições   | Valor padrão   | Descrição                           |
|:---------------:|:-------------:|:-----------:|:------------:|:--------------:|:-----------------------------------:|
| ID              | INT           | Default     | PK, NOT NULL | auto_increment | Número de identificação do cliente  |
| Foto_ID         | INT           | Default     | FK, NOT NULL | N/A            | Número de identificação de uma foto |
| Nome            | VARCHAR       | 100         | NOT NULL     | N/A            | Nome do cliente                     |
| Data_Nascimento | DATE          | Default     | NOT NULL     | N/A            | Data de nascimento do cliente       |
| CPF             | INT           | 11          | NOT NULL     | N/A            | CPF do cliente                      |
| Telefone        | INT           | 11          | NOT NULL     | N/A            | Telefone do cliente                 |
| Email           | VARCHAR       | 50          | NOT NULL     | N/A            | Email do cliente                    |
| Senha           | VARCHAR       | 20          | NOT NULL     | N/A            | Senha do cliente                    |
| Rua             | VARCHAR       | 100         | NOT NULL     | N/A            | Rua do cliente                      |
| Numero          | INT           | Default     | NOT NULL     | N/A            | Número do cliente                   |

</details>

<details>
<summary>Vendedor</summary><br>

| Nome dos dados | Tipo de dados | Comprimento | Restrições   | Valor padrão   | Descrição                           |
|:--------------:|:-------------:|:-----------:|:------------:|:--------------:|:-----------------------------------:|
| ID             | INT           | Default     | PK, NOT NULL | auto_increment | Número de identificação do vendedor |
| Foto_ID        | INT           | Default     | FK, NOT NULL | N/A            | Número de identificação de uma foto |
| Nome           | VARCHAR       | 100         | NOT NULL     | N/A            | Nome do vendedor                    |
| CNPJ           | INT           | 14          | NOT NULL     | N/A            | CNPJ do vendedor                    |
| Email          | VARCHAR       | 50          | NOT NULL     | N/A            | Email do vendedor                   |
| Senha          | VARCHAR       | 20          | NOT NULL     | N/A            | Senha do vendedor                   |
| Rua            | VARCHAR       | 100         | NOT NULL     | N/A            | Rua do vendedor                     |
| Numero         | INT           | Default     | NOT NULL     | N/A            | Número do vendedor                  |

</details>

<details>
<summary>Produto</summary><br>

| Nome dos dados | Tipo de dados | Comprimento | Restrições   | Valor padrão   | Descrição                                                             |
|:--------------:|:-------------:|:-----------:|:------------:|:--------------:|:---------------------------------------------------------------------:|
| ID             | INT           | Default     | PK, NOT NULL | auto_increment | Número de identificação do produto                                    |
| Foto_ID        | INT           | Default     | FK, NOT NULL | N/A            | Número de identificação de uma foto                                   |
| Nome           | VARCHAR       | 100         | NOT NULL     | N/A            | Nome do produto                                                       |
| Valor          | DECIMAL       | 10, 2       | NOT NULL     | N/A            | Valor do produto, definido pelo vendedor                              |
| Categoria      | VARCHAR       | 50          | NOT NULL     | N/A            | Categoria do produto, definida pelo vendedor                          |
| Vendedor_ID    | INT           | Default     | FK, NOT NULL | N/A            | Número de identificação do vendedor que efetuou o cadastro do produto |

</details>

<details>
<summary>Orcamento</summary><br>

| Nome dos dados | Tipo de dados | Comprimento | Restrições   | Valor padrão   | Descrição                                                     |
|:--------------:|:-------------:|:-----------:|:------------:|:--------------:|:-------------------------------------------------------------:|
| ID             | INT           | Default     | PK, NOT NULL | auto_increment | Número de identificação do orçamento                          |
| Nome           | VARCHAR       | 50          | NOT NULL     | N/A            | Nome de identificação do orçamento                            |
| Cliente_ID     | INT           | Default     | NOT NULL     | N/A            | Número de identificação do cliente gerador do orçamento       |
| Produto_ID     | INT           | Default     | NOT NULL     | N/A            | Número de identificação do produto escolhido para o orçamento |
| Quantidade     | INT           | Default     | NOT NULL     | N/A            | Quantidade do produto escolhido para o orçamento              |
| Data_Orcamento | DATE          | 50          | NOT NULL     | N/A            | Data em que o orçamento foi gerado                            |

</details>

</details>
