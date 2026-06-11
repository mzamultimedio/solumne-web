-- phpMyAdmin SQL Dump
-- version 5.2.3deb1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2025 a las 07:42:38
-- Versión del servidor: 11.8.3-MariaDB-1+b1 from Debian
-- Versión de PHP: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `solumne_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1763061463),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1763061463;', 1763061463),
('laravel-cache-admin@solumne.com|190.172.50.167', 'i:3;', 1763036902),
('laravel-cache-admin@solumne.com|190.172.50.167:timer', 'i:1763036902;', 1763036902),
('laravel-cache-joanachaves39@gmail.com|2802:8013:b2c5:ff00:26ff:dac2:e086:167f', 'i:1;', 1763037246),
('laravel-cache-joanachaves39@gmail.com|2802:8013:b2c5:ff00:26ff:dac2:e086:167f:timer', 'i:1763037246;', 1763037246),
('laravel-cache-juanabalo@abc.gob.ar|2a09:bac3:9d:1c96::2d9:50', 'i:2;', 1762531570),
('laravel-cache-juanabalo@abc.gob.ar|2a09:bac3:9d:1c96::2d9:50:timer', 'i:1762531570;', 1762531570),
('laravel-cache-livewire-rate-limiter:3bc184f664654652ea2804f4814f43c36326d128', 'i:1;', 1762616224),
('laravel-cache-livewire-rate-limiter:3bc184f664654652ea2804f4814f43c36326d128:timer', 'i:1762616224;', 1762616224),
('laravel-cache-livewire-rate-limiter:555df0c256e05eb02cb82b200712919c3a941d4d', 'i:1;', 1762520356),
('laravel-cache-livewire-rate-limiter:555df0c256e05eb02cb82b200712919c3a941d4d:timer', 'i:1762520356;', 1762520356),
('laravel-cache-livewire-rate-limiter:887f6ae37b5578a997b6998ee86901016c038e9e', 'i:3;', 1763059606),
('laravel-cache-livewire-rate-limiter:887f6ae37b5578a997b6998ee86901016c038e9e:timer', 'i:1763059606;', 1763059606),
('laravel-cache-livewire-rate-limiter:f288cd7dd88626f2e8fb63e2edd4266d1feffc6b', 'i:1;', 1762777249),
('laravel-cache-livewire-rate-limiter:f288cd7dd88626f2e8fb63e2edd4266d1feffc6b:timer', 'i:1762777249;', 1762777249),
('laravel-cache-mariajoseanglat@gmail.com|190.172.17.191', 'i:1;', 1762521292),
('laravel-cache-mariajoseanglat@gmail.com|190.172.17.191:timer', 'i:1762521292;', 1762521292),
('laravel-cache-mariajoseanglat@gmail.com|2802:8013:b231:6800:c0cc:592:b34b:7408', 'i:2;', 1762520310),
('laravel-cache-mariajoseanglat@gmail.com|2802:8013:b231:6800:c0cc:592:b34b:7408:timer', 'i:1762520310;', 1762520310);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `title`, `slug`, `description`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'ASESOR POLITICO', 'asesor-politico', 'Destacate en el ámbito politico', 'cursos/01K9ZA1TXM1W1RAZK50R2VYSXC.png', '2025-10-04 01:40:11', '2025-11-13 22:11:06'),
(2, 'CONSULTOR', 'consultor', 'PRUEBA', NULL, '2025-10-08 19:02:49', '2025-10-08 19:02:49'),
(3, 'LENGUA DE SEÑAS NIVEL 1- GRUP0 68', 'lengua-de-senas-nivel-1-grup0-68', '¡Aprendamos juntos en este camino a la inclusión!', 'cursos/kq1cAosuza95zBP7BmtmHsWoROd6ZfMu9TcOdt0L.jpg', '2025-10-13 13:00:54', '2025-10-13 13:01:05'),
(4, 'LENGUA DE SEÑAS NIVEL 1- GRUPO 71', 'lengua-de-senas-nivel-1-grupo-71', '¡Bienvenidos a este nivel 11', 'cursos/ffqAz5UWjThc8mTw9ZoiUsNjFC22nwtyJrp8Azz9.jpg', '2025-10-13 14:16:45', '2025-10-13 14:16:45'),
(5, 'LENGUA DE SEÑAS NOV', 'lengua-de-senas-nov', '¡Bienvenidos a nuestro curso de lengua de señas!', 'cursos/01K9A0A8DN5RNXNG86PM4JK41V.jpeg', '2025-11-05 15:36:53', '2025-11-05 15:36:53'),
(6, 'LENGUA DE SEÑAS 2- 69', 'lengua-de-senas-2-69', '¡Felicidades por este segundo nivel! Muchas gracias por continuar y bienvenidos a esta nueva etapa de aprendizaje.', NULL, '2025-11-06 16:19:17', '2025-11-06 16:47:34'),
(7, 'LENGUA DE SEÑAS 3- 70', 'lengua-de-senas-3-70', '¡Bienvenidos a este nuevo nivel!', NULL, '2025-11-06 16:50:37', '2025-11-06 16:50:37'),
(8, 'ROLES Y FUNCIONES DEL CONSEJAL', 'roles-y-funciones-del-consejal', 'Bienvenidos ', NULL, '2025-11-13 15:35:56', '2025-11-13 15:35:56'),
(9, 'MARKETNG POLITICO', 'marketng-politico', 'Bienvenidos!', NULL, '2025-11-13 16:11:01', '2025-11-13 16:11:01'),
(10, 'TÉCNICAS LESGILATIVAS', 'tecnicas-lesgilativas', 'Bienvenidos!', NULL, '2025-11-13 16:20:46', '2025-11-13 16:20:46'),
(11, 'ORGANIZACION DE EVENTOS POLITICOS ', 'organizacion-de-eventos-politicos', 'Bienvenidos!', NULL, '2025-11-13 16:23:48', '2025-11-13 16:23:48'),
(12, 'CAMPAÑAS POLITICAS EXITOSAS', 'campanas-politicas-exitosas', 'Bienvenidos !!', NULL, '2025-11-13 16:31:46', '2025-11-13 16:31:46'),
(13, 'CAMPAÑAS POLITICAS EXITOSAS 5', 'campanas-politicas-exitosas-5', 'Bienvenidos!', NULL, '2025-11-13 16:32:19', '2025-11-13 16:32:19'),
(14, 'ASESOR ECONOMICO', 'asesor-economico', 'Bienvenido!', 'cursos/01K9ZAC5822A9JA2RVPZ82H7ZY.png', '2025-11-13 16:55:53', '2025-11-13 22:16:44'),
(15, 'NEUROPOLITICA', 'neuropolitica', 'Bienvenido!', NULL, '2025-11-13 16:58:27', '2025-11-13 16:58:27'),
(16, 'LENGUA DE SEÑAS  1 y 2 (grupo 73)', 'lengua-de-senas-1-y-2-grupo-73', 'Bienvenidos!!', NULL, '2025-11-13 21:48:43', '2025-11-13 21:48:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_user`
--

