-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2021 at 05:22 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dp_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id` int(11) NOT NULL,
  `id_surat_masuk` int(11) NOT NULL,
  `perihal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batas_waktu` date NOT NULL,
  `catatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id`, `id_surat_masuk`, `perihal`, `tujuan`, `isi`, `sifat`, `batas_waktu`, `catatan`, `created_at`) VALUES
(16, 6, 'baksos', 'lurah', 'Test Dispo', 'Rahasia', '2021-02-12', 'Kasi Administrasi', '2021-02-11'),
(17, 6, 'aqiqah', 'lurah', 'Test Dispo', 'Segera', '2021-02-13', 'Sekertaris', '2021-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `front_blog`
--

CREATE TABLE `front_blog` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `front_blog`
--

INSERT INTO `front_blog` (`id`, `id_kategori`, `title`, `content`, `image`, `created_by`, `created_at`) VALUES
(1, 1, 'TEST', 'Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.\r\n                  Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.', 'blog-1.jpg', 'Dede Pankez', '2021-02-12'),
(6, 1, 'Wibu Adalah Jalan Hidupku !!', '<p>wikwik</p>\r\n', 'desain-kamar-otaku.jpg', 'Dede Pankez', '2021-02-13');

-- --------------------------------------------------------

--
-- Table structure for table `front_config`
--

CREATE TABLE `front_config` (
  `id` int(11) NOT NULL,
  `web_title` varchar(255) NOT NULL,
  `jalan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `about2` text NOT NULL,
  `about_image` varchar(255) NOT NULL,
  `map` varchar(255) NOT NULL,
  `access_comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `front_config`
--

INSERT INTO `front_config` (`id`, `web_title`, `jalan`, `kecamatan`, `kabupaten`, `provinsi`, `email`, `telp`, `about`, `about2`, `about_image`, `map`, `access_comment`) VALUES
(1, 'DP FRONTEND', 'Jln. Ki hajar Dewantara No 13', 'Batanghari', 'Metro Timur', 'Lampung', 'dpcms74@gmail.com', '082281196819', '<p>DP Front END Adalah Sebuah Aplikasi Frontend yang bertujuan untuk membangun frontend website secara cepat. Fitur Menu dan Semua Config Bisa Diatur Secara Dinamis di Backend.</p>\r\n', '<p>DP Front END Adalah Sebuah Aplikasi Frontend yang bertujuan untuk membangun frontend website secara cepat. Fitur Menu dan Semua Config Bisa Diatur Secara Dinamis di Backend. DP Front END Adalah Sebuah Aplikasi Frontend yang bertujuan untuk membangun frontend website secara cepat. Fitur Menu dan Semua Config Bisa Diatur Secara Dinamis di Backend. DP Front END Adalah Sebuah Aplikasi Frontend yang bertujuan untuk membangun frontend website secara cepat. Fitur Menu dan Semua Config Bisa Diatur Secara Dinamis di Backend.</p>\r\n', 'mahitam.jpg', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `front_kategori`
--

CREATE TABLE `front_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `front_kategori`
--

INSERT INTO `front_kategori` (`id`, `kategori`) VALUES
(1, 'DP FRONTEND'),
(2, 'FULL STACK DEVELOPER');

-- --------------------------------------------------------

--
-- Table structure for table `front_menu`
--

CREATE TABLE `front_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `front_menu`
--

INSERT INTO `front_menu` (`id`, `menu`, `status`, `url`, `sort`) VALUES
(1, 'Blog', 0, 'blog', 1),
(2, 'About', 0, 'about', 2),
(3, 'Contact', 0, 'contact', 3),
(4, 'Team', 0, 'team', 4),
(9, 'profil aku', 1, 'profilaku', 5),
(10, 'tes', 1, 'fasilitas', 6);

-- --------------------------------------------------------

--
-- Table structure for table `front_quote`
--

CREATE TABLE `front_quote` (
  `id` int(11) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `motto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `front_quote`
--

