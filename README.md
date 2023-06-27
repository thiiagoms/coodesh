<div align="center">
  <a href="https://github.com/thiiagoms/coodesh">
      <img src="./assets/img/rocket.png" alt="Logo" width="80" height="80">
  </a>
  <h3>Desafio coodesh :brazil::rocket: </h3>
  <p float="left">
    <img
      src="https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white"
      alt="Laravel"
    />
 <img
      src="https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white"
      alt="MySQL"
    />
  </p>
</div>

- [Dependências :heavy_plus_sign:](#dependências)
- [Instalação :package:](#instalação)
- [Uso :runner:](#uso)
- [Bonus :medal_sports:](#bonus)

## Dependências
- PHP8.2
- Composer
- MySQL

## Instalação

01 -) Clone:
```bash
$ git clone https://github.com/thiiagoms/coodesh
```

02 -) Navegue até o diretório da aplicação:
```bash
$ cd coodesh
coodesh $
```

03 -) Instale as dependências do projeto utilizando o `composer`
```bash
coodesh $ composer install
```

## Uso

01 -) Faca uma copia do arquivo `.env.example` para `.env` e gere a chave secreta com o `artisan`
```bash
coodesh $ cp .env.example .env
coodesh $ php artisan key:generate
```

02 -) Execute o servidor:
```bash
coodesh $ php artisan serve
```
