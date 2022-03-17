-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-03-2022 a las 21:24:10
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_guguelmaps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gincana`
--

CREATE TABLE `tbl_gincana` (
  `id_gincana` int(11) NOT NULL,
  `nombre_gincana` varchar(100) NOT NULL,
  `pista1_gincana` varchar(200) NOT NULL,
  `id_punto1_fk` int(11) NOT NULL,
  `pista2_gincana` varchar(200) NOT NULL,
  `id_punto2_fk` int(11) NOT NULL,
  `pista3_gincana` varchar(200) NOT NULL,
  `id_punto3_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_gincana`
--

INSERT INTO `tbl_gincana` (`id_gincana`, `nombre_gincana`, `pista1_gincana`, `id_punto1_fk`, `pista2_gincana`, `id_punto2_fk`, `pista3_gincana`, `id_punto3_fk`) VALUES
(1, 'Ruta del Bacalao', 'No te lleva a Francia', 16, 'Se hace choco pero del que engorda', 4, 'Hay un mamut dentro', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_grupo`
--

CREATE TABLE `tbl_grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_grupo`
--

INSERT INTO `tbl_grupo` (`id_grupo`, `nombre_grupo`) VALUES
(1, 'God'),
(2, 'Noob');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_lugar`
--

CREATE TABLE `tbl_lugar` (
  `id_lugar` int(11) NOT NULL,
  `nombre_lugar` varchar(50) NOT NULL,
  `coordenadas_lugar` varchar(200) DEFAULT NULL,
  `direccion_lugar` varchar(200) NOT NULL,
  `telf_lugar` varchar(9) DEFAULT NULL,
  `descripcion_lugar` varchar(300) DEFAULT NULL,
  `foto_lugar` varchar(200) DEFAULT NULL,
  `id_tipo_fk` int(11) NOT NULL,
  `id_tag_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_lugar`
--

INSERT INTO `tbl_lugar` (`id_lugar`, `nombre_lugar`, `coordenadas_lugar`, `direccion_lugar`, `telf_lugar`, `descripcion_lugar`, `foto_lugar`, `id_tipo_fk`, `id_tag_fk`) VALUES
(1, 'Restaurant Petra', '41.38390263173808, 2.181783655164913', 'Carrer dels Sombrerers, 13, 08003 Barcelona', '933199999', 'Platos catalanes tradicionales y de temporada en un restaurante pintoresco, con azulejos llamativos y vidrieras.', 'mKn4tJ7V3rjWJt03P9hHkszOIEMPSKNnFOP3Nnay.jpg', 1, 1),
(2, 'Mescladís del Pou', '41.38708152338786, 2.1803348757929433', 'C/ dels Carders, 35, 08003 Barcelona', '933198732', 'Platos sostenibles elaborados por los miembros de un programa de formación culinaria y servidos en un bar moderno y artístico.', 'mescladispou.png', 1, 1),
(3, 'Restaurante La Estrella', '41.38377920824461, 2.1850558011125725', 'Carrer d\'Ocata, 6, 08003 Barcelona', '933102768', 'Restaurante refinado de larga trayectoria, que ofrece alta cocina catalana elaborada con productos frescos locales y de temporada.', 'laestrella.png', 1, 1),
(4, 'Museo del Chocolate', '41.387362598724735, 2.181701106014877', 'Carrer del Comerç, 36, 08003 Barcelona', '932687878', 'Museo con obras de arte famosas elaboradas con chocolate, además de talleres para niños y adultos.', 'chocolate.png', 2, 1),
(5, 'Museu Picasso de Barcelona', '41.385171551786605, 2.1808147393527633', 'Carrer de Montcada, 15-23, 08003 Barcelona', '932563000', 'Mansión medieval que alberga una amplia colección de piezas y obras maestras del pintor cubista español.', 'picasso.png', 2, 1),
(6, 'Museo Etnológico y de Culturas del Mundo', '41.38506277199984, 2.180867341937956', 'Carrer de Montcada, 12, 14, 08003 Barcelona', '932562300', 'Museo etnológico y cultural, con exposiciones de objetos de humanos de África, Asia y otras regiones.', 'etnologico.png', 2, 1),
(7, 'Grand Hotel Central Barcelona', '41.38496758137014, 2.1777651668826183', 'Grand Hotel Central Barcelona, Via Laietana, 30, 08003 Barcelona', '932957900', NULL, 'grandhotel.png', 3, 1),
(8, 'K+K Hotel Picasso', '41.38671668093708, 2.1838765987334914', 'K+K Hotel Picasso, Passeig de Picasso, 26, 30, 08003 Barcelona', '935478600', NULL, 'khotel.png', 3, 1),
(9, 'Hotel Motel One Barcelona', '41.39004382047747, 2.184520289337863', 'Hotel Motel One Barcelona-Ciutadella, Passeig de Pujades, 11-13, 08018 Barcelona', '936261900', NULL, 'hotelmotel.png', 3, 1),
(10, 'CaixaBank', '41.386268157624094, 2.181708294411619', 'Carrer de la Princesa, 44, 08003 Barcelona', '932298770', NULL, 'caixa.png', 4, 1),
(11, 'Banc Sabadell', '41.38672078398207, 2.180261666622703', 'C/ dels Carders, 24, 08003 Barcelona', '933150561', NULL, 'sabadell.png', 4, 1),
(12, 'Banco Santander', '41.38609846404299, 2.1771575170084625', 'Av. de Francesc Cambó, 15, 08003 Barcelona', '933100802', NULL, 'santander.png', 4, 1),
(13, 'Farmàcia', '41.3917071397534, 2.180302370593196', 'Pg. de Sant Joan, 2, 08010 Barcelona', '932314605', NULL, 'farmacia.png', 5, 1),
(14, 'Farmàcia Fonoll', '41.38779081222274, 2.178106634261473', '08003, C/ de Sant Pere Més Baix, 52, 08003 Barcelona', '933190329', NULL, 'farmacia.png', 5, 1),
(15, 'Farmacia Sombrerers', '41.38402500155821, 2.181849662062854', 'Carrer dels Sombrerers, 19, 08003 Barcelona', '933103460', NULL, 'farmacia.png', 5, 1),
(16, 'Estació de França', '41.3848027799097, 2.1853700234520264', 'Av. del Marquès de l\'Argentera, s/n, 08003 Barcelona', NULL, NULL, 'estacionfrancia.png', 6, 1),
(17, 'L1 Arc de Triomf', '41.392001092863644, 2.181220581376575', 'Estació d\'Arc de Triomf, Barcelona', NULL, NULL, 'l1.png', 6, 1),
(18, 'L4 Urquinaona', '41.38875538942069, 2.1728957766424215', 'Urquinaona, 08010 Barcelona', NULL, NULL, 'l4.png', 6, 1),
(19, 'Arco de Triunfo de Barcelona', '41.39112215841537, 2.180668039178895', 'Arco de Triunfo de Barcelona, Passeig de Lluís Companys, 08003 Barcelona', '932853834', 'Arco clásico construido como entrada principal a la Exposición Universal que se celebró en la ciudad en 1888.', 'arcotriunfo.png', 7, 1),
(20, 'Parque de la Ciudadela', '41.38826788704287, 2.1868735066661986', 'Parque de la Ciudadela, Passeig de Picasso, 21, 08003 Barcelona', '638237115', 'Parque creado a finales del siglo XIX con zoo, lago con barcas, museos ornamentados y senderos frondosos.', 'ciutadella.png', 7, 1),
(21, 'Palau de la Música Catalana', '41.38755910128415, 2.1752484268421157', 'Palau de la Música Catalana, C/ Palau de la Música, 4-6, 08003 Barcelona', '932957200', 'Sala de conciertos modernista famosa por su elaborada fachada y por su opulento auditorio con claraboya.', 'palaumusica.png', 7, 1),
(35, 'gfngf', 'ghngfh', 'ghfnhgfnf', '666666666', 'gjghjgf', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rol`
--

