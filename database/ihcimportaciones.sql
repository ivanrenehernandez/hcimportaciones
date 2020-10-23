-- Crear todas las tablas
CREATE TABLE `bodega` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) NOT NULL,
    PRIMARY KEY `pk_bodega`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `categoria` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) NOT NULL,
    PRIMARY KEY `pk_categoria`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `calidad` (
    `id` INT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) NOT NULL,
    PRIMARY KEY `pk_calidad`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `existencias` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `bodega_id` INT(1) UNSIGNED NOT NULL,
    `producto_id` INT(1) UNSIGNED NOT NULL,
    'cantidad' INT UNSIGNED DEFAULT 0,
    `nombre` VARCHAR(50) NOT NULL,
    PRIMARY KEY `pk_existencias`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `producto` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `categoria_id` INT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
    `calidad_id` INT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
    `titulo` VARCHAR(50) NOT NULL,
    `descripcion` VARCHAR(50) NOT NULL,
    `precio` VARCHAR(20) NOT NULL,
    `fecha_registro` DATE NOT NULL,
    PRIMARY KEY `pk_producto`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `administrador` (
    `id` INT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(50),
    `password` VARCHAR(50) NOT NULL,
    PRIMARY KEY `pk_usuario`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `cliente` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombres` VARCHAR(50),
    `apellidos` VARCHAR(50) NOT NULL,
    `documento` VARCHAR(20) NOT NULL,
    `fecha_nacimiento` DATE NULL,
    PRIMARY KEY `pk_cliente`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `vendedor` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombres` VARCHAR(50) NOT NULL,
    `apellidos` VARCHAR(50) NOT NULL,
    `documento` VARCHAR(20) NOT NULL,
    `fecha_nacimiento` DATE NOT NULL,
    PRIMARY KEY `pk_vendedor`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `carrito` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `cliente_id` INT UNSIGNED NOT NULL,
    'existencia_id' INT UNSIGNED NOT NULL,
    `nombres` VARCHAR(50) NOT NULL,
    `apellidos` VARCHAR(50) NOT NULL,
    `documento` VARCHAR(20) NOT NULL,
    `fecha_nacimiento` DATE NOT NULL,
    PRIMARY KEY `pk_vendedor`(`id`)
) ENGINE = InnoDB;