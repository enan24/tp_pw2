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
  create_date datetime NOT NULL,
  CONSTRAINT fk_product_user FOREIGN KEY (idUser) REFERENCES usuario(id)
);

CREATE TABLE `category` (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255)
);

CREATE TABLE 'subcategory' (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  idCategory int NOT NULL,
  CONSTRAINT fk_category_id FOREIGN KEY (idCategory) REFERENCES category(id)
);

CREATE TABLE `sub_category_product` (
  idSubCategory int NOT NULL,
  idProduct int NOT NULL,
  CONSTRAINT pk_sub_category_product PRIMARY KEY (idSubCategory, idProduct),
  CONSTRAINT fk_sub_category_id FOREIGN KEY (idSubCategory) REFERENCES subcategory(id),
  CONSTRAINT fk_product_id FOREIGN KEY (idProduct) REFERENCES product(id)
);

INSERT INTO product (idUser, title, image, description, subDescription, price, create_date) values
(20, 'Producto 1', 'adasd.png', 'description', 'subDescription', '200', '20190519'),
(20, 'Producto 2', 'adasd.png', 'description', 'subDescription', '300', '20190519'),
(20, 'Producto 3', 'adasd.png', 'description', 'subDescription', '400', '20190519'),
(20, 'Producto 4', 'adasd.png', 'description', 'subDescription', '500', '20190519');

INSERT INTO category (name) values
('Vehiculos'),
('Inmuebles'),
('Servicios'),
('Productos y Otros');

INSERT INTO subcategory (name, idCategory) VALUES
('Autos Chocados y Averiados', 1),
('Autos de Colección', 1),
('Autos y Camionetas', 1),
('Camiones', 1),
('Colectivos', 1),
('Maquinaria Agricola', 1),
('Motorhomes', 1),
('Motos', 1),
('Náutica', 1),
('Semirremolques', 1),
('Bicicletas', 1),
('Otros vehiculos', 1),
('Campos', 2),
('Casas', 2),
('Cocheras', 2),
('Consultorios', 2),
('Departamentos', 2),
('Depósitos y Galpones', 2),
('Fondo de Comercio', 2),
('Locales', 2),
('Oficinas', 2),
('Parcelas, Nichos y Bóvedas', 2),
('Quintas', 2),
('Terrenos y Lotes', 2),
('Otros Inmuebles', 2),
('Asesoramiento Contable y Legal', 3),
('Belleza y Cuidado Personal', 3),
('Comunicación y Diseño', 3),
('Cursos y Clases', 3),
('Delivery', 3),
('Fiestas y Eventos', 3),
('Fotografia, Música y Cine', 3),
('Hogar y Construcción', 3),
('Imprenta', 3),
('Mantenimiento de Vehiculos', 3),
('Medicina y Salud', 3),
('Ropa y Moda', 3),
('Servicios para Mascotas', 3),
('Servicios para Oficinas', 3),
('Tecnologia', 3),
('Transporte', 3),
('Otros servicios', 3),
('Colegio', 4),
('Oficinas', 4),
('Hospital', 4),
('Hogar', 4),
('Mochilas', 4),
('Telefonos', 4),
('Tecnologia', 4),
('Computadoras', 4),
('Notebook', 4),
('Celulares', 4),
('Teclados', 4),
('Parlantes', 4),
('Bebidas', 4),
('Monitores', 4),
('Mouses', 4),
('Lamparas', 4),
('Veladores', 4),
('Telas', 4),
('Camisas', 4),
('Pantalones', 4),
('Shorts', 4),
('Remeras', 4),
('Musculosas', 4),
('Relojes', 4),
('Arte', 4),
('TV', 4),
('Otros', 4);
