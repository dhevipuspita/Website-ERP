-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 06:38 PM
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
-- Database: `fp_pemasaran`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `email`, `no_hp`, `alamat`, `catatan`, `image`, `role`) VALUES
(1, 'Nanda', 'admin@binato.com', '+6285320357152', 'Ngujang - Tulungagung', 'Follow me, chuakss', '165Rizky Aidil.png', 'Admin'),
(2, 'Avi', 'avisibuk@gmail.com', '08520357152', 'Brantas - Kediri', 'Saya adalah seorang Programmer', '255FB_IMG_1545569895276.jpg', 'Karyawan'),
(3, 'Firstha', 'pistapare@gmail.con', '08520357152', 'Kampung Inggris - Pare', 'Saya adalah seorang Polwan', '705Profil bluesloveyou.png', 'Karyawan'),
(4, 'Zalfa', 'zalfatuban@gmail.con', '08520357000', 'Galagung - Tuban', 'Penguasa Pantai Tuban adalah saya', '705Profil bluesloveyou.png', 'Karyawan'),
(5, 'Annisa', 'anisatp@gmail.con', '08520357662', 'TP6 - Surabaya', 'Suka menjelajah Tunjungan Plaza 1-6', '705Profil bluesloveyou.png', 'Karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(10) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pelanggan` varchar(255) NOT NULL,
  `no_hp_pelanggan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `username`, `password`, `alamat_pelanggan`, `no_hp_pelanggan`) VALUES
('PLG001', 'Ahmad Kurniawan', 'ahmadkurniawan', '$2y$10$2XCBNR15po6saIat5P29TuvE82QS7L9W2JEbZNoTx9xU2lYyc20gq', 'Pelandaan', '080000000000'),
('PLG002', 'Aiki Brilian', 'aikibrilian', '$2y$10$MrXOm8wg0rFa5.Fa4w0kGegDRaznpdq9mu1dCMU.0duNT.kshb7Ia', 'Perdagangan Pasar I', '080000001111'),
('PLG003', 'Alviansyah', 'alviansyah', '$2y$10$tSjY9ihwF0.iW1vUfWJnt.dTom7iAdkgH0H5qVEb2E93foKfYEWyS', 'Tempel Jaya', '080000002222'),
('PLG004', 'Anisha Catur Wulandari', 'anishacatur', '$2y$10$mIWdGXF4vpV.woQjIb.sQ.SCjdP31jZ2TDgn4/VlpTvkW0V0M8Yy.', 'Mangkai Baru Dusun III', '080000003333'),
('PLG005', 'Anugrah Sang Putra', 'anugrahsang', '$2y$10$lNcUqYmj2TazPwTTS6T9JuZt8pdicafiJV6UFVHAY9k5P5OLHTo8q', 'Toumoan', '080000004444'),
('PLG006', 'Ayu Andari', 'ayuandari', '$2y$10$8NLv6q8HL4m6D6iFwj9BoOKs4cyH3kvZLfEKvA2nth1yyKjqLhEym', 'Mangkai Baru Dusun IV', '080000005555'),
('PLG007', 'Bima Syahputra Purba', 'bimasyahputra', '$2y$10$u5hrREOr4bOgKu9CxAdWW.p02VUnlYuMzvpixYqea2tf1jAVzpItS', '-', '080000006666'),
('PLG008', 'Chairil Anwar', 'chairilanwar', '$2y$10$kYmgksf2KU85SvrVOb20R.OkNfBGJvcD4zDAr5NCZeUoMfHPFKrLe', '-', '080000007777'),
('PLG009', 'Deby Ridho Marauli Nasution', 'debyridho', '$2y$10$trC38ZFsfPFK9H1DanIxBOuPzi6l9P5v9Pei/As8TmkbShZmGRFqq', 'Perdagangan ', '080000008888'),
('PLG010', 'Dina Ira Pandini Purba', 'dinaira', '$2y$10$.VE63p/f1VQkTx6X2KRHjO2CMiveFbmj2wxKNova5DPR.ekdRVkdy', '-', '080000009999'),
('PLG011', 'Dinda Aristi', 'dindaaristi', '$2y$10$H2CaETQaUzhD/QfVMft9D./.hqMfO2zAHAHduWs1Yg85tY2biwqei', 'Kucingan', '080011110000'),
('PLG012', 'Indah Irawati', 'indahirawati', '$2y$10$PsU5G2z5vUR5i3xb49hIgOMigZ7YNK9qtq/5YtGC99k8lwjR3CcbK', '-', '080022220000'),
('PLG013', 'Iqbal Nur Adabi Nasution', 'iqbalnur', '$2y$10$TYl8JSb9zsSeq1kmQ/9LGeUmZBfMUV.pz0M6Gku0NMm0Ujt7rHiSS', '-', '080033330000'),
('PLG014', 'Ivan Pramana', 'ivanpramana', '$2y$10$faw5YKX8HqwZojLcY92p/.k3Hb2288Luw4OrFEAGy50ei85LsnnS6', '-', '080044440000'),
('PLG015', 'Melin Agus Triyanti', 'melinagus', '$2y$10$eY6usEjaGBOw8Rq0u93QLeEA11g/rxVrF0BVB.X/2Hz7m8PZ7BH/i', 'Tempel Jaya', '080055550000'),
('PLG016', 'Muhammad Hanafi', 'muhammadhanafi', '$2y$10$lFRTnd80/YuhLZJ1hlhbUue8a5D94q7KVMobwvR8Jh8SQXVgW44Xm', 'Perlanaan', '080066660000'),
('PLG017', 'Muhammad Iqbal', 'muhammadiqbal', '$2y$10$pkw/VVc8PeeQVoHGPMV8Qekn6rCjT8dc6RMwukTk.bihBzwhIbxL6', '-', '080077770000'),
('PLG018', 'Muhammad Rizky Yudistio', 'muhammadrizky', '$2y$10$TN4NaQs/9/7PWkWo/aFocexWBRIdI..yw..fh6jYTOu/yUGIboeFe', 'Mangkai Lama', '080088880000'),
('PLG019', 'Muhammad Nanda Kurniawan', 'muhammadnanda', '$2y$10$dpARYFleJae53LeuVhug1uE0sKcraA6V23RLjdnDTj9JxfaVPqOfa', 'Perlanaan', '080099990000'),
('PLG020', 'Rehan Firnanda', 'rehanfirnanda', '$2y$10$ZfjiHhOiPNhxKGyZvpPCMe8inERnjLSZTQn0viyRbKggtik/claqm', 'Mangkai Baru Dusun I', '080011111111'),
('PLG021', 'Ridhana Fiska', 'ridhanafiska', '$2y$10$ak10VJdi/t0jnePIIZNjhu23iHyBj.spJKdACO7uofjH9fW7CATF6', 'Mayang', '080011112222'),
('PLG022', 'Rizky Aidil', 'rizkyaidil', '$2y$10$G2sjLEPuKfKUXaU5Af4bbus9yQcRbkPr6wXZUxBxmU1uvxh3k0UjS', 'Mangkai Baru Dusun IV', '080011113333'),
('PLG023', 'Siti Kharisma Fitriana', 'sitikharisma', '$2y$10$8auWnYC4Mvb4XSeT7xNT1em2yx1adjG4kHON1hQr9.SdTaez5z8NC', 'Mangkai Lama', '080011114444'),
('PLG024', 'Sri Romadhona', 'sriromadhona', '$2y$10$N37Uw.W4T.SaI/uUGJ.pPuxUNFNGaD/DpKxPHpy7whCHPY19j74VS', 'Bukit Lima', '080011115555'),
('PLG025', 'Sultan Nico Nur', 'sultannico', '$2y$10$7SdFrZyOWiLgguySsAAuBOOwQ86wYHHipMaLKpHZf.l32Wh7MXUuS', 'Mangkai Lama', '080011116666'),
('PLG026', 'Tri Ayuni', 'triayuni', '$2y$10$I8AJ44wdKVSUo7AOXzVulO7pek1MBHlf98H7iF0jIBz9WnKhNlM3G', '-', '080011117777'),
('PLG027', 'Wahyu Fitrah', 'wahyufitrah', '$2y$10$D5I137SfziP/fQrutM0mYudnwQ.QUE9CTVGynw2N1t2L5LZuuQ8e6', 'Dosin', '080011118888'),
('PLG028', 'Wendy Riswana', 'wendyriswana', '$2y$10$.bR5xaYXpgLNgup3h3qc0O3ZTQeuQdEnoOK842XtonwiAImazsfcm', '-', '080011119999'),
('PLG029', 'Widya Mailani', 'widyamailani', '$2y$10$3V9mtYrnFNRk23Z6jp4WWO.6BlJoTUIR5LeoumdpFbm4nduY3X8Lm', '-', '080022221111'),
('PLG030', 'Wirandani Galih Kusuma', 'wirandanigalih', '$2y$10$.w3WFYKtS.fEbcdrQPbySenWbGlif4DphqC10RObhSwkSeiO/XIY.', 'Perlanaaan', '080022222222'),
('PLG031', 'Wisnu Falevi', 'wisnufalevi', '$2y$10$uN063k2u7NZutOm1maTnsu/eTVzt60mdGfRspjfjfe4a9GZgmkWGO', '-', '080022223333');

-- --------------------------------------------------------

--
-- Table structure for table `pemasaran`
--

CREATE TABLE `pemasaran` (
  `id_pemasaran` int(11) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `jenis_pemasaran` varchar(100) NOT NULL,
  `target_pemasaran` varchar(100) NOT NULL,
  `hasil_pemasaran` varchar(100) NOT NULL,
  `durasi_pemasaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemasaran`
--

INSERT INTO `pemasaran` (`id_pemasaran`, `tanggal`, `jenis_pemasaran`, `target_pemasaran`, `hasil_pemasaran`, `durasi_pemasaran`) VALUES
(1, '2023-01-01', 'Digital Marketing', 'Meningkatkan penjualan online', 'Penjualan meningkat 20%', '3 bulan'),
(2, '2023-02-01', 'Iklan Televisi', 'Kesadaran merek', 'Kesadaran merek meningkat 15%', '1 bulan'),
(3, '2023-03-01', 'Promosi Media Sosial', 'Jumlah pengikut media sosial', 'Pengikut meningkat 50%', '2 bulan');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(10) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `id_pelanggan` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal`, `id_pelanggan`, `qty`, `biaya`, `bayar`, `kembalian`, `id_produk`, `nama_produk`) VALUES
('TRS012', '2024-06-07', 'PLG001', 1, 15000, 15000, 0, 2, 'Gula 1 Kg'),
('TRS019', '2024-06-07', 'PLG011', 3, 45000, 30000, -15000, 2, 'Gula 1 Kg'),
('TRS020', '2024-06-07', 'PLG014', 5, 110000, 200000, 90000, 7, 'susu 1 lt'),
('TRS021', '2024-06-07', 'PLG007', 1, 14500, 20000, 5500, 4, 'Tepung Terigu 1 kg'),
('TRS022', '2024-06-07', 'PLG018', 1, 17000, 20000, 3000, 5, 'Minyak Goreng Pouch 1 L'),
('TRS023', '2024-06-07', 'PLG015', 1, 17000, 10000, -7000, 5, 'Minyak Goreng Pouch 1 L'),
('TRS024', '2024-06-07', 'PLG020', 1, 74000, 100000, 26000, 9, 'susu 1 lt');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('admin', '$2y$10$SGbZPoQrn8cal.bGbnKDfOW50gvpe5fje5XvBSYfTp6CRJf7EKf4y'),
('admin', '$2y$10$ALBs3CVeNWcuUEt25Q2hMOCyT.SnTRaL2wb1u8VP4Z0.mqCWYwSs6'),
('admin', '$2y$10$i8AIJrpD7CUh5tnPtApYUOmKqMgFNeLTf4aUkh1xdUIwO1R04jQUC'),
('admin', '$2y$10$Ck2db5KbGWKUy6pNZgeFqOnuwr1rwdAuxkXwME9hA.1/T9ssYaSKW'),
('admin', '$2y$10$hLydExa1DSDtKKWAVl.TmOI7DneWZh6nQnhjNkBT97/V4Chh/oWZi'),
('admin', '$2y$10$XEbPKE9LlsB8g2mjkvki9efKuiK8xKRBxblnfMxKTFVBrEG0atn2e'),
('admin', '$2y$10$6WCZbAwjKo0ckODSY/JDw.286Z.POHauf01q8DqMWg4ztxRijtRYm'),
('admin', '$2y$10$s1YXqRtJOOI4.4STAsemcu8WhN3uEz8XeTREv5ch8Yw07QVA3xqKy'),
('admin', '$2y$10$GfYKlOtaZHTohBmxUUt0D..VJNefSBWOfmlV52ZwmeicloxkVEf4W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pemasaran`
--
ALTER TABLE `pemasaran`
  ADD PRIMARY KEY (`id_pemasaran`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_pelanggan` (`id_pelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemasaran`
--
ALTER TABLE `pemasaran`
  MODIFY `id_pemasaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
