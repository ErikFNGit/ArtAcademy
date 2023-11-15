-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 26-09-2023 a les 13:43:10
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
-- Base de dades: `artacademy`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `curso`
--

CREATE TABLE `curso` (
  `code` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `sDate` date DEFAULT NULL,
  `eDate` date DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `curso`
--

INSERT INTO `curso` (`code`, `name`, `description`, `hours`, `sDate`, `eDate`, `teacher_id`, `active`) VALUES
(1, 'Pruebas', 'Algo', 40, '2023-09-21', '2023-09-28', 1234, NULL),
(2, 'Prueba 101', 'Algo pa llenar', 40, '2023-09-21', '2023-09-28', 1234, NULL),
(3, 'Algo', 'Algo', 5, '2023-09-21', '2023-09-28', 12345, NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `datosadministrador`
--

CREATE TABLE `datosadministrador` (
  `id` varchar(255) NOT NULL,
  `adminUser` varchar(255) DEFAULT NULL,
  `adminPass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `matricula`
--

CREATE TABLE `matricula` (
  `student_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `socre` decimal(2,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `dni` varchar(9) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `stPass` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `curso_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `teachers`
--

INSERT INTO `teachers` (`id`, `dni`, `name`, `surname`, `password`, `title`, `picture`, `active`, `curso_id`) VALUES
(123, 'Olga', 'Olga', 'Olga', '9e65caeb5b8ef0b2d33e500b0be43bb2', 'Olga', '', 1, 0),
(1234, '123456789', 'Joel', 'Gurrera', '7815696ecbf1c96e6894b779456d330e', 'Algo', '', 1, 0),
(12345, '53828890N', 'Erikaaaa', 'Fernandez', 'erikfn', 'Algoll', '', 1, 0),
(84956, '486840', 'asd', 'asda', 'ec02c59dee6faaca3189bace969c22d3', 'asdasdasd', 'img/1695382597LnRrYf6e_400x400.jpg', 1, 0),
(123456, '132645789', 'Marina', 'Marina', 'ce5225d01c39d2567bc229501d9e610d', 'Marina', '', 1, 0),
(123456789, '546879132', 'asdasd', 'asdasd', 'a8f5f167f44f4964e6c998dee827110c', 'asdasd', '', 1, 0);

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`code`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Índexs per a la taula `datosadministrador`
--
ALTER TABLE `datosadministrador`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`student_id`,`curso_id`),
  ADD KEY `curso_id` (`curso_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Índexs per a la taula `students`
--
-- ALTER TABLE `students`
--  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `curso`
--
ALTER TABLE `curso`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);

--
-- Restriccions per a la taula `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
