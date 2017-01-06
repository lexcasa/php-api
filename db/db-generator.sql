-- dev. @droman
-- SINGLE TABLE GENERATOR 

DROP TABLE IF EXISTS usuarios;


CREATE TABLE usuarios(
	id INT AUTO_INCREMENT PRIMARY KEY,
	fechaCreado DATETIME,
	fechaActualizado DATETIME,
	nombre VARCHAR(50),
	email VARCHAR(50),
	password VARCHAR(300),
	tipo VARCHAR(20),
	borrado TINYINT(1)
);