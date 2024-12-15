# Sistema de Cadastro de Fornecedores

Este projeto se trata de um sistema de cadastro de fornecedores, permitindo a busca por CNPJ ou CPF.

## Tecnologias utilizadas

* Backend: Laravel
* Frontend: Blade
* Banco de dados: MySQL

## Instalação e Documentação

O sistema utiliza a arquitetura MVC e Repository Pattern seguindo as PSR's do PHP.

A instalação foi feita utilizando Docker com PHP 8.3 e Laravel 11. Para levantar os containers rode o comando abaixo:

```bash
  docker compose up -d --build
```

Para acessar o container:

```bash
    docker compose exec -it app bash
```

Gere a chave e corra as migrations:

```bash
    php artisan key:generate
    php artisan migrate
```

Para instalar as dependências do projeto basta rodar:

```bash
    composer install
```

Utilizei a biblioteca do l5-swagger para realizar a documentação da API, basta acessar a rota /api/documentation e caso não tenha gerado a rota, basta rodar o seguinte comando:

```bash
    php artisan l5-swagger:generate
```

Para realizar os testes de endpoint utilizei o Pest PHP, e para rodá-los, basta utilizar este comando:

```bash
    php artisan test
```

Na rota "/" é possível verificar os usuários cadastrados em um paginate.

Foi criada uma factory para popular o banco, basta rodar o seeder:

```bash
    php artisan db:seed --class=SupplierSeeder
```

## Referências das tecnologias usadas

 - [Laravel](https://laravel.com/docs/10.x)
 - [MySQL](https://www.mysql.com/)
 - [Swagger](https://swagger.io/)
 - [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger)
 - [PHP](https://www.php.net/)
 - [Pest](https://pestphp.com/docs/plugins#laravel)
 - [PHPUnit](https://phpunit.de/)
