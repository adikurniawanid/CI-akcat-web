-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Agu 2021 pada 05.51
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akcat`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_kategori` (IN `id_param` VARCHAR(13), IN `kode_param` VARCHAR(5), IN `nama_param` VARCHAR(100), IN `nilai_param` DOUBLE)  INSERT INTO kategori (id, kode, nama, nilai, status_id)
VALUES (id_param,kode_param, nama_param, nilai_param, 0)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_pertanyaan` (IN `id_param` VARCHAR(13), IN `kode_param` VARCHAR(5), IN `pertanyaan_param` TEXT, IN `kategori_id_param` VARCHAR(13), IN `opsi_a_param` TEXT, IN `opsi_b_param` TEXT, IN `opsi_c_param` TEXT, IN `opsi_d_param` TEXT, IN `kunci_param` VARCHAR(1), IN `gambar_param` VARCHAR(500), IN `audio_param` VARCHAR(500))  BEGIN
    INSERT INTO pertanyaan (id, kode, pertanyaan, kategori_id)
    VALUES (id_param, kode_param, pertanyaan_param, kategori_id_param);

    INSERT INTO jawaban (pertanyaan_id, opsi_a, opsi_b, opsi_c, opsi_d, kunci)
    VALUES (id_param, opsi_a_param, opsi_b_param, opsi_c_param, opsi_d_param, kunci_param);

    INSERT INTO content (pertanyaan_id, gambar, audio)
    VALUES (id_param, gambar_param, audio_param);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_peserta` (IN `id_param` VARCHAR(13), IN `username_param` VARCHAR(18), IN `email_param` VARCHAR(30), IN `password_param` VARCHAR(60), IN `nama_param` VARCHAR(30), IN `jenis_kelamin_id_param` INT, IN `no_hp_param` VARCHAR(18), IN `instansi_param` VARCHAR(50))  BEGIN
    INSERT INTO user (id, username, email, password, role_id)
    VALUES (id_param, username_param, email_param, password_param, 2);

    INSERT INTO detail_user (peserta_id, nama, jenis_kelamin_id, no_hp, instansi)
    VALUES (id_param, nama_param, jenis_kelamin_id_param, no_hp_param, instansi_param);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_sesi_ujian` (IN `id_param` VARCHAR(13), IN `kode_param` VARCHAR(5), IN `nama_param` VARCHAR(100), IN `tempat_ujian_param` VARCHAR(100), IN `waktu_mulai_param` DATETIME, IN `durasi_param` INT)  INSERT INTO sesi (id, nama_ujian, tempat_ujian, waktu_mulai, waktu_selesai, durasi, kode, status_id)
VALUES (id_param, nama_param, tempat_ujian_param, waktu_mulai_param, (waktu_mulai_param + interval durasi_param minute) , durasi_param,  kode_param,0)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `arsip_kategori` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE kategori
SET status_id = 2
WHERE id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `arsip_pertanyaan` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE pertanyaan
SET status_id = 2
WHERE id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `arsip_peserta` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE detail_user
SET status_id = 2
WHERE peserta_id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `arsip_sesi_ujian` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE sesi
SET status_id = 2
WHERE id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_kategori` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE kategori
SET status_id = 1
WHERE id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_pertanyaan` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE pertanyaan
SET status_id = 1
WHERE id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_peserta` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE detail_user
SET status_id = 1
WHERE peserta_id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_sesi_ujian` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE sesi
SET status_id = 1
WHERE id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_kategori` (IN `id_param` VARCHAR(13), IN `nama_param` VARCHAR(100), IN `nilai_param` DOUBLE)  UPDATE kategori
SET nama = nama_param,
    nilai = nilai_param
