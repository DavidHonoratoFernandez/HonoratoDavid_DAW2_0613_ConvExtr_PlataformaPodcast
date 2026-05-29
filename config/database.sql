CREATE DATABASE IF NOT EXISTS db_podcast;

USE db_podcast;

CREATE TABLE users (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(10) DEFAULT 'client' NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
) ENGINE=InnoDB;

CREATE TABLE tbl_podcast (
    id_podcast INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    creador VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    portada VARCHAR(255) NOT NULL,
    PRIMARY KEY(id_podcast)
) ENGINE=InnoDB;

CREATE TABLE tbl_episodio (
    id_episodio INT NOT NULL AUTO_INCREMENT,
    fk_id_podcast INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    duracion TIME NOT NULL, 
    fecha_pub DATE NOT NULL,
    archivo_audio VARCHAR(255) NOT NULL,
    PRIMARY KEY(id_episodio)
) ENGINE=InnoDB;

CREATE TABLE tbl_suscripcion (
    fk_id_user BIGINT UNSIGNED NOT NULL,
    fk_id_podcast INT NOT NULL,
    fecha_suscripcion DATE NOT NULL,
    PRIMARY KEY (fk_id_user, fk_id_podcast)
) ENGINE=InnoDB;

CREATE TABLE tbl_lista (
    id_lista INT NOT NULL AUTO_INCREMENT,
    fk_id_user BIGINT UNSIGNED NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    privacidad VARCHAR(10) NOT NULL,
    PRIMARY KEY(id_lista)
) ENGINE=InnoDB;

CREATE TABLE tbl_lista_episodio (
    fk_id_lista INT NOT NULL,
    fk_id_episodio INT NOT NULL,
    PRIMARY KEY(fk_id_lista, fk_id_episodio)
) ENGINE=InnoDB;


ALTER TABLE tbl_episodio
ADD CONSTRAINT fk_episodio_podcast FOREIGN KEY (fk_id_podcast)
REFERENCES tbl_podcast(id_podcast) ON DELETE CASCADE;

ALTER TABLE tbl_suscripcion
ADD CONSTRAINT fk_suscripcion_user FOREIGN KEY (fk_id_user)
REFERENCES users(id) ON DELETE CASCADE;

ALTER TABLE tbl_suscripcion
ADD CONSTRAINT fk_suscripcion_podcast FOREIGN KEY (fk_id_podcast)
REFERENCES tbl_podcast(id_podcast) ON DELETE CASCADE;

ALTER TABLE tbl_lista
ADD CONSTRAINT fk_lista_user FOREIGN KEY (fk_id_user)
REFERENCES users(id) ON DELETE CASCADE;

ALTER TABLE tbl_lista_episodio
ADD CONSTRAINT fk_lista_ep_lista FOREIGN KEY (fk_id_lista)
REFERENCES tbl_lista(id_lista) ON DELETE CASCADE;

ALTER TABLE tbl_lista_episodio
ADD CONSTRAINT fk_lista_ep_episodio FOREIGN KEY (fk_id_episodio)
REFERENCES tbl_episodio(id_episodio) ON DELETE CASCADE;