-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 05 2022 г., 00:36
-- Версия сервера: 10.2.38-MariaDB
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ziatker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `direction_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `download` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `comment_when_deleted` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comment_refusal_delete` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_deleted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`id`, `title`, `description`, `user_id`, `subject_id`, `direction_id`, `class_id`, `file_name`, `view`, `download`, `is_active`, `comment_when_deleted`, `deleted_at`, `created_at`, `updated_at`, `comment_refusal_delete`, `status_deleted`) VALUES
(1, 'Шамалар және олардың қасиеттері\" сабақ жоспары', 'әріптестеріме көмек', 2, 27, 9, '12', '1601793082.docx', 7, 6, 1, NULL, NULL, NULL, '2022-05-03 18:45:46', NULL, NULL),
(2, 'Professions', 'бұл материал ұстаздарға қажет болар деп ойлаймын', 3, 17, 19, '9', '1601797121.docx', 6, 8, 1, NULL, NULL, NULL, NULL, NULL, 2),
(3, 'Әлеуметтік мінез-құлық және оны реттеу ', ' Психология мамандығының студенттеріне арналған,Әлеуметтік мінез-құлық және оны реттеу', 3, 22, 8, '11', '1605174370.pptx', 8, 9, 1, NULL, NULL, NULL, NULL, NULL, 3),
(4, 'Family relationships 5 сынып', 'How coulddefinite answer. In the 18th, 19th and at the beginning of the 20th century people used to get married at the age of 18 or even 16', 3, 49, 16, '13', '1605174476.pdf', 34, 34, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Ашық сабақ. Аденозинүшфосфор қышқылының (АТФ) құры...', 'Материал биология пәні мұғалімдеріне қажет деп сан...', 4, 9, 25, '14', '1601793469.docx', 5, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Особенности русского романтизма', 'Учащимся 9-х классов, для понимания и разъяснения ', 5, 10, 11, '4', '1601789537.docx', 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Шамалар және олардың қасиеттері\" сабақ жоспары', 'әріптестеріме көмек', 6, 36, 13, '14', '1601793082.docx', 7, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Professions', 'бұл материал ұстаздарға қажет болар деп ойлаймын', 7, 41, 14, '3', '1601797121.docx', 6, 8, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Ашық сабақ. Аденозинүшфосфор қышқылының (АТФ) құры...', 'Материал биология пәні мұғалімдеріне қажет деп сан...', 8, 1, 24, '11', '1601793469.docx', 5, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Особенности русского романтизма', 'Учащимся 9-х классов, для понимания и разъяснения ', 9, 50, 4, '2', '1601789537.docx', 3, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Шамалар және олардың қасиеттері\" сабақ жоспары', 'әріптестеріме көмек', 10, 3, 15, '1', '1601793082.docx', 7, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Professions', 'бұл материал ұстаздарға қажет болар деп ойлаймын', 5, 12, 18, '8', '1601797121.docx', 6, 8, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Шамалар және олардың қасиеттері\" сабақ жоспары', 'әріптестеріме көмек', 12, 31, 20, '13', '1601793082.docx', 7, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `material_classes`
--

CREATE TABLE `material_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `material_classes`
--

INSERT INTO `material_classes` (`id`, `name`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Барлық сыныптар', 'barly-synyptar', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06'),
(2, 'Мектепке дейінгі балалар', 'mektepke-deyingi-balalar', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06'),
(3, '1 сынып', '1-synyp', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06'),
(4, '2 сынып', '2-synyp', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06'),
(5, '3 сынып', '3-synyp', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06'),
(6, '4 сынып', '4-synyp', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(7, '5 сынып', '5-synyp', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(8, '6 сынып', '6-synyp', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(9, '7 сынып', '7-synyp', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(10, '8 сынып', '8-synyp', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(11, '9 сынып', '9-synyp', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(12, '10 сынып', '10-synyp', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(13, '11 сынып', '11-synyp', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(14, '12 сынып', '12-synyp', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(15, 'Басқа', 'bas-a', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07');

-- --------------------------------------------------------

--
-- Структура таблицы `material_comments`
--

CREATE TABLE `material_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `material_comments`
--

INSERT INTO `material_comments` (`id`, `user_id`, `material_id`, `comment_id`, `text`, `created_at`, `updated_at`) VALUES
(1, 5, 1, NULL, 'Осы сайтқа тіркелгеніме өте қуаныштымын . Мұғалімд..', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(2, 8, 1, NULL, 'маған бұл сайыт ұнаты рахмет', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(3, 6, 1, NULL, 'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(4, 10, 1, NULL, 'Осы материалдар ұстаздарымызға көмегін тігізеді де...', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(5, 7, 2, NULL, 'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(6, 2, 2, NULL, 'маған бұл сайыт ұнаты рахмет', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(7, 4, 2, NULL, 'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(8, 1, 2, NULL, 'маған бұл сайыт ұнаты рахмет', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(9, 4, 3, NULL, 'Осы материалдар ұстаздарымызға көмегін тігізеді де...', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(10, 8, 3, NULL, 'Осы сайтқа тіркелгеніме өте қуаныштымын . Мұғалімд..', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(11, 4, 3, NULL, 'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(12, 9, 3, NULL, 'Осы материалдар ұстаздарымызға көмегін тігізеді де...', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(13, 5, 4, NULL, 'маған бұл сайыт ұнаты рахмет', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(14, 4, 4, NULL, 'Өте тамаша мақала', '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(15, 7, 4, NULL, 'Рахмет', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(16, 6, 4, NULL, 'Рахмет', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(17, 12, 5, NULL, 'Тамаша!', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(18, 8, 5, NULL, 'Маған  бұл   сайт    ұнады.  Жылдам   әрі    тегін', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(19, 9, 5, NULL, 'маған бұл сайыт ұнаты рахмет', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(20, 2, 5, NULL, 'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(21, 8, 6, NULL, 'Тамаша!', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(22, 12, 6, NULL, 'Тамаша!', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(23, 4, 6, NULL, 'Осы сайтқа тіркелгеніме өте қуаныштымын . Мұғалімд..', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(24, 7, 6, NULL, 'Маған  бұл   сайт    ұнады.  Жылдам   әрі    тегін', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(25, 11, 7, NULL, 'Рахмет', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(26, 3, 7, NULL, 'Рахмет', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(27, 7, 7, NULL, 'Тамаша!', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(28, 3, 7, NULL, 'Осы материалдар ұстаздарымызға көмегін тігізеді де...', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(29, 5, 8, NULL, 'Рахмет', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(30, 9, 8, NULL, 'Рахмет', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(31, 8, 8, NULL, 'маған бұл сайыт ұнаты рахмет', '2022-05-01 10:44:14', '2022-05-01 10:44:14'),
(32, 6, 8, NULL, 'маған бұл сайыт ұнаты рахмет', '2022-05-01 10:44:15', '2022-05-01 10:44:15'),
(33, 7, 9, NULL, 'Маған  бұл   сайт    ұнады.  Жылдам   әрі    тегін', '2022-05-01 10:44:15', '2022-05-01 10:44:15'),
(34, 3, 9, NULL, 'Рахмет', '2022-05-01 10:44:15', '2022-05-01 10:44:15'),
(35, 12, 9, NULL, 'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.', '2022-05-01 10:44:15', '2022-05-01 10:44:15'),
(36, 12, 9, NULL, 'Осы материалдар ұстаздарымызға көмегін тігізеді де...', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(37, 12, 10, NULL, 'Рахмет', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(38, 7, 10, NULL, 'Рахмет', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(39, 9, 10, NULL, 'Өте тамаша мақала', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(40, 1, 10, NULL, 'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(41, 6, 11, NULL, 'маған бұл сайыт ұнаты рахмет', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(42, 2, 11, NULL, 'Маған  бұл   сайт    ұнады.  Жылдам   әрі    тегін', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(43, 7, 11, NULL, 'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(44, 7, 11, NULL, 'Ұстаз  тілегі\"  Республикалық  ұстаздар  сайтының', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(45, 7, 12, NULL, 'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(46, 7, 12, NULL, 'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(47, 7, 12, NULL, 'Осы материалдар ұстаздарымызға көмегін тігізеді де...', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(48, 11, 12, NULL, 'маған бұл сайыт ұнаты рахмет', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(49, 10, 13, NULL, 'Ұстаз  тілегі\"  Республикалық  ұстаздар  сайтының', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(50, 11, 13, NULL, 'Рахмет', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(51, 2, 13, NULL, 'Өте тамаша мақала', '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(52, 6, 13, NULL, 'Тамаша!', '2022-05-01 10:44:16', '2022-05-01 10:44:16');

-- --------------------------------------------------------

--
-- Структура таблицы `material_directions`
--

CREATE TABLE `material_directions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `material_directions`
--

INSERT INTO `material_directions` (`id`, `name`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Барлық материалдар', 'barly-materialdar', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(2, 'Мақала', 'ma-ala', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(3, 'Ашық сабақ', 'ashy-saba', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(4, 'Презентация', 'prezentaciya', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(5, 'Сабақ жоспары', 'saba-zhospary', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(6, 'Тест', 'test', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(7, 'Тәрбие сағаты', 't-rbie-sa-aty', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(8, 'Семинарлар', 'seminarlar', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(9, 'Конспект', 'konspekt', NULL, '2022-05-01 10:44:07', '2022-05-01 10:44:07'),
(10, 'Ғылыми жұмыстар', 'ylymi-zh-mystar', NULL, '2022-05-01 10:44:08', '2022-05-01 10:44:08'),
(11, 'Ойындар, Сценарийлер', 'oyyndar-scenariyler', NULL, '2022-05-01 10:44:08', '2022-05-01 10:44:08'),
(12, 'Тәлімгерлерге', 't-limgerlerge', NULL, '2022-05-01 10:44:08', '2022-05-01 10:44:08'),
(13, 'Тренерлерге', 'trenerlerge', NULL, '2022-05-01 10:44:08', '2022-05-01 10:44:08'),
(14, 'Эссе, шығарма, мазмұндама', 'esse-shy-arma-mazm-ndama', NULL, '2022-05-01 10:44:08', '2022-05-01 10:44:08'),
(15, 'Өлең, ертегі, әңгімелер', 'le-ertegi-gimeler', NULL, '2022-05-01 10:44:08', '2022-05-01 10:44:08'),
(16, 'Ақын жазушылар, ұлағатты сөздер', 'a-yn-zhazushylar-la-atty-s-zder', NULL, '2022-05-01 10:44:08', '2022-05-01 10:44:08'),
(17, 'Жұмбақтар, жаңылтпаштар, әзілдер', 'zh-mba-tar-zha-yltpashtar-zilder', NULL, '2022-05-01 10:44:08', '2022-05-01 10:44:08'),
(18, 'Көрнекілік', 'k-rnekilik', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(19, 'Портфолио', 'portfolio', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(20, 'Коучинг жоспары', 'kouching-zhospary', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(21, 'Сыныптан тыс жұмыс', 'synyptan-tys-zh-mys', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(22, 'Оқушылар жұмысы', 'o-ushylar-zh-mysy', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(23, 'Авторлық бағдарлама', 'avtorly-ba-darlama', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(24, 'Оқу жылы', 'o-u-zhyly', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(25, 'Ата-аналармен жұмыс', 'ata-analarmen-zh-mys', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(26, 'Баяндамалар, реферат', 'bayandamalar-referat', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(27, 'Басқа', 'bas-a', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09');

-- --------------------------------------------------------

--
-- Структура таблицы `material_subjects`
--

CREATE TABLE `material_subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `material_subjects`
--

INSERT INTO `material_subjects` (`id`, `name`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Барлық пәндер', 'barly-p-nder', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(2, 'Адам және қоғам', 'adam-zh-ne-o-am', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(3, 'Алғашқы әскери дайындық', 'al-ash-y-skeri-dayyndy', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(4, 'Алгебра', 'algebra', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(5, 'Астрономия', 'astronomiya', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(6, 'Аттестаттау материалдары', 'attestattau-materialdary', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(7, 'Əлеуметтік педагог', 'eleumettik-pedagog', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(8, 'Әлеуметтану', 'leumettanu', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(9, 'Әдістемелік бірлестік жетекшілері', 'distemelik-birlestik-zhetekshileri', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(10, 'Балабақша', 'balaba-sha', NULL, '2022-05-01 10:44:09', '2022-05-01 10:44:09'),
(11, 'Бастауыш сынып', 'bastauysh-synyp', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(12, 'Биология', 'biologiya', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(13, 'География', 'geografiya', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(14, 'Геометрия', 'geometriya', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(15, 'Директорға', 'direktor-a', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(16, 'Дене шынықтыру', 'dene-shyny-tyru', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(17, 'Дінтану', 'dintanu', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(18, 'Жаңартылған бағдарлама', 'zha-artyl-an-ba-darlama', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(19, 'Жаратылыстану', 'zharatylystanu', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(20, 'Завучтарға', 'zavuchtar-a', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(21, 'Информатика', 'informatika', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(22, 'Кітапханашылар', 'kitaphanashylar', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(23, 'Коррекциялық мектеп', 'korrekciyaly-mektep', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(24, 'Қазақ тілі', 'aza-tili', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(25, 'Қазақ әдебиеті', 'aza-debieti', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(26, 'Қаржылық сауаттылық пәні', 'arzhyly-sauattyly-p-ni', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(27, 'Құқық негіздері', 'y-negizderi', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(28, 'Қосымша білім беру', 'osymsha-bilim-beru', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(29, 'Логопед, дефектолог', 'logoped-defektolog', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(30, 'Математика', 'matematika', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(31, 'Мәдениеттану', 'm-deniettanu', NULL, '2022-05-01 10:44:10', '2022-05-01 10:44:10'),
(32, 'Мектепалды даярлық', 'mektepaldy-dayarly', NULL, '2022-05-01 10:44:11', '2022-05-01 10:44:11'),
(33, 'Музыка', 'muzyka', NULL, '2022-05-01 10:44:11', '2022-05-01 10:44:11'),
(34, 'Мектеп әкімшілігі', 'mektep-kimshiligi', NULL, '2022-05-01 10:44:11', '2022-05-01 10:44:11'),
(35, 'Мектептен тыс мекемелер', 'mektepten-tys-mekemeler', NULL, '2022-05-01 10:44:11', '2022-05-01 10:44:11'),
(36, 'Өзін-өзі тану', 'zin-zi-tanu', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(37, 'Психология', 'psihologiya', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(38, 'Русский язык', 'russkiy-yazyk', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(39, 'Русская литература', 'russkaya-literatura', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(40, 'Сынып жетекші', 'synyp-zhetekshi', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(41, 'Сызу', 'syzu', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(42, 'Сурет', 'suret', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(43, 'Дүние жүзі тарихы', 'd-nie-zh-zi-tarihy', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(44, 'Қазақстан тарихы', 'aza-stan-tarihy', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(45, 'Оқу ісінің меңгерушісі', 'o-u-isini-me-gerushisi', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(46, 'Технология', 'tehnologiya', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(47, 'Тіршілік қауіпсіздігінің негіздері', 'tirshilik-auipsizdigini-negizderi', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(48, 'Физика', 'fizika', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(49, 'Философия', 'filosofiya', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(50, 'Химия', 'himiya', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(51, 'Шағын орталық', 'sha-yn-ortaly', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(52, 'Шет тілі', 'shet-tili', NULL, '2022-05-01 10:44:12', '2022-05-01 10:44:12'),
(53, 'Неміс тілі', 'nemis-tili', NULL, '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(54, 'Экономика', 'ekonomika', NULL, '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(55, 'Экология', 'ekologiya', NULL, '2022-05-01 10:44:13', '2022-05-01 10:44:13'),
(56, 'Басқа', 'bas-a', NULL, '2022-05-01 10:44:13', '2022-05-01 10:44:13');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_095341_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2022_04_12_192925_create_news_types_table', 1),
(10, '2022_04_12_192927_create_news_table', 1),
(11, '2022_04_12_193332_create_material_subjects_table', 1),
(12, '2022_04_12_193333_create_material_directions_table', 1),
(13, '2022_04_12_193334_create_material_classes_table', 1),
(14, '2022_04_12_193351_create_materials_table', 1),
(15, '2022_04_12_193427_create_subscriptions_table', 1),
(16, '2022_04_12_193453_create_user_subscription_table', 1),
(17, '2022_04_12_193828_create_sms_verifications_table', 1),
(18, '2022_04_12_194015_create_personal_advice_table', 1),
(19, '2022_04_12_194038_create_personal_advice_orders_table', 1),
(20, '2022_04_12_194109_create_news_comments_table', 1),
(21, '2022_04_13_182302_create_material_comments_table', 1),
(22, '2022_04_13_183528_create_user_news_saveds_table', 1),
(23, '2022_04_13_183923_create_news_comment_likes_table', 1),
(24, '2022_04_28_204432_create_order_update_materials_table', 1),
(25, '2022_04_28_204437_create_sending_material_journals_table', 1),
(26, '2022_05_02_032019_add_token_to_users_table', 2),
(27, '2022_05_03_232414_add_reason_when_deleting_to_materials_table', 3),
(28, '2022_05_04_005735_add_cols_to_subscriptions_table', 4),
(29, '2022_05_04_013115_add_col_to_subscriptions_table', 5),
(30, '2022_05_04_015230_add_cols_to_personal_advices_table', 6),
(31, '2022_05_04_015447_add_col_to_personal_advices_table', 7),
(32, '2022_05_04_023732_add_cols_to_personal_advice_orders_table', 8),
(33, '2022_05_04_194308_create_promo_codes_table', 9),
(34, '2022_05_04_195405_add_cols_to_promo_codes_table', 10),
(35, '2022_05_04_200219_add_col_to_promo_codes_table', 11),
(36, '2022_05_04_201048_add_col_to_promo_codes_table', 12),
(37, '2022_05_05_003547_create_user_subscriptions_table', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '{"kk":"","ru":""}',
  `view` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `news_types_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `short_description`, `description`, `image`, `view`, `user_id`, `news_types_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ru\":\"\\u0412 \\u041a\\u0430\\u0437\\u0430\\u0445\\u0441\\u0442\\u0430\\u043d\\u0435 \\u0441\\u0442\\u0430\\u0440\\u0442\\u043e\\u0432\\u0430\\u043b \\u043f\\u0440\\u0438\\u0435\\u043c \\u0437\\u0430\\u044f\\u0432\\u043b\\u0435\\u043d\\u0438\\u0439 \\u043d\\u0430 \\u043e\\u0441\\u043d\\u043e\\u0432\\u043d\\u043e\\u0435 \\u0415\\u041d\\u0422-2022\",\"kk\":\"\\u049a\\u0430\\u0437\\u0430\\u049b\\u0441\\u0442\\u0430\\u043d\\u0434\\u0430 2022 \\u0436\\u044b\\u043b\\u0493\\u044b \\u043d\\u0435\\u0433\\u0456\\u0437\\u0433\\u0456 \\u04b0\\u0411\\u0422-\\u0493\\u0430 \\u04e9\\u0442\\u0456\\u043d\\u0456\\u0448\\u0442\\u0435\\u0440 \\u049b\\u0430\\u0431\\u044b\\u043b\\u0434\\u0430\\u0443 \\u0431\\u0430\\u0441\\u0442\\u0430\\u043b\\u0434\\u044b\"}', '{\"ru\":\"\\u041a\\u043e\\u043b\\u0438\\u0447\\u0435\\u0441\\u0442\\u0432\\u043e \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u043e\\u0432 \\u043e\\u0441\\u0442\\u0430\\u0435\\u0442\\u0441\\u044f \\u043f\\u0440\\u0435\\u0436\\u043d\\u0438\\u043c \\u2013 \\u0442\\u0440\\u0438 \\u043e\\u0431\\u044f\\u0437\\u0430\\u0442\\u0435\\u043b\\u044c\\u043d\\u044b\\u0445 \\u0438 \\u0434\\u0432\\u0430 \\u043d\\u0430 \\u0432\\u044b\\u0431\\u043e\\u0440. \\u0427\\u0438\\u0441\\u043b\\u043e \\u0442\\u0435\\u0441\\u0442\\u043e\\u0432\\u044b\\u0445 \\u0437\\u0430\\u0434\\u0430\\u043d\\u0438\\u0439 \\u2013 120. \\u0418\\u0437 \\u043d\\u0438\\u0445 \\u043f\\u043e \\u0438\\u0441\\u0442\\u043e\\u0440\\u0438\\u0438 \\u041a\\u0430\\u0437\\u0430\\u0445\\u0441\\u0442\\u0430\\u043d\\u0430 \\u2013 15, \\u043f\\u043e \\u043c\\u0430\\u0442\\u0435\\u043c\\u0430\\u0442\\u0438\\u0447\\u0435\\u0441\\u043a\\u043e\\u0439 \\u0433\\u0440\\u0430\\u043c\\u043e\\u0442\\u043d\\u043e\\u0441\\u0442\\u0438 \\u2013 15, \\u043f\\u043e \\u0433\\u0440\\u0430\\u043c\\u043e\\u0442\\u043d\\u043e\\u0441\\u0442\\u0438 \\u0447\\u0442\\u0435\\u043d\\u0438\\u044f \\u2013 20 \\u0438 \\u043f\\u043e 35 \\u0437\\u0430\\u0434\\u0430\\u043d\\u0438\\u0439 \\u043f\\u043e \\u0434\\u0432\\u0443\\u043c \\u043f\\u0440\\u043e\\u0444\\u0438\\u043b\\u044c\\u043d\\u044b\\u043c \\u043f\\u0440\\u0435\\u0434\\u043c\\u0435\\u0442\\u0430\\u043c. \\u041c\\u0430\\u043a\\u0441\\u0438\\u043c\\u0430\\u043b\\u044c\\u043d\\u043e\\u0435 \\u043a\\u043e\\u043b\\u0438\\u0447\\u0435\\u0441\\u0442\\u0432\\u043e \\u0431\\u0430\\u043b\\u043b\\u043e\\u0432 \\u2013 140.\",\"kk\":\"\\u041f\\u04d9\\u043d\\u0434\\u0435\\u0440\\u0434\\u0456\\u04a3 \\u0441\\u0430\\u043d\\u044b \\u04e9\\u0437\\u0433\\u0435\\u0440\\u0456\\u0441\\u0441\\u0456\\u0437 \\u049b\\u0430\\u043b\\u0430\\u0434\\u044b-\\u04af\\u0448 \\u043c\\u0456\\u043d\\u0434\\u0435\\u0442\\u0442\\u0456 \\u0436\\u04d9\\u043d\\u0435 \\u0435\\u043a\\u0435\\u0443\\u0456 \\u0442\\u0430\\u04a3\\u0434\\u0430\\u0443 \\u043a\\u0435\\u0440\\u0435\\u043a. \\u0422\\u0435\\u0441\\u0442 \\u0442\\u0430\\u043f\\u0441\\u044b\\u0440\\u043c\\u0430\\u043b\\u0430\\u0440\\u044b\\u043d\\u044b\\u04a3 \\u0441\\u0430\\u043d\\u044b-120. \\u041e\\u043d\\u044b\\u04a3 \\u0456\\u0448\\u0456\\u043d\\u0434\\u0435 \\u049a\\u0430\\u0437\\u0430\\u049b\\u0441\\u0442\\u0430\\u043d \\u0442\\u0430\\u0440\\u0438\\u0445\\u044b \\u0431\\u043e\\u0439\\u044b\\u043d\\u0448\\u0430 \\u2013 15, \\u043c\\u0430\\u0442\\u0435\\u043c\\u0430\\u0442\\u0438\\u043a\\u0430\\u043b\\u044b\\u049b \\u0441\\u0430\\u0443\\u0430\\u0442\\u0442\\u044b\\u043b\\u044b\\u049b \\u0431\\u043e\\u0439\\u044b\\u043d\\u0448\\u0430 \\u2013 15, \\u043e\\u049b\\u0443 \\u0441\\u0430\\u0443\\u0430\\u0442\\u0442\\u044b\\u043b\\u044b\\u0493\\u044b \\u0431\\u043e\\u0439\\u044b\\u043d\\u0448\\u0430 \\u2013 20 \\u0436\\u04d9\\u043d\\u0435 \\u0435\\u043a\\u0456 \\u0431\\u0435\\u0439\\u0456\\u043d\\u0434\\u0456 \\u043f\\u04d9\\u043d \\u0431\\u043e\\u0439\\u044b\\u043d\\u0448\\u0430 35 \\u0442\\u0430\\u043f\\u0441\\u044b\\u0440\\u043c\\u0430. \\u0415\\u04a3 \\u0436\\u043e\\u0493\\u0430\\u0440\\u0493\\u044b \\u04b1\\u043f\\u0430\\u0439 \\u0441\\u0430\\u043d\\u044b \\u2013 140.\"}', '{\"ru\":\"\\u041a\\u0430\\u043a \\u043e\\u0442\\u043c\\u0435\\u0442\\u0438\\u043b\\u0438 \\u0432 \\u041c\\u041e\\u041d \\u0420\\u041a, \\u0434\\u043b\\u044f \\u0441\\u043e\\u0431\\u043b\\u044e\\u0434\\u0435\\u043d\\u0438\\u044f \\u0430\\u043a\\u0430\\u0434\\u0435\\u043c\\u0438\\u0447\\u0435\\u0441\\u043a\\u043e\\u0439 \\u0447\\u0435\\u0441\\u0442\\u043d\\u043e\\u0441\\u0442\\u0438 \\u0442\\u0435\\u0441\\u0442\\u043e\\u0432\\u044b\\u0439 \\u0432\\u0430\\u0440\\u0438\\u0430\\u043d\\u0442 \\u0430\\u0431\\u0438\\u0442\\u0443\\u0440\\u0438\\u0435\\u043d\\u0442\\u043e\\u0432 \\u0431\\u0443\\u0434\\u0435\\u0442 \\u043f\\u0440\\u043e\\u043c\\u0430\\u0440\\u043a\\u0438\\u0440\\u043e\\u0432\\u0430\\u043d. \\u0422\\u043e \\u0435\\u0441\\u0442\\u044c \\u0443 \\u043a\\u0430\\u0436\\u0434\\u043e\\u0433\\u043e \\u0443\\u0447\\u0430\\u0441\\u0442\\u043d\\u0438\\u043a\\u0430 \\u0415\\u041d\\u0422 \\u0431\\u0443\\u0434\\u0435\\u0442 \\u0441\\u0432\\u043e\\u0439 \\u043b\\u0438\\u0447\\u043d\\u044b\\u0439 \\u0432\\u0430\\u0440\\u0438\\u0430\\u043d\\u0442 \\u0442\\u0435\\u0441\\u0442\\u043e\\u0432. \\u0412 \\u0441\\u043b\\u0443\\u0447\\u0430\\u0435 \\u043d\\u0430\\u0440\\u0443\\u0448\\u0435\\u043d\\u0438\\u044f \\u043f\\u0440\\u0430\\u0432\\u0438\\u043b \\u0438 \\u043f\\u043e\\u043f\\u044b\\u0442\\u043a\\u0435 \\u0432\\u044b\\u043d\\u043e\\u0441\\u0430 \\u0442\\u0435\\u0441\\u0442\\u043e\\u0432\\u044b\\u0445 \\u0437\\u0430\\u0434\\u0430\\u043d\\u0438\\u0439 \\u0437\\u0430 \\u043f\\u0440\\u0435\\u0434\\u0435\\u043b\\u044b \\u0430\\u0443\\u0434\\u0438\\u0442\\u043e\\u0440\\u0438\\u0438 \\u041d\\u0430\\u0446\\u0438\\u043e\\u043d\\u0430\\u043b\\u044c\\u043d\\u044b\\u0439 \\u0446\\u0435\\u043d\\u0442\\u0440 \\u0442\\u0435\\u0441\\u0442\\u0438\\u0440\\u043e\\u0432\\u0430\\u043d\\u0438\\u044f \\u0441\\u043c\\u043e\\u0436\\u0435\\u0442 \\u043e\\u043f\\u0440\\u0435\\u0434\\u0435\\u043b\\u0438\\u0442\\u044c \\u043d\\u0430\\u0440\\u0443\\u0448\\u0438\\u0442\\u0435\\u043b\\u044f, \\u0440\\u0435\\u0437\\u0443\\u043b\\u044c\\u0442\\u0430\\u0442\\u044b \\u043a\\u043e\\u0442\\u043e\\u0440\\u043e\\u0433\\u043e \\u0431\\u0443\\u0434\\u0443\\u0442 \\u0430\\u043d\\u043d\\u0443\\u043b\\u0438\\u0440\\u043e\\u0432\\u0430\\u043d\\u044b.\",\"kk\":\"\\u049a\\u0420 \\u0411\\u0492\\u041c \\u0430\\u0442\\u0430\\u043f \\u04e9\\u0442\\u043a\\u0435\\u043d\\u0434\\u0435\\u0439, \\u0430\\u043a\\u0430\\u0434\\u0435\\u043c\\u0438\\u044f\\u043b\\u044b\\u049b \\u0430\\u0434\\u0430\\u043b\\u0434\\u044b\\u049b\\u0442\\u044b \\u0441\\u0430\\u049b\\u0442\\u0430\\u0443 \\u04af\\u0448\\u0456\\u043d \\u0442\\u0430\\u043b\\u0430\\u043f\\u043a\\u0435\\u0440\\u043b\\u0435\\u0440\\u0434\\u0456\\u04a3 \\u0442\\u0435\\u0441\\u0442\\u0442\\u0456\\u043a \\u043d\\u04b1\\u0441\\u049b\\u0430\\u0441\\u044b \\u0442\\u0430\\u04a3\\u0431\\u0430\\u043b\\u0430\\u043d\\u0430\\u0442\\u044b\\u043d \\u0431\\u043e\\u043b\\u0430\\u0434\\u044b. \\u042f\\u0493\\u043d\\u0438, \\u04b0\\u0411\\u0422-\\u043d\\u044b\\u04a3 \\u04d9\\u0440\\u0431\\u0456\\u0440 \\u049b\\u0430\\u0442\\u044b\\u0441\\u0443\\u0448\\u044b\\u0441\\u044b\\u043d\\u044b\\u04a3 \\u0436\\u0435\\u043a\\u0435 \\u0442\\u0435\\u0441\\u0442 \\u043d\\u04b1\\u0441\\u049b\\u0430\\u0441\\u044b \\u0431\\u043e\\u043b\\u0430\\u0434\\u044b. \\u0415\\u0440\\u0435\\u0436\\u0435\\u043b\\u0435\\u0440\\u0434\\u0456 \\u0431\\u04b1\\u0437\\u0493\\u0430\\u043d \\u0436\\u04d9\\u043d\\u0435 \\u0442\\u0435\\u0441\\u0442 \\u0442\\u0430\\u043f\\u0441\\u044b\\u0440\\u043c\\u0430\\u043b\\u0430\\u0440\\u044b\\u043d \\u0430\\u0443\\u0434\\u0438\\u0442\\u043e\\u0440\\u0438\\u044f\\u0434\\u0430\\u043d \\u0442\\u044b\\u0441 \\u0448\\u044b\\u0493\\u0430\\u0440\\u0443\\u0493\\u0430 \\u0442\\u044b\\u0440\\u044b\\u0441\\u049b\\u0430\\u043d \\u0436\\u0430\\u0493\\u0434\\u0430\\u0439\\u0434\\u0430 \\u04b0\\u043b\\u0442\\u0442\\u044b\\u049b \\u0442\\u0435\\u0441\\u0442\\u0456\\u043b\\u0435\\u0443 \\u043e\\u0440\\u0442\\u0430\\u043b\\u044b\\u0493\\u044b \\u0431\\u04b1\\u0437\\u0443\\u0448\\u044b\\u043d\\u044b \\u0430\\u043d\\u044b\\u049b\\u0442\\u0430\\u0439 \\u0430\\u043b\\u0430\\u0434\\u044b, \\u043e\\u043d\\u044b\\u04a3 \\u043d\\u04d9\\u0442\\u0438\\u0436\\u0435\\u043b\\u0435\\u0440\\u0456 \\u0436\\u043e\\u0439\\u044b\\u043b\\u0430\\u0434\\u044b.\"}', '{\"ru\":\"1651407985_bBZK8.png\",\"kk\":\"1651407985_TrwLb.png\"}', 54597, 11, 1, NULL, '2022-05-01 10:44:18', '2022-05-04 20:10:41'),
(2, '{\"kk\":\"kk\",\"ru\":\"ru\"}', '{\"kk\":\"<p>ss<\\/p>\",\"ru\":\"<p>ru<\\/p>\"}', '{\"kk\":\"<p>shortkk<\\/p>\",\"ru\":\"<p>short ru<\\/p>\"}', '{\"kk\":\"\",\"ru\":\"\"}', 0, 11, 2, NULL, '2022-05-04 18:10:31', '2022-05-04 18:10:31');

-- --------------------------------------------------------

--
-- Структура таблицы `news_comments`
--

CREATE TABLE `news_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `likes_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news_comments`
--

INSERT INTO `news_comments` (`id`, `user_id`, `news_id`, `text`, `parent_id`, `likes_count`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Рахмет', NULL, 0, '2022-05-01 10:44:18', '2022-05-01 10:44:18'),
(2, 2, 1, 'Рахмет', NULL, 0, '2022-05-01 10:44:18', '2022-05-01 10:44:18'),
(3, 8, 1, 'маған бұл сайыт ұнаты рахмет', NULL, 0, '2022-05-01 10:44:18', '2022-05-01 10:44:18'),
(4, 2, 1, 'На лимузине в McDonalds или куда делись миллионы одного из самых богатых бизнесменов Америки? ', NULL, 0, '2022-05-01 10:44:18', '2022-05-01 10:44:18');

-- --------------------------------------------------------

--
-- Структура таблицы `news_comment_likes`
--

CREATE TABLE `news_comment_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_comment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `news_types`
--

CREATE TABLE `news_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news_types`
--

INSERT INTO `news_types` (`id`, `name`, `is_main`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"ru\":\"\\u0411\\u0438\\u0437\\u043d\\u0435\\u0441s\",\"kk\":\"\\u0411\\u0438\\u0437\\u043d\\u0435\\u0441\"}', 1, NULL, '2022-05-01 10:44:16', '2022-05-01 13:12:06'),
(2, '{\"ru\":\"\\u041f\\u043e\\u043b\\u0438\\u0442\\u0438\\u0447\\u0435\\u0441\\u043a\\u0438\\u0435\",\"kk\":\"\\u0421\\u0430\\u044f\\u0441\\u0438\"}', 0, NULL, '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(3, '{\"ru\":\"\\u041a\\u0440\\u0438\\u043c\\u0438\\u043d\\u0430\\u043b\\u044c\\u043d\\u044b\\u0435\",\"kk\":\"\\u041a\\u0440\\u0438\\u043c\\u0438\\u043d\\u0430\\u043b\\u044c\\u043d\\u044b\\u0435\"}', 0, NULL, '2022-05-01 10:44:16', '2022-05-01 10:44:16'),
(4, '{\"ru\":\"\\u041a\\u0443\\u043b\\u044c\\u0442\\u0443\\u0440\\u043d\\u044b\\u0435\",\"kk\":\"\\u041c\\u04d9\\u0434\\u0435\\u043d\\u0438\"}', 0, NULL, '2022-05-01 10:44:17', '2022-05-01 10:44:17'),
(5, '{\"ru\":\"\\u0421\\u043f\\u043e\\u0440\\u0442\\u0438\\u0432\\u043d\\u044b\\u0435\",\"kk\":\"\\u0421\\u043f\\u043e\\u0440\\u0442\\u0442\\u044b\\u049b\"}', 1, NULL, '2022-05-01 10:44:17', '2022-05-01 10:44:17'),
(6, '{\"ru\":\"\\u041c\\u0443\\u0437\\u044b\\u043a\\u0430\\u043b\\u044c\\u043d\\u044b\\u0435\",\"kk\":\"\\u041c\\u0443\\u0437\\u044b\\u043a\\u0430\\u043b\\u044b\\u049b\"}', 1, NULL, '2022-05-01 10:44:17', '2022-05-01 10:44:17'),
(7, '{\"ru\":\"\\u0421\\u043e\\u0446\\u0438\\u0430\\u043b\\u044c\\u043d\\u044b\\u0435\",\"kk\":\"\\u04d8\\u043b\\u0435\\u0443\\u043c\\u0435\\u0442\\u0442\\u0456\\u043a\"}', 1, NULL, '2022-05-01 10:44:17', '2022-05-01 10:44:17');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('658d6c996e996a321a6afdd72732557bde17ba2bca4a51965defe494dc67a052d6144b72713b3f07', 11, 1, 'Laravel', '[]', 0, '2022-05-01 21:04:35', '2022-05-01 21:04:35', '2023-05-02 03:04:35');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'Pf5rtp3ynzN66MW5Bw96XwYl8tbnaj9eXRcsedSU', NULL, 'http://localhost', 1, 0, 0, '2022-05-01 21:04:30', '2022-05-01 21:04:30'),
(2, NULL, 'Laravel Password Grant Client', 'ygzpzKBdRtdnLlnxzCo0vpTedaGlGlrwBnmHvnlH', 'users', 'http://localhost', 0, 1, 0, '2022-05-01 21:04:30', '2022-05-01 21:04:30'),
(3, NULL, 'Laravel Personal Access Client', '7bG25F0KLYACxJBWtvQxMUajIvPoVvuhPAhoNsUR', NULL, 'http://localhost', 1, 0, 0, '2022-05-01 21:46:56', '2022-05-01 21:46:56'),
(4, NULL, 'Laravel Password Grant Client', 'z0CIB60sUfdUVGOudAGjl05sbfxY618jq8H7U3y9', 'users', 'http://localhost', 0, 1, 0, '2022-05-01 21:46:56', '2022-05-01 21:46:56'),
(5, NULL, 'Laravel Personal Access Client', 'EUccmEl9kjVxp0Bm36eM8TI5uP4nN5vjAZsvWrFl', NULL, 'http://localhost', 1, 0, 0, '2022-05-04 21:01:47', '2022-05-04 21:01:47'),
(6, NULL, 'Laravel Password Grant Client', 'AX8QXqA7OmUFAx013xtxo4sFSsG2Qawm75ok9y1k', 'users', 'http://localhost', 0, 1, 0, '2022-05-04 21:01:48', '2022-05-04 21:01:48');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-05-01 21:04:30', '2022-05-01 21:04:30'),
(2, 3, '2022-05-01 21:46:56', '2022-05-01 21:46:56'),
(3, 5, '2022-05-04 21:01:48', '2022-05-04 21:01:48');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_update_materials`
--

CREATE TABLE `order_update_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `direction_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_advice`
--

CREATE TABLE `personal_advice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `is_discount` tinyint(1) NOT NULL DEFAULT 0,
  `discount_percentage` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `personal_advice`
--

INSERT INTO `personal_advice` (`id`, `created_at`, `updated_at`, `title`, `price`, `is_discount`, `discount_percentage`, `deleted_at`, `is_active`) VALUES
(1, '2022-05-03 20:17:27', '2022-05-03 20:17:27', '{\"ru\":\"\\u0423\\u0447\\u0438\\u043c\\u0441\\u044f \\u0441\\u043e\\u0437\\u0434\\u0430\\u0432\\u0430\\u0442\\u044c \\u0430\\u0432\\u0442\\u043e\\u0440\\u0441\\u043a\\u0443\\u044e \\u043f\\u0440\\u043e\\u0433\\u0440\\u0430\\u043c\\u043c\\u0443\",\"kk\":\"\\u0410\\u0432\\u0442\\u043e\\u0440\\u043b\\u044b\\u049b \\u0431\\u0430\\u0493\\u0434\\u0430\\u0440\\u043b\\u0430\\u043c\\u0430 \\u0436\\u0430\\u0441\\u0430\\u0443\\u0434\\u044b \\u04af\\u0439\\u0440\\u0435\\u043d\\u0443\"}', 8000, 0, NULL, NULL, NULL),
(2, '2022-05-03 20:17:28', '2022-05-03 20:29:43', '{\"ru\":\"\\u041f\\u0435\\u0434\\u0430\\u0433\\u043e\\u0433\\u0438\\u0447\\u0435\\u0441\\u043a\\u043e\\u0435 \\u0430\\u0439\\u043a\\u0438\\u0434\\u043e\",\"kk\":\"\\u041f\\u0435\\u0434\\u0430\\u0433\\u043e\\u0433\\u0438\\u043a\\u0430\\u043b\\u044b\\u049b \\u0430\\u0439\\u043a\\u0438\\u0434\\u043e\"}', 10000, 1, 5, NULL, 1),
(3, '2022-05-03 20:32:17', '2022-05-03 20:32:17', '{\"kk\":\"\\u043b\\u043b\",\"ru\":\"\\u0440\\u0443\"}', 5000, 1, 54545, NULL, 1),
(4, '2022-05-03 20:33:41', '2022-05-03 20:33:41', '{\"kk\":\"ssrr\",\"ru\":\"ru\"}', 1200, 1, 50, NULL, 1),
(5, '2022-05-03 20:34:27', '2022-05-03 20:34:27', '{\"kk\":\"ssss\",\"ru\":\"qqq\"}', 150, 1, 152, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `personal_advice_orders`
--

CREATE TABLE `personal_advice_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_advice_id` bigint(20) UNSIGNED NOT NULL,
  `comment_for_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `used_counts` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `discount_percentage` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `code`, `used_counts`, `created_at`, `updated_at`, `is_active`, `deleted_at`, `discount_percentage`, `from_date`, `to_date`) VALUES
(1, 'xb1JPfWdLa', 0, '2022-05-04 16:40:43', '2022-05-04 16:41:16', 1, NULL, 10, '2022-05-03', '2022-05-27'),
(2, 'Uy7eoO8CaC', 0, '2022-05-04 16:45:57', '2022-05-04 16:45:57', 1, NULL, 15, '2022-05-09', '2022-05-31'),
(3, 'mLHjQvUJHT', 0, '2022-05-04 16:46:44', '2022-05-04 17:10:52', 1, NULL, 16, '2022-06-01', '2022-07-01');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_general` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `is_general`, `created_at`, `updated_at`) VALUES
(1, 'админ', 0, '2022-05-01 10:44:05', '2022-05-01 10:44:05'),
(2, 'Мұғалім', 1, '2022-05-01 10:44:05', '2022-05-01 10:44:05'),
(3, 'Оқушы', 1, '2022-05-01 10:44:05', '2022-05-01 10:44:05'),
(4, 'Тәрбиеші', 1, '2022-05-01 10:44:06', '2022-05-01 10:44:06'),
(5, 'Студент', 1, '2022-05-01 10:44:06', '2022-05-01 10:44:06');

-- --------------------------------------------------------

--
-- Структура таблицы `sending_material_journals`
--

CREATE TABLE `sending_material_journals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sending_material_journals`
--

INSERT INTO `sending_material_journals` (`id`, `user_id`, `material_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, '2022-05-01 10:44:18', '2022-05-01 10:44:18'),
(2, 1, 3, NULL, '2022-05-01 10:44:18', '2022-05-01 10:44:18'),
(3, 1, 3, NULL, '2022-05-01 10:44:18', '2022-05-01 10:44:18'),
(4, 1, 12, NULL, '2022-05-01 10:44:18', '2022-05-01 10:44:18'),
(5, 1, 12, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(6, 1, 12, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(7, 1, 10, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(8, 1, 10, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(9, 1, 10, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(10, 1, 9, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(11, 1, 9, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(12, 1, 9, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(13, 1, 2, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(14, 1, 2, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(15, 1, 2, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(16, 1, 7, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(17, 1, 7, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(18, 1, 7, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(19, 1, 6, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(20, 1, 6, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(21, 1, 6, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(22, 1, 8, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(23, 1, 8, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(24, 1, 8, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(25, 1, 4, NULL, '2022-05-01 10:44:19', '2022-05-01 10:44:19'),
(26, 1, 4, NULL, '2022-05-01 10:44:20', '2022-05-01 10:44:20'),
(27, 1, 4, NULL, '2022-05-01 10:44:20', '2022-05-01 10:44:20'),
(28, 1, 11, NULL, '2022-05-01 10:44:20', '2022-05-03 16:48:02'),
(29, 1, 11, NULL, '2022-05-01 10:44:20', '2022-05-01 10:44:20'),
(30, 1, 11, 2, '2022-05-01 10:44:21', '2022-05-03 16:31:18');

-- --------------------------------------------------------

--
-- Структура таблицы `sms_verifications`
--

CREATE TABLE `sms_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `is_discount` tinyint(1) NOT NULL DEFAULT 0,
  `discount_percentage` int(11) DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `created_at`, `updated_at`, `name`, `price`, `is_discount`, `discount_percentage`, `duration`, `deleted_at`, `is_active`) VALUES
(1, '2022-05-03 19:06:22', '2022-05-03 19:47:30', '1 айға жазылуs', 2599, 0, 10, 1, NULL, 0),
(2, '2022-05-03 19:06:24', '2022-05-03 19:06:24', '3 айға жазылу', 1990, 0, NULL, 3, NULL, 1),
(3, '2022-05-03 19:06:24', '2022-05-03 19:06:24', '6 айға жазылу\n                ', 1490, 0, NULL, 6, NULL, 1),
(4, '2022-05-03 19:06:24', '2022-05-03 19:06:24', '12 айға жазылу', 990, 0, NULL, 12, NULL, 0),
(5, '2022-05-03 19:45:40', '2022-05-03 19:47:05', '1 айға жазылуs', 2599, 0, NULL, 1, '2022-05-03 19:47:05', 0),
(6, '2022-05-03 19:46:14', '2022-05-03 19:47:10', '1 айға жазылуs', 2599, 0, NULL, 1, '2022-05-03 19:47:10', 0),
(7, '2022-05-03 20:07:42', '2022-05-04 20:24:25', 'ыыв', 5000, 1, 10, 5, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `place_work` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_phone_verification` tinyint(1) NOT NULL DEFAULT 0,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 5,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `birthday`, `sex`, `place_work`, `is_phone_verification`, `is_email_verified`, `email_verified_at`, `password`, `role_id`, `remember_token`, `avatar`, `created_at`, `updated_at`, `email_token`) VALUES
(1, 'Kuhn Aida', 'sarah27@example.org', '+8845761540', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'IuIlkHh7Fa', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL),
(2, 'Feest Jo', 'vicente.jaskolski@example.net', '+8103637153', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'wo0JZbLKk5', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL),
(3, 'O\'Connell Marianna', 'hazle54@example.org', '+5429374935', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, '4kbdROQIbh', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL),
(4, 'Gottlieb Shawna', 'rafaela19@example.net', '+0987409896', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'g1nJPWn6Ws', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL),
(5, 'Sauer Corene', 'iparker@example.net', '+3286385919', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'DIdKHmeiBM', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL),
(6, 'Swift Lilla', 'hanna.raynor@example.net', '+8376088369', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'gTsA0t4kt9', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL),
(7, 'Toy Ernie', 'angelina82@example.com', '+6559206765', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'mpN7mXBcyb', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL),
(8, 'Homenick Sandy', 'eulalia29@example.net', '+5766134258', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, '1cTjytKj9w', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL),
(9, 'Metz Willa', 'paul.morar@example.net', '+3397139885', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'BDXnMEQqQ1', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL),
(10, 'Considine Cornelius', 'wlebsack@example.com', '+0275754154', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 5, 'HekvFjZ0Jn', NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL),
(11, 'Maksat Daulet', 'admin@mail.ru', '77714744971', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, NULL, NULL, '2022-05-01 10:44:06', '2022-05-01 21:17:56', NULL),
(12, 'Maksat Daulet', 'admin@mail.ru2', '+7 707 777 66 77', NULL, NULL, NULL, 0, 0, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, NULL, NULL, '2022-05-01 10:44:06', '2022-05-01 10:44:06', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_news_saveds`
--

CREATE TABLE `user_news_saveds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_news_saveds`
--

INSERT INTO `user_news_saveds` (`id`, `user_id`, `news_id`, `created_at`, `updated_at`) VALUES
(2, 11, 1, '2022-05-01 21:06:20', '2022-05-01 21:06:20');

-- --------------------------------------------------------

--
-- Структура таблицы `user_subscription`
--

CREATE TABLE `user_subscription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `user_id`, `subscription_id`, `from_date`, `to_date`, `created_at`, `updated_at`) VALUES
(4, 1, 3, '2022-05-05', '2021-11-03', '2022-05-04 19:32:09', '2022-05-04 19:32:09'),
(5, 1, 2, '2022-05-05', '2022-08-05', '2022-05-04 19:32:21', '2022-05-04 19:32:21');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materials_user_id_foreign` (`user_id`),
  ADD KEY `materials_subject_id_foreign` (`subject_id`),
  ADD KEY `materials_direction_id_foreign` (`direction_id`);

--
-- Индексы таблицы `material_classes`
--
ALTER TABLE `material_classes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_comments`
--
ALTER TABLE `material_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_comments_user_id_foreign` (`user_id`),
  ADD KEY `material_comments_material_id_foreign` (`material_id`),
  ADD KEY `material_comments_comment_id_foreign` (`comment_id`);

--
-- Индексы таблицы `material_directions`
--
ALTER TABLE `material_directions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_subjects`
--
ALTER TABLE `material_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_news_types_id_foreign` (`news_types_id`);

--
-- Индексы таблицы `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_comments_user_id_foreign` (`user_id`),
  ADD KEY `news_comments_news_id_foreign` (`news_id`),
  ADD KEY `news_comments_parent_id_foreign` (`parent_id`);

--
-- Индексы таблицы `news_comment_likes`
--
ALTER TABLE `news_comment_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_comment_likes_news_comment_id_foreign` (`news_comment_id`),
  ADD KEY `news_comment_likes_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `news_types`
--
ALTER TABLE `news_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Индексы таблицы `order_update_materials`
--
ALTER TABLE `order_update_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_update_materials_subject_id_foreign` (`subject_id`),
  ADD KEY `order_update_materials_direction_id_foreign` (`direction_id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `personal_advice`
--
ALTER TABLE `personal_advice`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personal_advice_orders`
--
ALTER TABLE `personal_advice_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_advice_orders_personal_adive_id_foreign` (`personal_advice_id`);

--
-- Индексы таблицы `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sending_material_journals`
--
ALTER TABLE `sending_material_journals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sending_material_journals_user_id_foreign` (`user_id`),
  ADD KEY `sending_material_journals_material_id_foreign` (`material_id`);

--
-- Индексы таблицы `sms_verifications`
--
ALTER TABLE `sms_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `user_news_saveds`
--
ALTER TABLE `user_news_saveds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_news_saveds_user_id_foreign` (`user_id`),
  ADD KEY `user_news_saveds_news_id_foreign` (`news_id`);

--
-- Индексы таблицы `user_subscription`
--
ALTER TABLE `user_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_subscriptions_user_id_foreign` (`user_id`),
  ADD KEY `user_subscriptions_subscription_id_foreign` (`subscription_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `material_classes`
--
ALTER TABLE `material_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `material_comments`
--
ALTER TABLE `material_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT для таблицы `material_directions`
--
ALTER TABLE `material_directions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `material_subjects`
--
ALTER TABLE `material_subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `news_comment_likes`
--
ALTER TABLE `news_comment_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `news_types`
--
ALTER TABLE `news_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `order_update_materials`
--
ALTER TABLE `order_update_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `personal_advice`
--
ALTER TABLE `personal_advice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `personal_advice_orders`
--
ALTER TABLE `personal_advice_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `sending_material_journals`
--
ALTER TABLE `sending_material_journals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `sms_verifications`
--
ALTER TABLE `sms_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `user_news_saveds`
--
ALTER TABLE `user_news_saveds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user_subscription`
--
ALTER TABLE `user_subscription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_direction_id_foreign` FOREIGN KEY (`direction_id`) REFERENCES `material_directions` (`id`),
  ADD CONSTRAINT `materials_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `material_subjects` (`id`),
  ADD CONSTRAINT `materials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `material_comments`
--
ALTER TABLE `material_comments`
  ADD CONSTRAINT `material_comments_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `material_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `material_comments_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `material_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_news_types_id_foreign` FOREIGN KEY (`news_types_id`) REFERENCES `news_types` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news_comments`
--
ALTER TABLE `news_comments`
  ADD CONSTRAINT `news_comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `news_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news_comment_likes`
--
ALTER TABLE `news_comment_likes`
  ADD CONSTRAINT `news_comment_likes_news_comment_id_foreign` FOREIGN KEY (`news_comment_id`) REFERENCES `news_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_comment_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_update_materials`
--
ALTER TABLE `order_update_materials`
  ADD CONSTRAINT `order_update_materials_direction_id_foreign` FOREIGN KEY (`direction_id`) REFERENCES `material_directions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_update_materials_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `material_subjects` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `personal_advice_orders`
--
ALTER TABLE `personal_advice_orders`
  ADD CONSTRAINT `personal_advice_orders_personal_adive_id_foreign` FOREIGN KEY (`personal_advice_id`) REFERENCES `personal_advice` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sending_material_journals`
--
ALTER TABLE `sending_material_journals`
  ADD CONSTRAINT `sending_material_journals_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sending_material_journals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_news_saveds`
--
ALTER TABLE `user_news_saveds`
  ADD CONSTRAINT `user_news_saveds_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_news_saveds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD CONSTRAINT `user_subscriptions_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
