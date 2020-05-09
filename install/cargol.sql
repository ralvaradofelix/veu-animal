
--
-- Database: `cargol`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `is_promocio` tinyint(1) DEFAULT NULL,
  `nom_cat` varchar(255) DEFAULT NULL,
  `nom_esp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Bolcant dades de la taula `categoria`
--

INSERT INTO `categoria` (`id`, `data_alta`, `data_modificacio`, `categoria_id`, `posicio`, `is_promocio`, `nom_cat`, `nom_esp`) VALUES
(1, '2017-05-20 17:26:25', '2017-10-12 18:01:29', 0, 1, 0, 'Caravanes', 'Caravanas'),
(2, '2017-05-20 17:26:57', '2017-10-12 18:01:13', 0, 0, 0, 'Autocaravanes', 'Autocaravanas'),
(3, '2017-10-12 18:02:17', '2017-10-12 18:02:17', 2, 0, 0, 'Perfilades', 'Perfiladas'),
(4, '2017-10-12 18:02:47', '2017-10-12 18:02:47', 2, 0, 0, 'Integrals', 'Integrales'),
(5, '2017-10-12 18:03:23', '2017-10-12 18:03:23', 2, 0, 0, 'Caputxines', 'Capuchinas'),
(6, '2017-10-12 18:04:07', '2017-10-12 18:04:07', 1, 0, 0, 'Noves', 'Nuevas'),
(7, '2017-10-12 18:04:41', '2017-10-12 18:04:41', 1, 0, 0, 'Ocasió', 'Ocasión');

-- --------------------------------------------------------

--
-- Estructura de la taula `client_satisfet`
--

CREATE TABLE `client_satisfet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `titol` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de la taula `config_projecte`
--

CREATE TABLE `config_projecte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `is_hidden` tinyint(1) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `clau` varchar(255) DEFAULT NULL,
  `valor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Bolcant dades de la taula `config_projecte`
--

INSERT INTO `config_projecte` (`id`, `data_alta`, `data_modificacio`, `posicio`, `is_hidden`, `nom`, `clau`, `valor`) VALUES
(1, '2015-08-18 16:40:51', '2017-11-09 19:28:21', 0, 0, 'E-mail', 'contacte_email', 'comercial@cargolcaravanes.com'),
(3, '2015-08-18 16:42:06', '2017-11-09 19:28:21', 0, 0, 'Telèfon', 'contacte_telefon', '93 562 14 14 / 93 562 48 03'),
(4, '2015-08-18 16:43:10', '2017-11-09 19:28:21', 0, 0, 'Contacte adreça', 'contacte_direccio', 'Ctra. C17 Km. 15,5 - 08150<br><b>Parets del Vallés</b>'),
(6, '2015-08-18 16:44:10', '2017-11-09 19:28:21', 1, 0, 'Social Facebook', 'social_facebook', 'http://www.facebook.com/burstner/'),
(7, '2015-08-18 16:44:23', '2017-11-09 19:28:21', 1, 0, 'Social Twitter', 'social_twitter', ''),
(8, '2015-08-18 16:44:30', '2017-11-09 19:28:21', 1, 0, 'Social Youtube', 'social_youtube', 'https://www.youtube.com/channel/burstner'),
(15, '2017-11-09 16:38:27', '2017-11-09 16:47:01', 0, 1, 'Notícies Banner Link (esp)', 'noticies_banner_link_esp', ''),
(16, '2017-11-09 16:38:27', '2017-11-09 16:47:01', 0, 1, 'Notícies Banner Link (cat)', 'noticies_banner_link_cat', ''),
(17, '2017-11-09 16:40:52', '2017-11-09 16:42:16', 0, 1, 'Notícies Banner Foto (esp)', 'noticies_banner_foto_esp', 'RECORTADO.jpg'),
(18, '2017-11-09 16:46:53', '2017-11-09 16:46:53', 0, 1, 'Notícies Banner Foto (cat)', 'noticies_banner_foto_cat', 'RECORTADO.jpg'),
(19, '2015-08-18 16:43:10', '2017-11-09 19:28:21', 0, 0, 'Horari', 'contacte_horari', 'De lunes a sábado<br>de <b>9:00 a 14:00</b> <br>y de <b>16:00 a 19:00</b>');

-- --------------------------------------------------------

--
-- Estructura de la taula `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `nom_cat` varchar(255) DEFAULT NULL,
  `nom_esp` varchar(255) DEFAULT NULL,
  `foto_principal` varchar(255) DEFAULT NULL,
  `descripcio_cat` text,
  `descripcio_esp` text,
  `resum_esp` varchar(255) DEFAULT NULL,
  `resum_cat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Bolcant dades de la taula `noticia`
--

