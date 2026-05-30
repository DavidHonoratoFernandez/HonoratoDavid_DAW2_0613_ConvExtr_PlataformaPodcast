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




-- 1. Insertar Canales de Podcast (Catálogo principal)
INSERT INTO tbl_podcast (titulo, creador, descripcion, categoria, portada) VALUES
('Crímenes Imperfectos', 'Carlos Ríos', 'Análisis detallado de los casos policiales más extraños y sin resolver de la última década.', 'True Crime', 'default.png'),
('Tech sin Filtros', 'Ana Gómez', 'Repaso semanal al mundo de la tecnología, inteligencia artificial y desarrollo web.', 'Tecnología', 'default.png'),
('Risas en Lata', 'Dani Mateo', 'Monólogos, entrevistas y mucho humor para desconectar de la rutina diaria.', 'Humor', 'default.png'),
('Historia Oculta', 'Laura Salas', 'Descubre los pasajes de la historia que no te contaron en el colegio.', 'Historia', 'default.png'),
('Mente Sana', 'Dra. Elena Ruiz', 'Consejos, psicología y meditación para afrontar el estrés del día a día.', 'Salud y Bienestar', 'default.png');

-- 2. Insertar Episodios 
-- (Asumiendo que los IDs generados arriba serán 1, 2, 3, 4 y 5)
-- Nota: Si tu tabla de episodios tiene nombres de columnas ligeramente distintos, ajústalos.
INSERT INTO tbl_episodio (fk_id_podcast, titulo, duracion, fecha_pub, archivo_audio) VALUES
-- Episodios para "Crímenes Imperfectos" (ID 1)
(1, 'El misterio del faro', '00:45:00', '2023-10-01', 'audio_test.mp3'),
(1, 'El robo al banco central', '00:52:00', '2023-10-08', 'audio_test.mp3'),

-- Episodios para "Tech sin Filtros" (ID 2)
(2, '¿Nos quitará la IA el trabajo?', '01:10:00', '2023-10-05', 'audio_test.mp3'),
(2, 'Novedades de PHP 8.3', '00:35:00', '2023-10-12', 'audio_test.mp3'),
(2, 'El fin de las cookies', '00:48:00', '2023-10-19', 'audio_test.mp3'),

-- Episodios para "Risas en Lata" (ID 3)
(3, 'Entrevista a Berto Romero', '01:05:00', '2023-09-20', 'audio_test.mp3'),

-- Episodios para "Historia Oculta" (ID 4)
(4, 'Los secretos de las Pirámides', '00:58:00', '2023-09-25', 'audio_test.mp3'),

-- Episodios para "Mente Sana" (ID 5)
(5, 'Aprender a decir NO', '00:30:00', '2023-10-22', 'audio_test.mp3');