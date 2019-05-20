DROP DATABASE IF EXISTS tp_final;

CREATE DATABASE tp_final;

USE tp_final;

CREATE TABLE `localidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(255) NOT NULL,
  `provincia` int(11) NOT NULL,
  CONSTRAINT `provincia_fk` FOREIGN KEY (`provincia`) REFERENCES `provincia` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `mas_info_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `documento` bigint(20) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `provincia` int(11) NOT NULL,
  `localidad` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `direccionNumero` bigint(20) NOT NULL,
  `direccionPiso` varchar(10) DEFAULT NULL,
  CONSTRAINT `localidad_fk` FOREIGN KEY (`localidad`) REFERENCES `localidad` (`id`),
  CONSTRAINT `provincia_user_fk` FOREIGN KEY (`provincia`) REFERENCES `provincia` (`id`),
  CONSTRAINT `usuario_fk` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bloqueado` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `product` (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idUser int NOT NULL,
  title varchar(255) NOT NULL,
  image varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  subDescription varchar(255),
  price varchar(20) NOT NULL,
  create_date date NOT NULL,
  CONSTRAINT fk_product_user FOREIGN KEY (idUser) REFERENCES usuario(id)
);

CREATE TABLE `category` (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255)
);

CREATE TABLE `category_product` (
  idCategory int NOT NULL,
  idProduct int NOT NULL,
  CONSTRAINT pk_category_product PRIMARY KEY (idCategory, idProduct),
  CONSTRAINT fk_category_id FOREIGN KEY (idCategory) REFERENCES category(id),
  CONSTRAINT fk_product_id FOREIGN KEY (idProduct) REFERENCES product(id)
);

INSERT INTO product (idUser, title, image, description, subDescription, price, create_date) values
(20, 'Producto 1', 'adasd.png', 'description', 'subDescription', '200', '20190519'),
(20, 'Producto 2', 'adasd.png', 'description', 'subDescription', '300', '20190519'),
(20, 'Producto 3', 'adasd.png', 'description', 'subDescription', '400', '20190519'),
(20, 'Producto 4', 'adasd.png', 'description', 'subDescription', '500', '20190519');

INSERT INTO category (name) VALUES
('Vehiculos'),
('Alimentos y Bebidas'),
('Animales y Mascotas'),
('Antigüedad'),
('Arte'),
('Artesania'),
('Auto'),
('Moto'),
('Otros'),
('Bebé'),
('Belleza'),
('Cuidado Personal'),
('Cámara'),
('Accesorio'),
('Telefono'),
('Celular'),
('Computacion'),
('Coleccionable'),
('Hobbie'),
('Consola'),
('Videojuego'),
('Electrodomestico'),
('Aire Acondicionado'),
('Electrónica'),
('Audio'),
('Video'),
('Cable'),
('Drone'),
('TV'),
('Hogar'),
('Mueble'),
('Jardin'),
('Oficina'),
('Inmueble'),
('Instrumento Musical'),
('Joyas'),
('Reloj'),
('Peluche'),
('Ropa'),
('Camperas'),
('Pantalon'),
('Sueter'),
('Camisa'),
('Musculosa'),
('Remera'),
('Short'),
('Calza'),
('Zapatilla'),
('Zapato'),
('Zandalia'),
('Ojota'),
('Pirotecnia'),
('Adulto');