CREATE TABLE `curso_user` (
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `curso_user`
--

INSERT INTO `curso_user` (`curso_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL),
(1, 13, NULL, NULL),
(1, 58, NULL, NULL),
(1, 59, NULL, NULL),
(1, 60, NULL, NULL),
(1, 61, NULL, NULL),
(1, 62, NULL, NULL),
(1, 63, NULL, NULL),
(1, 64, NULL, NULL),
(1, 65, NULL, NULL),
(1, 66, NULL, NULL),
(1, 67, NULL, NULL),
(1, 68, NULL, NULL),
(1, 69, NULL, NULL),
(1, 70, NULL, NULL),
(1, 71, NULL, NULL),
(1, 72, NULL, NULL),
(1, 73, NULL, NULL),
(1, 74, NULL, NULL),
(1, 75, NULL, NULL),
(1, 76, NULL, NULL),
(1, 77, NULL, NULL),
(1, 78, NULL, NULL),
(1, 79, NULL, NULL),
(1, 80, NULL, NULL),
(1, 81, NULL, NULL),
(1, 82, NULL, NULL),
(1, 83, NULL, NULL),
(1, 84, NULL, NULL),
(1, 85, NULL, NULL),
(1, 86, NULL, NULL),
(1, 87, NULL, NULL),
(1, 88, NULL, NULL),
(1, 89, NULL, NULL),
(1, 90, NULL, NULL),
(1, 91, NULL, NULL),
(1, 92, NULL, NULL),
(1, 93, NULL, NULL),
(1, 94, NULL, NULL),
(1, 95, NULL, NULL),
(1, 96, NULL, NULL),
(1, 97, NULL, NULL),
(1, 98, NULL, NULL),
(1, 100, NULL, NULL),
(1, 101, NULL, NULL),
(1, 102, NULL, NULL),
(1, 103, NULL, NULL),
(1, 104, NULL, NULL),
(1, 105, NULL, NULL),
(1, 106, NULL, NULL),
(1, 107, NULL, NULL),
(1, 108, NULL, NULL),
(1, 109, NULL, NULL),
(1, 110, NULL, NULL),
(1, 111, NULL, NULL),
(1, 112, NULL, NULL),
(1, 113, NULL, NULL),
(1, 114, NULL, NULL),
(1, 115, NULL, NULL),
(1, 116, NULL, NULL),
(1, 117, NULL, NULL),
(1, 118, NULL, NULL),
(1, 119, NULL, NULL),
(1, 120, NULL, NULL),
(1, 121, NULL, NULL),
(1, 122, NULL, NULL),
(1, 123, NULL, NULL),
(1, 124, NULL, NULL),
(1, 125, NULL, NULL),
(1, 127, NULL, NULL),
(1, 128, NULL, NULL),
(1, 130, NULL, NULL),
(1, 133, NULL, NULL),
(1, 134, NULL, NULL),
(1, 135, NULL, NULL),
(1, 136, NULL, NULL),
(1, 137, NULL, NULL),
(1, 138, NULL, NULL),
(1, 140, NULL, NULL),
(1, 141, NULL, NULL),
(1, 142, NULL, NULL),
(1, 144, NULL, NULL),
(1, 147, NULL, NULL),
(1, 148, NULL, NULL),
(1, 149, NULL, NULL),
(1, 150, NULL, NULL),
(1, 151, NULL, NULL),
(1, 152, NULL, NULL),
(1, 156, NULL, NULL),
(1, 157, NULL, NULL),
(1, 158, NULL, NULL),
(1, 159, NULL, NULL),
(1, 161, NULL, NULL),
(1, 163, NULL, NULL),
(1, 166, NULL, NULL),
(1, 167, NULL, NULL),
(1, 168, NULL, NULL),
(1, 169, NULL, NULL),
(1, 170, NULL, NULL),
(1, 171, NULL, NULL),
(1, 172, NULL, NULL),
(1, 173, NULL, NULL),
(1, 174, NULL, NULL),
(1, 175, NULL, NULL),
(1, 176, NULL, NULL),
(1, 177, NULL, NULL),
(1, 178, NULL, NULL),
(1, 180, NULL, NULL),
(1, 181, NULL, NULL),
(1, 182, NULL, NULL),
(1, 183, NULL, NULL),
(1, 184, NULL, NULL),
(1, 185, NULL, NULL),
(1, 186, NULL, NULL),
(1, 187, NULL, NULL),
(1, 189, NULL, NULL),
(1, 190, NULL, NULL),
(1, 191, NULL, NULL),
(3, 4, NULL, NULL),
(3, 5, NULL, NULL),
(3, 6, NULL, NULL),
(3, 7, NULL, NULL),
(3, 8, NULL, NULL),
(3, 9, NULL, NULL),
(3, 11, NULL, NULL),
(3, 12, NULL, NULL),
(3, 13, NULL, NULL),
(3, 15, NULL, NULL),
(3, 16, NULL, NULL),
(3, 17, NULL, NULL),
(3, 18, NULL, NULL),
(3, 19, NULL, NULL),
(3, 20, NULL, NULL),
(3, 21, NULL, NULL),
(3, 22, NULL, NULL),
(3, 23, NULL, NULL),
(3, 24, NULL, NULL),
(3, 25, NULL, NULL),
(3, 26, NULL, NULL),
(3, 27, NULL, NULL),
(3, 28, NULL, NULL),
(3, 29, NULL, NULL),
(3, 30, NULL, NULL),
(3, 31, NULL, NULL),
(3, 32, NULL, NULL),
(3, 33, NULL, NULL),
(3, 34, NULL, NULL),
(3, 35, NULL, NULL),
(4, 36, NULL, NULL),
(4, 37, NULL, NULL),
(4, 38, NULL, NULL),
(4, 39, NULL, NULL),
(4, 40, NULL, NULL),
(4, 41, NULL, NULL),
(4, 42, NULL, NULL),
(4, 43, NULL, NULL),
(4, 44, NULL, NULL),
(4, 45, NULL, NULL),
(6, 49, NULL, NULL),
(6, 50, NULL, NULL),
(6, 51, NULL, NULL),
(6, 52, NULL, NULL),
(7, 53, NULL, NULL),
(7, 54, NULL, NULL),
(7, 55, NULL, NULL),
(7, 56, NULL, NULL),
(8, 65, NULL, NULL),
(8, 66, NULL, NULL),
(8, 100, NULL, NULL),
(8, 110, NULL, NULL),
(8, 129, NULL, NULL),
(8, 131, NULL, NULL),
(8, 137, NULL, NULL),
(8, 139, NULL, NULL),
(8, 140, NULL, NULL),
(8, 155, NULL, NULL),
(8, 167, NULL, NULL),
(9, 143, NULL, NULL),
(10, 148, NULL, NULL),
(11, 151, NULL, NULL),
(12, 105, NULL, NULL),
(14, 157, NULL, NULL),
(15, 160, NULL, NULL),
(15, 162, NULL, NULL),
(16, 179, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modulo_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `instructions` longtext DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `available_from` timestamp NULL DEFAULT NULL,
  `due_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `exams`
--

INSERT INTO `exams` (`id`, `modulo_id`, `title`, `description`, `instructions`, `is_published`, `available_from`, `due_at`, `created_at`, `updated_at`) VALUES
(1, 4, 'examen de prueba', 'descripcin del examen de prueba', '<p>Con tenido de prueba examen instrucciones</p>', 1, '2025-10-31 15:21:00', '2025-11-02 15:22:00', '2025-10-31 18:22:12', '2025-10-31 18:30:21'),
(2, 1, 'TRABAJO 1', '¡Hola a todos nuestros alumnos! Mucha suerte con esta nueva entrega.', '<p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;application/vnd.openxmlformats-officedocument.wordprocessingml.document&quot;,&quot;filename&quot;:&quot;trabajo.docx&quot;,&quot;filesize&quot;:155838,&quot;href&quot;:&quot;https://solumne.com.ar/storage/iq3V1qI6EdkvdRDigznaQMRdg8E5Bp8kdY2LNiBz.docx&quot;,&quot;url&quot;:&quot;https://solumne.com.ar/storage/iq3V1qI6EdkvdRDigznaQMRdg8E5Bp8kdY2LNiBz.docx&quot;}\" data-trix-content-type=\"application/vnd.openxmlformats-officedocument.wordprocessingml.document\" class=\"attachment attachment--file attachment--docx\"><a href=\"https://solumne.com.ar/storage/iq3V1qI6EdkvdRDigznaQMRdg8E5Bp8kdY2LNiBz.docx\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">trabajo.docx</span> <span class=\"attachment__size\">152.19 KB</span></figcaption></a></figure></p>', 1, NULL, NULL, '2025-11-06 20:04:37', '2025-11-06 20:36:30'),
(3, 13, 'TRABAJO DEL MÓDULO', '¡Mucha suerte!', '<p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;application/vnd.openxmlformats-officedocument.wordprocessingml.document&quot;,&quot;filename&quot;:&quot;trabajo_modulo_2.docx&quot;,&quot;filesize&quot;:30799,&quot;href&quot;:&quot;https://solumne.com.ar/storage/fUWZOQHbg9ThomITSlpVivuU2TcHtQ6xz3BdGXla.docx&quot;,&quot;url&quot;:&quot;https://solumne.com.ar/storage/fUWZOQHbg9ThomITSlpVivuU2TcHtQ6xz3BdGXla.docx&quot;}\" data-trix-content-type=\"application/vnd.openxmlformats-officedocument.wordprocessingml.document\" class=\"attachment attachment--file attachment--docx\"><a href=\"https://solumne.com.ar/storage/fUWZOQHbg9ThomITSlpVivuU2TcHtQ6xz3BdGXla.docx\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">trabajo_modulo_2.docx</span> <span class=\"attachment__size\">30.08 KB</span></figcaption></a></figure></p>', 1, NULL, '2029-11-06 17:35:00', '2025-11-06 20:34:31', '2025-11-06 20:36:00'),
(4, 14, 'TRABAJO DEL MÓDULO', '¡Mucha suerte!', '<p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;application/vnd.openxmlformats-officedocument.wordprocessingml.document&quot;,&quot;filename&quot;:&quot;guia.docx&quot;,&quot;filesize&quot;:17151,&quot;href&quot;:&quot;https://solumne.com.ar/storage/qSIaBKbEPxOVoWqyLpy9ORS5WtlQWiAj3PVoIh4L.docx&quot;,&quot;url&quot;:&quot;https://solumne.com.ar/storage/qSIaBKbEPxOVoWqyLpy9ORS5WtlQWiAj3PVoIh4L.docx&quot;}\" data-trix-content-type=\"application/vnd.openxmlformats-officedocument.wordprocessingml.document\" class=\"attachment attachment--file attachment--docx\"><a href=\"https://solumne.com.ar/storage/qSIaBKbEPxOVoWqyLpy9ORS5WtlQWiAj3PVoIh4L.docx\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">guia.docx</span> <span class=\"attachment__size\">16.75 KB</span></figcaption></a></figure></p>', 1, NULL, '2029-11-06 17:51:00', '2025-11-06 20:51:13', '2025-11-06 20:51:43'),
(5, 15, 'EXAMEN', NULL, '<p><figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;application/pdf&quot;,&quot;filename&quot;:&quot;asesor_final-2.pdf&quot;,&quot;filesize&quot;:46467,&quot;href&quot;:&quot;https://solumne.com.ar/storage/uOMoXiuCd19kSZdT48N7aY1otQxtlgeJ1aRweTlC.pdf&quot;,&quot;url&quot;:&quot;https://solumne.com.ar/storage/uOMoXiuCd19kSZdT48N7aY1otQxtlgeJ1aRweTlC.pdf&quot;}\" data-trix-content-type=\"application/pdf\" class=\"attachment attachment--file attachment--pdf\"><a href=\"https://solumne.com.ar/storage/uOMoXiuCd19kSZdT48N7aY1otQxtlgeJ1aRweTlC.pdf\"><figcaption class=\"attachment__caption\"><span class=\"attachment__name\">asesor_final-2.pdf</span> <span class=\"attachment__size\">45.38 KB</span></figcaption></a></figure></p>', 1, NULL, NULL, '2025-11-06 21:01:37', '2025-11-06 21:01:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam_answers`
--

CREATE TABLE `exam_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_attempt_id` bigint(20) UNSIGNED NOT NULL,
  `exam_question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_text` longtext DEFAULT NULL,
  `points_awarded` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `exam_answers`
--

INSERT INTO `exam_answers` (`id`, `exam_attempt_id`, `exam_question_id`, `answer_text`, `points_awarded`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'RESPUESTA 1', 15.00, '2025-10-31 18:39:51', '2025-10-31 18:41:22'),
(2, 1, 2, 'RESPUESTA 2', 85.00, '2025-10-31 18:39:51', '2025-10-31 18:41:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam_attempts`
--

CREATE TABLE `exam_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'submitted',
  `score` decimal(8,2) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `graded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `exam_attempts`
--

INSERT INTO `exam_attempts` (`id`, `exam_id`, `user_id`, `status`, `score`, `feedback`, `submitted_at`, `graded_at`, `created_at`, `updated_at`) VALUES
(1, 1, 38, 'graded', 100.00, 'PESIMOS RESULTADOS SEÑORITA', '2025-10-31 18:39:51', '2025-10-31 18:41:22', '2025-10-31 18:39:51', '2025-10-31 18:41:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED NOT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `prompt` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `points` decimal(8,2) NOT NULL DEFAULT 1.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `exam_id`, `order`, `prompt`, `description`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'PREGUNTA DE PRUEBA', 'DETALLE DE PRUEBA', 15.00, '2025-10-31 18:22:12', '2025-10-31 18:22:12'),
(2, 1, 2, 'PREGUNTA 2', '85 PUNTOS DA ESTA RESPUESTA', 85.00, '2025-10-31 18:30:21', '2025-10-31 18:30:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leccions`
--

CREATE TABLE `leccions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modulo_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `text_content` longtext DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `leccions`
--

INSERT INTO `leccions` (`id`, `modulo_id`, `title`, `video_url`, `text_content`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tema 1', NULL, NULL, 0, '2025-10-04 01:41:14', '2025-10-04 01:41:14'),
(2, 1, 'CLASE 1: Comunicación', NULL, '¡En esta primera clase, aprenderemos los temas principales para abordar la comunicación política!', 0, '2025-10-13 12:45:32', '2025-10-13 12:45:32'),
(3, 1, 'CLASE 2: Argumentario político', NULL, 'Un argumentario político es un documento político que facilita respuestas oportunas a posibles objeciones que se planteen. En esta clase, comenzaremos a abordar las diferentes ramas de la comunicación para nutrir nuestro conocimiento político. ¡Mucha suerte!', 0, '2025-10-13 12:49:38', '2025-10-13 12:49:38'),
(4, 1, 'PEQUEÑO BONUS', NULL, '¡Les dejamos un pequeño bonus de regalo!', 0, '2025-10-13 12:50:34', '2025-10-13 12:50:34'),
(5, 1, 'CLASE 3: Influencia de las redes sociales', NULL, 'Las redes sociales han redefinido irrevocablemente la relación entre ciudadanía, medios y poder político. En paralelo, un informe de la Defensoría del Público (2024) mostró que el 74% de los encuestados considera que la política en redes es más accesible. Pese a ser una herramienta, también puede ser nuestro enemigo.', 0, '2025-10-13 12:53:58', '2025-10-13 12:53:58'),
(6, 1, 'Clase 4: Comunicación a través de las redes', NULL, 'Las redes sociales pueden servir para aumentar la conciencia política, pero es necesario afrontar desafíos. En este escenario, la comunicación digital se convierte en un terreno clave para disputar sentidos, llegar a los jóvenes y legitimar propuestas en un electorado.', 0, '2025-10-13 12:55:30', '2025-10-13 12:55:30'),
(7, 2, 'CLASE 1: 15/09/2025', 'https://drive.google.com/file/d/1bn5OYY92vf7pLx5rjNnV-5h9OaBaVjlP/view', '¡Bienvenidos a nuestra primera clase!', 0, '2025-10-13 13:03:09', '2025-10-13 13:03:09'),
(8, 2, 'CLASE 2: 22/09', 'https://drive.google.com/file/d/1kncNy3rvLEK6N7aBzpV4xLCK1lO1hy_6/view', NULL, 0, '2025-10-13 13:04:03', '2025-10-13 13:04:03'),
(9, 2, 'CLASE 3: 29/09', 'https://drive.google.com/file/d/1THVUyXCrST47j3MbNCOgMavnn4C-g_Nr/view', NULL, 0, '2025-10-13 13:04:34', '2025-10-13 13:04:34'),
(10, 2, 'CLASE 4: 06/09', 'https://drive.google.com/file/d/1K27XauVf4IFUmAgqOYKhNe6jtEt2boGQ/view', NULL, 0, '2025-10-13 13:05:17', '2025-10-13 13:05:17'),
(11, 4, 'CLASE 1: 25/09', 'https://drive.google.com/file/d/1WaHAoEwjPHdHZqKVY_XhispI_xN_idur/view?usp=sharing', 'Presentación y alfabeto', 0, '2025-10-13 14:19:04', '2025-10-31 17:04:12'),
(12, 4, 'CLASE 02/10', 'https://drive.google.com/file/d/12E8HUppt-BMCZx-UVj0zxeWpPXlYScWG/view', 'Configuración y números', 0, '2025-10-13 14:19:43', '2025-10-13 14:19:43'),
(14, 7, 'CUADERNILLO', 'https://drive.google.com/file/d/1VPKyKmntzkLSId9JF14aNoKiJz32riVR/view?usp=drivesdk', NULL, 1, '2025-11-05 16:07:04', '2025-11-05 16:07:13'),
(15, 2, 'CLASE 5: 13/10', 'https://drive.google.com/file/d/1PJE0AMjeF2SRZEQzW_rjptN4dxPLFE8Y/view', NULL, 1, '2025-11-06 15:42:24', '2025-11-06 15:42:24'),
(16, 2, 'CLASE 6: 13/10', 'https://drive.google.com/file/d/1PJE0AMjeF2SRZEQzW_rjptN4dxPLFE8Y/view', NULL, 2, '2025-11-06 15:43:36', '2025-11-06 15:43:36'),
(17, 2, 'CLASE 7: 20/10', 'https://drive.google.com/file/d/1AUBNdtb3RYnWIlXBR9_FfeuYUNO2PVC9/view', NULL, 3, '2025-11-06 15:44:08', '2025-11-06 15:44:08'),
(18, 2, 'CLASE 8: 27/10', 'https://drive.google.com/file/d/1GKYloD9ifp3BwHr2hb7CnavhD7G9mur7/view', NULL, 4, '2025-11-06 15:44:44', '2025-11-06 15:44:44'),
(19, 2, 'CLASE 9: 3/11', 'https://drive.google.com/file/d/1ehzDxKBsedfxGMAa1Zc1pneLuW0Jtvpi/view', NULL, 5, '2025-11-06 15:46:18', '2025-11-06 15:46:18'),
(20, 4, 'CLASE 03: 09/10', 'https://drive.google.com/file/d/1XXvgsQd4bq84oqiGKw8pNhn502zZ5X3p/view', NULL, 1, '2025-11-06 15:50:59', '2025-11-06 15:50:59'),
(21, 4, 'CLASE 04: 16/10', 'https://drive.google.com/file/d/1HvURyePMWhurjU69B6Ie0tgkEQA-A01S/view', NULL, 2, '2025-11-06 15:51:56', '2025-11-06 15:51:56'),
(22, 4, 'CLASE 05: 23/10', 'https://drive.google.com/file/d/17Ziyu3EQVwxRGGBaLJ7yn7nOBLgNwAC9/view', NULL, 3, '2025-11-06 15:52:19', '2025-11-06 15:52:19'),
(23, 4, 'CLASE 06: 30/10', 'https://drive.google.com/file/d/1TkzsNsB_BneF9W7DGPig3Vy7PbdbA3l3/view', NULL, 4, '2025-11-06 15:52:49', '2025-11-06 15:52:49'),
(24, 9, 'CLASE 1: 09/09', 'https://drive.google.com/file/d/1TYaHtf3lClu5BvLESafFOafyipX-SiM8/view', NULL, 1, '2025-11-06 16:25:45', '2025-11-06 16:25:45'),
(25, 9, 'CLASE 2: 16/09', 'https://drive.google.com/file/d/1LHq_feBBqAZ1KHNMbkpy2QsIFTVgAmuN/view', NULL, 2, '2025-11-06 16:26:10', '2025-11-06 16:26:10'),
(26, 9, 'CLASE 03: 23/09', 'https://drive.google.com/file/d/1LHq_feBBqAZ1KHNMbkpy2QsIFTVgAmuN/view', NULL, 3, '2025-11-06 16:26:46', '2025-11-06 16:26:46'),
(27, 9, 'CLASE 04: 30/09', 'https://drive.google.com/file/d/1fkORxbgZRytAWJ1ZX72SedQcCGjpfgfw/view', '<p>¡Practicamos oraciones!</p>', 4, '2025-11-06 16:27:15', '2025-11-06 16:27:15'),
(28, 9, 'CLASE 5: 07/10', 'https://drive.google.com/file/d/1jll46yA8sM6uEDu3QIpByXeLIBH2YtNG/view', NULL, 5, '2025-11-06 16:28:58', '2025-11-06 16:28:58'),
(29, 9, 'CLASE 6: 14/10', 'https://drive.google.com/file/d/19tfGyO1ANcjBGwh2tWPbyfFz413Vd28X/view', '<p>REPASAMOS UNIDAD 7 Y REALIZAMOS ALGUNAS ORACIONES</p>', 6, '2025-11-06 16:29:40', '2025-11-06 16:29:40'),
(30, 9, 'CLASE 7: 21/10', 'https://drive.google.com/file/d/1Xz-xR-Oya-kUjWolGvw1IA7G9AcyJ3Hl/view?usp=sharing', NULL, 7, '2025-11-06 16:31:02', '2025-11-06 16:31:02'),
(31, 9, 'CLASE 8: 28/10', 'https://drive.google.com/file/d/1yp3sotByJgTKKq9krVL2YmyqCP4Fit9v/view', '<p>UNIDAD 9 Y 10</p>', 8, '2025-11-06 16:31:37', '2025-11-06 16:31:37'),
(32, 10, 'CUADERNILLO', NULL, NULL, 1, '2025-11-06 18:02:52', '2025-11-06 18:02:52'),
(33, 13, 'CLASE 1: INTRODUCCIÓN', NULL, NULL, 1, '2025-11-06 20:18:49', '2025-11-06 20:18:49'),
(34, 13, 'CLASE 2: PROGRAMA ELECTORAL', NULL, NULL, 2, '2025-11-06 20:18:58', '2025-11-06 20:18:58'),
(35, 13, 'PROGRAMA EJEMPLO', NULL, NULL, 3, '2025-11-06 20:19:11', '2025-11-06 20:19:11'),
(36, 13, 'EL PODER DE LAS EMOCIONES EN LA POLÍTICA', NULL, NULL, 4, '2025-11-06 20:19:59', '2025-11-06 20:19:59'),
(37, 13, 'CIBERPOLÍTICA', NULL, NULL, 5, '2025-11-06 20:20:31', '2025-11-06 20:20:31'),
(38, 14, 'CLASE: NEUROPOLÍTICA', NULL, NULL, 1, '2025-11-06 20:37:56', '2025-11-06 20:37:56'),
(39, 14, 'CLASE SOBRE EL ÉXITO', NULL, NULL, 2, '2025-11-06 20:38:07', '2025-11-06 20:38:07'),
(40, 14, 'EL INCONSCIENTE Y LOS MEDIOS COLECTIVOS', NULL, NULL, 3, '2025-11-06 20:38:21', '2025-11-06 20:38:21'),
(41, 15, 'NEGOCIACIÓN EFECTIVA', NULL, NULL, 1, '2025-11-06 20:53:07', '2025-11-06 20:53:07'),
(42, 15, 'SEPARAR LAS PERSONAS DEL PROBLEMA', NULL, NULL, 2, '2025-11-06 20:53:16', '2025-11-06 20:53:16'),
(43, 15, 'CASO COMPRAVENTA', NULL, NULL, 3, '2025-11-06 20:53:23', '2025-11-06 20:53:23'),
(44, 15, 'CASO PAREJA', NULL, NULL, 4, '2025-11-06 20:53:30', '2025-11-06 20:53:30'),
(45, 15, 'CASO POLÍTICO', NULL, NULL, 5, '2025-11-06 20:53:36', '2025-11-06 20:53:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leccion_user`
--

CREATE TABLE `leccion_user` (
  `leccion_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `leccion_user`
--

INSERT INTO `leccion_user` (`leccion_id`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 5, '2025-11-05 16:12:42', '2025-11-05 16:12:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_29_174012_create_cursos_table', 1),
(5, '2025_09_29_174041_create_modulos_table', 1),
(6, '2025_09_29_174102_create_leccions_table', 1),
(7, '2025_09_29_174220_create_recursos_table', 1),
(8, '2025_09_29_174349_create_curso_user_table', 1),
(9, '2025_10_01_005003_add_file_type_to_recursos_table', 1),
(10, '2025_10_01_054457_modify_lecciones_table_for_flexible_content', 1),
(11, '2025_10_03_183703_create_leccion_user_pivot_table', 1),
(12, '2025_10_04_220851_create_sedes_table', 2),
(13, '2025_10_04_235918_create_sedes_table', 3),
(14, '2025_10_05_001447_add_image_path_to_sedes_table', 4),
(15, '2025_10_30_000600_create_modulo_user_table', 5),
(16, '2025_10_30_000700_create_evaluaciones_table', 5),
(17, '2025_10_31_011000_drop_evaluaciones_table', 6),
(18, '2025_10_31_011100_create_exams_table', 6),
(19, '2025_10_31_011200_create_exam_questions_table', 6),
(20, '2025_10_31_011300_create_exam_attempts_table', 6),
(21, '2025_10_31_011400_create_exam_answers_table', 6),
(22, '2025_11_01_224030_add_unlock_fields_to_modulo_user_table', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `curso_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `curso_id`, `title`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'COMUNICACIÓN POLÍTICA', 0, '2025-10-04 01:40:48', '2025-10-04 01:40:48'),
(2, 3, 'CLASES GRABADAS', 0, '2025-10-13 13:01:20', '2025-10-13 13:01:20'),
(3, 3, 'MATERIAL', 0, '2025-10-13 13:01:24', '2025-10-13 13:01:24'),
(4, 4, 'CLASES GRABADAS', 0, '2025-10-13 14:18:13', '2025-10-13 14:18:13'),
(5, 4, 'MATERIAL', 0, '2025-10-13 14:18:18', '2025-10-13 14:18:18'),
(6, 5, 'CLASES GRABADAS', 1, '2025-11-05 15:37:07', '2025-11-05 15:37:07'),
(7, 5, 'MATERIAL', 2, '2025-11-05 15:37:13', '2025-11-05 15:37:13'),
(8, 5, 'TRABAJOS PRÁCTICOS', 3, '2025-11-05 15:37:24', '2025-11-05 15:37:24'),
(9, 6, 'CLASES GRABADAS', 1, '2025-11-06 16:23:57', '2025-11-06 16:23:57'),
(10, 6, 'MATERIAL', 2, '2025-11-06 16:24:03', '2025-11-06 16:24:03'),
(11, 7, 'CLASES GRABADAS', 1, '2025-11-06 16:50:49', '2025-11-06 16:50:49'),
(12, 7, 'MATERIAL', 2, '2025-11-06 16:50:52', '2025-11-06 16:50:52'),
(13, 1, 'MARKETING POLÍTICO', 1, '2025-11-06 20:12:13', '2025-11-06 20:12:13'),
(14, 1, 'NEUROPOLÍTICA', 2, '2025-11-06 20:12:38', '2025-11-06 20:12:38'),
(15, 1, 'NEGOCIACIÓN EFECTIVA', 3, '2025-11-06 20:12:44', '2025-11-06 20:12:44'),
(16, 8, 'MODULO 1', 1, '2025-11-13 15:36:20', '2025-11-13 15:36:20'),
(17, 8, 'MODULO 2', 2, '2025-11-13 15:36:28', '2025-11-13 15:36:28'),
(18, 8, 'MODULO 3', 3, '2025-11-13 15:36:35', '2025-11-13 15:36:35'),
(19, 8, 'MODULO 4', 4, '2025-11-13 15:36:40', '2025-11-13 15:36:40'),
(20, 9, 'MODULO 1', 1, '2025-11-13 16:11:11', '2025-11-13 16:11:11'),
(21, 9, 'MODULO 2', 2, '2025-11-13 16:11:21', '2025-11-13 16:11:21'),
(22, 9, 'MODULO 3', 3, '2025-11-13 16:11:27', '2025-11-13 16:11:27'),
(23, 9, 'MODULO 4', 4, '2025-11-13 16:11:32', '2025-11-13 16:11:32'),
(24, 9, 'MODULO 5', 5, '2025-11-13 16:11:38', '2025-11-13 16:11:38'),
(25, 10, 'MODULO 1', 1, '2025-11-13 16:21:01', '2025-11-13 16:21:01'),
(26, 10, 'MODULO 2', 2, '2025-11-13 16:21:07', '2025-11-13 16:21:07'),
(27, 10, 'MODULO 3', 3, '2025-11-13 16:21:13', '2025-11-13 16:21:13'),
(28, 10, 'MODULO 4', 4, '2025-11-13 16:21:18', '2025-11-13 16:21:18'),
(29, 10, 'MODULO 5', 5, '2025-11-13 16:21:24', '2025-11-13 16:21:24'),
(30, 10, 'MODULO 6', 6, '2025-11-13 16:21:31', '2025-11-13 16:21:31'),
(31, 11, 'MODULO 1', 1, '2025-11-13 16:25:37', '2025-11-13 16:25:37'),
(32, 11, 'MODULO 2', 2, '2025-11-13 16:25:43', '2025-11-13 16:25:43'),
(33, 12, 'MODULO 1', 1, '2025-11-13 16:35:13', '2025-11-13 16:35:13'),
(34, 12, 'MODULO 2', 2, '2025-11-13 16:35:19', '2025-11-13 16:35:19'),
(35, 12, 'MODULO 3', 3, '2025-11-13 16:35:29', '2025-11-13 16:35:29'),
(36, 12, 'MODULO 4', 4, '2025-11-13 16:35:34', '2025-11-13 16:35:34'),
(37, 13, 'MODULO FINAL', 1, '2025-11-13 16:36:45', '2025-11-13 16:36:45'),
(38, 14, 'MODULO 1', 1, '2025-11-13 16:56:28', '2025-11-13 16:56:28'),
(39, 14, 'MODULO 2', 2, '2025-11-13 16:56:35', '2025-11-13 16:56:35'),
(40, 14, 'MODULO 3', 3, '2025-11-13 16:56:41', '2025-11-13 16:56:41'),
(41, 14, 'MODULO 4', 4, '2025-11-13 16:56:55', '2025-11-13 16:56:55'),
(42, 15, 'MODULO 1', 1, '2025-11-13 16:58:48', '2025-11-13 16:58:48'),
(43, 15, 'MODULO 2', 2, '2025-11-13 16:58:54', '2025-11-13 16:58:54'),
(44, 15, 'MODULO 3', 3, '2025-11-13 16:59:03', '2025-11-13 16:59:03'),
(45, 15, 'MODULO 4', 4, '2025-11-13 16:59:09', '2025-11-13 16:59:09'),
(46, 15, 'MODULO 5', 5, '2025-11-13 16:59:29', '2025-11-13 16:59:29'),
(47, 15, 'MODULO 6', 6, '2025-11-13 16:59:34', '2025-11-13 16:59:34'),
(48, 16, 'CLASES ', 1, '2025-11-13 21:49:12', '2025-11-13 21:49:12'),
(49, 16, 'MATERIAL', 2, '2025-11-13 21:49:19', '2025-11-13 21:49:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo_user`
--

CREATE TABLE `modulo_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modulo_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'locked',
  `assigned_at` timestamp NULL DEFAULT NULL,
  `available_from` timestamp NULL DEFAULT NULL,
  `available_until` timestamp NULL DEFAULT NULL,
  `released_by` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_reference` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `revoked_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modulo_user`
--

INSERT INTO `modulo_user` (`id`, `modulo_id`, `user_id`, `status`, `assigned_at`, `available_from`, `available_until`, `released_by`, `payment_reference`, `notes`, `revoked_at`, `created_at`, `updated_at`) VALUES
(3, 4, 38, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-01 23:27:32', '2025-11-06 18:54:51'),
(4, 1, 2, 'unlocked', '2025-11-08 20:35:56', '2025-11-08 20:35:56', NULL, 1, NULL, NULL, NULL, '2025-11-01 23:48:24', '2025-11-08 20:35:56'),
(5, 2, 6, 'unlocked', '2025-11-01 23:49:11', '2025-11-01 23:49:11', NULL, 1, NULL, NULL, NULL, '2025-11-01 23:49:11', '2025-11-01 23:49:11'),
(6, 3, 6, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-01 23:49:11', '2025-11-01 23:49:11', '2025-11-01 23:49:11'),
(7, 5, 38, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-06 18:54:51', '2025-11-06 18:54:51'),
(8, 1, 58, 'unlocked', '2025-11-10 15:20:38', '2025-11-10 15:20:38', NULL, 1, NULL, NULL, NULL, '2025-11-07 16:57:12', '2025-11-10 15:20:38'),
(9, 13, 58, 'unlocked', '2025-11-10 15:20:38', '2025-11-10 15:20:38', NULL, 1, NULL, NULL, NULL, '2025-11-07 16:57:12', '2025-11-10 15:20:38'),
(10, 14, 58, 'unlocked', '2025-11-10 15:20:38', '2025-11-10 15:20:38', NULL, 1, NULL, NULL, NULL, '2025-11-07 16:57:12', '2025-11-10 15:20:38'),
(11, 15, 58, 'unlocked', '2025-11-10 15:20:38', '2025-11-10 15:20:38', NULL, 1, NULL, NULL, NULL, '2025-11-07 16:57:12', '2025-11-10 15:20:38'),
(12, 1, 59, 'unlocked', '2025-11-10 15:20:57', '2025-11-10 15:20:57', NULL, 1, NULL, NULL, NULL, '2025-11-07 16:58:07', '2025-11-10 15:20:57'),
(13, 13, 59, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 16:58:07', '2025-11-07 16:58:07'),
(14, 14, 59, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 16:58:07', '2025-11-07 16:58:07'),
(15, 15, 59, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 16:58:07', '2025-11-07 16:58:07'),
(16, 1, 60, 'unlocked', '2025-11-10 15:21:19', '2025-11-10 15:21:19', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:01:18', '2025-11-10 15:21:19'),
(17, 13, 60, 'unlocked', '2025-11-10 15:21:19', '2025-11-10 15:21:19', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:01:18', '2025-11-10 15:21:19'),
(18, 14, 60, 'unlocked', '2025-11-10 15:21:19', '2025-11-10 15:21:19', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:01:18', '2025-11-10 15:21:19'),
(19, 15, 60, 'unlocked', '2025-11-10 15:21:19', '2025-11-10 15:21:19', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:01:18', '2025-11-10 15:21:19'),
(20, 1, 61, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:05:17', '2025-11-07 17:05:17'),
(21, 13, 61, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:05:17', '2025-11-07 17:05:17'),
(22, 14, 61, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:05:17', '2025-11-07 17:05:17'),
(23, 15, 61, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:05:17', '2025-11-07 17:05:17'),
(24, 1, 62, 'unlocked', '2025-11-09 06:06:59', '2025-11-09 06:06:59', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:09:17', '2025-11-09 06:06:59'),
(25, 13, 62, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:09:17', '2025-11-07 17:09:17'),
(26, 14, 62, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:09:17', '2025-11-07 17:09:17'),
(27, 15, 62, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:09:17', '2025-11-07 17:09:17'),
(28, 1, 63, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:16:43', '2025-11-07 17:16:43'),
(29, 13, 63, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:16:43', '2025-11-07 17:16:43'),
(30, 14, 63, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:16:43', '2025-11-07 17:16:43'),
(31, 15, 63, 'unlocked', '2025-11-10 15:21:58', '2025-11-10 15:21:58', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:16:43', '2025-11-10 15:21:58'),
(32, 1, 64, 'unlocked', '2025-11-10 15:22:17', '2025-11-10 15:22:17', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:17:47', '2025-11-10 15:22:17'),
(33, 13, 64, 'unlocked', '2025-11-10 15:22:17', '2025-11-10 15:22:17', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:17:47', '2025-11-10 15:22:17'),
(34, 14, 64, 'unlocked', '2025-11-10 15:22:17', '2025-11-10 15:22:17', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:17:47', '2025-11-10 15:22:17'),
(35, 15, 64, 'unlocked', '2025-11-10 15:22:17', '2025-11-10 15:22:17', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:17:47', '2025-11-10 15:22:17'),
(36, 1, 65, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:20:57', '2025-11-07 17:20:57'),
(37, 13, 65, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:20:57', '2025-11-07 17:20:57'),
(38, 14, 65, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:20:57', '2025-11-07 17:20:57'),
(39, 15, 65, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:20:57', '2025-11-07 17:20:57'),
(40, 1, 66, 'unlocked', '2025-11-10 15:23:19', '2025-11-10 15:23:19', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:24:02', '2025-11-10 15:23:19'),
(41, 13, 66, 'unlocked', '2025-11-10 15:23:19', '2025-11-10 15:23:19', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:24:02', '2025-11-10 15:23:19'),
(42, 14, 66, 'unlocked', '2025-11-10 15:23:19', '2025-11-10 15:23:19', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:24:02', '2025-11-10 15:23:19'),
(43, 15, 66, 'unlocked', '2025-11-10 15:23:19', '2025-11-10 15:23:19', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:24:02', '2025-11-10 15:23:19'),
(44, 1, 67, 'unlocked', '2025-11-10 15:23:34', '2025-11-10 15:23:34', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:26:02', '2025-11-10 15:23:34'),
(45, 13, 67, 'unlocked', '2025-11-10 15:23:34', '2025-11-10 15:23:34', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:26:02', '2025-11-10 15:23:34'),
(46, 14, 67, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:26:02', '2025-11-07 17:26:02'),
(47, 15, 67, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:26:02', '2025-11-07 17:26:02'),
(48, 1, 68, 'unlocked', '2025-11-10 15:23:55', '2025-11-10 15:23:55', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:28:06', '2025-11-10 15:23:55'),
(49, 13, 68, 'unlocked', '2025-11-10 15:23:55', '2025-11-10 15:23:55', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:28:06', '2025-11-10 15:23:55'),
(50, 14, 68, 'unlocked', '2025-11-10 15:23:55', '2025-11-10 15:23:55', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:28:06', '2025-11-10 15:23:55'),
(51, 15, 68, 'unlocked', '2025-11-10 15:23:55', '2025-11-10 15:23:55', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:28:06', '2025-11-10 15:23:55'),
(52, 1, 69, 'unlocked', '2025-11-10 15:24:23', '2025-11-10 15:24:23', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:40:33', '2025-11-10 15:24:23'),
(53, 13, 69, 'unlocked', '2025-11-10 15:24:23', '2025-11-10 15:24:23', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:40:33', '2025-11-10 15:24:23'),
(54, 14, 69, 'unlocked', '2025-11-10 15:24:23', '2025-11-10 15:24:23', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:40:33', '2025-11-10 15:24:23'),
(55, 15, 69, 'unlocked', '2025-11-10 15:24:23', '2025-11-10 15:24:23', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:40:33', '2025-11-10 15:24:23'),
(56, 1, 70, 'unlocked', '2025-11-10 15:24:44', '2025-11-10 15:24:44', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:48:22', '2025-11-10 15:24:44'),
(57, 13, 70, 'unlocked', '2025-11-10 15:24:44', '2025-11-10 15:24:44', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:48:22', '2025-11-10 15:24:44'),
(58, 14, 70, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:48:22', '2025-11-07 17:48:22'),
(59, 15, 70, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:48:22', '2025-11-07 17:48:22'),
(60, 1, 71, 'unlocked', '2025-11-10 15:25:02', '2025-11-10 15:25:02', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:54:19', '2025-11-10 15:25:02'),
(61, 13, 71, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:54:19', '2025-11-07 17:54:19'),
(62, 14, 71, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:54:19', '2025-11-07 17:54:19'),
(63, 15, 71, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:54:19', '2025-11-07 17:54:19'),
(64, 1, 72, 'unlocked', '2025-11-10 15:25:12', '2025-11-10 15:25:12', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:56:35', '2025-11-10 15:25:12'),
(65, 13, 72, 'unlocked', '2025-11-10 15:25:12', '2025-11-10 15:25:12', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:56:35', '2025-11-10 15:25:12'),
(66, 14, 72, 'unlocked', '2025-11-10 15:25:12', '2025-11-10 15:25:12', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:56:35', '2025-11-10 15:25:12'),
(67, 15, 72, 'unlocked', '2025-11-10 15:25:12', '2025-11-10 15:25:12', NULL, 1, NULL, NULL, NULL, '2025-11-07 17:56:35', '2025-11-10 15:25:12'),
(68, 1, 73, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:58:03', '2025-11-07 17:58:03'),
(69, 13, 73, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:58:03', '2025-11-07 17:58:03'),
(70, 14, 73, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:58:03', '2025-11-07 17:58:03'),
(71, 15, 73, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07 17:58:03', '2025-11-07 17:58:03'),
(72, 1, 74, 'unlocked', '2025-11-10 15:25:49', '2025-11-10 15:25:49', NULL, 1, NULL, NULL, NULL, '2025-11-07 18:02:09', '2025-11-10 15:25:49'),
(73, 13, 74, 'unlocked', '2025-11-10 15:25:49', '2025-11-10 15:25:49', NULL, 1, NULL, NULL, NULL, '2025-11-07 18:02:09', '2025-11-10 15:25:49'),
(74, 14, 74, 'unlocked', '2025-11-10 15:25:49', '2025-11-10 15:25:49', NULL, 1, NULL, NULL, NULL, '2025-11-07 18:02:09', '2025-11-10 15:25:49'),
(75, 15, 74, 'unlocked', '2025-11-10 15:25:49', '2025-11-10 15:25:49', NULL, 1, NULL, NULL, NULL, '2025-11-07 18:02:09', '2025-11-10 15:25:49'),
(76, 13, 2, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-08 20:02:51', '2025-11-08 20:02:51'),
(77, 14, 2, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-08 20:02:51', '2025-11-08 20:02:51'),
(78, 15, 2, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-08 20:02:51', '2025-11-08 20:02:51'),
(79, 1, 75, 'unlocked', '2025-11-10 15:27:42', '2025-11-10 15:27:42', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:27:42', '2025-11-10 15:27:42'),
(80, 13, 75, 'unlocked', '2025-11-10 15:27:42', '2025-11-10 15:27:42', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:27:42', '2025-11-10 15:27:42'),
(81, 14, 75, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 15:27:42', '2025-11-10 15:27:42'),
(82, 15, 75, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 15:27:42', '2025-11-10 15:27:42'),
(83, 1, 77, 'unlocked', '2025-11-10 15:36:29', '2025-11-10 15:36:29', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:36:29', '2025-11-10 15:36:29'),
(84, 13, 77, 'unlocked', '2025-11-10 15:36:29', '2025-11-10 15:36:29', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:36:29', '2025-11-10 15:36:29'),
(85, 14, 77, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 15:36:29', '2025-11-10 15:36:29'),
(86, 15, 77, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 15:36:29', '2025-11-10 15:36:29'),
(87, 1, 76, 'unlocked', '2025-11-10 15:37:00', '2025-11-10 15:37:00', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:37:00', '2025-11-10 15:37:00'),
(88, 13, 76, 'unlocked', '2025-11-10 15:37:00', '2025-11-10 15:37:00', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:37:00', '2025-11-10 15:37:00'),
(89, 14, 76, 'unlocked', '2025-11-10 15:37:00', '2025-11-10 15:37:00', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:37:00', '2025-11-10 15:37:00'),
(90, 15, 76, 'unlocked', '2025-11-10 15:37:00', '2025-11-10 15:37:00', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:37:00', '2025-11-10 15:37:00'),
(91, 1, 78, 'unlocked', '2025-11-10 15:39:35', '2025-11-10 15:39:35', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:39:35', '2025-11-10 15:39:35'),
(92, 13, 78, 'unlocked', '2025-11-10 15:39:35', '2025-11-10 15:39:35', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:39:35', '2025-11-10 15:39:35'),
(93, 14, 78, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 15:39:35', '2025-11-10 15:39:35'),
(94, 15, 78, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 15:39:35', '2025-11-10 15:39:35'),
(95, 1, 79, 'unlocked', '2025-11-10 15:46:19', '2025-11-10 15:46:19', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:46:19', '2025-11-10 15:46:19'),
(96, 13, 79, 'unlocked', '2025-11-10 15:46:19', '2025-11-10 15:46:19', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:46:19', '2025-11-10 15:46:19'),
(97, 14, 79, 'unlocked', '2025-11-10 15:46:19', '2025-11-10 15:46:19', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:46:19', '2025-11-10 15:46:19'),
(98, 15, 79, 'unlocked', '2025-11-10 15:46:19', '2025-11-10 15:46:19', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:46:19', '2025-11-10 15:46:19'),
(99, 1, 80, 'unlocked', '2025-11-10 15:58:59', '2025-11-10 15:58:59', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:58:59', '2025-11-10 15:58:59'),
(100, 13, 80, 'unlocked', '2025-11-10 15:58:59', '2025-11-10 15:58:59', NULL, 1, NULL, NULL, NULL, '2025-11-10 15:58:59', '2025-11-10 15:58:59'),
(101, 14, 80, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 15:58:59', '2025-11-10 15:58:59'),
(102, 15, 80, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 15:58:59', '2025-11-10 15:58:59'),
(103, 1, 81, 'unlocked', '2025-11-10 16:09:35', '2025-11-10 16:09:35', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:09:35', '2025-11-10 16:09:35'),
(104, 13, 81, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:09:35', '2025-11-10 16:09:35'),
(105, 14, 81, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:09:35', '2025-11-10 16:09:35'),
(106, 15, 81, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:09:35', '2025-11-10 16:09:35'),
(107, 1, 82, 'unlocked', '2025-11-10 16:14:21', '2025-11-10 16:14:21', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:14:21', '2025-11-10 16:14:21'),
(108, 13, 82, 'unlocked', '2025-11-10 16:14:21', '2025-11-10 16:14:21', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:14:21', '2025-11-10 16:14:21'),
(109, 14, 82, 'unlocked', '2025-11-10 16:14:21', '2025-11-10 16:14:21', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:14:21', '2025-11-10 16:14:21'),
(110, 15, 82, 'unlocked', '2025-11-10 16:14:21', '2025-11-10 16:14:21', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:14:21', '2025-11-10 16:14:21'),
(111, 1, 83, 'unlocked', '2025-11-10 16:17:32', '2025-11-10 16:17:32', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:17:32', '2025-11-10 16:17:32'),
(112, 13, 83, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:17:32', '2025-11-10 16:17:32'),
(113, 14, 83, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:17:32', '2025-11-10 16:17:32'),
(114, 15, 83, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:17:32', '2025-11-10 16:17:32'),
(115, 1, 84, 'unlocked', '2025-11-10 16:20:16', '2025-11-10 16:20:16', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:20:16', '2025-11-10 16:20:16'),
(116, 13, 84, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:20:16', '2025-11-10 16:20:16'),
(117, 14, 84, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:20:16', '2025-11-10 16:20:16'),
(118, 15, 84, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:20:16', '2025-11-10 16:20:16'),
(119, 1, 85, 'unlocked', '2025-11-10 16:25:45', '2025-11-10 16:25:45', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:25:45', '2025-11-10 16:25:45'),
(120, 13, 85, 'unlocked', '2025-11-10 16:25:45', '2025-11-10 16:25:45', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:25:45', '2025-11-10 16:25:45'),
(121, 14, 85, 'unlocked', '2025-11-10 16:25:45', '2025-11-10 16:25:45', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:25:45', '2025-11-10 16:25:45'),
(122, 15, 85, 'unlocked', '2025-11-10 16:25:45', '2025-11-10 16:25:45', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:25:45', '2025-11-10 16:25:45'),
(123, 1, 86, 'unlocked', '2025-11-10 16:28:37', '2025-11-10 16:28:37', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:28:37', '2025-11-10 16:28:37'),
(124, 13, 86, 'unlocked', '2025-11-10 16:28:37', '2025-11-10 16:28:37', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:28:37', '2025-11-10 16:28:37'),
(125, 14, 86, 'unlocked', '2025-11-10 16:28:37', '2025-11-10 16:28:37', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:28:37', '2025-11-10 16:28:37'),
(126, 15, 86, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:28:37', '2025-11-10 16:28:37'),
(127, 1, 87, 'unlocked', '2025-11-10 16:34:56', '2025-11-10 16:34:56', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:34:56', '2025-11-10 16:34:56'),
(128, 13, 87, 'unlocked', '2025-11-10 16:34:56', '2025-11-10 16:34:56', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:34:56', '2025-11-10 16:34:56'),
(129, 14, 87, 'unlocked', '2025-11-10 16:34:56', '2025-11-10 16:34:56', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:34:56', '2025-11-10 16:34:56'),
(130, 15, 87, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:34:56', '2025-11-10 16:34:56'),
(131, 1, 88, 'unlocked', '2025-11-10 16:42:42', '2025-11-10 16:42:42', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:42:42', '2025-11-10 16:42:42'),
(132, 13, 88, 'unlocked', '2025-11-10 16:42:42', '2025-11-10 16:42:42', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:42:42', '2025-11-10 16:42:42'),
(133, 14, 88, 'unlocked', '2025-11-10 16:42:42', '2025-11-10 16:42:42', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:42:42', '2025-11-10 16:42:42'),
(134, 15, 88, 'unlocked', '2025-11-10 16:42:42', '2025-11-10 16:42:42', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:42:42', '2025-11-10 16:42:42'),
(135, 1, 89, 'unlocked', '2025-11-10 16:46:09', '2025-11-10 16:46:09', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:46:09', '2025-11-10 16:46:09'),
(136, 13, 89, 'unlocked', '2025-11-10 16:46:09', '2025-11-10 16:46:09', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:46:09', '2025-11-10 16:46:09'),
(137, 14, 89, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:46:09', '2025-11-10 16:46:09'),
(138, 15, 89, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 16:46:09', '2025-11-10 16:46:09'),
(139, 1, 90, 'unlocked', '2025-11-10 16:50:03', '2025-11-10 16:50:03', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:50:03', '2025-11-10 16:50:03'),
(140, 13, 90, 'unlocked', '2025-11-10 16:50:03', '2025-11-10 16:50:03', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:50:03', '2025-11-10 16:50:03'),
(141, 14, 90, 'unlocked', '2025-11-10 16:50:03', '2025-11-10 16:50:03', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:50:03', '2025-11-10 16:50:03'),
(142, 15, 90, 'unlocked', '2025-11-10 16:50:03', '2025-11-10 16:50:03', NULL, 1, NULL, NULL, NULL, '2025-11-10 16:50:03', '2025-11-10 16:50:03'),
(143, 1, 91, 'unlocked', '2025-11-10 17:26:54', '2025-11-10 17:26:54', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:26:54', '2025-11-10 17:26:54'),
(144, 13, 91, 'unlocked', '2025-11-10 17:26:54', '2025-11-10 17:26:54', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:26:54', '2025-11-10 17:26:54'),
(145, 14, 91, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 17:26:54', '2025-11-10 17:26:54'),
(146, 15, 91, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 17:26:54', '2025-11-10 17:26:54'),
(147, 1, 92, 'unlocked', '2025-11-10 17:31:12', '2025-11-10 17:31:12', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:31:12', '2025-11-10 17:31:12'),
(148, 13, 92, 'unlocked', '2025-11-10 17:31:12', '2025-11-10 17:31:12', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:31:12', '2025-11-10 17:31:12'),
(149, 14, 92, 'unlocked', '2025-11-10 17:31:12', '2025-11-10 17:31:12', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:31:12', '2025-11-10 17:31:12'),
(150, 15, 92, 'unlocked', '2025-11-10 17:31:12', '2025-11-10 17:31:12', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:31:12', '2025-11-10 17:31:12'),
(151, 1, 93, 'unlocked', '2025-11-10 17:33:45', '2025-11-10 17:33:45', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:33:45', '2025-11-10 17:33:45'),
(152, 13, 93, 'unlocked', '2025-11-10 17:33:45', '2025-11-10 17:33:45', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:33:45', '2025-11-10 17:33:45'),
(153, 14, 93, 'unlocked', '2025-11-10 17:33:45', '2025-11-10 17:33:45', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:33:45', '2025-11-10 17:33:45'),
(154, 15, 93, 'unlocked', '2025-11-10 17:33:45', '2025-11-10 17:33:45', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:33:45', '2025-11-10 17:33:45'),
(155, 1, 94, 'unlocked', '2025-11-10 17:37:31', '2025-11-10 17:37:31', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:37:31', '2025-11-10 17:37:31'),
(156, 13, 94, 'unlocked', '2025-11-10 17:37:31', '2025-11-10 17:37:31', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:37:31', '2025-11-10 17:37:31'),
(157, 14, 94, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 17:37:31', '2025-11-10 17:37:31'),
(158, 15, 94, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 17:37:31', '2025-11-10 17:37:31'),
(159, 1, 95, 'unlocked', '2025-11-10 17:40:25', '2025-11-10 17:40:25', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:40:25', '2025-11-10 17:40:25'),
(160, 13, 95, 'unlocked', '2025-11-10 17:40:25', '2025-11-10 17:40:25', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:40:25', '2025-11-10 17:40:25'),
(161, 14, 95, 'unlocked', '2025-11-10 17:40:25', '2025-11-10 17:40:25', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:40:25', '2025-11-10 17:40:25'),
(162, 15, 95, 'unlocked', '2025-11-10 17:40:25', '2025-11-10 17:40:25', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:40:25', '2025-11-10 17:40:25'),
(163, 1, 96, 'unlocked', '2025-11-10 17:43:04', '2025-11-10 17:43:04', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:43:04', '2025-11-10 17:43:04'),
(164, 13, 96, 'unlocked', '2025-11-10 17:43:04', '2025-11-10 17:43:04', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:43:04', '2025-11-10 17:43:04'),
(165, 14, 96, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 17:43:04', '2025-11-10 17:43:04'),
(166, 15, 96, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 17:43:04', '2025-11-10 17:43:04'),
(167, 1, 97, 'unlocked', '2025-11-10 17:46:06', '2025-11-10 17:46:06', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:46:06', '2025-11-10 17:46:06'),
(168, 13, 97, 'unlocked', '2025-11-10 17:46:06', '2025-11-10 17:46:06', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:46:06', '2025-11-10 17:46:06'),
(169, 14, 97, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 17:46:06', '2025-11-10 17:46:06'),
(170, 15, 97, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 17:46:06', '2025-11-10 17:46:06'),
(171, 1, 98, 'unlocked', '2025-11-10 17:49:30', '2025-11-10 17:49:30', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:49:30', '2025-11-10 17:49:30'),
(172, 13, 98, 'unlocked', '2025-11-10 17:49:30', '2025-11-10 17:49:30', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:49:30', '2025-11-10 17:49:30'),
(173, 14, 98, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 17:49:30', '2025-11-10 17:49:30'),
(174, 15, 98, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 17:49:30', '2025-11-10 17:49:30'),
(175, 1, 13, 'unlocked', '2025-11-10 17:53:23', '2025-11-10 17:53:23', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:53:23', '2025-11-10 17:53:23'),
(176, 13, 13, 'unlocked', '2025-11-10 17:53:23', '2025-11-10 17:53:23', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:53:23', '2025-11-10 17:53:23'),
(177, 14, 13, 'unlocked', '2025-11-10 17:53:23', '2025-11-10 17:53:23', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:53:23', '2025-11-10 17:53:23'),
(178, 15, 13, 'unlocked', '2025-11-10 17:53:23', '2025-11-10 17:53:23', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:53:23', '2025-11-10 17:53:23'),
(179, 1, 100, 'unlocked', '2025-11-10 17:59:48', '2025-11-10 17:59:48', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:59:48', '2025-11-10 17:59:48'),
(180, 13, 100, 'unlocked', '2025-11-10 17:59:48', '2025-11-10 17:59:48', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:59:48', '2025-11-10 17:59:48'),
(181, 14, 100, 'unlocked', '2025-11-10 17:59:48', '2025-11-10 17:59:48', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:59:48', '2025-11-10 17:59:48'),
(182, 15, 100, 'unlocked', '2025-11-10 17:59:48', '2025-11-10 17:59:48', NULL, 1, NULL, NULL, NULL, '2025-11-10 17:59:48', '2025-11-10 17:59:48'),
(183, 1, 101, 'unlocked', '2025-11-11 15:13:30', '2025-11-11 15:13:30', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:13:30', '2025-11-11 15:13:30'),
(184, 13, 101, 'unlocked', '2025-11-11 15:13:30', '2025-11-11 15:13:30', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:13:30', '2025-11-11 15:13:30'),
(185, 14, 101, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 15:13:30', '2025-11-11 15:13:30'),
(186, 15, 101, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 15:13:30', '2025-11-11 15:13:30'),
(187, 1, 103, 'unlocked', '2025-11-11 15:18:28', '2025-11-11 15:18:28', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:18:28', '2025-11-11 15:18:28'),
(188, 13, 103, 'unlocked', '2025-11-11 15:18:28', '2025-11-11 15:18:28', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:18:28', '2025-11-11 15:18:28'),
(189, 14, 103, 'unlocked', '2025-11-11 15:18:28', '2025-11-11 15:18:28', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:18:28', '2025-11-11 15:18:28'),
(190, 15, 103, 'unlocked', '2025-11-11 15:18:28', '2025-11-11 15:18:28', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:18:28', '2025-11-11 15:18:28'),
(191, 1, 104, 'unlocked', '2025-11-11 15:21:18', '2025-11-11 15:21:18', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:21:18', '2025-11-11 15:21:18'),
(192, 13, 104, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 15:21:18', '2025-11-11 15:21:18'),
(193, 14, 104, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 15:21:18', '2025-11-11 15:21:18'),
(194, 15, 104, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 15:21:18', '2025-11-11 15:21:18'),
(195, 1, 105, 'unlocked', '2025-11-11 15:25:50', '2025-11-11 15:25:50', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:25:50', '2025-11-11 15:25:50'),
(196, 13, 105, 'unlocked', '2025-11-11 15:25:50', '2025-11-11 15:25:50', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:25:50', '2025-11-11 15:25:50'),
(197, 14, 105, 'unlocked', '2025-11-11 15:25:50', '2025-11-11 15:25:50', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:25:50', '2025-11-11 15:25:50'),
(198, 15, 105, 'unlocked', '2025-11-11 15:25:50', '2025-11-11 15:25:50', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:25:50', '2025-11-11 15:25:50'),
(199, 1, 106, 'unlocked', '2025-11-11 15:28:44', '2025-11-11 15:28:44', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:28:44', '2025-11-11 15:28:44'),
(200, 13, 106, 'unlocked', '2025-11-11 15:28:44', '2025-11-11 15:28:44', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:28:44', '2025-11-11 15:28:44'),
(201, 14, 106, 'unlocked', '2025-11-11 15:28:44', '2025-11-11 15:28:44', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:28:44', '2025-11-11 15:28:44'),
(202, 15, 106, 'unlocked', '2025-11-11 15:28:44', '2025-11-11 15:28:44', NULL, 1, NULL, NULL, NULL, '2025-11-11 15:28:44', '2025-11-11 15:28:44'),
(203, 1, 107, 'unlocked', '2025-11-11 16:06:26', '2025-11-11 16:06:26', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:06:26', '2025-11-11 16:06:26'),
(204, 13, 107, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:06:26', '2025-11-11 16:06:26'),
(205, 14, 107, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:06:26', '2025-11-11 16:06:26'),
(206, 15, 107, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:06:26', '2025-11-11 16:06:26'),
(207, 1, 108, 'unlocked', '2025-11-11 16:11:20', '2025-11-11 16:11:20', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:11:20', '2025-11-11 16:11:20'),
(208, 13, 108, 'unlocked', '2025-11-11 16:11:20', '2025-11-11 16:11:20', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:11:20', '2025-11-11 16:11:20'),
(209, 14, 108, 'unlocked', '2025-11-11 16:11:20', '2025-11-11 16:11:20', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:11:20', '2025-11-11 16:11:20'),
(210, 15, 108, 'unlocked', '2025-11-11 16:11:20', '2025-11-11 16:11:20', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:11:20', '2025-11-11 16:11:20'),
(211, 1, 109, 'unlocked', '2025-11-11 16:12:53', '2025-11-11 16:12:53', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:12:53', '2025-11-11 16:12:53'),
(212, 13, 109, 'unlocked', '2025-11-11 16:12:53', '2025-11-11 16:12:53', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:12:53', '2025-11-11 16:12:53'),
(213, 14, 109, 'unlocked', '2025-11-11 16:12:53', '2025-11-11 16:12:53', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:12:53', '2025-11-11 16:12:53'),
(214, 15, 109, 'unlocked', '2025-11-11 16:12:53', '2025-11-11 16:12:53', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:12:53', '2025-11-11 16:12:53'),
(215, 1, 110, 'unlocked', '2025-11-11 16:18:19', '2025-11-11 16:18:19', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:18:19', '2025-11-11 16:18:19'),
(216, 13, 110, 'unlocked', '2025-11-11 16:18:19', '2025-11-11 16:18:19', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:18:20', '2025-11-11 16:18:20'),
(217, 14, 110, 'unlocked', '2025-11-11 16:18:19', '2025-11-11 16:18:19', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:18:20', '2025-11-11 16:18:20'),
(218, 15, 110, 'unlocked', '2025-11-11 16:18:19', '2025-11-11 16:18:19', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:18:20', '2025-11-11 16:18:20'),
(219, 1, 111, 'unlocked', '2025-11-11 16:20:24', '2025-11-11 16:20:24', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:20:24', '2025-11-11 16:20:24'),
(220, 13, 111, 'unlocked', '2025-11-11 16:20:24', '2025-11-11 16:20:24', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:20:24', '2025-11-11 16:20:24'),
(221, 14, 111, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:20:24', '2025-11-11 16:20:24'),
(222, 15, 111, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:20:24', '2025-11-11 16:20:24'),
(223, 1, 112, 'unlocked', '2025-11-11 16:25:34', '2025-11-11 16:25:34', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:25:34', '2025-11-11 16:25:34'),
(224, 13, 112, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:25:34', '2025-11-11 16:25:34'),
(225, 14, 112, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:25:34', '2025-11-11 16:25:34'),
(226, 15, 112, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:25:34', '2025-11-11 16:25:34'),
(227, 1, 113, 'unlocked', '2025-11-11 16:27:20', '2025-11-11 16:27:20', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:27:20', '2025-11-11 16:27:20'),
(228, 13, 113, 'unlocked', '2025-11-11 16:27:20', '2025-11-11 16:27:20', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:27:20', '2025-11-11 16:27:20'),
(229, 14, 113, 'unlocked', '2025-11-11 16:27:29', '2025-11-11 16:27:29', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:27:20', '2025-11-11 16:27:29'),
(230, 15, 113, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:27:20', '2025-11-11 16:27:20'),
(231, 1, 114, 'unlocked', '2025-11-11 16:36:51', '2025-11-11 16:36:51', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:36:51', '2025-11-11 16:36:51'),
(232, 13, 114, 'unlocked', '2025-11-11 16:36:51', '2025-11-11 16:36:51', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:36:51', '2025-11-11 16:36:51'),
(233, 14, 114, 'unlocked', '2025-11-11 16:36:51', '2025-11-11 16:36:51', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:36:51', '2025-11-11 16:36:51'),
(234, 15, 114, 'unlocked', '2025-11-11 16:36:51', '2025-11-11 16:36:51', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:36:51', '2025-11-11 16:36:51'),
(235, 1, 115, 'unlocked', '2025-11-11 16:39:30', '2025-11-11 16:39:30', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:39:30', '2025-11-11 16:39:30'),
(236, 13, 115, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:39:30', '2025-11-11 16:39:30'),
(237, 14, 115, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:39:30', '2025-11-11 16:39:30'),
(238, 15, 115, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:39:30', '2025-11-11 16:39:30'),
(239, 1, 116, 'unlocked', '2025-11-11 16:47:44', '2025-11-11 16:47:44', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:47:44', '2025-11-11 16:47:44'),
(240, 13, 116, 'unlocked', '2025-11-11 16:47:44', '2025-11-11 16:47:44', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:47:44', '2025-11-11 16:47:44'),
(241, 14, 116, 'unlocked', '2025-11-11 16:47:44', '2025-11-11 16:47:44', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:47:44', '2025-11-11 16:47:44'),
(242, 15, 116, 'unlocked', '2025-11-11 16:47:44', '2025-11-11 16:47:44', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:47:44', '2025-11-11 16:47:44'),
(243, 1, 117, 'unlocked', '2025-11-11 16:50:10', '2025-11-11 16:50:10', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:50:10', '2025-11-11 16:50:10'),
(244, 13, 117, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:50:10', '2025-11-11 16:50:10'),
(245, 14, 117, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:50:10', '2025-11-11 16:50:10'),
(246, 15, 117, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 16:50:10', '2025-11-11 16:50:10'),
(247, 1, 118, 'unlocked', '2025-11-11 16:53:35', '2025-11-11 16:53:35', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:53:35', '2025-11-11 16:53:35'),
(248, 13, 118, 'unlocked', '2025-11-11 16:53:35', '2025-11-11 16:53:35', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:53:35', '2025-11-11 16:53:35'),
(249, 14, 118, 'unlocked', '2025-11-11 16:53:35', '2025-11-11 16:53:35', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:53:35', '2025-11-11 16:53:35'),
(250, 15, 118, 'unlocked', '2025-11-11 16:53:35', '2025-11-11 16:53:35', NULL, 1, NULL, NULL, NULL, '2025-11-11 16:53:35', '2025-11-11 16:53:35'),
(251, 1, 119, 'unlocked', '2025-11-11 17:23:25', '2025-11-11 17:23:25', NULL, 1, NULL, NULL, NULL, '2025-11-11 17:23:25', '2025-11-11 17:23:25'),
(252, 13, 119, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 17:23:25', '2025-11-11 17:23:25'),
(253, 14, 119, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 17:23:25', '2025-11-11 17:23:25'),
(254, 15, 119, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 17:23:25', '2025-11-11 17:23:25'),
(255, 1, 120, 'unlocked', '2025-11-11 17:54:40', '2025-11-11 17:54:40', NULL, 1, NULL, NULL, NULL, '2025-11-11 17:54:40', '2025-11-11 17:54:40'),
(256, 13, 120, 'unlocked', '2025-11-11 17:54:40', '2025-11-11 17:54:40', NULL, 1, NULL, NULL, NULL, '2025-11-11 17:54:40', '2025-11-11 17:54:40'),
(257, 14, 120, 'unlocked', '2025-11-11 17:54:40', '2025-11-11 17:54:40', NULL, 1, NULL, NULL, NULL, '2025-11-11 17:54:40', '2025-11-11 17:54:40'),
(258, 15, 120, 'unlocked', '2025-11-11 17:54:40', '2025-11-11 17:54:40', NULL, 1, NULL, NULL, NULL, '2025-11-11 17:54:40', '2025-11-11 17:54:40'),
(259, 1, 121, 'unlocked', '2025-11-11 17:56:19', '2025-11-11 17:56:19', NULL, 1, NULL, NULL, NULL, '2025-11-11 17:56:19', '2025-11-11 17:56:19'),
(260, 13, 121, 'unlocked', '2025-11-11 17:56:19', '2025-11-11 17:56:19', NULL, 1, NULL, NULL, NULL, '2025-11-11 17:56:19', '2025-11-11 17:56:19'),
(261, 14, 121, 'unlocked', '2025-11-11 17:56:19', '2025-11-11 17:56:19', NULL, 1, NULL, NULL, NULL, '2025-11-11 17:56:19', '2025-11-11 17:56:19'),
(262, 15, 121, 'unlocked', '2025-11-11 17:56:19', '2025-11-11 17:56:19', NULL, 1, NULL, NULL, NULL, '2025-11-11 17:56:19', '2025-11-11 17:56:19'),
(263, 1, 122, 'unlocked', '2025-11-11 18:07:22', '2025-11-11 18:07:22', NULL, 1, NULL, NULL, NULL, '2025-11-11 18:07:22', '2025-11-11 18:07:22'),
(264, 13, 122, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 18:07:22', '2025-11-11 18:07:22'),
(265, 14, 122, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 18:07:22', '2025-11-11 18:07:22'),
(266, 15, 122, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 18:07:22', '2025-11-11 18:07:22'),
(267, 1, 123, 'unlocked', '2025-11-11 18:11:44', '2025-11-11 18:11:44', NULL, 1, NULL, NULL, NULL, '2025-11-11 18:11:44', '2025-11-11 18:11:44'),
(268, 13, 123, 'unlocked', '2025-11-11 18:11:44', '2025-11-11 18:11:44', NULL, 1, NULL, NULL, NULL, '2025-11-11 18:11:44', '2025-11-11 18:11:44'),
(269, 14, 123, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 18:11:44', '2025-11-11 18:11:44'),
(270, 15, 123, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 18:11:44', '2025-11-11 18:11:44'),
(271, 1, 124, 'unlocked', '2025-11-11 18:13:18', '2025-11-11 18:13:18', NULL, 1, NULL, NULL, NULL, '2025-11-11 18:13:18', '2025-11-11 18:13:18'),
(272, 13, 124, 'unlocked', '2025-11-11 18:13:18', '2025-11-11 18:13:18', NULL, 1, NULL, NULL, NULL, '2025-11-11 18:13:18', '2025-11-11 18:13:18'),
(273, 14, 124, 'unlocked', '2025-11-11 18:13:18', '2025-11-11 18:13:18', NULL, 1, NULL, NULL, NULL, '2025-11-11 18:13:18', '2025-11-11 18:13:18'),
(274, 15, 124, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-11 18:13:18', '2025-11-11 18:13:18'),
(275, 1, 125, 'unlocked', '2025-11-11 18:15:52', '2025-11-11 18:15:52', NULL, 1, NULL, NULL, NULL, '2025-11-11 18:15:52', '2025-11-11 18:15:52'),
(276, 13, 125, 'unlocked', '2025-11-11 18:15:52', '2025-11-11 18:15:52', NULL, 1, NULL, NULL, NULL, '2025-11-11 18:15:52', '2025-11-11 18:15:52'),
(277, 14, 125, 'unlocked', '2025-11-11 18:15:52', '2025-11-11 18:15:52', NULL, 1, NULL, NULL, NULL, '2025-11-11 18:15:52', '2025-11-11 18:15:52'),
(278, 15, 125, 'unlocked', '2025-11-11 18:15:52', '2025-11-11 18:15:52', NULL, 1, NULL, NULL, NULL, '2025-11-11 18:15:52', '2025-11-11 18:15:52'),
(279, 1, 127, 'unlocked', '2025-11-13 15:34:50', '2025-11-13 15:34:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:34:50', '2025-11-13 15:34:50'),
(280, 13, 127, 'unlocked', '2025-11-13 15:34:50', '2025-11-13 15:34:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:34:50', '2025-11-13 15:34:50'),
(281, 14, 127, 'unlocked', '2025-11-13 15:34:50', '2025-11-13 15:34:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:34:50', '2025-11-13 15:34:50'),
(282, 15, 127, 'unlocked', '2025-11-13 15:34:50', '2025-11-13 15:34:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:34:50', '2025-11-13 15:34:50'),
(283, 1, 128, 'unlocked', '2025-11-13 15:41:00', '2025-11-13 15:41:00', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:41:00', '2025-11-13 15:41:00'),
(284, 13, 128, 'unlocked', '2025-11-13 15:41:00', '2025-11-13 15:41:00', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:41:00', '2025-11-13 15:41:00'),
(285, 14, 128, 'unlocked', '2025-11-13 15:41:00', '2025-11-13 15:41:00', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:41:00', '2025-11-13 15:41:00'),
(286, 15, 128, 'unlocked', '2025-11-13 15:41:00', '2025-11-13 15:41:00', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:41:00', '2025-11-13 15:41:00'),
(287, 16, 129, 'unlocked', '2025-11-13 15:44:17', '2025-11-13 15:44:17', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:44:17', '2025-11-13 15:44:17'),
(288, 17, 129, 'unlocked', '2025-11-13 15:44:17', '2025-11-13 15:44:17', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:44:17', '2025-11-13 15:44:17'),
(289, 18, 129, 'unlocked', '2025-11-13 15:44:17', '2025-11-13 15:44:17', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:44:17', '2025-11-13 15:44:17'),
(290, 19, 129, 'unlocked', '2025-11-13 15:44:17', '2025-11-13 15:44:17', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:44:17', '2025-11-13 15:44:17'),
(291, 1, 130, 'unlocked', '2025-11-13 15:44:48', '2025-11-13 15:44:48', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:44:48', '2025-11-13 15:44:48'),
(292, 13, 130, 'unlocked', '2025-11-13 15:44:48', '2025-11-13 15:44:48', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:44:48', '2025-11-13 15:44:48'),
(293, 14, 130, 'unlocked', '2025-11-13 15:44:48', '2025-11-13 15:44:48', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:44:48', '2025-11-13 15:44:48'),
(294, 15, 130, 'unlocked', '2025-11-13 16:39:04', '2025-11-13 16:39:04', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:44:48', '2025-11-13 16:39:04'),
(295, 16, 131, 'unlocked', '2025-11-13 15:46:50', '2025-11-13 15:46:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:46:50', '2025-11-13 15:46:50'),
(296, 17, 131, 'unlocked', '2025-11-13 15:46:50', '2025-11-13 15:46:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:46:50', '2025-11-13 15:46:50'),
(297, 18, 131, 'unlocked', '2025-11-13 15:46:50', '2025-11-13 15:46:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:46:50', '2025-11-13 15:46:50'),
(298, 19, 131, 'unlocked', '2025-11-13 15:46:50', '2025-11-13 15:46:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:46:50', '2025-11-13 15:46:50'),
(299, 1, 133, 'unlocked', '2025-11-13 15:49:35', '2025-11-13 15:49:35', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:49:35', '2025-11-13 15:49:35'),
(300, 13, 133, 'unlocked', '2025-11-13 15:49:35', '2025-11-13 15:49:35', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:49:35', '2025-11-13 15:49:35'),
(301, 14, 133, 'unlocked', '2025-11-13 15:49:35', '2025-11-13 15:49:35', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:49:35', '2025-11-13 15:49:35'),
(302, 15, 133, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 15:49:35', '2025-11-13 15:49:35'),
(303, 16, 65, 'unlocked', '2025-11-13 15:55:16', '2025-11-13 15:55:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:55:16', '2025-11-13 15:55:16'),
(304, 17, 65, 'unlocked', '2025-11-13 15:55:16', '2025-11-13 15:55:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:55:16', '2025-11-13 15:55:16'),
(305, 18, 65, 'unlocked', '2025-11-13 15:55:16', '2025-11-13 15:55:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:55:16', '2025-11-13 15:55:16'),
(306, 19, 65, 'unlocked', '2025-11-13 15:55:16', '2025-11-13 15:55:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:55:16', '2025-11-13 15:55:16'),
(307, 1, 134, 'unlocked', '2025-11-13 15:58:23', '2025-11-13 15:58:23', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:58:23', '2025-11-13 15:58:23'),
(308, 13, 134, 'unlocked', '2025-11-13 15:58:23', '2025-11-13 15:58:23', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:58:23', '2025-11-13 15:58:23'),
(309, 14, 134, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 15:58:23', '2025-11-13 15:58:23'),
(310, 15, 134, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 15:58:23', '2025-11-13 15:58:23'),
(311, 1, 135, 'unlocked', '2025-11-13 15:58:38', '2025-11-13 15:58:38', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:58:38', '2025-11-13 15:58:38'),
(312, 13, 135, 'unlocked', '2025-11-13 15:58:38', '2025-11-13 15:58:38', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:58:38', '2025-11-13 15:58:38'),
(313, 14, 135, 'unlocked', '2025-11-13 15:58:38', '2025-11-13 15:58:38', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:58:38', '2025-11-13 15:58:38'),
(314, 15, 135, 'unlocked', '2025-11-13 15:58:38', '2025-11-13 15:58:38', NULL, 1, NULL, NULL, NULL, '2025-11-13 15:58:38', '2025-11-13 15:58:38'),
(315, 1, 136, 'unlocked', '2025-11-13 16:01:26', '2025-11-13 16:01:26', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:01:26', '2025-11-13 16:01:26'),
(316, 13, 136, 'unlocked', '2025-11-13 16:01:26', '2025-11-13 16:01:26', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:01:26', '2025-11-13 16:01:26'),
(317, 14, 136, 'unlocked', '2025-11-13 16:01:26', '2025-11-13 16:01:26', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:01:26', '2025-11-13 16:01:26'),
(318, 15, 136, 'unlocked', '2025-11-13 16:01:26', '2025-11-13 16:01:26', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:01:26', '2025-11-13 16:01:26'),
(319, 16, 137, 'unlocked', '2025-11-13 16:02:27', '2025-11-13 16:02:27', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:02:27', '2025-11-13 16:02:27'),
(320, 17, 137, 'unlocked', '2025-11-13 16:02:27', '2025-11-13 16:02:27', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:02:27', '2025-11-13 16:02:27'),
(321, 18, 137, 'unlocked', '2025-11-13 16:02:27', '2025-11-13 16:02:27', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:02:27', '2025-11-13 16:02:27'),
(322, 19, 137, 'unlocked', '2025-11-13 16:02:27', '2025-11-13 16:02:27', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:02:27', '2025-11-13 16:02:27'),
(323, 1, 137, 'unlocked', '2025-11-13 16:03:49', '2025-11-13 16:03:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:03:49', '2025-11-13 16:03:49'),
(324, 13, 137, 'unlocked', '2025-11-13 16:03:49', '2025-11-13 16:03:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:03:49', '2025-11-13 16:03:49'),
(325, 14, 137, 'unlocked', '2025-11-13 16:03:49', '2025-11-13 16:03:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:03:49', '2025-11-13 16:03:49'),
(326, 15, 137, 'unlocked', '2025-11-13 16:03:49', '2025-11-13 16:03:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:03:49', '2025-11-13 16:03:49'),
(327, 1, 138, 'unlocked', '2025-11-13 16:04:39', '2025-11-13 16:04:39', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:04:39', '2025-11-13 16:04:39'),
(328, 13, 138, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:04:39', '2025-11-13 16:04:39'),
(329, 14, 138, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:04:39', '2025-11-13 16:04:39'),
(330, 15, 138, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:04:39', '2025-11-13 16:04:39'),
(331, 16, 139, 'unlocked', '2025-11-13 16:05:50', '2025-11-13 16:05:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:05:50', '2025-11-13 16:05:50'),
(332, 17, 139, 'unlocked', '2025-11-13 16:05:50', '2025-11-13 16:05:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:05:50', '2025-11-13 16:05:50'),
(333, 18, 139, 'unlocked', '2025-11-13 16:05:50', '2025-11-13 16:05:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:05:50', '2025-11-13 16:05:50'),
(334, 19, 139, 'unlocked', '2025-11-13 16:05:50', '2025-11-13 16:05:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:05:50', '2025-11-13 16:05:50'),
(335, 1, 141, 'unlocked', '2025-11-13 16:07:58', '2025-11-13 16:07:58', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:07:58', '2025-11-13 16:07:58'),
(336, 13, 141, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:07:58', '2025-11-13 16:07:58'),
(337, 14, 141, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:07:58', '2025-11-13 16:07:58'),
(338, 15, 141, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:07:58', '2025-11-13 16:07:58'),
(339, 16, 140, 'unlocked', '2025-11-13 16:08:02', '2025-11-13 16:08:02', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:08:02', '2025-11-13 16:08:02'),
(340, 17, 140, 'unlocked', '2025-11-13 16:08:02', '2025-11-13 16:08:02', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:08:02', '2025-11-13 16:08:02'),
(341, 18, 140, 'unlocked', '2025-11-13 16:08:02', '2025-11-13 16:08:02', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:08:02', '2025-11-13 16:08:02'),
(342, 19, 140, 'unlocked', '2025-11-13 16:08:02', '2025-11-13 16:08:02', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:08:02', '2025-11-13 16:08:02'),
(343, 1, 140, 'unlocked', '2025-11-13 16:08:33', '2025-11-13 16:08:33', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:08:33', '2025-11-13 16:08:33'),
(344, 13, 140, 'unlocked', '2025-11-13 16:08:33', '2025-11-13 16:08:33', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:08:33', '2025-11-13 16:08:33'),
(345, 14, 140, 'unlocked', '2025-11-13 16:08:33', '2025-11-13 16:08:33', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:08:33', '2025-11-13 16:08:33'),
(346, 15, 140, 'unlocked', '2025-11-13 16:08:33', '2025-11-13 16:08:33', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:08:33', '2025-11-13 16:08:33'),
(347, 1, 142, 'unlocked', '2025-11-13 16:11:11', '2025-11-13 16:11:11', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:11:11', '2025-11-13 16:11:11'),
(348, 13, 142, 'unlocked', '2025-11-13 16:11:11', '2025-11-13 16:11:11', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:11:11', '2025-11-13 16:11:11'),
(349, 14, 142, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:11:11', '2025-11-13 16:11:11'),
(350, 15, 142, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:11:11', '2025-11-13 16:11:11'),
(351, 20, 143, 'unlocked', '2025-11-13 16:13:22', '2025-11-13 16:13:22', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:13:22', '2025-11-13 16:13:22'),
(352, 21, 143, 'unlocked', '2025-11-13 16:13:22', '2025-11-13 16:13:22', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:13:22', '2025-11-13 16:13:22'),
(353, 22, 143, 'unlocked', '2025-11-13 16:13:22', '2025-11-13 16:13:22', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:13:22', '2025-11-13 16:13:22'),
(354, 23, 143, 'unlocked', '2025-11-13 16:13:22', '2025-11-13 16:13:22', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:13:22', '2025-11-13 16:13:22'),
(355, 24, 143, 'unlocked', '2025-11-13 16:13:22', '2025-11-13 16:13:22', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:13:22', '2025-11-13 16:13:22'),
(356, 1, 144, 'unlocked', '2025-11-13 16:14:36', '2025-11-13 16:14:36', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:14:36', '2025-11-13 16:14:36'),
(357, 13, 144, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:14:36', '2025-11-13 16:14:36'),
(358, 14, 144, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:14:36', '2025-11-13 16:14:36'),
(359, 15, 144, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 16:14:36', '2025-11-13 16:14:36'),
(360, 16, 100, 'unlocked', '2025-11-13 16:15:50', '2025-11-13 16:15:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:15:50', '2025-11-13 16:15:50'),
(361, 17, 100, 'unlocked', '2025-11-13 16:15:50', '2025-11-13 16:15:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:15:50', '2025-11-13 16:15:50'),
(362, 18, 100, 'unlocked', '2025-11-13 16:15:50', '2025-11-13 16:15:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:15:50', '2025-11-13 16:15:50'),
(363, 19, 100, 'unlocked', '2025-11-13 16:15:50', '2025-11-13 16:15:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:15:50', '2025-11-13 16:15:50'),
(364, 1, 147, 'unlocked', '2025-11-13 16:19:47', '2025-11-13 16:19:47', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:19:47', '2025-11-13 16:19:47'),
(365, 13, 147, 'unlocked', '2025-11-13 16:19:47', '2025-11-13 16:19:47', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:19:47', '2025-11-13 16:19:47'),
(366, 14, 147, 'unlocked', '2025-11-13 16:19:47', '2025-11-13 16:19:47', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:19:47', '2025-11-13 16:19:47'),
(367, 15, 147, 'unlocked', '2025-11-13 16:19:47', '2025-11-13 16:19:47', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:19:47', '2025-11-13 16:19:47'),
(368, 1, 148, 'unlocked', '2025-11-13 16:19:47', '2025-11-13 16:19:47', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:19:47', '2025-11-13 16:19:47'),
(369, 13, 148, 'unlocked', '2025-11-13 16:19:47', '2025-11-13 16:19:47', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:19:47', '2025-11-13 16:19:47'),
(370, 14, 148, 'unlocked', '2025-11-13 16:19:47', '2025-11-13 16:19:47', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:19:47', '2025-11-13 16:19:47'),
(371, 15, 148, 'unlocked', '2025-11-13 16:19:47', '2025-11-13 16:19:47', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:19:47', '2025-11-13 16:19:47'),
(372, 25, 148, 'unlocked', '2025-11-13 16:21:50', '2025-11-13 16:21:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:21:50', '2025-11-13 16:21:50');
INSERT INTO `modulo_user` (`id`, `modulo_id`, `user_id`, `status`, `assigned_at`, `available_from`, `available_until`, `released_by`, `payment_reference`, `notes`, `revoked_at`, `created_at`, `updated_at`) VALUES
(373, 26, 148, 'unlocked', '2025-11-13 16:21:50', '2025-11-13 16:21:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:21:50', '2025-11-13 16:21:50'),
(374, 27, 148, 'unlocked', '2025-11-13 16:21:50', '2025-11-13 16:21:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:21:50', '2025-11-13 16:21:50'),
(375, 28, 148, 'unlocked', '2025-11-13 16:21:50', '2025-11-13 16:21:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:21:50', '2025-11-13 16:21:50'),
(376, 29, 148, 'unlocked', '2025-11-13 16:21:50', '2025-11-13 16:21:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:21:50', '2025-11-13 16:21:50'),
(377, 30, 148, 'unlocked', '2025-11-13 16:21:50', '2025-11-13 16:21:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:21:50', '2025-11-13 16:21:50'),
(378, 1, 149, 'unlocked', '2025-11-13 16:21:57', '2025-11-13 16:21:57', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:21:57', '2025-11-13 16:21:57'),
(379, 13, 149, 'unlocked', '2025-11-13 16:21:57', '2025-11-13 16:21:57', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:21:57', '2025-11-13 16:21:57'),
(380, 14, 149, 'unlocked', '2025-11-13 16:21:57', '2025-11-13 16:21:57', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:21:57', '2025-11-13 16:21:57'),
(381, 15, 149, 'unlocked', '2025-11-13 16:21:57', '2025-11-13 16:21:57', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:21:57', '2025-11-13 16:21:57'),
(382, 1, 150, 'unlocked', '2025-11-13 16:24:26', '2025-11-13 16:24:26', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:24:26', '2025-11-13 16:24:26'),
(383, 13, 150, 'unlocked', '2025-11-13 16:24:26', '2025-11-13 16:24:26', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:24:26', '2025-11-13 16:24:26'),
(384, 14, 150, 'unlocked', '2025-11-13 16:24:26', '2025-11-13 16:24:26', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:24:26', '2025-11-13 16:24:26'),
(385, 15, 150, 'unlocked', '2025-11-13 16:24:26', '2025-11-13 16:24:26', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:24:26', '2025-11-13 16:24:26'),
(386, 31, 151, 'unlocked', '2025-11-13 16:26:01', '2025-11-13 16:26:01', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:26:01', '2025-11-13 16:26:01'),
(387, 32, 151, 'unlocked', '2025-11-13 16:26:01', '2025-11-13 16:26:01', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:26:01', '2025-11-13 16:26:01'),
(388, 1, 152, 'unlocked', '2025-11-13 16:27:49', '2025-11-13 16:27:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:27:49', '2025-11-13 16:27:49'),
(389, 13, 152, 'unlocked', '2025-11-13 16:27:49', '2025-11-13 16:27:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:27:49', '2025-11-13 16:27:49'),
(390, 14, 152, 'unlocked', '2025-11-13 16:27:49', '2025-11-13 16:27:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:27:49', '2025-11-13 16:27:49'),
(391, 15, 152, 'unlocked', '2025-11-13 16:27:49', '2025-11-13 16:27:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:27:49', '2025-11-13 16:27:49'),
(392, 1, 151, 'unlocked', '2025-11-13 16:30:01', '2025-11-13 16:30:01', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:30:01', '2025-11-13 16:30:01'),
(393, 13, 151, 'unlocked', '2025-11-13 16:30:01', '2025-11-13 16:30:01', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:30:01', '2025-11-13 16:30:01'),
(394, 14, 151, 'unlocked', '2025-11-13 16:30:01', '2025-11-13 16:30:01', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:30:01', '2025-11-13 16:30:01'),
(395, 15, 151, 'unlocked', '2025-11-13 16:30:01', '2025-11-13 16:30:01', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:30:01', '2025-11-13 16:30:01'),
(396, 33, 105, 'unlocked', '2025-11-13 16:37:29', '2025-11-13 16:37:29', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:37:29', '2025-11-13 16:37:29'),
(397, 34, 105, 'unlocked', '2025-11-13 16:37:29', '2025-11-13 16:37:29', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:37:29', '2025-11-13 16:37:29'),
(398, 35, 105, 'unlocked', '2025-11-13 16:37:29', '2025-11-13 16:37:29', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:37:29', '2025-11-13 16:37:29'),
(399, 36, 105, 'unlocked', '2025-11-13 16:37:29', '2025-11-13 16:37:29', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:37:29', '2025-11-13 16:37:29'),
(400, 16, 155, 'unlocked', '2025-11-13 16:41:16', '2025-11-13 16:41:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:41:16', '2025-11-13 16:41:16'),
(401, 17, 155, 'unlocked', '2025-11-13 16:41:16', '2025-11-13 16:41:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:41:16', '2025-11-13 16:41:16'),
(402, 18, 155, 'unlocked', '2025-11-13 16:41:16', '2025-11-13 16:41:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:41:16', '2025-11-13 16:41:16'),
(403, 19, 155, 'unlocked', '2025-11-13 16:41:16', '2025-11-13 16:41:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:41:16', '2025-11-13 16:41:16'),
(404, 1, 157, 'unlocked', '2025-11-13 16:54:56', '2025-11-13 16:54:56', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:54:56', '2025-11-13 16:54:56'),
(405, 13, 157, 'unlocked', '2025-11-13 16:54:56', '2025-11-13 16:54:56', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:54:56', '2025-11-13 16:54:56'),
(406, 14, 157, 'unlocked', '2025-11-13 16:54:56', '2025-11-13 16:54:56', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:54:56', '2025-11-13 16:54:56'),
(407, 15, 157, 'unlocked', '2025-11-13 16:54:56', '2025-11-13 16:54:56', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:54:56', '2025-11-13 16:54:56'),
(408, 1, 158, 'unlocked', '2025-11-13 16:55:30', '2025-11-13 16:55:30', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:55:30', '2025-11-13 16:55:30'),
(409, 13, 158, 'unlocked', '2025-11-13 16:55:30', '2025-11-13 16:55:30', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:55:30', '2025-11-13 16:55:30'),
(410, 14, 158, 'unlocked', '2025-11-13 16:55:30', '2025-11-13 16:55:30', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:55:30', '2025-11-13 16:55:30'),
(411, 15, 158, 'unlocked', '2025-11-13 16:55:30', '2025-11-13 16:55:30', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:55:30', '2025-11-13 16:55:30'),
(412, 38, 157, 'unlocked', '2025-11-13 16:57:23', '2025-11-13 16:57:23', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:57:23', '2025-11-13 16:57:23'),
(413, 39, 157, 'unlocked', '2025-11-13 16:57:23', '2025-11-13 16:57:23', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:57:23', '2025-11-13 16:57:23'),
(414, 40, 157, 'unlocked', '2025-11-13 16:57:23', '2025-11-13 16:57:23', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:57:23', '2025-11-13 16:57:23'),
(415, 41, 157, 'unlocked', '2025-11-13 16:57:23', '2025-11-13 16:57:23', NULL, 1, NULL, NULL, NULL, '2025-11-13 16:57:23', '2025-11-13 16:57:23'),
(416, 42, 160, 'unlocked', '2025-11-13 17:02:03', '2025-11-13 17:02:03', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:02:03', '2025-11-13 17:02:03'),
(417, 43, 160, 'unlocked', '2025-11-13 17:02:03', '2025-11-13 17:02:03', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:02:03', '2025-11-13 17:02:03'),
(418, 44, 160, 'unlocked', '2025-11-13 17:02:03', '2025-11-13 17:02:03', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:02:03', '2025-11-13 17:02:03'),
(419, 45, 160, 'unlocked', '2025-11-13 17:02:03', '2025-11-13 17:02:03', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:02:03', '2025-11-13 17:02:03'),
(420, 46, 160, 'unlocked', '2025-11-13 17:02:03', '2025-11-13 17:02:03', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:02:03', '2025-11-13 17:02:03'),
(421, 47, 160, 'unlocked', '2025-11-13 17:02:03', '2025-11-13 17:02:03', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:02:03', '2025-11-13 17:02:03'),
(422, 1, 159, 'unlocked', '2025-11-13 17:02:39', '2025-11-13 17:02:39', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:02:39', '2025-11-13 17:02:39'),
(423, 13, 159, 'unlocked', '2025-11-13 17:02:39', '2025-11-13 17:02:39', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:02:39', '2025-11-13 17:02:39'),
(424, 14, 159, 'unlocked', '2025-11-13 17:02:39', '2025-11-13 17:02:39', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:02:39', '2025-11-13 17:02:39'),
(425, 15, 159, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 17:02:39', '2025-11-13 17:02:39'),
(426, 1, 161, 'unlocked', '2025-11-13 17:05:47', '2025-11-13 17:05:47', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:05:47', '2025-11-13 17:05:47'),
(427, 13, 161, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 17:05:47', '2025-11-13 17:05:47'),
(428, 14, 161, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 17:05:47', '2025-11-13 17:05:47'),
(429, 15, 161, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 17:05:47', '2025-11-13 17:05:47'),
(430, 42, 162, 'unlocked', '2025-11-13 17:06:09', '2025-11-13 17:06:09', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:06:09', '2025-11-13 17:06:09'),
(431, 43, 162, 'unlocked', '2025-11-13 17:06:09', '2025-11-13 17:06:09', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:06:09', '2025-11-13 17:06:09'),
(432, 44, 162, 'unlocked', '2025-11-13 17:06:09', '2025-11-13 17:06:09', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:06:09', '2025-11-13 17:06:09'),
(433, 45, 162, 'unlocked', '2025-11-13 17:06:09', '2025-11-13 17:06:09', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:06:09', '2025-11-13 17:06:09'),
(434, 46, 162, 'unlocked', '2025-11-13 17:06:09', '2025-11-13 17:06:09', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:06:09', '2025-11-13 17:06:09'),
(435, 47, 162, 'unlocked', '2025-11-13 17:06:09', '2025-11-13 17:06:09', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:06:09', '2025-11-13 17:06:09'),
(436, 1, 163, 'unlocked', '2025-11-13 17:07:43', '2025-11-13 17:07:43', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:07:43', '2025-11-13 17:07:43'),
(437, 13, 163, 'unlocked', '2025-11-13 17:07:43', '2025-11-13 17:07:43', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:07:43', '2025-11-13 17:07:43'),
(438, 14, 163, 'unlocked', '2025-11-13 17:07:43', '2025-11-13 17:07:43', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:07:43', '2025-11-13 17:07:43'),
(439, 15, 163, 'unlocked', '2025-11-13 17:07:43', '2025-11-13 17:07:43', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:07:43', '2025-11-13 17:07:43'),
(440, 16, 110, 'unlocked', '2025-11-13 17:11:22', '2025-11-13 17:11:22', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:11:22', '2025-11-13 17:11:22'),
(441, 17, 110, 'unlocked', '2025-11-13 17:11:22', '2025-11-13 17:11:22', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:11:22', '2025-11-13 17:11:22'),
(442, 18, 110, 'unlocked', '2025-11-13 17:11:22', '2025-11-13 17:11:22', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:11:22', '2025-11-13 17:11:22'),
(443, 19, 110, 'unlocked', '2025-11-13 17:11:22', '2025-11-13 17:11:22', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:11:22', '2025-11-13 17:11:22'),
(444, 16, 66, 'unlocked', '2025-11-13 17:15:04', '2025-11-13 17:15:04', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:15:04', '2025-11-13 17:15:04'),
(445, 17, 66, 'unlocked', '2025-11-13 17:15:04', '2025-11-13 17:15:04', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:15:04', '2025-11-13 17:15:04'),
(446, 18, 66, 'unlocked', '2025-11-13 17:15:04', '2025-11-13 17:15:04', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:15:04', '2025-11-13 17:15:04'),
(447, 19, 66, 'unlocked', '2025-11-13 17:15:04', '2025-11-13 17:15:04', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:15:04', '2025-11-13 17:15:04'),
(448, 1, 166, 'unlocked', '2025-11-13 17:15:37', '2025-11-13 17:15:37', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:15:37', '2025-11-13 17:15:37'),
(449, 13, 166, 'unlocked', '2025-11-13 17:15:37', '2025-11-13 17:15:37', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:15:37', '2025-11-13 17:15:37'),
(450, 14, 166, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 17:15:37', '2025-11-13 17:15:37'),
(451, 15, 166, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 17:15:37', '2025-11-13 17:15:37'),
(452, 16, 167, 'unlocked', '2025-11-13 17:16:43', '2025-11-13 17:16:43', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:16:43', '2025-11-13 17:16:43'),
(453, 17, 167, 'unlocked', '2025-11-13 17:16:43', '2025-11-13 17:16:43', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:16:43', '2025-11-13 17:16:43'),
(454, 18, 167, 'unlocked', '2025-11-13 17:16:43', '2025-11-13 17:16:43', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:16:44', '2025-11-13 17:16:44'),
(455, 19, 167, 'unlocked', '2025-11-13 17:16:43', '2025-11-13 17:16:43', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:16:44', '2025-11-13 17:16:44'),
(456, 1, 168, 'unlocked', '2025-11-13 17:17:02', '2025-11-13 17:17:02', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:17:02', '2025-11-13 17:17:02'),
(457, 13, 168, 'unlocked', '2025-11-13 17:17:02', '2025-11-13 17:17:02', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:17:02', '2025-11-13 17:17:02'),
(458, 14, 168, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 17:17:02', '2025-11-13 17:17:02'),
(459, 15, 168, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 17:17:02', '2025-11-13 17:17:02'),
(460, 1, 169, 'unlocked', '2025-11-13 17:19:27', '2025-11-13 17:19:27', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:19:27', '2025-11-13 17:19:27'),
(461, 13, 169, 'unlocked', '2025-11-13 17:19:27', '2025-11-13 17:19:27', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:19:27', '2025-11-13 17:19:27'),
(462, 14, 169, 'unlocked', '2025-11-13 17:19:27', '2025-11-13 17:19:27', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:19:27', '2025-11-13 17:19:27'),
(463, 15, 169, 'unlocked', '2025-11-13 17:19:27', '2025-11-13 17:19:27', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:19:27', '2025-11-13 17:19:27'),
(464, 1, 167, 'unlocked', '2025-11-13 17:24:24', '2025-11-13 17:24:24', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:24:24', '2025-11-13 17:24:24'),
(465, 13, 167, 'unlocked', '2025-11-13 17:24:24', '2025-11-13 17:24:24', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:24:24', '2025-11-13 17:24:24'),
(466, 14, 167, 'unlocked', '2025-11-13 17:24:24', '2025-11-13 17:24:24', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:24:24', '2025-11-13 17:24:24'),
(467, 15, 167, 'unlocked', '2025-11-13 17:24:24', '2025-11-13 17:24:24', NULL, 1, NULL, NULL, NULL, '2025-11-13 17:24:24', '2025-11-13 17:24:24'),
(468, 1, 170, 'unlocked', '2025-11-13 21:11:15', '2025-11-13 21:11:15', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:11:15', '2025-11-13 21:11:15'),
(469, 13, 170, 'unlocked', '2025-11-13 21:11:15', '2025-11-13 21:11:15', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:11:15', '2025-11-13 21:11:15'),
(470, 14, 170, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:11:15', '2025-11-13 21:11:15'),
(471, 15, 170, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:11:15', '2025-11-13 21:11:15'),
(472, 1, 171, 'unlocked', '2025-11-13 21:13:18', '2025-11-13 21:13:18', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:13:18', '2025-11-13 21:13:18'),
(473, 13, 171, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:13:18', '2025-11-13 21:13:18'),
(474, 14, 171, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:13:18', '2025-11-13 21:13:18'),
(475, 15, 171, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:13:18', '2025-11-13 21:13:18'),
(476, 1, 172, 'unlocked', '2025-11-13 21:16:16', '2025-11-13 21:16:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:16:16', '2025-11-13 21:16:16'),
(477, 13, 172, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:16:16', '2025-11-13 21:16:16'),
(478, 14, 172, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:16:16', '2025-11-13 21:16:16'),
(479, 15, 172, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:16:16', '2025-11-13 21:16:16'),
(480, 1, 173, 'unlocked', '2025-11-13 21:18:56', '2025-11-13 21:18:56', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:18:56', '2025-11-13 21:18:56'),
(481, 13, 173, 'unlocked', '2025-11-13 21:18:56', '2025-11-13 21:18:56', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:18:56', '2025-11-13 21:18:56'),
(482, 14, 173, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:18:56', '2025-11-13 21:18:56'),
(483, 15, 173, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:18:56', '2025-11-13 21:18:56'),
(484, 1, 174, 'unlocked', '2025-11-13 21:33:55', '2025-11-13 21:33:55', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:33:55', '2025-11-13 21:33:55'),
(485, 13, 174, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:33:55', '2025-11-13 21:33:55'),
(486, 14, 174, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:33:55', '2025-11-13 21:33:55'),
(487, 15, 174, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:33:55', '2025-11-13 21:33:55'),
(488, 1, 175, 'unlocked', '2025-11-13 21:36:50', '2025-11-13 21:36:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:36:50', '2025-11-13 21:36:50'),
(489, 13, 175, 'unlocked', '2025-11-13 21:36:50', '2025-11-13 21:36:50', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:36:50', '2025-11-13 21:36:50'),
(490, 14, 175, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:36:50', '2025-11-13 21:36:50'),
(491, 15, 175, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:36:50', '2025-11-13 21:36:50'),
(492, 1, 176, 'unlocked', '2025-11-13 21:40:49', '2025-11-13 21:40:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:40:49', '2025-11-13 21:40:49'),
(493, 13, 176, 'unlocked', '2025-11-13 21:40:49', '2025-11-13 21:40:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:40:49', '2025-11-13 21:40:49'),
(494, 14, 176, 'unlocked', '2025-11-13 21:40:49', '2025-11-13 21:40:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:40:49', '2025-11-13 21:40:49'),
(495, 15, 176, 'unlocked', '2025-11-13 21:40:49', '2025-11-13 21:40:49', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:40:49', '2025-11-13 21:40:49'),
(496, 1, 177, 'unlocked', '2025-11-13 21:43:27', '2025-11-13 21:43:27', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:43:27', '2025-11-13 21:43:27'),
(497, 13, 177, 'unlocked', '2025-11-13 21:43:27', '2025-11-13 21:43:27', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:43:27', '2025-11-13 21:43:27'),
(498, 14, 177, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:43:27', '2025-11-13 21:43:27'),
(499, 15, 177, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:43:27', '2025-11-13 21:43:27'),
(500, 1, 178, 'unlocked', '2025-11-13 21:44:52', '2025-11-13 21:44:52', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:44:52', '2025-11-13 21:44:52'),
(501, 13, 178, 'unlocked', '2025-11-13 21:44:52', '2025-11-13 21:44:52', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:44:52', '2025-11-13 21:44:52'),
(502, 14, 178, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:44:52', '2025-11-13 21:44:52'),
(503, 15, 178, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:44:52', '2025-11-13 21:44:52'),
(504, 48, 179, 'unlocked', '2025-11-13 21:49:44', '2025-11-13 21:49:44', NULL, 126, NULL, NULL, NULL, '2025-11-13 21:49:44', '2025-11-13 21:49:44'),
(505, 49, 179, 'unlocked', '2025-11-13 21:49:44', '2025-11-13 21:49:44', NULL, 126, NULL, NULL, NULL, '2025-11-13 21:49:44', '2025-11-13 21:49:44'),
(506, 1, 180, 'unlocked', '2025-11-13 21:49:46', '2025-11-13 21:49:46', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:49:46', '2025-11-13 21:49:46'),
(507, 13, 180, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:49:47', '2025-11-13 21:49:47'),
(508, 14, 180, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:49:47', '2025-11-13 21:49:47'),
(509, 15, 180, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:49:47', '2025-11-13 21:49:47'),
(510, 1, 181, 'unlocked', '2025-11-13 21:53:30', '2025-11-13 21:53:30', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:53:30', '2025-11-13 21:53:30'),
(511, 13, 181, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:53:30', '2025-11-13 21:53:30'),
(512, 14, 181, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:53:30', '2025-11-13 21:53:30'),
(513, 15, 181, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:53:30', '2025-11-13 21:53:30'),
(514, 1, 182, 'unlocked', '2025-11-13 21:58:32', '2025-11-13 21:58:32', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:58:32', '2025-11-13 21:58:32'),
(515, 13, 182, 'unlocked', '2025-11-13 21:58:32', '2025-11-13 21:58:32', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:58:32', '2025-11-13 21:58:32'),
(516, 14, 182, 'unlocked', '2025-11-13 21:58:32', '2025-11-13 21:58:32', NULL, 1, NULL, NULL, NULL, '2025-11-13 21:58:32', '2025-11-13 21:58:32'),
(517, 15, 182, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 21:58:32', '2025-11-13 21:58:32'),
(518, 1, 183, 'unlocked', '2025-11-13 22:07:14', '2025-11-13 22:07:14', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:07:14', '2025-11-13 22:07:14'),
(519, 13, 183, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:07:14', '2025-11-13 22:07:14'),
(520, 14, 183, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:07:14', '2025-11-13 22:07:14'),
(521, 15, 183, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:07:14', '2025-11-13 22:07:14'),
(522, 1, 184, 'unlocked', '2025-11-13 22:12:53', '2025-11-13 22:12:53', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:12:53', '2025-11-13 22:12:53'),
(523, 13, 184, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:12:53', '2025-11-13 22:12:53'),
(524, 14, 184, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:12:53', '2025-11-13 22:12:53'),
(525, 15, 184, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:12:53', '2025-11-13 22:12:53'),
(526, 1, 185, 'unlocked', '2025-11-13 22:14:16', '2025-11-13 22:14:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:14:16', '2025-11-13 22:14:16'),
(527, 13, 185, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:14:16', '2025-11-13 22:14:16'),
(528, 14, 185, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:14:16', '2025-11-13 22:14:16'),
(529, 15, 185, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:14:16', '2025-11-13 22:14:16'),
(530, 1, 187, 'unlocked', '2025-11-13 22:18:51', '2025-11-13 22:18:51', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:18:51', '2025-11-13 22:18:51'),
(531, 13, 187, 'unlocked', '2025-11-13 22:18:51', '2025-11-13 22:18:51', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:18:51', '2025-11-13 22:18:51'),
(532, 14, 187, 'unlocked', '2025-11-13 22:18:51', '2025-11-13 22:18:51', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:18:51', '2025-11-13 22:18:51'),
(533, 15, 187, 'unlocked', '2025-11-13 22:18:51', '2025-11-13 22:18:51', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:18:51', '2025-11-13 22:18:51'),
(534, 1, 189, 'unlocked', '2025-11-13 22:33:16', '2025-11-13 22:33:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:33:16', '2025-11-13 22:33:16'),
(535, 13, 189, 'unlocked', '2025-11-13 22:33:16', '2025-11-13 22:33:16', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:33:16', '2025-11-13 22:33:16'),
(536, 14, 189, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:33:16', '2025-11-13 22:33:16'),
(537, 15, 189, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:33:16', '2025-11-13 22:33:16'),
(538, 1, 190, 'unlocked', '2025-11-13 22:36:38', '2025-11-13 22:36:38', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:36:38', '2025-11-13 22:36:38'),
(539, 13, 190, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:36:38', '2025-11-13 22:36:38'),
(540, 14, 190, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:36:38', '2025-11-13 22:36:38'),
(541, 15, 190, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:36:38', '2025-11-13 22:36:38'),
(542, 1, 191, 'unlocked', '2025-11-13 22:47:11', '2025-11-13 22:47:11', NULL, 1, NULL, NULL, NULL, '2025-11-13 22:47:11', '2025-11-13 22:47:11'),
(543, 13, 191, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:47:11', '2025-11-13 22:47:11'),
(544, 14, 191, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:47:11', '2025-11-13 22:47:11'),
(545, 15, 191, 'locked', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-13 22:47:11', '2025-11-13 22:47:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('vargasjesusalberto55@gmail.com', '$2y$12$Dhilhb2FEDAiWflu4bbJcuZyNLnOAL33QaHAokHbf/PN.zbqdNrR6', '2025-11-10 15:31:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leccion_id` bigint(20) UNSIGNED NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `leccion_id`, `display_name`, `file_path`, `file_type`, `file_size`, `created_at`, `updated_at`) VALUES
(1, 1, 'COMUNICACION', 'recursos/2S5ZSCCJ0St2P34V9utRBjExQvI8rxBKpRbQ3NRw.pdf', 'pdf', 33064, '2025-10-04 20:50:18', '2025-10-04 20:50:18'),
(2, 2, 'comunicación-clase 1', 'recursos/opP2zsFqo0h6Tcrqb6zVxJDabUzxK7KsgDEALUt7.pdf', 'pdf', 1498462, '2025-10-13 12:45:53', '2025-10-13 12:45:53'),
(3, 3, 'Argumentario', 'recursos/FeZlnFnKXVhbxflO144yPd2hVNuS0FyCIg7ntSuF.pdf', 'pdf', 738088, '2025-10-13 12:49:53', '2025-10-13 12:49:53'),
(4, 4, 'BONUS', 'recursos/qLRFuyUlIIELGrhmRgsagnfsOJoGksMX8s2gBPtW.pdf', 'pdf', 101061, '2025-10-13 12:51:53', '2025-10-13 12:51:53'),
(5, 5, 'Redes sociales', 'recursos/DfirmW2yWFufgshNAteUor2kHQwHP0sjI46srTrm.pdf', 'pdf', 420340, '2025-10-13 12:54:19', '2025-10-13 12:54:19'),
(6, 6, 'COMUNICACIÓN', 'recursos/BzcMKZEG6j93SLJUKx4HqM8EestAzPUxLIuMQeLU.pdf', 'pdf', 1053135, '2025-10-13 12:55:44', '2025-10-13 12:55:44'),
(7, 32, 'CUADERNILLO', 'recursos/01K9CV4AFDWJSZR1S1DB6VM4QK.pdf', NULL, NULL, '2025-11-06 18:03:59', '2025-11-06 18:03:59'),
(8, 33, 'MATERIAL', 'recursos/01K9D319545BF1MXF4T162VJ2X.pdf', NULL, NULL, '2025-11-06 20:22:08', '2025-11-06 20:22:08'),
(9, 34, 'PROGRAMA', 'recursos/01K9D37C83NDVVHGD18ABYEQ75.pdf', NULL, NULL, '2025-11-06 20:25:28', '2025-11-06 20:25:28'),
(10, 35, 'PROGRAMA VIEJO', 'recursos/01K9D38J6TQN0ZMCWMZJ0TNKQW.pdf', NULL, NULL, '2025-11-06 20:26:07', '2025-11-06 20:26:07'),
(11, 36, 'EMOCIONES', 'recursos/01K9D3AJAX64DRZ4SJYYVVHW0P.pdf', NULL, NULL, '2025-11-06 20:27:12', '2025-11-06 20:27:12'),
(12, 37, 'CLASE', 'recursos/01K9D3BZNBPRYE9KFZ3D3NVWZM.pdf', NULL, NULL, '2025-11-06 20:27:59', '2025-11-06 20:27:59'),
(13, 38, 'MATERIAL', 'recursos/01K9D42K2K5PFPPNRRBDPQP1RS.pdf', NULL, NULL, '2025-11-06 20:40:20', '2025-11-06 20:40:20'),
(14, 39, 'MATERIAL', 'recursos/01K9D4HEYJR63QWJJAXN88DDKE.pdf', NULL, NULL, '2025-11-06 20:48:27', '2025-11-06 20:48:27'),
(15, 40, 'MATERIAL', 'recursos/01K9D4JSBBBT5D7ANJH70C92GV.pdf', NULL, NULL, '2025-11-06 20:49:10', '2025-11-06 20:49:10'),
(16, 41, 'MATERIAL', 'recursos/01K9D4WXV57HPK9CYV3KF69QTV.pdf', NULL, NULL, '2025-11-06 20:54:43', '2025-11-06 20:54:43'),
(17, 42, 'MATERIAL', 'recursos/01K9D4YZ95GZMSF520QED9V3Q5.pdf', NULL, NULL, '2025-11-06 20:55:50', '2025-11-06 20:55:50'),
(18, 43, 'CASO COMPRAVENTA', 'recursos/01K9D4ZVKFFX2G57EWN1T32MZN.pdf', NULL, NULL, '2025-11-06 20:56:19', '2025-11-06 20:56:19'),
(19, 44, 'CASO PAREJA', 'recursos/01K9D52C5PGBW9KMJ9AVHZBNWE.pdf', NULL, NULL, '2025-11-06 20:57:41', '2025-11-06 20:57:41'),
(20, 45, 'POLÍTICO', 'recursos/01K9D534TD7G52YDNM80YTEVE4.pdf', NULL, NULL, '2025-11-06 20:58:06', '2025-11-06 20:58:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `name`, `image_path`, `facebook_url`, `instagram_url`, `created_at`, `updated_at`) VALUES
(1, 'Sede Central Mendoza', 'sedes/rnSBBDeB0G6opbyKC0XoMod54O3EBf3F2imBiAZd.jpg', 'https://facebook.com/instituto-solumne', 'https://instagram.com/instituto-solumne', '2025-10-05 00:02:09', '2025-10-05 00:16:32'),
(2, 'Los Molinos. La Rioja', NULL, 'https://facebook.com/instituto-solumne-sr', NULL, '2025-10-05 00:02:09', '2025-10-05 15:44:22'),
(3, 'SEDE PARANÁ', 'sedes/DSV5fl4EU618YSJJsWRgUEpNiT9LqB7ejvWcxljX.jpg', 'https://www.facebook.com/p/Instituto-Solumne-Parana-61563236524713/', NULL, '2025-10-06 12:10:39', '2025-10-06 12:10:39'),
(4, 'SEDE BRAGADO', 'sedes/f8f2o5NTrS5h94tNSLsrK0etUxgU22o3KcSQ4nyE.jpg', NULL, 'https://www.instagram.com/institutosolumne_bragado_ok/', '2025-10-06 12:11:36', '2025-10-06 12:11:36'),
(5, 'SEDE CÓRDOBA CAPITAL', 'sedes/RaRRaxNineDm47ZkWeNXsgNLVwz4D1u7k53lK0Mc.jpg', 'https://www.facebook.com/people/Instituto-Solumne-Sede-Córdoba-Capital/61565391177414/', 'https://www.instagram.com/institutosolumne.cordoba/', '2025-10-06 12:13:00', '2025-10-06 12:13:00'),
(6, 'SEDE PIEDRA BUENA', 'sedes/Qhf1KltifeBeWENPaCSYgEvvg3IQ62HXkZ9xUxlf.jpg', NULL, NULL, '2025-10-06 12:17:26', '2025-10-06 12:17:26'),
(7, 'SEDE RECOLETA', 'sedes/bh7UYplLk0qibfcaLVheQHPAfTAppKu8zCldKGUH.jpg', NULL, NULL, '2025-10-06 12:17:54', '2025-10-06 12:17:54'),
(8, 'SEDE MAR DEL PLATA', 'sedes/5js9F7LKwvPMTHhpZNNJcByUUsFAcfE6wZXge3ig.jpg', NULL, NULL, '2025-10-06 12:18:55', '2025-10-06 12:18:55'),
(9, 'SEDE QUILMES', 'sedes/YT97ueEDGVgpP8duyIsrQu9Oj1dR3JrNW5KM6V9Y.jpg', NULL, NULL, '2025-10-06 12:19:43', '2025-10-06 12:19:43'),
(10, 'SEDE SALVADOR MAZA', 'sedes/8VYqnpFSTnjfwV6HwNZOtF3gZ5fnMj972mqoeSlx.jpg', NULL, NULL, '2025-10-06 12:21:19', '2025-10-06 12:21:19'),
(11, 'SEDE ENTRE RIOS', 'sedes/Occi3BzOsqPKeKYcb4r21HeDMZNbUmg7JRFfQcMu.jpg', NULL, NULL, '2025-10-06 12:21:56', '2025-10-06 12:21:56'),
(12, 'SDE BARILOCHE', 'sedes/gthkpF3NVk4WJjMaLNIyLjtuo4YSTP6okZ4juKaT.jpg', NULL, NULL, '2025-10-06 12:22:14', '2025-10-06 12:22:14'),
(13, 'SEDE ORÁN, SALTA', 'sedes/yVK63Pk1LLajROTuU6cz3VxoTqm8A4Q6AOs0hKv1.jpg', NULL, NULL, '2025-10-06 12:22:52', '2025-10-06 12:22:52'),
(14, 'SEDE ATLÁNTICA', 'sedes/WnvNfpHoLgXPxFWgm9ksy0uAdHsPxX1jHf6VF8xu.jpg', NULL, NULL, '2025-10-06 12:23:07', '2025-10-06 12:23:07'),
(15, 'SEDE VOLPATTI', 'sedes/wTvXNttXpr520hKSKysATdsDADHZl18hITrGV1MP.jpg', NULL, NULL, '2025-10-06 12:23:32', '2025-10-06 12:23:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1rnPfBupxEQ2LGT5tlJy2jII0516KxFcVURIDuF6', NULL, '2a02:26f7:d988:4040:0:c000:0:e', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWUdUSUw5bVpud3ZVaFFhTlZlaU1wSVpmbmpwRWZtaVFzQ3loYlJyTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vc29sdW1uZS5jb20uYXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763062765),
('9GHXDAsnAqSTXTFpBIH85aNGiDxPttqdZUxfaBYD', 1, '190.172.1.95', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiV1h6VW1kc2RCc0RkRUlLRVdkNnNEOGZHeUpzT0ZTNlBzd2pGRkJHbCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwczovL3NvbHVtbmUuY29tLmFyL2FkbWluL3VzZXJzL2NyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRkbFQvYncuUWdRQ05ZN3hwT01KSnNPQlRLdk1VNXdVc0VkRkJ1dkFBN25mY0lEeko5TWVsQyI7czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1763063290),
('B9c6l2YHXSDJJ0EUIfdE1XEOPz1R3wMX9luuN1qy', 126, '2802:8013:b2f0:7600:65c7:5c3c:83b0:4029', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoibHFmbWhnS1JpSldqck53ODBnam1oMmU0NU9Tenl4MEVkeXowOGladSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwczovL3NvbHVtbmUuY29tLmFyL2FkbWluL3VzZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo4OiJmaWxhbWVudCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI2O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkRXpJcTBUVkR5S3dHcXkxUkk1bklCZVhTR3RRQ0NYamMxQkhhc3NMZVhyZGViRUhzaDRkS2EiO30=', 1763060915),
('cZnd6kSsiwebiOVX7Dem3Fu2gCnHVwKiaELMQL8O', 179, '2800:810:429:837d:91c1:309c:3e44:918b', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/29.0 Chrome/136.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUzFWb0g1QjVJeHZvcEd6OGZJdEtFTlRrR0ozc1k3eGk1cjlFaVRSRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vc29sdW1uZS5jb20uYXIvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNzk7fQ==', 1763059918),
('dGOHfV7zjrgvuwkXUyMLDvEXau9DwdujTAqKhOxZ', NULL, '45.239.86.159', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0.1 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOGFXZDM0ZHlCeWZtOTgzdjBnUWh1WjZQUUg1azhSdEM0cUVYRElpSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vc29sdW1uZS5jb20uYXIvc2VkZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763070210),
('dRWB8RcDOJvFI4ye4GvaTF7I0gB8KxOnzmVr3ZfP', NULL, '142.132.190.254', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzNrWW1zZDFOdFdaUlBzOFEzU2duS29BQUxadWoxNFl3YXVKeHlKVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vc29sdW1uZS5jb20uYXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763089154),
('haF9XN1fCOjw2yonXCl7uPUS0dls9NLO1rgkm9iW', NULL, '40.77.167.235', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiejZBVXQ0TmI4MDNqeEx5NUhDZ294SkluVHExSWZRcHc3alc4WGZmViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vc29sdW1uZS5jb20uYXIvZG93bmxvYWRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1763071705),
('i6qfO2b9wKYzCeCXdsXszPyMVHb4WpOYNu6sRF8s', NULL, '207.191.167.202', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekxoa3JQYlpsRTNycGJpZ3JLTXVybG5pQlV5TVptaDFnWHVpRXpmNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vc29sdW1uZS5jb20uYXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763095780),
('N58KAWZ2p76x2ufdLEGItOtmko4B438aKjtAojj2', NULL, '40.77.167.70', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid0RpcUpnS3JQOXFrbHJKbFBkb1h5bm02R1V3NHo0SUxTUXUwV2VKOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vc29sdW1uZS5jb20uYXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763087560),
('N7xh3ToOwLqYqhqw65yyeIXHy66y2Y5j3JHZZ1wS', NULL, '2802:8013:b2c5:ff00:65db:ac28:890e:62fa', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib1k3ODlqVzY5Y3Jmb1pHb0M4YVhsTWFBSG42MElVSkhRYTQ2dHpBTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vc29sdW1uZS5jb20uYXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1763058697);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'alumno',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Solumne', 'admin@solumne.com', '2025-10-03 19:58:02', '$2y$12$dlT/bw.QgQCNY7xpOMJJsOBTKvMU5wUsEdFBuvAA7nfcIDzJ9MelC', 'admin', NULL, '2025-10-03 19:58:02', '2025-10-03 19:58:02'),
(2, 'ALUMNO', 'ALUMNO@SOLUMNE.COM', NULL, '$2y$12$.3LLt27QrVLzoal1r9A.Wug8XIpRQqOdi1OkdWJBcp3.NJWsHfRaG', 'alumno', 'imFSiHXvYKbPHumSTxDwxKQobQRh5ZpTI2JATm8Ufj33BoeK6rGEqZf0XkJq', '2025-10-04 20:51:44', '2025-11-08 20:03:18'),
(3, 'Gestor de Prueba', 'gestor@test.com', NULL, '$2y$12$oyNGAyMhM1P9tJic/6IoLu5ZVrGY5MqZOfh2QzFOknch3s46YIuA.', 'gestor', NULL, '2025-10-04 21:32:56', '2025-10-04 21:32:56'),
(4, 'Mariana Aguilera', 'miaaguilera66@gmail.com', NULL, '$2y$12$PtkpTssuXjvD9MJ7E0N4SOx4uYTYiBreflRkL.jIDnIhwOPaLbo7m', 'alumno', NULL, '2025-10-13 13:09:15', '2025-10-13 13:09:49'),
(5, 'Maria Ángela Aponte', 'mari.angela.apont@gmail.com', NULL, '$2y$12$uVHyQVg37RZ0wyzcfRcokeyjrd1DaOFQUjAsEgSJzw26Us0KBNy4S', 'alumno', NULL, '2025-10-13 13:10:48', '2025-10-13 13:11:03'),
(6, 'Alexis Aquino', 'ramonaguerrero145@gmail.com', NULL, '$2y$12$VPZK01S.ZSTN.Ka/0z1o2eH6WK2poEL294DUhJmwPVfkkC/yyM5GG', 'alumno', NULL, '2025-10-13 13:12:18', '2025-10-13 13:13:23'),
(7, 'Patricia Astrada', 'patriciastr@hotmail.com', NULL, '$2y$12$mfhNyPnGnkC8ErU8AULhie0Pc.Wbg/Jb0h1qIuW200GGkA/NzxnVS', 'alumno', NULL, '2025-10-13 13:14:01', '2025-10-13 13:14:17'),
(8, 'Teresita Barboza', 'tere.betty.teresita.beatriz@gmail.com', NULL, '$2y$12$/LU5/kT6rQorXAmgRAOum.CK8.WDLJcxB.fteO/x7lYfPeOLmzYLy', 'alumno', NULL, '2025-10-13 13:15:10', '2025-10-13 13:16:08'),
(9, 'María Belen Fuenzalida', 'mariabelenfuenzalida@gmail.com', NULL, '$2y$12$1RN8Qg/jFAB1KnB7m9mxsOxDEMt8kAjPleDL2RUHNqmd58N/15O7W', 'alumno', NULL, '2025-10-13 13:17:22', '2025-10-13 13:17:39'),
(10, 'Damián Andrés Bustamante', 'jardindamianbus@gmail.com', NULL, '$2y$12$odRK.eH9bByi4QE3Qhvq8uv0l0kost8fOfoTyRgMQoahXyq5DVc8i', 'alumno', NULL, '2025-10-13 13:18:29', '2025-10-13 13:18:58'),
(11, 'Roxana Calvar', 'artdecocalvar@gmail.com', NULL, '$2y$12$lHC4Nv8qrGFWljnJgpBYcO8WZ9TpxKvNIm0qqDND.eTU6WPCga/bS', 'alumno', NULL, '2025-10-13 13:20:48', '2025-10-13 13:21:04'),
(12, 'Gabriel Cantaloube', 'g.a.cantaloubec@gmail.com', NULL, '$2y$12$g8P/1Eud7EoHEQQm4js69O4XY85FgyXATKvtZeTriIpD0pkEoRP/y', 'alumno', NULL, '2025-10-13 13:22:02', '2025-10-13 13:22:02'),
(13, 'Ivonne Piddoux Claure', 'ivonnecorazoncito@gmail.com', NULL, '$2y$12$CqAFQSXMG6o5tHull7xePONH.n5nvuJCfC7ql/Z.2IFjVxTDuiU/a', 'alumno', NULL, '2025-10-13 13:23:24', '2025-11-10 17:52:36'),
(14, 'Catalina Maria Jose Colcombet', 'majo_antiheroe@hotmail.com', NULL, '$2y$12$4Ey7sOJUrYdBNFg7cuiYXOJjrxvcUAZJqag3LE31azxZ7c9CiK1Gm', 'alumno', NULL, '2025-10-13 13:24:51', '2025-10-13 13:24:51'),
(15, 'María Paula Cordero', 'paulini25@yahoo.com.ar', NULL, '$2y$12$Q5yPzKxSorJNvnb59CiWZeznlh5dasAHzhcKbIv7Ui9a5Fpvz8pPi', 'alumno', NULL, '2025-10-13 13:36:31', '2025-10-13 13:36:47'),
(16, 'Juan Carlos Cuesta', 'joanico35@hotmail.com', NULL, '$2y$12$DBXp.zs1DgAc5w.aGLO4YOaIlhcoSIx.YLknR2UYXk0rdY5MBPH1K', 'alumno', NULL, '2025-10-13 13:37:46', '2025-10-13 13:37:46'),
(17, 'Gilda Curilan', 'gildacurillan2512@gmail.com', NULL, '$2y$12$KX.9CsWnl1G1p9nTDKXi5eMKInE1DE/rQAdiNTehrjigbpkbG7G9O', 'alumno', NULL, '2025-10-13 13:39:21', '2025-10-13 13:39:21'),
(18, 'Marisa Fernanda Dahas Rallim', 'ferminetti22@gmail.com', NULL, '$2y$12$WEj.114kSO3iW6VN4nM0x.y6LkItKNN3NNgNa3sqnvEmd5edYMfWa', 'alumno', NULL, '2025-10-13 13:40:26', '2025-10-13 13:40:26'),
(19, 'Dora Catalina Estrada', 'dorita.laslo@gmail.com', NULL, '$2y$12$kKmcBLclWr.35Nsp38UpmOVI6WgqaDlO/AutyHZMHT83s7jDWxpri', 'alumno', NULL, '2025-10-13 13:41:27', '2025-10-13 13:41:27'),
(20, 'Maria Ana Limpe Flores', 'meryighor@hotmail.com', NULL, '$2y$12$PkJRC5m8EV/PHgriuPswGuE6aQGUVssHBeljCpDr5ch4fPr6qRsdq', 'alumno', NULL, '2025-10-13 13:42:35', '2025-10-13 13:42:35'),
(21, 'Paola de los Ángeles Galleguillo', 'paolagalleguillo102@gmail.com', NULL, '$2y$12$nr/CzAibBTBkv8edKoeGVe0pseRkwGPie9VtIfUTKs23bkBR2M/Tu', 'alumno', NULL, '2025-10-13 13:43:35', '2025-10-13 13:43:35'),
(22, 'Nélida Gomez', 'gomeznelly177@gmail.com', NULL, '$2y$12$2EHRC94/B1H4JaKlmh1Q6OqzqO3MSu6yugEked2GMUGL2CS4B.XUG', 'alumno', NULL, '2025-10-13 13:44:22', '2025-10-13 13:44:22'),
(23, 'María Fernanda Gonzalez', 'mafergonzalez0919@gmail.com', NULL, '$2y$12$JB/W0Fwmu88tvC43VUexfOMcke9VmepksNwzMlWMeieTKPvnO2syW', 'alumno', NULL, '2025-10-13 13:45:13', '2025-10-13 13:45:13'),
(24, 'Alfredo Lezcano', 'freddolez@hotmail.com.ar', NULL, '$2y$12$b6rkhFKdcUnIBt6CSbS6neXSDUfDZ33YF7...ADccSryXJVxiUzb.', 'alumno', NULL, '2025-10-13 13:45:57', '2025-10-13 13:45:57'),
(25, 'Eva Alejandra Luna', 'alelunaeva@gmail.com', NULL, '$2y$12$d1PIf8GPxQeS7vZWWGjewuHYvPoVqlCbvqz48ejiQjytejdSVdmKa', 'alumno', NULL, '2025-10-13 13:46:45', '2025-10-13 13:46:45'),
(26, 'Juan Alfredo Damian Olguin', 'juanolg37@gmail.com', NULL, '$2y$12$jAGh/NlaEjvzfBef7xjNbeJAN2S7tKjw1JfzfsphlHNCIi/4ndH46', 'alumno', NULL, '2025-10-13 13:48:14', '2025-10-13 13:48:14'),
(27, 'Maria Rosa Penovi', 'mari.penovi@gmail.com', NULL, '$2y$12$XkT/8m7.56BDpWecSTnVouFJbHQOPyjwEuDipeWxp8w2.haSm40fS', 'alumno', NULL, '2025-10-13 13:49:27', '2025-10-13 13:49:27'),
(28, 'Maite Antonela Reyna', 'cristianemmareyna@gmail.com', NULL, '$2y$12$Ann1QIpbSCIkwkhTh9vZXeQMA26DXmoxG7fFCJhU/ANsEz2RyRB.W', 'alumno', NULL, '2025-10-13 13:50:37', '2025-10-13 13:50:37'),
(29, 'Facundo Luis Rios', 'riosamarillafacundo@gmail.com', NULL, '$2y$12$OuGr.cRewATPio.G8cn9tOmfhel516hDV./T3PU7C6r3eK6cGit4G', 'alumno', NULL, '2025-10-13 13:51:30', '2025-10-13 13:51:30'),
(30, 'Rosario del Pilar Saavedra', 'rosariozoe0806@gmail.com', NULL, '$2y$12$2K9fV/Roq4luHmQXTF10auWt/Hd4l5WmMDlpV3EGgzM6N4FHauVWC', 'alumno', NULL, '2025-10-13 13:52:18', '2025-10-13 13:52:18'),
(31, 'Fabiana Sabrina Serra', 'sabrinaserra@hotmail.com.ar', NULL, '$2y$12$opsAfcARVi6cUzwaLjuMKOM6Qxm.rIjENAFE.safXEEJEXncPEQXa', 'alumno', NULL, '2025-10-13 13:53:14', '2025-10-13 13:53:14'),
(32, 'Estela Silveira', 'silveirae9@gmail.com', NULL, '$2y$12$609saCnndbF5CPznMj8a3.zlTDEGWwjmmMyo0vlX2urHaGsEFxHX6', 'alumno', NULL, '2025-10-13 13:54:42', '2025-10-13 13:54:42'),
(33, 'Giuliana Belen Sosa Aguirre', 'giuli.aguirre13@gmail.com', NULL, '$2y$12$YqOZCsXHM/YB6evc/BcVne10Cb6.5bn0psGuU9rBkPBVwRgHgYnxS', 'alumno', NULL, '2025-10-13 13:55:38', '2025-10-13 13:55:38'),
(34, 'Yuliana Wingeyer', 'yulianawin06@gmail.com', NULL, '$2y$12$seQYbxTAymv1mKfm4j8RAOafQxH2kj58wabsQwh0jtVSfNo26/zmK', 'alumno', NULL, '2025-10-13 14:14:44', '2025-10-13 14:14:44'),
(35, 'Augusto Fabian Zerpa', 'aufazerpa@gmail.com', NULL, '$2y$12$GZxPYnvJF0hcLcWvcvXEBehNxGajW4lja8MgRah4L3T8I.4IuhZsu', 'alumno', NULL, '2025-10-13 14:15:31', '2025-10-13 14:15:31'),
(36, 'Silvia Brandan', 'sil.brandan75@gmail.com', NULL, '$2y$12$HID/M5wFWjbcV4twhhi89e95foQEA5z7XIVa0/oDHI8uGM.XA/i2K', 'alumno', NULL, '2025-10-13 14:25:11', '2025-10-13 14:25:11'),
(37, 'MARIA CRISTINA CUENCA', 'ccuenca347@gmail.com', NULL, '$2y$12$qjfpSarJD3UvWfY1TViVkecN51t7As9IjquIu0qUmzpJMn2T/aeXK', 'alumno', NULL, '2025-10-13 14:26:24', '2025-10-13 14:26:24'),
(38, 'SILVANA LAURA GACCETTA', 'slgaccetta@gmail.com', NULL, '$2y$12$d4H4auuNFww0Q8Y4e.xJwOh./5YrRzT/NWkVp4/caIeKPOBZYJtkO', 'alumno', 'UKCsR7HTrqA5JEyyB1Yxx7ltc665hCVXskmQIranGNdDMGnE0ylC1MQZNdnL', '2025-10-13 14:27:44', '2025-10-13 14:27:44'),
(39, 'NATALIA GABRIELA GOMEZ GASTIAZORO', 'ngg.asesoramientoprofesional@gmail.com', NULL, '$2y$12$uET7DSQoF2hTyy2WINEoMuH49igvwcUlRNHNUthCRAbLc/xaksfgW', 'alumno', NULL, '2025-10-13 14:28:57', '2025-10-13 14:28:57'),
(40, 'DEBORA GONZALEZ', 'gonzalezdy@hotmail.com', NULL, '$2y$12$1AmqMfAiPG116FO0/kz9SuB0UgVvUXSR4CbrIyRqsuTlQznLPzoGe', 'alumno', NULL, '2025-10-13 14:29:50', '2025-10-13 14:29:50'),
(41, 'JULIETA OLIVERA', 'july31olivera80@gmail.com', NULL, '$2y$12$DDDgQWtXuustebz9qcaAdOrapoxu00X8NQX.JXqThotXKwnZqm/lq', 'alumno', NULL, '2025-10-13 14:30:51', '2025-10-13 14:30:51'),
(42, 'MARIANA SOLEDAD SOSA', 'maryana.soledad.sosa1987@gmail.com', NULL, '$2y$12$nM.nN/rVCFQ46NIo3gF.I.52BZGtqosozghAvtBFRriq.ZjGkw7KG', 'alumno', NULL, '2025-10-13 14:36:03', '2025-10-13 14:36:03'),
(43, 'PAOLA SPARANTINO', 'sparantino76@gmail.com', NULL, '$2y$12$/zLtykowMV5T8cJbpUFTrOv79eCKHo5KwfdtUMhWWhrNoLv0JsTP.', 'alumno', NULL, '2025-10-13 14:38:31', '2025-10-13 14:38:31'),
(44, 'ANALIA VERCELLI', 'analiavercelli185@hotmail.com', NULL, '$2y$12$k9j7MUQZkSNWjVyQRvD2.uJkAaB6bSJ.iZxEUmQSJkKvxI38W8w/.', 'alumno', NULL, '2025-10-13 14:39:44', '2025-10-13 14:39:44'),
(45, 'FERNANDO VILLEGAS THIERRY', 'duendevato.com@gmail.com', NULL, '$2y$12$dfC/wo0d1gttmyRb4x01/u4KuPNdimSh6wxdc0L/t1f2j5jIYJ9j.', 'alumno', NULL, '2025-10-13 14:40:47', '2025-10-13 14:40:47'),
(49, 'NILDA ESTER ERAZO', 'nildaerazo2023@gmail.com', NULL, '$2y$12$9x5RYJd1d8lURaeWbv3BoOyHJGU/wWVS38ftwA/CDY3S6.IcwPZYW', 'alumno', NULL, '2025-11-06 16:38:14', '2025-11-06 16:38:14'),
(50, 'MORA LUANA IBARROLA', 'juana.luamora@gmail.com', NULL, '$2y$12$7.lkbZdDD.MyM9kVROh1Bu6VgHOXC10eOLX/Jardi7FoLr6bGvdY6', 'alumno', NULL, '2025-11-06 16:38:44', '2025-11-06 16:38:44'),
(51, 'LEILA SAVADINI', 'leilamarlenesavadini@gmail.com', NULL, '$2y$12$nGDTBZgnZRTe2VajTonP0uTZOHo.45bxuMFnFEVzoiLkSIRy1mRMG', 'alumno', NULL, '2025-11-06 16:39:13', '2025-11-06 16:39:13'),
(52, 'CARINA VILLAFAÑE', 'carisgb2005@gmail.com', NULL, '$2y$12$DbZnfh9fa7vniYC1Z2CJUeRg9.QhRV5cceV0UfqdvVWB80pJG0bRG', 'alumno', NULL, '2025-11-06 16:39:55', '2025-11-06 16:39:55'),
(53, 'GUSTAVO ARIEL ESCALANTE', 'gao_escalante@yahoo.com.ar', NULL, '$2y$12$/elyBOewg/Bjc1obUkwzg.CQjI6KOq14iPuS.pZ4uMI.FMtbS.0wS', 'alumno', NULL, '2025-11-06 18:29:47', '2025-11-06 18:29:47'),
(54, 'ALEJANDRA ARACELI IBARS', 'ale.ibars@hotmail.com', NULL, '$2y$12$a5DzFztOGJr29LboUHvSq.B7w0Y4wyjKYWkRlRfWJvkKGubIZBBPa', 'alumno', NULL, '2025-11-06 18:30:31', '2025-11-06 18:30:31'),
(55, 'ANA ISABEL POLO', 'anaisapolo17@gmail.com', NULL, '$2y$12$x35o0o93X/tQiZMTWMnkfefdyIR0RbP2Jb3gpfOuYTku1xW6yBzoC', 'alumno', NULL, '2025-11-06 18:32:12', '2025-11-06 18:32:12'),
(56, 'NOELIA DEL VALLE SERAPIO', 'noelia23500@gmail.com', NULL, '$2y$12$R0UFEvo/bc08TvI1lIvuiObr2JpL8LQgI69OYMFHlmT.Q0NZ.lrMS', 'alumno', NULL, '2025-11-06 18:33:47', '2025-11-06 18:33:47'),
(57, 'Maria José Anglat', 'mariajoseanglat@gmail.com', NULL, '$2y$12$8TYxmP06avrfHbWIDL8jm.EJ/SPyhTZ6JGYbxOpVeVoeK6ypDkaIG', 'gestor', NULL, '2025-11-07 15:57:01', '2025-11-07 15:59:20'),
(58, 'JUAN SEBASTIAN ABALO', 'juanabalo@abc.com.ar', NULL, '$2y$12$qrbuICsiVTjrtBV53ki8deb.YrYy2HW5hGr0LRCfoz.7bNF4lxr4q', 'alumno', NULL, '2025-11-07 16:53:34', '2025-11-07 16:53:34'),
(59, 'JONATHAN ACOSTA', 'joniacosta455@gmail.com', NULL, '$2y$12$9/6mcH1rzT0e.lmGCuOyXuYvrwkeGc.2VEWw2sqjIQrMOAGM3U3r6', 'alumno', NULL, '2025-11-07 16:56:25', '2025-11-07 16:56:25'),
(60, 'JOSÉ RAMÓN ACOSTA', 'joserracosta@gmail.com', NULL, '$2y$12$uB0Akef9RDSfeeyEmmA7OO1WoOnELYhm0g3wkHWnL9ISDoK1SwTkG', 'alumno', NULL, '2025-11-07 17:00:41', '2025-11-07 17:00:41'),
(61, 'JUAN EMILIO ACOSTA', 'juan_emilio_33@hotmail.com.ar', NULL, '$2y$12$IvSxFnQQS0.Rd5Tfen0vhuC37zVnCqUvjqs6yNVAvHxt6nq8lN5.G', 'alumno', NULL, '2025-11-07 17:04:40', '2025-11-07 17:04:40'),
(62, 'DIEGO DEMIAN AGUILAR', 'chevette33@gmail.com', NULL, '$2y$12$gzEWTbrmHybeZT21Sm68TuuafQCFS8RMB9gIwA5xzfiXFVGyanQLW', 'alumno', NULL, '2025-11-07 17:08:41', '2025-11-07 17:11:30'),
(63, 'FRANCISCO ANTONIO AGUILAR', 'chinomburu@gmail.com', NULL, '$2y$12$9HA3.JivJ1oRpuum.nsFc.vIqPthTkabq8ogDPUhw2VQaNQZHiX4y', 'alumno', NULL, '2025-11-07 17:16:15', '2025-11-07 17:16:15'),
(64, 'MAIRA SOFIA AGUILAR', 'mairasofiaaguilarmartinez@gmail.com', NULL, '$2y$12$JK2J7WJwWIjGwwQ0jv8aKuwvC7aZSDzN3x3pG4RfyrQ1zoRvme4Pu', 'alumno', NULL, '2025-11-07 17:17:30', '2025-11-07 17:17:30'),
(65, 'FERNANDO JESUS AGUILERA', 'fernandoaguilera27@gmail.com', NULL, '$2y$12$JSvJcKr1BBnStXL1gC662OvBS.XRaFzAVqxtiKdN667xpBnqWMa3i', 'alumno', NULL, '2025-11-07 17:20:40', '2025-11-07 17:20:40'),
(66, 'OMAR ONÉSIMO AGUIRRE', 'meritattoo@hotmail.com', NULL, '$2y$12$n6ipzGNQ4bTL59WsyGNZ.u4LVDIYyd3KgiT8VjrAaUssAwbCtaVAq', 'alumno', NULL, '2025-11-07 17:23:23', '2025-11-07 17:23:23'),
(67, 'SERGIO LEANDRO AGUIRRE', 'sergioleandroaguirre928@gmail.com', NULL, '$2y$12$fkEK.Xtp2dZcNMUoCqWHh.n5pjftsXqxj4zBwFaHYFs29mtpqG9Ve', 'alumno', NULL, '2025-11-07 17:25:38', '2025-11-07 17:25:38'),
(68, 'DUILIO LUIS ALBARIÑO', 'duilioalbarinio.2020@gmail.com', NULL, '$2y$12$AVWMcx1jL0xW4rrRGUtavewU95vJooPozhG6WyS2bqedNP06Uxdvu', 'alumno', NULL, '2025-11-07 17:27:49', '2025-11-07 17:27:49'),
(69, 'MARIA ESTELA ALBARRACIN', 'noad@outlook.es', NULL, '$2y$12$M75dEo3RoXBGpWk91b3kneDEBuc917p2YeV9enLOEQ8gHwrADdZFm', 'alumno', NULL, '2025-11-07 17:39:54', '2025-11-07 17:39:54'),
(70, 'MONICA ALICIA ALGUILA', 'innovacionneomisionerista@gmail.com', NULL, '$2y$12$2zUq3KkY3f0tz.ujylSpSeH/5tGGcCn9IRX7aEZIDUgtczDFh7cx6', 'alumno', NULL, '2025-11-07 17:45:57', '2025-11-07 17:45:57'),
(71, 'KARINA ALMONACID', 'karina_almonacid@hotmail.es', NULL, '$2y$12$aOSBCBr8I.SiUkvT2.xIUeWfK9s5c1SlA76l00LJeUd0ebRqPa8wq', 'alumno', NULL, '2025-11-07 17:51:23', '2025-11-07 17:51:23'),
(72, 'MATILDE ZULEMA AMPUDIA', 'matildea.mpudia62@gmail.com', NULL, '$2y$12$gF965P5gmNOSvXEWjogII.LKkave/ow8STEa8ys5rk7a/oV0CdWai', 'alumno', NULL, '2025-11-07 17:56:20', '2025-11-07 17:56:20'),
(73, 'JAZMIN ESTHER ANDRADA', 'jazmiina7@gmail.com', NULL, '$2y$12$LQwc43YlHWvkva1tGU1mau1LdJRvjB/IhT8YKtkOWHoBpv.TdntwC', 'alumno', NULL, '2025-11-07 17:57:35', '2025-11-07 17:57:35'),
(74, 'JUAN FERNANDO ARAMAYO', 'juanfernandoaramayo@gmail.com', NULL, '$2y$12$h9oIvz4QOAeg9i9vMPST4eeo1Y8tLQ65.uC9HGNSV219eOWUZehYy', 'alumno', NULL, '2025-11-07 18:01:53', '2025-11-07 18:01:53'),
(75, 'JESÚS ALBERTO VARGAS', 'vargasjesusalberto55@gmail.com', NULL, '$2y$12$N5baO46G8t68Oy4RI.RyxuzvynhkT.N7jSaWL6vHDCbJL7kuGJCuC', 'alumno', '5Tp75UDkOslLWWDqnxCo83pnUwD2iAXhwQwXMq54ThaiLeWOXnlRctG4EGZa', '2025-11-10 15:27:04', '2025-11-10 15:27:04'),
(76, 'CARMEN NELIDA ARREGUI', 'carmenarregui957@gmail.com', NULL, '$2y$12$qPET4WeRi8L.V0IVCRUGOOLNluo26U5AtiRkLr5uQfIVC1Ev6Fwhi', 'alumno', NULL, '2025-11-10 15:31:18', '2025-11-10 15:31:18'),
(77, 'LAUTARO ASAD', 'comlautaroasad@gmail.com', NULL, '$2y$12$JqSL2TY3MOBRtJRL5DBL8O2FY2ldbkb/NBz19zTVM.3uXlWm08Pym', 'alumno', NULL, '2025-11-10 15:35:58', '2025-11-10 15:35:58'),
(78, 'MARIA FABIANA ASCHERI', 'fabiascheri@gmail.com', NULL, '$2y$12$4d/XeAieFGpok0LwXcvRSOqE3Q0lHpYJ9i/5cfvfqRgLjBdHdRKfi', 'alumno', NULL, '2025-11-10 15:39:01', '2025-11-10 15:39:01'),
(79, 'MARTA ANDREA AZATEGUI', 'andreaazategui77@gmail.com', NULL, '$2y$12$PHSOXu5n.35r9ClXBEjaye4OwdBmggo/MhS25YQsFy.Z2UnQgGgly', 'alumno', NULL, '2025-11-10 15:45:21', '2025-11-10 15:45:21'),
(80, 'GUILLERMO DAVID ARIEL MENDOZA', 'gdamendoza2@gmail.com', NULL, '$2y$12$5MB.pViqwce4xWijTZiqG.cjiFg7ro5QioYIGCVnMYkIiLUZPwwwe', 'alumno', NULL, '2025-11-10 15:58:24', '2025-11-10 15:58:24'),
(81, 'ÁNGEL DANIEL BARBOZA', 'angeldbarzola@gmail.com', NULL, '$2y$12$ApQMKh186nrXJv0zOl8IWux40CfzByP6LLe9JjXCM8LBGMkxmUN4e', 'alumno', NULL, '2025-11-10 16:08:11', '2025-11-10 16:08:11'),
(82, 'MELINA SOLEDAD BARRIENTOS', 'melinabarrientos.oficial@gmail.com', NULL, '$2y$12$lofebdh5cQjWOVn6LHYOh.PoGkuwJSlBNUEaxzx5Laqx9UZl3OvzS', 'alumno', NULL, '2025-11-10 16:13:01', '2025-11-10 16:13:01'),
(83, 'DANIELA LORENA BAZAN', 'lorebazannqn@gmail.com', NULL, '$2y$12$gti7jz3G9Vtf1Cauu6fmx.BHAxp3nUNYvn42LZlq7vww9mL8gR1k6', 'alumno', NULL, '2025-11-10 16:17:03', '2025-11-10 16:17:03'),
(84, 'HERNAN ALBERTO BEIS', 'hab6720@gmail.com', NULL, '$2y$12$Fg.ZY4L4CyFTl.jay9Q1HeFMbIEwq3U0nBVBfg9.fTCxZr/pTC.By', 'alumno', NULL, '2025-11-10 16:19:50', '2025-11-10 16:19:50'),
(85, 'MAURICIO BESAGONILL', 'mdbesagonill@gmail.com', NULL, '$2y$12$lQ51WMFfsxE0UKloyLMxS.hfGy9k2SuqL/DceaBz7SwR.LgfMl7.y', 'alumno', NULL, '2025-11-10 16:25:14', '2025-11-10 16:25:14'),
(86, 'MAURO DAMIAN BLANCO', 'cuervoxlive@hotmail.com', NULL, '$2y$12$qxfpfoOMOQN3EAWpIDHKkeRXnhtSBE96uxoznjV9zOS77w.37or0S', 'alumno', NULL, '2025-11-10 16:27:45', '2025-11-10 16:27:45'),
(87, 'MAURICIO RENE BODE', 'mauriciobode@gmail.com', NULL, '$2y$12$5n6rfBk0e9s/7zt/cgPkJu3aax8QSUefBKq.XuQc5ykvaBUQ9xXDq', 'alumno', NULL, '2025-11-10 16:34:23', '2025-11-10 16:34:23'),
(88, 'BRANCO TIAGO ROCCO JAIME', 'golderocco@gmail.com', NULL, '$2y$12$pFeuBi1mqAh0WeBRLWVQieh9h7P3WOUfgASN1LTBqMVZz8zPteefq', 'alumno', NULL, '2025-11-10 16:42:07', '2025-11-10 16:42:07'),
(89, 'BRANDAN SANTA EDIT', 'santaedit3120@gmail.com', NULL, '$2y$12$2d2komP3j9P6G75xS3U5k.qOPjjxu6JRobVqeuz.OcvhoXlCaGo1q', 'alumno', NULL, '2025-11-10 16:45:37', '2025-11-10 16:47:21'),
(90, 'ELIANA LORENA BRUNO', 'elianabrunotc@gmail.com', NULL, '$2y$12$fofa.uXYqHBRbQs0IJF9WuwYNH8vXqWo/Mfj/U5nespRrzX6VkKie', 'alumno', NULL, '2025-11-10 16:49:18', '2025-11-10 16:49:18'),
(91, 'MARIA SOLEDAD BUSTAMANTE', 'soledadbustamante2@hotmail.com', NULL, '$2y$12$izTmXBmokiX4jmXUcDnCqOrRknoojekq.QZyQ3Aw0foMLeMa3Y2Z2', 'alumno', NULL, '2025-11-10 17:26:15', '2025-11-10 17:26:15'),
(92, 'ANDRES CALVO', 'andresmcalvo1983@gmail.com', NULL, '$2y$12$qfi/ROm7/kp8V5yuAOBa1.baySFrskU2cBHOoxNWzyu6whihwIz7O', 'alumno', NULL, '2025-11-10 17:30:39', '2025-11-10 17:30:39'),
(93, 'CALVO ALCIDES', 'prensaalcidescalvo@gmail.com', NULL, '$2y$12$qspdgkXCF1lwVNwyGfYUU.wgI7vu3ykZTqu2qbRuVTNKaxoGvfKaq', 'alumno', NULL, '2025-11-10 17:32:31', '2025-11-10 17:32:31'),
(94, 'FERNANDO NICOLAS CÁCERES', 'nicolascaceres32123@gmail.com', NULL, '$2y$12$FxRnI/0RBHK7acg20DZfKunK.2adsbEMzfd9FSUA.bD9PRzMw9Aqa', 'alumno', NULL, '2025-11-10 17:36:52', '2025-11-10 17:36:52'),
(95, 'MARIA VICTORIA CABRAL ORIGGI ', 'vcabral45@gmail.com', NULL, '$2y$12$tA5EsqS6hiPk719AfsWEOOkeGiCur7GvGdbjMpx8mRcNUDpye4hy.', 'alumno', NULL, '2025-11-10 17:39:45', '2025-11-10 17:39:45'),
(96, 'CARABALLO CARMEN', 'caraballo33belen@gmail.com', NULL, '$2y$12$idwM.9sEwNgVPvrZukLDE.InVM4rv3uKoeADTioq1qjD0QDNMqvDy', 'alumno', NULL, '2025-11-10 17:42:25', '2025-11-10 17:42:25'),
(97, 'CASTIGLIONI CARINA VANESA', 'carocastiglioni@yahoo.com.ar', NULL, '$2y$12$jXXYsfoe4Rw2iJoKs931xuS4MEYmVfZJLrnhA3JOD.9RsUs0SpV2.', 'alumno', NULL, '2025-11-10 17:45:18', '2025-11-10 17:45:18'),
(98, 'CLAUDIA EVA CAVALLO', 'claudiaeva959@gmail.com', NULL, '$2y$12$zI3rYv9wMFEj1p8O50LL6es17/Jo4nP5YQdUZ7gZ44MQgs.FFXE5i', 'alumno', NULL, '2025-11-10 17:48:55', '2025-11-10 17:48:55'),
(100, 'CONOVALCHUK OMAR ANIBAL', 'konovalchukomar2018@gmail.com', NULL, '$2y$12$JLz2Ecgy6jV.oy.A0Kp3TuMvQ.tcA9ksoEsyksH/SDMN3QszNu6nq', 'alumno', NULL, '2025-11-10 17:59:18', '2025-11-10 17:59:18'),
(101, 'CÓRDOBA ENZO', 'enzocordobabam@gmail.com', NULL, '$2y$12$Ypa2iqD/Mvdk3JeGw9ngQ.Sh7MNOfuJuTPwOf9yRJcq39ZwupF7zi', 'alumno', NULL, '2025-11-11 15:12:59', '2025-11-11 15:12:59'),
(102, 'CORDOBA FELIPE NERIS', 'felipecordoba309@gmail.com', NULL, '$2y$12$nIfeM.7ez39x0EPmNXEMk.VJE4KiNquhDdyFghf7y4gC/IZ0WrwO6', 'alumno', NULL, '2025-11-11 15:14:22', '2025-11-11 15:14:22'),
(103, 'COSTA PEÑA KARINA ELIZABETH', 'ave2017fenix@gmail.com', NULL, '$2y$12$ZYepn6UP2V0wj2STY7uSFeQlNM3yUBmBK6J5ArTYfxqhOlfz01ndi', 'alumno', NULL, '2025-11-11 15:17:44', '2025-11-11 15:17:44'),
(104, 'CUEVAS MARTÍN', 'martinalexis_83@hotmail.com', NULL, '$2y$12$xGL7UtZ31rmE6umhhSxR7On4FnEzjg85PILF2jgeQ9fZ65y9sxmyC', 'alumno', NULL, '2025-11-11 15:19:43', '2025-11-11 15:19:43'),
(105, 'DI LEO MARTIN FRANCISCO', 'ztvdsign@gmail.com', NULL, '$2y$12$Slh30nd9B02KrMj2L4YaBe2f1J.lNZfpICO5TEF6ZSCX5U./WARJC', 'alumno', NULL, '2025-11-11 15:25:06', '2025-11-11 15:25:06'),
(106, 'DIAZ JORGE EDUARDO', 'jorgeduardodiaz@hotmail.com.ar', NULL, '$2y$12$GVkyP89YREduLJlOwBY2d.8YL2nbw3dYAtA.sMs/MRQv48scObvJm', 'alumno', NULL, '2025-11-11 15:28:05', '2025-11-11 15:28:05'),
(107, 'DIAZ OSCAR RUIZ', 'oginoruizdiaz@gmail.com', NULL, '$2y$12$EwyGIrJRFEAX.yWggxgPcehTk42Ar7MNB48sJbt6BQn9fuzWodzM2', 'alumno', NULL, '2025-11-11 16:05:33', '2025-11-11 16:05:33'),
(108, 'DUARTE BALBI FERNANDO JOSE', 'f.duartebalbi@gmail.com', NULL, '$2y$12$n9RBBENWA68hJrDTnJrCnORLfdUP0vnRiBM9ywLadDSywQqlZUpMO', 'alumno', NULL, '2025-11-11 16:10:46', '2025-11-11 16:10:46'),
(109, 'DULCE LUIS MARCELO', 'marcelodulce16@gmail.com', NULL, '$2y$12$W70HWt5Uc9Qbe/Ta5gtcI.wVWDJwwlLQFvzxFuYZQIRZgXuIOALGi', 'alumno', NULL, '2025-11-11 16:12:15', '2025-11-11 16:12:15'),
(110, 'EVANGELISTA MILAGROS MERCEDES', 'milagrosevangelista4@gmail.com', NULL, '$2y$12$nnXDjKV0VPkE5zYDXCP/Eu3.nVJOKIRK5wjBtBlVvUuHi6HQjvXgW', 'alumno', NULL, '2025-11-11 16:17:09', '2025-11-11 16:17:09'),
(111, 'FABRE ALBERARDO CEFERINO', 'elpicuru2009@hotmail.com', NULL, '$2y$12$v.Yhr0r6fwkgRljL/nI7rOUJQCQmom0DFWdEijFflbk64FQyqg5X.', 'alumno', NULL, '2025-11-11 16:19:54', '2025-11-11 16:19:54'),
(112, 'FRÍAS DANIEL ANTONIO', 'danielfrias79@yahoo.com', NULL, '$2y$12$hsNbgv5MYd73mXFdeyYK6.WsfICE7rrePEA6iPKIxAWQTCAKKB6ce', 'alumno', NULL, '2025-11-11 16:24:57', '2025-11-11 16:24:57'),
(113, 'FRÍAS HORACIO', 'alfredoarmando1945@gmail.com', NULL, '$2y$12$xFxQb2ImH9PFgNDxyarXNe8kPaqk2gJoxSA8T.EyPu7dxThYn9wfi', 'alumno', NULL, '2025-11-11 16:26:46', '2025-11-11 16:26:46'),
(114, 'GIMENEZ CARINA DANIELA', 'carinagimenez1974@gmail.com', NULL, '$2y$12$0ufDuoZpitAdDiaufVaozepSpWZjshk3MDSePtc1gM8OvmJi4ndi6', 'alumno', NULL, '2025-11-11 16:36:03', '2025-11-11 16:36:03'),
(115, 'GIMENEZ ELIDA EGLE', 'jimenezelida935@gmail.com', NULL, '$2y$12$5b4K.5oT4WE67mwNJjoVLeW.qc8AGXpOt8z4d.GX6PkZ1wlx8DVC2', 'alumno', NULL, '2025-11-11 16:39:01', '2025-11-11 16:39:01'),
(116, 'GOMEZ NICOLAS', 'nicosimon678@gmail.com', NULL, '$2y$12$LHKmHjnElrQJ0/XuEpYAxuU.CL4txzRlu8u8WVxNCSe8ZBk5VnL.S', 'alumno', NULL, '2025-11-11 16:46:49', '2025-11-11 16:46:49'),
(117, 'GOMEZ MERCEDES DEL VALLE', 'mercedesgomez221084@gmail.com', NULL, '$2y$12$MiVUI6lbajH2wFKU0qcdIuNzvw2U5tWcXKmPu1u0fhkZQ3a0fCR5i', 'alumno', NULL, '2025-11-11 16:49:35', '2025-11-11 16:49:35'),
(118, 'GOMEZ ANDREA VERONICA', 'andreavgomez.1978@gmail.com', NULL, '$2y$12$rCHGzeXzjwREVLNH3zj/k.qY7AK.3f8CxgG.HHEEahTVcxBLMsjTe', 'alumno', NULL, '2025-11-11 16:52:55', '2025-11-11 16:52:55'),
(119, 'GUZMAN ELISA DEL CARMEN', 'elisaguzman86@yahoo.com', NULL, '$2y$12$m37D7QBbgyoaF9VKtAzWX.xreRxl/tZEMDKnK6SaQHwAWbKr1M2sW', 'alumno', NULL, '2025-11-11 17:22:54', '2025-11-11 17:22:54'),
(120, 'HARTRIDGE MARIANO AGUSTIN', 'hartridgemariano@gmail.com', NULL, '$2y$12$Rwm3FHhhDns4KwoXG90TdeBaEIrbmKxKC7EfCmAP7YofcBIbu0eT2', 'alumno', NULL, '2025-11-11 17:54:12', '2025-11-11 17:54:12'),
(121, 'ISBERT MARINA', 'mithumbsup@gmail.com', NULL, '$2y$12$crCL642zO3GypmNVxzvK3u30oVkAsXMOR0HMBXnuUkcYFbPT.KQYS', 'alumno', NULL, '2025-11-11 17:55:52', '2025-11-11 17:55:52'),
(122, 'JAIMEZ CECILIA DEL VALLE', 'ceci121712@gmail.com', NULL, '$2y$12$jffp1q/TG91UkJ3YeFZKD.frgeWuiEPIw9Mc3iBFwzElVAPOpqwY2', 'alumno', NULL, '2025-11-11 18:06:59', '2025-11-11 18:06:59'),
(123, 'JASER JORGE ADOLFO', 'jorjaser04@gmail.com', NULL, '$2y$12$gRCEZnYHmKFklsCuazVNEOGUDkmIUAXUEVckm7JCMJtXadRZv7Y3e', 'alumno', NULL, '2025-11-11 18:11:17', '2025-11-11 18:11:17'),
(124, 'KOCH GASTÓN LUIS', 'gastonlkoch@gmail.com', NULL, '$2y$12$HeyC3hataR8bAK8cjzt6E.es5l1tPUWr5Q2/bNbrjp2Qi4Sd8sI42', 'alumno', NULL, '2025-11-11 18:12:51', '2025-11-11 18:12:51'),
(125, 'KOCH ROSANA', 'kochrosana88@gmail.com', NULL, '$2y$12$XBBgBGRP.705ubCgFua0q.TwdDk4P1uyPodTeCZEiN.KGQ//CeITC', 'alumno', NULL, '2025-11-11 18:15:24', '2025-11-11 18:15:24'),
(126, 'Yami Administradora', 'joanachaves39@gmail.com', NULL, '$2y$12$EzIq0TVDyKwGqy1RI5nIBeXSGtQCCXjc1BHassLeXrdebEHsh4dKa', 'admin', NULL, '2025-11-13 15:28:45', '2025-11-13 15:30:35'),
(127, 'LARREY CECILIA', 'estudiolarrey2@gmail.com', NULL, '$2y$12$1shGY1wdxbeF1Rq0c2tn9Ov1AqF1pSCMjywLZpCIKvTvidoWFhWIq', 'alumno', NULL, '2025-11-13 15:33:55', '2025-11-13 15:33:55'),
(128, 'LEIVA PATRICIA ANALIA', 'leivapatricia2023@gmail.com', NULL, '$2y$12$.TjHeSCXLMYwRrDxHN4tnOIY/O8eKODA2wG8QgHhak0b8jOfMORB.', 'alumno', NULL, '2025-11-13 15:39:29', '2025-11-13 15:39:29'),
(129, ' ROSANA MABEL TOSO', 'tosorosana@gmail.com', NULL, '$2y$12$J0ebdPAPVlAkrrWXfoXxZuDnSV1PbEUGP7yAJG24.wuSzSCd2.RYa', 'alumno', NULL, '2025-11-13 15:42:58', '2025-11-13 15:48:27'),
(130, 'LONGO LAURA', 'laurablongo@yahoo.com.ar', NULL, '$2y$12$KMtpSy.X3pfocVwmIR.eXOl4CbeLsisiwgxkFrK7dWuCcz8UeOMxu', 'alumno', NULL, '2025-11-13 15:43:01', '2025-11-13 15:43:01'),
(131, 'RODRIGUEZ JUAN ALDO', 'juanaldo-rodriguez@hotmail.com', NULL, '$2y$12$rD5EyB8OF5cQseOsAP/pmOgLXSKQ546rNyhA1SXQAWsZWk5.iQDf6', 'alumno', NULL, '2025-11-13 15:46:03', '2025-11-13 15:46:03'),
(133, 'LOPEZ DANA ANDREA', 'danalopez1877@gmail.com', NULL, '$2y$12$teL9Gy7DPt7oebfIr1a50.DSHeCh0pLAHu3yUEwBZDkNomGkL.s.G', 'alumno', NULL, '2025-11-13 15:48:39', '2025-11-13 15:48:39'),
(134, 'LUNA VERONICA', 'vevalu2002@yahoo.com.ar', NULL, '$2y$12$bBZ5Dgf9O.89Ar9.bYS96eCfKr.bn4I2v6EVot4rp.5DWGsjQadnO', 'alumno', NULL, '2025-11-13 15:57:55', '2025-11-13 15:57:55'),
(135, 'LUIS MIGUEL MONTES', 'luismiguelmontes582@gmail.com', NULL, '$2y$12$j0xe6z6LaV7Oaux/mImHi.vvNOfXVYuqOOhzupad9zd1bt0JWZm5G', 'alumno', NULL, '2025-11-13 15:57:59', '2025-11-13 15:57:59'),
(136, 'MACÍAS EMMANUEL MIGUEL', 'emmamaciasdf@gmail.com', NULL, '$2y$12$1/yGQyqPCfAho3K9Sa/Q2u.44IAmTABWtFPG7ORjzod74.iyC2SIa', 'alumno', NULL, '2025-11-13 16:00:52', '2025-11-13 16:00:52'),
(137, 'CELIA HERRERA', 'celiaherrera2006@yahoo.com.ar', NULL, '$2y$12$r6oLR6vYRySzfEuliv.LKeKQZoOIbU8j6DoUxZwLq6QC.VLC6neHe', 'alumno', NULL, '2025-11-13 16:01:54', '2025-11-13 16:01:54'),
(138, 'MALDONADO DANIEL', 'danycmaldonado@yahoo.com.ar', NULL, '$2y$12$fuXtBtSxfq72W9jgE8tMfuayY0/B00U9c8c6TVTtAcQoFXm5953y.', 'alumno', NULL, '2025-11-13 16:04:04', '2025-11-13 16:04:04'),
(139, 'MONICA YOLANDA LUENGO ', 'monicaluengo1878@gmail.com', NULL, '$2y$12$YlDfUPlaH9plYEQt9rDZueZo9RmrwEbpJ/SkFWoL7QrF9Cegxe206', 'alumno', NULL, '2025-11-13 16:05:04', '2025-11-13 16:05:04'),
(140, 'DANIEL GENARO MERCHARN', 'danielgenaromerchan@outlook.com', NULL, '$2y$12$PZAL2qUZVCXGEOwwI80cRuVuGDUNTSvHoMrqTLB/VRT29GExFFO/m', 'alumno', NULL, '2025-11-13 16:07:04', '2025-11-13 16:07:04'),
(141, 'MAMANI RAMONA', 'miriamramona468@gmail.com', NULL, '$2y$12$EfZzufMoEOiV0iD6AwYckuCJ0yLrcMKdEyiLR9JETx7650X1oPLri', 'alumno', NULL, '2025-11-13 16:07:31', '2025-11-13 16:07:31'),
(142, 'MANCILLA NORA MABEL', 'noramancilla11@gmail.com', NULL, '$2y$12$RqZFmZV3gBxbPvy2DdAt7OphAn7rGEF5eizPTbUys5DcW70P0PpBC', 'alumno', NULL, '2025-11-13 16:09:07', '2025-11-13 16:10:25'),
(143, 'MAGALI ALICIA VOLPE', 'magui_volpe@hotmail.com', NULL, '$2y$12$Z9/5SMyav4dNFKqwzxlFcu.DZmecawWswHaHmgE7UqBcedldX7BM2', 'alumno', NULL, '2025-11-13 16:12:44', '2025-11-13 16:12:44'),
(144, 'MANSILLA SILBIA LORENA', 'silbialmansilla28@hotmail.com', NULL, '$2y$12$QBveOvK80iaBygYVJHO2VulovaDPUniYV3bv4lRafFM1htr4axv0e', 'alumno', NULL, '2025-11-13 16:13:28', '2025-11-13 16:13:28'),
(147, 'MARADONA WALDINO ESTEBAN JAIME', 'waldinojaime@hotmail.com', NULL, '$2y$12$eyr1YTgg3r5WXsRbJF/bXeKJDGDjTNm06JU.jexk7tW1OMLyCIcn2', 'alumno', NULL, '2025-11-13 16:19:08', '2025-11-13 16:19:08'),
(148, 'CAROLINA EDIT BAZAN', 'bazancarolina79@gmail.com', NULL, '$2y$12$8379mswPpoatuqa2/jVSveHVIgZMjzcqzTMWX4JAlAzNvM0PpEGOO', 'alumno', NULL, '2025-11-13 16:19:10', '2025-11-13 16:19:10'),
(149, 'MARSILI OSCAR ALBERTO', 'oscaralbertomarsili@gmail.com', NULL, '$2y$12$RbeeFAv0NG7KX/ssUhoiQOtt8D5zS1NkIxrrKfKhhJZdZLRblNkXy', 'alumno', NULL, '2025-11-13 16:21:23', '2025-11-13 16:21:23'),
(150, 'MARTINEZ ANALIA SOLEDAD', 'anyteck20@gmail.com', NULL, '$2y$12$4iKgfM3iULtMH9T1zhyHJ.4AzKKhXYwfwu0ITQcP4oY2626IjnLiC', 'alumno', NULL, '2025-11-13 16:23:51', '2025-11-13 16:23:51'),
(151, 'MARIA ESTER PADILLA', 'pmariaester92@gmail.com', NULL, '$2y$12$EXIpVij5oJ04JD68KVHw/eot2pEBhw7GZcs9Z0VvgbKuFPG7qX8a6', 'alumno', NULL, '2025-11-13 16:24:48', '2025-11-13 16:24:48'),
(152, 'MARTINEZ MARCOS DANTE', 'marcosmartinez.brand@gmail.com', NULL, '$2y$12$BF/gjWLD0.ECGufkTsaKt.ZN0kf6IAxPxrlo1d28.8LO4ZdOw2beq', 'alumno', NULL, '2025-11-13 16:26:03', '2025-11-13 16:26:03'),
(155, 'KAREN UNGERER', 'karenua.social@gmail.com', NULL, '$2y$12$gJr7aI1iW4PUoFc1cHlR0egHWKppw5iDHPIrnELlU5UTrQUojdobC', 'alumno', NULL, '2025-11-13 16:40:34', '2025-11-13 16:40:34'),
(156, 'MILLANO MILAGROS', 'milagrosesqmilla27@gmail.com', NULL, '$2y$12$TMoTwxq50UBNdLABEJNONeRPCgUK71Ymriye16FzKI042daAwkfqm', 'alumno', NULL, '2025-11-13 16:46:30', '2025-11-13 16:46:58'),
(157, 'IVAN ANDRES LARA', 'ivanlara.ok@gmail.com', NULL, '$2y$12$XZHY6ocDTzgjoqyc.dUfauV1zsW7YOq9AAoVKJAAj96cqXSqex8hS', 'alumno', NULL, '2025-11-13 16:54:04', '2025-11-13 16:54:04'),
(158, 'MESSINGER CARLOS RICARDO', 'messingercarlos5@gmail.com', NULL, '$2y$12$sB7F2AyR/9Zg8RgYlwOcEeEOkDBdRECz1O3WZfqw4p1N.805IsrC2', 'alumno', NULL, '2025-11-13 16:54:45', '2025-11-13 16:54:45'),
(159, 'MIRANDA TANIA CALLAPA', 'tania.cmiranda@hotmail.com', NULL, '$2y$12$Kk9XdAVpKjY4Gfopu5iv0u8PvS6DiZnlr3UiJtv5auKDeSr6JWd3S', 'alumno', NULL, '2025-11-13 17:00:58', '2025-11-13 17:00:58'),
(160, 'GÓMEZ NATALIA AILÉN', 'gestion.humana.inteligente@gmail.com', NULL, '$2y$12$xg05JvewnMCy54VTzIS5WuacjfihcQqZEDWQcTlUF3uXxKY3ZLlbe', 'alumno', NULL, '2025-11-13 17:01:22', '2025-11-13 17:01:22'),
(161, 'MONTERO GUSTAVO', 'gusromluana@gmail.com', NULL, '$2y$12$kgGAhqt0D7rLtwtRYT0.1uYD8ggOGF/F.73el9lC3kr9lk8B08rFO', 'alumno', NULL, '2025-11-13 17:04:45', '2025-11-13 17:04:45'),
(162, 'KARINA DEL VALLE OLIVIERI', 'karinaolivieri4@gmail.com', NULL, '$2y$12$T2Kl87ndxzn39k6hNUXMHOYXODskgN9PXivQofLMpclp7JX5r6mg.', 'alumno', NULL, '2025-11-13 17:05:02', '2025-11-13 17:05:02'),
(163, 'MONZON MARIA DE LOS ANGELES', 'monzonmariadelosangeles30@gmail.com', NULL, '$2y$12$LuEPYs5euw1ZY7LaX.T29.qenG.VfvIpjUM6huA0/odF5F2BFA9xq', 'alumno', NULL, '2025-11-13 17:07:08', '2025-11-13 17:07:08'),
(166, 'MOYANO MAIDANA ELIN FERNANDA', 'moyanofernanda9@gmail.com', NULL, '$2y$12$Nm4Bmh7r/9RYm4Ymao0sIuC.RBJeZzCUyAOPAjtIlpllIBoZ9zGKi', 'alumno', NULL, '2025-11-13 17:14:06', '2025-11-13 17:14:06'),
(167, 'JUAN PABLO CICARÉ', 'juanpablocicare@gmail.com', NULL, '$2y$12$U6C4K0SBOZeXKiOTQNBWMeEbC8ukGrKGTt1FjAX4Gg2eBMQ4dUzvW', 'alumno', NULL, '2025-11-13 17:16:01', '2025-11-13 17:16:01'),
(168, 'NAPAL MAURO', 'napaljavier@gmail.com', NULL, '$2y$12$OacnuwCgicWjDJ77Nh1zI.mam7AupdqXca5CFnS3Ngt7Xc6A3HlCm', 'alumno', NULL, '2025-11-13 17:16:30', '2025-11-13 17:16:30'),
(169, 'NIETO ALFREDO ALBERTO', 'alfanisud@yahoo.com.ar', NULL, '$2y$12$4WN/oes8jYiDbOUIz7SEcecNcgUEwSsMZQMPCFhNe7.q24V6iQTPO', 'alumno', NULL, '2025-11-13 17:18:18', '2025-11-13 17:18:18'),
(170, 'NUÑEZ ANCELMO VIDAL', 'ancelmovidalnunez@gmail.com', NULL, '$2y$12$j0r0sg624Dw2DOlEO4dEN.5pZreTSoy7X5aabQ9ljiKQad0KkOPg.', 'alumno', NULL, '2025-11-13 21:10:38', '2025-11-13 21:10:38'),
(171, 'NOTTI GLADYS NOEMI', 'nottigla22@gmail.com', NULL, '$2y$12$MJZrRwGjJJ7/lVRIYbseG.94M4re9Tq//AR.LReXuM7pyeDtK84DC', 'alumno', NULL, '2025-11-13 21:12:41', '2025-11-13 21:12:41'),
(172, 'ORELLANA JOSÉ F', 'josemellizorellana@gmail.com', NULL, '$2y$12$4DTj6KULneuCGchygFsCduGLOUWnX76VVM3Svl1XS.ihhlAkrS8iu', 'alumno', NULL, '2025-11-13 21:14:38', '2025-11-13 21:14:38'),
(173, 'OJEDA CESAR', 'cesar-ojeda@hotmail.com.ar', NULL, '$2y$12$vbEJLH2CLD06x2LByPdWEujh/JMJfV0IIkU8kyR5CC7R76M36FAu.', 'alumno', NULL, '2025-11-13 21:18:22', '2025-11-13 21:18:22'),
(174, 'OVEJERO CLAUDIO', 'claudioovejero285@gmail.com', NULL, '$2y$12$1GPbo7Dor8Ko96t4uRJwFe6qArWrsOPi.6zMsNO.3acJKZBsp9J7W', 'alumno', NULL, '2025-11-13 21:32:12', '2025-11-13 21:33:12'),
(175, 'PATALANO GUILLERMO', 'ggmision55@hotmail.com', NULL, '$2y$12$cRqiqEI5n30fG2FmjBgmJ.tJuitG9ihSmexx/PGGMeQweLPICR5m.', 'alumno', NULL, '2025-11-13 21:36:08', '2025-11-13 21:36:08'),
(176, 'PERUCHENA NICOLÁS LEANDRO ', 'nicolasperuchena12@gmail.com', NULL, '$2y$12$umE0Dp6l2uC1/07FCvfpAeSDPuyocfeABBcWYzER7SpudEG1n9ubu', 'alumno', NULL, '2025-11-13 21:38:35', '2025-11-13 21:38:35'),
(177, 'PIEDRA ADRIANA VERONICA', 'adrianapiedra2017@gmail.com', NULL, '$2y$12$RDhPx0b.cCWEOcHYvCYDg.IFGiHj4R5DVDL/eMgvBJaKqvhvE5gha', 'alumno', NULL, '2025-11-13 21:42:25', '2025-11-13 21:42:25'),
(178, 'PISTOCHINI SORAYA', 'sorypisto@gmail.com', NULL, '$2y$12$cf7Rq/.89DQufDwfGoYOV.VTSSFz9SJ/KF.LHnCXk/zIW.kgWsgn6', 'alumno', NULL, '2025-11-13 21:44:07', '2025-11-13 21:44:07'),
(179, 'Cousau Gisela', 'giselacousau@gmail.com', NULL, '$2y$12$V02a4ayLGAn.v0AzSg24Gu4OcUm3ntdbEiIN613FakhTKQi3UF9Ca', 'alumno', NULL, '2025-11-13 21:47:20', '2025-11-13 21:47:20'),
(180, 'POLINEZI FRANCO', 'polinezif@gmail.com', NULL, '$2y$12$r2TK8y1ZUc0S6L2/iupeW.Pr93ENh9O.c1eOVbhz6o/XEqgX7NTdi', 'alumno', NULL, '2025-11-13 21:48:57', '2025-11-13 21:48:57'),
(181, 'POSETTO ALIHUEN', 'aliposettonogara@gmail.com', NULL, '$2y$12$LDkDxxXawPa6DLkEDaGEDe5YN4Tsm3VK5IaAn5t9PJbQtuhdaPMDi', 'alumno', NULL, '2025-11-13 21:50:51', '2025-11-13 21:50:51'),
(182, 'PRADA LAURA LETICIA', 'laulet1234@gmail.com', NULL, '$2y$12$aS/0ENLTLYfQxs0Rm.i70OZWyQ7UI8ralH31XD5I70XK5k5vpV0X6', 'alumno', NULL, '2025-11-13 21:57:57', '2025-11-13 21:57:57'),
(183, 'RIVAROLA SANDRA LIDIA', 'sandryta1973@gmail.com', NULL, '$2y$12$W6zk8GqU.SajW181P2D6AeIjvRNX9izOfqX1aerrLknEevKlcVle6', 'alumno', NULL, '2025-11-13 22:06:43', '2025-11-13 22:06:43'),
(184, 'RIVOLTA JUAN LEONARDO', 'jrivolta2001@gmail.com', NULL, '$2y$12$aCCK0XYy6t6l/FND.Y6XwOm7UeUXdpAGjtKuFCqgw85RtJa8MFGT.', 'alumno', NULL, '2025-11-13 22:12:15', '2025-11-13 22:12:15'),
(185, 'RIVERO NORMA ELDA', 'norelri360@gmail.com', NULL, '$2y$12$mcRpsj9q.YymZvwZm3d17uoHQFfVxXKSkhQw4.sq06wbT6e2gKZ1y', 'alumno', NULL, '2025-11-13 22:13:41', '2025-11-13 22:13:41'),
(186, 'ROMERO EXEQUIEL ENRIQUE', 'eromeroh2@gmail.com', NULL, '$2y$12$hIpfokkdsUEkLLQhSD1IOO5q26jccB1hZA7E4urnx43zWDTW7pL4O', 'alumno', NULL, '2025-11-13 22:15:51', '2025-11-13 22:15:51'),
(187, 'RODRÍGUEZ MARIA MICAELA', 'micaelarodriguezhcd@gmail.com', NULL, '$2y$12$1Gx3kSVCBBiu6e9c9drLL.4uC.6zQ5uhRMzQTexMrsS8LeNwIc/p.', 'alumno', NULL, '2025-11-13 22:18:15', '2025-11-13 22:18:15'),
(188, 'SAITON SARA SILVANA', 'sarasilvana.armada@gmail.com', NULL, '$2y$12$RwzkodMxnTb6d7xNbSAJUeSHgdHflDRXq5socUySI0nhTYdJojuxu', 'alumno', NULL, '2025-11-13 22:21:21', '2025-11-13 22:21:21'),
(189, 'SALINAS JOSE LUIS', 'salinasjoseluis22@gmail.com', NULL, '$2y$12$dUhWYEoLhcD.Slm9fQBfXulhYkNPa4KZjcMLXhW8B6LClnRYgdlIK', 'alumno', NULL, '2025-11-13 22:29:52', '2025-11-13 22:32:30'),
(190, 'SANDEZ ESTELA', 'matofh@gmail.com', NULL, '$2y$12$KwDqNh5UYLxBu.A0PrUrfusM1SFotb.hl5BoHqhgvNQQUhdfALgTK', 'alumno', NULL, '2025-11-13 22:35:55', '2025-11-13 22:35:55'),
(191, 'SILVA MÓNICA ELIZABETH', 'monicaesilva2023@gmail.com', NULL, '$2y$12$xaj9HasmJGV7oYjXSAmlFuWf/JxWJTSmh/UauxjDRxU9WGcejl2gW', 'alumno', NULL, '2025-11-13 22:46:28', '2025-11-13 22:46:28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cursos_slug_unique` (`slug`);

--
-- Indices de la tabla `curso_user`
--
ALTER TABLE `curso_user`
  ADD PRIMARY KEY (`curso_id`,`user_id`),
  ADD KEY `curso_user_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exams_modulo_id_unique` (`modulo_id`);

--
-- Indices de la tabla `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_answers_exam_attempt_id_exam_question_id_unique` (`exam_attempt_id`,`exam_question_id`),
  ADD KEY `exam_answers_exam_question_id_foreign` (`exam_question_id`);

--
-- Indices de la tabla `exam_attempts`
--
ALTER TABLE `exam_attempts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_attempts_exam_id_user_id_unique` (`exam_id`,`user_id`),
  ADD KEY `exam_attempts_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_questions_exam_id_foreign` (`exam_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `leccions`
--
ALTER TABLE `leccions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leccions_modulo_id_foreign` (`modulo_id`);

--
-- Indices de la tabla `leccion_user`
--
ALTER TABLE `leccion_user`
  ADD PRIMARY KEY (`leccion_id`,`user_id`),
  ADD KEY `leccion_user_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulos_curso_id_foreign` (`curso_id`);

--
-- Indices de la tabla `modulo_user`
--
ALTER TABLE `modulo_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modulo_user_modulo_id_user_id_unique` (`modulo_id`,`user_id`),
  ADD KEY `modulo_user_user_id_foreign` (`user_id`),
  ADD KEY `modulo_user_released_by_foreign` (`released_by`),
  ADD KEY `modulo_user_status_index` (`status`),
  ADD KEY `modulo_user_available_from_index` (`available_from`),
  ADD KEY `modulo_user_available_until_index` (`available_until`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recursos_leccion_id_foreign` (`leccion_id`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `exam_answers`
--
ALTER TABLE `exam_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `exam_attempts`
--
ALTER TABLE `exam_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `leccions`
--
ALTER TABLE `leccions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `modulo_user`
--
ALTER TABLE `modulo_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=546;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso_user`
--
ALTER TABLE `curso_user`
  ADD CONSTRAINT `curso_user_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `curso_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_modulo_id_foreign` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD CONSTRAINT `exam_answers_exam_attempt_id_foreign` FOREIGN KEY (`exam_attempt_id`) REFERENCES `exam_attempts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_answers_exam_question_id_foreign` FOREIGN KEY (`exam_question_id`) REFERENCES `exam_questions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `exam_attempts`
--
ALTER TABLE `exam_attempts`
  ADD CONSTRAINT `exam_attempts_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `leccions`
--
ALTER TABLE `leccions`
  ADD CONSTRAINT `leccions_modulo_id_foreign` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `leccion_user`
--
ALTER TABLE `leccion_user`
  ADD CONSTRAINT `leccion_user_leccion_id_foreign` FOREIGN KEY (`leccion_id`) REFERENCES `leccions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leccion_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `modulos_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `modulo_user`
--
ALTER TABLE `modulo_user`
  ADD CONSTRAINT `modulo_user_modulo_id_foreign` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `modulo_user_released_by_foreign` FOREIGN KEY (`released_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `modulo_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `recursos_leccion_id_foreign` FOREIGN KEY (`leccion_id`) REFERENCES `leccions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
