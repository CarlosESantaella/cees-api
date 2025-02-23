-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 22-02-2025 a las 22:05:50
-- Versión del servidor: 10.11.11-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u997039293_cees`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `cellphone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `nit` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `identification` varchar(255) DEFAULT NULL,
  `cell` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `full_name`, `cellphone`, `address`, `nit`, `contact`, `identification`, `cell`, `city`, `email`, `comments`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'nuevo cliente', '12341234', 'puerto ordaz', NULL, 'contacto', '12341234', '12341234', 'asdfasdf', 'asdfasdf@gmail.com', 'asdfasdfasdf asd fas', 3, '2024-07-06 08:59:38', '2024-07-06 08:59:38'),
(3, 'cliente segundo', '1234123', 'esto es una dirección de prueba', NULL, 'asasdf', '1234123', '1234123', 'asdfasdf', 'cliente2@gmail.com', 'as dfas dfasd fasd f', 3, '2025-02-16 20:38:45', '2025-02-16 20:38:45'),
(4, 'cliente tercero prueba2', '12341234', 'asdfasdf', NULL, 'asdfasd', '12341234', 'fasdfas', 'asdfasdf', 'holahola@gmail.com', 'qwerqwerqwer', 3, '2025-02-22 19:40:14', '2025-02-22 19:40:22'),
(5, 'cuarto cliente de pruebas', '123412', '12341234', NULL, 'asdfsadf', '12341234', '12341234', 'qwerqwer', 'qwerq@gmail.com', 'asdfqwerqwer', 3, '2025-02-22 22:05:33', '2025-02-22 22:05:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configurations`
--

CREATE TABLE `configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `index_reception` int(11) DEFAULT NULL,
  `index_reception_reference` int(11) DEFAULT NULL,
  `currency` varchar(255) DEFAULT '$',
  `logo_path` varchar(255) DEFAULT 'https://mintcream-pony-205152.hostingersite.com/storage/configurations/logos/banner-placeholder.jpg',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configurations`
--

INSERT INTO `configurations` (`id`, `index_reception`, `index_reception_reference`, `currency`, `logo_path`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 100, 101, '$', 'https://mintcream-pony-205152.hostingersite.com/storage/configurations/logos/colQmcduh23WI1mqWlo0cVfddN8blkBHyYtXixLr.webp', 3, '2024-06-28 05:57:37', '2025-02-16 21:29:29'),
(4, NULL, NULL, NULL, NULL, 8, '2025-02-11 23:41:48', '2025-02-11 23:41:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnoses`
--

CREATE TABLE `diagnoses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `description` varchar(255) NOT NULL,
  `observations` varchar(255) DEFAULT NULL,
  `initial_date` datetime DEFAULT NULL,
  `reception_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diagnoses`
--

INSERT INTO `diagnoses` (`id`, `status`, `description`, `observations`, `initial_date`, `reception_id`, `user_id`, `created_at`, `updated_at`) VALUES
(16, 1, 'asdf', 'asdfasdfasdf', '2024-07-06 07:47:54', 3, 3, '2024-07-06 11:39:23', '2024-07-06 12:47:54'),
(17, 1, 'dfg', 'asdfsadf', '2024-07-27 19:07:17', 4, 3, '2024-07-27 23:57:31', '2024-07-28 00:07:17'),
(18, 0, '2134', 'sdafsdf', '2024-07-27 19:09:39', 5, 3, '2024-07-28 00:09:29', '2024-07-28 00:09:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnoses_files`
--

CREATE TABLE `diagnoses_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `diagnoses_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `failure_modes`
--

CREATE TABLE `failure_modes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `failure_mode` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `failure_modes`
--

INSERT INTO `failure_modes` (`id`, `failure_mode`, `user_id`, `created_at`, `updated_at`) VALUES
(9, 'esto es otra falla', 3, '2025-02-16 21:04:00', '2025-02-16 21:04:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failure_modes_diagnoses`
--

CREATE TABLE `failure_modes_diagnoses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diagnoses_id` bigint(20) UNSIGNED NOT NULL,
  `failure_modes_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `failure_modes_diagnoses`
--

INSERT INTO `failure_modes_diagnoses` (`id`, `diagnoses_id`, `failure_modes_id`, `created_at`, `updated_at`) VALUES
(29, 16, 9, '2025-02-16 21:04:33', '2025-02-16 21:04:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `unit_of_measurement` varchar(255) DEFAULT NULL,
  `gross_cost` varchar(255) DEFAULT NULL,
  `indirect_cost` varchar(255) DEFAULT NULL,
  `utility` varchar(255) DEFAULT NULL,
  `total_cost` varchar(255) DEFAULT NULL,
  `initial_description` varchar(255) DEFAULT NULL,
  `final_description` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `description`, `unit_of_measurement`, `gross_cost`, `indirect_cost`, `utility`, `total_cost`, `initial_description`, `final_description`, `user_id`, `rate_id`, `created_at`, `updated_at`) VALUES
(5, 'tornillo', 'mm', '12', '12', '12', '36', 'di tornillo', 'df tornillo', 3, 2, '2024-07-06 12:49:18', '2024-07-06 12:49:18'),
(6, 'destornillador', 'cm', '12', '32', '23', '67', 'di destornillador', 'df destornillador', 3, 2, '2024-07-06 12:49:48', '2024-07-06 12:49:48'),
(7, 'martillo', 'cm', '32', '23', '43', '98', 'di martillo', 'df martillo', 3, 2, '2024-07-06 12:50:13', '2024-07-06 12:50:13'),
(8, 'qwer', 'qwer', '1234123', '12341', '1234123', '2480587', 'sadfas', 'dfasdf', 3, 2, '2025-02-16 20:37:16', '2025-02-16 20:37:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_diagnoses`
--

CREATE TABLE `items_diagnoses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `diagnoses_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items_diagnoses`
--

INSERT INTO `items_diagnoses` (`id`, `quantity`, `diagnoses_id`, `item_id`, `created_at`, `updated_at`) VALUES
(24, 2, 16, 5, '2024-07-07 02:32:52', '2024-07-07 02:32:52'),
(25, 1, 16, 6, '2024-07-07 02:32:52', '2024-07-07 02:32:52');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2023_12_12_213851_create_failed_jobs_table', 1),
(4, '2023_12_12_213852_create_password_reset_tokens_table', 1),
(5, '2023_12_12_213855_create_profile_table', 1),
(6, '2023_12_16_173806_create_clients_table', 1),
(7, '2024_01_07_142325_create_receptions_table', 1),
(8, '2024_01_25_213322_create_configurations_table', 1),
(9, '2024_02_12_184531_create_rates_table', 1),
(10, '2024_02_12_192929_create_items_table', 1),
(11, '2024_04_03_171811_add_column_logo_path_to_configurations_table', 1),
(12, '2024_04_03_193641_change_column_photos_from_receptions_table', 1),
(13, '2024_05_15_184446_create_diagnoses_table', 1),
(14, '2024_05_15_185011_create_diagnoses_files_table', 1),
(15, '2024_05_15_185438_create_failure_modes_table', 1),
(16, '2024_05_15_185536_create_failure_modes_diagnoses_table', 1),
(17, '2024_05_15_185629_create_items_diagnoses_table', 1),
(18, '2024_05_15_185901_create_photos_items_diagnoses_table', 1),
(20, '2024_07_06_063257_add_column_observations_to_diagnoses', 2),
(22, '2024_07_06_064308_add_column_initial_date_to_diagnoses_table', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photos_items_diagnoses`
--

CREATE TABLE `photos_items_diagnoses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `diagnoses_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `photos_items_diagnoses`
--

INSERT INTO `photos_items_diagnoses` (`id`, `photo`, `description`, `diagnoses_id`, `item_id`, `created_at`, `updated_at`) VALUES
(52, 'http://localhost:8000/storage/diagnoses/items/photo/NfgVi8rKerMHVRuMD9iKVgWexDYyMFySoFbwDx2m.png', '', 16, 5, '2024-07-07 02:33:12', '2024-07-07 02:33:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`permissions`)),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `permissions`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '{\"MANAGE USERS\": \"All\"}', 1, '2024-05-25 22:33:45', '2024-05-25 22:33:46'),
(2, 'Admin', '{\n    \"MANAGE USERS\": \"Own\",\n    \"MANAGE PROFILES\": \"Own\"\n}', 1, '2024-05-25 22:33:45', '2024-05-25 22:33:46'),
(5, 'supervisor 2', '{\"MANAGE CLIENTS\":\"OWN\",\"MANAGE RATES\":\"OWN\",\"MANAGE ITEMS\":\"OWN\",\"MANAGE RECEPTIONS\":\"OWN\",\"MANAGE DIAGNOSES\":\"OWN\",\"MANAGE FAILURE MODES\":\"OWN\",\"MANAGE CONFIGURATIONS\":\"OWN\"}', 3, '2025-01-06 21:06:30', '2025-02-16 21:02:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `clients` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rates`
--

INSERT INTO `rates` (`id`, `user_id`, `clients`, `created_at`, `updated_at`) VALUES
(2, 3, '[2]', '2024-07-06 12:48:39', '2024-07-06 12:48:39'),
(3, 3, '[3]', '2025-02-16 20:40:12', '2025-02-16 20:40:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receptions`
--

CREATE TABLE `receptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_id` int(11) DEFAULT NULL,
  `equipment_type` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `serie` varchar(255) DEFAULT NULL,
  `capability` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `photos` longtext DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `specific_location` varchar(255) DEFAULT NULL,
  `type_of_job` varchar(255) DEFAULT NULL,
  `equipment_owner` varchar(255) DEFAULT NULL,
  `customer_inventory` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `receptions`
--

INSERT INTO `receptions` (`id`, `custom_id`, `equipment_type`, `brand`, `model`, `serie`, `capability`, `state`, `comments`, `photos`, `location`, `specific_location`, `type_of_job`, `equipment_owner`, `customer_inventory`, `client_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 12, 's dfsa df', 'df sa', 'dfs a dfsa', 'serie123', 'as dfs adf sa', 'Recibido', 'as dfs adf', 'http://localhost:8000/storage/receptions/photos/3cr8o9mHh9AqlDXsOS2l7IjplyakiPMJZJf1ytET.png', 'fsa dfsa', 'dfsa dfsa df', 'Nuevo', 'asdf', 'asdfas df', 2, 3, '2024-07-06 08:59:57', '2024-07-06 08:59:57'),
(4, 1, '1234', '1234', '1234', 'serie321', '1234', 'Recibido', '12341234', 'http://localhost:8000/storage/receptions/photos/8UDIrsCezP53Zexy36ffDq2kESEruVWahtRaKa5M.jpg', '2134', '1234', 'Nuevo', '1234', '1234', 2, 3, '2024-07-27 23:43:35', '2024-07-27 23:43:35'),
(5, 100, '777', '777', '777', 'serie777', '777', 'Recibido', '777', 'http://localhost:8000/storage/receptions/photos/k1NPiVTgfDv5KIYBucxLWxAfU5oa066HwYuAT8Je.jpg', '777', '777', 'Nuevo', '777', '777', 2, 3, '2024-07-28 00:08:49', '2024-07-28 00:08:49'),
(6, 100, 'asdfasdf', 'sdfas', 'dfasdf', '1234123421', 'asdfa', 'Recibido', 'fasdfasdfasdfasdf', 'https://mintcream-pony-205152.hostingersite.com/storage/receptions/photos/KzYHp3olUgXitsCzsQQeuT6cs3FRgDdsvpEwackW.png', '3asdfasdf', 'asdfasdfasdf', 'Nuevo', 'asdfasdf', 'asdfasdfasd', 2, 3, '2025-02-16 20:52:10', '2025-02-16 20:52:10'),
(7, 101, 's dfsa df', 'df sa', 'dfs a dfsa', 'serie123', 'as dfs adf sa', 'Recibido', 'as dfs adf', 'https://mintcream-pony-205152.hostingersite.com/storage/receptions/photos/inx8GEgnuPs3AakQ1hkxrQjYCKZDvWA25c3DEptt.png', 'fsa dfsa', 'dfsa dfsa df', 'Nuevo', 'asdf', 'asdfas df', 2, 3, '2025-02-16 21:00:04', '2025-02-16 21:00:04'),
(8, 100, 'asdf', 'dfasdf', 'asdfa', '12341234', 'asdfas', 'Recibido', 'asdfasdfas', 'https://mintcream-pony-205152.hostingersite.com/storage/receptions/photos/yMmPx8AOCD4QXPHnbEMbwddP9ArfhC2M9cGhkQ3E.png', 'asdfas', 'dfasdf', 'Nuevo', 'asdfasd', 'fasdfasdf', 3, 3, '2025-02-16 21:29:29', '2025-02-16 21:29:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token_reset_password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner` bigint(20) UNSIGNED DEFAULT NULL,
  `profile` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `token_reset_password`, `remember_token`, `created_at`, `updated_at`, `owner`, `profile`) VALUES
(1, 'John Doe', 'superadmin', 'john.doe@gmail.com', '2024-05-25 22:33:45', '$2y$12$xgpmhT4tzcxf5VgHnlvtBOsTieIxBYnZfcRxN5cj6GmjN4s12HppW', NULL, 'rNqrBJvgWl', '2024-05-25 22:33:46', '2024-05-25 22:33:46', NULL, 1),
(3, 'Admin Hildegar', 'admin', 'carlos.santaella.cesg@gmail.com', NULL, '$2y$12$Hu.b5cetZ1WLKScnYu24G.aXyxnhWPvYzJmnfzYuqvg3R31AP3X6q', NULL, NULL, '2024-06-28 05:57:37', '2025-02-16 20:30:53', NULL, 2),
(7, 'supervisor', 'supervisor', 'supervisor@gmail.com', NULL, '$2y$12$1MqT1wYc9Le2spgRoOLfieVHAwVeyjUmcmwasD.N2AhQ9M/hd2Cgq', NULL, NULL, '2025-01-06 21:19:54', '2025-01-06 21:19:54', 3, 5),
(8, 'RAMON ARIZA', 'LEOTECNICAS', 'gestiondocumental@leotecnicas.com', NULL, '$2y$12$A3xCQoq0vYXVw7Igh1LoxuidnQmVKB9fLN4xmfYEpDGFdLOV1meQW', NULL, NULL, '2025-02-11 23:41:48', '2025-02-11 23:41:48', NULL, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `configurations_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diagnoses_reception_id_foreign` (`reception_id`),
  ADD KEY `diagnoses_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `diagnoses_files`
--
ALTER TABLE `diagnoses_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diagnoses_files_diagnoses_id_foreign` (`diagnoses_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `failure_modes`
--
ALTER TABLE `failure_modes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `failure_modes_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `failure_modes_diagnoses`
--
ALTER TABLE `failure_modes_diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `failure_modes_diagnoses_diagnoses_id_foreign` (`diagnoses_id`),
  ADD KEY `failure_modes_diagnoses_failure_modes_id_foreign` (`failure_modes_id`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_user_id_foreign` (`user_id`),
  ADD KEY `items_rate_id_foreign` (`rate_id`);

--
-- Indices de la tabla `items_diagnoses`
--
ALTER TABLE `items_diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_diagnoses_diagnoses_id_foreign` (`diagnoses_id`),
  ADD KEY `items_diagnoses_item_id_foreign` (`item_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `photos_items_diagnoses`
--
ALTER TABLE `photos_items_diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_items_diagnoses_diagnoses_id_foreign` (`diagnoses_id`),
  ADD KEY `photos_items_diagnoses_item_id_foreign` (`item_id`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `receptions`
--
ALTER TABLE `receptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receptions_client_id_foreign` (`client_id`),
  ADD KEY `receptions_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_owner_foreign` (`owner`),
  ADD KEY `users_profile_foreign` (`profile`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `diagnoses`
--
ALTER TABLE `diagnoses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `diagnoses_files`
--
ALTER TABLE `diagnoses_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failure_modes`
--
ALTER TABLE `failure_modes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `failure_modes_diagnoses`
--
ALTER TABLE `failure_modes_diagnoses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `items_diagnoses`
--
ALTER TABLE `items_diagnoses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `photos_items_diagnoses`
--
ALTER TABLE `photos_items_diagnoses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `receptions`
--
ALTER TABLE `receptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `configurations`
--
ALTER TABLE `configurations`
  ADD CONSTRAINT `configurations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD CONSTRAINT `diagnoses_reception_id_foreign` FOREIGN KEY (`reception_id`) REFERENCES `receptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diagnoses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `diagnoses_files`
--
ALTER TABLE `diagnoses_files`
  ADD CONSTRAINT `diagnoses_files_diagnoses_id_foreign` FOREIGN KEY (`diagnoses_id`) REFERENCES `diagnoses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `failure_modes`
--
ALTER TABLE `failure_modes`
  ADD CONSTRAINT `failure_modes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `failure_modes_diagnoses`
--
ALTER TABLE `failure_modes_diagnoses`
  ADD CONSTRAINT `failure_modes_diagnoses_diagnoses_id_foreign` FOREIGN KEY (`diagnoses_id`) REFERENCES `diagnoses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `failure_modes_diagnoses_failure_modes_id_foreign` FOREIGN KEY (`failure_modes_id`) REFERENCES `failure_modes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_rate_id_foreign` FOREIGN KEY (`rate_id`) REFERENCES `rates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `items_diagnoses`
--
ALTER TABLE `items_diagnoses`
  ADD CONSTRAINT `items_diagnoses_diagnoses_id_foreign` FOREIGN KEY (`diagnoses_id`) REFERENCES `diagnoses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_diagnoses_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `photos_items_diagnoses`
--
ALTER TABLE `photos_items_diagnoses`
  ADD CONSTRAINT `photos_items_diagnoses_diagnoses_id_foreign` FOREIGN KEY (`diagnoses_id`) REFERENCES `diagnoses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `photos_items_diagnoses_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `receptions`
--
ALTER TABLE `receptions`
  ADD CONSTRAINT `receptions_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_owner_foreign` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_profile_foreign` FOREIGN KEY (`profile`) REFERENCES `profiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
