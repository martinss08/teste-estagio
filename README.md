# 📝 To-do List Laravel
![Home](./resources/img/img-teste2.png)


Este projeto é uma aplicação de gerenciamento de tarefas desenvolvida com Laravel (frontend via Blade), com ambiente configurado via Docker.

---
## Funcionalidades
- CRUD de Usuario
- CRUD de Tarefa
#### Funcionalidades bônus
- Barra de pesquisa, para localizar tarefas
- Nivel de permissão
    - Apenas o usuarios tem acesso a sua tarefas
    - Lixeira para restaurar tarefas excluidas
    - Uso da autenticação para proteção das rotas
#### Uso do Framework 
- **Relacionamentos:**
- **Validations [FormRequest]**
- **Migrations**
- **Seeders**
- **Soft delete:** tarefas excluídas são removidas logicamente e podem ser restauradas

## 🚀 Como rodar o projeto localmente

### 1. Clone o repositório

```bash
git clone https://github.com/martinss08/teste-estagio.git
cd teste-estagio
```

### 2. Instale as dependências do Laravel

```bash
make build 
```

## 3. Acesse o projeto

Para acessar o projeto, acesse [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 👤 Usuário padrão (seeded)

Após rodar o proejto, você poderá acessar com:

- **Email:** `admin@example.com`  
- **Senha:** `123456`

---

## 🐞 Comandos úteis

| Ação                          | Comando                                                  |
|-------------------------------|----------------------------------------------------------|
| Subir containers              | `make up`                                                |
| Parar containers              | `make down`                                              |

---

## 💡 Estrutura

- `app/` –  Lógica de negócio (Laravel)
- `resources/js/` – Scripts JS (Bootstrap ou outros)
- `routes/` – Arquivos de rotas (web.php, console.php, etc.)
- `docker/` – Arquivos de configuração dos containers (caso existam)

---

## 📦 Tecnologias

- Laravel 10+
- Bootstrap 5
- Docker / Docker Compose
- MySQL 

---
