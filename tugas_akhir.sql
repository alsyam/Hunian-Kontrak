-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jan 2022 pada 14.03
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_akhir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` varchar(12) NOT NULL,
  `tgl_booking` date NOT NULL,
  `batas_ambil` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_detail`
--

CREATE TABLE `booking_detail` (
  `id` int(11) NOT NULL,
  `id_booking` varchar(12) NOT NULL,
  `id_kontrak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesan`
--

CREATE TABLE `detail_pesan` (
  `id` int(11) NOT NULL,
  `no_pesan` varchar(12) NOT NULL,
  `id_kontrak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pesan`
--

INSERT INTO `detail_pesan` (`id`, `no_pesan`, `id_kontrak`) VALUES
(1, '23082021001', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id_konfir` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_pesan` varchar(12) NOT NULL,
  `status_konfir` enum('Sudah menempati','Belum menempati') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfir`, `id_user`, `no_pesan`, `status_konfir`) VALUES
(1, 36, '23082021001', 'Sudah menempati');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontrak`
--

CREATE TABLE `kontrak` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `luas_b` varchar(50) NOT NULL,
  `luas_t` varchar(50) NOT NULL,
  `listrik` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `harga` int(50) NOT NULL,
  `durasi` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `ditempati` int(11) NOT NULL,
  `dibooking` int(11) NOT NULL,
  `image` varchar(256) NOT NULL,
  `image2` varchar(256) NOT NULL,
  `image3` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kontrak`
--

INSERT INTO `kontrak` (`id`, `id_user`, `luas_b`, `luas_t`, `listrik`, `deskripsi`, `alamat`, `no_telp`, `harga`, `durasi`, `stok`, `ditempati`, `dibooking`, `image`, `image2`, `image3`) VALUES
(1, 34, '120m2', '80m2', '1200watt', 'kamar mandi 5, kamar tidur 8, parkiran ,lantai 2 ', 'Cikaret gg. flamboyan', '085883617123', 9000000, 365, 5, 0, 0, 'img1625461944.jpg', 'img16254619441.jpg', 'img16254619442.jpg'),
(2, 32, '77m2', '90m2', '1200watt', 'kamar mandi 1, kamar tidur 3, parkiran', 'pancasan', '085765438765', 1700000, 365, 2, 0, 0, 'img1625462017.jpg', 'img16254620171.jpg', 'img16254620172.jpg'),
(4, 39, '120m2', '90m2', '1200watt', 'kamar mandi 1, kamar tidur 3, parkiran ,lantai 2', 'Cikaret gg. flamboyan', '085883617123', 9000000, 30, 2, 0, 0, 'img1626687453.jpg', 'img16266874531.jpg', 'img16266874532.jpg'),
(5, 32, '120m2', '90m2', '2400watt', 'kamar mandi 2, kamar tidur 3, parkiran', 'Cikaret gg. flamboyan', '085883617123', 1200000, 0, 6, 0, 0, 'img16296792753.jpg', 'img16296792754.jpg', 'img16296792755.jpg'),
(6, 42, '120m2', '80m2', '1200watt', 'kamar mandi 1, kamar tidur 3, parkiran ,lantai 2', 'Cikaret gg. flamboyan', '6767623762', 900000, 30, 1, 2, -1, 'img1629693226.jpg', 'img16296932261.jpg', 'img16296932262.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `no_pesan` varchar(12) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `id_booking` varchar(12) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status` enum('Ditempati','Kosong') NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `w_mulai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`no_pesan`, `tgl_pesan`, `id_booking`, `id_user`, `tgl_kembali`, `tgl_pengembalian`, `status`, `id_pemilik`, `w_mulai`) VALUES
('23082021001', '2021-08-23', '23082021001', 36, '2021-09-26', '0000-00-00', 'Ditempati', 42, '2021-08-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rek` int(11) NOT NULL,
  `id_booking` varchar(12) NOT NULL,
  `id_pemesan` varchar(11) NOT NULL,
  `nama_rek` varchar(30) NOT NULL,
  `bank_rek` varchar(40) NOT NULL,
  `no_rek` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `bukti` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Penyewa'),
(3, 'Pemilik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempo`
--

CREATE TABLE `tempo` (
  `id` int(11) NOT NULL,
  `tgl_booking` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pemilik` int(11) NOT NULL,
  `email_user` varchar(128) NOT NULL,
  `id_kontrak` int(11) NOT NULL,
  `luas_b` varchar(50) NOT NULL,
  `luas_t` varchar(50) NOT NULL,
  `listrik` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `harga` int(50) NOT NULL,
  `durasi` int(11) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `rek` varchar(20) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `tanggal_input` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `alamat`, `email`, `no_telp`, `rek`, `image`, `password`, `role_id`, `is_active`, `tanggal_input`) VALUES
(30, 'Muhammad Al Syam', 'Cikaret gg. flamboyan', 'malsyamuh@gmail.com', '6767623762', '0', 'default.jpg', '$2y$10$PoF1cx.nLGrMYuKWlZ3sheI6ogUWuJHDiF87zyoXhqRz278ss/15u', 1, 1, 1621686994),
(32, 'Budi Suryajana', 'pancasan', 'budi@gmail.com', '085883617123', '0', 'default.jpg', '$2y$10$IA866fMm5s5SNPyUYOidWOsUjJWJPv5SW/YJI1eGsdl9Spapo5m3G', 3, 1, 1621694629),
(33, 'Burhan', 'Cikaret', 'burhan@gmail.com', '9779978698', '0', 'default.jpg', '$2y$10$i3Vf.nEDec03Dn5Qt87fT.qydY72q9TY48BWr04Npu1LfN/dtb3ci', 2, 1, 1621695089),
(34, 'dimas', 'IPB Dramaga', 'dimas@gmail.com', '6767623762', '0', 'default.jpg', '$2y$10$wgKku0upW72AP.dAeD94qex7z04HRYafnTMzTvYb.D2V1V9Elu9RC', 3, 1, 1621731407),
(35, 'David Bayu', 'Cisarua Puncak', 'david@gmail.com', '9779978698', '0', 'img1625133138.jpg', '$2y$10$uqTCTiXeNE6VCPg8RzuVwevrxaIDGvxQ1ZQUiqjDm/51iPaZcRmrC', 2, 1, 1621738673),
(36, 'Rizki Mukodompit', 'Cisarua', 'rizki@gmail.com', '09878676686', '0', 'img1629694480.jpg', '$2y$10$bpdVU6WRCvuwZmODRT0ZSuXVji0d1VKTMFWRfbaodKPKuKvhk/me2', 2, 1, 1621982361),
(37, 'Vita ', 'Tajur', 'vita@gmail.com', '085883617199', '123456789098765', 'default.jpg', '$2y$10$BNBsdPJHsCH0rpkabVMrY.gggyUzqc4xP.WoWU6vPCnjb6KJSMQhm', 2, 1, 1624882966),
(38, 'alex nurdin', 'pasirkuda no.112', 'alex@gmail.com', '085765438765', '0', 'img1625321378.png', '$2y$10$bNyeSexK54tonOuA8nPhU.oCdN1O1q.Nx3W3VN0LD34elhZ6504hK', 2, 1, 1624883060),
(39, 'David Bayu Ari', 'IPB Dramaga', 'bayu@gmail.com', '085765438765', '123456789098765', 'default.jpg', '$2y$10$it9y3vqPc78nDxxzFvs1LOcGDzkkD21QrQ3PJuOolqdHaUuoaJx6e', 3, 1, 1626687281),
(40, 'arie', 'Cikaret', 'ari@gmail.com', '9779978698', '0', 'default.jpg', '$2y$10$DpiNDbu32Zxx7Aw7h6yxUutm.xUkHJDnDCKxr4FmwTt3D9Z.1pURO', 2, 1, 1626687512),
(41, 'Muhammad Al Syam', 'Cikaret gg. flamboyan', 'malsyam69@gmail.com', '085883617123', '123456789098765', 'default.jpg', '$2y$10$sKcNNLduWZH9RefhfAqQAuxc40w1kR1dsU8bx5SY5CGt5Js.PcCca', 3, 1, 1629682569),
(42, 'BENI', 'pancasan', 'beni@gmail.com', '6767623762', '123456789098765', 'default.jpg', '$2y$10$g79Aah9/fuglcObd3iPxuutm6yGGqjJWyUt7DBLlw0eRoSIt1Rc0G', 3, 1, 1629693131);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indeks untuk tabel `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_pesan`
--
ALTER TABLE `detail_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfir`);

--
-- Indeks untuk tabel `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`no_pesan`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rek`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tempo`
--
ALTER TABLE `tempo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pesan`
--
ALTER TABLE `detail_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id_konfir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rek` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tempo`
--
ALTER TABLE `tempo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
