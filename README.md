# Leader Inventory


O **Leader Inventory** é uma aplicação desenvolvida em **PHP**  que tem como objetivo fazer o gerenciamento de um inventário.

## Linguagens utilizadas

- PHP 8.1.12
- HTML 5
- CSS 3
- MySQL

## Frameworks
- Laravel 8

## Controle de Versão
para controlar as versões de código do  projeto que serão atualizadas constantemente durante o desenvolvimento, usaremos o git
- [Como instalar o git em diferentes SOS](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

## Ferramentas para executar o projeto

Para executar o projeto, será necessário instalar os seguintes programas:
- [Laragon: Usado para iniciar o servidor web e fazer o gerenciamento do banco de dados (PHP embutido, MySQL  e Composer)](https://laragon.org/download/index.html)
- [Visual Studio Code: Para desenvolvimento do projeto (ou editor de sua preferência)](https://code.visualstudio.com/download)
Ou a ferramenta de sua prefrência

## Instalação do projeto

Para iniciar o desenvolvimento, é necessário clonar o projeto do GitHub num diretório de sua preferência:
```shell
Caso esteja usando o laragon entre em cd "C:\laragon\www "  e abra o cmd ou terminal nesta pasta e cole o comando a seguir  
git clone https://github.com/KSouzaEng/leader-inventory.git

Caso esteja usando o xampp entre em cd "C:\xampp\htdocs"  e abra o cmd ou terminal nesta pasta e cole o comando a seguir
git clone https://github.com/KSouzaEng/leader-inventory.git

Ou cole em sua pasta de preferência
```

## Configurando a aplicação 

Antes de rodar a aplicação é necessário executar os seguintes commandos.

Instala dependências do Laravel
```shell
composer install
```
Copia o arquivo para fazer a conexão com a base de dados
```shell
cp .env.example .env
```

Gera uma chave aleatório com 32 caracteres para manter os dados da aplicação protegidos
```shell
php artisan key:generate
```
Abra o arquivo .env e inclua nele o nome de sua base de dados. Procure pela linha DB_DATABASE
```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nodedobanco
DB_USERNAME=root
DB_PASSWORD=
```
- OBS : Caso não estiver usando as configurações padrões do Mysql é necesário informar qual gerenciador está usando, o host, a porta, o usuário e a senha


Para gerar as tabelas do banco de dados é necessário executar o comando a seguir
```shell
php artisan migrate
```

Para compilar os arquivos JavaScript embutidos no framework Laravel
```shell
php artisan serve
```

Lista de comandos básicos laravel

**Banco de dados:**

[Documentação comandos base de dados](https://laravel.com/docs/9.x/migrations#main-content)


```
php artisan migrate - migra as tabelas pra base de dados
```
```
php artisan migrate:fresh - remove todas as tabelas do banco e logo após faz a migração
```
```
php artisan migrate --seed  - roda as migrações e os arquivos de seed
```
```
php artisan migrate:refresh   - Este comando recria efetivamente todo o seu banco de dados.
```
**Comandos pra criar arquivos**

```
php artisan make:controller TesteController  - cria um controller dentro da pasta controllers

https://laravel.com/docs/9.x/controllers#main-content - controllers documentação
```

```
php artisan make:model Teste   - cria um modelo dentro da pasta models

https://laravel.com/docs/9.x/eloquent - models doc
```

```
php artisan make:migration create_name_table   - cria uma migration dentro de database/migrations

https://laravel.com/docs/9.x/migrations#main-content - migrations doc
```


```
php artisan make:seeder UserSeeder - cria um arquivo de seed dentro de database/seedrs

https://laravel.com/docs/9.x/seeding#main-content
```
