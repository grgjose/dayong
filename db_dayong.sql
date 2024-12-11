-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 04:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dayong`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_in` timestamp NULL DEFAULT NULL,
  `time_out` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `ext` varchar(255) DEFAULT NULL,
  `birthdate` timestamp NULL DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `contact_num` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `code`, `city`, `branch`, `address`, `description`, `created_at`, `updated_at`) VALUES
(1, '0001', 'METRO DAVAO', 'AGDAO', '-', '-', '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(2, '0002', 'METRO DAVAO', 'TIBUNGCO', '-', '-', '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(3, '0003', 'METRO DAVAO', 'BUHANGIN', '-', '-', '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(4, '0004', 'METRO DAVAO', 'MATINA', '-', '-', '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(5, '0005', 'METRO DAVAO', 'STA. CRUZ', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(6, '0006', 'METRO DAVAO', 'TORIL', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(7, '0007', 'METRO DAVAO', 'CALINAN', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(8, '0008', 'METRO DAVAO', 'MINTAL', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(9, '0009', 'METRO DAVAO', 'MARILOG', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(10, '0010', 'DAVAO DEL NORTE', 'TAGUM', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(11, '0011', 'DAVAO DEL NORTE', 'LA FILIPINA', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(12, '0012', 'DAVAO DE ORO', 'MACO', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(13, '0013', 'DAVAO DE ORO', 'MABINI', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(14, '0014', 'DAVAO DE ORO', 'PANTUKAN', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(15, '0015', 'DAVAO DE ORO', 'MARAGUSAN', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(16, '0016', 'DAVAO DE ORO', 'NABUNTURAN', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(17, '0017', 'DAVAO DE ORO', 'LUPON', '-', '-', '2024-06-16 18:11:58', '2024-06-16 18:11:58'),
(18, '0018', 'SURIGAO DEL SUR', 'HINATUAN', '-', '-', '2024-06-16 18:11:59', '2024-06-16 18:11:59'),
(19, '0019', 'SURIGAO DEL SUR', 'TAGBINA', '-', '-', '2024-06-16 18:11:59', '2024-06-16 18:11:59'),
(20, '0020', 'SURIGAO DEL SUR', 'BUTUAN', '-', '-', '2024-06-16 18:11:59', '2024-06-16 18:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `claimants`
--

CREATE TABLE `claimants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `ext` varchar(255) DEFAULT NULL,
  `birthdate` timestamp NULL DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `contact_num` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `marketting_agent` int(11) NOT NULL,
  `member_id` varchar(255) NOT NULL,
  `or_number` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `number_of_payment` int(11) NOT NULL,
  `program_id` varchar(255) NOT NULL,
  `month_from` varchar(255) DEFAULT NULL,
  `month_to` varchar(255) DEFAULT NULL,
  `is_reactivated` int(11) NOT NULL,
  `is_transferred` int(11) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `excel_entries`
--

CREATE TABLE `excel_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `marketting_agent` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `phmember` varchar(255) DEFAULT NULL,
  `or_number` varchar(255) DEFAULT NULL,
  `or_date` datetime DEFAULT NULL,
  `amount_collected` varchar(255) DEFAULT NULL,
  `month_of` varchar(255) DEFAULT NULL,
  `nop` varchar(255) DEFAULT NULL,
  `date_remitted` datetime DEFAULT NULL,
  `dayong_program` varchar(255) DEFAULT NULL,
  `reactivation` varchar(255) DEFAULT NULL,
  `transferred` varchar(255) DEFAULT NULL,
  `isImported` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `excel_members`
--

CREATE TABLE `excel_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `marketting_agent` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `phmember` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact_num` varchar(255) DEFAULT NULL,
  `type_of_transaction` varchar(255) DEFAULT NULL,
  `with_registration_fee` varchar(255) DEFAULT NULL,
  `registration_amount` varchar(255) DEFAULT NULL,
  `dayong_program` varchar(255) DEFAULT NULL,
  `application_no` varchar(255) DEFAULT NULL,
  `or_number` varchar(255) DEFAULT NULL,
  `or_date` datetime DEFAULT NULL,
  `amount_collected` varchar(255) DEFAULT NULL,
  `reactivation` varchar(255) DEFAULT NULL,
  `transferred` varchar(255) DEFAULT NULL,
  `name1` varchar(255) DEFAULT NULL,
  `age1` varchar(255) DEFAULT NULL,
  `relationship1` varchar(255) DEFAULT NULL,
  `name2` varchar(255) DEFAULT NULL,
  `age2` varchar(255) DEFAULT NULL,
  `relationship2` varchar(255) DEFAULT NULL,
  `name3` varchar(255) DEFAULT NULL,
  `age3` varchar(255) DEFAULT NULL,
  `relationship3` varchar(255) DEFAULT NULL,
  `name4` varchar(255) DEFAULT NULL,
  `age4` varchar(255) DEFAULT NULL,
  `relationship4` varchar(255) DEFAULT NULL,
  `isImported` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `ext` varchar(255) DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `citizenship` varchar(255) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `contact_num` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members_program`
--

CREATE TABLE `members_program` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_no` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `claimants_id` int(11) DEFAULT NULL,
  `beneficiaries_ids` varchar(255) DEFAULT NULL,
  `registration_fee` int(11) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_person_num` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(669, '2014_10_12_000000_create_users_table', 1),
(670, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(671, '2019_08_19_000000_create_failed_jobs_table', 1),
(672, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(673, '2023_10_26_210924_create_entries_table', 1),
(674, '2023_10_31_095644_create_programs_table', 1),
(675, '2023_10_31_095711_create_branches_table', 1),
(676, '2023_10_31_095742_create_members_table', 1),
(677, '2023_11_27_055621_create_members_program_table', 1),
(678, '2024_03_01_192210_create_or_management_table', 1),
(679, '2024_03_07_060235_create_attendance_table', 1),
(680, '2024_03_07_060446_create_beneficiaries_table', 1),
(681, '2024_05_04_173501_create_claimants_table', 1),
(682, '2024_05_30_174629_create_jobs_table', 1),
(683, '2024_06_12_221912_create_excel_entries_table', 1),
(684, '2024_06_12_221925_create_excel_members_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `or_management`
--

CREATE TABLE `or_management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `or_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `or_management`
--

INSERT INTO `or_management` (`id`, `branch_id`, `program_id`, `or_code`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'AGD180', '2024-06-16 18:11:59', '2024-06-16 18:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `with_beneficiaries` tinyint(1) NOT NULL,
  `age_min` int(11) DEFAULT NULL,
  `age_max` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `code`, `description`, `with_beneficiaries`, `age_min`, `age_max`, `created_at`, `updated_at`) VALUES
(1, 'D-180', 'Dayong Cash Assistance Programs', 0, NULL, NULL, '2024-06-16 18:11:55', '2024-06-16 18:11:55'),
(2, 'D-190', 'Dayong Cash Assistance Programs', 0, NULL, NULL, '2024-06-16 18:11:55', '2024-06-16 18:11:55'),
(3, 'D-290', 'Dayong Cash Assistance Programs', 0, NULL, NULL, '2024-06-16 18:11:55', '2024-06-16 18:11:55'),
(4, 'D-230', 'Dayong Cash Assistance Programs', 0, NULL, NULL, '2024-06-16 18:11:56', '2024-06-16 18:11:56'),
(5, 'D-300', 'Dayong Cash Assistance Programs', 0, NULL, NULL, '2024-06-16 18:11:56', '2024-06-16 18:11:56'),
(6, 'D-460', 'Dayong Cash Assistance Programs', 0, NULL, NULL, '2024-06-16 18:11:56', '2024-06-16 18:11:56'),
(7, 'D-350', 'Dayong Paid the Balance', 0, NULL, NULL, '2024-06-16 18:11:56', '2024-06-16 18:11:56'),
(8, 'D-420', 'Dayong Paid the Balance', 0, NULL, NULL, '2024-06-16 18:11:56', '2024-06-16 18:11:56'),
(9, 'D-410', 'Dayong Paid the Balance', 0, NULL, NULL, '2024-06-16 18:11:56', '2024-06-16 18:11:56'),
(10, 'M-150', 'Dayong Paid the Balance', 0, NULL, NULL, '2024-06-16 18:11:56', '2024-06-16 18:11:56'),
(11, 'M-250', 'Dayong Paid the Balance', 0, NULL, NULL, '2024-06-16 18:11:56', '2024-06-16 18:11:56'),
(12, 'DC-260', 'Dayong Citizen', 0, NULL, NULL, '2024-06-16 18:11:56', '2024-06-16 18:11:56'),
(13, 'DC-300', 'Dayong Citizen', 0, NULL, NULL, '2024-06-16 18:11:56', '2024-06-16 18:11:56'),
(14, 'DC-180', 'Dayong Citizen', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(15, 'D-179', 'Dayong Special Programs', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(16, 'D-290', 'Dayong Special Programs', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(17, 'D-390', 'Dayong Special Programs', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(18, 'D-270', 'Dayong Special Programs', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(19, 'D-370', 'Dayong Special Programs', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(20, 'D-320', 'Dayong Special Programs', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(21, 'D-185', 'Dayong Special Programs', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(22, 'DPP-650', 'Dayong Special Programs', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(23, 'D-550', 'Dayong Family Package', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(24, 'D-650', 'Dayong Family Package', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57'),
(25, 'D-480', 'Dayong Family Package', 0, NULL, NULL, '2024-06-16 18:11:57', '2024-06-16 18:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `usertype` int(11) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `birthdate` timestamp NULL DEFAULT NULL,
  `contact_num` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `usertype`, `fname`, `mname`, `lname`, `email`, `status`, `email_verified_at`, `birthdate`, `contact_num`, `profile_pic`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'grgjose', 1, 'George Louis', 'Martinez', 'Jose', 'georgelouisjose@gmail.com', 'active', '2024-06-16 18:11:54', '1999-04-15 16:00:00', '09363362225', '1.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BwSMRrf2Ij', '2024-06-16 18:11:54', '2024-06-16 18:11:54'),
(2, 'jeey', 1, 'Jeey', '', 'Bautista', 'jeey.bautista@gmail.com', 'active', '2024-06-16 18:11:55', NULL, NULL, 'default.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'oviKVdPgRe', '2024-06-16 18:11:55', '2024-06-16 18:11:55'),
(3, 'juliet', 1, 'Juliet', '', 'Martinez', 'juliet.martinez@gmail.com', 'active', '2024-06-16 18:11:55', NULL, NULL, 'default.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0oRj3etbcr', '2024-06-16 18:11:55', '2024-06-16 18:11:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claimants`
--
ALTER TABLE `claimants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `excel_entries`
--
ALTER TABLE `excel_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `excel_members`
--
ALTER TABLE `excel_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_program`
--
ALTER TABLE `members_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `or_management`
--
ALTER TABLE `or_management`
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
-- Indexes for table `programs`
--
ALTER TABLE `programs`
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
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `claimants`
--
ALTER TABLE `claimants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `excel_entries`
--
ALTER TABLE `excel_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `excel_members`
--
ALTER TABLE `excel_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members_program`
--
ALTER TABLE `members_program`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=685;

--
-- AUTO_INCREMENT for table `or_management`
--
ALTER TABLE `or_management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
