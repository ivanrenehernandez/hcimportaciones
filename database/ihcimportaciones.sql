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
    `image_url` VARCHAR(191),
    `fecha_registro` DATE DEFAULT NULL,
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
    `estado` INT(1) UNSIGNED DEFAULT 0,
    PRIMARY KEY `pk_carrito`(`id`)
) ENGINE = InnoDB;

CREATE TABLE `carrito_existencia` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `carrito_id` INT(5) UNSIGNED NOT NULL,
    `existencia_id` INT UNSIGNED NOT NULL,
    `cantidad` INT UNSIGNED,
    PRIMARY KEY `pk_carrito_existencia` (`id`)
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
    CONSTRAINT FK_PRODUCTO_EXISTENCIAS FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
ADD
    CONSTRAINT UNIQUE_EXISTENCIAS UNIQUE (`bodega_id`, `producto_id`);

ALTER TABLE
    `carrito`
ADD
    CONSTRAINT FK_CLIENTE_CARRITO FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);

ALTER TABLE
    `carrito_existencia`
ADD
    CONSTRAINT FK_CARRITO_CARRITO_EXISTENCIA FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`),
ADD
    CONSTRAINT FK_EXISTENCIA_CARRITO_EXISTENCIA FOREIGN KEY (`existencia_id`) REFERENCES `existencias` (`id`);

ALTER TABLE
    `ventas`
ADD
    CONSTRAINT FK_VENDEDOR_VENTA FOREIGN KEY (`vendedor_id`) REFERENCES `vendedor` (`id`),
ADD
    CONSTRAINT FK_CARRITO_VENTA FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`),
ADD
    CONSTRAINT UC_VENTAS UNIQUE (`vendedor_id`, `carrito_id`);

INSERT INTO
    `administrador`(`id`, `email`, `password`)
VALUES
    (1, 'admin@gmail.com', '2222');

INSERT INTO
    `categoria`(`id`, `nombre`)
VALUES
    (1, 'Sudadera'),
    (2, 'Camiseta'),
    (3, 'Relojes'),
    (4, 'Lentes'),
    (5, 'Pulseras'),
    (6, 'Zapatos');

INSERT INTO
    `calidad`(`id`, `nombre`)
VALUES
    (1, 'AAA'),
    (2, 'AA');

INSERT INTO
    `bodega`(`id`, `nombre`)
VALUES
    (1, 'Bodega A'),
    (2, 'Bodega B');

INSERT INTO
    `producto`(
        `categoria_id`,
        `calidad_id`,
        `titulo`,
        `descripcion`,
        `precio`,
        `image_url`
    )
VALUES
    (
        1,
        1,
        'Sudadera Flash',
        'Increible Sudadera de Flash del Arrowverse',
        65000,
        'https://e7.pngegg.com/pngimages/496/682/png-clipart-flash-baris-alenas-t-shirt-hoodie-wonder-woman-flash-tshirt-comics.png'
    ),
    (
        1,
        1,
        'Sudadera Flecha Verde',
        'Increible Sudadera de Flecha Verde del Arrowverse',
        55000,
        'https://ih1.redbubble.net/image.978160815.1549/ssrco,lightweight_hoodie,mens,101010:01c5ca27c6,front,square_product,x600-bg,f8f8f8.2.jpg'
    ),
    (
        1,
        1,
        'Sudadera Superman',
        'Increible Sudadera de Superman de Smallville',
        85000,
        'https://i.pinimg.com/originals/05/a7/05/05a70582a8fbea2f6db1cedc19e00378.jpg'
    );

INSERT INTO
    `vendedor` (
        `nombres`,
        `apellidos`,
        `documento`,
        `celular`,
        `email`,
        `password`,
        `fecha_nacimiento`
    )
VALUES
    (
        "September",
        "Santana",
        "1090900541",
        "3105639245",
        "fermentum.vel.mauris@auctor.net",
        1474,
        "1954-03-12"
    ),
    (
        "Whoopi",
        "Hahn",
        "1090380111",
        "3117807306",
        "laoreet.ipsum@necleoMorbi.edu",
        1709,
        "1959-03-26"
    ),
    (
        "Mark",
        "Davis",
        "1090818486",
        "3178006653",
        "Integer@luctusvulputate.co.uk",
        1229,
        "1958-03-24"
    ),
    (
        "Charles",
        "Brewer",
        "1090187678",
        "3009806092",
        "in.hendrerit@fermentumvelmauris.org",
        1915,
        "1984-08-11"
    ),
    (
        "Reed",
        "Fox",
        "1090755073",
        "3153625460",
        "In.nec@nasceturridiculus.ca",
        1180,
        "1965-03-07"
    ),
    (
        "Kasimir",
        "Perry",
        "1090017443",
        "3015135913",
        "quam@eratEtiam.edu",
        1939,
        "1948-06-14"
    ),
    (
        "Abbot",
        "Joyner",
        "1090885863",
        "3001700513",
        "Duis@vehiculaet.co.uk",
        1111,
        "1989-05-14"
    ),
    (
        "Xandra",
        "Newton",
        "1090785807",
        "3123708948",
        "imperdiet@arcu.co.uk",
        1357,
        "1990-05-31"
    ),
    (
        "Maite",
        "Acevedo",
        "1090985442",
        "3154605179",
        "mi.eleifend.egestas@ultriciesligulaNullam.co.uk",
        1904,
        "1961-06-18"
    ),
    (
        "Plato",
        "English",
        "1090545593",
        "3012550133",
        "lobortis@ipsum.com",
        1235,
        "1993-11-14"
    );

