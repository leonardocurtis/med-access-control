# 🔐 Med Access Control

![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)
![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql)
![License](https://img.shields.io/badge/License-MIT-258a60?style=for-the-badge)

**Med Access Control** é uma aplicação web administrativa desenvolvida com **Laravel 12** para o gerenciamento centralizado de usuários e controle de acesso baseado em perfis e permissões.

O sistema contempla dois perfis distintos: **administrador**, responsável pela gestão de usuários e permissões, e **colaborador**, cujo acesso é restrito aos módulos operacionais autorizados individualmente.

---

## 🚀 Funcionalidades

### 🔑 Autenticação
- Login com e-mail e senha
- Sessões seguras via middleware de autenticação
- Redirecionamento automático conforme perfil do usuário

### 👤 Gerenciamento de Usuários
- CRUD completo de usuários
- Atribuição de perfil (administrador ou colaborador)
- Atribuição granular de permissões por usuário
- Proteção contra auto-exclusão de conta

### 🛡️ Gerenciamento de Permissões
- CRUD de permissões disponíveis no sistema
- Validação de uso antes da exclusão
- Listagem com contagem de usuários vinculados

### 🏥 Módulos Operacionais
- Setores Hospitalares
- Especialidades Médicas
- Equipamentos
- Unidades Assistenciais

---

## 🔐 Controle de Acesso

- Controle de acesso aplicado **no nível da rota**, via middleware
- Acesso bloqueado mesmo em tentativa de acesso direto por URL
- Menus exibidos dinamicamente conforme permissões do usuário autenticado
- Página de erro 403 customizada para acessos não autorizados
- Separação clara entre controle por **role** (administrador) e por **permission** (módulos de colaborador)

---

## 🧠 Regras de Negócio

- Apenas **administradores** podem gerenciar usuários e permissões
- **Colaboradores** acessam exclusivamente os módulos para os quais foram autorizados
- Um colaborador sem nenhuma permissão atribuída não acessa nenhum módulo
- Administrador não pode excluir a própria conta
---

## 🛠️ Tech Stack

- PHP 8.2+
- Laravel 12
- Laravel Breeze (scaffolding de autenticação)
- Spatie Laravel Permission (RBAC)
- Blade (motor de templates)
- Tailwind CSS
- Laravel Pint (formatação de código)
- MySQL 8

---

## 📁 Estrutura do Projeto

```text
app/
├── Http/
│   └── Controllers/
│       ├── DashboardController     # Redirecionamento pós-login por perfil
│       ├── UserController          # CRUD de usuários com atribuição de roles/permissions
│       ├── PermissionController    # CRUD de permissões
│       └── ModuleController        # Módulos operacionais protegidos por permission
├── Models/
│   ├── Permission                  # Model com descrição personalizada
│   └── User                        # Model com trait HasRoles (Spatie)
database/
├── migrations/                     # Estrutura das tabelas (incluindo tabelas da Spatie)
└── seeders/
    ├── RoleAndPermissionSeeder     # Criação de roles e permissions iniciais
    ├── AdminUserSeeder             # Usuário administrador padrão
    ├── CollaboratorUserSeeder      # Usuário colaborador padrão
    └── DatabaseSeeder              # Orquestrador dos seeders
resources/
└── views/
    ├── users/                      # Views de listagem, criação e edição de usuários
    ├── permissions/                # Views de listagem, criação e edição de permissões
    ├── modules/                    # Uma view por módulo operacional
    ├── errors/
    │   └── 403.blade.php           # Página de acesso negado
    └── layouts/
routes/
└── web.php                         # Rotas com middleware role: e permission: por grupo
```

---

## 🔗 Modelo de Domínio

- Um usuário possui exatamente **uma role** (admin ou collaborator)
- Um colaborador pode ter **nenhuma ou várias permissions** de módulo
- Administradores **não possuem permissions de módulo**  o controle é feito pela role
- As permissions são atribuídas individualmente, permitindo controle granular por usuário

---

## 🧩 Decisões Técnicas

**Spatie Laravel Permission**
Adotado no lugar de uma implementação manual de pivot table. É o padrão da indústria para RBAC em Laravel, possui integração nativa com Eloquent, middleware de rota pronto (`role:`, `permission:`), cache automático e manutenção ativa.

**Controle de acesso na rota, não na view**
O bloqueio de acesso é aplicado via middleware diretamente nas rotas, garantindo que a restrição funcione mesmo em tentativas de acesso direto por URL, independentemente do que é exibido na interface.

**Separação entre role e permission**
O perfil `admin` é controlado por *role* ele não precisa de permissions individuais. O acesso dos colaboradores aos módulos é controlado por *permissions*, permitindo combinações granulares sem alterar a estrutura de perfis.

**Laravel Breeze**
Utilizado para o scaffolding de autenticação. Gera as rotas, views e middleware de login/logout com Tailwind CSS, sem o overhead do Jetstream, mantendo o projeto simples e extensível.

**Idempotência nos Seeders**
Todos os seeders utilizam `firstOrCreate()`, garantindo que possam ser executados múltiplas vezes sem duplicação de dados — importante para ambientes de desenvolvimento e CI.

---

## ⚙️ Configuração (.env)

O projeto utiliza variáveis de ambiente via arquivo `.env`.
Você deve fornecer suas próprias credenciais de banco de dados.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=SEU_BD
DB_USERNAME=SEU_USUÁRIO
DB_PASSWORD=SUA_SENHA
```

---

## ▶️ Executando o Projeto

### Pré-requisitos

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8+

### Clonar o repositório

```bash
https://github.com/leonardocurtis/med-access-control.git
```

### Instalar dependências

```bash
composer install
npm install
npm run build
```

### Configurar ambiente

```bash
cp .env.example .env
php artisan key:generate
```

Configure as credenciais do banco de dados no arquivo `.env`.

### Criar o banco de dados

```sql
CREATE DATABASE SEU_BD;
```

### Executar as migrations

```bash
php artisan migrate
```

### Executar os seeders

```bash
php artisan db:seed
```

---

## 🔑 Credenciais Padrão

| Perfil        | E-mail                     | Senha    |
|---------------|----------------------------|----------|
| Administrador | admin@medaccess.com        | 12345@medaccess |
| Colaborador   | collaborator@medaccess.com | 12345@medaccess |

---

## 📈 Aprendizados

Este projeto reforça conceitos importantes de desenvolvimento web com PHP e Laravel, incluindo:

- Autenticação com Laravel Breeze e middleware de sessão
- Role-Based Access Control (RBAC) com Spatie Laravel Permission
- Controle de acesso por middleware em grupos de rotas
- CRUD completo com validações, mensagens flash e Route Model Binding
- Relacionamentos Eloquent com eager loading para evitar o problema N+1
- Seeders idempotentes com `firstOrCreate()`
- Boas práticas de arquitetura MVC no ecossistema Laravel
- Formatação de código com Laravel Pint

---

## 📄 Licença

Este projeto está licenciado sob a **MIT License**.

---

## 👨‍💻 Autor

Desenvolvido por **Leonardo Curtis**.
Focado em desenvolvimento back-end, arquitetura limpa e aprendizado contínuo.
