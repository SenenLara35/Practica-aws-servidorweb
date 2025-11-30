-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 30-11-2025 a las 14:07:14
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arquetipo`
--

CREATE TABLE `arquetipo` (
  `id_arquetipo` int(11) NOT NULL,
  `nombre_arquetipo` varchar(100) NOT NULL,
  `url_imagen_mini` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `arquetipo`
--

INSERT INTO `arquetipo` (`id_arquetipo`, `nombre_arquetipo`, `url_imagen_mini`) VALUES
(21, 'Mega Absol Box', 'absolbox.png'),
(22, 'Alakazam Powerful Hand', 'alakazam.png'),
(23, 'Ceruledge', 'ceruledge.png'),
(24, 'Charizard ex', 'charizard.png'),
(25, 'Crustle Mysterious Rock Inn', 'crustle.png'),
(26, 'Dragapult ex', 'dragapult.png'),
(27, 'Farigiraf ex', 'farigiraf.png'),
(28, 'Flareon ex', 'flareon.png'),
(29, 'Gardevoir', 'gardevoir.png'),
(30, 'Gholdengo ex', 'gholdengo.png'),
(31, 'Marnie\'s Grimmsnarl ex', 'grimmsnarl.png'),
(32, 'Joltik Box', 'joltikbox.png'),
(33, 'Mega Kangaskan ex', 'kangaskhan-mega.png'),
(34, 'Pidgeot Control', 'pidgeot.png'),
(35, 'Raging Bolt', 'raging-bolt.png'),
(36, 'Ethan\'s Typhlosion', 'typhlosion.png'),
(37, 'N\'s Zoroark ex', 'zoroark.png'),
(38, 'Froslass Munkidori', 'frosmunki.png'),
(39, 'Ogerpon Box', 'ogerponbox.png'),
(40, 'Tera Box', 'terabox.png'),
(42, 'Slowking', 'slowking.png'),
(43, 'Hydreigon', 'hydreigon.png'),
(44, 'Roaring Moon', 'roaring-moon.png'),
(45, 'Great Tusk Mill', 'great-tusk.png'),
(47, 'Mew Vmax', 'mew.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id_inscripcion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_torneo` int(11) NOT NULL,
  `id_mazo_registrado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id_inscripcion`, `id_usuario`, `id_torneo`, `id_mazo_registrado`) VALUES
