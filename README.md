# Laravel Docker Project

## Resumo do Projeto

Este projeto é uma aplicação Laravel configurada para rodar em contêineres Docker. Ele inclui funcionalidades para gerenciar usuários, influenciadores e campanhas, com autenticação JWT.

## Tecnologias Utilizadas

- **PHP**: 8.1
- **Laravel**: 10
- **MySQL**: 5.7
- **Nginx**
- **Docker**
- **JWT Auth**: Para autenticação segura de usuários

## Passos para Clonar o Repositório

1. Clone o repositório:
    ```sh
    git clone https://github.com/seu-usuario/laravel-docker.git
    cd laravel-docker
    ```

## Passos para Rodar o Docker e Inicializar o Projeto

1. Construa e inicie os contêineres Docker:
    ```sh
    docker-compose up --build
    ```

    Esse comando irá:
    - Construir a imagem do Docker a partir do `Dockerfile`.
    - Iniciar todos os serviços definidos no `docker-compose.yml`, incluindo:
      - O PHP-FPM para rodar a aplicação Laravel.
      - O MySQL para armazenar os dados.
      - O Nginx para servir a aplicação web.

2. **Automação do Processo:**
    - Após o `docker-compose up --build`, o `composer install` será executado automaticamente dentro do contêiner do Laravel para instalar todas as dependências necessárias do projeto.
    - Logo em seguida, as **migrações do banco de dados** serão executadas automaticamente para configurar o banco de dados.
    - Por fim, **os testes de feature das controllers** serão executados para garantir que as funcionalidades da aplicação estão funcionando corretamente.

3. **Acessando a Aplicação:**
    - O Nginx estará disponível na porta 8000. Você pode acessar a aplicação Laravel através do navegador ou utilizando uma ferramenta como o Postman, com o endereço `http://localhost:8000`.

4. **Acessando o Banco de Dados:**
    - O MySQL estará disponível na porta `3306`. Você pode acessá-lo utilizando qualquer cliente MySQL, como o MySQL Workbench ou o PhpMyAdmin (disponível na porta `8080`).



## Importar a Collection no Postman

    - Importe o arquivo chamado collection.json disponivel no repositório no postman ou insomnia.


## Mini Documentação das Rotas

### Autenticação

- **Registrar Usuário**
    - **URL:** `/api/register`
    - **Método:** `POST`
    - **Body:**
        ```json
        {
            "name": "João Silva",
            "email": "joao@exemplo.com",
            "password": "senha123"
        }
        ```

- **Login**
     **-URL:** `/api/login`
    - **Método:** `POST`
    - **Body:**
        ```json
        {
            "email": "joao@exemplo.com",
            "password": "senha123"
        }
        ```

### Usuários

- **Mostrar Usuário**
    - **URL:** `/api/user`
    - **Método:** `GET`
    - **Headers:** `Authorization: Bearer {token}`

- **Atualizar Usuário**
    - **URL:** `/api/user`
    - **Método:** `PUT`
    - **Headers:** `Authorization: Bearer {token}`
    - **Body:**
        ```json
        {
            "name": "João Silva Atualizado",
            "email": "joao.atualizado@exemplo.com",
            "password": "novaSenha123"
        }
        ```

- **Deletar Usuário**
    - **URL:** `/api/user`
    - **Método:** `DELETE`
    - **Headers:** `Authorization: Bearer {token}`

### Influenciadores

- **Criar Influenciador**
    - **URL:** `/api/influencers`
    - **Método:** `POST`
    - **Headers:** `Authorization: Bearer {token}`
    - **Body:**
        ```json
        {
            "name": "John Doe",
            "instagram_user": "johndoe",
            "followers_count": 1000,
            "category": "Technology"
        }
        ```

- **Listar Influenciadores**
    - **URL:** `/api/influencers`
    - **Método:** `GET`
    - **Headers:** `Authorization: Bearer {token}`

- **Mostrar Influenciador**
    - **URL:** `/api/influencers/{id}`
    - **Método:** `GET`
    - **Headers:** `Authorization: Bearer {token}`

- **Atualizar Influenciador**
    - **URL:** `/api/influencers/{id}`
    - **Método:** `PUT`
    - **Headers:** `Authorization: Bearer {token}`
    - **Body:**
        ```json
        {
            "name": "Jane Doe",
            "instagram_user": "janedoe",
            "followers_count": 2000,
            "category": "Lifestyle"
        }
        ```

- **Deletar Influenciador**
    - **URL:** `/api/influencers/{id}`
    - **Método:** `DELETE`
    - **Headers:** `Authorization: Bearer {token}`

### Campanhas

- **Criar Campanha**
    - **URL:** `/api/campaigns`
    - **Método:** `POST`
    - **Headers:** `Authorization: Bearer {token}`
    - **Body:**
        ```json
        {
            "name": "New Campaign",
            "budget": 5000,
            "description": "This is a test campaign",
            "start_date": "2025-02-15",
            "end_date": "2025-03-15",
            "influencer_ids": [1, 2, 3]
        }
        ```

- **Listar Campanhas**
    - **URL:** `/api/campaigns`
    - **Método:** `GET`
    - **Headers:** `Authorization: Bearer {token}`

- **Mostrar Campanha**
    - **URL:** `/api/campaigns/{id}`
    - **Método:** `GET`
    - **Headers:** `Authorization: Bearer {token}`

- **Atualizar Campanha**
    - **URL:** `/api/campaigns/{id}`
    - **Método:** `PUT`
    - **Headers:** `Authorization: Bearer {token}`
    - **Body:**
        ```json
        {
            "name": "Updated Campaign",
            "budget": 10000,
            "description": "This is an updated test campaign",
            "start_date": "2025-02-15",
            "end_date": "2025-03-15"
        }
        ```

- **Deletar Campanha**
    - **URL:** `/api/campaigns/{id}`
    - **Método:** `DELETE`
    - **Headers:** `Authorization: Bearer {token}`