CREATE TABLE `tbl_rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_rol`
--

INSERT INTO `tbl_rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tags`
--

CREATE TABLE `tbl_tags` (
  `id_tag` int(11) NOT NULL,
  `nombre_tag` varchar(20) NOT NULL,
  `icono_tag` varchar(200) NOT NULL,
  `ubicaciones_tag` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_tags`
--

INSERT INTO `tbl_tags` (`id_tag`, `nombre_tag`, `icono_tag`, `ubicaciones_tag`) VALUES
(1, 'Bonito', 'fad fa-grin-hearts', NULL),
(2, 'Tranquilo', 'fad fa-volume-slash', NULL),
(3, 'Barato', 'fad fa-coin', NULL),
(4, 'Lujoso', 'fad fa-gem', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tags_usuario`
--

CREATE TABLE `tbl_tags_usuario` (
  `nombre_tag_usuario` varchar(50) NOT NULL,
  `ubicacion_tag_usuario` varchar(200) DEFAULT NULL,
  `id_usu_tag_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_tags_usuario`
--

INSERT INTO `tbl_tags_usuario` (`nombre_tag_usuario`, `ubicacion_tag_usuario`, `id_usu_tag_usuario`) VALUES
('Favoritos', NULL, 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo`
--

CREATE TABLE `tbl_tipo` (
  `id_tipo` int(11) NOT NULL,
  `nombre_tipo` varchar(50) NOT NULL,
  `icono_tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_tipo`
--

INSERT INTO `tbl_tipo` (`id_tipo`, `nombre_tipo`, `icono_tipo`) VALUES
(1, 'Restaurantes', 'fad fa-utensils'),
(2, 'Museos', 'fad fa-palette'),
(3, 'Hoteles', 'fad fa-h-square'),
(4, 'Banco', 'fad fa-money-check-alt'),
(5, 'Farmacias', 'fad fa-first-aid'),
(6, 'Transporte publico', 'fad fa-subway'),
(7, 'Lugares de interes', 'fad fa-map-marked-alt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `contra_usuario` varchar(45) NOT NULL,
  `telf_usuario` varchar(9) NOT NULL,
  `foto_usuario` varchar(200) DEFAULT NULL,
  `json_usuario` varchar(255) DEFAULT NULL,
  `id_rol_fk` int(11) NOT NULL,
  `id_grupo_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `nombre_usuario`, `email_usuario`, `contra_usuario`, `telf_usuario`, `foto_usuario`, `json_usuario`, `id_rol_fk`, `id_grupo_fk`) VALUES
(1, 'Diaz', 'marc.diaz@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '111111111', 'KBEg4bMhvAqDJRVKXXgIaUH5fJt8hXBLiSYFtxYB.jpg', NULL, 1, NULL),
(2, 'Ortiz', 'marc.ortiz@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '222222222', 'L6vPBgCk8ikUPKx0e7oq500FmP8934uvzO2lSNw6.png', NULL, 1, NULL),
(3, 'Isaac', 'isaac.ortiz@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '333333333', 'UhBzDkETUtoIZiOKcnFJI0jJPSHSJzDfJTPA7aQA.jpg', NULL, 1, NULL),
(4, 'Sergio', 'sergio@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '444444444', 'ewEZ6K8vzJ2Kt4eeZ5M5p7lZEjVJjBnK7CiUqtGO.jpg', NULL, 2, 2),
(5, 'Danny', 'danny@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '555555555', 'kCibRA0DhF9AS4xQC006OurWjCnvlpOhagR8zt0c.jpg', NULL, 2, 2),
(6, 'Agnes', 'agnes@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '666666666', '1suTr0wlX22T6VFUpFh9fuNiyVt2c0Tr8Sn7pyaz.jpg', NULL, 2, NULL),
(53, 'admin', 'admin@admin.com', '81dc9bdb52d04dc20036dbd8313ed055', '656789876', 'L7x5oSambpGkt26jTTj6fYdOdWpWkol6wvtBSfrr.jpg', 'admin656789876.json', 1, NULL),
(55, 'cliente', 'cliente@cliente.com', '81dc9bdb52d04dc20036dbd8313ed055', '654345678', 'XQP8hLzFYG9Tbw61bBTV5bN5SXHW7lEvohwfXGUq.jpg', 'cliente654345678.json', 2, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_gincana`
--
ALTER TABLE `tbl_gincana`
  ADD PRIMARY KEY (`id_gincana`),
  ADD KEY `id_punto1_fk` (`id_punto1_fk`),
  ADD KEY `id_punto2_fk` (`id_punto2_fk`),
  ADD KEY `id_punto3_fk` (`id_punto3_fk`) USING BTREE;

--
-- Indices de la tabla `tbl_grupo`
--
ALTER TABLE `tbl_grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `tbl_lugar`
--
ALTER TABLE `tbl_lugar`
  ADD PRIMARY KEY (`id_lugar`),
  ADD KEY `tbl_lugar_id_tipo_fk_idx` (`id_tipo_fk`),
  ADD KEY `tbl_lugar_id_tag_fk_idx` (`id_tag_fk`);

--
-- Indices de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tbl_tags`
--
ALTER TABLE `tbl_tags`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indices de la tabla `tbl_tags_usuario`
--
ALTER TABLE `tbl_tags_usuario`
  ADD PRIMARY KEY (`nombre_tag_usuario`),
  ADD KEY `id_usu_tag_usuario` (`id_usu_tag_usuario`);

--
-- Indices de la tabla `tbl_tipo`
--
ALTER TABLE `tbl_tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `tbl_usuario_id_rol_fk_idx` (`id_rol_fk`),
  ADD KEY `tbl_usuario_id_grupo_fk_idx` (`id_grupo_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_gincana`
--
ALTER TABLE `tbl_gincana`
  MODIFY `id_gincana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_grupo`
--
ALTER TABLE `tbl_grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_lugar`
--
ALTER TABLE `tbl_lugar`
  MODIFY `id_lugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tags`
--
ALTER TABLE `tbl_tags`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo`
--
ALTER TABLE `tbl_tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_gincana`
--
ALTER TABLE `tbl_gincana`
  ADD CONSTRAINT `tbl_gincana_ibfk_1` FOREIGN KEY (`id_punto1_fk`) REFERENCES `tbl_lugar` (`id_lugar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_gincana_ibfk_2` FOREIGN KEY (`id_punto2_fk`) REFERENCES `tbl_lugar` (`id_lugar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_gincana_ibfk_3` FOREIGN KEY (`id_punto3_fk`) REFERENCES `tbl_lugar` (`id_lugar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_lugar`
--
ALTER TABLE `tbl_lugar`
  ADD CONSTRAINT `tbl_lugar_id_tag_fk` FOREIGN KEY (`id_tag_fk`) REFERENCES `tbl_tags` (`id_tag`),
  ADD CONSTRAINT `tbl_lugar_id_tipo_fk` FOREIGN KEY (`id_tipo_fk`) REFERENCES `tbl_tipo` (`id_tipo`);

--
-- Filtros para la tabla `tbl_tags_usuario`
--
ALTER TABLE `tbl_tags_usuario`
  ADD CONSTRAINT `tbl_tags_usuario_ibfk_1` FOREIGN KEY (`id_usu_tag_usuario`) REFERENCES `tbl_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `tbl_usuario_id_grupo_fk` FOREIGN KEY (`id_grupo_fk`) REFERENCES `tbl_grupo` (`id_grupo`),
  ADD CONSTRAINT `tbl_usuario_id_rol_fk` FOREIGN KEY (`id_rol_fk`) REFERENCES `tbl_rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