INSERT INTO
    `cliente` (
        `nombres`,
        `apellidos`,
        `documento`,
        `celular`,
        `email`,
        `password`,
        `fecha_nacimiento`
    )
VALUES
    (
        "Ronan",
        "Osborn",
        "1090532726",
        "3171010898",
        "lobortis.mauris@eleifend.edu",
        1862,
        "1964-11-10"
    ),
    (
        "Lunea",
        "Reynolds",
        "1090273644",
        "3119343932",
        "Fusce@malesuadavelconvallis.edu",
        1452,
        "1962-06-29"
    ),
    (
        "Fiona",
        "Howell",
        "1090906153",
        "3114005718",
        "lorem.luctus.ut@laoreetposuere.org",
        1346,
        "1955-12-21"
    ),
    (
        "Daryl",
        "Olson",
        "1090669223",
        "3157243592",
        "Sed.eu@massaSuspendisseeleifend.net",
        1297,
        "1982-09-11"
    ),
    (
        "Doris",
        "Collier",
        "1090091522",
        "3147795480",
        "massa.Suspendisse@arcu.co.uk",
        1434,
        "1956-05-25"
    ),
    (
        "Beau",
        "Kelley",
        "1090856289",
        "3154330259",
        "eget@Proinultrices.co.uk",
        1470,
        "1981-06-07"
    ),
    (
        "Hedwig",
        "Greer",
        "1090218849",
        "3009173606",
        "Morbi.metus@condimentumDonec.edu",
        1975,
        "1998-03-18"
    ),
    (
        "Brenna",
        "Finley",
        "1090142828",
        "3006576674",
        "Duis.dignissim.tempor@malesuadafamesac.edu",
        1559,
        "1988-09-22"
    ),
    (
        "Marvin",
        "Melton",
        "1090446273",
        "3105886160",
        "at.nisi.Cum@at.edu",
        1712,
        "1940-03-04"
    ),
    (
        "Carlos",
        "Ramos",
        "1090753424",
        "3013894526",
        "nunc.interdum.feugiat@urna.net",
        1228,
        "1995-11-23"
    ),
    (
        "Wang",
        "Mcmillan",
        "1090666833",
        "3011864583",
        "bibendum@disparturient.com",
        1458,
        "1954-03-13"
    ),
    (
        "Darius",
        "White",
        "1090013973",
        "3170317882",
        "nec.ante@Uttinciduntorci.net",
        1644,
        "1996-12-13"
    ),
    (
        "Sara",
        "Fischer",
        "1090285052",
        "3146732175",
        "Lorem.ipsum.dolor@acturpisegestas.net",
        1095,
        "1949-03-18"
    ),
    (
        "Camilla",
        "Barnett",
        "1090614343",
        "3122267166",
        "suscipit.nonummy@venenatislacus.edu",
        1745,
        "1978-11-10"
    ),
    (
        "Adele",
        "Browning",
        "1090113031",
        "3173481067",
        "nunc.sed@ultricesVivamusrhoncus.com",
        1992,
        "1944-07-25"
    ),
    (
        "Sybil",
        "Dotson",
        "1090588651",
        "3174274089",
        "pellentesque.Sed@conguea.org",
        1148,
        "1987-10-21"
    ),
    (
        "Imani",
        "Stokes",
        "1090468690",
        "3008412024",
        "nascetur.ridiculus.mus@DonecestNunc.net",
        1041,
        "1956-06-15"
    ),
    (
        "Guy",
        "David",
        "1090380986",
        "3157301256",
        "posuere.vulputate@augueutlacus.net",
        1024,
        "1999-11-19"
    ),
    (
        "Hope",
        "Morin",
        "1090230005",
        "3148070050",
        "vel@porttitorvulputateposuere.ca",
        1528,
        "1998-03-20"
    ),
    (
        "Chava",
        "Cruz",
        "1090258210",
        "3003373249",
        "velit.Aliquam@risusMorbi.org",
        1676,
        "1996-01-13"
    );