INSERT INTO `noticia` (`id`, `data_alta`, `data_modificacio`, `data`, `posicio`, `nom_cat`, `nom_esp`, `foto_principal`, `descripcio_cat`, `descripcio_esp`, `resum_esp`, `resum_cat`) VALUES
(2, '2017-09-15 19:39:07', '2017-10-11 14:24:39', '2017-04-19 00:00:00', 0, 'CARAVANES D''OCASIÓ?', '¿CARAVANAS DE OCASIÓN?', '1507723184.JPG', '<p class="brcm-summary">&iquest;Est&aacute;s mirando caravanas de ocasi&oacute;n? &iquest;Conoces la Especial campa&ntilde;a 40 aniversario Caravanas? Caravelair desde 120&euro; al mes, sin entrada y con sobre equipamiento vinculado:</p>\r\n<div class="brcm-body">\r\n<p>&iquest;Est&aacute;s mirando caravanas de ocasi&oacute;n?</p>\r\n<p>Conoces la Especial campa&ntilde;a "LEST DAYS" 40 aniversario Caravanas Caravelair desde 120&euro; al mes, sin entrada y con sobre equipamiento vinculado: (Aire acondicionado, kit de ruta, toldo). 2 A&Ntilde;OS DE GARANTIA. Una OCASI&Oacute;N irrepetible.</p>\r\n<p>Disponemos de 40 caravanas en Stock, modelos 2017, de entrega inmediata, con un sistema de pago hist&oacute;ricamente inigualable (inter&eacute;s del 3,50%) posiblemente irrepetible.</p>\r\n<h2>Algunos ejemplos:<br />Caravelair Antares 330 (la super rutera de 640Kg) x &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&nbsp;<strong>120&euro; al mes</strong>&nbsp;sin entrada.</h2>\r\n<h2>Caravelair Antares 476 ( La 3 ambientes con literas, rutera) x &hellip;&hellip;&hellip;&hellip;.&nbsp;<strong>148&euro; al mes</strong>sin entrada.</h2>\r\n<h2>Caravelair Antares 486 ( 3 ambientes, literas con frigo 150) x &hellip;&hellip;&hellip;&hellip;.&nbsp;<strong>159&euro; al mes</strong>sin entrada.</h2>\r\n<h2>Caravelair Antares 496 (3 literas para super familias con frigo 150lt)..&nbsp;<strong>167&euro; al mes</strong>&nbsp;sin entrada.</h2>\r\n<p>Si quieres un equipo excepcional, te proponemos la gama Style.</p>\r\n<p><strong><em>+ Equipamiento Style (Entre 16&euro; y 23&euro; mas al mes)</em></strong></p>\r\n<p>-Claraboya panor&aacute;mica 70x50cm // -Amortiguadores // -Dep&oacute;sito aguas grises 30 lts. con ruedas. // -Luces lectura flexibles. // -Preinstalaci&oacute;n de bater&iacute;a 2kg // -Paredes Poli&eacute;ster. // -Agua caliente. // -Puerta de entrada reforzada. // -Port&oacute;n exterior lateral 100x40cm // - Amortiguadores cama matrimonio. // - Estabilizador Al-ko</p>\r\n<p><strong>Y ll&eacute;vate El AIRE ACONDICIONADO y el toldo GRATIS&hellip;</strong></p>\r\n</div>', '<p class="brcm-summary">&iquest;Est&aacute;s mirando caravanas de ocasi&oacute;n? &iquest;Conoces la Especial campa&ntilde;a 40 aniversario Caravanas? Caravelair desde 120&euro; al mes, sin entrada y con sobre equipamiento vinculado:</p>\r\n<div class="brcm-body">\r\n<p>&iquest;Est&aacute;s mirando caravanas de ocasi&oacute;n?</p>\r\n<p>Conoces la Especial campa&ntilde;a "LEST DAYS" 40 aniversario Caravanas Caravelair desde 120&euro; al mes, sin entrada y con sobre equipamiento vinculado: (Aire acondicionado, kit de ruta, toldo). 2 A&Ntilde;OS DE GARANTIA. Una OCASI&Oacute;N irrepetible.</p>\r\n<p>Disponemos de 40 caravanas en Stock, modelos 2017, de entrega inmediata, con un sistema de pago hist&oacute;ricamente inigualable (inter&eacute;s del 3,50%) posiblemente irrepetible.</p>\r\n<h2>Algunos ejemplos:<br />Caravelair Antares 330 (la super rutera de 640Kg) x &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&nbsp;<strong>120&euro; al mes</strong>&nbsp;sin entrada.</h2>\r\n<h2>Caravelair Antares 476 ( La 3 ambientes con literas, rutera) x &hellip;&hellip;&hellip;&hellip;.&nbsp;<strong>148&euro; al mes</strong>sin entrada.</h2>\r\n<h2>Caravelair Antares 486 ( 3 ambientes, literas con frigo 150) x &hellip;&hellip;&hellip;&hellip;.&nbsp;<strong>159&euro; al mes</strong>sin entrada.</h2>\r\n<h2>Caravelair Antares 496 (3 literas para super familias con frigo 150lt)..&nbsp;<strong>167&euro; al mes</strong>&nbsp;sin entrada.</h2>\r\n<p>Si quieres un equipo excepcional, te proponemos la gama Style.</p>\r\n<p><strong><em>+ Equipamiento Style (Entre 16&euro; y 23&euro; mas al mes)</em></strong></p>\r\n<p>-Claraboya panor&aacute;mica 70x50cm // -Amortiguadores // -Dep&oacute;sito aguas grises 30 lts. con ruedas. // -Luces lectura flexibles. // -Preinstalaci&oacute;n de bater&iacute;a 2kg // -Paredes Poli&eacute;ster. // -Agua caliente. // -Puerta de entrada reforzada. // -Port&oacute;n exterior lateral 100x40cm // - Amortiguadores cama matrimonio. // - Estabilizador Al-ko</p>\r\n<p><strong>Y ll&eacute;vate El AIRE ACONDICIONADO y el toldo GRATIS&hellip;</strong></p>\r\n</div>', NULL, NULL),
(4, '2017-10-11 14:15:47', '2017-10-11 14:23:58', '2017-06-09 00:00:00', 0, 'El nostre objectiu: Fer feliços als nostres clients', 'Nuestro objetivo: Hacer felices a nuestros clientes', '1507724147.JPG', '<h3>El nostre objectiu: Fer feli&ccedil;os als nostres clients...</h3>\r\n<h3>Un petit equip, amb MOLTA ESPERIENCIA i ganes de treballar per vost&egrave;s...</h3>\r\n<h3>CARGOL CARAVANAS 40 ANIVERSARI</h3>\r\n<h2>(La nostra for&ccedil;a es el nostre GRAN EQUIP...)</h2>', '<h3>Nuestro objetivo: Hacer felices a nuestros clientes.</h3>\r\n<h3>Un peque&ntilde;o equipo con MUCHA EXPERIENCIA y ganas de trabajar por usted.</h3>\r\n<h3>CARGOL CARAVANAS 40 ANIVERSARIO....</h3>\r\n<h2>(Nuestra fuerza es nuestro GRAN EQUIPO )</h2>', NULL, NULL),
(5, '2017-10-11 14:32:05', '2017-10-11 18:39:45', '2017-06-23 00:00:00', 0, 'Premi del grup Trigano a Cargol Caravanas com líder de vendes temporada 2017', 'Premio del grupo Trigano a Cargol Caravanas como lider de ventas temporada 2017', '1507725125.jpg', '<h2>Premi del grup Trigano a Cargol Caravanas com l&iacute;der de vendes temporada 2017 en Espa&ntilde;a por tercer any consecutiu.</h2>\r\n<h2>Cargol Caravanas L&iacute;der en Espa&ntilde;a de les marques Caravelair i Challenger, vol agreir als seus clients la fidelitat/confian&ccedil;a en la nostra empresa. El nostre objectiu: Fer feli&ccedil;os als nostres clients&hellip;.</h2>\r\n<div>\r\n<h2>CARGOL CARAVANAS (La for&ccedil;a de un GRAN EQUIP)</h2>\r\n</div>', '<h2>Premio del grupo Trigano a Cargol Caravanas como lider de ventas temporada 2017 en Espa&ntilde;a por tercer a&ntilde;o consecutivo.</h2>\r\n<h2>Cargol Caravanas Lider en Espa&ntilde;a de las marcas Caravelair y Challenger, Quiere agradecer a sus clientes la fidelidad/confianza en nuestra empresa. Nuestro objetivo: Hacer felices a nuestros clientes&hellip;.</h2>\r\n<p>CARGOL CARAVANAS (La fuerza de un GRAN EQUIPO)</p>', 'Premio del grupo Trigano a Cargol Caravanas como lider de ventas temporada 2017 en España por tercer año consecutivo.', 'Premi del grup Trigano a Cargol Caravanas com líder de vendes temporada 2017 en España por tercer any consecutiu.'),
(6, '2017-10-11 14:36:44', '2017-10-11 18:38:51', '2017-07-01 00:00:00', 0, 'Video de la millor oferta Rapido 855f', 'Video de la mejor oferta Rapido 855f', '1507725404.jpg', '<p><iframe src="https://www.youtube.com/embed/6tWVy-jfftE?rel=0" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>', '<p><iframe src="https://www.youtube.com/embed/6tWVy-jfftE?rel=0" width="560" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>', 'Ver video', 'Veure vídeo'),
(7, '2017-10-11 17:45:56', '2017-10-11 18:38:13', '2017-09-08 00:00:00', 0, 'Oferta Challenger Genesis 284 por 399¤* al mes.', 'Oferta Challenger Genesis 284 por 399¤* al mes.', '1507736756.JPG', '<h2>Oferta final de campanya: Per 9.608&euro; d&rsquo;entrada i paga c&ograve;modament. Distribuci&oacute; de llit transversal regulable en al&ccedil;ada, sobre garatge &nbsp;de mol bona capacitat.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Doble armari de roba, bany perfectament dissenyat, frigor&iacute;fic intel&middot;ligent, calefacci&oacute; Truma amb comandament programador i alimentaci&oacute; a gasoil. &nbsp;Panels de fins 6,5cm de gruix amb &nbsp;a&iuml;llament de&nbsp;<strong><a href="http://www.cargolcaravanas.com/ca/noticies/2016/04/20/tecnologia-i-r-p-de-challenger">ALTA DENSITAT. (VEURA PER QUE es el millor SISTEMA CONSTRUCTIU)</a></strong></h2>\r\n<p>Ultimes 2 unitats a preu OUTLET (Oferta transparent claus en ma&hellip;)</p>\r\n<h2>(<a>VEURE FITXA</a>)</h2>', '<h2>Oferta final de campa&ntilde;a: Por 9.608&euro; de entrada y paga c&oacute;modamente. Distribuci&oacute;n de cama transversal regulable en altura, sobre garaje &nbsp;de muy buena capacidad.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Doble armario ropero, ba&ntilde;o perfectamente dise&ntilde;ado, frigor&iacute;fico inteligente, calefacci&oacute;n Truma con mando programador y alimentaci&oacute;n a gasoil. &nbsp;Paneles de hasta 6,5cm de grueso con &nbsp;aislamiento de&nbsp;<strong><a href="http://www.cargolcaravanas.com/es/noticias/2016/04/20/tecnologia-i-r-p">ALTA DENSIDAD. (VER POR QUE es el MEJOR SISTEMA CONSTRUCTIVO)</a></strong></h2>\r\n<p>Ultimas 2 unidades a precio OUTLET (Oferta transparente llaves en mano&hellip;)</p>\r\n<h2><a href="http://www.cargolcaravanas.com/es/productos/autocaravanes/autocaravanes-noves/autocaravanes-perfilades/challenger-quartz-284">(VER FICHA)</a></h2>', 'Oferta final de campaña: Por 9.608¤ de entrada y paga cómodamente. Distribución de cama transversal regulable en altura, sobre garaje de muy buena capacidad.', 'Oferta final de campanya: Per 9.608¤ d&#8217;entrada i paga còmodament. Distribució de llit transversal regulable en alçada, sobre garatge de mol bona capacitat.'),
(8, '2017-10-11 18:02:03', '2017-10-12 14:11:47', '2017-09-22 00:00:00', 0, 'NOVETATS 2018', 'NOVEDADES 2018', '1507737723.jpg', '<p><strong>Ja es poden veure les primeres NOVETATS 2018 en Cargol Caravanes. Tant de CHALLENGER, com de RAPIDO i CARAVELAIR.</strong></p>\r\n<p>Poden veure la Revolucionaria Genesis 396 (Autocaravana amb lliteres retractils):&nbsp;<a href="http://www.cargolcaravanas.com/es/productos/autocaravanes/autocaravanes-noves/autocaravanes-perfilades/challenger-genesis-396">http://www.cargolcaravanas.com/es/productos/autocaravanes/autocaravanes-noves/autocaravanes-perfilades/challenger-genesis-396</a></p>\r\n<p>Tamb&eacute; la NOVA 260 en versi&oacute; MAGEO. Pot ser la autocaravana amb mes espai de dia del mercat i amb llit de 1,60. Et sorprendr&agrave;:&nbsp;<a href="http://www.cargolcaravanas.com/es/productos/autocaravanas/autocaravanas-nuevas/autocaravanas-perfiladas/challenger-mageo-260">http://www.cargolcaravanas.com/es/productos/autocaravanas/autocaravanas-nuevas/autocaravanas-perfiladas/challenger-mageo-260</a></p>\r\n<p>I com no, les ofertes &ldquo;Special 40 Aniversario&rdquo; en les seves diferents versions, amb llits illa, llits paral&middot;lels i amb la incorporaci&oacute; de les noves 378 y 368 de seients sal&oacute; &ldquo;enfrontats&rdquo;:&nbsp;</p>\r\n<p><a href="http://www.cargolcaravanas.com/es/productos/autocaravanas/autocaravanas-nuevas/autocaravanas-perfiladas/challenger-edition-40-aniversary-387-m-2018">http://www.cargolcaravanas.com/es/productos/autocaravanas/autocaravanas-nuevas/autocaravanas-perfiladas/challenger-edition-40-aniversary-387-m-2018</a></p>\r\n<p>Ja poden passar per Cargol a veure aquestes i altres novetats:&nbsp;<a href="http://www.cargolcaravanas.com/es/autocaravanas/autocaravanas-nuevas">http://www.cargolcaravanas.com/es/autocaravanas/autocaravanas-nuevas</a></p>\r\n<h3>US ESPEREM</h3>\r\n<p>(Recordamos que pueden hacer servir el servicio&nbsp;<a href="http://www.cargolcaravanas.com/ca/noticies/2017/04/17/visita-amb-cita-previa-assessorament-de-caravanas-i-autocaravanas">&ldquo;VISITA CON CITA PR&Egrave;VIA&rdquo;...&nbsp;</a>para poder ser atendidos sin&nbsp; esperas.) De Lunes a Sabado de 9h a 14h y de 16h a 19h)</p>', '<p class="brcm-summary">Ya se pueden ver las primeras NOVEDADES 2018 en Cargol Caravanas. Tanto de CHALLENGER, como de RAPIDO y CARAVELAIR.</p>\r\n<div class="brcm-body">\r\n<h3>Puedes ver la Revolucionaria Genesis 396 (Autocaravana con literas retractiles):&nbsp;<a href="http://www.cargolcaravanas.com/es/productos/autocaravanes/autocaravanes-noves/autocaravanes-perfilades/challenger-genesis-396">http://www.cargolcaravanas.com/es/productos/autocaravanes/autocaravanes-noves/autocaravanes-perfilades/challenger-genesis-396</a></h3>\r\n<h3>Tambi&eacute;n la NUEVA 260 en versi&oacute;n MAGEO. Quiz&aacute;s la autocaravana con m&aacute;s espacio de d&iacute;a del mercado y con cama de 1,60. Te sorprender&aacute;:&nbsp;<a href="http://www.cargolcaravanas.com/es/productos/autocaravanas/autocaravanas-nuevas/autocaravanas-perfiladas/challenger-mageo-260">http://www.cargolcaravanas.com/es/productos/autocaravanas/autocaravanas-nuevas/autocaravanas-perfiladas/challenger-mageo-260</a></h3>\r\n<h3>Y como no, las ofertas &ldquo;Special 40 Aniversario&rdquo; en sus diferentes versiones, con camas islas, camas paralelas y con la incorporaci&oacute;n de las nuevas 378 y 368 de asientos sal&oacute;n &ldquo;enfrentados&rdquo;:&nbsp;</h3>\r\n<h3>&nbsp;&nbsp;<a href="http://www.cargolcaravanas.com/es/productos/autocaravanas/autocaravanas-nuevas/autocaravanas-perfiladas/challenger-edition-40-aniversary-387-m-2018">http://www.cargolcaravanas.com/es/productos/autocaravanas/autocaravanas-nuevas/autocaravanas-perfiladas/challenger-edition-40-aniversary-387-m-2018</a></h3>\r\n<h3>Ya pueden pasar por Cargol a ver estas y otras novedades:&nbsp;<a href="http://www.cargolcaravanas.com/es/autocaravanas/autocaravanas-nuevas">http://www.cargolcaravanas.com/es/autocaravanas/autocaravanas-nuevas</a></h3>\r\n<h3>LES &nbsp;ESPEREMOS</h3>\r\n<h2>(Recordamos que pueden hacer servir el servicio&nbsp;<a href="http://www.cargolcaravanas.com/ca/noticies/2017/04/17/visita-amb-cita-previa-assessorament-de-caravanas-i-autocaravanas">&ldquo;VISITA CON CITA PR&Egrave;VIA&rdquo;...&nbsp;</a>para poder ser atendidos sin&nbsp; esperas.)</h2>\r\n</div>', 'Ya se pueden ver las primeras NOVEDADES 2018 en Cargol Caravanas. Tanto de CHALLENGER, como de RAPIDO y CARAVELAIR.', 'Ja es poden veure les primeres NOVETATS 2018 en Cargol Caravanes. Tant de CHALLENGER, com de RAPIDO i CARAVELAIR.');

