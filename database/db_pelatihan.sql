-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jun 2023 pada 10.24
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pelatihan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_hp` varchar(128) NOT NULL,
  `pendidikan` varchar(128) NOT NULL,
  `domisili` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `buktibayar` varchar(128) NOT NULL,
  `verified` int(2) NOT NULL,
  `status_id` int(2) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `no_hp`, `pendidikan`, `domisili`, `image`, `password`, `role_id`, `buktibayar`, `verified`, `status_id`, `is_active`, `date_created`) VALUES
(1, 'Administrator', 'admin@admin.com', '08123123123', 'D3', 'Sleman', 'default.jpg', '$2y$10$09q72I5aab8V8qRPLUN7nOZK1fXmZRpv5q6Lez0HPxjaBPMbL8C2S', 1, 'nodata.png', 1, 1, 1, 1686039730),
(16, 'Cahyo Fitriningtyas', 'cahyo@gmail.com', '1234567890112', 'D3', 'Sleman', 'default.jpg', '$2y$10$5fkxDAgSM2N4iFLNzZ23NutH03FZvB9H3ilSxZCOnRm3sJrgcvKua', 1, '', 1, 1, 1, 1671437739),
(17, 'Putra Ujianjaya', 'putra1@gmail.com', '088812312313', '', 'Kulon Progo', 'Fh3IaTFVQAAa4cY.jpg', '$2y$10$/GoJPpZzGnLouCUzReYktOlQzfVMw3nmTBzupDIsFjGgyGn1CmbRm', 4, '', 1, 1, 1, 1671437758),
(19, 'aldi', 'aldi@gmail.com', '081231231233', 'SMA/SMK', 'Bantul', 'default.jpg', '$2y$10$3NVol6kKPG5eOFCgiVMqgOH2q8dRdw.OwvbwvM4DasREXKOoygowK', 4, '', 1, 1, 1, 1671437853),
(10005, 'Riska Zuliyanti', 'riska@gmail.com', '081231234123', 'SMA/SMK', 'Magelang', 'default.jpg', '$2y$10$C4zJbvfUmhIOwAT4pjgvR.0iZhJc.DcnU5Yg2ISb3Wkx7yp7RTFPK', 4, '1684486824invoice.jpeg', 1, 1, 1, 1684486506),
(10008, 'Cahyo Fitriningtyas', 'f30.cahyo@gmail.com', '0888066605373', 'SMA/SMK', 'Sleman', 'default.jpg', '$2y$10$6srx1q0hY4f9EWIP7MBGt.uQX.BcW3KNqpJOgt2hPiakJRoXA1UtG', 2, '1685677380.jpg', 1, 1, 1, 1685521196),
(10009, 'Siti Avi Miliantari', 'sitiavi.m@gmail.com', '082312312312', '', 'Bantul', '1685699575.jpg', '$2y$10$DY6QXrXYfSiT5nvS3OG0hOv7pwygiHAF4oM7Na43.i8p5G90Ijfna', 2, 'nodata.png', 1, 0, 1, 1685609591),
(10013, 'User peserta', 'peserta@gmail.com', '081231231231', 'D3', 'Yogyakarta', 'default.jpg', '$2y$10$ydBC977cNDGaQn8/4YNWiuI2mgg8Xub0ZeSLSLk3W3yELRkuUpQau', 2, 'nodata.png', 0, 0, 1, 1685714137),
(10015, 'Instruktur', 'instruktur@gmail.com', '', '', '', 'default.jpg', '$2y$10$4KXLZd7ygdpbsBwlIs9RTutVQWcobM0NZRpmDUeFkRgQC1uDniNom', 3, 'nodata.png', 1, 0, 1, 1685787191);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(7, 1, 3),
(9, 3, 2),
(10, 3, 3),
(11, 4, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_certificate`
--