WHERE id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_pertanyaan` (IN `id_param` VARCHAR(13), IN `pertanyaan_param` TEXT, IN `kategori_id_param` VARCHAR(13), IN `opsi_a_param` TEXT, IN `opsi_b_param` TEXT, IN `opsi_c_param` TEXT, IN `opsi_d_param` TEXT, IN `kunci_param` VARCHAR(1), IN `gambar_param` VARCHAR(500), IN `audio_param` VARCHAR(500))  BEGIN
    UPDATE pertanyaan
    SET pertanyaan = pertanyaan_param,
        kategori_id = kategori_id_param
    WHERE id = id_param;

    UPDATE jawaban
    SET opsi_a = opsi_a_param,
        opsi_b = opsi_b_param,
        opsi_c = opsi_c_param,
        opsi_d = opsi_d_param,
        kunci = kunci_param
    WHERE pertanyaan_id = id_param;

    UPDATE content
    SET gambar = gambar_param,
        audio = audio_param
    WHERE pertanyaan_id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_peserta` (IN `id_param` VARCHAR(13), IN `email_param` VARCHAR(30), IN `password_param` VARCHAR(60), IN `nama_param` VARCHAR(30), IN `jenis_kelamin_id_param` INT, IN `no_hp_param` VARCHAR(18), IN `instansi_param` VARCHAR(50))  BEGIN
    IF(isnull(password_param) OR password_param like '') THEN
        UPDATE user 
        SET email = email_param
        WHERE id = id_param;
    ELSE
        UPDATE user 
        SET email = email_param,
            password = password_param
        WHERE id = id_param;
    END IF;

    UPDATE detail_user 
    SET nama = nama_param,
        jenis_kelamin_id = jenis_kelamin_id_param,
        no_hp = no_hp_param,
        instansi = instansi_param
    WHERE peserta_id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_sesi_ujian` (IN `id_param` VARCHAR(13), IN `nama_param` VARCHAR(100), IN `tempat_ujian_param` VARCHAR(100), IN `waktu_mulai_param` DATETIME, IN `durasi_param` INT)  UPDATE sesi
SET nama_ujian = nama_param,
    tempat_ujian = tempat_ujian_param,
    waktu_mulai = waktu_mulai_param,
    waktu_selesai = (waktu_mulai_param + interval durasi_param minute),
    durasi = durasi_param
WHERE id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_jenis_kelamin_list` ()  SELECT id, description FROM detail_jenis_kelamin$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_kategori_arsip_list` ()  SELECT id,
       kode,
       nama,
       nilai
FROM kategori
WHERE status_id = 2
ORDER BY nama$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_kategori_kode` (IN `id_param` VARCHAR(13))  SELECT
       kode
FROM kategori
WHERE id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_kategori_list` ()  SELECT id,
       kode,
       nama,
       nilai
FROM kategori
WHERE status_id = 0
ORDER BY nama$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_kategori_name` (IN `id_param` VARCHAR(13))  SELECT
       nama
FROM kategori
WHERE id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_pertanyaan_arsip_list` ()  SELECT pertanyaan.id,
       pertanyaan.kode as kode,
       nama as kategori,
       pertanyaan
FROM pertanyaan
INNER JOIN kategori k on pertanyaan.kategori_id = k.id
WHERE pertanyaan.status_id = 2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_pertanyaan_detail_by_id` (IN `id_param` VARCHAR(13))  SELECT
       p.id, p.kode, p.pertanyaan, kategori_id, k.nama as kategori, c.gambar, c.audio,j.kunci, j.opsi_a, j.opsi_b, j.opsi_c, j.opsi_d
FROM pertanyaan p
INNER JOIN kategori k on p.kategori_id = k.id
INNER JOIN content c on p.id = c.pertanyaan_id
INNER JOIN jawaban j on p.id = j.pertanyaan_id
WHERE p.status_id = 0
AND p.id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_pertanyaan_kode` (IN `id_param` VARCHAR(13))  SELECT
       kode
FROM pertanyaan
WHERE id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_pertanyaan_list` ()  SELECT
       p.id, p.kode, p.pertanyaan, kategori_id, k.nama as kategori, c.gambar, c.audio,j.kunci, j.opsi_a, j.opsi_b, j.opsi_c, j.opsi_d
FROM pertanyaan p
INNER JOIN kategori k on p.kategori_id = k.id
INNER JOIN content c on p.id = c.pertanyaan_id
INNER JOIN jawaban j on p.id = j.pertanyaan_id

