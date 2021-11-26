CREATE DATABASE visitaSite;
USE visitaSite;
CREATE TABLE tb_contador(
    id_visita int AUTO_INCREMENT PRIMARY KEY,
    ip   VARCHAR(30),
    dia  VARCHAR(30),
    hora VARCHAR(30)      
    )
    DEFAULT charset utf8;