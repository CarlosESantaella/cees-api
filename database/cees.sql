-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 26, 2024 at 12:58 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cees`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cellphone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cell` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `full_name`, `cellphone`, `address`, `nit`, `contact`, `identification`, `cell`, `city`, `email`, `comments`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'nuevo cliente', '12341234', 'puerto ordaz', NULL, 'contacto', '12341234', '12341234', 'asdfasdf', 'asdfasdf@gmail.com', 'asdfasdfasdf asd fas', 3, '2024-07-06 08:59:38', '2024-07-06 08:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` bigint UNSIGNED NOT NULL,
  `index_reception` int DEFAULT NULL,
  `index_reception_reference` int DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `index_reception`, `index_reception_reference`, `currency`, `logo_path`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 100, 101, NULL, NULL, 3, '2024-06-28 05:57:37', '2024-07-28 00:08:49'),
(3, NULL, NULL, NULL, NULL, 6, '2024-06-28 06:03:26', '2024-06-28 06:03:26');

-- --------------------------------------------------------

--
-- Table structure for table `diagnoses`
--

CREATE TABLE `diagnoses` (
  `id` bigint UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initial_date` datetime DEFAULT NULL,
  `reception_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diagnoses`
--

INSERT INTO `diagnoses` (`id`, `status`, `description`, `observations`, `initial_date`, `reception_id`, `user_id`, `created_at`, `updated_at`) VALUES
(16, 1, 'asdf', 'asdfasdfasdf', '2024-07-06 07:47:54', 3, 3, '2024-07-06 11:39:23', '2024-07-06 12:47:54'),
(17, 1, 'dfg', 'asdfsadf', '2024-07-27 19:07:17', 4, 3, '2024-07-27 23:57:31', '2024-07-28 00:07:17'),
(18, 0, '2134', 'sdafsdf', '2024-07-27 19:09:39', 5, 3, '2024-07-28 00:09:29', '2024-07-28 00:09:39');

-- --------------------------------------------------------

--
-- Table structure for table `diagnoses_files`
--

CREATE TABLE `diagnoses_files` (
  `id` bigint UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnoses_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failure_modes`
--

CREATE TABLE `failure_modes` (
  `id` bigint UNSIGNED NOT NULL,
  `failure_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failure_modes`
--

INSERT INTO `failure_modes` (`id`, `failure_mode`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 'esto es una falla nueva', 3, '2024-07-06 06:17:21', '2024-07-06 06:17:21');

-- --------------------------------------------------------

--
-- Table structure for table `failure_modes_diagnoses`
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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_of_measurement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gross_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indirect_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utility` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initial_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `rate_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `description`, `unit_of_measurement`, `gross_cost`, `indirect_cost`, `utility`, `total_cost`, `initial_description`, `final_description`, `user_id`, `rate_id`, `created_at`, `updated_at`) VALUES
(5, 'tornillo', 'mm', '12', '12', '12', '36', 'di tornillo', 'df tornillo', 3, 2, '2024-07-06 12:49:18', '2024-07-06 12:49:18'),
(6, 'destornillador', 'cm', '12', '32', '23', '67', 'di destornillador', 'df destornillador', 3, 2, '2024-07-06 12:49:48', '2024-07-06 12:49:48'),
(7, 'martillo', 'cm', '32', '23', '43', '98', 'di martillo', 'df martillo', 3, 2, '2024-07-06 12:50:13', '2024-07-06 12:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `items_diagnoses`
--

CREATE TABLE `items_diagnoses` (
  `id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `diagnoses_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items_diagnoses`
--

INSERT INTO `items_diagnoses` (`id`, `quantity`, `diagnoses_id`, `item_id`, `created_at`, `updated_at`) VALUES
(24, 2, 16, 5, '2024-07-07 02:32:52', '2024-07-07 02:32:52'),
(25, 1, 16, 6, '2024-07-07 02:32:52', '2024-07-07 02:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
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
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos_items_diagnoses`
--

CREATE TABLE `photos_items_diagnoses` (
  `id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnoses_id` bigint UNSIGNED NOT NULL,
  `item_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos_items_diagnoses`
--

INSERT INTO `photos_items_diagnoses` (`id`, `photo`, `description`, `diagnoses_id`, `item_id`, `created_at`, `updated_at`) VALUES
(52, 'http://localhost:8000/storage/diagnoses/items/photo/NfgVi8rKerMHVRuMD9iKVgWexDYyMFySoFbwDx2m.png', '', 16, 5, '2024-07-07 02:33:12', '2024-07-07 02:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `permissions`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '{\"MANAGE ITEMS\": \"None\", \"MANAGE USERS\": \"All\", \"MANAGE ORDERS\": \"None\", \"MANAGE CLIENTS\": \"None\", \"MANAGE REQUEST\": \"None\", \"MANAGE PROFILES\": \"All\", \"MANAGE SERVICES\": \"None\", \"MANAGE INVENTORY\": \"None\", \"MANAGE FAILURE MODES\": \"None\", \"MANAGE CONFIGURATIONS\": \"None\", \"MANAGE DIAGNOSES\": \"None\"}', 1, '2024-05-25 22:33:45', '2024-05-25 22:33:46'),
(2, 'Admin', '{\"MANAGE ITEMS\": \"Own\", \"MANAGE RATES\": \"Own\", \"MANAGE USERS\": \"Own\", \"MANAGE ORDERS\": \"Own\", \"MANAGE CLIENTS\": \"Own\", \"MANAGE REQUEST\": \"Own\", \"MANAGE PROFILES\": \"Own\", \"MANAGE SERVICES\": \"Own\", \"MANAGE INVENTORY\": \"Own\", \"MANAGE RECEPTIONS\": \"Own\", \"MANAGE FAILURE MODES\": \"Own\", \"MANAGE CONFIGURATIONS\": \"Own\", \"MANAGE DIAGNOSES\": \"Own\"}', 1, '2024-05-25 22:33:45', '2024-05-25 22:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `clients` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `user_id`, `clients`, `created_at`, `updated_at`) VALUES
(2, 3, '[2]', '2024-07-06 12:48:39', '2024-07-06 12:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `receptions`
--

CREATE TABLE `receptions` (
  `id` bigint UNSIGNED NOT NULL,
  `custom_id` int DEFAULT NULL,
  `equipment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos` longtext COLLATE utf8mb4_unicode_ci,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specific_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipment_owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_inventory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receptions`
--

INSERT INTO `receptions` (`id`, `custom_id`, `equipment_type`, `brand`, `model`, `serie`, `capability`, `state`, `comments`, `photos`, `location`, `specific_location`, `type_of_job`, `equipment_owner`, `customer_inventory`, `client_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 12, 's dfsa df', 'df sa', 'dfs a dfsa', 'serie123', 'as dfs adf sa', 'Recibido', 'as dfs adf', 'http://localhost:8000/storage/receptions/photos/3cr8o9mHh9AqlDXsOS2l7IjplyakiPMJZJf1ytET.png', 'fsa dfsa', 'dfsa dfsa df', 'Nuevo', 'asdf', 'asdfas df', 2, 3, '2024-07-06 08:59:57', '2024-07-06 08:59:57'),
(4, 1, '1234', '1234', '1234', 'serie321', '1234', 'Recibido', '12341234', 'http://localhost:8000/storage/receptions/photos/8UDIrsCezP53Zexy36ffDq2kESEruVWahtRaKa5M.jpg', '2134', '1234', 'Nuevo', '1234', '1234', 2, 3, '2024-07-27 23:43:35', '2024-07-27 23:43:35'),
(5, 100, '777', '777', '777', 'serie777', '777', 'Recibido', '777', 'http://localhost:8000/storage/receptions/photos/k1NPiVTgfDv5KIYBucxLWxAfU5oa066HwYuAT8Je.jpg', '777', '777', 'Nuevo', '777', '777', 2, 3, '2024-07-28 00:08:49', '2024-07-28 00:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner` bigint UNSIGNED DEFAULT NULL,
  `profile` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `owner`, `profile`) VALUES
(1, 'John Doe', 'superadmin', 'john.doe@gmail.com', '2024-05-25 22:33:45', '$2y$12$E2Mk1wkOwUiEovbGYNUP.eARoJwaYpKGI8o.FgJ1M69VCHJwk3JTy', 'rNqrBJvgWl', '2024-05-25 22:33:46', '2024-05-25 22:33:46', NULL, 1),
(3, 'Admin Hildegar', 'admin', 'admin.hildegar@gmail.com', NULL, '$2y$12$xgpmhT4tzcxf5VgHnlvtBOsTieIxBYnZfcRxN5cj6GmjN4s12HppW', NULL, '2024-06-28 05:57:37', '2024-07-27 23:28:00', NULL, 2),
(6, 'Admin Hildegar2', 'admin2', 'admin.hildegar2@gmail.com', NULL, '$2y$12$cIhH0WPtcvM7KxYwIs3OJ.n.eqqRoP0W3KpM1gQmCzu.nqMqqIN5e', NULL, '2024-06-28 06:03:26', '2024-06-28 06:03:26', NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `configurations_user_id_foreign` (`user_id`);

--
-- Indexes for table `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diagnoses_reception_id_foreign` (`reception_id`),
  ADD KEY `diagnoses_user_id_foreign` (`user_id`);

--
-- Indexes for table `diagnoses_files`
--
ALTER TABLE `diagnoses_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diagnoses_files_diagnoses_id_foreign` (`diagnoses_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `failure_modes`
--
ALTER TABLE `failure_modes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `failure_modes_user_id_foreign` (`user_id`);

--
-- Indexes for table `failure_modes_diagnoses`
--
ALTER TABLE `failure_modes_diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `failure_modes_diagnoses_diagnoses_id_foreign` (`diagnoses_id`),
  ADD KEY `failure_modes_diagnoses_failure_modes_id_foreign` (`failure_modes_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_user_id_foreign` (`user_id`),
  ADD KEY `items_rate_id_foreign` (`rate_id`);

--
-- Indexes for table `items_diagnoses`
--
ALTER TABLE `items_diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_diagnoses_diagnoses_id_foreign` (`diagnoses_id`),
  ADD KEY `items_diagnoses_item_id_foreign` (`item_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photos_items_diagnoses`
--
ALTER TABLE `photos_items_diagnoses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_items_diagnoses_diagnoses_id_foreign` (`diagnoses_id`),
  ADD KEY `photos_items_diagnoses_item_id_foreign` (`item_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_user_id_foreign` (`user_id`);

--
-- Indexes for table `receptions`
--
ALTER TABLE `receptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receptions_client_id_foreign` (`client_id`),
  ADD KEY `receptions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_owner_foreign` (`owner`),
  ADD KEY `users_profile_foreign` (`profile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `diagnoses`
--
ALTER TABLE `diagnoses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `diagnoses_files`
--
ALTER TABLE `diagnoses_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failure_modes`
--
ALTER TABLE `failure_modes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failure_modes_diagnoses`
--
ALTER TABLE `failure_modes_diagnoses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items_diagnoses`
--
ALTER TABLE `items_diagnoses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos_items_diagnoses`
--
ALTER TABLE `photos_items_diagnoses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `receptions`
--
ALTER TABLE `receptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `configurations`
--
ALTER TABLE `configurations`
  ADD CONSTRAINT `configurations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD CONSTRAINT `diagnoses_reception_id_foreign` FOREIGN KEY (`reception_id`) REFERENCES `receptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diagnoses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnoses_files`
--
ALTER TABLE `diagnoses_files`
  ADD CONSTRAINT `diagnoses_files_diagnoses_id_foreign` FOREIGN KEY (`diagnoses_id`) REFERENCES `diagnoses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `failure_modes`
--
ALTER TABLE `failure_modes`
  ADD CONSTRAINT `failure_modes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `failure_modes_diagnoses`
--
ALTER TABLE `failure_modes_diagnoses`
  ADD CONSTRAINT `failure_modes_diagnoses_diagnoses_id_foreign` FOREIGN KEY (`diagnoses_id`) REFERENCES `diagnoses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `failure_modes_diagnoses_failure_modes_id_foreign` FOREIGN KEY (`failure_modes_id`) REFERENCES `failure_modes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_rate_id_foreign` FOREIGN KEY (`rate_id`) REFERENCES `rates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items_diagnoses`
--
ALTER TABLE `items_diagnoses`
  ADD CONSTRAINT `items_diagnoses_diagnoses_id_foreign` FOREIGN KEY (`diagnoses_id`) REFERENCES `diagnoses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_diagnoses_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photos_items_diagnoses`
--
ALTER TABLE `photos_items_diagnoses`
  ADD CONSTRAINT `photos_items_diagnoses_diagnoses_id_foreign` FOREIGN KEY (`diagnoses_id`) REFERENCES `diagnoses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `photos_items_diagnoses_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receptions`
--
ALTER TABLE `receptions`
  ADD CONSTRAINT `receptions_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `receptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_owner_foreign` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_profile_foreign` FOREIGN KEY (`profile`) REFERENCES `profiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