WHERE p.status_id = 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_pertanyaan_list_by_kategori_id` (IN `kategori_id_param` VARCHAR(13))  SELECT
       p.id, p.kode, p.pertanyaan, kategori_id, k.nama as kategori, c.gambar, c.audio,j.kunci, j.opsi_a, j.opsi_b, j.opsi_c, j.opsi_d
FROM pertanyaan p
INNER JOIN kategori k on p.kategori_id = k.id
INNER JOIN content c on p.id = c.pertanyaan_id
INNER JOIN jawaban j on p.id = j.pertanyaan_id
WHERE p.status_id = 0
AND kategori_id = kategori_id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_peserta_arsip_list` ()  SELECT p.id, username, email, nama, description as jenis_kelamin, no_hp, instansi
FROM user p
INNER JOIN detail_user dp on p.id = dp.peserta_id
INNER JOIN detail_jenis_kelamin djk on dp.jenis_kelamin_id = djk.id
WHERE status_id = 2
AND role_id = 2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_peserta_list` ()  SELECT p.id, username, email, nama, description as jenis_kelamin, no_hp, instansi
FROM user p
INNER JOIN detail_user dp on p.id = dp.peserta_id
INNER JOIN detail_jenis_kelamin djk on dp.jenis_kelamin_id = djk.id
WHERE status_id = 0
AND role_id = 2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_peserta_name` (IN `id_param` VARCHAR(13))  BEGIN
    SELECT nama FROM detail_user
        WHERE
    peserta_id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sesi_ujian_arsip_list` ()  SELECT id,
       nama_ujian,
       tempat_ujian,
       waktu_mulai,
       waktu_selesai,
       durasi,
       kode
FROM sesi
WHERE status_id = 2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sesi_ujian_list` ()  SELECT id,
       nama_ujian,
       tempat_ujian,
       waktu_mulai,
       waktu_selesai,
       durasi,
       kode
FROM sesi
WHERE status_id = 0
ORDER BY nama_ujian$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sesi_ujian_name` (IN `id_param` VARCHAR(13))  SELECT
       nama_ujian as nama
FROM sesi
WHERE id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recovery_kategori` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE kategori
SET status_id = 0
WHERE id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recovery_pertanyaan` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE pertanyaan
SET status_id = 0
WHERE id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recovery_peserta` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE detail_user
SET status_id = 0
WHERE peserta_id = id_param;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recovery_sesi_ujian` (IN `id_param` VARCHAR(13))  BEGIN
UPDATE sesi
SET status_id = 0
WHERE id = id_param;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_users`
--

