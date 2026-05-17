-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-03-2025 a las 16:10:36
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cees`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cellphone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cell` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`id`, `full_name`, `cellphone`, `address`, `nit`, `contact`, `identification`, `cell`, `city`, `email`, `comments`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'nuevo cliente', '12341234', 'puerto ordaz', NULL, 'contacto', '12341234', '12341234', 'asdfasdf', 'asdfasdf@gmail.com', 'asdfasdfasdf asd fas', 3, '2024-07-06 08:59:38', '2024-07-06 08:59:38'),
(3, '12341234777777', '1234123', '41234', NULL, '1234123', '1234', '4123412341', '234123', '41234', '1234123412', 3, '2025-02-02 04:10:51', '2025-02-02 04:11:22'),
(4, 'prueba de creación de cliente', '1234', '1234123', NULL, 'safsad', '1234123', 'fasdf', 'asdf', 'hola@gmail.com', 'as dfasdf asdfasdfasd fas', 3, '2025-02-23 00:24:42', '2025-02-23 00:24:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configurations`
--

CREATE TABLE `configurations` (
  `id` bigint UNSIGNED NOT NULL,
  `index_reception` int DEFAULT NULL,
  `index_reception_reference` int DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$',
  `logo_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configurations`
--

INSERT INTO `configurations` (`id`, `index_reception`, `index_reception_reference`, `currency`, `logo_path`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 123, 123, '$', 'http://localhost/storage/configurations/logos/wBGeDWxQXju6COIdE4S1wy40vepyt6hNqJSIJCEj.webp', 3, '2024-06-28 05:57:37', '2025-03-15 14:06:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnoses`
--

CREATE TABLE `diagnoses` (
  `id` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `observations` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initial_date` datetime DEFAULT NULL,
  `reception_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diagnoses`
--

INSERT INTO `diagnoses` (`id`, `status`, `description`, `observations`, `initial_date`, `reception_id`, `user_id`, `created_at`, `updated_at`) VALUES
(19, 0, 'diagnostico1', 'esto es una observación', NULL, 7, 3, '2025-03-02 00:08:40', '2025-03-02 00:08:40'),
(20, 0, 'hola mundo', 'hola mundo', NULL, 6, 3, '2025-03-15 23:50:15', '2025-03-15 23:50:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diagnoses_files`
--

CREATE TABLE `diagnoses_files` (
  `id` bigint UNSIGNED NOT NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnoses_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failure_modes`
--

CREATE TABLE `failure_modes` (
  `id` bigint UNSIGNED NOT NULL,
  `failure_mode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `failure_modes`
--

INSERT INTO `failure_modes` (`id`, `failure_mode`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 'esto es una falla nueva', 3, '2024-07-06 06:17:21', '2024-07-06 06:17:21'),
(9, 'ewrtwert', 3, '2025-02-01 01:12:28', '2025-02-01 01:12:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failure_modes_diagnoses`
--

CREATE TABLE `failure_modes_diagnoses` (
  `id` bigint UNSIGNED NOT NULL,
  `diagnoses_id` bigint UNSIGNED NOT NULL,
  `failure_modes_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_of_measurement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross_cost` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indirect_cost` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_cost` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initial_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `rate_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `description`, `unit_of_measurement`, `gross_cost`, `indirect_cost`, `utility`, `total_cost`, `initial_description`, `final_description`, `user_id`, `rate_id`, `created_at`, `updated_at`) VALUES
(5, 'tornillo2', 'mm', '12', '12', '12', '36', 'di tornillo', 'df tornillo', 3, 2, '2024-07-06 12:49:18', '2025-03-15 21:24:23'),
(6, 'destornillador', 'cm', '12', '32', '23', '67', 'di destornillador', 'df destornillador', 3, 2, '2024-07-06 12:49:48', '2024-07-06 12:49:48'),
(7, 'martillo', 'cm', '32', '23', '43', '98', 'di martillo', 'df martillo', 3, 2, '2024-07-06 12:50:13', '2024-07-06 12:50:13'),
(8, 'Llave ale2', 'mm', NULL, NULL, NULL, NULL, 'es una llave ale', 'es una llave ale', 3, 2, '2025-03-15 21:25:42', '2025-03-15 21:25:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_diagnoses`
--

CREATE TABLE `items_diagnoses` (
  `id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `diagnoses_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_rates`
--

CREATE TABLE `items_rates` (
  `id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `rate_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items_rates`
--

INSERT INTO `items_rates` (`id`, `quantity`, `rate_id`, `item_id`, `created_at`, `updated_at`) VALUES
(5, 7, 2, 6, '2025-03-16 00:39:03', '2025-03-16 00:39:03'),
(6, 2, 2, 8, '2025-03-16 00:39:03', '2025-03-16 00:39:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(22, '2024_07_06_064308_add_column_initial_date_to_diagnoses_table', 3),
(24, '2025_01_30_212921_change_name_column_from_users_table', 4),
(26, '2025_02_16_081702_add_token_reset_password_column_to_users_table', 5),
(28, '2025_02_22_194740_change_currency_column_from_configurations_table', 6),
(29, '2025_03_15_091259_change_profile_column_from_users_table', 7),
(31, '2025_03_15_134449_change_name_column_from_profiles_table', 8),
(33, '2025_03_15_160347_add_gross_cost_column_to_rates_table', 9),
(35, '2025_03_15_160557_add_indirect_cost_column_to_rates_table', 10),
(37, '2025_03_15_160701_add_utility_column_to_rates_table', 11),
(39, '2025_03_15_160829_add_total_cost_column_to_rates_table', 12),
(43, '2025_03_15_184432_create_items_rates_table', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnoses_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` json NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `permissions`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '{\"MANAGE USERS\": \"All\"}', 1, '2024-05-25 22:33:45', '2024-05-25 22:33:46'),
(2, 'Admin', '{\"MANAGE USERS\": \"Own\", \"MANAGE PROFILES\": \"Own\"}', 1, '2024-05-25 22:33:45', '2024-05-25 22:33:46'),
(17, NULL, '{\"MANAGE ITEMS\": \"OWN\", \"MANAGE RATES\": \"OWN\", \"MANAGE CLIENTS\": \"OWN\", \"MANAGE RECEPTIONS\": \"OWN\"}', 3, '2025-03-15 18:58:37', '2025-03-15 19:07:00'),
(18, NULL, '{\"MANAGE ITEMS\": \"OWN\", \"MANAGE RATES\": \"OWN\", \"MANAGE CLIENTS\": \"OWN\", \"MANAGE DIAGNOSES\": \"OWN\", \"MANAGE RECEPTIONS\": \"OWN\", \"MANAGE FAILURE MODES\": \"OWN\", \"MANAGE CONFIGURATIONS\": \"OWN\"}', 3, '2025-03-15 21:16:16', '2025-03-15 21:16:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rates`
--

CREATE TABLE `rates` (
  `id` bigint UNSIGNED NOT NULL,
  `total_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utility` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indirect_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `clients` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rates`
--

INSERT INTO `rates` (`id`, `total_cost`, `utility`, `indirect_cost`, `gross_cost`, `user_id`, `clients`, `created_at`, `updated_at`) VALUES
(2, '69', '23', '23', '23', 3, '[3]', '2024-07-06 12:48:39', '2025-03-15 23:17:45'),
(3, '123', '111', '1', '11', 3, '[3]', '2025-03-02 00:12:44', '2025-03-15 23:17:57'),
(4, NULL, NULL, NULL, NULL, 3, '[4]', '2025-03-02 00:15:45', '2025-03-02 00:15:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receptions`
--

CREATE TABLE `receptions` (
  `id` bigint UNSIGNED NOT NULL,
  `custom_id` int DEFAULT NULL,
  `equipment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capability` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specific_location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipment_owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_inventory` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `receptions`
--

INSERT INTO `receptions` (`id`, `custom_id`, `equipment_type`, `brand`, `model`, `serie`, `capability`, `state`, `comments`, `photos`, `location`, `specific_location`, `type_of_job`, `equipment_owner`, `customer_inventory`, `client_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 100, 'ASDF', 'FASDF', 'ASDF', 'ASDFAS', 'ASDFASD', 'Recibido', 'FASDFASDF', 'http://localhost:8000/storage/receptions/photos/XTes0h4m8ttTGiBKgBDYOnMar1V9q8u6SL0VVDFl.png, http://localhost:8000/storage/receptions/photos/Ir93v3QPjcnmTH6g842SguiIMQjQudXr6HBSYJo5.png', 'DFASDFAS', 'DFASDF', 'Nuevo', 'ASDFASDF', 'ASDFASD', 2, 3, '2025-02-03 02:03:04', '2025-02-03 02:03:04'),
(7, 123, '123', 'asdfas', 'dfasdf', 'asdf1234', 'asdf', 'Recibido', 'asdfasdf', 'http://localhost:8000/storage/receptions/photos/qHLX1XqmVPu6aEgRdWeaHFUvCMLTigXlB5nBk1rX.jpg', '123412', '341234', 'Nuevo', 'asdfsad', 'fasdfasdf', 2, 3, '2025-02-09 18:44:27', '2025-02-09 18:44:27'),
(8, 124, 'asdf', 'asdf', 'asdfas', 'dfasdf', 'asdfasdf', 'Recibido', 'asdfasdf', 'http://localhost:8000/storage/receptions/photos/JodylDEwpfCYbybhxeJvdAoATm9tGyfbblZyMBSR.jpg', 'asdfasdf', 'asdfasdfas', 'Nuevo', 'dfasdfa', 'sdfasdf', 2, 3, '2025-02-09 18:44:49', '2025-02-09 18:44:49'),
(9, 125, 'asddddd', NULL, NULL, NULL, NULL, 'Recibido', NULL, 'http://localhost:8000/storage/receptions/photos/jWfwmoEaQE19XMevsRrLV0hvXCtMxUvEgUttJ883.jpg', NULL, NULL, 'Nuevo', 'aaaaaaaaaaa', NULL, 2, 3, '2025-02-09 05:00:00', '2025-02-10 00:59:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_reset_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner` bigint UNSIGNED DEFAULT NULL,
  `profile` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `token_reset_password`, `remember_token`, `created_at`, `updated_at`, `owner`, `profile`) VALUES
(1, 'John Doe', 'superadmin', 'john.doe@gmail.com', '2024-05-25 22:33:45', '$2y$12$E2Mk1wkOwUiEovbGYNUP.eARoJwaYpKGI8o.FgJ1M69VCHJwk3JTy', NULL, 'rNqrBJvgWl', '2024-05-25 22:33:46', '2024-05-25 22:33:46', NULL, 1),
(3, 'Admin Carlos', 'admin', 'carlos.santaella.cesg@gmail.com', NULL, '$2y$12$sg.zbqAVAQ9KYuNnlaDXtumCBSgAeTavm.8WOaN4ryg8j1z1I2T7C', '2670f59bb0acf17cd2be371db9dc18a9e1cd6688b57eb761b3e6ea5fb09fbf73', NULL, '2024-06-28 05:57:37', '2025-02-16 17:14:51', NULL, 2),
(7, NULL, 'adminqwer', 'hola@gmail.com', NULL, '$2y$12$z5jT8trcKBQ5YutNGj3ududzvlJ6Qao3VbHkSYj25WUKQ1mdjeZgq', NULL, NULL, '2025-01-31 02:31:13', '2025-01-31 02:31:13', 3, NULL),
(9, NULL, 'PEPEPE', 'PEPE@GMAIL.COM', NULL, '$2y$12$z7oqczQPj3jTih5XTokHx.CdwGhhiH.Emkquk9UoQaTCpCHOCe5dO', NULL, NULL, '2025-02-15 14:37:39', '2025-03-15 21:16:16', 3, 18),
(10, NULL, 'supervisorPrueba22', 'sp@gmail.com', NULL, '$2y$12$hfNG9PgEb64nJhXNhlkSP.PaFvG5JTrOsHDu.0fSl5eiEbQcMZ0l.', NULL, NULL, '2025-02-16 02:08:24', '2025-02-23 00:36:41', 3, NULL),
(16, NULL, 'userprueba', 'userprueba@gmail.com', NULL, '$2y$12$/aavMbLe6v6oI1amghJIzO3Sep92yp8ri6rDuZ/guySAdxGnLJshC', NULL, NULL, '2025-03-15 18:50:32', '2025-03-15 18:58:37', 3, 17);

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
-- Indices de la tabla `items_rates`
--
ALTER TABLE `items_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_rates_rate_id_foreign` (`rate_id`),
  ADD KEY `items_rates_item_id_foreign` (`item_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `diagnoses`
--
ALTER TABLE `diagnoses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `diagnoses_files`
--
ALTER TABLE `diagnoses_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failure_modes`
--
ALTER TABLE `failure_modes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `failure_modes_diagnoses`
--
ALTER TABLE `failure_modes_diagnoses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `items_diagnoses`
--
ALTER TABLE `items_diagnoses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `items_rates`
--
ALTER TABLE `items_rates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `photos_items_diagnoses`
--
ALTER TABLE `photos_items_diagnoses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `receptions`
--
ALTER TABLE `receptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
-- Filtros para la tabla `items_rates`
--
ALTER TABLE `items_rates`
  ADD CONSTRAINT `items_rates_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_rates_rate_id_foreign` FOREIGN KEY (`rate_id`) REFERENCES `rates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

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
  ADD CONSTRAINT `users_profile_foreign` FOREIGN KEY (`profile`) REFERENCES `profiles` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
