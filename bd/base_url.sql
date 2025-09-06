create database urls; 
use  urls;

create table url(
	id_url int not null auto_increment,
    url_larga text not null,
    url_hash varchar(255) not null,
    url_corta varchar(255) not null,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_url primary key (id_url)
);

ALTER TABLE url
ADD expiracion int not null;

ALTER TABLE url 
ADD fecha_expiracion DATETIME

/*Trigger para la fecha de expiracion*/
DELIMITER $$

CREATE TRIGGER trg_url_before_insert
BEFORE INSERT ON url
FOR EACH ROW
BEGIN
    IF NEW.expiracion IS NOT NULL THEN
        SET NEW.fecha_expiracion = DATE_ADD(NEW.fecha_registro, INTERVAL NEW.expiracion DAY);
    END IF;
END$$

DELIMITER ;
