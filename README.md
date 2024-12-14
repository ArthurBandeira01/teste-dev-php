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

## Referências das tecnologias usadas

 - [Laravel](https://laravel.com/docs/10.x)
 - [MySQL](https://www.mysql.com/)
 - [Swagger](https://swagger.io/)
 - [PHP](https://www.php.net/)
 - [PHPUnit](https://phpunit.de/)
