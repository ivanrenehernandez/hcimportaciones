-- Crear todas las tablas
CREATE TABLE `bodega` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(50) NOT NULL,
    PRIMARY KEY `pk_bodega`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `categoria` (
    `id` INT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
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
    `cantidad` INT UNSIGNED,
    `nombre` VARCHAR(50) NOT NULL,
    PRIMARY KEY `pk_existencias`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `producto` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `categoria_id` INT(1) UNSIGNED NOT NULL,
    `calidad_id` INT(1) UNSIGNED NOT NULL,
    `titulo` VARCHAR(50) NOT NULL,
    `descripcion` TEXT DEFAULT NULL,
    `precio` INT NOT NULL,
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
    `id` INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombres` VARCHAR(50),
    `apellidos` VARCHAR(50) NOT NULL,
    `documento` VARCHAR(20) NOT NULL,
    `celular` VARCHAR(25) NOT NULL,
    `email` VARCHAR(50),
    `password` VARCHAR(50) NOT NULL,
    `fecha_nacimiento` DATE NULL,
    PRIMARY KEY `pk_cliente`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `vendedor` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nombres` VARCHAR(50) NOT NULL,
    `apellidos` VARCHAR(50) NOT NULL,
    `documento` VARCHAR(20) NOT NULL,
    `celular` VARCHAR(25) NOT NULL,
    `email` VARCHAR(50),
    `password` VARCHAR(50) NOT NULL,
    `fecha_nacimiento` DATE NOT NULL,
    PRIMARY KEY `pk_vendedor`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `carrito` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `cliente_id` INT(5) UNSIGNED NOT NULL,
    `existencia_id` INT UNSIGNED NOT NULL,
    `cantidad` INT UNSIGNED,
    PRIMARY KEY `pk_carrito`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `ventas` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `vendedor_id` INT(5) UNSIGNED NOT NULL,
    `carrito_id` INT UNSIGNED NOT NULL,
    `approved_at` DATE DEFAULT NULL,
    PRIMARY KEY `pk_ventas` (`id`)
) ENGINE = InnoDB;

ALTER TABLE
    `categoria`
ADD
    CONSTRAINT UC_CATEGORIA UNIQUE (`nombre`);

ALTER TABLE
    `calidad`
ADD
    CONSTRAINT UC_CALIDAD UNIQUE (`nombre`);

ALTER TABLE
    `administrador`
ADD
    CONSTRAINT UC_ADMINISTRADOR UNIQUE (`email`);

ALTER TABLE
    `cliente`
ADD
    CONSTRAINT UC_CLIENTE UNIQUE (`documento`, `email`);

ALTER TABLE
    `vendedor`
ADD
    CONSTRAINT UC_CLIENTE UNIQUE (`documento`, `email`);

ALTER TABLE
    `producto`
ADD
    CONSTRAINT FK_CATEGORIA_PRODUCTO FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
ADD
    CONSTRAINT FK_CALIDAD_PRODUCTO FOREIGN KEY (`calidad_id`) REFERENCES `calidad` (`id`),
ADD
    CONSTRAINT UC_PRODUCTO UNIQUE (`categoria_id`, `calidad_id`, `titulo`);

ALTER TABLE
    `existencias`
ADD
    CONSTRAINT FK_BODEGA_EXISTENCIAS FOREIGN KEY (`bodega_id`) REFERENCES `bodega` (`id`),
ADD
    CONSTRAINT FK_PRODUCTO_EXISTENCIAS FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

ALTER TABLE
    `carrito`
ADD
    CONSTRAINT FK_CLIENTE_CARRITO FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
ADD
    CONSTRAINT FK_EXISTENCIA_CARRITO FOREIGN KEY (`existencia_id`) REFERENCES `existencias` (`id`),
ADD
    CONSTRAINT UC_CARRITO UNIQUE (`cliente_id`, `existencia_id`);

ALTER TABLE
    `ventas`
ADD
    CONSTRAINT FK_VENDEDOR_VENTA FOREIGN KEY (`vendedor_id`) REFERENCES `vendedor` (`id`),
ADD
    CONSTRAINT FK_CARRITO_VENTA FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`),
ADD
    CONSTRAINT UC_VENTAS UNIQUE (`vendedor_id`, `carrito_id`);