# Laravel Docker Project

## Resumo do Projeto

Este projeto é uma aplicação Laravel configurada para rodar em contêineres Docker. Ele inclui funcionalidades para gerenciar usuários, influenciadores e campanhas, com autenticação JWT.

## Tecnologias Utilizadas

- PHP 8.1
- Laravel 10
- MySQL 5.7
- Nginx
- Docker
- JWT Auth

## Passos para Clonar o Repositório

1. Clone o repositório:
    ```sh
    git clone https://github.com/seu-usuario/laravel-docker.git
    cd laravel-docker
    ```
    ```

## Passos para Rodar o Docker e inicializar o Projeto

1. Construa e inicie os contêineres Docker:
    ```sh
    docker-compose up --build
    ```



## Importar a Collection no Postman




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
