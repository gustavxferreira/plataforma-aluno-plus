# Plaforma Aluno Plus

Este projeto feito para controle de matrículas de alunos construída utilizando as seguintes tecnologias:

- **PHP**: Utilizada no Backend.
- **Javascript**: Utilizada no Frontend
- **Eloquent**: ORM para interação com o banco de dados.
- **FastRoute**: Gerenciador de rotas rápido e eficiente.
- **Respect/Validation**: Para validação de dados.
- **Phinx**: Gerenciador de migrations e seeds.
- **Lit**: Para criação de componentes leves no frontend.
- **JWT**: Para geração e validação de tokens de autenticação.
- **jQuery**: Utilizado no frontend para manipulação de DOM.

---
## Esquema do Banco de Dados
![Esquema Do Banco de Dados](/schema.png)
---
## Pré-requisitos

Antes de começar, certifique-se de ter as seguintes ferramentas instaladas no seu ambiente:

- **Git**
- **Composer**
- **Docker** e **Docker Compose**
---

## Esquema de Rotas

**O arquivo `aluno-plus.postman_collection.json` contém a definição das rotas da API. Você pode importá-lo no Postman para explorar e testar as rotas disponíveis.**

---

## Como rodar o projeto

Siga os passos abaixo para configurar e rodar o projeto:

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/gustavxferreira/plataforma-aluno-plus.git
   cd plataforma-aluno-plus
   ```
2.  **Instale as dependências do projeto:**
     ```bash
     composer install
     ```
3. **Renomear arquivo .env**
     ```bash
     mv example.env .env
     ```
4. **Suba os containers com PHP, Apache e MySQL**
     ```bash
     docker-compose up -d
     ```
5. **Execute as migrations para configurar o banco de dados**
   ```bash
     vendor/bin/phinx migrate
     ```
 6. **Popule o banco de dados com os seeds**
     ```bash
     vendor/bin/phinx seed:run
     ```
## Usuário Padrão

- **Login: admin**
- **Senha: admin**

## Acesse o projeto
Depois de realizar os passos acima, acesse o projeto no navegador pelo endereço:
http://localhost:80


   
