-- Base de datos del sistema de inventario
CREATE DATABASE IF NOT EXISTS `inventario_dev` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `inventario_dev`;

-- Tabla productos (si ya existe, se reemplaza)
DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `idproducto` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `producto`   VARCHAR(100) NOT NULL,
  `categoria`  VARCHAR(100) NOT NULL,
  `precio`     DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `stock`      INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Datos de ejemplo
INSERT INTO `productos` (`producto`, `categoria`, `precio`, `stock`) VALUES
('cocass', 'refre',   115.00, 45),
('huevo',  'lactosa',  54.60, 12);
