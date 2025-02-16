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

## Importar a Collection no Insomnia

Para importar a collection no Insomnia, siga os passos abaixo:

1. Abra o Insomnia.
2. Clique em `Import/Export` no canto superior direito.
3. Selecione `Import Data` e depois `From Clipboard`.
4. Cole o JSON abaixo e clique em `Import`.

```json
{
  "workspace": {
    "name": "Campaign API",
    "description": "",
    "scope": "collection"
  },
  "requests": [
    {
      "_id": "req_1",
      "name": "Create Campaign",
      "url": "http://localhost:8000/api/campaigns",
      "method": "POST",
      "headers": [
        {
          "name": "Authorization",
          "value": "Bearer {{token}}"
        },
        {
          "name": "Content-Type",
          "value": "application/json"
        }
      ],
      "body": {
        "mimeType": "application/json",
        "text": "{\n  \"name\": \"New Campaign\",\n  \"budget\": 5000,\n  \"description\": \"This is a test campaign\",\n  \"start_date\": \"2025-02-15\",\n  \"end_date\": \"2025-03-15\",\n  \"influencer_ids\": [1, 2, 3]\n}"
      }
    },
    {
      "_id": "req_2",
      "name": "List Campaigns",
      "url": "http://localhost:8000/api/campaigns",
      "method": "GET",
      "headers": [
        {
          "name": "Authorization",
          "value": "Bearer {{token}}"
        }
      ]
    },
    {
      "_id": "req_3",
      "name": "Show Campaign",
      "url": "http://localhost:8000/api/campaigns/{{campaign_id}}",
      "method": "GET",
      "headers": [
        {
          "name": "Authorization",
          "value": "Bearer {{token}}"
        }
      ]
    },
    {
      "_id": "req_4",
      "name": "Update Campaign",
      "url": "http://localhost:8000/api/campaigns/{{campaign_id}}",
      "method": "PUT",
      "headers": [
        {
          "name": "Authorization",
          "value": "Bearer {{token}}"
        },
        {
          "name": "Content-Type",
          "value": "application/json"
        }
      ],
      "body": {
        "mimeType": "application/json",
        "text": "{\n  \"name\": \"Updated Campaign\",\n  \"budget\": 10000,\n  \"description\": \"This is an updated test campaign\",\n  \"start_date\": \"2025-02-15\",\n  \"end_date\": \"2025-03-15\"\n}"
      }
    },
    {
      "_id": "req_5",
      "name": "Delete Campaign",
      "url": "http://localhost:8000/api/campaigns/{{campaign_id}}",
      "method": "DELETE",
      "headers": [
        {
          "name": "Authorization",
          "value": "Bearer {{token}}"
        }
      ]
    }
  ],
  "_type": "export"
}