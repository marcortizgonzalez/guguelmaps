CREATE SCHEMA `db_guguelmaps`;
USE `db_guguelmaps`;

----------------------------------------------
/* Table structure for table `tbl_gincana` */
----------------------------------------------
CREATE TABLE `tbl_gincana` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_gincana` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

--------------------------------------------
/* Table structure for table `tbl_grupo` */
--------------------------------------------
CREATE TABLE `tbl_grupo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_grupo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
);

-------------------------------------------
/* Table structure for table `tbl_tipo` */
-------------------------------------------
CREATE TABLE `tbl_tipo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `tbl_tipo` (`id`,`nombre_tipo`) VALUES
(1,`Restaurantes`),
(2,`Museos`),
(3,`Hoteles`),
(4,`Banco`),
(5,`Farmacias`),
(6,`Transporte_publico`),
(7,`Lugare_de_interes`);

------------------------------------------
/* Table structure for table `tbl_rol` */
------------------------------------------
CREATE TABLE `tbl_rol` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `tbl_rol` (`id`,`nombre_rol`) VALUES
(1,`admin`),
(2,`cliente`);

-------------------------------------------
/* Table structure for table `tbl_tags` */
-------------------------------------------
CREATE TABLE `tbl_tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_tag` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
);

---------------------------------------------------
/* Table structure for table `tbl_puntogincana` */
---------------------------------------------------
CREATE TABLE `tbl_puntogincana` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_punto1_fk` int NOT NULL,
  `id_punto2_fk` int NOT NULL,
  `id_gincana_fk` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_punto_id_punto1_fk_idx` (`id_punto1_fk`),
  KEY `tbl_punto_id_punto2_fk_idx` (`id_punto2_fk`),
  KEY `tbl_punto_id_gincana_fk_idx` (`id_gincana_fk`),
  CONSTRAINT `tbl_punto_id_gincana_fk` FOREIGN KEY (`id_gincana_fk`) REFERENCES `tbl_gincana` (`id`),
  CONSTRAINT `tbl_punto_id_punto1_fk` FOREIGN KEY (`id_punto1_fk`) REFERENCES `tbl_lugar` (`id`),
  CONSTRAINT `tbl_punto_id_punto2_fk` FOREIGN KEY (`id_punto2_fk`) REFERENCES `tbl_lugar` (`id`)
);

---------------------------------------------
/* Table structure for table `tbl_pistas` */
---------------------------------------------
CREATE TABLE `tbl_pistas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pista1` varchar(100) NOT NULL,
  `pista2` varchar(100) NOT NULL,
  `pista3` varchar(100) NOT NULL,
  `id_puntogincana_fk` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_pista_id_puntogincana_fk_idx` (`id_puntogincana_fk`),
  CONSTRAINT `tbl_pista_id_puntogincana_fk` FOREIGN KEY (`id_puntogincana_fk`) REFERENCES `tbl_puntogincana` (`id`)
);