CREATE TABLE `api_users` (
  `user_id` varchar(13) NOT NULL,
  `api_key` varchar(13) NOT NULL,
  `hit` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `api_users`
--

INSERT INTO `api_users` (`user_id`, `api_key`, `hit`) VALUES
('ads', '21', 166);

-- --------------------------------------------------------

--
-- Struktur dari tabel `content`
--

CREATE TABLE `content` (
  `pertanyaan_id` varchar(13) NOT NULL,
  `gambar` varchar(500) DEFAULT NULL,
  `audio` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `content`
--

INSERT INTO `content` (`pertanyaan_id`, `gambar`, `audio`) VALUES
('id_param', NULL, NULL),
('60f8e157b6514', '', ''),
('60f8e1dca113e', '', ''),
('60f8e2a52cea5', NULL, NULL),
('60f8e74f7ad53', '1626924879_f3565a461bfaf4635e75.jpg', NULL),
('60f8e8b704fd5', '1626925239_cf3b4e2364399d00d99b.jpeg', ''),
('60f8e9d2a0f57', '1626925522_29cd9c5d31c402d2295e.jpeg', NULL),
('60f8ea44a6776', '1626925636_e9d60782c3a6af4fb62b.png', NULL),
('60f8ea6f453d3', '1626925679_46e1489473da27061a74.jpeg', NULL),
('60f8f9fa5dfb9', '1626929658_e9ad8affe81903624cb5.jpg', '1626929658_80a3a37b9965ab1c92be.wav'),
('60f8fa0d7ffee', '1626929677_7c5494bce63b884d0086.jpg', '1626929677_f1000f54bd21b789a582.wav'),
('60f8fab7c1560', '1626929847_971d29239a24c6819f05.jpg', '1626929847_d48b42003cf6a1a52b50.wav'),
('60f8fb4d3ed1d', '1626929997_c6faaf35e16a8bbf1ac2.jpg', '1626929997_e3f22291c673bceeb21d.wav'),
('60f8fbff2657f', '1626939920_28da0da5c877bb45c5de.jpg', '1626939931_fd9c7375d9ee9f9d2401.wav'),
('60f8ff4abdb1a', '$nama_gambar', '$nama_audio'),
('60f9001e8fa27', NULL, NULL),
('60f900333912b', '1626931251_d7c6ff0e720015f2b305.jpg', NULL),
('60f90041f37a5', NULL, '1626931266_3899f6725cb29afaf80d.wav'),
('60f938dec8d7d', NULL, NULL),
('60fb7724d35b1', '1627092799_2beb9e896ac4a5564da9.jpg', '1627092799_3ff17a1b4408f05066b6.wav'),
('60fba8734fef7', 'Tidak Ada File', 'Tidak Ada File'),
('60fbab7209507', 'Tidak Ada File', 'Tidak Ada File'),
('60fbacaca6075', NULL, NULL),
('60fbad24d08c2', 'Tidak Ada File', 'Tidak Ada File'),
('09021', NULL, NULL),
('09021212', NULL, NULL),
('0902s1212', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_jenis_kelamin`
--

CREATE TABLE `detail_jenis_kelamin` (
  `id` int(11) NOT NULL,
  `description` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_jenis_kelamin`
--

INSERT INTO `detail_jenis_kelamin` (`id`, `description`) VALUES
(1, 'Pria'),
(2, 'Wanita');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_role`
--

CREATE TABLE `detail_role` (
  `id` int(11) NOT NULL,
  `description` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_role`
--

INSERT INTO `detail_role` (`id`, `description`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_status`
--

CREATE TABLE `detail_status` (
  `id` int(11) NOT NULL,
  `description` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_status`
--

INSERT INTO `detail_status` (`id`, `description`) VALUES
(0, 'Non Trash'),
(1, 'Trash'),
(2, 'Archive');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_type`
--

CREATE TABLE `detail_type` (
  `id` int(11) NOT NULL,
  `description` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_type`
--

INSERT INTO `detail_type` (`id`, `description`) VALUES
(1, 'Kategori'),
(2, 'Pertanyaan'),
(3, 'Peserta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_user`
--

CREATE TABLE `detail_user` (
  `peserta_id` varchar(13) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin_id` int(11) NOT NULL,
  `no_hp` varchar(18) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_user`
--

INSERT INTO `detail_user` (`peserta_id`, `nama`, `jenis_kelamin_id`, `no_hp`, `instansi`, `status_id`) VALUES
('0902s1212', 'Aasdsda', 1, '08218282828', 'UNSRI', 0),
('0902s121s', 'Aasdsda', 1, '08218282828', 'UNSRI', 0),
('123', 'asdasds', 2, '123123213112', 'adssad', 0),
('60fbc74141a24', 'Adi Kurniawan', 0, '0821827510102', 'adsads', 0),
('60fbc910bfa9d', 'Adi Kurniawan', 1, '082182751010', 'UNSRI', 0),
('asdads', 'asdasd', 0, 'asdasd', 'asdsad', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `pertanyaan_id` varchar(13) NOT NULL,
  `opsi_a` text NOT NULL,
  `opsi_b` text NOT NULL,
  `opsi_c` text NOT NULL,
  `opsi_d` text NOT NULL,
  `kunci` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`pertanyaan_id`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `kunci`) VALUES
('60f8e157b6514', 'dasThe following text is for the question number 7 -8 SCHOOL ANNOUNCEMENT To : All students We would like to inform you, that we would be having the school holiday from Thursday 8th to Saturday 10th August 2015. During the holiday, our school has already made plans! We want to go camping in the Highlands to a place called Aviemore. It’s an outdoor centre where you can learn to climb, canoe and fish and do all sorts of exciting things. Of course, we have to take you to Edinburgh Castle and the Fest', '12The following text is for the question number 7 -8 SCHOOL ANNOUNCEMENT To : All students We would like to inform you, that we would be having the school holiday from Thursday 8th to Saturday 10th August 2015. During the holiday, our school has already made plans! We want to go camping in the Highlands to a place called Aviemore. It’s an outdoor centre where you can learn to climb, canoe and fish and do all sorts of exciting things. Of course, we have to take you to Edinburgh Castle and the Fest', 'sad    The following text is for the question number 7 -8 SCHOOL ANNOUNCEMENT To : All students We would like to inform you, that we would be having the school holiday from Thursday 8th to Saturday 10th August 2015. During the holiday, our school has already made plans! We want to go camping in the Highlands to a place called Aviemore. It’s an outdoor centre where you can learn to climb, canoe and fish and do all sorts of exciting things. Of course, we have to take you to Edinburgh Castle and the Fest ', '12The following text is for the question number 7 -8 SCHOOL ANNOUNCEMENT To : All students We would like to inform you, that we would be having the school holiday from Thursday 8th to Saturday 10th August 2015. During the holiday, our school has already made plans! We want to go camping in the Highlands to a place called Aviemore. It’s an outdoor centre where you can learn to climb, canoe and fish and do all sorts of exciting things. Of course, we have to take you to Edinburgh Castle and the Fest', 'A'),
('60f8e1dca113e', 'sdadas', 'ADSDSA', 'ASDDSA', 'ADSDAS', 'A'),
('60f8e2a52cea5', 'adads', 'adsdas', 'adsdas', 'adsdas', 'B'),
('60f8e74f7ad53', 'adasd', 'asdasd', 'asdsad', 'asdds', 'B'),
('60f8e8b704fd5', 'ads', 'ads', 'dsa ', 'ads', 'A'),
('60f8e9d2a0f57', 'adsda', 'asd', 'ads', 'asd', 'A'),
('60f8ea44a6776', 'adsasd', 'adsdsa', 'adsads', 'adsads', 'A'),
('60f8ea6f453d3', 'sdadas', 'asdsad', 'asdsda', 'asdsad', 'A'),
('60f8f9fa5dfb9', 'asdsda', 'ads', 'sad', 'ads', 'A'),
('60f8fa0d7ffee', 'ads', 'ads', 'ads', 'dsa', 'A'),
('60f8fab7c1560', 'adsdsa', 'asdd', 'ads', 'ads', 'A'),
('60f8fb4d3ed1d', 'asddas', 'ads', 'asd', 'ads', 'A'),
('60f8fbff2657f', 'dsaadsd', 'asdadsd', 'sadads  d    ', 'asdadsd', 'D'),
('60f8ff4abdb1a', 'asdsda', 'saddsa', 'sdasad', 'sadasd', 'A'),
('60f9001e8fa27', 'dasasd', 'asdads', 'asdsad', 'asdda', 'A'),
('60f900333912b', 'asd', 'asd', 'das', 'das', 'A'),
('60f90041f37a5', 'asdads', 'asddas', 'asdda', 'asddsa', 'A'),
('60f938dec8d7d', 'asd', 'asd', 'asd', 'ads', 'A'),
('60fb7724d35b1', 'a', 'as', 'd  ', 'e', 'A'),
('60fba8734fef7', 'ayam', 'bakar', 'gurih', 'gg gaming', 'A'),
('60fbab7209507', '2021-07-24 16:53:12', '2021-07-24 16:53:12', '2021-07-24 16:53:12  ', '2021-07-24 16:53:12', 'A'),
('60fbacaca6075', '2021-07-24 16:53:12', '2021-07-24 16:53:12', '2021-07-24 16:53:12', '2021-07-24 16:53:12', 'B'),
('60fbad24d08c2', '2021-07-24 16:53:12', '2021-07-24 16:53:12', '2021-07-24 16:53:12  ', '2021-07-24 16:53:12', 'B'),
('09021', 'A', 'B', 'C', 'D', 'A'),
('09021212', 'A', 'B', 'C', 'D', 'B'),
('0902s1212', 'A', 'B', 'C', 'D', 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` varchar(13) NOT NULL,
  `kode` varchar(5) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` double NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kode`, `nama`, `nilai`, `status_id`) VALUES
('0902s1212', 'dsa2', 'soal eassa', 5, 0),
('1', '5bcaa', '1', 1, 0),
('60f63c6261246', '83821', 'Tes Wawancara', 21, 0),
('60f63c6c8f442', '2df92', 'Tes Wawancara', 5, 0),
('60f63e61bedc8', 'cbb4a', 'das', 12, 0),
('60f63e744300b', '5541b', 'Adi', 2, 0),
('60f63ea41b08b', '20886', 'wawa', 21, 0),
('60f63ef8b94a8', '116fe', 'wea', 21, 0),
('60f63f3f93f76', 'e8f89', '21', 21, 0),
('60f63f56e54a0', '1af57', 'Tes Wawancara', 100, 0),
('60f643e3d60f3', 'b88a0', 'woi', 21, 0),
('60f64427b0c6f', '82839', 'wea', 21, 0),
('60f6447a42098', '08d56', '12', 21, 0),
('60f645b20fa03', '56d9c', '21', 2, 0),
('60f645f699c5c', '2f098', '21', 2, 0),
('60f6467ddebc0', '4867b', 'weawe', 21, 0),
('60f65d3556cf8', 'f1a20', 'ads', 213, 0),
('60f65d39095f5', 'd2dda', '1', 21, 0),
('60f6641bb02af', '7ab14', 'adsaea', 12222, 0),
('60f66fbc7bde7', '75a91', 'Adi GEGE', 2111, 0),
('60f6f21797260', 'e42b9', 'baru', 200, 0),
('60f6f23bb2c87', '6872a', 'atest221', 2111, 0),
('60f6f26468b9c', '34b75', 'atest1', 2111, 0),
('60f6f3d396945', 'dfa3f', 'das', 12, 0),
('60f780fcc0f5b', '8d979', 'as', 2, 0),
('60f8d2cff30d6', 'fbf73', 'SDAD', 213, 0),
('60f8d5ab2bb7c', '25f18', 'as', 123, 0),
('60f8d5bd36aca', '15981', 'sadd', 213, 0),
('60f8d6959db25', 'f9376', 'adsad', 123, 0),
('60f8d6d9c1835', '7e414', 'asda', 21, 0),
('60f9252c019a5', 'f9f4d', 'sda', 21, 0),
('60f9390dee9d7', '79cbc', 'ea', 21, 0),
('60fbbdd5334a6', '73f24', 'The following text is for the question number 7 -8 SCHOOL ANNOUNCEMENT To : All students  We would l', 21, 0),
('60fbbe9d07109', '957b9', 'The following text is for the question number 7 -8 SCHOOL ANNOUNCEMENT To : All students  We would l', 2, 0),
('60fbbef638f93', '09c4b', 'The following text is for the question number 7 -8 SCHOOL ANNOUNCEMENT To : All students  We would l', 21, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` varchar(13) NOT NULL,
  `kode` varchar(5) DEFAULT NULL,
  `pertanyaan` text NOT NULL,
  `kategori_id` varchar(13) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `kode`, `pertanyaan`, `kategori_id`, `status_id`) VALUES
('09021', '09a02', 'soal eassa', '60f63e61bedc8', 0),
('09021212', 'dsa', 'soal ea', '60f63e61bedc8', 0),
('0902s1212', 'dsa2', 'soal ea', '60f63e61bedc8', 0),
('12', '123', 'weaea', '60f63c6261246', 1),
('2131', '12435', 'dwadawdaw', '60f63c6261246', 0),
('31', '1234', 'sdaweaw', '60f63c6261246', 0),
('60f8e08ddcf8b', '03cc9', 'adsads', '60f6641bb02af', 0),
('60f8e094bd328', '359b0', 'adsads', '60f6641bb02af', 0),
('60f8e157b6514', '521f0', 'adsadsea', '60f6641bb02af', 0),
('60f8e1dca113e', '33ce5', 'tes null', '60f8d6959db25', 1),
('60f8e2a52cea5', '51c4d', 'adsdsa', '60f8d6d9c1835', 2),
('60f8e74f7ad53', '8a75e', 'adsasd', '60f8d5ab2bb7c', 0),
('60f8e8b704fd5', '78283', 'adsasdsa', '60f8d6959db25', 1),
('60f8e9d2a0f57', '235d4', 'dsadas', '60f8d6959db25', 0),
('60f8ea44a6776', 'e4436', 'adsdsa', '60f6641bb02af', 0),
('60f8ea6f453d3', '82021', 'adssad', '60f6641bb02af', 0),
('60f8f9fa5dfb9', 'd68ef', 'asdsda', '60f8d6959db25', 0),
('60f8fa0d7ffee', 'ce97a', 'adsasd', '60f6641bb02af', 0),
('60f8fab7c1560', '4eb59', 'adsdas', '60f6641bb02af', 0),
('60f8fb4d3ed1d', '45420', 'dasdsa', '60f6641bb02af', 0),
('60f8fbff2657f', '429c3', 'ada audio dan gambar  tes', '60f8d2cff30d6', 0),
('60f8ff4abdb1a', 'cfa92', 'sad', '60f6641bb02af', 1),
('60f9001e8fa27', 'bee36', 'asd', '60f6641bb02af', 0),
('60f900333912b', '12365', 'dasasd', '60f6641bb02af', 0),
('60f90041f37a5', 'a4f27', 'adsads', '60f6641bb02af', 0),
('60f938dec8d7d', 'f9b8e', 'adsdsa', '60f6641bb02af', 0),
('60fb7724d35b1', '24b41', 'ada apa', '60f65d39095f5', 0),
('60fba8734fef7', 'ba229', 'The following text is for the question number 7 -8\r\nSCHOOL ANNOUNCEMENT\r\nTo : All students\r\n\r\nWe would like to inform you, that we would be having the school holiday from Thursday 8th to Saturday 10th August 2015.\r\nDuring the holiday, our school has already made plans! We want to go camping in the Highlands to a place called Aviemore. It’s an outdoor centre where you can learn to climb, canoe and fish and do all sorts of exciting things.\r\nOf course, we have to take you to Edinburgh Castle and the Fest', '1', 0),
('60fbab7209507', '42aa2', '2021-07-24 16:53:12', '1', 0),
('60fbacaca6075', '70110', '2021-07-24 16:53:12', '1', 0),
('60fbad24d08c2', '2b069', '2021-07-24 16:53:12', '1', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sesi`
--

CREATE TABLE `sesi` (
  `id` varchar(13) NOT NULL,
  `nama_ujian` varchar(100) NOT NULL,
  `tempat_ujian` varchar(100) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `durasi` decimal(10,0) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sesi`
--

INSERT INTO `sesi` (`id`, `nama_ujian`, `tempat_ujian`, `waktu_mulai`, `waktu_selesai`, `durasi`, `kode`, `status_id`) VALUES
('0902s121s', 'ujian gg gimang2', 'palembang', '2021-07-28 11:38:32', '2021-07-28 11:50:32', '12', 'dsas2', 0),
('1231', 'dasea', 'sdaasd', '2021-07-28 11:38:32', '2021-07-28 11:50:32', '12', '3212', 0),
('60d331200a5f7', 'Aktif', 'Palembang', '2021-07-19 19:40:34', '2021-07-20 19:41:09', '120', '0a646', 0),
('60d35c3251147', 'Hapus', 'Palembang', '2021-07-19 19:41:56', '2021-07-20 19:41:58', '123', '511ac', 0),
('60d35d668d009', 'Arsip', 'Palembang', '2021-07-19 19:42:23', '2021-07-20 19:42:25', '122', '8d06b', 0),
('60f788b55f549', '13212', 'asd', '2021-07-21 09:38:00', '2021-07-21 13:09:00', '211', '5e795', 0),
('60f788c853181', '1', '1321', '2021-07-21 09:38:00', '2021-07-21 13:29:00', '231', 'ba0f9', 2),
('60f78900e0676', 'ads', '213', '2021-07-21 09:40:00', '2021-07-21 11:40:00', '120', '1c29f', 2),
('60f7a1a7b5727', 'test waktu mulai param', 'Universitas Sriwijaya', '2021-07-21 11:26:00', '2021-07-21 13:30:00', '124', 'ff11e', 0),
('60f7a7c2ad74e', 'TES CAT MUSI RAWA SESI 1 TRY OUT CPNS UNTUK PGRI', 'palembang', '2021-07-21 11:51:00', '2021-07-21 12:12:00', '120', 'f57cd', 0),
('60f8d65776fed', 'sda', 'dasasd', '2021-07-22 09:22:00', '2021-07-22 12:54:00', '212', '38d50', 0),
('60f8d7061147d', 'adssad', 'adsadseaeaea', '2021-07-22 09:25:00', '2021-07-22 09:46:00', '21', '449c4', 0),
('60f93905add9f', 'sda', 'ads', '2021-07-22 16:24:00', '2021-07-22 18:26:00', '122', '46cfc', 0),
('60fba913a0b38', 'ass', 'ASD', '2021-07-24 12:45:00', '2021-07-24 14:15:00', '90', 'fe481', 0),
('60fbb7cacd947', 'SESI 3 UJIAN TES CPNS LUBUKLINGGAU', 'SESI 3 UJIAN TES CPNS LUBUKLINGGAU', '2021-07-24 13:49:00', '2021-07-24 14:10:00', '21', 'b3e64', 0),
('60fbbf5706493', 'The following text is for the question number 7 -8 SCHOOL ANNOUNCEMENT To : All students  We would l', 'The following text is for the question number 7 -8 SCHOOL ANNOUNCEMENT To : All students  We would l', '2021-07-31 14:21:00', '2021-07-31 14:42:00', '21', '6e6cf', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` varchar(13) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role_id`) VALUES
('0902s1212', 'dsa2', 'soal ea@gmail.com', '60f63e61bedc8', 2),
('0902s121s', 'dsas2', 'soalsa@gmail.com', '60f63e61bedc8', 2),
('123', '213', '13132@sadasd.com', 'adsads1213', 2),
('60fbc74141a24', '', 'adhi.kurniawan2s101@gmail.com', 'adsasdasd', 2),
('60fbc910bfa9d', 'keizzo2101', 'adhi.kurniawan2101@gmail.com', 'woiadigege', 2),
('asdads', 'asdasd', 'asddsa', 'adssda', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `waktu`
--

CREATE TABLE `waktu` (
  `item_id` varchar(13) NOT NULL,
  `created_at` datetime NOT NULL,
  `last_edited` datetime DEFAULT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `waktu`
--

INSERT INTO `waktu` (`item_id`, `created_at`, `last_edited`, `type_id`) VALUES
('12', '2021-07-24 12:52:59', NULL, 2),
('2131', '2021-07-24 11:53:01', NULL, 2),
('31', '2021-07-24 11:53:04', NULL, 2),
('60f8e08ddcf8b', '2021-07-24 10:53:06', NULL, 2),
('60f8e094bd328', '2021-07-24 09:53:08', NULL, 2),
('60f8e157b6514', '2021-07-24 08:53:10', NULL, 2),
('60f8e1dca113e', '2021-07-24 16:53:12', NULL, 2),
('60f8e2a52cea5', '2021-07-24 12:53:15', NULL, 2),
('60f8e74f7ad53', '2021-07-24 16:53:12', NULL, 2),
('60f8e8b704fd5', '2021-07-24 16:53:12', NULL, 2),
('60f8e9d2a0f57', '2021-07-24 16:53:12', NULL, 2),
('60f8ea44a6776', '2021-07-24 16:53:12', NULL, 2),
('60f8ea6f453d3', '2021-07-24 16:53:12', NULL, 2),
('60f8f9fa5dfb9', '2021-07-24 16:53:12', NULL, 2),
('60f8fa0d7ffee', '2021-07-24 16:53:12', NULL, 2),
('60f8fab7c1560', '2021-07-24 16:53:12', NULL, 2),
('60f8fb4d3ed1d', '2021-07-24 16:53:12', NULL, 2),
('60f8fbff2657f', '2021-07-24 16:53:12', NULL, 2),
('60f8ff4abdb1a', '2021-07-24 16:53:12', NULL, 2),
('60f9001e8fa27', '2021-07-24 16:53:12', NULL, 2),
('60f900333912b', '2021-07-24 16:53:12', NULL, 2),
('60f90041f37a5', '2021-07-24 16:53:12', NULL, 2),
('60f938dec8d7d', '2021-07-24 16:53:12', NULL, 2),
('60fb7724d35b1', '2021-07-24 16:53:12', NULL, 2),
('60fba8734fef7', '2021-07-24 16:53:12', NULL, 2),
('60fbab7209507', '2021-07-24 12:56:02', NULL, 2),
('60fbad24d08c2', '2021-07-24 13:03:16', NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `api_users`
--
ALTER TABLE `api_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `api_key` (`api_key`);

--
-- Indeks untuk tabel `detail_jenis_kelamin`
--
ALTER TABLE `detail_jenis_kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_role`
--
ALTER TABLE `detail_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_type`
--
ALTER TABLE `detail_type`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_user`
--
ALTER TABLE `detail_user`
  ADD PRIMARY KEY (`peserta_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_kode_uindex` (`kode`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pertanyaan_kode_uindex` (`kode`);

--
-- Indeks untuk tabel `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_username_uindex` (`username`),
  ADD UNIQUE KEY `user_email_uindex` (`email`);

--
-- Indeks untuk tabel `waktu`
--
ALTER TABLE `waktu`
  ADD UNIQUE KEY `waktu_item_id_uindex` (`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