-- --------------------------------------------------------

--
-- Estructura de la taula `noticia_galeria`
--

CREATE TABLE `noticia_galeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `noticia_id` int(11) DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `titol` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Bolcant dades de la taula `noticia_galeria`
--

INSERT INTO `noticia_galeria` (`id`, `data_alta`, `data_modificacio`, `noticia_id`, `posicio`, `titol`, `foto`, `thumb`) VALUES
(6, '2017-10-11 14:23:23', '2017-10-11 14:23:58', 4, 0, '', '1507724603.JPG', ''),
(5, '2017-10-11 14:23:23', '2017-10-11 14:23:58', 4, 0, '', '1507724603.JPG', ''),
(7, '2017-10-11 14:23:23', '2017-10-11 14:23:58', 4, 0, '', '1507724638.JPG', ''),
(8, '2017-10-11 14:23:58', '2017-10-11 14:23:58', 4, 0, '', '1507724638.JPG', ''),
(9, '2017-10-11 14:23:58', '2017-10-11 14:23:58', 4, 0, '', '1507724638.JPG', ''),
(10, '2017-10-11 14:23:58', '2017-10-11 14:23:58', 4, 0, '', '1507724638.JPG', ''),
(11, '2017-10-11 14:24:39', '2017-10-11 14:24:39', 2, 0, '', '1507724679.JPG', ''),
(12, '2017-10-11 14:24:39', '2017-10-11 14:24:39', 2, 0, '', '1507724679.JPG', ''),
(13, '2017-10-11 14:32:05', '2017-10-11 18:39:45', 5, 0, '', '1507725125.JPG', ''),
(14, '2017-10-11 14:32:05', '2017-10-11 18:39:45', 5, 0, '', '1507725125.JPG', ''),
(15, '2017-10-11 14:33:21', '2017-10-11 18:39:45', 5, 0, '', '1507725201.JPG', ''),
(16, '2017-10-11 14:33:21', '2017-10-11 18:39:45', 5, 0, '', '1507725201.JPG', ''),
(17, '2017-10-11 17:45:56', '2017-10-11 18:38:13', 7, 0, '', '1507736756.JPG', ''),
(18, '2017-10-11 17:45:56', '2017-10-11 18:38:13', 7, 0, '', '1507736756.JPG', ''),
(19, '2017-10-11 17:45:56', '2017-10-11 18:38:13', 7, 0, '', '1507736756.JPG', ''),
(20, '2017-10-11 18:02:03', '2017-10-12 14:11:47', 8, 0, '', '1507737723.JPG', ''),
(21, '2017-10-11 18:02:03', '2017-10-12 14:11:47', 8, 0, '', '1507737723.JPG', ''),
(22, '2017-10-11 18:02:03', '2017-10-12 14:11:47', 8, 0, '', '1507737723.JPG', ''),
(23, '2017-10-11 18:02:03', '2017-10-12 14:11:47', 8, 0, '', '1507737723.png', ''),
(24, '2017-10-11 18:02:03', '2017-10-12 14:11:47', 8, 0, '', '1507737723.png', '');

-- --------------------------------------------------------

--
-- Estructura de la taula `pagina`
--

CREATE TABLE `pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `pagina_id` int(11) DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `actiu` tinyint(1) DEFAULT NULL,
  `titol_cat` varchar(255) DEFAULT NULL,
  `subtitol_cat` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `curl` varchar(255) DEFAULT NULL,
  `resum` text,
  `descripcio` text,
  `titol_esp` varchar(255) DEFAULT NULL,
  `subtitol_esp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Bolcant dades de la taula `pagina`
--

INSERT INTO `pagina` (`id`, `data_alta`, `data_modificacio`, `pagina_id`, `posicio`, `actiu`, `titol_cat`, `subtitol_cat`, `foto`, `curl`, `resum`, `descripcio`, `titol_esp`, `subtitol_esp`) VALUES
(8, '2017-09-12 18:49:20', '2017-11-22 12:07:40', 0, 100, 1, 'TECNOLOGIA I.R.P DE CHALLENGER', 'MÉS RÍGIDA, MÉS DURADERA, MÉS ESTANCA I MÉS AILLANT', '', 'tecnologia-irp-challenge', '', '', 'TECNOLOGIA I.R.P DE CHALLENGER', 'MÁS RÍGIDA, MÁS DURADERA, MAS ESTANCA Y MAS AISLANTE'),
(9, '2017-11-03 18:09:47', '2017-11-22 12:07:40', 0, 101, 1, 'Clients Satisfets', 'Cargol, 40 anys d''ofici i MOLTS CLIENTS SATISFETS!', '', '', '', '', 'Clientes Satisfechos', '¡Cargol, 40 años de oficio y MUCHOS CLIENTES SATISFECHOS!'),
(10, '2017-11-21 13:32:34', '2017-11-22 12:07:40', 0, 0, 1, 'Contacte', '', '', 'contacto', '', '', 'Contacto', ''),
(11, '2017-11-22 13:14:30', '2017-11-22 13:28:35', 0, 0, 1, 'Clients Satisfets', 'Cargol, 40 anys d''ofici i MOLTS CLIENTS SATISFETS!', '', 'clientes-satisfechos', '', '', 'Clientes Satisfechos', '¡Cargol, 40 años de oficio y MUCHOS CLIENTES SATISFECHOS!');

-- --------------------------------------------------------

--
-- Estructura de la taula `pagina_galeria`
--

CREATE TABLE `pagina_galeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `pagina_id` int(11) DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `es_destacat` tinyint(1) DEFAULT NULL,
  `actiu` tinyint(1) DEFAULT NULL,
  `titol` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `descripcio` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Bolcant dades de la taula `pagina_galeria`
