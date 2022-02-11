-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2022 a las 13:41:47
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyfin`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

CREATE TABLE `anuncio` (
  `idanu` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `texto` varchar(2000) DEFAULT NULL,
  `precio` varchar(100) DEFAULT NULL,
  `fotoanu` varchar(2000) DEFAULT NULL,
  `fecha` varchar(100) NOT NULL DEFAULT current_timestamp(),
  `categoria` varchar(200) NOT NULL,
  `idanunciante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `anuncio`
--

INSERT INTO `anuncio` (`idanu`, `titulo`, `texto`, `precio`, `fotoanu`, `fecha`, `categoria`, `idanunciante`) VALUES
(3, 'Vendo Bandera del atleti', 'mu flama', '21', 'http://localhost/EL_TRABAJAZO/backend/images/SIN-IMAGEN.jpg', '2021-07-12 19:11:14', 'Decoración', 3),
(34, 'Vendo seat ibiza blanco', 'Un sear blanco', '022', 'http://localhost/EL_TRABAJAZO/backend/images/p-9-1640703565.jpg', '2021-07-14 17:24:12', 'Vehiculo', 4),
(35, 'En el guerra como en el amor', 'Todo vale y siempre queda un perdedor, normalmente pierde el que quiere más', 'al igual que en una mesa de blackjack', 'http://localhost/EL_TRABAJAZO/backend/images/SIN-IMAGEN.jpg', '2021-07-14 18:18:45', 'Otros', 13),
(36, 'Vendo yogures', 'Azules y amarillos', '323', 'http://localhost/EL_TRABAJAZO/backend/images/SIN-IMAGEN.jpg', '2021-08-09 15:57:57', 'Alimentacion', 4),
(37, 'Se alquila cantinplora', 'Tengo una cantimplora que no uso y no me importaría alquilársela a alguien.', 'mes/50', 'http://localhost/EL_TRABAJAZO/backend/images/p-4-1615701833.jpg', '2021-08-11 16:29:59', 'Alimentacion', 4),
(38, 'Se alquila piso', 'En madrid ', '10000000000000', 'http://localhost/EL_TRABAJAZO/backend/images/p-9-1640703565.jpg', '2021-08-16 09:13:44', 'Decoracion', 13),
(46, 'Vendo ordenador', 'Componentes:\n-i3\n-8gb ram', '2000', 'http://localhost/EL_TRABAJAZO/backend/images/SIN-IMAGEN.jpg', '2021-12-13 09:44:35', 'Electronica', 13),
(54, 'foto3', '1', '1', 'http://localhost/EL_TRABAJAZO/backend/images/p-4-1615701833.jpg', '2022-01-10 19:26:24', 'Otros', 3),
(69, 'Fotaza', 'fotaza', '10', 'http://localhost/EL_TRABAJAZO/backend/images/SIN-IMAGEN.jpg', '2022-01-11 13:00:49', 'Otros', 4),
(79, 'Vendo cajas de cartón', 'Cajas acartonadas, color cartón, con un ligero aroma a cartón y con un sabor y textura propias de los mejores cartones de la Península Ibérica.', 'Unidad/0,3', 'http://localhost/EL_TRABAJAZO/backend/images/cartonoso.jpg', '2022-01-14 17:09:18', 'Decoracion', 5),
(80, 'Vendo Xbox', 'No se enciendo, pero es bonita.', '30,43', 'http://localhost/EL_TRABAJAZO/backend/images/SIN-IMAGEN.jpg', '2022-01-25 16:27:28', 'Electronica', 5),
(82, 'Vendo alimento', 'si', '1', 'http://localhost/EL_TRABAJAZO/backend/images/SIN-IMAGEN.jpg', '2022-02-01 15:38:27', 'Alimentacion', 3),
(83, 'Vendo móviles ', 'Móviles con un dibujo de una pera por detrás.', '300', 'http://localhost/EL_TRABAJAZO/backend/images/SIN-IMAGEN.jpg', '2022-02-04 15:46:29', 'Electronica', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(2000) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `poblacion` varchar(2000) DEFAULT NULL,
  `provincia` varchar(2000) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `foto` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `password`, `poblacion`, `provincia`, `email`, `telefono`, `foto`) VALUES
(3, 'Ivan', 'a', '$2y$10$GcxE/fRj1ZHFerQZNSd6W.CyqYH.Zl3GGf6Yfi4tN2zCdO4KD0N5i', 'Alc', 'Ciud', 'iva@ho', '31221312', 'http://localhost/proyfin/images/p-3-1615692525.jpg'),
(4, 'Daniel', 'abe', '$2y$10$NZLtyuGB9clyrIe3SbEdRuJGmr5KUqUf1kNtWWJncVg3YbTdh82Aq', 'Alc', 'Ciud', 'a@aa', '31221312', 'http://localhost/EL_TRABAJAZO/backend/images/p-4-1642177431.jpg'),
(5, 'Jorge', 'leal', '$2y$10$TLdm8apj0DSNi7wpavo/p.vKnyJEUam8zpFxgJZRC/fTeyzgOCOtO', 'crip', 'Ciud', 'b@bb', '123', 'http://localhost/proyfin/images/p-5-1626109786.jpg'),
(8, '3', 'e', '$2y$10$the9Vt/KcYBUxXYId2gdKOlfRStYgTn.XvBd7m/neCUn6ma8oYnR6', 'e', 'e', 'e@ee', '31221312', NULL),
(9, '1', '2', '$2y$10$l0zV/S9kyHwRJM8edkIZsu1eWkTqH8O.V1HlcBlHBLKPG6yhAauYO', 'ewq', 'ewq', 'a@aaa', '31221312', 'http://localhost/proyfin/images/p-9-1640703565.jpg'),
(10, '¨sd&%', 'ewq', '$2y$10$SywU/Dbc8PO56z1PIgqAb.9TJNc1UW4M1CufCRN9.CUiu.HWtjhQq', 'e', 'e', 'e@asd', '11', NULL),
(11, 'e', 'e', '$2y$10$jpUP9x.QubjLn.NShuRc/erhxjj9GUrI/UAeDL6TObfutpguMT0lm', 'e', 'e', 'e@e', NULL, NULL),
(13, 'Javi', 'Delegao', '$2y$10$LYPsrIxoqEoBCUK.N5izhOXDKSdVGpBbXgNEu9N8ZyLmKmsxIqFoi', 'Villafranca', 'España', 'd@dd', '31221312', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`idanu`),
  ADD KEY `idanunciante` (`idanunciante`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `idanu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `anuncio_ibfk_1` FOREIGN KEY (`idanunciante`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
