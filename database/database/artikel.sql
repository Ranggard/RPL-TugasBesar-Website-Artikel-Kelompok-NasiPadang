-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20250611.a72a6b040c
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2026 at 11:30 AM
-- Server version: 8.4.3
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artikel`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `articleId` bigint UNSIGNED NOT NULL,
  `authorId` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `isDraft` tinyint(1) NOT NULL DEFAULT '1',
  `viewCount` int NOT NULL DEFAULT '0',
  `publishedAt` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articleId`, `authorId`, `title`, `content`, `isPublished`, `isDraft`, `viewCount`, `publishedAt`, `created_at`, `updated_at`) VALUES
(1, 1, 'Analisis Mendalam Mengenai Dampak Teknologi & Digital', '<div>\r\n            <p><strong>Analisis Mendalam Mengenai Dampak Teknologi & Digital</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Ut occaecati perspiciatis eaque vel ut. Nesciunt odit sit et ad consequatur sed tempora. Molestiae sed tempore quia.</p><p>Dolorum dignissimos nostrum quidem velit voluptas. Ut aliquam aliquid et hic exercitationem molestiae labore est. Sed velit aut rerum incidunt beatae enim.</p><p>Tempore expedita earum odio eos nobis voluptatem. Eum enim et aut aliquam pariatur ratione ducimus. Illo corporis nihil doloremque ut est ad temporibus voluptatem.</p><p>Et maiores cumque recusandae dolorem totam blanditiis voluptatem. Cumque sint perspiciatis inventore. Inventore id sed dignissimos ad qui asperiores hic. Illo quidem qui deleniti repudiandae expedita voluptatem assumenda.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 302, '2026-02-13 04:16:13', '2026-02-13 04:16:13', '2026-02-13 04:16:13'),
(2, 2, 'Pentingnya Mengetahui Teknologi & Digital di Era Modern', '<div>\r\n            <p><strong>Pentingnya Mengetahui Teknologi & Digital di Era Modern</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Dolores voluptatum non sunt nostrum. Saepe qui dolorem dolor minus. Dolores aut quo libero at aliquid dolor dolor. Tempore aut alias voluptatem est aut.</p><p>Officia tenetur quaerat at tempora. Voluptatem quia quia maiores minus quia velit. Dicta ea id veritatis rerum commodi nobis quod. Vero vel sit aut molestiae quidem distinctio.</p><p>Vel qui animi nemo consequuntur saepe provident similique nostrum. Provident et architecto consequatur delectus. Quo vel itaque harum eum in accusantium.</p><p>Aliquid accusantium corrupti quas ut. Incidunt eveniet mollitia est placeat. Fugiat aliquid ullam voluptatem in sit corrupti repellendus odit.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 63, '2026-02-11 04:16:14', '2026-02-13 04:16:14', '2026-02-13 04:16:14'),
(3, 3, 'Masa Depan Politik & Hukum di Indonesia: Apa yang Perlu Diketahui?', '<div>\r\n            <p><strong>Masa Depan Politik & Hukum di Indonesia: Apa yang Perlu Diketahui?</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Rem id debitis voluptate. Ut voluptas magni molestiae dolorem dignissimos est. Et commodi et sint eos incidunt. Dolorum repellendus laboriosam necessitatibus dolorum nam ut.</p><p>Nihil id qui velit repellat. Ea consequatur sint aliquam temporibus. Qui commodi deserunt rerum magni. Mollitia ducimus qui et molestias sit.</p><p>Quae alias ut quasi mollitia repellat est repellendus. Beatae architecto rem odit quia possimus et quia. Ea sunt quae non et eligendi expedita.</p><p>Ut velit eligendi et nulla reprehenderit rem. Qui repellat culpa aut sunt quis et officia. Quam deleniti fugit inventore aliquam rerum. Dolores quia accusantium enim enim reprehenderit consequuntur.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 433, '2026-02-13 04:16:14', '2026-02-13 04:16:14', '2026-02-13 04:16:14'),
(4, 4, 'Pentingnya Mengetahui Politik & Hukum di Era Modern', '<div>\r\n            <p><strong>Pentingnya Mengetahui Politik & Hukum di Era Modern</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Totam laudantium aliquid est quis. Rerum deserunt fugit vero dolor ut. Expedita qui sed nobis ducimus. Hic ullam ratione et quam sint enim at.</p><p>Esse nam ea blanditiis et a et. Dolores eligendi perspiciatis exercitationem illo incidunt sunt quia. Quaerat dolores in repellat illo necessitatibus nam harum.</p><p>Recusandae ducimus ut voluptatem ut sed doloribus illum et. Dolorum rerum dicta quam odit quaerat sunt. Minima praesentium officia inventore mollitia molestiae eligendi. Delectus qui hic nisi nihil qui.</p><p>Repellendus voluptatem et quod numquam. Animi culpa ipsam enim nobis vel. Quo est sit blanditiis laudantium. Labore illum omnis sed delectus.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 179, '2026-02-11 04:16:14', '2026-02-13 04:16:14', '2026-02-13 04:16:14'),
(5, 5, 'Mengapa Ekonomi & Bisnis Sangat Penting Bagi Generasi Muda', '<div>\r\n            <p><strong>Mengapa Ekonomi & Bisnis Sangat Penting Bagi Generasi Muda</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Corrupti alias nam aut rerum. Repudiandae provident voluptates autem officiis enim sed deserunt quos. Necessitatibus facere dolores praesentium asperiores.</p><p>Omnis voluptatem dolores ut aut voluptas natus. Repellendus porro incidunt praesentium soluta nobis eveniet. Nostrum quis magnam delectus minima.</p><p>Expedita omnis quam nostrum velit nam consequatur ut quo. Delectus animi totam sed et possimus. Quia perferendis nisi similique animi doloremque rerum occaecati. Sed ut et assumenda consequatur impedit.</p><p>Architecto nihil incidunt optio. Commodi saepe in aut nihil rerum ut. Sit sit aspernatur ullam voluptatem.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 328, '2026-02-13 04:16:14', '2026-02-13 04:16:14', '2026-02-13 04:16:14'),
(6, 6, 'Pentingnya Mengetahui Ekonomi & Bisnis di Era Modern', '<div>\r\n            <p><strong>Pentingnya Mengetahui Ekonomi & Bisnis di Era Modern</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Velit perspiciatis totam adipisci cupiditate. Similique alias rerum autem qui quis eveniet. Nesciunt qui assumenda sit asperiores iste alias nulla.</p><p>Soluta quia eius tenetur est. Illo similique incidunt ipsa natus est. Est natus nam veritatis porro.</p><p>Et tenetur nihil perferendis beatae debitis tempore ut. Ullam praesentium dolorem quidem id ut odit.</p><p>Adipisci fuga rem laboriosam. Rem in necessitatibus quis et nostrum voluptas nisi exercitationem. Adipisci inventore voluptas eligendi ut. Laboriosam voluptates et dolore.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 182, '2026-02-11 04:16:15', '2026-02-13 04:16:15', '2026-02-13 04:16:15'),
(7, 7, 'Panduan Lengkap Belajar Edukasi & Sains untuk Pemula', '<div>\r\n            <p><strong>Panduan Lengkap Belajar Edukasi & Sains untuk Pemula</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Dolor tenetur consequatur fuga placeat unde dolorum. Dicta repellendus laborum dolores illum ea est nihil. A nostrum qui voluptas.</p><p>Amet et neque est eaque. Odio eum commodi et corrupti vero eligendi. Odio possimus deleniti et recusandae. Neque et molestiae quia pariatur perferendis et dolor.</p><p>Nihil a nemo delectus suscipit reiciendis aut sed eos. In porro qui occaecati nihil doloribus ad deleniti. Deserunt quaerat reprehenderit minima. Qui ea et alias sunt.</p><p>Labore minima provident voluptatem nulla est voluptate optio qui. Laudantium nam quo placeat qui molestiae debitis.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 302, '2026-02-13 04:16:15', '2026-02-13 04:16:15', '2026-02-13 04:16:15'),
(8, 8, 'Pentingnya Mengetahui Edukasi & Sains di Era Modern', '<div>\r\n            <p><strong>Pentingnya Mengetahui Edukasi & Sains di Era Modern</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Voluptatum est accusamus aliquid excepturi. Et rem minima modi mollitia fugit. Ut et omnis sit debitis laboriosam ipsa sint.</p><p>Commodi quia quaerat eaque est commodi. Error voluptate commodi recusandae corrupti ad tempore veniam. Laudantium sed qui harum eius. Quo aut minus fugiat velit et quibusdam doloribus enim.</p><p>Id eveniet error molestiae nam at. Hic et quia asperiores id officia. Voluptatem temporibus voluptas dignissimos et sed totam aut.</p><p>Blanditiis consequatur ut et voluptatum rerum non. Accusantium quia id saepe est molestiae. Perspiciatis aut adipisci pariatur illo odit deleniti exercitationem perferendis.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 152, '2026-02-11 04:16:15', '2026-02-13 04:16:15', '2026-02-13 04:16:15'),
(9, 9, 'Masa Depan Gaya Hidup & Kesehatan di Indonesia: Apa yang Perlu Diketahui?', '<div>\r\n            <p><strong>Masa Depan Gaya Hidup & Kesehatan di Indonesia: Apa yang Perlu Diketahui?</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Sit nesciunt impedit voluptatibus sint ipsam temporibus. Qui praesentium qui architecto voluptas. Nesciunt fugiat aut quo et consequatur cum.</p><p>Non voluptatem optio voluptates a. Sequi rerum blanditiis repellendus quisquam facilis vel et. Amet ea dolorum exercitationem.</p><p>Totam aut cum nemo dolor animi omnis perferendis. Sit incidunt quas velit suscipit nisi et sit. Ut est neque laudantium quia culpa recusandae voluptatem.</p><p>Quisquam omnis doloribus omnis. Veritatis consequuntur exercitationem omnis sequi aut autem. Accusamus incidunt ipsum officia tempore nesciunt repudiandae corrupti delectus. Occaecati dolorem odit qui velit corporis.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 402, '2026-02-13 04:16:15', '2026-02-13 04:16:15', '2026-02-13 04:16:15'),
(10, 10, 'Pentingnya Mengetahui Gaya Hidup & Kesehatan di Era Modern', '<div>\r\n            <p><strong>Pentingnya Mengetahui Gaya Hidup & Kesehatan di Era Modern</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Voluptatem et minus saepe nulla voluptatum voluptatem et. Sequi commodi unde laboriosam rerum fugit. Tempora reprehenderit est consequatur aut molestiae et voluptatibus.</p><p>Nemo id nisi dolorem repellat eius est velit dicta. Omnis aut esse unde et eum aliquid sint. Exercitationem et voluptatem nisi aut sint eius aut.</p><p>Ratione voluptatem eum quae eligendi cumque ab quos. Magnam perferendis qui veniam pariatur doloremque qui esse delectus. Ipsam corporis consequuntur saepe modi.</p><p>Sint voluptatibus fuga expedita non natus. Voluptates quis vitae sapiente consequatur recusandae porro totam. Sed error voluptatem deserunt aut. Dolores qui natus dolore dolores. Atque eos sed et ab aut.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 185, '2026-02-11 04:16:15', '2026-02-13 04:16:15', '2026-02-13 04:16:15'),
(11, 11, '10 Tips Rahasia Sukses di Bidang Seni & Budaya', '<div>\r\n            <p><strong>10 Tips Rahasia Sukses di Bidang Seni & Budaya</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Quia et voluptas vero corrupti eum cupiditate veniam. Animi temporibus reiciendis quisquam dolorum officia veniam inventore. Ut quisquam qui eius autem suscipit. Fugit dolorem dolore enim.</p><p>Non quis soluta totam quo. Aperiam occaecati est ducimus ut. Molestiae possimus nam veniam iure et odit ratione ea.</p><p>Et cum a molestiae perferendis architecto repellat voluptas. Omnis dicta aut ut recusandae. Repellat totam ducimus perspiciatis voluptate autem similique dolorem.</p><p>Aperiam animi eum voluptas totam dolorem. Placeat minima quos et.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 464, '2026-02-13 04:16:16', '2026-02-13 04:16:16', '2026-02-13 04:16:16'),
(12, 12, 'Pentingnya Mengetahui Seni & Budaya di Era Modern', '<div>\r\n            <p><strong>Pentingnya Mengetahui Seni & Budaya di Era Modern</strong> adalah topik yang sangat menarik untuk dibahas saat ini.</p>\r\n            <p>Debitis accusamus et culpa expedita voluptates at enim. Quaerat et corporis illum. In sapiente beatae non exercitationem cum.</p><p>Perspiciatis recusandae sint nobis. Explicabo quo totam laborum enim autem. Error sed autem beatae quod quam quis assumenda.</p><p>Et doloribus earum dignissimos voluptatem aperiam aut et doloremque. Quia dolores alias laudantium ipsam laudantium veniam. Est occaecati ad qui quaerat ut sint. Est illum aut accusamus non architecto.</p><p>Neque beatae in tenetur aut quam. Est voluptas molestiae saepe et vitae accusantium. Quae est veniam ad. Natus architecto qui vero architecto. Esse neque minima doloribus nihil sunt.</p>\r\n            <p>Kesimpulannya, memahami materi ini akan memberikan dampak positif bagi perkembangan kita ke depannya.</p>\r\n        </div>', 1, 0, 138, '2026-02-11 04:16:16', '2026-02-13 04:16:16', '2026-02-13 04:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `id` bigint UNSIGNED NOT NULL,
  `articleId` bigint UNSIGNED NOT NULL,
  `categoryId` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `articleId`, `categoryId`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2),
(5, 5, 3),
(6, 6, 3),
(7, 7, 4),
(8, 8, 4),
(9, 9, 5),
(10, 10, 5),
(11, 11, 6),
(12, 12, 6);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` bigint UNSIGNED NOT NULL,
  `categoryName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Teknologi & Digital', NULL, '2026-02-13 04:16:13', '2026-02-13 04:16:13'),
(2, 'Politik & Hukum', NULL, '2026-02-13 04:16:13', '2026-02-13 04:16:13'),
(3, 'Ekonomi & Bisnis', NULL, '2026-02-13 04:16:13', '2026-02-13 04:16:13'),
(4, 'Edukasi & Sains', NULL, '2026-02-13 04:16:13', '2026-02-13 04:16:13'),
(5, 'Gaya Hidup & Kesehatan', NULL, '2026-02-13 04:16:13', '2026-02-13 04:16:13'),
(6, 'Seni & Budaya', NULL, '2026-02-13 04:16:13', '2026-02-13 04:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` bigint UNSIGNED NOT NULL,
  `articleId` bigint UNSIGNED NOT NULL,
  `userId` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeId` bigint UNSIGNED NOT NULL,
  `articleId` bigint UNSIGNED NOT NULL,
  `userId` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2022_create_users_table', 1),
(2, '2026_01_27_022023_create_sessions_table', 1),
(3, '2026_02_06_124948_create_personal_access_tokens_table', 1),
(4, 'xxxx_create_articles_table', 1),
(5, 'xxxx_create_categories_table', 1),
(6, 'xxxx_create_comments_table', 1),
(7, 'xxxx_create_likes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('penulis','pembaca') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pembaca',
  `isNewAuthor` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `email`, `password`, `role`, `isNewAuthor`, `created_at`, `updated_at`) VALUES
(1, 'waskita.usyi', 'mulyani.sadina@example.com', '$2y$12$01zlWJDzl5aeeXppelJvFurfrL1azM9BPwjaQ/hIYfDq5rwYokAF.', 'penulis', 1, '2026-02-13 04:16:13', '2026-02-13 04:16:13'),
(2, 'aryani.baktianto', 'asmuni.nainggolan@example.com', '$2y$12$bu6feGsM6XOPkq3z6KwVyOFp6Fjq9ygSTy69zMG/F4STUf0Uw5HqS', 'penulis', 0, '2026-02-13 04:16:14', '2026-02-13 04:16:14'),
(3, 'jarwa.agustina', 'artanto.hakim@example.com', '$2y$12$jtnS3vEsH9GRrTAYwBvrW.kikLOWE0ywWeSpvhZU2GwtA875e888y', 'penulis', 1, '2026-02-13 04:16:14', '2026-02-13 04:16:14'),
(4, 'prayogo34', 'tirta19@example.com', '$2y$12$wwxd1YmL7KlAmvNVryjVqehRwrufpBMYZbmVXbmf2D9bXrDbSM7aK', 'penulis', 0, '2026-02-13 04:16:14', '2026-02-13 04:16:14'),
(5, 'sudiati.anita', 'syuliarti@example.org', '$2y$12$yjZlZSnBtRwdACF1g8f2VOPF4ajWPlLyj.cYaE4JOuf5O10rBv8Qa', 'penulis', 1, '2026-02-13 04:16:14', '2026-02-13 04:16:14'),
(6, 'prasasta.kajen', 'drajat.nugroho@example.org', '$2y$12$9zqKJsgrWMNINW1nZP186uxp2MUM4z5WeuXLPLO/hVCmQoJlmGT9e', 'penulis', 0, '2026-02-13 04:16:15', '2026-02-13 04:16:15'),
(7, 'salsabila48', 'karman58@example.net', '$2y$12$ENCpwHzONQXdUNpN.SMafecMAj.VajwXT0q.PNtEgl7Klp2e9lbbK', 'penulis', 1, '2026-02-13 04:16:15', '2026-02-13 04:16:15'),
(8, 'rsihotang', 'mustika86@example.com', '$2y$12$eE7x.loIOhqVYE6OvcW6wuvZbxtWzTRn.64XXQWlmNvkX6HnEemM.', 'penulis', 0, '2026-02-13 04:16:15', '2026-02-13 04:16:15'),
(9, 'bella91', 'iyuliarti@example.net', '$2y$12$0fgmW5ggZCb.Jy11tTZeLuZzW3zRMK4gwmdMvp2RKROktv.tuExd6', 'penulis', 1, '2026-02-13 04:16:15', '2026-02-13 04:16:15'),
(10, 'vhabibi', 'juyainah@example.org', '$2y$12$WMvxX5u/0Iw6VHlUazVuO.bJF5PrDtNxYj1hz6ryQvQZOV/2Ef6ry', 'penulis', 0, '2026-02-13 04:16:15', '2026-02-13 04:16:15'),
(11, 'lazuardi.raina', 'zusamah@example.org', '$2y$12$AwZOXW570vXFE0iZlrTQQuHcX3pfS4uN/Htr1DbtgwsZPsgIllY12', 'penulis', 1, '2026-02-13 04:16:16', '2026-02-13 04:16:16'),
(12, 'ulya27', 'maida69@example.com', '$2y$12$zjGP.LRx4OXBXGZLap5YquyKVsB1EWmaIbUUy2.bzHLMlXDTT5vWu', 'penulis', 0, '2026-02-13 04:16:16', '2026-02-13 04:16:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articleId`),
  ADD KEY `articles_authorid_foreign` (`authorId`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_category_articleid_foreign` (`articleId`),
  ADD KEY `article_category_categoryid_foreign` (`categoryId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `comments_articleid_foreign` (`articleId`),
  ADD KEY `comments_userid_foreign` (`userId`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeId`),
  ADD KEY `likes_articleid_foreign` (`articleId`),
  ADD KEY `likes_userid_foreign` (`userId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `articleId` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeId` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_authorid_foreign` FOREIGN KEY (`authorId`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_articleid_foreign` FOREIGN KEY (`articleId`) REFERENCES `articles` (`articleId`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_category_categoryid_foreign` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_articleid_foreign` FOREIGN KEY (`articleId`) REFERENCES `articles` (`articleId`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`commentId`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_articleid_foreign` FOREIGN KEY (`articleId`) REFERENCES `articles` (`articleId`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`userid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
