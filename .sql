CREATE TABLE libros (
    libro_id SERIAL PRIMARY KEY,
    libro_titulo VARCHAR(255) NOT NULL,
    libro_autor VARCHAR(255) NOT NULL,
    libro_situacion INT DEFAULT 1 NOT NULL
);

CREATE TABLE personas (
    persona_id SERIAL PRIMARY KEY,
    persona_nombre VARCHAR(100) NOT NULL,
    persona_apellidos VARCHAR(100) NOT NULL,
    persona_situacion INT DEFAULT 1 NOT NULL
);

CREATE TABLE prestamos (
    prestamo_id SERIAL PRIMARY KEY,
    libro_id INT NOT NULL,
    persona_nombre VARCHAR(255) NOT NULL,
    fecha_prestamo DATETIME YEAR TO MINUTE NOT NULL,
    fecha_devolucion DATETIME YEAR TO MINUTE,
    prestamo_situacion INT DEFAULT 1 NOT NULL,
    FOREIGN KEY (libro_id) REFERENCES libros(libro_id)
);