(5, 1, 1, 3),
(6, 1, 4, 1),
(7, 3, 4, 4),
(8, 5, 1, 7),
(9, 5, 4, 7),
(10, 6, 4, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mazo`
--

CREATE TABLE `mazo` (
  `id_mazo` int(11) NOT NULL,
  `id_propietario` int(11) NOT NULL,
  `id_arquetipo` int(11) DEFAULT NULL,
  `nombre_mazo` varchar(100) DEFAULT NULL,
  `lista_completa` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mazo`
--

INSERT INTO `mazo` (`id_mazo`, `id_propietario`, `id_arquetipo`, `nombre_mazo`, `lista_completa`) VALUES
(1, 1, 37, 'Zoroark Piper Lepine Gdansk 2025', 'Pokémon: 19\r\n4 N\'s Zorua JTG 97\r\n4 N\'s Zoroark ex JTG 98\r\n2 N\'s Darumaka JTG 26\r\n1 N\'s Darmanitan JTG 27\r\n2 Munkidori TWM 95\r\n2 N\'s Reshiram JTG 116\r\n1 Yveltal MEG 88\r\n1 Pecharunt ex SFA 39\r\n1 Okidogi ex SFA 36\r\n1 Fezandipiti ex SFA 38\r\n\r\nTrainer: 34\r\n3 Boss\'s Orders MEG 114\r\n3 Cyrano SSP 170\r\n3 Iono PAL 185\r\n2 Professor Turo\'s Scenario PAR 171\r\n2 Lillie\'s Determination MEG 119\r\n1 Hilda WHT 84\r\n4 Buddy-Buddy Poffin TEF 144\r\n2 Counter Catcher PAR 160\r\n2 Night Stretcher SFA 61\r\n2 N\'s PP Up JTG 153\r\n1 Nest Ball SVI 181\r\n1 Super Rod PAL 188\r\n1 Energy Switch MEG 115\r\n1 Pal Pad SVI 182\r\n1 Secret Box TWM 163\r\n1 Air Balloon BLK 79\r\n1 Binding Mochi PRE 95\r\n2 Artazon PAL 171\r\n1 Team Rocket\'s Watchtower DRI 180\r\n\r\nEnergy: 7\r\n6 Darkness Energy SVE 23\r\n1 Reversal Energy PAL 192'),
(2, 2, 28, 'Furromazo', 'Pokémon: 22\r\n4 Hoothoot SCR 114\r\n4 Noctowl SCR 115\r\n1 Eevee SSP 143\r\n1 Eevee ex PRE 75\r\n2 Flareon ex PRE 14\r\n1 Leafeon ex PRE 6\r\n2 Fan Rotom SCR 118\r\n1 Pidgey MEW 16\r\n1 Pidgeot ex OBF 164\r\n1 Wellspring Mask Ogerpon ex TWM 64\r\n1 Terapagos ex SCR 128\r\n1 Bloodmoon Ursaluna ex TWM 141\r\n1 Fezandipiti ex SFA 38\r\n1 Latias ex SSP 76\r\n\r\nTrainer: 30\r\n2 Crispin SCR 133\r\n2 Boss\'s Orders MEG 114\r\n1 Iono PAL 185\r\n1 Cyrano SSP 170\r\n1 Hilda WHT 84\r\n1 Briar SCR 132\r\n1 Black Belt\'s Training JTG 145\r\n4 Nest Ball SVI 181\r\n3 Buddy-Buddy Poffin TEF 144\r\n3 Ultra Ball MEG 131\r\n2 Night Stretcher SFA 61\r\n1 Tera Orb SSP 189\r\n1 Rare Candy MEG 125\r\n1 Counter Catcher PAR 160\r\n1 Glass Trumpet SCR 135\r\n1 Energy Switch MEG 115\r\n1 Sparkling Crystal SCR 142\r\n2 Area Zero Underdepths SCR 131\r\n1 Gravity Mountain SSP 177\r\n\r\nEnergy: 8\r\n2 Jet Energy PAL 190\r\n2 Fire Energy SVE 18\r\n2 Water Energy SVE 19\r\n1 Lightning Energy SVE 20\r\n1 Grass Energy SVE 17'),
(3, 1, 24, 'Charizard EX con Klefki', 'Pokémon: 20\r\n3 Charmander PAF 7\r\n1 Charmeleon PFL 12\r\n1 Charmeleon PAF 8\r\n2 Charizard ex OBF 125\r\n2 Duskull PRE 35\r\n1 Dusclops PRE 36\r\n1 Dusknoir PRE 37\r\n1 Pidgey MEW 16\r\n1 Pidgey OBF 162\r\n1 Pidgeotto OBF 163\r\n2 Pidgeot ex OBF 164\r\n1 Tatsugiri TWM 131\r\n1 Chi-Yu PAR 29\r\n1 Fezandipiti ex SFA 38\r\n1 Klefki SVI 96\r\n\r\nTrainer: 32\r\n4 Lillie\'s Determination MEG 119\r\n3 Arven OBF 186\r\n2 Iono PAL 185\r\n2 Boss\'s Orders MEG 114\r\n1 Briar SCR 132\r\n4 Buddy-Buddy Poffin TEF 144\r\n4 Ultra Ball MEG 131\r\n3 Rare Candy MEG 125\r\n2 Super Rod PAL 188\r\n1 Counter Catcher PAR 160\r\n1 Blowtorch PFL 86\r\n2 Technical Machine: Evolution PAR 178\r\n1 Maximum Belt TEF 154\r\n2 Artazon PAL 171\r\n\r\nEnergy: 8\r\n5 Fire Energy SVE 18\r\n3 Jet Energy PAL 190'),
(4, 3, 47, 'Mew VMax', 'Pokémon: 15\r\n4 Mew V FST 113\r\n3 Mew VMAX FST 114\r\n4 Genesect V FST 185\r\n1 Oricorio FST 42\r\n1 Marshadow UNB 81\r\n1 Seismitoad-EX FFI 20\r\n1 Sudowoodo GRI 66\r\n\r\nTrainer: 41\r\n1 Guzma BUS 115\r\n1 Pokémon Ranger STS 104\r\n1 Wally ROS 94\r\n1 Marnie SSH 169\r\n1 N FCO 105\r\n1 Plumeria BUS 120\r\n4 Battle VIP Pass FST 225\r\n4 Quick Ball FST 237\r\n4 Ultra Ball SVI 196\r\n4 Trainers\' Mail ROS 92\r\n4 Power Tablet FST 236\r\n2 Escape Rope BST 125\r\n2 Field Blower GRI 125\r\n2 VS Seeker PHF 109\r\n1 Lost Vacuum LOR 162\r\n1 Battle Compressor PHF 92\r\n1 Unfair Stamp TWM 165\r\n2 Muscle Band XY 121\r\n1 Forest Seal Stone SIT 156\r\n3 Path to the Peak CRE 148\r\n\r\nEnergy: 4\r\n4 Double Colorless Energy SUM 136'),
(6, 4, 24, 'hola', '4 pikachu'),
(7, 5, 44, 'mazo rexulon', 'DIablo, duende, montapuercas'),
(8, 6, 34, 'Mazo RS6', 'Frost\r\nIQ\r\nAshe\r\nCaveira\r\nHibana\r\nTwitch\r\nPulse\r\nSmoke');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id_partida` int(11) NOT NULL,
  `id_torneo` int(11) NOT NULL,
  `ronda` int(11) NOT NULL DEFAULT 1,
  `id_usuario_1` int(11) NOT NULL,
  `id_mazo_1` int(11) NOT NULL,
  `id_usuario_2` int(11) NOT NULL,
  `id_mazo_2` int(11) NOT NULL,
  `resultado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id_partida`, `id_torneo`, `ronda`, `id_usuario_1`, `id_mazo_1`, `id_usuario_2`, `id_mazo_2`, `resultado`) VALUES
(2, 4, 1, 3, 4, 1, 1, '1-2'),
(3, 1, 1, 5, 7, 1, 3, '0-2'),
(4, 4, 1, 6, 8, 5, 7, '2-0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo`
--

CREATE TABLE `torneo` (
  `id_torneo` int(11) NOT NULL,
  `id_creador` int(11) NOT NULL,
  `nombre_torneo` varchar(150) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `torneo`
--

INSERT INTO `torneo` (`id_torneo`, `id_creador`, `nombre_torneo`, `fecha`) VALUES
(1, 1, 'Torneo de Noviembre!', '2025-11-21'),
(4, 1, 'Copa regional Granada', '2025-11-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `NomUsuario` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('usuario','admin','organizador') NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `NomUsuario`, `email`, `contrasena`, `rol`) VALUES
(1, 'Sennanya', 'senenlara35@gmail.com', '1234', 'admin'),
(2, 'schww', 'cristiobal@hotmail.com', '1234', 'usuario'),
(3, 'Nertomar', 'nerenavagar@gmail.com', '1234', 'usuario'),
(4, 'schw', 'cr7@gmail.com', '12345', 'usuario'),
(5, 'ñectorin', 'pepe@gmail.com', '1234', 'usuario'),
(6, 'MabePein', 'mabepein@gmail.com', 'mabepein', 'usuario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arquetipo`
--
ALTER TABLE `arquetipo`
  ADD PRIMARY KEY (`id_arquetipo`),
  ADD UNIQUE KEY `nombre_arquetipo` (`nombre_arquetipo`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD UNIQUE KEY `uq_usuario_torneo` (`id_usuario`,`id_torneo`),
  ADD KEY `id_torneo` (`id_torneo`),
  ADD KEY `id_mazo_registrado` (`id_mazo_registrado`);

--
-- Indices de la tabla `mazo`
--
ALTER TABLE `mazo`
  ADD PRIMARY KEY (`id_mazo`),
  ADD KEY `id_propietario` (`id_propietario`),
  ADD KEY `id_arquetipo` (`id_arquetipo`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id_partida`),
  ADD KEY `id_torneo` (`id_torneo`),
  ADD KEY `id_usuario_1` (`id_usuario_1`),
  ADD KEY `id_usuario_2` (`id_usuario_2`),
  ADD KEY `id_mazo_1` (`id_mazo_1`),
  ADD KEY `id_mazo_2` (`id_mazo_2`);

--
-- Indices de la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`id_torneo`),
  ADD KEY `id_creador` (`id_creador`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arquetipo`
--
ALTER TABLE `arquetipo`
  MODIFY `id_arquetipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `mazo`
--
ALTER TABLE `mazo`
  MODIFY `id_mazo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
  MODIFY `id_torneo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_2` FOREIGN KEY (`id_torneo`) REFERENCES `torneo` (`id_torneo`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscripcion_ibfk_3` FOREIGN KEY (`id_mazo_registrado`) REFERENCES `mazo` (`id_mazo`);

--
-- Filtros para la tabla `mazo`
--
ALTER TABLE `mazo`
  ADD CONSTRAINT `mazo_ibfk_1` FOREIGN KEY (`id_propietario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `mazo_ibfk_2` FOREIGN KEY (`id_arquetipo`) REFERENCES `arquetipo` (`id_arquetipo`) ON DELETE SET NULL;

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`id_torneo`) REFERENCES `torneo` (`id_torneo`),
  ADD CONSTRAINT `partida_ibfk_2` FOREIGN KEY (`id_usuario_1`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `partida_ibfk_3` FOREIGN KEY (`id_usuario_2`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `partida_ibfk_4` FOREIGN KEY (`id_mazo_1`) REFERENCES `mazo` (`id_mazo`),
  ADD CONSTRAINT `partida_ibfk_5` FOREIGN KEY (`id_mazo_2`) REFERENCES `mazo` (`id_mazo`);

--
-- Filtros para la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD CONSTRAINT `torneo_ibfk_1` FOREIGN KEY (`id_creador`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