INSERT INTO `front_quote` (`id`, `visi`, `misi`, `motto`) VALUES
(1, '<p>Menjadi Fullstack Developer Agar Dapat Menguasai Keseluruhan Backend,Frontend Dan Server.</p>\r\n', '<p>Membangun Backend dan Frontend Sendiri, Menciptakan Source Procedure Agar Dapat Customed Langsung Dengan Cepat Tanpa Harus Banyak Melakukan Pengkodingan Serta Menguasai JSON, JavaScript, Datatables, HTML, CSS, SQL Framwork Codeigniter dan Bootstrap</p>\r\n', '<p>Aku Tidak Akan Melakukan Apa yang tidak harus kulakukan, Karna Hemat Energi itu Baik. Akan tetapi apabila harus dilakukan maka akan segera kuselesaikan.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `front_slider`
--

CREATE TABLE `front_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title2` varchar(255) NOT NULL,
  `subtitle2` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `title3` varchar(255) NOT NULL,
  `subtitle3` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `front_slider`
--

INSERT INTO `front_slider` (`id`, `title`, `subtitle`, `image`, `title2`, `subtitle2`, `image2`, `title3`, `subtitle3`, `image3`) VALUES
(1, 'WELCOME TO DP FRONTEND WEBSITE', '<p>DP Front END Adalah Sebuah Aplikasi Frontend yang bertujuan untuk membangun frontend website secara cepat. Fitur Menu dan Semua Config Bisa Diatur Secara Dinamis di Backend.</p>\r\n', 'slide-1.jpg', 'DEDE PANKEZ FRONTEND', '<p>DP Front END Adalah Sebuah Aplikasi Frontend yang bertujuan untuk membangun frontend website secara cepat. Fitur Menu dan Semua Config Bisa Diatur Secara Dinamis di Backend.</p>\r\n', 'slide-21.jpg', 'WELCOME TO DP FRONTEND SLIDER 3', '<p>DP Front END Adalah Sebuah Aplikasi Frontend yang bertujuan untuk membangun frontend website secara cepat. Fitur Menu dan Semua Config Bisa Diatur Secara Dinamis di Backend.</p>\r\n', 'slide-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `front_sosmed`
--

CREATE TABLE `front_sosmed` (
  `id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `front_sosmed`
--

INSERT INTO `front_sosmed` (`id`, `class`, `url`, `status`) VALUES
(1, 'whatsapp', '', 0),
(2, 'twitter', '', 0),
(3, 'facebook', 'www.facebook/dedepankez.com', 0),
(4, 'instagram', '', 0),
(5, 'telegram', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `front_team`
--

CREATE TABLE `front_team` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `whatapp` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `intagram` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `front_team`
--

INSERT INTO `front_team` (`id`, `name`, `job`, `about`, `whatapp`, `facebook`, `intagram`, `image`) VALUES
(1, 'Edo Pratama', 'Designer & Manager Marketing', 'DP Front END Adalah Sebuah Aplikasi Frontend yang bertujuan untuk membangun frontend website secara cepat. Fitur Menu dan Semua Config Bisa Diatur Secara Dinamis di Backend.', '', '', '', 'IMG_0676.JPG'),
(2, 'Dede Pankez', 'CEO & Developer Web', 'DP Front END Adalah Sebuah Aplikasi Frontend yang bertujuan untuk membangun frontend website secara cepat. Fitur Menu dan Semua Config Bisa Diatur Secara Dinamis di Backend.', '', '', '', 'dede.jpg'),
(4, 'Andika Saputra', 'Content Creator', 'DP Front END Adalah Sebuah Aplikasi Frontend yang bertujuan untuk membangun frontend website secara cepat. Fitur Menu dan Semua Config Bisa Diatur Secara Dinamis di Backend.', '', '', '', 'IMG_0758.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi`
--

CREATE TABLE `klasifikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `klasifikasi`
--

INSERT INTO `klasifikasi` (`id`, `nama`, `kode`, `uraian`, `created_at`) VALUES
(8, 'Pemerintah', 'A-3', '<p>Meriwayatkan Tentang Pemerintahan</p>\r\n', '2021-02-10'),
(11, 'Kelurahan', 'K-P', '<p>Disposisi Ke Pegawai Kelurahan</p>\r\n', '2021-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `site_config`
--

CREATE TABLE `site_config` (
  `id` int(11) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `icon_sidebar` varchar(255) NOT NULL,
  `site_title_user` varchar(255) NOT NULL,
  `icon_sidebar_user` varchar(255) NOT NULL,
  `theme_sidebar` varchar(255) NOT NULL,
  `theme_navbar` varchar(255) NOT NULL,
  `font_color` varchar(255) NOT NULL,
  `font_color_heading` varchar(255) NOT NULL,
  `jam_theme` varchar(255) NOT NULL,
  `jam_font` varchar(255) NOT NULL,
  `theme_sidebar_user` varchar(255) NOT NULL,
  `theme_navbar_user` varchar(255) NOT NULL,
  `font_color_user` varchar(255) NOT NULL,
  `font_color_heading_user` varchar(255) NOT NULL,
  `jam_theme_user` varchar(255) NOT NULL,
  `jam_font_user` varchar(255) NOT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `logo_instansi` varchar(255) NOT NULL,
  `email_instansi` varchar(255) NOT NULL,
  `telp_instansi` varchar(255) NOT NULL,
  `kepala_instansi` varchar(255) NOT NULL,
  `alamat_instansi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_config`
--

INSERT INTO `site_config` (`id`, `site_title`, `icon_sidebar`, `site_title_user`, `icon_sidebar_user`, `theme_sidebar`, `theme_navbar`, `font_color`, `font_color_heading`, `jam_theme`, `jam_font`, `theme_sidebar_user`, `theme_navbar_user`, `font_color_user`, `font_color_heading_user`, `jam_theme_user`, `jam_font_user`, `nama_instansi`, `logo_instansi`, `email_instansi`, `telp_instansi`, `kepala_instansi`, `alamat_instansi`) VALUES
(1, 'DP ADMIN', 'fas fa-laptop-code', 'User Panel', 'fas fa-user-cog', 'dark', 'white', 'text-white', 'text-info', 'btn-secondary', 'text-white', 'info', 'white', 'text-white', 'text-white', 'btn-info', 'text-white', ' Kelurahan Beban Keluarga', 'dinas1.png', ' syarif@gmail.com', ' 07257572151', ' Syarif Mahmudi Amd.Kom', 'Jln. Kihajar Dewantara No 12 Lampung Timur');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `jenis_surat` varchar(255) NOT NULL,
  `pemohon` varchar(255) NOT NULL,
  `dusun` varchar(255) NOT NULL,
  `rt` varchar(255) NOT NULL,
  `rw` varchar(255) NOT NULL,
  `pengelola` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `created_at`, `no_surat`, `jenis_surat`, `pemohon`, `dusun`, `rt`, `rw`, `pengelola`, `keterangan`, `file`) VALUES
(1, '2021-02-11', '21/545/121', 'Permohonan SKCK', 'Mukidi', 'BATANGHARI', '02', '03', 'Sekertaris', 'TES', 'Aqiqah_13.docx');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `id_kode` int(11) NOT NULL,
  `no_agenda` int(11) DEFAULT NULL,
  `pengirim` varchar(128) DEFAULT NULL,
  `kurir` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_surat` varchar(128) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `tgl_diterima` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `file` varchar(128) DEFAULT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `id_kode`, `no_agenda`, `pengirim`, `kurir`, `alamat`, `no_surat`, `isi`, `tgl_surat`, `tgl_diterima`, `keterangan`, `file`, `created_at`) VALUES
(4, 8, 787, 'Mentri Olahraga', 'Slamet', 'Gunung Sugih', '5657/2392', 'jkgkbkh', '2021-02-11', '2021-02-12', 'TES', 'download2.png', '2021-02-10'),
(6, 11, 3, 'Dinas Sosial', 'Mukidi', 'Berna', '21/545/121', 'Testing', '2021-02-11', '2021-02-11', 'TES', 'Aqiqah_12.docx', '2021-02-11'),
(7, 8, 14, 'Kelurahan Iring Mulyo', 'Klentip', 'Metro', '32131/12', 'Wacana Pendidikan Usaha Rakyat', '2021-02-10', '2021-02-11', 'Acara Tanggal 15/02/2021', 'Aqiqah_131.docx', '2021-02-11'),
(8, 8, 1078, 'Mentri Olahraga', 'Ujang', 'Metro', '21/545/124', 'popopo', '2021-02-10', '2021-02-11', '', 'dinas2.png', '2021-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Dede Pankez', 'pankeztheflexman@gmail.com', 'full_size_20150916094951.jpg', '$2y$10$KtcTnkrs1psBrRHFn9bRhuGqlaBD5BEPYmfoEZaPEbMDPOv2dKQ5O', 1, 1, 1574863801),
(23, 'Administrator', 'admin@admin.com', 'default.jpg', '$2y$10$iuKiNpzNltMJ/75aEncPneM3Ija75UV9ynqiYl5PHlzZeAsgYnLcW', 7, 1, 1613142194);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 1, 4),
(6, 2, 4),
(9, 1, 14),
(10, 4, 2),
(12, 4, 14),
(13, 3, 15),
(14, 1, 15),
(15, 4, 15),
(16, 1, 16),
(19, 2, 16),
(20, 3, 2),
(21, 3, 17),
(22, 4, 17),
(23, 1, 17),
(26, 3, 19),
(28, 6, 2),
(30, 3, 20),
(31, 3, 21),
(33, 1, 5),
(37, 7, 2),
(38, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Menu Frontend'),
(11, 'Module Crud'),
(19, 'Management Surat Masuk'),
(20, 'Management Surat Keluar'),
(21, 'Config Instansi');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Developer'),
(2, 'Member'),
(7, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`, `sort`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1, 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-id-card', 1, 7),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1, 8),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1, 2),
(5, 3, 'Submenu Management', 'menu/submenu', 'far  fa-fw fa-folder-open', 1, 3),
(6, 1, 'Role', 'admin/role', 'fab  fa-fw fa-critical-role', 1, 4),
(7, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1, 9),
(8, 1, 'User Account', 'admin/account', 'fa fa-microchip', 1, 5),
(11, 3, 'Sort Menu', 'menu/sort', 'far fa-window-restore', 1, 10),
(16, 11, 'Report Example', 'crud/filter', 'fa fa-book', 1, 12),
(41, 11, 'Crud Generator', 'crud', 'fa fa-id-card', 1, 36),
(45, 3, 'Site Config', 'admin/site_config', 'fas fa-laptop', 1, 40),
(46, 3, 'Widget Config', 'admin/widget_config', 'fas fa-text-width', 1, 41),
(47, 3, 'Site Config User', 'admin/site_config_user', 'fa fa-user', 1, 90),
(48, 3, 'Widget Config User', 'admin/widget_config_user', 'fa fa-cog', 1, 91),
(49, 11, 'Crud Examples', 'crud/example', 'far fa-window-restore', 1, 37),
(50, 19, 'Surat Masuk', 'surat_masuk', 'fas fa-share-square', 1, 38),
(51, 19, 'Disposisi', 'dispo', 'fas fa-random', 1, 39),
(52, 21, 'Klasifikasi', 'klasifikasi', 'fa fa-cog', 1, 100),
(53, 21, 'Instansi', 'instansi', 'fa fa-cog', 1, 101),
(54, 19, 'Buku Agenda Surat Masuk', 'surat_masuk/agenda', 'fa fa-book', 1, 102),
(55, 19, 'Report Period Surat Masuk', 'surat_masuk/filter_period', 'fa fa-book', 1, 103),
(56, 20, 'Surat Keluar', 'surat_keluar', 'fas fa-reply-all', 1, 104),
(57, 20, 'Buku Agenda Surat Keluar', 'surat_keluar/agenda', 'fa fa-book', 1, 105),
(58, 20, 'Report Period Surat Keluar', 'surat_keluar/filter_period', 'fa fa-book', 1, 106),
(59, 4, 'Front Config', 'frontend/front_config', 'fa fa-cog', 1, 200),
(60, 4, 'Front Menu', 'frontend_config/menu', 'fa fa-cog', 1, 201),
(61, 4, 'Front Slider', 'frontend_config/slider', 'fa fa-cog', 1, 202),
(62, 4, 'Front Sosmed', 'frontend_config/sosmed', 'fa fa-cog', 1, 203),
(64, 4, 'Front Team', 'frontend_config/team', 'fa fa-cog', 1, 204),
(65, 4, 'Front Quote', 'frontend_config/quote', 'fa fa-cog', 1, 205),
(66, 4, 'Front Kategori', 'frontend_config/blog/kategori_backend', 'fa fa-cog', 1, 206),
(67, 4, 'Front Blog', 'frontend_config/blog', 'fa fa-cog', 1, 207);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_blog`
--
ALTER TABLE `front_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_config`
--
ALTER TABLE `front_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_kategori`
--
ALTER TABLE `front_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_menu`
--
ALTER TABLE `front_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_quote`
--
ALTER TABLE `front_quote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_slider`
--
ALTER TABLE `front_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_sosmed`
--
ALTER TABLE `front_sosmed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_team`
--
ALTER TABLE `front_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_config`
--
ALTER TABLE `site_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `front_blog`
--
ALTER TABLE `front_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `front_config`
--
ALTER TABLE `front_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `front_kategori`
--
ALTER TABLE `front_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `front_menu`
--
ALTER TABLE `front_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `front_quote`
--
ALTER TABLE `front_quote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `front_slider`
--
ALTER TABLE `front_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `front_sosmed`
--
ALTER TABLE `front_sosmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `front_team`
--
ALTER TABLE `front_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `klasifikasi`
--
ALTER TABLE `klasifikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `site_config`
--
ALTER TABLE `site_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
