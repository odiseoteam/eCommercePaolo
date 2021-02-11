CREATE DATABASE paolo_ecommerce 

create table paolo_ecommerce.app_product
(
    id          int auto_increment
        primary key,
    name        varchar(100) not null,
    price       int          not null,
    imagen      varchar(100) null,
    description varchar(500) null
);



insert into paolo_ecommerce.app_product (id, name, price, imagen, description)
values  (1, 'Martillito', 10000, 'martillo.jpg', null),
        (2, 'Birra', 5500, 'cerveza.jpg', null),
        (3, 'Sledge Hammer', 99999, 'revolver.jpg', null),
        (4, 'Vinasi', 50000, 'vino.jpg', null),
        (5, 'Un Dami', 50, 'dami.jpg', null),
        (6, 'Porotos', 9500, 'porotos.jpg', null),
        (47, 'Tornillo', 3, 'tornillo.jpeg', 'Muy lindo el tornillo'),
        (48, 'Papa', 44, 'papa.jpeg', 'Las papas son lo más de lo más'),
        (49, 'Café', 15090, 'coffee.jpg', 'Flor de café. Es un viaje de ida'),
        (50, 'Hacha', 100005, 'hacha-vikinga.jpg', 'Efectiva para cortarle la cabeza a Dieguito');
