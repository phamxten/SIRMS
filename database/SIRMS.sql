-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2026 at 03:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SIRMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `spesialis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `username`, `password`, `nama_dokter`, `alamat`, `tgl_lahir`, `jenis`, `spesialis`) VALUES
(1, 'admin', '$2y$10$f9ZZD3xWzWq1NhKNh0O7QutOWIXuvtySwcR.z/83NRMOHRsS7FQPG', 'Dr. Admin', 'Jl. Klinik No. 1', '1990-01-01', 'Laki-laki', 'Dokter Umum'),
(2, 'agus', '12345', 'agus', 'jaksel', '2026-10-28', 'Laki-laki', 'bedah jantung'),
(3, 'admin', '$2y$10$BwQnEXrSaAZg5Z7CftRqpeWJWmJLU1M25TCmDEQu9cnCn3.9C/.NS', 'Dr. klontong', 'Jl. Klinik No. 1', '1990-01-01', 'Laki-laki', 'Dokter Umum'),
(4, 'phamx', '$2y$10$fiG.HOmgXV32KU31dE7mN.lYxoNcDce5VZ6CGuVr95mrFAMegfoye', 'Dr. klontong', 'Jl. Klinik No. 1', '1990-01-01', 'Laki-laki', 'Dokter Umum'),
(5, 'phamx', '$2y$10$sH4RiRhEkKwtTOeuoSSwX.3iIUmuTVzORWxC4x5LQim5.KCzq9E2m', 'Admin', 'Jl. Klinik No. 1', '1990-01-01', 'Laki-laki', 'Dokter Umum'),
(6, 'phamx', '$2y$10$tXkxPsjteGofecprGLRtUev90Dg3lXk/duuVSA357r2cQpfHI/g26', 'Admin', 'Jl. Klinik No. 1', '1990-01-01', 'Laki-laki', 'Dokter Umum');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(5) NOT NULL,
  `kode_obat` varchar(255) NOT NULL,
  `nama_obat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `kode_obat`, `nama_obat`) VALUES
(1, 'OBT-01', 'herbal promax 100mg'),
(2, '02', 'jahe herbal');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(5) NOT NULL,
  `no_registrasi` varchar(255) NOT NULL,
  `nama_pasien` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `no_registrasi`, `nama_pasien`, `alamat`, `tgl_lahir`) VALUES
(1, '01', 'siti', 'gresik', '2026-10-28'),
(2, '02', 'yono', 'sby', '2026-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `id` int(5) NOT NULL,
  `id_pasien` int(5) NOT NULL,
  `id_dokter` int(5) DEFAULT NULL,
  `tgl_periksa` date NOT NULL,
  `keluhan` varchar(255) NOT NULL,
  `tensi_darah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`id`, `id_pasien`, `id_dokter`, `tgl_periksa`, `keluhan`, `tensi_darah`) VALUES
(1, 1, 1, '2026-10-28', 'atit', '100'),
(2, 2, 1, '2026-10-28', 'paruh paruh bocor', '300');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan_obat`
--

CREATE TABLE `pemeriksaan_obat` (
  `id` int(5) NOT NULL,
  `id_pemeriksaan` int(5) NOT NULL,
  `id_obat` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemeriksaan_obat`
--

INSERT INTO `pemeriksaan_obat` (`id`, `id_pemeriksaan`, `id_obat`) VALUES
(1, 1, 1),
(2, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemeriksaan_obat`
--
ALTER TABLE `pemeriksaan_obat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemeriksaan_obat`
--
ALTER TABLE `pemeriksaan_obat`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
