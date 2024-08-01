-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 29, 2024 at 10:23 PM
-- Server version: 8.0.30
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `midacollection`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `count` int NOT NULL,
  `size` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_07_18_000000_create_users_table', 1),
(2, '2024_07_18_105442_create_products_table', 1),
(3, '2024_07_18_044028_create_carts_table', 1),
(4, '2024_07_18_120401_create_orders_table', 1),
(5, '2024_07_18_060246_alter_users_table_change_columns_length', 1),
(6, '2024_07_18_063621_alter_products_table_change_columns_length', 2),
(7, '2024_07_18_071654_alter_orders_table_change_columns_length', 3),
(8, '2024_07_18_071956_alter_orders_table_change_columns_length', 4),
(9, '2024_07_18_073422_alter_carts_table_change_columns_length', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL,
  `price` int NOT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sold` int DEFAULT '0',
  `count` int NOT NULL,
  `size` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_pembayaran` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `stock`, `price`, `category`, `sold`, `count`, `size`, `status`, `image`, `payment`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
(7, 3, 'Laptop Maul', 1, 20000, 'Kasur', NULL, 1, '180 x 150 CM', 'Pending', '1722264438_Lapjik.jpg', NULL, '1722265004_Lapjik.jpg', '2024-07-29 07:56:44', '2024-07-29 07:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL,
  `price` int NOT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sold` int DEFAULT '0',
  `size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `stock`, `price`, `category`, `sold`, `size`, `image`, `created_at`, `updated_at`) VALUES
(2, 'TOTEBAG', 10, 15000, 'Souvenir', NULL, '30 x 55 CM', '1721481243_totebag2.jpg', '2024-07-20 05:36:48', '2024-07-21 02:08:48'),
(3, 'SARUNG TISU', 15, 10000, 'SarungCover', NULL, '10 x 20 CM', '1721481233_sarungtisu.jpg', '2024-07-20 05:38:10', '2024-07-21 02:09:49'),
(5, 'POUCH PERCA', 15, 20000, 'Souvenir', NULL, '10 x 20 CM', '1721481209_pouch2.jpg', '2024-07-20 05:41:07', '2024-07-21 02:09:42'),
(6, 'POUCH BIASA', 15, 20000, 'Souvenir', NULL, '10 x 20 CM', '1721481193_pouch3.jpg', '2024-07-20 05:45:13', '2024-07-21 02:08:32'),
(7, 'SARUNG GALON', 10, 45000, 'SarungCover', NULL, '45 x 80 CM', '1721481184_sarunggalon.jpg', '2024-07-20 05:50:13', '2024-07-21 02:08:26'),
(8, 'KASUR BAYI', 5, 125000, 'Kasur', NULL, '100 x 80 CM', '1721481175_kasurbayi.jpg', '2024-07-20 05:52:27', '2024-07-21 02:08:18'),
(9, 'SARUNG MEJA', 10, 55000, 'SarungCover', NULL, '120 x 60 CM', '1721481141_sarungmeja.jpg', '2024-07-20 05:54:32', '2024-07-21 02:08:12'),
(15, 'SARUNG KULKAS', 5, 55000, 'SarungCover', NULL, '100 x 80 CM', '1721537505_tutupkulkas.jpg', '2024-07-20 21:51:45', '2024-07-25 08:54:33'),
(30, 'Laptop Maul', 10, 20000, 'Kasur', NULL, '180 x 150 CM', '1722264438_Lapjik.jpg', '2024-07-29 07:35:17', '2024-07-29 10:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone_number`, `address`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$5WpJ7TWxMj8KVsR7E0hh1OyaWjcPn5a4jF1MI9XdciHHDShy5z86u', '08902109301', 'Tangerang', 'admin', 'tMBINNhDww0ax659CkfwEuaovqD5iFnFVwlCRhPIcSesPWvc8roYsP2J3iJJ', '2024-07-17 23:54:31', '2024-07-18 01:36:54'),
(3, 'user', 'user@gmail.com', NULL, '$2y$10$UPqaVl0KEB9CjA2QiszarOfHFkGuzJuyNOa5JYF1Uc9VziOzE9LA.', '085172538153', 'Jakarta', 'user', 'pA67pKrz72v8LDiwqk2IBVJttoG7g7qpxJEQyg8eyKSEbiF0Zz2yuzAPxM1x', '2024-07-18 01:53:24', '2024-07-29 04:17:23'),
(4, 'nabila', 'nabilatriaa@gmail.com', NULL, '$2y$10$vDboesp8GGCOfvW7Rg4wMOaM6t/JhBUIxn9xpg/hfqtkD75amOwaS', '089523751470', 'global living', 'user', NULL, '2024-07-20 05:30:52', '2024-07-20 05:30:52'),
(5, 'Suherti', 'hessty02@gmail.com', NULL, '$2y$10$7HnDZCdlUeFh60tvBZVs2OjxdLVzmYkAZUSBtlMAyw6MszpJe7EHS', '08989891637', 'Cibogo Wetan, Kelapa Dua Tangerang Banten 15812', 'user', NULL, '2024-07-20 21:12:32', '2024-07-20 21:12:32'),
(6, 'M. Robbyul Antsani Zulyansyah', 'byulimoetz@gmail.com', NULL, '$2y$10$jZli24/kH/Yi.0T7ja4zku2u5Ap.YhcQnejh/Yq9Rp3qxuIYIiwgC', '082111223445', 'Perumnas 4, No.10 Tangerang. Kode Pos, 15138', 'user', 'Wy9HrvsKT7god39cv16I8JJe5ouaV7iXISrp7OQ0jASlwUycjbeuSfgaYTCg', '2024-07-20 21:35:41', '2024-07-29 07:32:29'),
(7, 'Mohammad Radja Alyfa Amri', 'radja.amri28@gmail.com', NULL, '$2y$10$wMq9xhyRS5In7w/xmpId4.ge.6v/UBos2G0zPIEyVs8JFg427kW7G', '085710399735', 'Tangerang, Banten', 'user', '29r4dVZxQArzuFPsm5xs2ULO1iXdYy2BSor0fFBrsiEVwx47O6k7RW1SWpG8', '2024-07-25 08:49:11', '2024-07-29 09:40:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_products_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_products_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
