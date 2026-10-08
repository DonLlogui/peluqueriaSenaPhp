CREATE DATABASE IF NOT EXISTS barberia CHARACTER SET utf8mb4;
USE barberia;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','cliente') DEFAULT 'cliente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE barberos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    especialidad VARCHAR(100),
    activo TINYINT(1) DEFAULT 1
);

CREATE TABLE servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    duracion_min INT NOT NULL
);

CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    barbero_id INT NOT NULL,
    servicio_id INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    estado ENUM('pendiente','confirmada','cancelada','completada') DEFAULT 'pendiente',
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (barbero_id) REFERENCES barberos(id),
    FOREIGN KEY (servicio_id) REFERENCES servicios(id)
);

-- Datos iniciales
INSERT INTO usuarios (nombre,email,password,rol) VALUES
('Admin','admin@barberia.com','$2y$10$e0NRbQ7y1xZKzE8vKqZ0xeOqZ0xeOqZ0xeOqZ0xeOqZ0xeOqZ0xeO','admin');
-- (usa password_hash() para generar el hash real)

INSERT INTO barberos (nombre, especialidad) VALUES
('Carlos','Cortes clásicos'),
('Luis','Barba y degradados');

INSERT INTO servicios (nombre, descripcion, precio, duracion_min) VALUES
('Corte clásico','Corte tradicional con tijera',15000,30),
('Degradado','Fade moderno',20000,45),
('Arreglo de barba','Perfilado y aceite',10000,20),
('Corte + Barba','Combo completo',25000,60);