-- ===== TABLA DE USUARIOS =====
CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  usuario VARCHAR(50) UNIQUE NOT NULL,
  contrasena VARCHAR(255) NOT NULL,
  rol ENUM('admin', 'usuario') DEFAULT 'usuario',
  estado ENUM('activo', 'inactivo') DEFAULT 'activo',
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ===== TABLA DE NOTICIAS =====
CREATE TABLE IF NOT EXISTS noticias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  contenido LONGTEXT NOT NULL,
  autor_id INT NOT NULL,
  imagen VARCHAR(255),
  estado ENUM('publicado', 'borrador', 'cancelado') DEFAULT 'borrador',
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  fecha_publicacion DATETIME NULL,
  FOREIGN KEY (autor_id) REFERENCES usuarios(id) ON DELETE CASCADE,
  INDEX idx_estado (estado),
  INDEX idx_fecha (fecha_creacion)
);

-- ===== TABLA DE POSICIONES =====
CREATE TABLE IF NOT EXISTS tabla_posiciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  posicion INT NOT NULL UNIQUE,
  equipo VARCHAR(100) NOT NULL,
  partidos_jugados INT DEFAULT 0,
  partidos_ganados INT DEFAULT 0,
  partidos_empatados INT DEFAULT 0,
  partidos_perdidos INT DEFAULT 0,
  goles_favor INT DEFAULT 0,
  goles_contra INT DEFAULT 0,
  diferencia_goles INT GENERATED ALWAYS AS (goles_favor - goles_contra) STORED,
  puntos INT GENERATED ALWAYS AS ((partidos_ganados * 3) + partidos_empatados) STORED,
  estado ENUM('activo', 'inactivo') DEFAULT 'activo',
  fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_posicion (posicion),
  INDEX idx_estado (estado)
);

-- ===== INSERTAR USUARIO ADMINISTRADOR POR DEFECTO =====
-- Usuario: admin
-- Contraseña: admin123
INSERT INTO usuarios (nombre, email, usuario, contrasena, rol, estado) 
VALUES (
  'Administrador',
  'admin@clubbolivar.com',
  'admin',
  '$2y$10$E8VwQJ2V/sM3h0Vz/ZlVGOy6F6Y6F6Y6F6Y6F6Y6F6Y6F6Y6F6Y6',
  'admin',
  'activo'
) ON DUPLICATE KEY UPDATE id=id;

-- ===== INSERTAR DATOS DE EJEMPLO PARA TABLA DE POSICIONES =====
INSERT INTO tabla_posiciones (posicion, equipo, partidos_jugados, partidos_ganados, partidos_empatados, partidos_perdidos, goles_favor, goles_contra, estado) VALUES
(1, 'Club Bolívar', 10, 8, 0, 2, 22, 7, 'activo'),
(2, 'Equipo 2', 10, 6, 0, 4, 16, 8, 'activo'),
(3, 'Equipo 3', 10, 5, 0, 5, 14, 12, 'activo'),
(4, 'Equipo 4', 10, 4, 2, 4, 13, 12, 'activo'),
(5, 'Equipo 5', 10, 3, 3, 4, 11, 14, 'activo');

-- ===== INSERTAR NOTICIA DE EJEMPLO =====
INSERT INTO noticias (titulo, contenido, autor_id, imagen, estado, fecha_publicacion) VALUES
(
  'Bienvenido a Club Bolívar',
  'Esta es una noticia de bienvenida al nuevo sistema de gestión de Club Bolívar. Aquí podrás ver todas las noticias importantes del club.',
  1,
  'principal.png',
  'publicado',
  NOW()
);