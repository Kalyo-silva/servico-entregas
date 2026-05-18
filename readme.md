# Serviço de Entregas

Sistema web para gerenciamento de entregas, desenvolvido com backend em PHP, frontend em HTML/CSS/JavaScript e banco de dados PostgreSQL.
A aplicação é containerizada com Docker e orquestrada com Docker Compose, permitindo execução simplificada em ambientes de desenvolvimento e testes.

---

# 📦 Descrição da Aplicação

O **Serviço de Entregas** é uma aplicação web desenvolvida para realizar o gerenciamento de entregas e pedidos de forma simples e organizada.

A aplicação permite:

* Cadastro de entregas;
* Listagem de entregas cadastradas;
* Atualização de status das entregas;
* Persistência dos dados em banco PostgreSQL;
* Comunicação entre frontend, backend e banco de dados via containers Docker;
* Execução completa através do Docker Compose.

---

# 🚀 Tecnologias Utilizadas

## Backend

* PHP 8
* Apache
* PDO PostgreSQL

## Frontend

* HTML5
* CSS3
* JavaScript

## Banco de Dados

* PostgreSQL

## Containerização

* Docker
* Docker Compose

## Versionamento

* Git
* GitHub

---

# 🏗️ Arquitetura Utilizada

A aplicação segue uma arquitetura baseada em containers:

```text
Frontend (HTML/CSS/JS)
        ↓
Backend PHP (API)
        ↓
PostgreSQL
```

Estrutura dos containers:

```text
┌────────────────────┐
│   Frontend Web     │
│ HTML/CSS/JS        │
└─────────┬──────────┘
          │ HTTP
          ▼
┌────────────────────┐
│   Backend PHP      │
│ API REST           │
└─────────┬──────────┘
          │ SQL
          ▼
┌────────────────────┐
│   PostgreSQL       │
│ Banco de Dados     │
└────────────────────┘
```

---

# 📁 Estrutura do Projeto

```text
projeto/
├── app/
│   ├── backend/
│   │   └── Dockerfile
│   └── frontend/
│       └── Dockerfile
├── docker-compose.yml
├── README.md
└── evidencias/
```

---

# ⚙️ Pré-requisitos

Antes de iniciar o projeto, é necessário possuir instalado:

* Docker
* Docker-Compose
* Git

---

# 🔧 Clonando o Repositório

```bash
git clone https://github.com/Kalyo-silva/servico-entregas.git
```

```bash
cd servico-entregas
```

---

# ▶️ Instruções Completas de Execução

## 1. Iniciar a aplicação
Execute o terminal como administrador para evitar erros.

```bash
docker-compose up -d
```

---

## 2. Verificar containers em execução

```bash
docker ps
```

---

## 3. Acessar a aplicação

Frontend:

```text
http://localhost:3000
```

Backend/API:

```text
http://localhost:8000
```

---

# 🐳 Instruções do Docker Compose

## Subir containers
Execute o terminal como administrador para evitar erros.

```bash
docker-compose up -d
```

---

## Parar containers

```bash
docker-compose down
```

---

# 🗄️ Banco de Dados PostgreSQL

## Acessar container PostgreSQL

```bash
docker exec -it postgres bash
```

---

## Entrar no banco

```bash
psql -U postgres -d delivery_db
```
---

## Consultar no banco os dados

```SQL
select * from deliveries;
```
---

# 🔌 Portas Utilizadas

| Serviço           | Porta |
| ----------------- | ----- |
| Backend           | 8000  |
| Frontend          | 3000  |
| PostgreSQL        | 5433  |

---

# 🌎 Variáveis de Ambiente - adicionado no docker-compose.yml

```env
    POSTGRES_USER: postgres
    POSTGRES_PASSWORD: postgres
    POSTGRES_DB: delivery_db
```

---

# 📄 Exemplo docker-compose.yml

```yaml
version: '3.9'

services:

  postgres:
    image: postgres:16
    container_name: delivery_postgres
    restart: always
    environment:
      POSTGRES_USER: postgres
      POSTGRES_PASSWORD: postgres
      POSTGRES_DB: delivery_db
    ports:
      - "5433:5432"
    volumes:
      - postgres_data:/var/lib/postgresql/data
      - ./app/backend/init.sql:/docker-entrypoint-initdb.d/init.sql

  backend:
    image: kalyo/backend-servico-entregas:v1
    container_name: delivery_backend
    restart: always
    ports:
      - "8000:80"
    depends_on:
      - postgres

  frontend:
    image: kalyo/frontend-servico-entregas:v1
    container_name: delivery_frontend
    restart: always
    ports:
      - "3000:80"
    depends_on:
      - backend

volumes:
  postgres_data:
```

# 👨‍💻 Autor

Projeto desenvolvido por Kalyo Silva.