--------------------------------------------
/* Table structure for table `tbl_lugar` */
--------------------------------------------
CREATE TABLE `tbl_lugar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_lugar` varchar(50) NOT NULL,
  `ubi_lugar` varchar(50) NOT NULL,
  `telf_lugar` varchar(9) DEFAULT NULL,
  `descripcion_lugar` varchar(300) DEFAULT NULL,
  `foto_lugar` varchar(200) DEFAULT NULL,
  `id_tipo_fk` int NOT NULL,
  `id_tag_fk` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_lugar_id_tipo_fk_idx` (`id_tipo_fk`),
  KEY `tbl_lugar_id_tag_fk_idx` (`id_tag_fk`),
  CONSTRAINT `tbl_lugar_id_tag_fk` FOREIGN KEY (`id_tag_fk`) REFERENCES `tbl_tags` (`id`),
  CONSTRAINT `tbl_lugar_id_tipo_fk` FOREIGN KEY (`id_tipo_fk`) REFERENCES `tbl_tipo` (`id`)
);

INSERT INTO `tbl_lugar` (`id`,`nombre_lugar`,`ubi_lugar`,`telf_lugar`,`descripcion_lugar`,`foto_lugar`,`id_tipo_fk`,`id_tag_fk`) VALUES
(1,`Restaurant Petra`,`41.38390263173808, 2.181783655164913`,`933199999`,`Platos catalanes tradicionales y de temporada en un restaurante pintoresco, con azulejos llamativos y vidrieras.`,`petra.png`,1,NULL),
(2,`Mescladís del Pou`,`41.38708152338786, 2.1803348757929433`,`933198732`,`Platos sostenibles elaborados por los miembros de un programa de formación culinaria y servidos en un bar moderno y artístico.`,`mescladispou.png`,1,NULL),
(3,`Restaurante La Estrella`,`41.38377920824461, 2.1850558011125725`,`933102768`,`Restaurante refinado de larga trayectoria, que ofrece alta cocina catalana elaborada con productos frescos locales y de temporada.`,`laestrella.png`,1,NULL),
(4,`Museo del Chocolate`,`41.387362598724735, 2.181701106014877`,`932687878`,`Museo con obras de arte famosas elaboradas con chocolate, además de talleres para niños y adultos.`,`chocolate.png`,2,NULL),
(5,`Museu Picasso de Barcelona`,`41.385171551786605, 2.1808147393527633`,`932563000`,`Mansión medieval que alberga una amplia colección de piezas y obras maestras del pintor cubista español.`,`picasso.png`,2,NULL),
(6,`Museo Etnológico y de Culturas del Mundo`,`41.38506277199984, 2.180867341937956`,`932562300`,`Museo etnológico y cultural, con exposiciones de objetos de humanos de África, Asia y otras regiones.`,`etnologico.png`,2,NULL),
(7,`Grand Hotel Central Barcelona`,`41.38496758137014, 2.1777651668826183`,`932957900`,NULL,`grandhotel.png`,3,NULL),
(8,`K+K Hotel Picasso`,`41.38671668093708, 2.1838765987334914`,`935478600`,NULL,`khotel.png`,3,NULL),
(9,`Hotel Motel One Barcelona`,`41.39004382047747, 2.184520289337863`,`936261900`,NULL,`hotelmotel.png`,3,NULL),
(10,`CaixaBank`,`41.3862715005426, 2.181713363478766`,`932298770`,NULL,`caixa.png`,4,NULL),
(11,`Banc Sabadell`,`41.38442149199794, 2.1845427089262124`,`933150561`,NULL,`sabadell.png`,4,NULL),
(12,`Banco Santander`,`41.38604778562761, 2.1771442815801367`,`933100802`,NULL,`santander.png`,4,NULL),
(13,`Farmàcia`,`41.3917071397534, 2.180302370593196`,`932314605`,NULL,`farmacia.png`,5,NULL),
(14,`Farmàcia Fonoll`,`41.38779081222274, 2.178106634261473`,`933190329`,NULL,`farmacia.png`,5,NULL),
(15,`Farmacia Sombrerers`,`41.38402500155821, 2.181849662062854`,`933103460`,NULL,`farmacia.png`,5,NULL),
(16,`Estació de França`,`41.3848027799097, 2.1853700234520264`,NULL,NULL,`estacionfrancia.png`,6,NULL),
(17,`L1 Arc de Triomf`,`41.392001092863644, 2.181220581376575`,NULL,NULL,`l1.png`,6,NULL),
(18,`L4 Urquinaona`,`41.38875538942069, 2.1728957766424215`,NULL,NULL,`l4.png`,6,NULL),
(19,`Arco de Triunfo de Barcelona`,`41.39112215841537, 2.180668039178895`,`932853834`,`Arco clásico construido como entrada principal a la Exposición Universal que se celebró en la ciudad en 1888.`,`arcotriunfo.png`,7,NULL),
(20,`Parque de la Ciudadela`,`41.38826788704287, 2.1868735066661986`,`638237115`,`Parque creado a finales del siglo XIX con zoo, lago con barcas, museos ornamentados y senderos frondosos.`,`ciutadella.png`,7,NULL),
(21,`Palau de la Música Catalana`,`41.38755910128415, 2.1752484268421157`,`932957200`,`Sala de conciertos modernista famosa por su elaborada fachada y por su opulento auditorio con claraboya.`,`palaumusica.png`,7,NULL);


----------------------------------------------
/* Table structure for table `tbl_usuario` */
----------------------------------------------
CREATE TABLE `tbl_usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(45) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `contra_usuario` varchar(45) NOT NULL,
  `telf_usuario` varchar(9) NOT NULL,
  `foto_usuario` varchar(200) DEFAULT NULL,
  `id_rol_fk` int NOT NULL,
  `id_grupo_fk` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_usuario_id_rol_fk_idx` (`id_rol_fk`),
  KEY `tbl_usuario_id_grupo_fk_idx` (`id_grupo_fk`),
  CONSTRAINT `tbl_usuario_id_grupo_fk` FOREIGN KEY (`id_grupo_fk`) REFERENCES `tbl_grupo` (`id`),
  CONSTRAINT `tbl_usuario_id_rol_fk` FOREIGN KEY (`id_rol_fk`) REFERENCES `tbl_rol` (`id`)
);