CREATE TABLE `user_certificate` (
  `user_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `certificate` varchar(255) NOT NULL,
  `cert_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_certificate`
--

INSERT INTO `user_certificate` (`user_id`, `name`, `certificate`, `cert_created`) VALUES
(10008, 'Cahyo Fitriningtyas', 'Certificate1686039395.pdf', '2023-06-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_course`
--

CREATE TABLE `user_course` (
  `course_id` int(1) NOT NULL,
  `course` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_course`
--

INSERT INTO `user_course` (`course_id`, `course`) VALUES
(1, 'Brevet Pajak A & B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_exam`
--

CREATE TABLE `user_exam` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `exam_tp` int(2) NOT NULL,
  `exam_file` varchar(256) NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_exam`
--

INSERT INTO `user_exam` (`id`, `course_id`, `exam_tp`, `exam_file`, `deadline`) VALUES
(3, 1, 1, 'task1686031037.rar', '2023-06-10 20:11:00'),
(6, 1, 2, 'task1684225209.pdf', '2023-06-16 23:28:00'),
(8, 1, 3, 'task1685716204.pdf', '2023-07-07 21:29:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_exam_score`
--

CREATE TABLE `user_exam_score` (
  `user_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `kup_a` int(4) NOT NULL,
  `pph_op` int(4) NOT NULL,
  `pph_21` int(4) NOT NULL,
  `pph_22` int(4) NOT NULL,
  `ppn` int(4) NOT NULL,
  `pph_b` int(4) NOT NULL,
  `pbb` int(4) NOT NULL,
  `kup_b` int(4) NOT NULL,
  `akt_pjk` int(4) NOT NULL,
  `status_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_exam_score`
--

INSERT INTO `user_exam_score` (`user_id`, `name`, `email`, `kup_a`, `pph_op`, `pph_21`, `pph_22`, `ppn`, `pph_b`, `pbb`, `kup_b`, `akt_pjk`, `status_id`) VALUES
(10008, 'Cahyo Fitriningtyas', 'f30.cahyo@gmail.com', 90, 90, 90, 90, 90, 90, 90, 90, 90, 1),
(10009, 'Siti Avi Miliantari', 'sitiavi.m@gmail.com', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_exam_type`
--

CREATE TABLE `user_exam_type` (
  `exam_tp` int(2) NOT NULL,
  `exam_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_exam_type`
--

INSERT INTO `user_exam_type` (`exam_tp`, `exam_name`) VALUES
(1, 'Mid Exam'),
(2, 'Final Exam'),
(3, 'Remedial Exam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_exam_upload`
--

CREATE TABLE `user_exam_upload` (
  `user_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `midexam_file` varchar(256) NOT NULL,
  `finalexam_file` varchar(256) NOT NULL,
  `remedialexam_file` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_exam_upload`
--

INSERT INTO `user_exam_upload` (`user_id`, `name`, `email`, `midexam_file`, `finalexam_file`, `remedialexam_file`) VALUES
(17, 'Putra', '', '', '', ''),
(19, 'aldi', '', '', '', ''),
(10005, 'Riska', '', 'MidExam1685005334.pdf', 'FinalExam1685005498.pdf', ''),
(10008, 'Cahyo Fitriningtyas', 'f30.cahyo@gmail.com', '', '', ''),
(10009, 'Siti Avi Miliantari', 'sitiavi.m@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_material`
--

CREATE TABLE `user_material` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `link` varchar(256) NOT NULL,
  `modul` varchar(512) DEFAULT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_material`
--

INSERT INTO `user_material` (`id`, `course_id`, `title`, `link`, `modul`, `time`) VALUES
(17, 1, 'PPh Orang Pribadi', '123123123', 'modul1684220172.pdf', '2023-06-29 17:54:00'),
(21, 1, 'PPh Badan', '-', '1683876994PPh_B.pdf', '0000-00-00 00:00:00'),
(22, 1, 'PBB, BPHTB, dan Bea Materai', '-', '1683877029PBB,BPHTB.pdf', '0000-00-00 00:00:00'),
(23, 1, 'KUP B', '-', '1683877059KUPB.pdf', '0000-00-00 00:00:00'),
(24, 1, 'Akuntansi Pajak', '-', '1683877081AktPajak.pdf', '0000-00-00 00:00:00'),
(25, 1, 'Pemeriksaan Pajak', '-', '1683877125Pemeriksaan_Pajak.pdf', '0000-00-00 00:00:00'),
(29, 1, 'Test Materi', 'https://www.youtube.com', '1685417550Ruang_Mahasiswa_Bina_Sarana_Informatika.pdf', '2023-05-25 13:34:00'),
(33, 1, 'Accounting', 'https://www.youtube.com', '1685621856SISTEM_INFORMASI_PENDAFTARAN_PESERTA_DIDIK_BARU_BERBASIS_WEB_MENGGUNAKAN_CODEIGNITER_3.pdf', '2023-06-01 19:17:00'),
(34, 1, 'Test Materi', 'https://www.youtube.com', '1686030609AktPajak.pdf', '2023-06-23 16:54:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Instructor'),
(4, 'Menu'),
(5, 'Sertifikat\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Peserta'),
(3, 'Instruktur'),
(4, 'Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status`
--

CREATE TABLE `user_status` (
  `status_id` int(2) NOT NULL,
  `status_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_status`
--

INSERT INTO `user_status` (`status_id`, `status_name`) VALUES
(0, 'Tidak Lulus'),
(1, 'Lulus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard Admin', 'admin', 'fa-solid fa-fw fa-gauge', 1),
(2, 2, 'Dashboard', 'user', 'fa-solid fa-fw fa-gauge', 0),
(3, 2, 'Profil Saya', 'user/profile', 'fa-solid fa-fw fa-user', 1),
(4, 4, 'Sertifikat', 'menu', 'fa-solid fa-fw fa-certificate', 1),
(5, 4, 'Sub Menu Management', 'menu/submenu', 'fa-solid fa-fw fa-folder-open', 0),
(6, 2, 'Edit Profil', 'user/edit', 'fa-solid fa-fw fa-user-pen', 1),
(7, 1, 'User Role', 'admin/role', 'fa-solid fa-fw fa-user-gear', 0),
(8, 2, 'Ubah Password', 'user/chpasswd', 'fa-solid fa-fw fa-key', 1),
(9, 3, 'Unggah Materi', 'instructor', 'fa-solid fa-fw fa-chalkboard-user', 1),
(11, 2, 'Materi Pelatihan', 'user/v_course', 'fa-solid fa-fw fa-chalkboard-teacher', 1),
(15, 1, 'Daftar Peserta', 'admin/member', 'fa-solid fa-fw fa-users', 1),
(16, 1, 'Daftar Instruktur', 'admin/instructor', 'fa-solid fa-fw fa-user-graduate', 1),
(18, 3, 'Unggah Soal Ujian', 'instructor/exam', 'fa-solid fa-fw fa-tasks', 1),
(19, 2, 'Ujian Pelatihan', 'user/v_exam', 'fa-solid fa-fw fa-file-alt', 1),
(20, 3, 'Unggah Nilai Ujian', 'instructor/examscore', 'fa-solid fa-fw fa-star', 1),
(21, 1, 'Sertifikat Peserta', 'admin/certificate', 'fa-solid fa-fw fa-certificate', 1),
(22, 4, 'Sertifikat', 'sertifikat', 'fa-solid fa-fw fa-file-certificate', 0),
(23, 3, 'Jawaban Ujian', 'instructor/examresult', 'fa-solid fa-fw fa-file-alt', 1),
(24, 1, 'Daftar Alumni', 'admin/alumni', 'fa-solid fa-fw fa-graduation-cap', 1),
(25, 2, 'Nilai Ujian', 'user/examscore', 'fa-solid fa-fw fa-star', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_verify`
--

CREATE TABLE `user_verify` (
  `id` int(11) NOT NULL,
  `verified` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_verify`
--

INSERT INTO `user_verify` (`id`, `verified`) VALUES
(1, 'Yes'),
(2, 'No');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_certificate`
--
ALTER TABLE `user_certificate`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `user_course`
--
ALTER TABLE `user_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indeks untuk tabel `user_exam`
--
ALTER TABLE `user_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_exam_score`
--
ALTER TABLE `user_exam_score`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `user_exam_type`
--
ALTER TABLE `user_exam_type`
  ADD PRIMARY KEY (`exam_tp`);

--
-- Indeks untuk tabel `user_exam_upload`
--
ALTER TABLE `user_exam_upload`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `user_material`
--
ALTER TABLE `user_material`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_verify`
--
ALTER TABLE `user_verify`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10017;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_course`
--
ALTER TABLE `user_course`
  MODIFY `course_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_exam`
--
ALTER TABLE `user_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user_material`
--
ALTER TABLE `user_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user_verify`
--
ALTER TABLE `user_verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
