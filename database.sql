-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Лис 15 2017 р., 22:46
-- Версія сервера: 5.7.20-0ubuntu0.16.04.1
-- Версія PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `dev_vitech`
--

-- --------------------------------------------------------

--
-- Структура таблиці `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2017_11_14_121109_create_user_messages_table', 2),
(6, '2017_11_14_124910_create_user_message_table', 2),
(7, '2017_11_14_225653_create_files_table', 3);

-- --------------------------------------------------------

--
-- Структура таблиці `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Andrew', 'klebanandrew@gmail.com', '$2y$10$HdUenRKhCmM549pdU9JIcO/8VO1Uz1b/IKdbPuULJaon.oIW5X5.W', 'n4ZziiAOVRxWYItgROr6KGA1vKjWkyUik4QgjQNzQ3yu3qXSaMjIRprnbCZL', '2017-11-14 09:48:34', '2017-11-14 09:48:34'),
(2, 'Test', 'test@test.com', '$2y$10$HdUenRKhCmM549pdU9JIcO/8VO1Uz1b/IKdbPuULJaon.oIW5X5.W', 'slfJVL4aqMRcyxyzTZJfIsqNckkuue3CfrfSDLTsSVLdAtg6U5N86ul3vOm0', NULL, NULL),
(3, 'Test1', 'test1@test.com', '$2y$10$HdUenRKhCmM549pdU9JIcO/8VO1Uz1b/IKdbPuULJaon.oIW5X5.W', 'tMooQS3De2WLDbeBm4O7jIO6Va0C4TpxsgeMEobsV1WePGwjcOIfhVBepZDS', NULL, NULL),
(4, 'Test2', 'test2@test.com', '$2y$10$HdUenRKhCmM549pdU9JIcO/8VO1Uz1b/IKdbPuULJaon.oIW5X5.W', NULL, NULL, NULL),
(5, 'Test3', 'test3@test.com', '$2y$10$HdUenRKhCmM549pdU9JIcO/8VO1Uz1b/IKdbPuULJaon.oIW5X5.W', NULL, NULL, NULL),
(6, 'Test4', 'test4@test.com', '$2y$10$HdUenRKhCmM549pdU9JIcO/8VO1Uz1b/IKdbPuULJaon.oIW5X5.W', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `user_message`
--

CREATE TABLE `user_message` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `user_message`
--

INSERT INTO `user_message` (`message_id`, `user_id`) VALUES
(4, 2),
(4, 4),
(4, 5),
(5, 3),
(5, 4),
(6, 1),
(6, 5),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 3),
(14, 4),
(14, 6),
(15, 3),
(15, 5),
(16, 4);

-- --------------------------------------------------------

--
-- Структура таблиці `user_messages`
--

CREATE TABLE `user_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci,
  `is_draft` tinyint(4) NOT NULL DEFAULT '0',
  `text` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `user_messages`
--

INSERT INTO `user_messages` (`id`, `sender_id`, `subject`, `is_draft`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test', 0, 'test', '2017-11-14 15:00:04', '2017-11-14 15:00:04'),
(2, 1, 'Subject', 0, 'Text', '2017-11-14 15:03:32', '2017-11-14 15:03:32'),
(3, 1, 'Subject', 0, 'Text', '2017-11-14 15:03:58', '2017-11-14 15:03:58'),
(4, 1, 'Subject', 0, 'Text', '2017-11-14 15:04:59', '2017-11-14 15:04:59'),
(5, 1, 'asf', 0, 'asfsaf', '2017-11-14 15:05:49', '2017-11-14 15:05:49'),
(6, 1, 'Test 2', 0, 'Test 2', '2017-11-14 15:10:17', '2017-11-14 15:10:17'),
(7, 1, 'Subject', 0, 'ар', '2017-11-14 20:51:43', '2017-11-14 20:51:43'),
(8, 1, 'Subject', 0, 'івиваи', '2017-11-14 20:53:12', '2017-11-14 20:53:12'),
(9, 1, 'Subject', 0, 'івиваи', '2017-11-14 20:53:27', '2017-11-14 20:53:27'),
(10, 1, 'Subject', 0, 'івиваи', '2017-11-14 20:53:55', '2017-11-14 20:53:55'),
(11, 1, 'Subject', 0, 'sgsg', '2017-11-14 22:17:25', '2017-11-14 22:17:25'),
(12, 1, 'Subject', 0, 'sdgsg', '2017-11-14 22:18:44', '2017-11-14 22:18:44'),
(13, 1, 'Subject', 0, 'asfasf', '2017-11-14 22:20:00', '2017-11-14 22:20:00'),
(14, 1, 'sdgsdg', 0, 'asgdsg', '2017-11-14 22:33:12', '2017-11-14 22:33:12'),
(15, 1, 'fgmfgmf', 0, 'fnfgmgfm', '2017-11-14 22:34:07', '2017-11-14 22:34:07'),
(16, 1, 'sdgsdg', 0, 'sdhsdh', '2017-11-14 22:35:35', '2017-11-14 22:35:35');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `files_token_unique` (`token`);

--
-- Індекси таблиці `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Індекси таблиці `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблиці `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
