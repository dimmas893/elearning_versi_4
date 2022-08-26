-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Agu 2022 pada 12.17
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elerning_latihan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`id`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Guru Ananda Dmmas Budiarto', 'anandadimmas@gmail.com', '$2y$10$M8zdbS.eeIcHnpnXuJfh8.DtenkcDX5VnXrN4jPN0GTGPP/.m1Lni', '1661330484.jpg', '2022-08-24 08:30:15', '2022-08-25 07:47:50'),
(6, 'dsdsds', 'anandadimmda@gmail.com', '$2y$10$IRHZvt3iY4BowCiOm9ryhONqAJ6N1ciL8UfsolFNBMv3jUXdzH1Dy', '1661403457.jpg', '2022-08-25 04:57:38', '2022-08-25 04:57:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guru_id` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `mata_pelajaran_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guru_kelas`
--

INSERT INTO `guru_kelas` (`id`, `guru_id`, `ruangan_id`, `mata_pelajaran_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, '2022-08-25 04:50:36', '2022-08-25 04:55:51'),
(2, 2, 1, NULL, '2022-08-25 04:57:49', '2022-08-25 04:57:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE `hari` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hari`
--

INSERT INTO `hari` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'senin', NULL, NULL),
(2, 'selasa', NULL, NULL),
(3, 'rabu', NULL, NULL),
(4, 'kamis', NULL, NULL),
(5, 'jumat', NULL, NULL),
(6, 'sabtu', NULL, NULL),
(7, 'minggu', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `mata_pelajaran_id` int(11) NOT NULL,
  `hari_id` int(20) NOT NULL,
  `jam_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_keluar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwals`
--

INSERT INTO `jadwals` (`id`, `ruangan_id`, `guru_id`, `mata_pelajaran_id`, `hari_id`, `jam_masuk`, `jam_keluar`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 4, '16:00', '23:00', '2022-08-25 04:16:08', '2022-08-25 04:16:08'),
(2, 1, 2, 4, 1, '22:22', '23:22', '2022-08-25 04:30:53', '2022-08-25 04:30:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'IPS', '2022-08-24 07:27:56', '2022-08-24 07:30:58'),
(2, 'IPA', '2022-08-24 07:30:45', '2022-08-24 07:30:52'),
(4, 'BAHASA', '2022-08-24 07:31:16', '2022-08-24 07:31:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `created_at`, `updated_at`) VALUES
(3, '12', '2022-08-24 06:43:29', '2022-08-24 07:29:45'),
(4, '11', '2022-08-24 06:44:01', '2022-08-24 07:29:37'),
(7, '10', '2022-08-24 07:07:18', '2022-08-24 07:29:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'PPKN', '2022-08-24 07:46:42', '2022-08-24 07:51:02'),
(3, 'MATEMATIKA', '2022-08-24 07:46:54', '2022-08-24 07:46:54'),
(4, 'BAHASA INDONESIA', '2022-08-24 07:47:06', '2022-08-24 07:47:06'),
(5, 'BAHASA INGGRIS', '2022-08-24 07:47:20', '2022-08-24 07:47:20'),
(6, 'AGAMA', '2022-08-24 07:49:05', '2022-08-24 07:49:05'),
(7, 'ELECTRO', '2022-08-24 07:49:36', '2022-08-24 07:49:36'),
(8, 'BAHASA ARAB', '2022-08-24 07:49:44', '2022-08-24 07:49:44'),
(9, 'KIMIA', '2022-08-24 07:49:50', '2022-08-24 07:49:50'),
(10, 'FISIKA', '2022-08-24 07:49:56', '2022-08-24 07:49:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_08_24_020101_create_jurusan_table', 1),
(5, '2022_08_24_020128_create_kelas_table', 1),
(6, '2022_08_24_020216_create_guru_table', 1),
(7, '2022_08_24_020558_create_mata_pelajaran_table', 2),
(8, '2022_08_24_020614_create_sekolah_table', 2),
(9, '2022_08_24_020853_create_penjaga_perpus_table', 2),
(10, '2022_08_24_021040_create_siswa_table', 2),
(11, '2022_08_24_095817_create_sekolah_table', 3),
(12, '2022_08_22_084211_create_products_table', 4),
(13, '2022_08_22_090114_create_employees_table', 4),
(14, '2022_08_24_145403_create_guru_table', 5),
(15, '2022_08_24_154409_create_tu_table', 6),
(16, '2022_08_24_155746_create_siswa_table', 7),
(17, '2022_08_24_163235_create_ruangan_table', 8),
(18, '2022_08_24_172457_create_penjaga_perpus_table', 9),
(19, '2022_08_25_090442_create_admins_table', 10),
(24, '2022_08_25_102044_create_jadwals_table', 11),
(25, '2022_08_25_102546_create_guru_kelas_table', 11),
(26, '2022_08_25_111142_create_hari_table', 11),
(27, '2022_08_25_120155_create_tugas_table', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjaga_perpus`
--

CREATE TABLE `penjaga_perpus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjaga_perpus`
--

INSERT INTO `penjaga_perpus` (`id`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`) VALUES
(1, 'penjaga perpus 3', 'nanda@gmail.com', '$2y$10$Yb.wwfhQp7tiSq5W.fx8ZePDL/A3BTD3nAEjPk6PKHlNkQricDgeO', '1661336745.jpg', '2022-08-24 10:25:45', '2022-08-24 10:30:26'),
(3, 'penjaga perpus 2', 'cinta@gmail.com', '$2y$10$6YrxLfXkl8MOxtf05bVuiOW2pMfPEQSyqTRLG6d65kedSSeZszE/y', '1661336857.jpg', '2022-08-24 10:27:37', '2022-08-24 10:29:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guru_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siswa_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `name`, `guru_id`, `siswa_id`, `jurusan_id`, `kelas_id`, `created_at`, `updated_at`) VALUES
(1, 'KELAS 11 BAHASA', NULL, '1', '4', '3', NULL, '2022-08-25 04:30:31'),
(3, 'KELAS 11 IPA', NULL, '3', '2', '4', '2022-08-25 04:28:57', '2022-08-25 04:29:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id`, `name`, `alamat`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'SMA NEMGERI 2 JEPON', 'KECAMATAN JEPON', 'BERDIRI TAHUN 8988', '1661323089.jpg', NULL, '2022-08-24 06:38:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `name`, `email`, `password`, `gender`, `alamat`, `image`, `nisn`, `created_at`, `updated_at`) VALUES
(1, 'Ananda Dmmas Budiarto', 'nanda@gmail.com', '$2y$10$UUqEP/yHhpwTuWo7UbYBL.XIOHs.9Xg3EgFciUiX9XLnUCwPOJiKO', 'Laki-Laki', 'ds Cabak', '1661332991.jpg', '234567895555', '2022-08-24 09:17:45', '2022-08-25 07:57:24'),
(3, 'shafig', 'shafig@gmail.com', '$2y$10$SzzTZpSy81rjyP0f5eSEoOzBaKEk/ZEbt7Nf2oAD6wW8xYGDU8Vg6', 'laki-laki', 'blora', '1661401622.jpg', '32323232', '2022-08-25 04:27:02', '2022-08-25 04:27:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tu`
--

CREATE TABLE `tu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tu`
--

INSERT INTO `tu` (`id`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Ananda petugas TU', 'nanda@gmail.com', '$2y$10$UGJ9nUYKed.RjHjGcjh.vOS251JXjp/o47VLIVxAd9uTONiY7YTRW', '1661331084.jpg', '2022-08-24 08:50:40', '2022-08-24 08:51:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `mata_pelajaran_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_or_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertemuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengumpulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'cinta', 'cinta@gmail.com', NULL, '$2y$10$X7EBGITGHRsHa3nuJVuf7ev0potRk2CkJh58cz0TE1ETbNzn.uEvy', NULL, '2022-08-23 19:19:16', '2022-08-23 19:19:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_email_unique` (`email`);

--
-- Indeks untuk tabel `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `penjaga_perpus`
--
ALTER TABLE `penjaga_perpus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penjaga_perpus_email_unique` (`email`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_email_unique` (`email`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`nisn`);

--
-- Indeks untuk tabel `tu`
--
ALTER TABLE `tu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tu_email_unique` (`email`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hari`
--
ALTER TABLE `hari`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `penjaga_perpus`
--
ALTER TABLE `penjaga_perpus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tu`
--
ALTER TABLE `tu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