--

INSERT INTO `pagina_galeria` (`id`, `data_alta`, `data_modificacio`, `pagina_id`, `posicio`, `es_destacat`, `actiu`, `titol`, `foto`, `thumb`, `descripcio`) VALUES
(2, '2017-02-01 14:37:37', '2017-02-06 18:53:06', 3, 0, 0, 0, '', '1486403586.jpg', '', ''),
(5, '2017-02-01 16:48:33', '2017-04-04 16:40:51', 4, 0, 0, 0, '', '1485964113.JPG', '', ''),
(7, '2017-02-01 16:48:33', '2017-04-04 16:40:51', 4, 0, 0, 0, '', '1485964113.jpg', '', ''),
(9, '2017-02-01 16:48:33', '2017-04-04 16:40:51', 4, 0, 0, 0, '', '1485964113.jpg', '', ''),
(10, '2017-02-01 16:48:33', '2017-04-04 16:40:52', 4, 0, 0, 0, '', '1485964113.jpg', '', ''),
(11, '2017-02-01 16:55:28', '2017-04-04 15:12:56', 103, 0, 0, 0, '', '1491311576.jpg', '', ''),
(12, '2017-04-04 15:14:38', '2017-04-04 15:14:38', 104, 0, 0, 0, '', '1491311678.jpg', '', ''),
(13, '2017-04-04 15:16:03', '2017-04-04 15:16:07', 105, 0, 0, 0, '', '1491311763.jpg', '', ''),
(14, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(15, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(16, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(17, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(18, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(19, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(20, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(21, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(22, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(23, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(24, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(25, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(26, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(27, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(28, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(29, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(30, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(31, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(32, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(33, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(34, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(35, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(36, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(37, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(38, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(39, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(40, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(41, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(42, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(43, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(44, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(45, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(46, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(47, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(48, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(49, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(50, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(51, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(52, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(53, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(54, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(55, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(56, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(57, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(58, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(59, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(60, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(61, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(62, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', ''),
(63, '2017-11-22 12:16:56', '2017-11-22 12:16:56', 0, 0, 0, 0, '', '1511349416.jpg', '', '');

-- --------------------------------------------------------

--
-- Estructura de la taula `pagina_seccio`
--

CREATE TABLE `pagina_seccio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `pagina_id` int(11) DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `actiu` tinyint(1) DEFAULT NULL,
  `titol` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `descripcio` text,
  `code` text,
  `titol_esp` varchar(255) DEFAULT NULL,
  `titol_cat` varchar(255) DEFAULT NULL,
  `descripcio_esp` text,
  `descripcio_cat` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Bolcant dades de la taula `pagina_seccio`
--

INSERT INTO `pagina_seccio` (`id`, `data_alta`, `data_modificacio`, `pagina_id`, `posicio`, `actiu`, `titol`, `foto`, `thumb`, `video`, `color`, `descripcio`, `code`, `titol_esp`, `titol_cat`, `descripcio_esp`, `descripcio_cat`) VALUES
(4, '2017-09-12 18:45:30', '2017-11-09 12:46:41', 8, 0, 1, '', '', '', 'https://www.youtube.com/watch?v=za6dtClCFcc', '', '<p>Cualquiera que sea el nivel de acabado, Genesis o Mageo, la estructura&nbsp;de los habit&aacute;culos de Challenger respeta el mismo est&aacute;ndar de alta calidad IRP, garantizando un alto&nbsp;nivel de fabricaci&oacute;n para disponer de un<strong>&nbsp;Aislamiento &oacute;ptimo, una Resistencia multiplicada&nbsp;</strong><strong>y una Protecci&oacute;n reforzada. A continuaci&oacute;n se detallan los motivos que justifican la calidad IRP de Challenger:</strong></p>\r\n<div>\r\n<div>\r\n<div>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;">\r\n<p><strong>Aislante XPS:&nbsp;</strong>una espuma extra firme e hidr&oacute;fuga, con alto poder aislante ac&uacute;stico y t&eacute;rmico.</p>\r\n</li>\r\n</ul>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Espesores extra-gruesos de suelo y techo,&nbsp;</strong>64 mm de grosor de suelo y 55 mm de grosor de techo&nbsp;permiten un aislamiento que va m&aacute;s all&aacute; de los est&aacute;ndares de la profesi&oacute;n. Adem&aacute;s,&nbsp;ofrece una mejor resistencia a la carga y limitan la deformaci&oacute;n con el tiempo.</li>\r\n</ul>\r\n</div>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Los paneles de poli&eacute;ster&nbsp;</strong>son&nbsp;m&aacute;s resistentes que el aluminio por que no se abollan, en cambio, el aluminio, al ser un metal muy blando se deforma y se abolla con mucha facilidada. Por eso el poliester es mas resistente a las rayadas, los peque&ntilde;os golpes, el granizo, los hidrocarburos, los ultravioletas y a la intemperie en general.</li>\r\n</ul>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Alianza madera / composite eficiente,&nbsp;</strong>La ventaja de la madera es que es un material muy r&iacute;gido pero se puede pudrir si hubiesen filtraciones, en cambio el composite es un material mas flexible que la madera pero no se pudre en contacto con el agua. Por eso, Challenger combina estos dos materiales para aprovechar las ventajas de los dos materiales.</li>\r\n</ul>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Estanqueidad.&nbsp;</strong>Todos los materiales que est&aacute;n en contacto con el exterior son hidr&oacute;fugos. Adem&aacute;s, los perfiles que unen los paneles no estan atornillados, de manera que se evita crerar innecesarios orificios susceptibles de convertirse en futuras filtraciones.</li>\r\n</ul>\r\n<p><strong>Paneles de hasta 6,5cm de grueso con &nbsp;aislamiento de&nbsp;<strong><a href="https://www.youtube.com/watch?v=za6dtClCFcc">ALTA DENSIDAD. (VER POR QUE es el MEJOR SISTEMA CONSTRUCTIVO)</a></strong></strong></p>\r\n<p>&nbsp;</p>\r\n<p>Nota: por su forma especial, el techo de nuestras autocaravanas Capuchinas dispone de una tecnolog&iacute;a espec&iacute;fica.</p>\r\n</div>\r\n</div>', '', '', '', '<p>Cualquiera que sea el nivel de acabado, Genesis o Mageo, la estructura&nbsp;de los habit&aacute;culos de Challenger respeta el mismo est&aacute;ndar de alta calidad IRP, garantizando un alto&nbsp;nivel de fabricaci&oacute;n para disponer de un<strong>&nbsp;Aislamiento &oacute;ptimo, una Resistencia multiplicada&nbsp;</strong><strong>y una Protecci&oacute;n reforzada. A continuaci&oacute;n se detallan los motivos que justifican la calidad IRP de Challenger:</strong></p>\r\n<div>\r\n<div>\r\n<div>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;">\r\n<p><strong>Aislante XPS:&nbsp;</strong>una espuma extra firme e hidr&oacute;fuga, con alto poder aislante ac&uacute;stico y t&eacute;rmico.</p>\r\n</li>\r\n</ul>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Espesores extra-gruesos de suelo y techo,&nbsp;</strong>64 mm de grosor de suelo y 55 mm de grosor de techo&nbsp;permiten un aislamiento que va m&aacute;s all&aacute; de los est&aacute;ndares de la profesi&oacute;n. Adem&aacute;s,&nbsp;ofrece una mejor resistencia a la carga y limitan la deformaci&oacute;n con el tiempo.</li>\r\n</ul>\r\n</div>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Los paneles de poli&eacute;ster&nbsp;</strong>son&nbsp;m&aacute;s resistentes que el aluminio por que no se abollan, en cambio, el aluminio, al ser un metal muy blando se deforma y se abolla con mucha facilidada. Por eso el poliester es mas resistente a las rayadas, los peque&ntilde;os golpes, el granizo, los hidrocarburos, los ultravioletas y a la intemperie en general.</li>\r\n</ul>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Alianza madera / composite eficiente,&nbsp;</strong>La ventaja de la madera es que es un material muy r&iacute;gido pero se puede pudrir si hubiesen filtraciones, en cambio el composite es un material mas flexible que la madera pero no se pudre en contacto con el agua. Por eso, Challenger combina estos dos materiales para aprovechar las ventajas de los dos materiales.</li>\r\n</ul>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Estanqueidad.&nbsp;</strong>Todos los materiales que est&aacute;n en contacto con el exterior son hidr&oacute;fugos. Adem&aacute;s, los perfiles que unen los paneles no estan atornillados, de manera que se evita crerar innecesarios orificios susceptibles de convertirse en futuras filtraciones.</li>\r\n</ul>\r\n<p><strong>Paneles de hasta 6,5cm de grueso con &nbsp;aislamiento de&nbsp;<strong><a href="https://www.youtube.com/watch?v=za6dtClCFcc">ALTA DENSIDAD. (VER POR QUE es el MEJOR SISTEMA CONSTRUCTIVO)</a></strong></strong></p>\r\n<p>&nbsp;</p>\r\n<p>Nota: por su forma especial, el techo de nuestras autocaravanas Capuchinas dispone de una tecnolog&iacute;a espec&iacute;fica.</p>\r\n</div>\r\n</div>', '<p>Cualquiera que sea el nivel de acabado, Genesis o Mageo, la estructura&nbsp;de los habit&aacute;culos de Challenger respeta el mismo est&aacute;ndar de alta calidad IRP, garantizando un alto&nbsp;nivel de fabricaci&oacute;n para disponer de un<strong>&nbsp;Aislamiento &oacute;ptimo, una Resistencia multiplicada&nbsp;</strong><strong>y una Protecci&oacute;n reforzada. A continuaci&oacute;n se detallan los motivos que justifican la calidad IRP de Challenger:</strong></p>\r\n<div>\r\n<div>\r\n<div>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;">\r\n<p><strong>Aislante XPS:&nbsp;</strong>una espuma extra firme e hidr&oacute;fuga, con alto poder aislante ac&uacute;stico y t&eacute;rmico.</p>\r\n</li>\r\n</ul>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Espesores extra-gruesos de suelo y techo,&nbsp;</strong>64 mm de grosor de suelo y 55 mm de grosor de techo&nbsp;permiten un aislamiento que va m&aacute;s all&aacute; de los est&aacute;ndares de la profesi&oacute;n. Adem&aacute;s,&nbsp;ofrece una mejor resistencia a la carga y limitan la deformaci&oacute;n con el tiempo.</li>\r\n</ul>\r\n</div>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Los paneles de poli&eacute;ster&nbsp;</strong>son&nbsp;m&aacute;s resistentes que el aluminio por que no se abollan, en cambio, el aluminio, al ser un metal muy blando se deforma y se abolla con mucha facilidada. Por eso el poliester es mas resistente a las rayadas, los peque&ntilde;os golpes, el granizo, los hidrocarburos, los ultravioletas y a la intemperie en general.</li>\r\n</ul>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Alianza madera / composite eficiente,&nbsp;</strong>La ventaja de la madera es que es un material muy r&iacute;gido pero se puede pudrir si hubiesen filtraciones, en cambio el composite es un material mas flexible que la madera pero no se pudre en contacto con el agua. Por eso, Challenger combina estos dos materiales para aprovechar las ventajas de los dos materiales.</li>\r\n</ul>\r\n<ul style="list-style-type: none;">\r\n<li style="list-style-type: none;"><strong>Estanqueidad.&nbsp;</strong>Todos los materiales que est&aacute;n en contacto con el exterior son hidr&oacute;fugos. Adem&aacute;s, los perfiles que unen los paneles no estan atornillados, de manera que se evita crerar innecesarios orificios susceptibles de convertirse en futuras filtraciones.</li>\r\n</ul>\r\n<p><strong>Paneles de hasta 6,5cm de grueso con &nbsp;aislamiento de&nbsp;<strong><a href="https://www.youtube.com/watch?v=za6dtClCFcc">ALTA DENSIDAD. (VER POR QUE es el MEJOR SISTEMA CONSTRUCTIVO)</a></strong></strong></p>\r\n<p>&nbsp;</p>\r\n<p>Nota: por su forma especial, el techo de nuestras autocaravanas Capuchinas dispone de una tecnolog&iacute;a espec&iacute;fica.</p>\r\n</div>\r\n</div>'),
(5, '2017-11-03 18:09:57', '2017-11-03 18:11:12', 9, 0, 1, 'Cargol, 40 anys d''ofici i MOLTS CLIENTS SATISFETS!', '', '', '', '', '"Clients satisfets" és el valor afegit més apreciat que pot tenir una empresa, per això, exposem aquestes fotos dels clients amb l''equip de Cargol, com a mostra inequivoca de que fem bé la nostra feina.', '', 'Cargol, 40 anys d''ofici i MOLTS CLIENTS SATISFETS!', NULL, '"Clients satisfets" és el valor afegit més apreciat que pot tenir una empresa, per això, exposem aquestes fotos dels clients amb l''equip de Cargol, com a mostra inequivoca de que fem bé la nostra feina.', NULL),
(6, '2017-11-21 13:27:57', '2017-11-21 13:33:09', 10, 0, 1, 'Queremos estar más cerca de usted', '', '', '', '', '<p>Estamos a su entera disposición para recibir sus comentarios, sugerencias y preguntas. Tanto nuestros comerciales como nuestro personal de oficina y de taller estarán encantados de atenderle.</p>', '', 'Queremos estar más cerca de usted', 'Volem estar més aprop teu', '<p>Estamos a su entera disposición para recibir sus comentarios, sugerencias y preguntas. Tanto nuestros comerciales como nuestro personal de oficina y de taller estarán encantados de atenderle.</p>', '<p>Estem a la seva disposició per rebre els seus comentaris, suggeriments i preguntes. Tant els nostres comercials com el nostre personal d''oficina i de taller estaran encantats d''atendre''l.</p>'),
(8, '2017-11-21 13:35:01', '2017-11-21 13:35:01', 10, 0, 0, '', '', '', '', '', '', '', '', '', '', ''),
(9, '2017-11-22 13:15:16', '2017-11-22 13:27:40', 11, 0, 1, '¡Cargol, 40 años de oficio y MUCHOS CLIENTES SATISFECHOS!', '', '', '', '', '<p>"Clientes satisfechos" es el valor añadido mas apreciado que una empresa puede tener, por eso, exponemos estas fotos de los clientes junto con el equipo de Cargol como muestra inequívoca de que hacemos bién nuestro trabajo.</p>', '', '¡Cargol, 40 años de oficio y MUCHOS CLIENTES SATISFECHOS!', 'Cargol, 40 anys d''ofici i MOLTS CLIENTS SATISFETS!', '<p>"Clientes satisfechos" es el valor añadido mas apreciado que una empresa puede tener, por eso, exponemos estas fotos de los clientes junto con el equipo de Cargol como muestra inequívoca de que hacemos bién nuestro trabajo.</p>', '<p>"Clients satisfets" és el valor afegit més apreciat que pot tenir una empresa, per això, exposem aquestes fotos dels clients amb l''equip de Cargol, com a mostra inequivoca de que fem bé la nostra feina.</p>');

-- --------------------------------------------------------

--
-- Estructura de la taula `producte`
--

CREATE TABLE `producte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `llits` int(11) DEFAULT NULL,
  `seients` int(11) DEFAULT NULL,
  `menjadors` int(11) DEFAULT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `promocio_id` int(11) DEFAULT NULL,
  `en_stock` tinyint(1) DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `motor` varchar(255) DEFAULT NULL,
  `llargada` varchar(255) DEFAULT NULL,
  `distribucio_dia` varchar(255) DEFAULT NULL,
  `distribucio_nit` varchar(255) DEFAULT NULL,
  `descripcio_cat` text,
  `descripcio_esp` text,
  `equipament_cat` text,
  `equipament_esp` text,
  `preu` int(11) DEFAULT NULL,
  `preu_mes` int(11) DEFAULT NULL,
  `estat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Bolcant dades de la taula `producte`
--

INSERT INTO `producte` (`id`, `data_alta`, `data_modificacio`, `posicio`, `llits`, `seients`, `menjadors`, `marca_id`, `promocio_id`, `en_stock`, `referencia`, `motor`, `llargada`, `distribucio_dia`, `distribucio_nit`, `descripcio_cat`, `descripcio_esp`, `equipament_cat`, `equipament_esp`, `preu`, `preu_mes`, `estat_id`) VALUES
(1, '2017-05-20 17:30:39', '2017-11-16 13:04:08', 0, 5, 4, 1, 1, 1, 1, 'MAGEO 378 SPECIAL M-2018', 'Fiat 150 CV', '7,46m', '1507826910.png', '1507826910.png', '<p>Nova versi&oacute; de la &egrave;xitosa 398 &ldquo;llit illa&rdquo;. Aqu&iacute; canvia el sal&oacute; de seients enfrontats, lo que li donen un espai realment c&ograve;mode. Gran disseny de els seients salon, que es transforman en seients de cara a la marxa, independents i de una forma realment agil i rapida. &nbsp;Es tracta de una edici&oacute; limitada &ldquo;Special 40 Aniversary&rdquo;. &nbsp;inclou de serie un equipament molt complet de luxe, essent una distribuci&oacute; de 7,46 m, ens ofereix una amplitut interior enorme en tots els espais: menjador, bany, armaris, garatge i especialment al dormitori que te el llit m&eacute;s ample de totes les autocaravanes &ldquo;1,60mt&rdquo;...En resum, equipament, luxe i espai al m&agrave;xim nivell.Cuina exterior Easy Chef OPCIONAL</p>\r\n<h2><a href="http://www.challenger-autocaravanas.es/perfiladas/378xlb#model">VEURE VISTA 360&ordm;:</a></h2>', '<p>Nueva versi&oacute;n de la exitosa 398 &ldquo;cama isla&rdquo;. Aqu&iacute; cambia el sal&oacute;n de asientos enfrentados, lo que le da un espacio realmente c&oacute;modo. Gran dise&ntilde;o de los asientos sal&oacute;n, que se transforman en asientos de cara a la marcha, independientes de una forma realmente &aacute;gil y r&aacute;pida. Se trata de una edici&oacute;n limitada &ldquo;Special 40 Aniversary&rdquo; . Incluye de serie un equipamiento muy completo y lujoso. Siendo una distribuci&oacute;n de 7,46 m, nos ofrece una amplitud interior enorme en todos los espacios: comedor, ba&ntilde;o, armarios, garaje y especialmente en el dormitorio, ya que tiene la cama mas ancha de todas las autocaravanas &ldquo;1,60CM&rdquo;...En definitiva, equipamiento, lujo y espacio al m&aacute;ximo nivel. Cocina exterior Easy Chef OPCIONAL</p>\r\n<h2><a href="http://www.challenger-autocaravanas.es/perfiladas/378xlb#model">VER VISTA 360&ordm;:</a></h2>', '<h3>Cabina</h3>\r\n<p>Airbag passatger // Regulador de velocitat // Retrovisors el&egrave;ctrics // Multimedia amb radio, USB, MP3, Bluetooth i pantalla t&agrave;ctil // Comandament del multimedia al volant // Llantas Aluminio 16" // C&agrave;mera de visi&oacute; posterior.</p>\r\n<h3>Finestres i portons</h3>\r\n<p>Finestres Seitz integrades al panel // Sostre panor&agrave;mic // Claraboya de 70x40 cm // Claraboya amb ventilador-extractor //&nbsp;Porta de l''habitacle amb finestra integrada // Porta de l''habitacle amb tancament centralitzat // Mosquitera a la porta de l''habitacle //&nbsp;Port&oacute; lateral esquerra de 54x32 cm // Port&oacute; lateral dret de 114x76 cm //&nbsp;&nbsp;Port&oacute; posterior de 70x140 cm.</p>\r\n<h3>Panels</h3>\r\n<p>Gruix de terra de 63 mm //Tecnologia IRP (a&iuml;llament, resist&egrave;ncia i protecci&oacute;) // Sostre, laterals i terra de poli&eacute;ster refor&ccedil;at // A&iuml;llament XPS Stirofoam&nbsp;// Gruix de sostre de 55 mm //&nbsp;7 anys de garantia.</p>\r\n<h3>Habitacle</h3>\r\n<p>Llit fixa posterior "XL Bed" de 160 cm d''ample // Llit fixa amb matal&agrave;s "Thermocool" &nbsp;termoformable // Calefacci&oacute; utilitzable en ruta Diesel // Il&middot;luminaci&oacute; exterior // Il&middot;luminaci&oacute; interior armaris //&nbsp;Frigor&iacute;fic de 140 L autom&agrave;tic // &nbsp;Il&middot;luminaci&oacute; 100% LED // Panels retroiluminats a la cuina, llit i menjador //&nbsp;Technibox //&nbsp;Abertura dels somiers assistida // Regulaci&oacute; d''all&ccedil;ada del llit fixa posterior (Esasy Bed) // Conexi&oacute; 220/12 V al garatge.</p>\r\n<h2><a href="https://www.youtube.com/watch?v=qykrBfgA0S0">VEURE NOU CONCEPTE DE SALO TRANSFORMABLE "Smart Lounge" VEURE VIDEO</a></h2>', '<p><strong>Cabina</strong></p>\r\n<p>Airbag pasajero // Regulador de velocidad // Retrovisores el&eacute;ctricos// Multimedia con radio, USB, MP3, Bluetooth y pantalla t&aacute;ctil // Mandos del multimedia en el volante // Llantes Alumini 16" &nbsp;// C&aacute;mara de visi&oacute;n trasera.</p>\r\n<p><strong>Ventanas y portones</strong></p>\r\n<p>Ventanas Seitz integradas en el panel // Techo panor&aacute;mico // Claraboya de 70x40 cm // Claraboya con ventilador-extractor //Puerta del habit&aacute;culo con ventana integrada&nbsp;// Puerta del habit&aacute;culo con cierre centralizado // Mosquitera en la puerta del habit&aacute;culo //&nbsp;Port&oacute;n lateral izquierdo de 54x32 cm // Port&oacute;n lateral derecho de 114x76 cm //&nbsp;&nbsp;Port&oacute;n trasero de 70x140 cm.</p>\r\n<p><strong>Paneles</strong></p>\r\n<p>Grosor de suelo de 63 mm // Grosor de techo de 55 mm //&nbsp;Tecnologia IRP (Aislamiento, resistencia y protecci&oacute;n) //&nbsp;Techo, laterales y suelo de poli&eacute;ster reforzado // Aislante XPS Stirofoam&nbsp;// &nbsp;7 a&ntilde;os de garantia.</p>\r\n<p><strong>Habit&aacute;culo</strong></p>\r\n<p>Cama fija trasera "XL Bed" de 160 cm de ancho // cama fija con colch&oacute;n "Thermocool" &nbsp;termoformable // Calefacci&oacute;n utilizable en ruta Diesel // Iluminaci&oacute;n exterior // Frigor&iacute;fico de 140 L autom&aacute;tico // Technibox // Iluminaci&oacute;n 100% LED // Paneles retroiluminados en la cocina, cama y comedor // Abertura de los somieres asistida // Iluminaci&oacute;n interior armarios //Regulaci&oacute;n de altura de la cama fija (Esasy Bed) // Conexi&oacute;n 220/12 V en el garaje.</p>\r\n<h2><a href="https://www.youtube.com/watch?v=qykrBfgA0S0">VER NUEVO CONCEPTO DE SALON TRANSFORMABLE "Smart Lounge" VER VIDEO</a></h2>', 0, 0, 1),
(2, '2017-05-29 18:49:08', '2017-11-16 12:41:12', 0, 5, 5, 1, 1, 0, 0, 'MAGEO 387 GA SPECIAL 40 ANIVERSARY M-2018', 'Fiat 150 CV', '7,46 m', '1510679633.png', '', '<p>Generosa autocaravana en tots els sentits, tant en equipament com en amplitut interior. Al tratars-se de un model en gama Mageo inclou de serie un equipament molt complert i lux&oacute;s, essent una distribuci&oacute; de 7,46 m ofreix una amplitud interior enorme en tots els espais: menjador, dormitori, bany, armaris, garatge...En definitiva equipament, luxe i espai al m&agrave;xim nivell.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>EQUIP EDICIO 40 ANIVERSARY</strong></p>\r\n<ul>\r\n<li>Llantas de Aluminio&nbsp; de 16&rdquo;</li>\r\n<li>Suplement motor de 150cv</li>\r\n<li>+ SEGURIDAD: (ESP,&nbsp; TRACTION PLUS + HILL DESCENS )</li>\r\n</ul>', '<p>Generosa autocaravana en todos los sentidos, tanto en equipamiento como en amplitud interior. Al tratarse de un modelo de la gama Mageo incluye de serie un equipamiento muy completo y lujosos, siendo una distribuci&oacute;n de 7,46 m nos ofrece una amplitud interior enorme en todos los espacios: comedor, dormitorio, ba&ntilde;o, armarios, garaje...En definitiva, equipamiento, lujo y espacio al m&aacute;ximo nivel.</p>\r\n<p><strong>EQUIP EDICIO 40 ANIVERSARY</strong></p>\r\n<ul>\r\n<li>Llantas de Aluminio&nbsp; de 16&rdquo;</li>\r\n<li>Suplement motor de 150cv</li>\r\n<li>+ SEGURIDAD: (ESP,&nbsp; TRACTION PLUS + HILL DESCENS )</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>LES FOTOGRAFIES I VIDEO ACTUALS SON DEL MODEL 2017</strong></p>\r\n<p>&nbsp;</p>', '<h3>Cabina</h3>\r\n<p>Airbag passatger // Regulador de velocitat // Retrovisors el&egrave;ctrics// &nbsp;Radio USB MP3 Bluetooth // Enfosquidors de cabina Remis // Pintura exterior.</p>\r\n<h3>Finestres i portons</h3>\r\n<p>Finestres Seitz integrades al panel // Sostre panor&agrave;mic // Claraboya de 70x40 cm // Claraboya amb ventilador-extractor // Porta de l''habitacle amb finestra integrada i doble tanca // Porta de l''habit&agrave;cle amb tancament centralitzat // Mosquitera a la porta de l''habitacle //&nbsp;Port&oacute; lateral esquerra de 90x60 cm // Port&oacute; lateral deret de 100x76 cm // Port&oacute; del darrera de 70x140 cm.</p>\r\n<h3>Panels</h3>\r\n<p>Gruix de terra de 64 mm //&nbsp;Tecnologia IRP (A&iuml;llament, resist&egrave;ncia y protecci&oacute;) // Sostre, laterals i terra de poli&eacute;ster refor&ccedil;at // A&iuml;llant de XPS Stirofoam&nbsp;// Gruix de sostre de 55 mm //&nbsp;7 anys de garantia.//</p>\r\n<h3><a href="http://www.cargolcaravanas.com/ca/noticies/2016/04/20/tecnologia-i-r-p-de-challenger">VEURE RAONAMENTS TECNICS</a></h3>', '<p>Construcci&oacute;n habit&aacute;culo: IRP Poli&eacute;ster</p>\r\n<h3>Cabina</h3>\r\n<p>Airbag pasajero // Regulador de velocidad // Retrovisores el&eacute;ctricos// Radio USB MP3 Bluetooth // Oscurecedores de cabina Remis // Pintura exterior.//</p>\r\n<h3>Ventanas y portones</h3>\r\n<p>Ventanas Seitz integradas en el panel // Techo panor&aacute;mico // Claraboya de 70x40 cm // Claraboya con ventilador-extractor // Puerta de habit&aacute;culo con ventana integrada y doble cierre // Puerta de habitaculo con cierre centralizado // Mosquitera en la puerta del habit&aacute;culo //&nbsp;Port&oacute;n lateral izquierdo 90x60 cm // Port&oacute;n lateral derecho 100x76 cm // Porton trasero 70x140 cm.</p>\r\n<h3>Paneles</h3>\r\n<p>Grosor de suelo 64 mm //&nbsp;Tecnologia IRP (Aislamiento, resistencia y protecci&oacute;n) //&nbsp;Techo, laterales y suelo de poli&eacute;ster reforzado // Aislante XPS Stirofoam&nbsp;// Grosor de techo 55 mm // 7 a&ntilde;os de garantia.</p>\r\n<h3><a href="http://www.cargolcaravanas.com/ca/noticies/2016/04/20/tecnologia-i-r-p-de-challenger">VEURE RAONAMENTS TECNICS</a></h3>\r\n<h3>Habit&aacute;culo</h3>\r\n<p>Calefacci&oacute;n utilizable en ruta Truma Diesel // Calentador de agua Truma Diesel // Colch&oacute;n lujo en cama principal // Iluminaci&oacute;n exterior // Iluminaci&oacute;n interior armarios // &nbsp;Frigor&iacute;fico de 140 L autom&aacute;tico // Technibox // Iluminaci&oacute;n 100% LED // Paneles retroiluminados en la cocina, cama y comedor // Abertura somieres asistida.</p>', 0, 0, 5),
(3, '2017-11-10 18:42:34', '2017-11-18 11:38:24', 0, 0, 0, 0, 0, 0, 0, 'test', 'motor', '', '', '', '', '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `producte_categoria`
--

CREATE TABLE `producte_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `producte_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Bolcant dades de la taula `producte_categoria`
--

INSERT INTO `producte_categoria` (`id`, `data_alta`, `data_modificacio`, `producte_id`, `categoria_id`, `posicio`) VALUES
(72, '2017-11-16 13:04:08', '2017-11-16 13:04:08', 1, 3, 0),
(70, '2017-11-16 12:41:12', '2017-11-16 12:41:12', 2, 3, 0),
(69, '2017-11-16 12:41:12', '2017-11-16 12:41:12', 2, 2, 0),
(71, '2017-11-16 13:04:08', '2017-11-16 13:04:08', 1, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `producte_estat`
--

CREATE TABLE `producte_estat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `producte_id` int(11) DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `nom_cat` varchar(50) DEFAULT NULL,
  `nom_esp` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Bolcant dades de la taula `producte_estat`
--

INSERT INTO `producte_estat` (`id`, `data_alta`, `data_modificacio`, `producte_id`, `posicio`, `token`, `nom`, `nom_cat`, `nom_esp`) VALUES
(1, NULL, NULL, NULL, NULL, 'disponible', 'Disponible', 'Disponible', 'Disponible'),
(2, NULL, NULL, NULL, NULL, 'ultimas', '¡Ultimas unidades!', 'Últimes unitats!', '¡Ultimas unidades!'),
(3, NULL, NULL, NULL, NULL, 'prereserva', 'Pre-Reservada', 'Pre-Reservada', 'Pre-Reservada'),
(4, NULL, NULL, NULL, NULL, 'agotadas', 'Vendida', 'Venuda', 'Vendida'),
(5, NULL, NULL, NULL, NULL, 'proximament', 'Pròximament', 'Pròximament', 'Próximamente');

-- --------------------------------------------------------

--
-- Estructura de la taula `producte_galeria`
--

CREATE TABLE `producte_galeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `producte_id` int(11) DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `copy` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Bolcant dades de la taula `producte_galeria`
--

INSERT INTO `producte_galeria` (`id`, `data_alta`, `data_modificacio`, `producte_id`, `posicio`, `nom`, `copy`, `foto`) VALUES
(17, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(15, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(16, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(52, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 2, '', '', '1511001462.png'),
(18, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(19, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(20, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(21, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(22, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(23, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(24, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(25, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(26, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(27, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(28, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(29, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(30, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(31, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(32, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(33, '2017-11-14 17:09:45', '2017-11-16 13:04:08', 1, 0, '', '', '1510675785.jpg'),
(35, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(36, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(37, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(38, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(39, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(40, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(41, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(42, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(43, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(44, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(45, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(46, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(47, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(48, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(49, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(50, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(51, '2017-11-14 18:13:53', '2017-11-16 12:41:12', 2, 0, '', '', '1510679633.jpg'),
(53, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 3, '', '', '1511001462.png'),
(54, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 1, '', '', '1511001462.jpg'),
(55, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 4, '', '', '1511001462.jpg'),
(56, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 5, '', '', '1511001462.jpg'),
(57, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 6, '', '', '1511001462.jpg'),
(58, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 7, '', '', '1511001462.jpg'),
(59, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 8, '', '', '1511001462.jpg'),
(60, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 9, '', '', '1511001462.jpg'),
(61, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 10, '', '', '1511001462.jpg'),
(62, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 11, '', '', '1511001462.jpg'),
(63, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 12, '', '', '1511001462.jpg'),
(64, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 13, '', '', '1511001462.jpg'),
(65, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 14, '', '', '1511001462.jpg'),
(66, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 15, '', '', '1511001462.jpg'),
(67, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 16, '', '', '1511001462.jpg'),
(68, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 17, '', '', '1511001462.jpg'),
(69, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 18, '', '', '1511001462.jpg'),
(70, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 19, '', '', '1511001462.jpg'),
(71, '2017-11-18 11:37:42', '2017-11-18 12:01:35', 3, 20, '', '', '1511001462.jpg');

-- --------------------------------------------------------

--
-- Estructura de la taula `producte_marca`
--

CREATE TABLE `producte_marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `producte_id` int(11) DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Bolcant dades de la taula `producte_marca`
--

INSERT INTO `producte_marca` (`id`, `data_alta`, `data_modificacio`, `producte_id`, `posicio`, `nom`, `logo`) VALUES
(1, '2017-05-20 17:28:19', '2017-10-12 18:55:46', 0, 0, 'Challenger', '1507827346.png'),
(2, '2017-10-12 18:56:09', '2017-10-12 18:56:09', NULL, 0, 'Caravelair', '1507827369.png'),
(3, '2017-10-12 18:56:44', '2017-10-12 18:56:44', NULL, 0, 'Rapido', '1507827404.png'),
(4, '2017-10-12 18:58:03', '2017-10-12 18:58:03', NULL, 0, 'Burstner', '1507827483.png'),
(5, '2017-10-12 18:58:50', '2017-10-12 18:58:50', NULL, 0, 'Silver', '1507827530.png');

-- --------------------------------------------------------

--
-- Estructura de la taula `producte_promocio`
--

CREATE TABLE `producte_promocio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `nom_esp` varchar(255) DEFAULT NULL,
  `nom_cat` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Bolcant dades de la taula `producte_promocio`
--

INSERT INTO `producte_promocio` (`id`, `data_alta`, `data_modificacio`, `posicio`, `nom_esp`, `nom_cat`, `foto`) VALUES
(1, '2017-11-16 12:23:12', '2017-11-16 12:23:12', 0, '40 aniversario', '40 aniversari', '');



--
-- Estructura de la taula `financament`
--

CREATE TABLE `financament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_alta` datetime DEFAULT NULL,
  `data_modificacio` datetime DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `posicio` int(11) DEFAULT NULL,
  `nom_cat` varchar(255) DEFAULT NULL,
  `nom_esp` varchar(255) DEFAULT NULL,
  `coef` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Bolcant dades de la taula `financament`
--

INSERT INTO `financament` (`id`, `data_alta`, `data_modificacio`, `numero`, `posicio`, `nom_cat`, `nom_esp`, `coef`) VALUES
(1, '2017-12-04 18:04:13', '2017-12-04 18:05:27', 48, 0, '48 Mesos', '48 Meses', '0.0246639'),
(2, '2017-12-04 18:04:13', '2017-12-04 18:05:27', 60, 1, '60 Mesos', '60 Meses', '0.0202009'),
(3, '2017-12-04 18:04:13', '2017-12-04 18:05:27', 72, 2, '72 Mesos', '72 Meses', '0.0172308'),
(4, '2017-12-04 18:04:14', '2017-12-04 18:05:27', 84, 3, '84 Mesos', '84 Meses', '0.0151111'),
(5, '2017-12-04 18:04:14', '2017-12-04 18:05:27', 96, 4, '96 Mesos', '96 Meses', '0.0135337');
