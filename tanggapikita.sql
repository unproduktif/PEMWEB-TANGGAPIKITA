-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2025 at 12:06 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tanggapikita`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` bigint UNSIGNED NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `jabatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'aktif', '2025-06-22 01:57:45', '2025-06-24 18:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `akuns`
--

CREATE TABLE `akuns` (
  `id_akun` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akuns`
--

INSERT INTO `akuns` (`id_akun`, `nama`, `email`, `password`, `foto`, `no_hp`, `alamat`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Samsul Widodo', 'admin@gmail.com', '$2y$12$GUWHo2UKa9RxXyCbwkITs.ybg3SUzoOtgdBUd5VVDFKfxXfz9z8h.', 'foto_admin/99lvgyDM6Kip34xsYyt3vr4evltSGHTMedok11mJ.png', '081234567890', 'Jln Lingkar Selatan No 45', 'admin', '2025-06-22 01:57:45', '2025-06-24 18:42:22'),
(2, 'makbulah alhamdallah', 'rizal@gmail.com', '$2y$12$F/uqa7hta7rGGFJ58Tr0MOzSOPRT0picQvHopYlUzdwfb0caPd2g6', 'foto_users/Ilhd025mSWFM2H8uOqobMXFQnl21sN3rNmkSEMJ4.png', '08196607993', 'Jln. Panji Anom no. 26', 'user', '2025-06-22 01:58:39', '2025-06-30 02:50:59'),
(3, 'Aditias Zulmatoriq', 'toriq@gmail.com', '$2y$12$qKZuIVAK8.Ryll35wr4nDO0T49BkWXEbhSHrn.6Ky7que36PdlLcK', NULL, '343434325242', 'vsvfvfvf', 'user', '2025-06-22 12:06:24', '2025-06-22 12:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `alokasi_danas`
--

CREATE TABLE `alokasi_danas` (
  `id_alokasidana` bigint UNSIGNED NOT NULL,
  `id_laporandonasi` bigint UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alokasi_danas`
--

INSERT INTO `alokasi_danas` (`id_alokasidana`, `id_laporandonasi`, `keterangan`, `tujuan`, `jumlah`, `created_at`, `updated_at`) VALUES
(2, 6, 'makawin', 'hfecuew', 1000000, '2025-06-24 13:18:22', '2025-06-24 13:18:22'),
(3, 7, 'Pembelian makanan pokok', 'Beras, minyak, gula, dan mie instan untuk 100 KK', 20000000, '2025-06-28 12:58:11', '2025-06-28 12:58:11'),
(4, 7, 'Bantuan medis', 'Pembelian obat-obatan dan alat kesehatan dasar', 20000000, '2025-06-28 12:58:11', '2025-06-28 12:58:11'),
(5, 7, 'Pakaian dan selimut', 'Pakaian layak dan selimut untuk pengungsi', 8000000, '2025-06-28 12:58:11', '2025-06-28 12:58:11'),
(6, 7, 'Transportasi dan logistik', 'Biaya pengiriman barang bantuan ke wilayah terdampak', 7000000, '2025-06-28 12:58:11', '2025-06-28 12:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donasis`
--

CREATE TABLE `donasis` (
  `id_donasi` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_laporan` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` bigint NOT NULL,
  `total` bigint NOT NULL DEFAULT '0',
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `status` enum('berlangsung','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'berlangsung',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donasis`
--

INSERT INTO `donasis` (`id_donasi`, `id_user`, `id_laporan`, `judul`, `deskripsi`, `target`, `total`, `tgl_mulai`, `tgl_selesai`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'bantuan untuk rizal', 'mau kawin', 150000000, 1000000, '2025-06-22', '2025-06-30', 'selesai', '2025-06-22 02:01:19', '2025-06-22 02:03:07'),
(2, 2, 2, 'bantuan untuk masyarakat palestina', 'rfejifoc', 50000000, 55000000, '2025-06-22', '2025-06-30', 'selesai', '2025-06-22 03:12:42', '2025-06-22 22:36:03'),
(3, 2, 4, 'Kebakaran Hebat di Kawasan Perumahan Jaya', 'ocendcuen;lijk', 15000000, 60000000, '2025-06-23', '2025-06-29', 'berlangsung', '2025-06-22 11:15:17', '2025-06-30 04:42:41'),
(4, 3, 7, 'Bantu Korban Kebakaran di Kawasan Perumahan Jaya', 'gvfroipuvjorpmv eivjjo[pvpmrk', 149999999, 156500000, '2025-06-24', '2025-07-01', 'berlangsung', '2025-06-24 06:39:25', '2025-06-30 06:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `edukasis`
--

CREATE TABLE `edukasis` (
  `id_edukasi` bigint UNSIGNED NOT NULL,
  `id_admin` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `edukasis`
--

INSERT INTO `edukasis` (`id_edukasi`, `id_admin`, `judul`, `konten`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 1, 'cdvk fk\' lvmf', 'vnk;vm kfl vfk olf', 'edukasi/tN04EbpMcpM6CJtnIHKBLCZHtt4L0GT8b5PuQeY4.jpg', '2025-06-24 17:22:56', '2025-06-24 17:22:56'),
(3, 1, 'kcd uipbjn;cjdio jkn;mx,clp;d', 'kjc kmlvmx mnikkzmvkc cmdo ,cmssj  n,vmk nvlcmsdk mcl.', 'edukasi/sLzxMIstAlVQZSjf6Nz1YxF8BIanHXFq59mcKsxV.jpg', '2025-06-24 17:23:17', '2025-06-24 17:23:17'),
(4, 1, 'konten 123', 'oiodvn xm m;kjcm jivvcsmclj jkmdvin', 'edukasi/YFsjcCbmeMXqE7RcZj0HhqCRWAnnaKcm13yGAb0g.jpg', '2025-06-24 17:23:37', '2025-06-30 02:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id_laporan` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_admin` bigint UNSIGNED DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` enum('Banjir','Gempa','Kebakaran','Tanah Longsor','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pendding','verifikasi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendding',
  `tgl_publish` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporans`
--

INSERT INTO `laporans` (`id_laporan`, `id_user`, `id_admin`, `judul`, `deskripsi`, `keterangan`, `lokasi`, `media`, `status`, `tgl_publish`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'Banjir Terjang Kampung Nelayan Sukamaju', 'rizal ganteng', 'Banjir', 'Kampung Nelayan Sukamaju', 'laporan/gjbPsw3D5baMLIWiJEKIa3JNxdH1GEK4UM8I5piY.jpg', 'verifikasi', NULL, '2025-06-22 01:59:36', '2025-06-22 10:41:30'),
(2, 2, NULL, 'Bantu Korban Banjir di Semarang', 'eefvwdvcd', 'Banjir', 'Desa Sukamaju, Kabupaten Sukamaju', 'laporan/eIo3VmzRRM2HQitf1HzWYbJ13KPOfkP47ayaJsom.jpg', 'verifikasi', NULL, '2025-06-22 03:09:23', '2025-06-22 03:10:02'),
(4, 2, NULL, 'Kebakaran Hutan di Wilayah X', 'hscbdi;uvdkvcndlk', 'Kebakaran', 'Jalan Hutan Raya, Desa Tunas Maju, Kecamatan Alam Selatan', 'laporan/AQJmmUkzYiMggMmigBqD1LAW3t81jYcIm65OqVMf.jpg', 'verifikasi', '2025-06-22 10:30:40', '2025-06-22 10:29:59', '2025-06-22 10:30:40'),
(7, 3, NULL, 'Kebakaran Hebat di Kawasan Perumahan Jaya', 'ufheuidciudnvc idelncjrkdcnfdrov im;fm lfdk', 'Kebakaran', 'Jalan Hutan Raya, Desa Tunas Maju, Kecamatan Alam Selatan', 'laporan/vD4EkjM7w6RN0GJH0IzQzXlI1RwwzzxB2Qwe5GnW.jpg', 'verifikasi', '2025-06-24 06:37:43', '2025-06-24 06:36:53', '2025-06-24 06:37:43'),
(8, 2, NULL, 'Kebakaran Hebat di Kawasan Perumahan Jaya', 'Terjadi kebakaran pada kawaksan perumahan jaya, yang memakan korban 5 jiwa', 'Kebakaran', 'Jalan Hutan Raya, Desa Tunas Maju, Kecamatan Alam Selatan', 'laporan/WXiODAUFYZuXhpTNuAO2F47oC8Z9TWhuhb3fp6Y8.jpg', 'verifikasi', '2025-06-25 12:15:17', '2025-06-25 12:14:33', '2025-06-25 12:15:17'),
(9, 2, NULL, 'Banjir di Kecamatan Mavora', 'contoh', 'Banjir', 'israel', 'laporan/grtewcygad4THN1QPHY7sNyQJDRfoiC3I5vK1Jkp.png', 'pendding', NULL, '2025-06-30 02:28:01', '2025-06-30 02:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_donasis`
--

CREATE TABLE `laporan_donasis` (
  `id_laporandonasi` bigint UNSIGNED NOT NULL,
  `id_donasi` bigint UNSIGNED NOT NULL,
  `id_admin` bigint UNSIGNED NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` bigint NOT NULL,
  `sisa` bigint NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_donasis`
--

INSERT INTO `laporan_donasis` (`id_laporandonasi`, `id_donasi`, `id_admin`, `deskripsi`, `total`, `sisa`, `tanggal`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 'ldcm,dl;cv,d', 1000000, 0, '2025-06-23 16:00:00', '2025-06-24 13:18:22', '2025-06-24 13:18:22'),
(7, 2, 1, 'Donasi \"Bantuan untuk Masyarakat Palestina\" berhasil mengumpulkan dana sebesar Rp 55.000.000. Dana tersebut dialokasikan untuk berbagai kebutuhan mendesak, seperti pembelian makanan pokok, bantuan medis, pakaian dan selimut, perlengkapan kebersihan, serta biaya transportasi dan logistik pengiriman bantuan. Hingga laporan ini dibuat pada tanggal 28 Juni 2025, total dana yang telah digunakan sebesar Rp 50.000.000, dan sisa dana sebesar Rp 5.000.000 masih tersedia untuk keperluan bantuan selanjutnya.', 55000000, 0, '2025-06-27 16:00:00', '2025-06-28 12:58:11', '2025-06-28 12:58:11');

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
(1, '2025_06_07_123428_create_akuns_table', 1),
(2, '2025_06_07_123438_create_admins_table', 1),
(3, '2025_06_07_123633_create_users_table', 1),
(4, '2025_06_07_123640_create_laporans_table', 1),
(5, '2025_06_07_123657_create_donasis_table', 1),
(6, '2025_06_07_123725_create_user_donasis_table', 1),
(7, '2025_06_07_123742_create_laporan_donasis_table', 1),
(8, '2025_06_07_123757_create_alokasi_danas_table', 1),
(9, '2025_06_07_124913_create_edukasis_table', 1),
(10, '2025_06_07_161018_create_sessions_table', 1),
(11, '2025_06_12_094231_create_cache_table', 1),
(12, '2025_06_22_210318_create_password_resets_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('dodi@gmail.com', 'pwZtRxTqxFCdg5lUZAYqqJ80KQUILLopFkcYh9BYe2Ks74oWEdlrdNWB5cuQu4Ve', '2025-06-22 13:13:45'),
('odyesanjaya03@gmail.com', 'WE4sECuNiByrkH15nMcdkCCrmlJrjVpZGsT8CEoMaZJ9EpSxNxbYN12J7HsSOU6S', '2025-06-22 13:14:35');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5bGetdhzoueuATwVA8rf8dsTAFiI3NkKsp4FCnWx', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMFlENmg3UXNmaDR5dWt5TmNvR3lnbUNNNHZWQWRkczVkZnVtQ0pMSCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1751975609),
('U97ToAqAD5LgUKgcyfrPFa8CHrBpVuTE2j4bExLz', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSmpweGV5eUZaWUg1MnhZbjEzdzJ1eXJkYlRmam11b3VZcGJzMWVKTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1751265827);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `kode_pos`, `kota`, `provinsi`, `created_at`, `updated_at`) VALUES
(2, '12345', 'Mataram', 'Nusa tenggara barat', '2025-06-22 01:58:39', '2025-06-22 01:58:39'),
(3, '86003', 'Lombok Timur', 'Nusa tenggara barat', '2025-06-22 12:06:24', '2025-06-22 12:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_donasis`
--

CREATE TABLE `user_donasis` (
  `id` bigint UNSIGNED NOT NULL,
  `id_donasi` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `metode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` bigint NOT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','settlement','cancel','expire','failure') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_donasis`
--

INSERT INTO `user_donasis` (`id`, `id_donasi`, `id_user`, `metode`, `jumlah`, `pesan`, `order_id`, `status`, `snap_token`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'bank_transfer', 1000000, NULL, 'DONASI-BJOIPIXMQH', 'settlement', 'a89a86b1-49fe-4768-8056-bd2943988f53', '2025-06-22 02:01:31', '2025-06-22 02:02:22'),
(2, 2, 2, 'bank_transfer', 50000000, 'semoga barokah', 'DONASI-YA8FFZWABY', 'settlement', '06c725f2-de52-43cb-aad1-2bbc23b80178', '2025-06-22 05:55:06', '2025-06-22 05:58:24'),
(3, 2, 2, 'bank_transfer', 1000000, 'semoga barokah', 'DONASI-GE89VA91BI', 'settlement', 'f1ea648a-7f34-48f5-963f-4b5e396f3512', '2025-06-22 06:08:56', '2025-06-22 06:16:25'),
(4, 2, 2, 'bank_transfer', 200000, NULL, 'DONASI-PHQFD8MV02', 'settlement', '619a20a1-d7ab-4526-9c4a-35c1c2acc7b8', '2025-06-22 06:20:29', '2025-06-22 06:21:16'),
(5, 2, 2, NULL, 15000000, 'Semoga ini bisa membantu', 'DONASI-4WS4HZIE99', 'pending', '306312f6-09cb-4e84-bae1-610cf4eaf1cd', '2025-06-22 08:19:46', '2025-06-22 08:19:48'),
(6, 2, 2, 'qris', 5000000, NULL, 'DONASI-RA2H7XTT6X', 'pending', 'df76fa68-c357-47bd-ac01-4a48c2026fca', '2025-06-22 08:41:57', '2025-06-22 08:42:07'),
(7, 2, 2, 'bank_transfer', 800000, NULL, 'DONASI-A7TCIZRYEQ', 'settlement', 'cf8d4b44-4017-444d-95de-eb7ce58a2855', '2025-06-22 08:44:48', '2025-06-22 08:45:11'),
(8, 2, 2, 'bank_transfer', 1000000, NULL, 'DONASI-XNBJS49ZIW', 'settlement', 'fab3fbb8-ec27-40e4-a826-d91a47f805dc', '2025-06-22 08:45:50', '2025-06-22 08:46:09'),
(9, 2, 2, 'cstore', 100000, NULL, 'DONASI-OYNFYPAAWD', 'pending', 'ad393d9f-191b-460e-9b6c-1aec217baee3', '2025-06-22 09:09:54', '2025-06-22 09:10:12'),
(10, 2, 2, 'echannel', 2000000, NULL, 'DONASI-SQZSCDISEW', 'settlement', '829fea19-3056-4b7f-9c80-0b0adb585e15', '2025-06-22 09:19:02', '2025-06-22 09:19:44'),
(11, 3, 3, 'echannel', 50000000, 'semoga ini bisa membantu para korban bencana', 'DONASI-GVDMOCUFBU', 'settlement', 'cf22b43b-7c78-4518-9445-9a927322e902', '2025-06-22 12:08:47', '2025-06-22 12:09:26'),
(12, 4, 3, 'bank_transfer', 14000000, 'semoga barokah yaa', 'DONASI-YT63ZDZEKA', 'settlement', 'dbfdf660-8939-4245-9982-2d1953395bfe', '2025-06-24 06:45:47', '2025-06-24 06:47:15'),
(13, 4, 2, 'bank_transfer', 140000000, 'semoga barokah', 'DONASI-NCSEEXYAOF', 'settlement', '1d18769a-b215-404b-8bf4-bbac15bd8ccb', '2025-06-30 01:21:19', '2025-06-30 01:21:43'),
(14, 3, 2, 'bank_transfer', 1000000, 'semoga cepat sehat', 'DONASI-H9DYGG6HGB', 'settlement', 'd0d541c7-8b43-4938-a98e-506aa9b10b7a', '2025-06-30 02:29:14', '2025-06-30 02:29:58'),
(15, 3, 2, 'bank_transfer', 9000000, 'sfc', 'DONASI-MPNXJN1WSM', 'settlement', '91f92558-25b4-4f42-8aa3-2c808670910b', '2025-06-30 04:42:10', '2025-06-30 04:42:41'),
(16, 4, 2, 'bank_transfer', 1500000, NULL, 'DONASI-HZT4NR64VT', 'settlement', 'af6166bf-1ffb-4730-92b4-eb6038796ba0', '2025-06-30 05:56:09', '2025-06-30 05:57:30'),
(17, 4, 2, 'bank_transfer', 1000000, 'semoga cukup', 'DONASI-HALECJMD1L', 'settlement', '716f24d0-d671-4bf2-bd8f-dc8f08ce6517', '2025-06-30 06:36:03', '2025-06-30 06:36:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD KEY `admins_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `akuns`
--
ALTER TABLE `akuns`
  ADD PRIMARY KEY (`id_akun`),
  ADD UNIQUE KEY `akuns_email_unique` (`email`);

--
-- Indexes for table `alokasi_danas`
--
ALTER TABLE `alokasi_danas`
  ADD PRIMARY KEY (`id_alokasidana`),
  ADD KEY `alokasi_danas_id_laporandonasi_foreign` (`id_laporandonasi`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `donasis`
--
ALTER TABLE `donasis`
  ADD PRIMARY KEY (`id_donasi`),
  ADD KEY `donasis_id_user_foreign` (`id_user`),
  ADD KEY `donasis_id_laporan_foreign` (`id_laporan`);

--
-- Indexes for table `edukasis`
--
ALTER TABLE `edukasis`
  ADD PRIMARY KEY (`id_edukasi`),
  ADD KEY `edukasis_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `laporans_id_user_foreign` (`id_user`),
  ADD KEY `laporans_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `laporan_donasis`
--
ALTER TABLE `laporan_donasis`
  ADD PRIMARY KEY (`id_laporandonasi`),
  ADD KEY `laporan_donasis_id_donasi_foreign` (`id_donasi`),
  ADD KEY `laporan_donasis_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  ADD KEY `users_id_user_foreign` (`id_user`);

--
-- Indexes for table `user_donasis`
--
ALTER TABLE `user_donasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_donasis_order_id_unique` (`order_id`),
  ADD KEY `user_donasis_id_donasi_foreign` (`id_donasi`),
  ADD KEY `user_donasis_id_user_foreign` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akuns`
--
ALTER TABLE `akuns`
  MODIFY `id_akun` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `alokasi_danas`
--
ALTER TABLE `alokasi_danas`
  MODIFY `id_alokasidana` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `donasis`
--
ALTER TABLE `donasis`
  MODIFY `id_donasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `edukasis`
--
ALTER TABLE `edukasis`
  MODIFY `id_edukasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id_laporan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `laporan_donasis`
--
ALTER TABLE `laporan_donasis`
  MODIFY `id_laporandonasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_donasis`
--
ALTER TABLE `user_donasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `akuns` (`id_akun`) ON DELETE RESTRICT;

--
-- Constraints for table `alokasi_danas`
--
ALTER TABLE `alokasi_danas`
  ADD CONSTRAINT `alokasi_danas_id_laporandonasi_foreign` FOREIGN KEY (`id_laporandonasi`) REFERENCES `laporan_donasis` (`id_laporandonasi`) ON DELETE RESTRICT;

--
-- Constraints for table `donasis`
--
ALTER TABLE `donasis`
  ADD CONSTRAINT `donasis_id_laporan_foreign` FOREIGN KEY (`id_laporan`) REFERENCES `laporans` (`id_laporan`) ON DELETE RESTRICT,
  ADD CONSTRAINT `donasis_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT;

--
-- Constraints for table `edukasis`
--
ALTER TABLE `edukasis`
  ADD CONSTRAINT `edukasis_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id_admin`) ON DELETE RESTRICT;

--
-- Constraints for table `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporans_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id_admin`) ON DELETE RESTRICT,
  ADD CONSTRAINT `laporans_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT;

--
-- Constraints for table `laporan_donasis`
--
ALTER TABLE `laporan_donasis`
  ADD CONSTRAINT `laporan_donasis_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id_admin`) ON DELETE RESTRICT,
  ADD CONSTRAINT `laporan_donasis_id_donasi_foreign` FOREIGN KEY (`id_donasi`) REFERENCES `donasis` (`id_donasi`) ON DELETE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `akuns` (`id_akun`) ON DELETE RESTRICT;

--
-- Constraints for table `user_donasis`
--
ALTER TABLE `user_donasis`
  ADD CONSTRAINT `user_donasis_id_donasi_foreign` FOREIGN KEY (`id_donasi`) REFERENCES `donasis` (`id_donasi`) ON DELETE RESTRICT,
  ADD CONSTRAINT `user_donasis_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
