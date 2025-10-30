-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bdtruechange
CREATE DATABASE IF NOT EXISTS `bdtruechange` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bdtruechange`;

-- Volcando estructura para tabla bdtruechange.cambio
CREATE TABLE IF NOT EXISTS `cambio` (
  `id_cambio` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_producto` int(11) DEFAULT NULL,
  `id_otro_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cambio`),
  KEY `FK_cambio_usuario` (`id_usuario_producto`),
  KEY `FK_cambio_usuario_2` (`id_otro_usuario`),
  CONSTRAINT `FK_cambio_usuario` FOREIGN KEY (`id_usuario_producto`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cambio_usuario_2` FOREIGN KEY (`id_otro_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bdtruechange.direccion
CREATE TABLE IF NOT EXISTS `direccion` (
  `id_direccion` int(11) NOT NULL AUTO_INCREMENT,
  `calle` varchar(50) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `piso` int(11) DEFAULT NULL,
  `mano` varchar(50) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `codigo_postal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_direccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bdtruechange.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `fotografia` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bdtruechange.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `primerApellido` varchar(100) DEFAULT NULL,
  `segundoApellido` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_valoracion` int(11) DEFAULT NULL,
  `id_cambio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_direccion` (`id_direccion`),
  KEY `FK_usuario_producto` (`id_producto`),
  KEY `FK_usuario_valoracion` (`id_valoracion`),
  KEY `FK_usuario_cambio` (`id_cambio`),
  CONSTRAINT `FK_usuario_cambio` FOREIGN KEY (`id_cambio`) REFERENCES `cambio` (`id_cambio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuario_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_usuario_valoracion` FOREIGN KEY (`id_valoracion`) REFERENCES `valoracion` (`valoracion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_direccion` FOREIGN KEY (`id_direccion`) REFERENCES `direccion` (`id_direccion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla bdtruechange.valoracion
CREATE TABLE IF NOT EXISTS `valoracion` (
  `valoracion` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`valoracion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
