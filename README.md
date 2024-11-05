
# Documentação de uso

1. **Clone o repositório**

    ```bash
    git clone https://github.com/ededias/primeit.git
    cd primeit
    ```


1. **Docker**

    ```bash
        // para subir as imagens do docker
        docker compose up --build -d
        // para instalar as dependencias do laravel 
        docker exec -it laravel_app composer install
        // para rodar as migrations e executar os seeders
        docker exec -it laravel_app php artisan migrate --seed
    ```

A aplicação ira rodar localhost

Utilizando a aplicação sem o docker

1. **Sem docker**
    
    ```bash
        // instalar as dependencias
        composer install
        // rodar as migrations
        php artisan migrate
    ```
    4. **Configure o arquivo `.env`**

    Edite o arquivo `.env` para configurar o banco de dados e outras variáveis. Exemplo de configuração para MySQL:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=usuario
    DB_PASSWORD=senha
    ```


# API Documentation

## Endpoint: Criar Usuário

### Método: `POST`
### ENDPOINT: `/api/register`

### Descrição
Este endpoint permite criar um novo usuário com informações básicas, incluindo nome, email, senha e função. Ele pode ser usado para registrar novos usuários no sistema.

### Parâmetros da Requisição

O corpo da requisição deve conter os seguintes parâmetros em JSON:

| Campo      | Tipo   | Obrigatório | Descrição                                    |
|------------|--------|-------------|----------------------------------------------|
| `name`     | String | Sim         | Nome do usuário.                             |
| `email`    | String | Sim         | Endereço de e-mail único do usuário.         |
| `password` | String | Sim         | Senha do usuário (mínimo de 8 caracteres).   |
| `role`     | String | Sim         | Função do usuário no sistema (ex.: `attendant, doctor, customer`). |

### Exemplo de Requisição

```http
POST /api/register
Content-Type: application/json

{
	"name": "edenilson",
	"email": "cliente1@gmail.com",
	"password": "12345678",
	"role": "attendant"
}
```

### Método: `POST`
### ENDPOINT: `/api/login`

### Descrição
Este endpoint permite autenticar um usuário no sistema com base no e-mail e senha fornecidos. Ele retorna um token de autenticação para acesso aos demais endpoints protegidos da API.

### Parâmetros da Requisição

O corpo da requisição deve conter os seguintes parâmetros em JSON:

| Campo      | Tipo   | Obrigatório | Descrição                        |
|------------|--------|-------------|----------------------------------|
| `email`    | String | Sim         | Endereço de e-mail do usuário.   |
| `password` | String | Sim         | Senha do usuário.                |

### Exemplo de Requisição

```http
POST /api/login
Content-Type: application/json

{
	"email": "edenilso1n1@gmail.com",
	"password": "12345678"
}
```

 

## Endpoint: Obter Informações do Usuário

### Método: `GET`
### URL: `/api/user`

### Descrição
Este endpoint permite obter as informações do usuário autenticado. É necessário enviar um token de autenticação no cabeçalho da requisição.

### Cabeçalhos da Requisição

| Cabeçalho         | Tipo   | Obrigatório | Descrição                       |
|-------------------|--------|-------------|---------------------------------|
| `Authorization`   | String | Sim         | Token Bearer do usuário. Exemplo: `Bearer {token}` |

### Exemplo de Requisição

```http
GET /api/user
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...

```



## Endpoint: Obter Informações de varios pacientes

### Método: `GET`
### URL: `api/patient/all`

### Descrição
Este endpoint permite obter as informações do usuário autenticado. É necessário enviar um token de autenticação no cabeçalho da requisição.

### Cabeçalhos da Requisição

| Cabeçalho         | Tipo   | Obrigatório | Descrição                       |
|-------------------|--------|-------------|---------------------------------|
| `Authorization`   | String | Sim         | Token Bearer do usuário. Exemplo: `Bearer {token}` |

### Exemplo de Requisição

```http
GET api/patient/all
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...

```


## Endpoint: Obter Informações de um paciente

### Método: `GET`
### URL: `api/patient/get/{id}`

### Descrição
Este endpoint permite obter as informações do usuário autenticado. É necessário enviar um token de autenticação no cabeçalho da requisição.

### Cabeçalhos da Requisição

| Cabeçalho         | Tipo   | Obrigatório | Descrição                       |
|-------------------|--------|-------------|---------------------------------|
| `Authorization`   | String | Sim         | Token Bearer do usuário. Exemplo: `Bearer {token}` |

### Parametros da Requisição

| Parametros         | Tipo   | Obrigatório | Descrição                       |
|-------------------|--------|-------------|---------------------------------|
| `id`   | String | Sim         | id do paciente que deseja buscar |

### Exemplo de Requisição

```http
GET api/patient/all
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...

```


## Endpoint: Obter Informações de um paciente

### Método: `GET`
### URL: `api/patient/get-doctors/`

### Descrição
Este endpoint permite obter as informações dos medicos veterinários cadastrados no sistema.

### Cabeçalhos da Requisição

| Cabeçalho         | Tipo   | Obrigatório | Descrição                       |
|-------------------|--------|-------------|---------------------------------|
| `Authorization`   | String | Sim         | Token Bearer do usuário. Exemplo: `Bearer {token}` |


### Exemplo de Requisição

```http
GET api/patient/all
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...

