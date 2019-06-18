CREATE TABLE sale (
  id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  idUser int(11) NOT NULL,
  date_sale datetime,
  amount varchar(55) NOT NULL,
  type_pay varchar(55) NOT NULL,
  CONSTRAINT fk_sale FOREIGN KEY (idUser) REFERENCES usuario(id)
)

CREATE TABLE products_sale (
  idSale int(11) NOT NULL,
  idProduct int(11) NOT NULL,
  cant int(11),
  PRIMARY KEY (idSale, idProduct),
  CONSTRAINT fk_sale_product_id FOREIGN KEY (idProduct) REFERENCES product(id),
  CONSTRAINT fk_product_sale_id FOREIGN KEY (idSale) REFERENCES sale(id)
)
