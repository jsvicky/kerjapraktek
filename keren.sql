-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 04 Mar 2016 pada 17.01
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `keren`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `carabeli`
--

CREATE TABLE IF NOT EXISTS `carabeli` (
  `id_carabeli` int(5) NOT NULL AUTO_INCREMENT,
  `nama_carabeli` text COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `carabeli_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `count` int(5) NOT NULL,
  PRIMARY KEY (`id_carabeli`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=64 ;

--
-- Dumping data untuk tabel `carabeli`
--

INSERT INTO `carabeli` (`id_carabeli`, `nama_carabeli`, `username`, `carabeli_seo`, `count`) VALUES
(63, 'But I must explain to you how all this mistaken idea of denouncing pleasure.But I must explain to you how all this mistaken idea of denouncing pleasure.&nbsp;But I must explain to you how all this mistaken idea of denouncing pleasure.But I must explain to you how all this mistaken idea of denouncing pleasure.&nbsp;But I must explain to you how all this mistaken idea of denouncing pleasure.But I must explain to you how all this mistaken idea of denouncing pleasure.&nbsp;But I must explain to you how all this mistaken idea of denouncing pleasure.But I must explain to you how all this mistaken idea of denouncing pleasure.\r\n', 'admin', 'but-i-must-explain-to-you-how-all-this-mistaken-idea-of-denouncing-pleasurebut-i-must-explain-to-you', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id_gallery` int(5) NOT NULL AUTO_INCREMENT,
  `id_produk` int(5) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `jdl_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gallery_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `gbr_gallery` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_gallery`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=256 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hubungi`
--

CREATE TABLE IF NOT EXISTS `hubungi` (
  `id_hubungi` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `subjek` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pesan` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `dibaca` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_hubungi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=42 ;

--
-- Dumping data untuk tabel `hubungi`
--

INSERT INTO `hubungi` (`id_hubungi`, `nama`, `email`, `subjek`, `pesan`, `tanggal`, `jam`, `dibaca`) VALUES
(41, 'VICKY SAJAHH', 'vickyjulyanto@gmail.com', 'BERAPAAN?', 'jiji', '2016-03-04', '00:00:00', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `identitas`
--

CREATE TABLE IF NOT EXISTS `identitas` (
  `id_identitas` int(5) NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `facebook` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `rekening` varchar(100) NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `meta_deskripsi` varchar(250) NOT NULL,
  `meta_keyword` varchar(250) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  PRIMARY KEY (`id_identitas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_website`, `email`, `url`, `facebook`, `rekening`, `no_telp`, `meta_deskripsi`, `meta_keyword`, `favicon`) VALUES
(1, 'Sewa Alat Event by VD Production', 'cs.vdproduction@gmail.com', 'sewa.warungevent.com', 'instagram.com/vdproduction', '', '02129615658', 'Jalan Benteng Mas I No. No. 69, Jl. Pucuk Beringin I No.69, DKI Jakarta, Daerah Khusus Ibukota Jakarta 14350', 'eventorganizer,sewa,alatevent', 'favicon.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `kategori_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=63 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `username`, `kategori_seo`, `aktif`) VALUES
(62, 'Paket Lighting', 'admin', 'paket-lighting', 'Y'),
(61, 'Paket Event', 'admin', 'paket-event', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kustomer`
--

CREATE TABLE IF NOT EXISTS `kustomer` (
  `id_kustomer` int(5) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `identitas` varchar(100) NOT NULL,
  `telpon` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_orders` varchar(20) NOT NULL,
  `aktif` enum('N','Y') DEFAULT 'Y',
  PRIMARY KEY (`id_kustomer`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=289 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `logo`
--

CREATE TABLE IF NOT EXISTS `logo` (
  `id_logo` int(5) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_logo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Dumping data untuk tabel `logo`
--

INSERT INTO `logo` (`id_logo`, `gambar`) VALUES
(15, 'vd_logo.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_orders` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `status_order` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'Baru',
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `id_kustomer` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `id_tiket` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `checkin` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `checkout` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `dibaca` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_orders`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_temp`
--

CREATE TABLE IF NOT EXISTS `orders_temp` (
  `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT,
  `id_produk` int(5) NOT NULL,
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(5) NOT NULL,
  `startin` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `endout` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `lama` int(5) NOT NULL,
  PRIMARY KEY (`id_orders_temp`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=221 ;

--
-- Dumping data untuk tabel `orders_temp`
--

INSERT INTO `orders_temp` (`id_orders_temp`, `id_produk`, `id_session`, `jumlah`, `startin`, `endout`, `lama`) VALUES
(194, 44, 'jd7l1biec8tffd5sbddug0ls23', 1, '2015-08-01', '2015-08-29', 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(5) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(5) NOT NULL,
  `jdl_produk` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `produk_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  `gbr_produk` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `hits_produk` int(5) NOT NULL DEFAULT '1',
  `tgl_posting` date NOT NULL,
  `jam` time NOT NULL,
  `hari` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `harga` int(10) NOT NULL,
  `diskon` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `tag` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=56 ;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `jdl_produk`, `produk_seo`, `keterangan`, `gbr_produk`, `aktif`, `hits_produk`, `tgl_posting`, `jam`, `hari`, `username`, `harga`, `diskon`, `stok`, `tag`) VALUES
(51, 61, 'Paket Standard Event', 'paket-standard-event', 'Paket Murah Event untuk Standard Pensi', '', 'Y', 8, '2016-03-04', '17:39:24', 'Jumat', 'admin', 10000000, 0, 3, 'Sound System Ground Stack 8000 Watt, Alat band standard artis, Stage Semi Rigging ukuran 5x6m, 4 Unit kembang api air mancur, 1 Unit Confetti Blower LED, 1 Unit Tenda (FOH) Ukuran 3x3m, Backdrop Photobooth + Red Carpet, 1 Unit Genset 60KVA, Gratis Photo Frame Instagram, 1 Unit Tiket Box serta Tenda Ukuran 2x2m'),
(52, 62, 'Paket Standard Lighting', 'paket-standard-lighting', 'Adalah Paket Standard untuk Lighting dengan harga murah', '', 'Y', 10, '2016-03-04', '17:41:41', 'Jumat', 'admin', 1500000, 2, 0, '8 Unit Par LED, 1 Unit Smoke Machine, 3 Unit Kembang Api Air Mancur'),
(53, 62, 'Paket Medium Lighting', 'paket-medium-lighting', 'Paket Menengah Untuk Kebutuhan Lighting Event Anda', '', 'Y', 3, '2016-03-04', '19:06:07', 'Jumat', 'admin', 4500000, 0, 4, '4 Unit Moving Beam, 12 Unit Par LED, 2 Unit Par Can (Minibrute), 3 Unit Halogen, 1 Unit Smoke Machine, 10 Unit Kembang Api Air Mancur, 1 Unit Confetti Blower LED'),
(54, 62, 'Paket High Lighting', 'paket-high-lighting', 'Pilihan Paket yang sempurna untuk lighting event anda, diskon 5% untuk produk ini.', '', 'Y', 1, '2016-03-04', '19:23:10', 'Jumat', 'admin', 10000000, 5, 4, '10 Unit Moving Beam, 20 Unit Par LED, 4 Unit Minitribute 4 Cell, 6 Unit Frenel, 1 Unit Smoke Machine, 20 Unit Kembang Api Air Mancur, 2 Unit Confetti Mortar, 1 Unit Confetti Blower LED'),
(55, 61, 'Paket Medium Event', 'paket-medium-event', 'Paket Menengah Untuk Event Anda, Harga Spesial Diskon 2%', '', 'Y', 3, '2016-03-04', '19:27:49', 'Jumat', 'admin', 18000000, 2, 3, 'Sound System Ground Stack 10000 Watt, Alat Band Standard Artis, Stage Full Rigging Ukuran 8x6m+Catwalk, 1 Unit Tenda (FOH) Ukuran 4x4m, 1 Unit Tenda (Wing Stage) Ukuran 3x3m, Backdrop Photobooth serta Redcarpet, 8 Unit Par LED, 4 Unit Moving Beam, 2 Unit Par Can (Minibrute), 3 Unit Halogen, 8 Unit kembang api air mancur, 1 Unit Smoke Machine, 1 Unit Confetti Blower LED, Gratis Photoframe Instagram, 1 Unit Tiket Box+Tenda Ukuran 2x2m, 4 Unit Handy Talky');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_session` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `foto`, `level`, `blokir`, `id_session`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'cs.vdproduction@gmail.com', '0818956973', '2a3.jpg', 'admin', 'N', 'q173s8hs1jl04st35169ccl8o7');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
