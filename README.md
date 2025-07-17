# Sistema de Admissão de Funcionários para o eSocial

Este é um sistema desenvolvido em **Laravel** para gerenciar o processo de admissão de novos funcionários, coletando de forma estruturada todas as informações necessárias para o registro no eSocial. O projeto utiliza **Livewire** para criar uma interface reativa e dinâmica, e **Docker** para garantir um ambiente de desenvolvimento padronizado e de fácil configuração.

## ✨ Funcionalidades Principais

  * **Cadastro Completo de Funcionários:** Formulário intuitivo dividido em seções para coletar dados pessoais, documentos, endereço, informações sobre estrangeiros, e mais.
  * **Gerenciamento de Dependentes:** Adicione e remova dependentes dinamicamente, com campos específicos para imposto de renda, salário-família e plano de saúde.
  * **Validação de Dados em Tempo Real:** A reatividade do Livewire, combinada com a validação do Laravel, fornece feedback instantâneo ao usuário.
  * **Consulta de CEP Automática:** Preenchimento automático de endereço ao digitar o CEP, consumindo a API do ViaCEP.
  * **Geração de PDF:** Exporte a ficha de cadastro completa do funcionário para um arquivo PDF com um único clique.
  * **Interface Responsiva:** Visual moderno e adaptável para diferentes tamanhos de tela, construído com Bootstrap 5.
  * **Ambiente Dockerizado:** Configuração completa com containers para PHP, Nginx, MySQL e Mailpit, facilitando a instalação e a execução do projeto.

-----

## 🛠️ Tecnologias Utilizadas

  * **Backend:** Laravel 12, PHP 8.3
  * **Frontend:** Livewire 3, Alpine.js, Bootstrap 5, SASS
  * **Banco de Dados:** MySQL 8.4
  * **Servidor Web:** Nginx
  * **Ambiente de Desenvolvimento:** Docker, Docker Compose
  * **Geração de PDF:** `barryvdh/laravel-dompdf`
  * **Validação de Documentos:** `geekcom/validator-docs`

-----

## 📋 Pré-requisitos

  * Docker
  * Docker Compose
  * Task (opcional, para usar os comandos do `Taskfile.yml`. Pode ser substituído por `make`).

-----

## 🚀 Instalação e Execução

**1. Clonar o Repositório**

```bash
git clone <URL_DO_SEU_REPOSITORIO>
cd admisao_cdc
```

**2. Configurar o Ambiente**

Primeiro, crie o arquivo `.env` a partir do exemplo. O Docker Compose usará as variáveis deste arquivo para configurar os containers.

```bash
cp src/.env.example src/.env
```

Se você estiver em um ambiente Linux, execute o seguinte comando para configurar corretamente as permissões de usuário e grupo:

```bash
task for-linux-env

# Ou manualmente:
# echo "UID=$(id -u)" >> .env
# echo "GID=$(id -g)" >> .env
```

**3. Subir os Containers**

Use o `Taskfile.yml` para simplificar o processo. Este comando irá construir as imagens e iniciar os containers.

```bash
task up
```

Alternativamente, use o Docker Compose diretamente:

```bash
docker-compose up -d --build
```

**4. Instalar Dependências e Configurar a Aplicação**

Com os containers em execução, execute o comando de instalação, que irá:

  * Instalar as dependências do Composer.
  * Instalar as dependências do NPM.
  * Gerar a chave da aplicação.
  * Criar o link simbólico para o `storage`.
  * Executar as migrações do banco de dados e popular com dados iniciais (`seeders`).

<!-- end list -->

```bash
task install
```

**5. Compilar os Assets de Frontend**

Execute o Vite em modo de desenvolvimento para compilar os assets (CSS e JS) e habilitar o Hot Module Replacement (HMR).

```bash
docker-compose exec app npm run dev
```

**Pronto\!** A aplicação estará disponível em seu navegador.

-----

## 🌐 Endereços Úteis

  * **Aplicação:** [http://localhost](https://www.google.com/search?q=http://localhost)
  * **Mailpit (para visualizar e-mails):** [http://localhost:8025](https://www.google.com/search?q=http://localhost:8025)
  * **phpMyAdmin (gerenciador de banco de dados):** Verifique a porta definida em `PHPMYADMIN_PUBLISHED_PORT` no `compose.yaml`.

-----

## 🔧 Comandos Úteis (via Task)

  * `task up`: Inicia os containers em background.
  * `task down`: Para os containers.
  * `task restart`: Reinicia os containers.
  * `task app`: Acessa o terminal (bash) do container `app`.
  * `task tinker`: Inicia uma sessão do Laravel Tinker.
  * `task fresh`: Executa `migrate:fresh --seed` para resetar e popular o banco de dados.
  * `task test`: Roda os testes automatizados do PHPUnit.