```

## Endpoint: Excluir uma consultat

### Método: `GET`
### URL: `api/patient/delete`

### Descrição
Este endpointt permite realizar a exclusão de uma consulta.

### Cabeçalhos da Requisição

| Cabeçalho         | Tipo   | Obrigatório | Descrição                       |
|-------------------|--------|-------------|---------------------------------|
| `Authorization`   | String | Sim         | Token Bearer do usuário. Exemplo: `Bearer {token}` |


### Exemplo de Requisição

```http
GET api/patient/delete
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...

```

# API Documentation

## Endpoint: Vincular Paciente a Médico

### Método: `POST`
### URL: `/api/patient/attendant/set-doctor`

### Descrição
Este endpoint permite vincular um paciente a um médico específico. É necessário fornecer os IDs do paciente e do médico, além de autenticar a requisição com um token Bearer no cabeçalho.

### Cabeçalhos da Requisição

| Cabeçalho         | Tipo   | Obrigatório | Descrição                                     |
|-------------------|--------|-------------|-----------------------------------------------|
| `Authorization`   | String | Sim         | Token Bearer do usuário. Exemplo: `Bearer {token}` |

### Parâmetros da Requisição

O corpo da requisição deve conter os seguintes parâmetros em JSON:

| Campo        | Tipo   | Obrigatório | Descrição                    |
|--------------|--------|-------------|------------------------------|
| `patient_id` | Inteiro | Sim         | ID do paciente.              |
| `doctor_id`  | Inteiro | Sim         | ID do médico.                |

### Exemplo de Requisição

```http
POST /api/patient/attendant/set-doctor
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
Content-Type: application/json

{
	"patient_id": 1,
	"doctor_id": 1
}
```


## Endpoint: Agendar Consulta para Paciente

### Método: `POST`
### URL: `/api/patient/create`

### Descrição
Este endpoint permite agendar uma consulta para um paciente, especificando dados como nome do dono, nome do paciente, idade, tipo, sintomas, data e período da consulta. É necessário autenticar a requisição com um token Bearer no cabeçalho.

### Cabeçalhos da Requisição

| Cabeçalho         | Tipo   | Obrigatório | Descrição                                     |
|-------------------|--------|-------------|-----------------------------------------------|
| `Authorization`   | String | Sim         | Token Bearer do usuário. Exemplo: `Bearer {token}` |

### Parâmetros da Requisição

O corpo da requisição deve conter os seguintes parâmetros em JSON:

| Campo          | Tipo   | Obrigatório | Descrição                                  |
|----------------|--------|-------------|--------------------------------------------|
| `name`         | String | Sim         | Nome do dono do paciente.                  |
| `email`        | String | Sim         | E-mail do dono do paciente.                |
| `patient_name` | String | Sim         | Nome do paciente.                          |
| `age`          | String | Sim         | Idade do paciente.                         |
| `type`         | String | Sim         | Tipo de animal (ex.: `cat`, `dog`).        |
| `symptoms`     | String | Sim         | Sintomas apresentados pelo paciente.       |
| `date`         | String | Sim         | Data e hora da consulta (formato `YYYY-MM-DD HH:MM`). |
| `reception`    | String | Sim         | Período de recepção (ex.: `manhã`, `tarde`). |

### Exemplo de Requisição

```http
POST /api/patient/create
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
Content-Type: application/json

{
	"name": "edenilson",
	"email": "edenilson@gmail.com",
	"patient_name": "bill",
	"age": "5",
	"type": "cat",
	"symptoms": "tosse",
	"date": "2024-10-30 10:00",
	"reception": "manhã"
}
```

## Endpoint: Atualizar Consulta

### Método: `PUT`
### URL: `/api/patient/attendant/update`

### Descrição
Este endpoint permite atualizar os detalhes de uma consulta existente. É necessário fornecer os dados do paciente, como nome, idade, tipo, sintomas, data, recepção e o ID do médico, além de autenticar a requisição com um token Bearer no cabeçalho.

### Cabeçalhos da Requisição

| Cabeçalho         | Tipo   | Obrigatório | Descrição                                     |
|-------------------|--------|-------------|-----------------------------------------------|
| `Authorization`   | String | Sim         | Token Bearer do usuário. Exemplo: `Bearer {token}` |

### Parâmetros da Requisição

O corpo da requisição deve conter os seguintes parâmetros em JSON:

| Campo          | Tipo    | Obrigatório | Descrição                                  |
|----------------|---------|-------------|--------------------------------------------|
| `name`         | String  | Sim         | Nome do dono do paciente.                  |
| `email`        | String  | Sim         | E-mail do dono do paciente.                |
| `patient_name` | String  | Sim         | Nome do paciente.                          |
| `age`          | String  | Sim         | Idade do paciente.                         |
| `type`         | String  | Sim         | Tipo de animal (ex.: `cat`, `dog`).        |
| `symptoms`     | String  | Sim         | Sintomas apresentados pelo paciente.       |
| `date`         | String  | Sim         | Data e hora da consulta (formato `YYYY-MM-DD HH:MM`). |
| `reception`    | String  | Sim         | Período de recepção (ex.: `manhã`, `tarde`). |
| `doctor_id`    | Inteiro | Sim         | ID do médico responsável pela consulta.    |
| `id`           | Inteiro | Sim         | ID da consulta a ser atualizada.           |

### Exemplo de Requisição

```http
PUT /api/patient/attendant/update
Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
Content-Type: application/json

{
	"name": "edenilson",
	"email": "edenilson@gmail.com",
	"patient_name": "mateus",
	"age": "5",
	"type": "cat",
	"symptoms": "tosse",
	"date": "2024-10-30 10:00",
	"reception": "manhã",
	"doctor_id": 1,
	"id": 1
}
```