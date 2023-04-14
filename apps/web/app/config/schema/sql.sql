-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2023 年 4 月 10 日 09:29
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- データベース: `reiwakai`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `admins`
--

INSERT INTO `admins` (`id`, `created`, `modified`, `name`, `username`, `password`, `role`) VALUES
(1, '2022-12-16 13:51:15', '2022-12-16 13:51:15', '管理者', 'caters_admin', '$2y$10$7X.icRPhUBnFrsoBR784y.VMC9IrXxbbinEff3WMGa0N.WG3D8kH6', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `append_items`
--

CREATE TABLE `append_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `page_config_id` int(11) UNSIGNED NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(40) DEFAULT NULL,
  `slug` varchar(30) DEFAULT NULL,
  `value_type` decimal(10,0) DEFAULT NULL,
  `max_length` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_required` decimal(10,0) UNSIGNED NOT NULL DEFAULT '0',
  `mst_list_slug` varchar(40) DEFAULT NULL,
  `value_default` varchar(100) DEFAULT NULL,
  `attention` varchar(100) DEFAULT NULL,
  `edit_pos` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `append_items`
--

INSERT INTO `append_items` (`id`, `created`, `modified`, `page_config_id`, `position`, `name`, `slug`, `value_type`, `max_length`, `is_required`, `mst_list_slug`, `value_default`, `attention`, `edit_pos`) VALUES
(15, '2023-04-05 03:19:01', '2023-04-05 03:19:39', 1, 1, 'caters', 'test', '11', 1, '0', '0', '', 'a', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `page_config_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `parent_category_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `name` varchar(40) DEFAULT NULL,
  `identifier` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `categories`
--

INSERT INTO `categories` (`id`, `created`, `modified`, `page_config_id`, `parent_category_id`, `position`, `status`, `name`, `identifier`) VALUES
(4, '2023-04-05 01:31:29', '2023-04-06 00:32:12', 1, 0, 1, 'publish', 'お知らせ', NULL),
(5, '2023-04-06 00:32:34', '2023-04-06 00:32:34', 1, 0, 2, 'publish', 'ブログ', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `infos`
--

CREATE TABLE `infos` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `page_config_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'draft',
  `title` varchar(100) DEFAULT NULL,
  `notes` text,
  `start_now` tinyint(2) DEFAULT '0',
  `start_datetime` datetime DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `meta_description` varchar(200) DEFAULT NULL,
  `meta_keywords` varchar(200) DEFAULT NULL,
  `regist_user_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `index_type` decimal(10,0) DEFAULT NULL,
  `multi_position` bigint(20) DEFAULT NULL,
  `parent_info_id` int(10) UNSIGNED DEFAULT NULL,
  `post_useradmin_id` int(10) UNSIGNED DEFAULT NULL,
  `link_type` tinyint(2) UNSIGNED DEFAULT '1',
  `link` varchar(255) DEFAULT NULL,
  `link_blank` varchar(255) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_size` int(10) UNSIGNED DEFAULT NULL,
  `file_extension` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `infos`
--

INSERT INTO `infos` (`id`, `created`, `modified`, `page_config_id`, `position`, `status`, `title`, `notes`, `start_now`, `start_datetime`, `start_at`, `end_at`, `image`, `meta_description`, `meta_keywords`, `regist_user_id`, `category_id`, `index_type`, `multi_position`, `parent_info_id`, `post_useradmin_id`, `link_type`, `link`, `link_blank`, `file`, `file_name`, `file_size`, `file_extension`) VALUES
(3, '2023-04-06 00:43:27', '2023-04-10 03:29:59', 1, 7, 'publish', 'aa', NULL, 1, NULL, '2023-04-19 00:00:00', NULL, '', NULL, '', NULL, 4, NULL, NULL, NULL, NULL, 1, '', '', '', NULL, NULL, NULL),
(4, '2023-04-06 01:12:58', '2023-04-07 02:31:36', 1, 14, 'publish', 'bb', NULL, 1, NULL, '2023-04-08 00:00:00', NULL, '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, 1, '', '', '', NULL, NULL, NULL),
(5, '2023-04-06 09:04:26', '2023-04-07 00:29:23', 1, 12, 'draft', '文字以内で入力文字以内で入力文字以内で入力文字以内で入力文字以内で入力', NULL, 1, NULL, '2023-04-02 00:00:00', NULL, '', NULL, '', NULL, 4, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2023-04-06 09:04:44', '2023-04-07 02:31:54', 1, 13, 'draft', 'タイトルタイトルタイトルタイトルタイトルタイトルタイトル', NULL, 0, NULL, '2023-04-06 00:00:00', NULL, '', NULL, '', NULL, 4, NULL, NULL, NULL, NULL, 1, '', '', '', NULL, NULL, NULL),
(7, '2023-04-06 09:05:15', '2023-04-07 00:31:02', 1, 5, 'publish', 'testt', NULL, 0, NULL, '2023-04-06 00:00:00', NULL, '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '2023-04-07 00:32:51', '2023-04-07 01:13:22', 1, 8, 'publish', 'リンク', NULL, 0, NULL, '2023-04-07 00:00:00', NULL, '', NULL, '', NULL, 4, NULL, NULL, NULL, NULL, 2, 'https://www.google.com/', NULL, '', NULL, NULL, NULL),
(9, '2023-04-07 00:41:46', '2023-04-07 00:44:33', 1, 9, 'publish', 'タイトル1', NULL, 0, NULL, '2023-04-07 00:00:00', NULL, '', NULL, '', NULL, 4, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '2023-04-07 01:17:13', '2023-04-07 01:17:55', 1, 11, 'publish', 'リンク　別', NULL, 0, NULL, '2023-04-07 00:00:00', NULL, '', NULL, '', NULL, 4, NULL, NULL, NULL, NULL, 3, '', 'https://github.com/', '', NULL, NULL, NULL),
(11, '2023-04-07 01:19:06', '2023-04-07 08:26:26', 1, 10, 'publish', 'ファイル', NULL, 1, NULL, '2023-04-06 00:00:00', '2023-04-10 00:00:00', '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, 4, '', '', 'file_11_51bc6b24-2c83-4cc5-953a-83c49a6a600f.pdf', '', NULL, NULL),
(12, '2023-04-07 01:22:42', '2023-04-07 01:22:42', 1, 1, 'publish', 'ファイル', NULL, 0, NULL, '2023-04-07 00:00:00', NULL, '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, 4, '', '', 'file_12_77311b1f-5f36-4a31-b191-8f785cbf76a9.pdf', NULL, NULL, NULL),
(13, '2023-04-07 01:25:35', '2023-04-10 08:52:13', 1, 6, 'publish', 'ファイル２２２２', NULL, 1, NULL, '2023-03-26 00:00:00', '2023-04-06 00:00:00', '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, 4, '', '', 'file_13_c77174af-4bdd-474e-ad69-ac4a8a77c7d3.pdf', 'ファイルテスト', NULL, NULL),
(16, '2023-04-07 05:26:23', '2023-04-07 07:44:02', 1, 4, 'publish', '【令和4年11月下旬】外部足場組立が始まりました！', NULL, 0, NULL, '2023-04-07 00:00:00', NULL, '', NULL, '', NULL, 4, NULL, NULL, NULL, NULL, 1, '', '', '', NULL, NULL, NULL),
(17, '2023-04-07 08:28:23', '2023-04-10 03:21:03', 1, 3, 'publish', 'test6', NULL, 1, NULL, '2023-04-13 00:00:00', '2023-04-13 00:00:00', '', NULL, '', NULL, 4, NULL, NULL, NULL, NULL, 2, 'https://www.google.com/', 'https://github.com/', '', NULL, NULL, NULL),
(18, '2023-04-10 05:28:16', '2023-04-10 08:41:14', 1, 2, 'publish', 'blog', NULL, 0, NULL, '2023-04-10 00:00:00', NULL, '', NULL, '', NULL, 4, NULL, NULL, NULL, NULL, 1, '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `info_append_items`
--

CREATE TABLE `info_append_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `info_id` int(11) UNSIGNED NOT NULL,
  `append_item_id` int(11) UNSIGNED NOT NULL,
  `value_text` varchar(200) DEFAULT NULL,
  `value_textarea` text,
  `value_date` date DEFAULT NULL,
  `value_datetime` datetime DEFAULT NULL,
  `value_time` time DEFAULT NULL,
  `value_int` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `value_key` varchar(30) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `file_size` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `file_name` varchar(100) DEFAULT NULL,
  `file_extension` varchar(10) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `info_categories`
--

CREATE TABLE `info_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `info_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `info_contents`
--

CREATE TABLE `info_contents` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `info_id` int(11) UNSIGNED NOT NULL,
  `block_type` decimal(10,0) NOT NULL DEFAULT '0',
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `image` varchar(100) DEFAULT NULL,
  `image_pos` varchar(10) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `file_size` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `file_name` varchar(100) DEFAULT NULL,
  `file_extension` varchar(10) DEFAULT NULL,
  `section_sequence_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `option_value` varchar(255) DEFAULT NULL,
  `option_value2` varchar(40) DEFAULT NULL,
  `option_value3` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `info_contents`
--

INSERT INTO `info_contents` (`id`, `created`, `modified`, `info_id`, `block_type`, `position`, `title`, `content`, `image`, `image_pos`, `file`, `file_size`, `file_name`, `file_extension`, `section_sequence_id`, `option_value`, `option_value2`, `option_value3`) VALUES
(7, '2023-04-06 09:48:45', '2023-04-07 00:29:23', 5, '19', 1, '見出しが入ります見出しが入ります（h1）', '', '', '', '', 0, '', NULL, 0, '0', '', ''),
(8, '2023-04-06 09:48:45', '2023-04-07 00:29:23', 5, '1', 2, '見出しが入ります見出しが入ります（h2）', '', '', '', '', 0, '', NULL, 0, '1', '', ''),
(9, '2023-04-06 09:48:45', '2023-04-07 00:29:23', 5, '5', 3, '見出しが入ります見出しが入ります（h3）', '', '', '', '', 0, '', NULL, 0, '2', '', ''),
(10, '2023-04-06 09:53:24', '2023-04-07 00:29:23', 5, '18', 4, NULL, NULL, '', NULL, '', 0, NULL, NULL, 0, NULL, NULL, NULL),
(11, '2023-04-06 09:53:27', '2023-04-07 00:29:23', 5, '2', 5, '', '<p><span style=\"color:rgb(50,51,41);\">テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。</span></p><p><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\"><strong>こちらはダミーです。</strong></span></p><p><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\"><u>こちらはダミーです。</u></span></p><p><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\"><s>こちらはダミーです。</s></span></p><p><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\"><i>こちらはダミーです。</i></span></p><p><span style=\"background-color:rgb(255,255,255);color:hsl(30,75%,60%);\">こちらはダミーです。</span></p><p><a href=\"https://design.sample.caters.jp/reiwakai/230322/pc_apply.html\"><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></a></p><ul style=\"list-style-type:disc;\"><li><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></li><li><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></li></ul><ul style=\"list-style-type:circle;\"><li><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></li><li><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></li></ul><ul style=\"list-style-type:square;\"><li><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></li><li><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></li></ul><ol><li><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></li><li><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></li></ol><p class=\"text-center\"><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></p><p class=\"text-right\"><span style=\"background-color:rgb(255,255,255);color:rgb(50,51,41);\">こちらはダミーです。</span></p>', '', '', '', 0, '', NULL, 0, '4', '', ''),
(12, '2023-04-06 09:53:27', '2023-04-07 00:29:23', 5, '8', 6, '<script>alert(1)<script>', 'https://www.clapp.edu.kh/home', '', '', '', 0, '', NULL, 0, '', '_blank', ''),
(13, '2023-04-06 10:00:03', '2023-04-07 00:29:23', 5, '4', 7, '', '', '', '', 'e_f_13_3cd1bf76-ca8c-4ff0-b2ad-880d19b185f7.xls', 8704, 'file_example_XLS_10', 'xls', 0, '6', '', ''),
(14, '2023-04-06 10:00:03', '2023-04-07 00:29:23', 5, '4', 8, '', '', '', '', 'e_f_14_1fac5bfb-ede6-4e0f-a45f-3e1be1ff5fa4.doc', 100352, 'file-sample_100kB', 'doc', 0, '7', '', ''),
(15, '2023-04-06 10:00:03', '2023-04-07 00:29:23', 5, '4', 9, '', '', '', '', 'e_f_15_df7725cb-0a71-4ac1-9d5b-4e6979ed22fa.pdf', 53122, 'ファイルテスト', 'pdf', 0, '8', '', ''),
(16, '2023-04-06 10:00:03', '2023-04-07 00:29:23', 5, '11', 11, NULL, '<p><span style=\"color:rgb(50,51,41);\">テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。</span></p><p><span style=\"color:rgb(50,51,41);\">テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。</span></p><p><span style=\"color:rgb(50,51,41);\">テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。</span></p>', 'img_16_481306ad-c951-4905-a82e-97c8ab95b96e.jpeg', 'left', '', 0, '', '', 0, 'http://backlog.caters.jp:8969/backlog/dashboard?from_globalbar', NULL, NULL),
(17, '2023-04-06 10:00:04', '2023-04-07 00:29:23', 5, '11', 12, NULL, '<p><span style=\"color:rgb(50,51,41);\">テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。</span></p><p><span style=\"color:rgb(50,51,41);\">テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。</span></p><p><span style=\"color:rgb(50,51,41);\">テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。テキストが入ります。こちらはダミーです。</span></p>', 'img_17_2104ce41-1410-47a5-ab78-e235e159b20d.jpeg', 'right', '', 0, '', '', 0, '', NULL, NULL),
(18, '2023-04-07 00:03:25', '2023-04-07 00:29:23', 5, '4', 10, '', '', '', '', 'e_f_18_3116a81c-998e-4af8-bc44-2d1bc64913d5.pptx', 413895, 'samplepptx', 'pptx', 0, '9', '', ''),
(19, '2023-04-07 00:19:17', '2023-04-07 00:31:02', 7, '4', 1, '', '', '', '', 'e_f_19_289fb42b-4dbc-49d1-9f70-4e8795e7d3ad.ppt', 248320, 'file_example_PPT_250kB', 'ppt', 0, '0', '', ''),
(20, '2023-04-07 00:19:17', '2023-04-07 00:31:02', 7, '4', 2, '', '', '', '', 'e_f_20_de0ba89d-dd90-468c-b8e9-54c43dbf4473.xls', 8704, 'file_example_XLS_10', 'xls', 0, '1', '', ''),
(21, '2023-04-07 00:19:17', '2023-04-07 00:31:02', 7, '4', 3, '', '', '', '', 'e_f_21_f2eb46fa-801e-4e53-88b3-d4b8bab2e04e.pptx', 413895, 'samplepptx', 'pptx', 0, '2', '', ''),
(22, '2023-04-07 00:30:05', '2023-04-07 00:31:02', 7, '2', 5, '', '<figure class=\"table\"><table><thead><tr><th>テストです</th><th>テストです</th><th>テストです</th><th>テストです</th></tr></thead><tbody><tr><th>テストです</th><td>テストです</td><td>テストです</td><td>テストです</td></tr></tbody></table></figure>', '', '', '', 0, '', NULL, 0, '3', '', ''),
(23, '2023-04-07 00:31:02', '2023-04-07 00:31:02', 7, '4', 4, '', '', '', '', 'e_f_23_827581fe-50eb-40bf-a342-fe2a2746f008.xlsx', 5425, 'file_example_XLSX_10', 'xlsx', 0, '4', '', ''),
(24, '2023-04-07 00:41:46', '2023-04-07 00:44:33', 9, '18', 1, NULL, NULL, '', NULL, '', 0, NULL, NULL, 0, NULL, NULL, NULL),
(25, '2023-04-07 02:34:09', '2023-04-10 03:29:59', 3, '11', 1, NULL, '<figure class=\"table\"><table><tbody><tr><td>テストです</td><td>テストです</td><td>テストです</td></tr><tr><td>テストです</td><td>テストです</td><td>テストです</td></tr></tbody></table></figure>', 'img_25_3e3bb5c0-97b5-4915-abe1-86dcb8525e3b.jpeg', '', '', 0, '', '', 0, '', NULL, NULL),
(26, '2023-04-07 05:16:20', '2023-04-10 03:29:59', 3, '2', 2, '', '', '', '', '', 0, '', NULL, 0, '1', '', ''),
(27, '2023-04-07 05:26:23', '2023-04-07 07:44:02', 16, '18', 1, NULL, NULL, '', NULL, '', 0, NULL, NULL, 0, NULL, NULL, NULL),
(28, '2023-04-07 05:26:24', '2023-04-07 07:44:02', 16, '19', 2, '見出しが入ります見出しが入ります', '', '', '', '', 0, '', NULL, 0, '1', '', ''),
(29, '2023-04-07 05:26:24', '2023-04-07 07:44:02', 16, '1', 3, '見出しが入ります見出しが入ります', '', '', '', '', 0, '', NULL, 0, '2', '', ''),
(30, '2023-04-07 05:26:24', '2023-04-07 07:44:02', 16, '5', 4, '見出しが入ります見出しが入ります', '', '', '', '', 0, '', NULL, 0, '3', '', ''),
(31, '2023-04-07 05:26:24', '2023-04-07 07:44:02', 16, '2', 5, '', '<p><a href=\"https://design.sample.caters.jp/reiwakai/230322/pc_news_2.html\">hello</a></p><p><a href=\"https://design.sample.caters.jp/reiwakai/230322/pc_news_2.html\">hiiiiiiii</a></p>', '', '', '', 0, '', NULL, 0, '4', '', ''),
(32, '2023-04-07 05:26:24', '2023-04-07 07:44:02', 16, '8', 6, 'ボタン名', 'https://norolodge.com', '', NULL, '', 0, NULL, NULL, 0, NULL, '_blank', NULL),
(33, '2023-04-07 07:44:02', '2023-04-07 07:44:02', 16, '18', 7, NULL, NULL, '', NULL, '', 0, NULL, NULL, 0, NULL, NULL, NULL),
(36, '2023-04-10 05:41:02', '2023-04-10 08:41:14', 18, '11', 2, NULL, '<p>栃木県小山市の社会福祉法人 令和会は、<br>地域密着型老人ホーム「大沼の里」の運営などの社会福祉事業を展開しております。<br>要介護になっても、可能な限り住み慣れた地域に住み続けることで、<br>利用者さまに健康で生きがいのある生活を送っていただきたい。栃木県小山市の社会福祉法人 令和会は、<br>地域密着型老人ホーム「大沼の里」の運営などの社会福祉事業を展開しております。<br>要介護になっても、可能な限り住み慣れた地域に住み続けることで、<br>利用者さまに健康で生きがいのある生活を送っていただきたい。<br>利用者さまのご家族の介護負担を軽減し、<br>ご家族お一人おひとりが、その人らしい生活が送れるための支援がしたい。<br>そんな想いで日々利用者さまに接しております。<br>利用者さまのご家族の介護負担を軽減し、<br>ご家族お一人おひとりが、その人らしい生活が送れるための支援がしたい。<br>そんな想いで日々利用者さまに接しております。</p>', 'img_36_3dcad1ee-4dcf-40dd-a8af-970670d862ae.jpeg', 'left', '', 0, '', '', 0, 'https://docs.google.com/spreadsheets/d/1fg_0YG356Q3UGOetEwe1SMMAvegOgY8fB0jq3-e1-_c/edit#gid=1676503937', NULL, NULL),
(37, '2023-04-10 05:43:58', '2023-04-10 08:41:14', 18, '11', 1, NULL, '<p>栃木県小山市の社会福祉法人 令和会は、<br>地域密着型老人ホーム「大沼の里」の運営などの社会福祉事業を展開しております。<br>要介護になっても、可能な限り住み慣れた地域に住み続けることで、<br>利用者さまに健康で生きがいのある生活を送っていただきたい。栃木県小山市の社会福祉法人 令和会は、<br>地域密着型老人ホーム「大沼の里」の運営などの社会福祉事業を展開しております。<br>要介護になっても、可能な限り住み慣れた地域に住み続けることで、<br>利用者さまに健康で生きがいのある生活を送っていただきたい。<br>利用者さまのご家族の介護負担を軽減し、<br>ご家族お一人おひとりが、その人らしい生活が送れるための支援がしたい。<br>そんな想いで日々利用者さまに接しております。<br>利用者さまのご家族の介護負担を軽減し、<br>ご家族お一人おひとりが、その人らしい生活が送れるための支援がしたい。<br>そんな想いで日々利用者さまに接しております。</p>', 'img_37_f31c0a6b-6b28-4539-acb7-5d7322a389d0.jpeg', 'left', '', 0, '', '', 0, 'https://jmsu-jmsunited-develop.sampleweb.org/use-case/', NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `info_stock_tables`
--

CREATE TABLE `info_stock_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `info_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `page_slug` varchar(40) NOT NULL DEFAULT '',
  `model_name` varchar(40) NOT NULL DEFAULT '',
  `model_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `info_tags`
--

CREATE TABLE `info_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `info_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `tag_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `info_tags`
--

INSERT INTO `info_tags` (`id`, `created`, `modified`, `info_id`, `tag_id`) VALUES
(2, '2023-03-16 17:12:19', '2023-03-16 17:12:19', 31, 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `info_tops`
--

CREATE TABLE `info_tops` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `page_config_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `info_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `kvs`
--

CREATE TABLE `kvs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `key_name` varchar(40) NOT NULL DEFAULT '',
  `val` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_lists`
--

CREATE TABLE `mst_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `position` decimal(10,0) NOT NULL COMMENT '表示順',
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `ltrl_cd` varchar(60) DEFAULT NULL,
  `ltrl_val` varchar(60) DEFAULT NULL,
  `ltrl_sub_val` text,
  `slug` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `sys_cd` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `mst_lists`
--

INSERT INTO `mst_lists` (`id`, `created`, `modified`, `position`, `status`, `ltrl_cd`, `ltrl_val`, `ltrl_sub_val`, `slug`, `name`, `sys_cd`) VALUES
(10, '2023-04-05 03:20:16', '2023-04-05 03:20:16', '1', 'publish', 'aa', 'aaa', '', 'test', 'caters', '2');

-- --------------------------------------------------------

--
-- テーブルの構造 `multi_images`
--

CREATE TABLE `multi_images` (
  `id` int(11) NOT NULL,
  `info_content_id` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `multi_images`
--

INSERT INTO `multi_images` (`id`, `info_content_id`, `image`) VALUES
(3, 10, 'img_3_fc83b170-819a-448f-9b74-9fdade498304.jpeg'),
(4, 24, 'img_4_e50d9926-38f5-431e-a2c0-5ab5d7c00274.jpeg'),
(6, 27, 'img_6_7c0b453d-f65d-491a-8d43-ea7204921e2b.jpg'),
(7, 33, 'img_7_5ab09de7-55a1-438b-9733-eccf96a3e240.jpeg');

-- --------------------------------------------------------

--
-- テーブルの構造 `page_configs`
--

CREATE TABLE `page_configs` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `site_config_id` int(11) UNSIGNED NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `page_title` varchar(100) DEFAULT NULL,
  `slug` varchar(40) DEFAULT NULL,
  `header` text,
  `footer` text,
  `is_public_period` decimal(10,0) NOT NULL DEFAULT '0',
  `public_timer_mode` decimal(10,0) NOT NULL DEFAULT '0',
  `page_template_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `is_category` varchar(10) NOT NULL DEFAULT 'N',
  `is_category_sort` varchar(10) NOT NULL DEFAULT 'N',
  `is_category_multiple` decimal(10,0) NOT NULL DEFAULT '0',
  `is_category_multilevel` decimal(10,0) NOT NULL DEFAULT '0',
  `modified_category_role` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `max_multilevel` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `disable_position_order` decimal(10,0) NOT NULL DEFAULT '0',
  `disable_preview` decimal(10,0) NOT NULL DEFAULT '0',
  `is_auto_menu` decimal(10,0) NOT NULL DEFAULT '0',
  `list_style` decimal(10,0) NOT NULL DEFAULT '1',
  `root_dir_type` decimal(10,0) NOT NULL DEFAULT '0',
  `link_color` varchar(10) DEFAULT NULL,
  `admin_menu_role` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_approval` decimal(1,0) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `page_configs`
--

INSERT INTO `page_configs` (`id`, `created`, `modified`, `site_config_id`, `position`, `page_title`, `slug`, `header`, `footer`, `is_public_period`, `public_timer_mode`, `page_template_id`, `description`, `keywords`, `is_category`, `is_category_sort`, `is_category_multiple`, `is_category_multilevel`, `modified_category_role`, `max_multilevel`, `disable_position_order`, `disable_preview`, `is_auto_menu`, `list_style`, `root_dir_type`, `link_color`, `admin_menu_role`, `is_approval`) VALUES
(1, '2022-12-16 15:38:35', '2023-03-16 11:44:14', 1, 1, 'お知らせ', 'news', '', '', '0', '0', 0, '', '', 'Y', 'N', '0', '0', 0, 0, '0', '0', '1', '1', '0', '#000000', 99, '0');

-- --------------------------------------------------------

--
-- テーブルの構造 `page_config_extensions`
--

CREATE TABLE `page_config_extensions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `page_config_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `type` decimal(10,0) NOT NULL DEFAULT '0',
  `option_value` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(40) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `page_config_items`
--

CREATE TABLE `page_config_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `page_config_id` int(11) UNSIGNED NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parts_type` varchar(10) NOT NULL DEFAULT 'main',
  `item_key` varchar(40) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Y',
  `memo` varchar(100) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `sub_title` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `page_config_items`
--

INSERT INTO `page_config_items` (`id`, `created`, `modified`, `page_config_id`, `position`, `parts_type`, `item_key`, `status`, `memo`, `title`, `sub_title`) VALUES
(1, '2023-04-04 05:19:10', '2023-04-04 05:19:10', 1, 2, 'main', 'title', 'Y', '', '', ''),
(2, '2023-04-04 05:22:02', '2023-04-04 05:22:02', 1, 3, 'main', 'category', 'Y', '', '', ''),
(3, '2023-04-04 05:22:16', '2023-04-04 05:22:16', 1, 4, 'main', 'status', 'Y', '', '', ''),
(4, '2023-04-04 05:22:38', '2023-04-04 05:22:38', 1, 16, 'block', 'image', 'N', '', '', ''),
(5, '2023-04-04 05:22:50', '2023-04-04 05:22:50', 1, 6, 'block', 'content', 'Y', '', '', ''),
(6, '2023-04-04 05:23:45', '2023-04-04 05:23:45', 1, 9, 'block', 'title_h4', 'Y', '', '', ''),
(7, '2023-04-04 05:24:12', '2023-04-04 05:24:12', 1, 7, 'block', 'with_image', 'Y', '', '', ''),
(8, '2023-04-04 05:24:19', '2023-04-04 05:24:19', 1, 8, 'block', 'file', 'Y', '', '', ''),
(9, '2023-04-05 00:11:21', '2023-04-05 00:11:21', 1, 10, 'section', 'all', 'N', '', '', ''),
(10, '2023-04-05 00:12:26', '2023-04-05 00:12:26', 1, 11, 'main', 'meta', 'N', '', '', ''),
(11, '2023-04-05 00:13:23', '2023-04-05 00:13:23', 1, 12, 'main', 'hash_tag', 'N', '', '', ''),
(12, '2023-04-05 00:13:42', '2023-04-05 00:13:42', 1, 13, 'main', 'index_type', 'N', '', '', ''),
(13, '2023-04-05 00:27:01', '2023-04-05 00:27:01', 1, 14, 'main', 'image_title', 'N', '', '', ''),
(14, '2023-04-05 00:27:13', '2023-04-05 00:27:13', 1, 15, 'main', 'notes', 'N', '', '', ''),
(15, '2023-04-05 00:49:36', '2023-04-05 00:49:36', 1, 5, 'block', 'MULTI_IMAGE', 'Y', '', '', ''),
(16, '2023-04-06 09:37:39', '2023-04-06 09:42:44', 1, 1, 'block', 'title_h1', 'Y', '', '', ''),
(17, '2023-04-06 09:46:16', '2023-04-06 09:46:16', 1, 17, 'block', 'line', 'N', '', '', ''),
(18, '2023-04-07 01:17:34', '2023-04-07 01:17:34', 1, 18, 'main', 'image', 'N', '', '', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `schedules`
--

CREATE TABLE `schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `memo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `schedules`
--

INSERT INTO `schedules` (`id`, `created`, `modified`, `date`, `status`, `memo`) VALUES
(1, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-01', '1', NULL),
(2, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-02', '1', NULL),
(3, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-07', '1', NULL),
(4, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-08', '1', NULL),
(5, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-09', '1', NULL),
(6, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-14', '1', NULL),
(7, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-15', '1', NULL),
(8, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-21', '1', NULL),
(9, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-22', '1', NULL),
(10, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-28', '1', NULL),
(11, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-01-29', '1', NULL),
(12, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-02-04', '1', NULL),
(13, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-02-05', '1', NULL),
(14, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-02-11', '1', NULL),
(15, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-02-12', '1', NULL),
(16, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-02-18', '1', NULL),
(17, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-02-19', '1', NULL),
(18, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-02-23', '1', NULL),
(19, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-02-25', '1', NULL),
(20, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-02-26', '1', NULL),
(21, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-03-04', '1', NULL),
(22, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-03-05', '1', NULL),
(23, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-03-11', '1', NULL),
(24, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-03-12', '1', NULL),
(25, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-03-18', '1', NULL),
(26, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-03-19', '1', NULL),
(27, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-03-25', '1', NULL),
(28, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-03-26', '1', NULL),
(29, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-04-01', '1', NULL),
(30, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-04-02', '1', NULL),
(31, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-04-08', '1', NULL),
(32, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-04-09', '1', NULL),
(33, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-04-15', '1', NULL),
(34, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-04-16', '1', NULL),
(35, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-04-22', '1', NULL),
(36, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-04-23', '1', NULL),
(37, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-04-29', '1', NULL),
(38, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-04-30', '1', NULL),
(39, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-05-03', '1', NULL),
(40, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-05-04', '1', NULL),
(41, '2023-04-05 00:18:12', '2023-04-05 00:18:12', '2023-05-05', '1', NULL),
(42, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-05-06', '1', NULL),
(43, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-05-07', '1', NULL),
(44, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-05-13', '1', NULL),
(45, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-05-14', '1', NULL),
(46, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-05-20', '1', NULL),
(47, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-05-21', '1', NULL),
(48, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-05-27', '1', NULL),
(49, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-05-28', '1', NULL),
(50, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-06-03', '1', NULL),
(51, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-06-04', '1', NULL),
(52, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-06-10', '1', NULL),
(53, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-06-11', '1', NULL),
(54, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-06-17', '1', NULL),
(55, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-06-18', '1', NULL),
(56, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-06-24', '1', NULL),
(57, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-06-25', '1', NULL),
(58, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-01', '1', NULL),
(59, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-02', '1', NULL),
(60, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-08', '1', NULL),
(61, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-09', '1', NULL),
(62, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-15', '1', NULL),
(63, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-16', '1', NULL),
(64, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-17', '1', NULL),
(65, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-22', '1', NULL),
(66, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-23', '1', NULL),
(67, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-29', '1', NULL),
(68, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-07-30', '1', NULL),
(69, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-08-05', '1', NULL),
(70, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-08-06', '1', NULL),
(71, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-08-11', '1', NULL),
(72, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-08-12', '1', NULL),
(73, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-08-13', '1', NULL),
(74, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-08-19', '1', NULL),
(75, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-08-20', '1', NULL),
(76, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-08-26', '1', NULL),
(77, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-08-27', '1', NULL),
(78, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-09-02', '1', NULL),
(79, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-09-03', '1', NULL),
(80, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-09-09', '1', NULL),
(81, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-09-10', '1', NULL),
(82, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-09-16', '1', NULL),
(83, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-09-17', '1', NULL),
(84, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-09-18', '1', NULL),
(85, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-09-23', '1', NULL),
(86, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-09-24', '1', NULL),
(87, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-09-30', '1', NULL),
(88, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-10-01', '1', NULL),
(89, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-10-07', '1', NULL),
(90, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-10-08', '1', NULL),
(91, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-10-09', '1', NULL),
(92, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-10-14', '1', NULL),
(93, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-10-15', '1', NULL),
(94, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-10-21', '1', NULL),
(95, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-10-22', '1', NULL),
(96, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-10-28', '1', NULL),
(97, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-10-29', '1', NULL),
(98, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-11-03', '1', NULL),
(99, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-11-04', '1', NULL),
(100, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-11-05', '1', NULL),
(101, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-11-11', '1', NULL),
(102, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-11-12', '1', NULL),
(103, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-11-18', '1', NULL),
(104, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-11-19', '1', NULL),
(105, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-11-23', '1', NULL),
(106, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-11-25', '1', NULL),
(107, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-11-26', '1', NULL),
(108, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-12-02', '1', NULL),
(109, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-12-03', '1', NULL),
(110, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-12-09', '1', NULL),
(111, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-12-10', '1', NULL),
(112, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-12-16', '1', NULL),
(113, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-12-17', '1', NULL),
(114, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-12-23', '1', NULL),
(115, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-12-24', '1', NULL),
(116, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-12-30', '1', NULL),
(117, '2023-04-05 00:18:13', '2023-04-05 00:18:13', '2023-12-31', '1', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `section_sequences`
--

CREATE TABLE `section_sequences` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `info_content_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `site_configs`
--

CREATE TABLE `site_configs` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'draft',
  `site_name` varchar(100) DEFAULT NULL,
  `slug` varchar(40) DEFAULT NULL,
  `is_root` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `site_configs`
--

INSERT INTO `site_configs` (`id`, `created`, `modified`, `position`, `status`, `site_name`, `slug`, `is_root`) VALUES
(1, '2022-12-16 13:55:04', '2022-12-16 13:55:04', 1, 'publish', '社会福祉法人 令和会', '', '1');

-- --------------------------------------------------------

--
-- テーブルの構造 `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tag` varchar(40) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `page_config_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `useradmins`
--

CREATE TABLE `useradmins` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `email` varchar(200) NOT NULL DEFAULT '',
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `temp_password` varchar(40) NOT NULL DEFAULT '',
  `temp_pass_expired` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
  `temp_key` varchar(200) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT 'publish',
  `face_image` varchar(100) NOT NULL DEFAULT '',
  `role` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `useradmins`
--

INSERT INTO `useradmins` (`id`, `created`, `modified`, `email`, `username`, `password`, `temp_password`, `temp_pass_expired`, `temp_key`, `name`, `status`, `face_image`, `role`) VALUES
(1, '2022-12-16 14:58:38', '2022-12-16 15:38:04', '', 'develop', '', 'caters040917', '1900-01-01 00:00:00', '', '開発', 'publish', 'img_1_33d0f62c-394d-405d-8d30-90ee39fb61fe.jpg', 0),
(2, '2023-03-16 11:47:47', '2023-03-16 11:47:47', '', 'editor', '$2y$10$L.SnwoM/4HxHYYtaqcKOfeDHyUl6b99R6X49iHpzNM7QBCpC0Btli', '', '1900-01-01 00:00:00', '', '編集者', 'publish', '', 20),
(3, '2023-03-16 16:58:57', '2023-03-16 16:58:57', '', 'authorizer', '$2y$10$pNE67sFXJrv0tHNlo1fh0ORRvkIFc135oxt9OXX/TVMujQNzgEUmu', '', '1900-01-01 00:00:00', '', '承認者', 'publish', '', 10),
(4, '2023-03-27 21:49:33', '2023-03-27 21:49:33', '', 'user', '', 'cms2023', '1900-01-01 00:00:00', '', '使用者', 'publish', '', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `useradmin_logs`
--

CREATE TABLE `useradmin_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `session_id` varchar(255) NOT NULL DEFAULT '',
  `useradmin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(200) NOT NULL DEFAULT '',
  `model_name` varchar(40) NOT NULL DEFAULT '',
  `model_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `page` varchar(60) NOT NULL DEFAULT '',
  `action` varchar(40) NOT NULL DEFAULT '',
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `useradmin_logs`
--

INSERT INTO `useradmin_logs` (`id`, `created`, `modified`, `session_id`, `useradmin_id`, `ip`, `model_name`, `model_id`, `page`, `action`, `detail`) VALUES
(1, '2023-04-04 08:56:22', '2023-04-04 08:56:22', 'seqrmmksasvcdlqasf6qorkhgu', 1, '127.0.0.1', 'PageConfigs', 0, 'PageConfigs:delete', '削除', '{\"id\":0,\"type\":\"content\",\"columns\":null,\"option\":{\"redirect\":null}}'),
(2, '2023-04-05 00:02:00', '2023-04-05 00:02:00', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigs', 3, 'PageConfigs:edit', '保存', '{\"mode\":\"update\"}'),
(3, '2023-04-05 00:11:21', '2023-04-05 00:11:21', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 0, 'PageConfigItems:edit', '保存', '{\"mode\":\"new\"}'),
(4, '2023-04-05 00:11:24', '2023-04-05 00:11:24', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 9, 'PageConfigItems:enable', '掲載/下書き', ''),
(5, '2023-04-05 00:12:26', '2023-04-05 00:12:26', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 0, 'PageConfigItems:edit', '保存', '{\"mode\":\"new\"}'),
(6, '2023-04-05 00:13:23', '2023-04-05 00:13:23', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 0, 'PageConfigItems:edit', '保存', '{\"mode\":\"new\"}'),
(7, '2023-04-05 00:13:42', '2023-04-05 00:13:42', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 0, 'PageConfigItems:edit', '保存', '{\"mode\":\"new\"}'),
(8, '2023-04-05 00:27:02', '2023-04-05 00:27:02', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 0, 'PageConfigItems:edit', '保存', '{\"mode\":\"new\"}'),
(9, '2023-04-05 00:27:13', '2023-04-05 00:27:13', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 0, 'PageConfigItems:edit', '保存', '{\"mode\":\"new\"}'),
(10, '2023-04-05 00:49:36', '2023-04-05 00:49:36', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 0, 'PageConfigItems:edit', '保存', '{\"mode\":\"new\"}'),
(11, '2023-04-05 00:49:49', '2023-04-05 00:49:49', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 15, 'PageConfigItems:position', '並び順変更', '{\"pos\":\"top\"}'),
(12, '2023-04-05 00:49:52', '2023-04-05 00:49:52', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 15, 'PageConfigItems:position', '並び順変更', '{\"pos\":\"down\"}'),
(13, '2023-04-05 00:49:53', '2023-04-05 00:49:53', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 15, 'PageConfigItems:position', '並び順変更', '{\"pos\":\"down\"}'),
(14, '2023-04-05 00:49:55', '2023-04-05 00:49:55', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 15, 'PageConfigItems:position', '並び順変更', '{\"pos\":\"down\"}'),
(15, '2023-04-05 00:49:57', '2023-04-05 00:49:57', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 15, 'PageConfigItems:position', '並び順変更', '{\"pos\":\"down\"}'),
(16, '2023-04-05 00:50:01', '2023-04-05 00:50:01', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 4, 'PageConfigItems:position', '並び順変更', '{\"pos\":\"bottom\"}'),
(17, '2023-04-05 00:50:04', '2023-04-05 00:50:04', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'PageConfigItems', 4, 'PageConfigItems:enable', '掲載/下書き', ''),
(18, '2023-04-05 01:31:29', '2023-04-05 01:31:29', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'Categories', 0, 'Categories:edit', '保存', '{\"mode\":\"new\"}'),
(19, '2023-04-05 01:35:00', '2023-04-05 01:35:00', '76lrushd9v9p4s7hqdlsneg97a', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(20, '2023-04-05 03:19:01', '2023-04-05 03:19:01', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'AppendItems', 0, 'AppendItems:edit', '保存', '{\"mode\":\"new\"}'),
(21, '2023-04-05 03:19:39', '2023-04-05 03:19:39', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'AppendItems', 15, 'AppendItems:edit', '保存', '{\"mode\":\"update\"}'),
(22, '2023-04-05 03:20:16', '2023-04-05 03:20:16', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'MstLists', 0, 'MstLists:edit', '保存', '{\"mode\":\"new\"}'),
(23, '2023-04-05 05:33:29', '2023-04-05 05:33:29', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(24, '2023-04-05 05:33:40', '2023-04-05 05:33:40', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(25, '2023-04-05 05:33:45', '2023-04-05 05:33:45', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(26, '2023-04-05 05:34:03', '2023-04-05 05:34:03', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(27, '2023-04-05 05:34:09', '2023-04-05 05:34:09', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(28, '2023-04-05 05:51:32', '2023-04-05 05:51:32', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(29, '2023-04-05 05:51:36', '2023-04-05 05:51:36', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(30, '2023-04-05 06:09:28', '2023-04-05 06:09:28', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(31, '2023-04-05 07:11:34', '2023-04-05 07:11:34', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(32, '2023-04-05 07:11:59', '2023-04-05 07:11:59', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(33, '2023-04-05 07:12:11', '2023-04-05 07:12:11', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(34, '2023-04-05 07:13:51', '2023-04-05 07:13:51', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(35, '2023-04-05 07:13:58', '2023-04-05 07:13:58', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 2, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(36, '2023-04-05 07:32:57', '2023-04-05 07:32:57', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 2, 'Infos:position', '並び順変更', '{\"pos\":\"down\"}'),
(37, '2023-04-05 07:32:59', '2023-04-05 07:32:59', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 2, 'Infos:position', '並び順変更', '{\"pos\":\"up\"}'),
(38, '2023-04-05 07:33:02', '2023-04-05 07:33:02', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 2, 'Infos:enable', '掲載/下書き', ''),
(39, '2023-04-05 07:33:06', '2023-04-05 07:33:06', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 2, 'Infos:enable', '掲載/下書き', ''),
(40, '2023-04-05 08:17:22', '2023-04-05 08:17:22', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 2, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(41, '2023-04-05 08:18:40', '2023-04-05 08:18:40', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 2, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(42, '2023-04-05 09:56:17', '2023-04-05 09:56:17', 'q291ei54gpu2rk4kchtr6nao43', 1, '127.0.0.1', 'Infos', 2, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(43, '2023-04-05 23:49:51', '2023-04-05 23:49:51', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(44, '2023-04-05 23:55:46', '2023-04-05 23:55:46', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(45, '2023-04-05 23:55:53', '2023-04-05 23:55:53', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 1, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(46, '2023-04-06 00:32:12', '2023-04-06 00:32:12', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Categories', 4, 'Categories:edit', '保存', '{\"mode\":\"update\"}'),
(47, '2023-04-06 00:32:34', '2023-04-06 00:32:34', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Categories', 0, 'Categories:edit', '保存', '{\"mode\":\"new\"}'),
(48, '2023-04-06 00:43:27', '2023-04-06 00:43:27', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(49, '2023-04-06 01:09:11', '2023-04-06 01:09:11', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(50, '2023-04-06 01:09:15', '2023-04-06 01:09:15', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(51, '2023-04-06 01:09:20', '2023-04-06 01:09:20', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(52, '2023-04-06 01:09:45', '2023-04-06 01:09:45', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(53, '2023-04-06 01:12:01', '2023-04-06 01:12:01', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 2, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(54, '2023-04-06 01:12:06', '2023-04-06 01:12:06', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 2, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(55, '2023-04-06 01:12:43', '2023-04-06 01:12:43', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(56, '2023-04-06 01:12:48', '2023-04-06 01:12:48', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(57, '2023-04-06 01:12:58', '2023-04-06 01:12:58', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(58, '2023-04-06 01:14:25', '2023-04-06 01:14:25', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 4, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(59, '2023-04-06 01:14:29', '2023-04-06 01:14:29', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 4, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(60, '2023-04-06 01:14:58', '2023-04-06 01:14:58', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 4, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(61, '2023-04-06 01:15:04', '2023-04-06 01:15:04', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 4, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(62, '2023-04-06 01:15:08', '2023-04-06 01:15:08', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 4, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(63, '2023-04-06 01:15:14', '2023-04-06 01:15:14', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 4, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(64, '2023-04-06 01:24:11', '2023-04-06 01:24:11', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 4, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(65, '2023-04-06 01:26:20', '2023-04-06 01:26:20', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 4, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(66, '2023-04-06 01:26:24', '2023-04-06 01:26:24', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 4, 'Infos:enable', '掲載/下書き', ''),
(67, '2023-04-06 01:26:31', '2023-04-06 01:26:31', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 4, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(68, '2023-04-06 08:36:23', '2023-04-06 08:36:23', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 3, 'Infos:enable', '掲載/下書き', ''),
(69, '2023-04-06 08:36:34', '2023-04-06 08:36:34', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 2, 'Infos:enable', '掲載/下書き', ''),
(70, '2023-04-06 09:04:26', '2023-04-06 09:04:26', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(71, '2023-04-06 09:04:45', '2023-04-06 09:04:45', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(72, '2023-04-06 09:05:15', '2023-04-06 09:05:15', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(73, '2023-04-06 09:06:34', '2023-04-06 09:06:34', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 7, 'Infos:enable', '掲載/下書き', ''),
(74, '2023-04-06 09:35:06', '2023-04-06 09:35:06', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 5, 'Infos:position', '並び順変更', '{\"pos\":\"top\"}'),
(75, '2023-04-06 09:36:28', '2023-04-06 09:36:28', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'PageConfigs', 0, 'PageConfigs:delete', '削除', '{\"id\":0,\"type\":\"content\",\"columns\":null,\"option\":{\"redirect\":null}}'),
(76, '2023-04-06 09:37:39', '2023-04-06 09:37:39', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'PageConfigItems', 0, 'PageConfigItems:edit', '保存', '{\"mode\":\"new\"}'),
(77, '2023-04-06 09:42:45', '2023-04-06 09:42:45', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'PageConfigItems', 16, 'PageConfigItems:edit', '保存', '{\"mode\":\"update\"}'),
(78, '2023-04-06 09:44:21', '2023-04-06 09:44:21', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'PageConfigItems', 16, 'PageConfigItems:position', '並び順変更', '{\"pos\":\"top\"}'),
(79, '2023-04-06 09:44:32', '2023-04-06 09:44:32', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'PageConfigItems', 6, 'PageConfigItems:enable', '掲載/下書き', ''),
(80, '2023-04-06 09:44:36', '2023-04-06 09:44:36', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'PageConfigItems', 6, 'PageConfigItems:position', '並び順変更', '{\"pos\":\"down\"}'),
(81, '2023-04-06 09:44:38', '2023-04-06 09:44:38', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'PageConfigItems', 6, 'PageConfigItems:position', '並び順変更', '{\"pos\":\"down\"}'),
(82, '2023-04-06 09:44:57', '2023-04-06 09:44:57', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'PageConfigItems', 6, 'PageConfigItems:enable', '掲載/下書き', ''),
(83, '2023-04-06 09:46:16', '2023-04-06 09:46:16', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'PageConfigItems', 0, 'PageConfigItems:edit', '保存', '{\"mode\":\"new\"}'),
(84, '2023-04-06 09:48:45', '2023-04-06 09:48:45', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 5, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(85, '2023-04-06 09:53:27', '2023-04-06 09:53:27', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 5, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(86, '2023-04-06 09:57:05', '2023-04-06 09:57:05', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 5, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(87, '2023-04-06 10:00:04', '2023-04-06 10:00:04', '3hija9aq7apu1t1s9h81jpghmi', 1, '127.0.0.1', 'Infos', 5, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(88, '2023-04-07 00:03:25', '2023-04-07 00:03:25', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 5, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(89, '2023-04-07 00:14:03', '2023-04-07 00:14:03', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 5, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(90, '2023-04-07 00:16:43', '2023-04-07 00:16:43', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 5, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(91, '2023-04-07 00:18:35', '2023-04-07 00:18:35', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 5, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(92, '2023-04-07 00:19:17', '2023-04-07 00:19:17', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 7, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(93, '2023-04-07 00:24:02', '2023-04-07 00:24:02', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 7, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(94, '2023-04-07 00:26:13', '2023-04-07 00:26:13', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 5, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(95, '2023-04-07 00:29:23', '2023-04-07 00:29:23', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 5, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(96, '2023-04-07 00:30:06', '2023-04-07 00:30:06', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 7, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(97, '2023-04-07 00:31:02', '2023-04-07 00:31:02', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 7, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(98, '2023-04-07 00:32:51', '2023-04-07 00:32:51', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(99, '2023-04-07 00:33:25', '2023-04-07 00:33:25', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 8, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(100, '2023-04-07 00:41:47', '2023-04-07 00:41:47', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(101, '2023-04-07 00:44:34', '2023-04-07 00:44:34', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 9, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(102, '2023-04-07 01:08:34', '2023-04-07 01:08:34', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 8, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(103, '2023-04-07 01:12:54', '2023-04-07 01:12:54', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 8, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(104, '2023-04-07 01:13:22', '2023-04-07 01:13:22', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 8, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(105, '2023-04-07 01:13:54', '2023-04-07 01:13:54', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 8, 'Infos:position', '並び順変更', '{\"pos\":\"top\"}'),
(106, '2023-04-07 01:17:13', '2023-04-07 01:17:13', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(107, '2023-04-07 01:17:34', '2023-04-07 01:17:34', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'PageConfigItems', 0, 'PageConfigItems:edit', '保存', '{\"mode\":\"new\"}'),
(108, '2023-04-07 01:17:55', '2023-04-07 01:17:55', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 10, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(109, '2023-04-07 01:19:06', '2023-04-07 01:19:06', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(110, '2023-04-07 01:22:43', '2023-04-07 01:22:43', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(111, '2023-04-07 01:25:35', '2023-04-07 01:25:35', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(112, '2023-04-07 01:25:37', '2023-04-07 01:25:37', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(113, '2023-04-07 01:35:54', '2023-04-07 01:35:54', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(114, '2023-04-07 01:36:09', '2023-04-07 01:36:09', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 15, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(115, '2023-04-07 01:41:35', '2023-04-07 01:41:35', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 8, 'Infos:position', '並び順変更', '{\"pos\":\"top\"}'),
(116, '2023-04-07 01:52:39', '2023-04-07 01:52:39', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 9, 'Infos:enable', '掲載/下書き', ''),
(117, '2023-04-07 02:06:41', '2023-04-07 02:06:41', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 9, 'Infos:enable', '掲載/下書き', ''),
(118, '2023-04-07 02:22:35', '2023-04-07 02:22:35', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:delete', '削除', '{\"id\":0,\"type\":\"content\",\"columns\":null,\"option\":{\"redirect\":{\"action\":\"index\",\"?\":{\"sch_page_id\":\"1\",\"parent_id\":null,\"sch_category_id\":0,\"sch_status\":null,\"sch_words\":null,\"pos\":\"368\"}}}}'),
(119, '2023-04-07 02:28:48', '2023-04-07 02:28:48', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:delete', '削除', '{\"id\":0,\"type\":\"content\",\"columns\":null,\"option\":{\"redirect\":{\"action\":\"index\",\"?\":{\"sch_page_id\":\"1\",\"parent_id\":null,\"sch_category_id\":0,\"sch_status\":null,\"sch_words\":null,\"pos\":0}}}}'),
(120, '2023-04-07 02:29:44', '2023-04-07 02:29:44', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:delete', '削除', '{\"id\":0,\"type\":\"content\",\"columns\":null,\"option\":{\"redirect\":{\"action\":\"index\",\"?\":{\"sch_page_id\":\"1\",\"parent_id\":null,\"sch_category_id\":0,\"sch_status\":null,\"sch_words\":null,\"pos\":0}}}}'),
(121, '2023-04-07 02:30:07', '2023-04-07 02:30:07', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 2, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(122, '2023-04-07 02:30:19', '2023-04-07 02:30:19', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:delete', '削除', '{\"id\":0,\"type\":\"content\",\"columns\":null,\"option\":{\"redirect\":{\"action\":\"index\",\"?\":{\"sch_page_id\":\"1\",\"parent_id\":null,\"sch_category_id\":0,\"sch_status\":null,\"sch_words\":null,\"pos\":0}}}}'),
(123, '2023-04-07 02:31:26', '2023-04-07 02:31:26', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(124, '2023-04-07 02:31:36', '2023-04-07 02:31:36', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 4, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(125, '2023-04-07 02:31:54', '2023-04-07 02:31:54', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 6, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(126, '2023-04-07 02:32:46', '2023-04-07 02:32:46', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 5, 'Infos:enable', '掲載/下書き', ''),
(127, '2023-04-07 02:33:34', '2023-04-07 02:33:34', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 5, 'Infos:enable', '掲載/下書き', ''),
(128, '2023-04-07 02:34:10', '2023-04-07 02:34:10', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(129, '2023-04-07 02:39:05', '2023-04-07 02:39:05', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 13, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(130, '2023-04-07 02:40:08', '2023-04-07 02:40:08', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 13, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(131, '2023-04-07 02:45:01', '2023-04-07 02:45:01', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:position', '並び順変更', '{\"pos\":\"top\"}'),
(132, '2023-04-07 02:45:28', '2023-04-07 02:45:28', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(133, '2023-04-07 02:47:34', '2023-04-07 02:47:34', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(134, '2023-04-07 03:03:39', '2023-04-07 03:03:39', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(135, '2023-04-07 03:04:24', '2023-04-07 03:04:24', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(136, '2023-04-07 03:04:41', '2023-04-07 03:04:41', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(137, '2023-04-07 03:15:16', '2023-04-07 03:15:16', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 13, 'Infos:enable', '掲載/下書き', ''),
(138, '2023-04-07 03:15:21', '2023-04-07 03:15:21', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 13, 'Infos:enable', '掲載/下書き', ''),
(139, '2023-04-07 03:16:18', '2023-04-07 03:16:18', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:enable', '掲載/下書き', ''),
(140, '2023-04-07 03:16:20', '2023-04-07 03:16:20', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:enable', '掲載/下書き', ''),
(141, '2023-04-07 03:31:24', '2023-04-07 03:31:24', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 9, 'Infos:enable', '掲載/下書き', ''),
(142, '2023-04-07 03:34:46', '2023-04-07 03:34:46', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 11, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(143, '2023-04-07 03:35:05', '2023-04-07 03:35:05', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 11, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(144, '2023-04-07 05:07:18', '2023-04-07 05:07:18', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 13, 'Infos:enable', '掲載/下書き', ''),
(145, '2023-04-07 05:07:23', '2023-04-07 05:07:23', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 13, 'Infos:enable', '掲載/下書き', ''),
(146, '2023-04-07 05:16:20', '2023-04-07 05:16:20', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(147, '2023-04-07 05:22:49', '2023-04-07 05:22:49', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(148, '2023-04-07 05:26:25', '2023-04-07 05:26:25', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(149, '2023-04-07 05:32:03', '2023-04-07 05:32:03', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 16, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(150, '2023-04-07 05:40:49', '2023-04-07 05:40:49', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 16, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(151, '2023-04-07 05:45:36', '2023-04-07 05:45:36', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 16, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(152, '2023-04-07 05:47:01', '2023-04-07 05:47:01', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 16, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(153, '2023-04-07 05:47:52', '2023-04-07 05:47:52', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 16, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(154, '2023-04-07 05:48:37', '2023-04-07 05:48:37', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 16, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(155, '2023-04-07 05:54:14', '2023-04-07 05:54:14', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 16, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(156, '2023-04-07 05:55:30', '2023-04-07 05:55:30', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 16, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(157, '2023-04-07 05:56:02', '2023-04-07 05:56:02', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 16, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(158, '2023-04-07 07:44:05', '2023-04-07 07:44:05', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 16, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(159, '2023-04-07 08:22:26', '2023-04-07 08:22:26', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 7, 'Infos:position', '並び順変更', '{\"pos\":\"top\"}'),
(160, '2023-04-07 08:23:16', '2023-04-07 08:23:16', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 12, 'Infos:position', '並び順変更', '{\"pos\":\"top\"}'),
(161, '2023-04-07 08:25:28', '2023-04-07 08:25:28', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 5, 'Infos:enable', '掲載/下書き', ''),
(162, '2023-04-07 08:25:35', '2023-04-07 08:25:35', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 9, 'Infos:enable', '掲載/下書き', ''),
(163, '2023-04-07 08:26:07', '2023-04-07 08:26:07', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 13, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(164, '2023-04-07 08:26:26', '2023-04-07 08:26:26', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 11, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(165, '2023-04-07 08:28:23', '2023-04-07 08:28:23', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(166, '2023-04-07 08:28:58', '2023-04-07 08:28:58', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 6, 'Infos:enable', '掲載/下書き', ''),
(167, '2023-04-07 08:29:04', '2023-04-07 08:29:04', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 17, 'Infos:enable', '掲載/下書き', ''),
(168, '2023-04-07 08:29:21', '2023-04-07 08:29:21', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 3, 'Infos:enable', '掲載/下書き', ''),
(169, '2023-04-07 08:29:55', '2023-04-07 08:29:55', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 17, 'Infos:enable', '掲載/下書き', ''),
(170, '2023-04-07 08:32:50', '2023-04-07 08:32:50', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 13, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(171, '2023-04-07 08:41:53', '2023-04-07 08:41:53', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 13, 'Infos:position', '並び順変更', '{\"pos\":\"up\"}'),
(172, '2023-04-07 08:41:58', '2023-04-07 08:41:58', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 13, 'Infos:position', '並び順変更', '{\"pos\":\"up\"}'),
(173, '2023-04-07 08:42:04', '2023-04-07 08:42:04', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 7, 'Infos:position', '並び順変更', '{\"pos\":\"down\"}'),
(174, '2023-04-07 08:42:54', '2023-04-07 08:42:54', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 9, 'Infos:position', '並び順変更', '{\"pos\":\"up\"}'),
(175, '2023-04-07 08:43:00', '2023-04-07 08:43:00', '3r245703bl06nu9f67du0giu50', 1, '127.0.0.1', 'Infos', 9, 'Infos:position', '並び順変更', '{\"pos\":\"up\"}'),
(176, '2023-04-10 01:02:03', '2023-04-10 01:02:03', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(177, '2023-04-10 01:02:23', '2023-04-10 01:02:23', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(178, '2023-04-10 01:02:32', '2023-04-10 01:02:32', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(179, '2023-04-10 01:11:27', '2023-04-10 01:11:27', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(180, '2023-04-10 01:11:39', '2023-04-10 01:11:39', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(181, '2023-04-10 01:20:24', '2023-04-10 01:20:24', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(182, '2023-04-10 01:20:25', '2023-04-10 01:20:25', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(183, '2023-04-10 01:21:26', '2023-04-10 01:21:26', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(184, '2023-04-10 01:24:15', '2023-04-10 01:24:15', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(185, '2023-04-10 01:25:22', '2023-04-10 01:25:22', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(186, '2023-04-10 01:27:54', '2023-04-10 01:27:54', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(187, '2023-04-10 01:36:57', '2023-04-10 01:36:57', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(188, '2023-04-10 01:38:03', '2023-04-10 01:38:03', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(189, '2023-04-10 01:40:36', '2023-04-10 01:40:36', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(190, '2023-04-10 01:55:41', '2023-04-10 01:55:41', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(191, '2023-04-10 01:55:56', '2023-04-10 01:55:56', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(192, '2023-04-10 01:56:22', '2023-04-10 01:56:22', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(193, '2023-04-10 01:57:34', '2023-04-10 01:57:34', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(194, '2023-04-10 02:00:24', '2023-04-10 02:00:24', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(195, '2023-04-10 02:00:45', '2023-04-10 02:00:45', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(196, '2023-04-10 02:02:09', '2023-04-10 02:02:09', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(197, '2023-04-10 02:02:29', '2023-04-10 02:02:29', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(198, '2023-04-10 02:02:45', '2023-04-10 02:02:45', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(199, '2023-04-10 02:10:55', '2023-04-10 02:10:55', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(200, '2023-04-10 02:11:07', '2023-04-10 02:11:07', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(201, '2023-04-10 02:33:15', '2023-04-10 02:33:15', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(202, '2023-04-10 02:33:20', '2023-04-10 02:33:20', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(203, '2023-04-10 02:33:53', '2023-04-10 02:33:53', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(204, '2023-04-10 02:40:45', '2023-04-10 02:40:45', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(205, '2023-04-10 02:41:03', '2023-04-10 02:41:03', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(206, '2023-04-10 02:52:29', '2023-04-10 02:52:29', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 13, 'Infos:enable', '掲載/下書き', ''),
(207, '2023-04-10 03:08:22', '2023-04-10 03:08:22', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 13, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(208, '2023-04-10 03:21:03', '2023-04-10 03:21:03', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(209, '2023-04-10 03:21:34', '2023-04-10 03:21:34', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 17, 'Infos:enable', '掲載/下書き', ''),
(210, '2023-04-10 03:25:55', '2023-04-10 03:25:55', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 13, 'Infos:enable', '掲載/下書き', ''),
(211, '2023-04-10 03:25:58', '2023-04-10 03:25:58', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 3, 'Infos:enable', '掲載/下書き', ''),
(212, '2023-04-10 03:29:59', '2023-04-10 03:29:59', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 3, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(213, '2023-04-10 05:28:16', '2023-04-10 05:28:16', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 0, 'Infos:edit', '保存', '{\"mode\":\"new\"}'),
(214, '2023-04-10 05:34:49', '2023-04-10 05:34:49', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(215, '2023-04-10 05:35:50', '2023-04-10 05:35:50', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(216, '2023-04-10 05:36:22', '2023-04-10 05:36:22', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(217, '2023-04-10 05:36:56', '2023-04-10 05:36:56', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(218, '2023-04-10 05:37:31', '2023-04-10 05:37:31', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(219, '2023-04-10 05:41:04', '2023-04-10 05:41:04', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(220, '2023-04-10 05:41:11', '2023-04-10 05:41:11', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(221, '2023-04-10 05:43:58', '2023-04-10 05:43:58', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(222, '2023-04-10 05:48:58', '2023-04-10 05:48:58', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(223, '2023-04-10 05:50:58', '2023-04-10 05:50:58', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(224, '2023-04-10 08:38:41', '2023-04-10 08:38:41', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(225, '2023-04-10 08:40:22', '2023-04-10 08:40:22', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(226, '2023-04-10 08:41:14', '2023-04-10 08:41:14', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 18, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(227, '2023-04-10 08:52:13', '2023-04-10 08:52:13', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 13, 'Infos:edit', '保存', '{\"mode\":\"update\"}'),
(228, '2023-04-10 08:52:18', '2023-04-10 08:52:18', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 11, 'Infos:enable', '掲載/下書き', ''),
(229, '2023-04-10 08:56:27', '2023-04-10 08:56:27', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 3, 'Infos:enable', '掲載/下書き', ''),
(230, '2023-04-10 08:57:31', '2023-04-10 08:57:31', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 11, 'Infos:enable', '掲載/下書き', ''),
(231, '2023-04-10 09:26:08', '2023-04-10 09:26:08', 'ibfquj1vcalbmalgs0l759lv0u', 1, '127.0.0.1', 'Infos', 12, 'Infos:position', '並び順変更', '{\"pos\":\"top\"}');

-- --------------------------------------------------------

--
-- テーブルの構造 `useradmin_sites`
--

CREATE TABLE `useradmin_sites` (
  `id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `useradmin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `site_config_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `useradmin_sites`
--

INSERT INTO `useradmin_sites` (`id`, `created`, `modified`, `useradmin_id`, `site_config_id`) VALUES
(1, '2022-12-16 15:38:04', '2022-12-16 15:38:04', 1, 1),
(2, '2023-03-16 16:58:57', '2023-03-16 16:58:57', 2, 1),
(3, '2023-03-16 16:58:57', '2023-03-16 16:58:57', 3, 1),
(4, '2023-03-27 21:49:33', '2023-03-27 21:49:33', 4, 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- テーブルのインデックス `append_items`
--
ALTER TABLE `append_items`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `infos`
--
ALTER TABLE `infos`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `info_append_items`
--
ALTER TABLE `info_append_items`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `info_categories`
--
ALTER TABLE `info_categories`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `info_contents`
--
ALTER TABLE `info_contents`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `info_stock_tables`
--
ALTER TABLE `info_stock_tables`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `info_tags`
--
ALTER TABLE `info_tags`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `info_tops`
--
ALTER TABLE `info_tops`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `kvs`
--
ALTER TABLE `kvs`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `mst_lists`
--
ALTER TABLE `mst_lists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sys_cd` (`sys_cd`,`slug`,`ltrl_cd`),
  ADD KEY `sys_cd_2` (`sys_cd`,`slug`);

--
-- テーブルのインデックス `multi_images`
--
ALTER TABLE `multi_images`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `page_configs`
--
ALTER TABLE `page_configs`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `page_config_extensions`
--
ALTER TABLE `page_config_extensions`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `page_config_items`
--
ALTER TABLE `page_config_items`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- テーブルのインデックス `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `section_sequences`
--
ALTER TABLE `section_sequences`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `site_configs`
--
ALTER TABLE `site_configs`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `useradmins`
--
ALTER TABLE `useradmins`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `useradmin_logs`
--
ALTER TABLE `useradmin_logs`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `useradmin_sites`
--
ALTER TABLE `useradmin_sites`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `append_items`
--
ALTER TABLE `append_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- テーブルの AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `infos`
--
ALTER TABLE `infos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- テーブルの AUTO_INCREMENT `info_append_items`
--
ALTER TABLE `info_append_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `info_categories`
--
ALTER TABLE `info_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `info_contents`
--
ALTER TABLE `info_contents`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- テーブルの AUTO_INCREMENT `info_stock_tables`
--
ALTER TABLE `info_stock_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `info_tags`
--
ALTER TABLE `info_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `info_tops`
--
ALTER TABLE `info_tops`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `kvs`
--
ALTER TABLE `kvs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `mst_lists`
--
ALTER TABLE `mst_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `multi_images`
--
ALTER TABLE `multi_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルの AUTO_INCREMENT `page_configs`
--
ALTER TABLE `page_configs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `page_config_extensions`
--
ALTER TABLE `page_config_extensions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `page_config_items`
--
ALTER TABLE `page_config_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- テーブルの AUTO_INCREMENT `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- テーブルの AUTO_INCREMENT `section_sequences`
--
ALTER TABLE `section_sequences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `site_configs`
--
ALTER TABLE `site_configs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `useradmins`
--
ALTER TABLE `useradmins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `useradmin_logs`
--
ALTER TABLE `useradmin_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- テーブルの AUTO_INCREMENT `useradmin_sites`
--
ALTER TABLE `useradmin_sites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
