# Cutter


O **Cutter** é uma aplicação desenvolvida em **PHP** e **JavaScript** que tem como objetivo reduzir o tamanho de urls muito grandes.

## Linguagens utilizadas

- PHP 7.4.19
- HTML 5
- CSS 3
- MySQL
- JavaScript

## Frameworks
- Laravel 8
- Vuejs 3

## Ferramentas para executar o projeto

Para executar o projeto, será necessário instalar os seguintes programas:
- [Laragon: Usado para iniciar o servidor web e fazer o gerenciamento do banco de dados (PHP embutido, MySQL  e Composer)](https://laragon.org/download/index.html)
- [Visual Studio Code: Para desenvolvimento do projeto (ou editor de sua preferência)](https://code.visualstudio.com/download)
Ou a ferramenta de sua prefrência

## Instalação do projeto

Para iniciar o desenvolvimento, é necessário clonar o projeto do GitHub num diretório de sua preferência:
```shell
Caso esteja usando o laragon entre em cd "C:\laragon\www "  e abra o cmd ou terminal nesta pasta e cole o comando a seguir  
git clone https://github.com/KSouzaEng/ShortenerUrl.git

Caso esteja usando o laragon entre em cd "C:\xampp\htdocs"  e abra o cmd ou terminal nesta pasta e cole o comando a seguir
git clone https://github.com/KSouzaEng/ShortenerUrl.git

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
Permite Intalar e atualizar as dependências da palicação
```shell
npm install
```
Permite usar variáveis de ambiente
```shell
npm install cross-env
```
Permite usar variáveis de ambiente
```shell
npm install 
```
Para os alertas da aplicação
```shell
npm install sweetalert2
```
Para compilar os arquivos JavaScript embutidos no framework Laravel
```shell
npm run dev
```

Para compilar os arquivos JavaScript embutidos no framework Laravel
```shell
php artisan serve
```

## Melhorias

- Como melhoria do projeto seria interessante implementar os testes unitários, pois é necessário que a aplicação fique o mais funcional possível e com uma quantidade pequena de erros.
-  Melhorar a interface que não está funcional, pois me preocupei muito com a implementação da funcionalidade principal.
-  Utualização de tabela após salvar os dados

