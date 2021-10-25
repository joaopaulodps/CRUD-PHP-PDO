create database bd_pedidos;

use bd_pedidos;

create table clientes (

    Id int not null auto_increment primary key,
    NomeCliente varchar(100) not null,
    CPF char(11) not null,
    Email char(100)

);

create table pedidos (

    NumeroPedido int not null auto_increment primary key,
    DtPedido datetime not null,
    Quantidade int not null,
    IdProduto int not null,
    IdCliente int not null

);

create table produtos (

    IdProduto int not null auto_increment primary key,
    CodBarras varchar(20) not null,
    NomeProduto varchar(100),
    ValorUnitario decimal(14,2) not null

);