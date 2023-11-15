-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 10-11-2023 a les 17:53:05
-- Versió del servidor: 10.4.28-MariaDB
-- Versió de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `padel`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `administradores`
--

INSERT INTO `administradores` (`id`, `name`, `password`) VALUES
(4848, 'Joel', '0000');

-- --------------------------------------------------------

--
-- Estructura de la taula `pistas`
--

CREATE TABLE `pistas` (
  `ID_pista` varchar(8) NOT NULL,
  `condicion` varchar(50) NOT NULL,
  `Precio_por_hora` decimal(10,2) DEFAULT NULL,
  `activa` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `pistas`
--

INSERT INTO `pistas` (`ID_pista`, `condicion`, `Precio_por_hora`, `activa`) VALUES
('AR332', 'Renovada', 50.00, 1),
('IUT47', 'Reservada', 10.00, 0),
('LAG54', 'Nueva', 15.50, 1),
('WW211', 'En construccion', 25.00, 1),
('XD888', 'Clausurada', 15.32, 0),
('ZZA21', 'Nueva', 20.00, 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `Fecha` varchar(50) NOT NULL,
  `horaInicio` varchar(5) NOT NULL,
  `horaFin` varchar(5) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `ID_pista` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `Fecha`, `horaInicio`, `horaFin`, `dni`, `ID_pista`) VALUES
(1, 'dt. d’oct. 31 CET 2023', '09:00', '10:00', '4821876H', 'AR332'),
(8, 'dv. de nov. 10 CET 2023', '09:00', '13:00', '48218611P', 'XD888');

-- --------------------------------------------------------

--
-- Estructura de la taula `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(9) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Apellidos` varchar(255) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `usuarios`
--

INSERT INTO `usuarios` (`id`, `Email`, `Nombre`, `Apellidos`, `password`, `active`) VALUES
('0', '0', 'Usu', 'Test', '0', 1),
('48218611P', 'joelgurrera@gmail.com', 'tUS', 'MUERTOPS', '0000', 1),
('4821876H', 'caludioCarrion@gmail.com', 'Claudio', 'Carrion', '0000', 0);

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `pistas`
--
ALTER TABLE `pistas`
  ADD PRIMARY KEY (`ID_pista`);

--
-- Índexs per a la taula `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `dni` (`dni`),
  ADD KEY `reservas_id_pista` (`ID_pista`);

--
-- Índexs per a la taula `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4849;

--
-- AUTO_INCREMENT per la taula `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reservas_id_pista` FOREIGN KEY (`ID_pista`) REFERENCES `pistas` (`ID_pista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
