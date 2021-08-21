-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 21 Agu 2021 pada 12.44
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_peserta_ujian` (IN `no_peserta_param` VARCHAR(5), IN `peserta_id_param` VARCHAR(13), IN `kode_param` VARCHAR(13))  BEGIN
    DECLARE sesi_id_var varchar(13);
    SET sesi_id_var = (SELECT id FROM sesi WHERE kode = kode_param);

    IF(SELECT EXISTS(SELECT no_peserta FROM peserta_ujian WHERE trash_id = 1 AND peserta_id = peserta_id_param AND sesi_id = sesi_id_var)) THEN
        UPDATE peserta_ujian
            SET trash_id = 0
        WHERE peserta_id = peserta_id_param
        AND sesi_id = sesi_id_var;
    ELSE
        INSERT INTO peserta_ujian (no_peserta, peserta_id, sesi_id)
    VALUES (no_peserta_param, peserta_id_param, sesi_id_var);
    END IF;

    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_sesi_ujian` (IN `id_param` VARCHAR(13), IN `kode_param` VARCHAR(5), IN `nama_param` VARCHAR(100), IN `tempat_ujian_param` VARCHAR(100), IN `waktu_mulai_param` DATETIME, IN `durasi_param` INT)  INSERT INTO sesi (id, nama_ujian, tempat_ujian, waktu_mulai, waktu_selesai, durasi, kode, status_id)
VALUES (id_param, nama_param, tempat_ujian_param, waktu_mulai_param, (waktu_mulai_param + interval durasi_param minute) , durasi_param,  kode_param,0)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `arsip_kategori` (IN `id_param` VARCHAR(13))  BEGIN
    DECLARE status_id_var tinyint;

    SET status_id_var =  (SELECT status_id FROM kategori WHERE id = id_param);

    IF status_id_var = 0 THEN
        UPDATE kategori
        SET status_id = 2
        WHERE id = id_param;
    ELSE 
        UPDATE kategori
        SET status_id = 0
        WHERE id = id_param;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `arsip_pertanyaan` (IN `id_param` VARCHAR(13))  BEGIN
DECLARE status_id_var tinyint;

    SET status_id_var =  (SELECT status_id FROM pertanyaan WHERE id = id_param);

    IF status_id_var = 0 THEN
        UPDATE pertanyaan
        SET status_id = 2
        WHERE id = id_param;
    ELSE 
        UPDATE pertanyaan
        SET status_id = 0
        WHERE id = id_param;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `arsip_peserta` (IN `id_param` VARCHAR(13))  BEGIN
DECLARE status_id_var tinyint;

    SET status_id_var =  (SELECT status_id FROM user WHERE id = id_param);

    IF status_id_var = 0 THEN
        UPDATE user
        SET status_id = 2
        WHERE id = id_param;
    ELSE
        UPDATE user
        SET status_id = 0
        WHERE id = id_param;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `arsip_sesi_ujian` (IN `id_param` VARCHAR(13))  BEGIN
DECLARE status_id_var tinyint;

    SET status_id_var =  (SELECT status_id FROM sesi WHERE id = id_param);

    IF status_id_var = 0 THEN
        UPDATE sesi
        SET status_id = 2
        WHERE id = id_param;
    ELSE
        UPDATE sesi
        SET status_id = 0
        WHERE id = id_param;
    END IF;
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
UPDATE user
SET status_id = 1
WHERE id = id_param;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_detail_edit_kategori` (IN `id_param` VARCHAR(13))  SELECT id, kategori.nama, nilai, kode FROM akcat.kategori
WHERE id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_detail_edit_pertanyaan` (IN `id_param` VARCHAR(13))  SELECT
       p.id, p.kode, p.pertanyaan, kategori_id, k.nama as kategori, c.gambar, c.audio,j.kunci, j.opsi_a, j.opsi_b, j.opsi_c, j.opsi_d
FROM pertanyaan p
INNER JOIN kategori k on p.kategori_id = k.id
INNER JOIN content c on p.id = c.pertanyaan_id
INNER JOIN jawaban j on p.id = j.pertanyaan_id
WHERE p.id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_detail_edit_peserta` (IN `id_param` VARCHAR(13))  SELECT p.id, username, email, nama, description as jenis_kelamin, no_hp, instansi
FROM user p
INNER JOIN detail_user dp on p.id = dp.peserta_id
INNER JOIN detail_jenis_kelamin djk on dp.jenis_kelamin_id = djk.id
WHERE p.id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_detail_edit_sesi_ujian` (IN `id_param` VARCHAR(13))  SELECT id,
       nama_ujian,
       tempat_ujian,
       waktu_mulai,
       waktu_selesai,
       durasi,
       kode
FROM sesi
WHERE id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_jenis_kelamin_list` ()  SELECT id, description FROM detail_jenis_kelamin$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_jumlah_kategori` ()  SELECT count(id) as RESULT
from kategori
where status_id = 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_jumlah_pertanyaan` ()  SELECT count(id) as RESULT
from pertanyaan join jawaban j on pertanyaan.id = j.pertanyaan_id
where status_id = 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_jumlah_peserta` ()  SELECT count(p.id) as RESULT
FROM user p
INNER JOIN detail_user dp on p.id = dp.peserta_id
INNER JOIN detail_jenis_kelamin djk on dp.jenis_kelamin_id = djk.id
WHERE status_id = 0
AND role_id = 2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_jumlah_sesi_ujian` ()  SELECT count(id) as RESULT
from sesi
where status_id = 0$$

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
       nama as RESULT
FROM kategori
WHERE id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_password_hash` (IN `email_username_param` VARCHAR(50))  SELECT password as RESULT
FROM user
WHERE (username = email_username_param OR email = email_username_param)$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sesi_ujian_user_list` (`user_id_param` VARCHAR(13))  SELECT id,
       nama_ujian,
       tempat_ujian,
       waktu_mulai,
       waktu_selesai,
       durasi,
       kode
FROM sesi
INNER JOIN peserta_ujian pu on sesi.id = pu.sesi_id
WHERE status_id = 0
AND peserta_id = user_id_param
ORDER BY nama_ujian$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_id_by_username_email` (IN `username_email_param` VARCHAR(50))  BEGIN
    SELECT id as RESULT FROM user
        WHERE
    (email = username_email_param or username = username_email_param) ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_information` (IN `id_param` VARCHAR(13))  SELECT
       email, nama, jenis_kelamin_id, no_hp, instansi
FROM user u
INNER JOIN detail_user du ON u.id = du.peserta_id 
WHERE id = id_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_role` (IN `username_email_param` VARCHAR(13))  SELECT
        role_id as RESULT
FROM user
WHERE username = username_email_param OR email = username_email_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user_status` (IN `username_email_param` VARCHAR(13))  SELECT
        status_id as RESULT
FROM user
WHERE username = username_email_param OR email = username_email_param$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `is_email_exist` (IN `email_param` VARCHAR(50))  SELECT EXISTS(SELECT email FROM user WHERE email = email_param) AS RESULT$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `is_registered_peserta_ujian` (IN `kode_param` VARCHAR(5), IN `user_id_param` VARCHAR(13))  BEGIN
    DECLARE sesi_id_var varchar(13);
    SET sesi_id_var = (SELECT id FROM sesi WHERE kode = kode_param);

SELECT EXISTS(SELECT no_peserta FROM peserta_ujian WHERE sesi_id = sesi_id_var and peserta_id = user_id_param and trash_id=0) AS RESULT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `is_ujian_exist` (IN `kode_param` VARCHAR(5))  SELECT id FROM sesi WHERE kode = kode_param and status_id = 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `is_ujian_valid` (IN `kode_param` VARCHAR(5))  SELECT EXISTS(SELECT id FROM sesi WHERE kode = kode_param and status_id = 0 and waktu_mulai > now()) AS RESULT$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `is_username_exist` (IN `username_param` VARCHAR(50))  SELECT EXISTS(SELECT username FROM user WHERE username = username_param) AS RESULT$$

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
('ads', '21', 170);

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
('6120bc8ae6eee', NULL, NULL),
('6120bcbd1a91d', NULL, NULL),
('6120c1e9607e5', NULL, NULL),
('6120c22108d68', NULL, NULL),
('6120c3786d63b', NULL, NULL),
('6120c49f5c020', NULL, NULL),
('6120c4c9ae7c1', NULL, NULL),
('6120c512d2619', NULL, NULL),
('6120c53a140d1', NULL, NULL),
('6120c56841efb', NULL, NULL),
('6120ccc2eee1e', NULL, NULL),
('6120ccf540505', NULL, NULL),
('6120cd2398c6e', NULL, NULL),
('6120cd4ab7251', NULL, NULL),
('6120cd6d46535', NULL, NULL),
('6120cd9ac90c7', NULL, NULL),
('6120cdc4da762', NULL, NULL),
('6120cdf04580f', NULL, NULL),
('6120ce161edfa', NULL, NULL),
('6120ce3c8830f', NULL, NULL),
('6120cf1944bdd', NULL, NULL),
('6120cf478d1ac', NULL, NULL),
('6120cf7e43563', NULL, NULL),
('6120cfb379f71', NULL, NULL),
('6120cfe0723df', NULL, NULL),
('6120d00f26598', NULL, NULL),
('6120d04583fa0', NULL, NULL),
('6120d06d57a44', NULL, NULL),
('6120d09ba47db', NULL, NULL),
('6120d0c311c3b', NULL, NULL),
('6120d1e6239a3', NULL, NULL),
('6120d2640df25', NULL, NULL),
('6120d2a502b5f', NULL, NULL),
('6120d2e2b731f', NULL, NULL),
('6120d32993031', NULL, NULL),
('6120d397846ed', NULL, NULL),
('6120d3d363018', NULL, NULL),
('6120d4124d3f1', NULL, NULL),
('6120d448beccf', NULL, NULL),
('6120d4796d381', NULL, NULL),
('6120d65aa4cdb', NULL, NULL),
('6120d685915d6', NULL, NULL),
('6120d6aec9ac8', NULL, NULL),
('6120d6ece5e21', NULL, NULL),
('6120d72055e41', NULL, NULL),
('6120d74f60edb', NULL, NULL),
('6120d78b78200', NULL, NULL),
('6120d7b81199e', NULL, NULL),
('6120d7ecd8227', NULL, NULL),
('6120d88090c21', '', '');

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
  `instansi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_user`
--

INSERT INTO `detail_user` (`peserta_id`, `nama`, `jenis_kelamin_id`, `no_hp`, `instansi`) VALUES
('6120bda180892', 'akdev2101', 1, '082182751010', 'akdev'),
('6120c319ae2b6', 'Adi Kurniawan', 1, '082182751010', 'Universitas Sriwijaya');

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
('6120bc8ae6eee', 'A chef', 'A cook', 'A baker', 'A salesperson', 'C'),
('6120bcbd1a91d', 'He gets the news about the President.', 'He has been told by the spokesman.', 'He calls the President’s spokesman. ', 'He finds the spokesman.', 'B'),
('6120c1e9607e5', 'in a restaurant', 'in a bank', 'in a post office', 'at the train station', 'C'),
('6120c22108d68', 'He has been there for an hour', 'He has left before an hour', 'He has waited for just some minutes.', 'He has been there for thirty minutes.', 'D'),
('6120c3786d63b', 'At the cinema', 'At a restaurant', 'At home', 'At a museum', 'B'),
('6120c49f5c020', 'He has something to do.', 'He’s also happy that the classes are finished.', 'He is in the classroom.', 'He’s glad to talk about the classroom.', 'B'),
('6120c4c9ae7c1', 'The man’s birthday', 'The woman’s birthday', 'A friend’s birthday', 'Their mother’s birthday', 'C'),
('6120c512d2619', 'He exports some photos.', 'He takes a photo.', 'He is not very skilled.', 'He is an expert.', 'C'),
('6120c53a140d1', 'Asking for help from a lawyer', 'Becoming a lawyer.', 'Seeing the women’s lawyer.', 'Finding a lawyer for the woman.', 'A'),
('6120c56841efb', 'It’s short.', 'It’s simple.', 'It’s nice.', 'It’s important.', 'B'),
('6120ccc2eee1e', 'The stereo is very loud.', 'She does not want to hear the stereo.', 'The stereo is loud enough.', 'The man can increase the volume.', 'D'),
('6120ccf540505', 'In a bank', 'In an airport', 'In a store', 'In a hotel', 'D'),
('6120cd2398c6e', 'She feels the same as the man.', 'She has a different feeling from the man.', 'She is not happy being there.', 'She doesn’t share with the man.', 'A'),
('6120cd4ab7251', 'He has the newest chemistry book by his own.', 'He has just borrowed a chemistry book.', 'He did not find the newest chemistry book in the book store.', 'He have looked for the chemistry book in the library.', 'A'),
('6120cd6d46535', 'Diana has already known about it.', 'Diana has just been told about it.', 'The woman has not told Diana yet.', 'The woman doesn’t know either.', 'C'),
('6120cd9ac90c7', 'He wants to ride with the woman.', 'The man will drive the woman home.', 'The woman may leave the man there.', 'He is not going home alone.', 'C'),
('6120cdc4da762', 'She is going somewhere.', 'She wants to go with the man.', 'She will stay at home.', 'She is visiting her hometown.', 'C'),
('6120cdf04580f', 'The sandwich is so bland.', 'He has a sandwich for lunch.', 'The sandwich needs some more ingredients.', 'The sandwich is delicious.', 'D'),
('6120ce161edfa', 'She doesn’t want to go to class.', 'The course starts in the evening.', 'She takes the course with the man.', 'The course is canceled.', 'B'),
('6120ce3c8830f', 'He wants to enjoy the sunny day.', 'He wants to stay at home.', 'He wants to go with his son together.', 'The woman can go alone.', 'A'),
('6120cf1944bdd', 'She will buy the ticket today.', 'She has some problem with her flight ticket.', 'She is not very healthy.', 'She does not feel that her flight is well-prepared.', 'A'),
('6120cf478d1ac', 'His baby slept.', 'His baby was playing in bed.', 'His baby doesn’t like to sleep.', 'His baby was awake.', 'D'),
('6120cf7e43563', 'He shares the woman’s opinion.', 'He doesn’t believe the woman.', 'He disagrees with the woman.', 'He has his own opinion about the weather.', 'A'),
('6120cfb379f71', 'Jimmy’s father is a professor.', 'Jimmy wants to be a professor.', 'Jimmy is discussing his thesis.', 'jimmy is typing his thesis.', 'A'),
('6120cfe0723df', ' He’s not sure about the exam.', 'He received a passing grade.', 'He does not satisfy with his previous test score.', 'His test score is very good.', 'C'),
('6120d00f26598', 'Re-writing the essay', ' Throwing the essay', 'Deleting the mistakes', 'Consulting the essay', 'D'),
('6120d04583fa0', 'He wants to offer her orange juice.', 'He asks for a glass of orange juice.', 'He peels oranges in his kitchen.', 'He has just picked some oranges.', 'A'),
('6120d06d57a44', 'The math test will still be held that day.', 'It is impossible to have the test today.', 'The test is still going on.', 'The test has just been handed out.', 'B'),
('6120d09ba47db', 'In a fast-food restaurant', 'In a grocery store', 'In a harbor', 'In an internet center', 'D'),
('6120d0c311c3b', 'He should finish the drink', 'The drink is good.', 'She wants the man to buy her a drink', 'She will buy him another drink', 'D'),
('6120d1e6239a3', 'Everyday life in the Canadian Arctic', 'The Importance of the mythology in Inuuit life', 'The subject of Inuit art', 'The value of Inuit art', 'C'),
('6120d2640df25', 'Carefully', 'Presumably', 'Closely', 'Formally', 'C'),
('6120d2a502b5f', 'It presents a nearly complete picture of Inuit life', 'It covers one aspect of Inuit life thoroughly ', 'It focuses mainly on scenes of Inuit camp and family life', 'It is the main way Inuit myths are passed from one generation to another ', 'A'),
('6120d2e2b731f', 'Predictable', 'Total', 'Traditional', 'Necessary ', 'B'),
('6120d32993031', 'Observance of taboos', 'Inuit life in the past few decades', 'Preparation for a hunt ', 'An animal ', 'B'),
('6120d397846ed', 'Capturing', 'Tricking', 'Following', 'Studying', 'C'),
('6120d3d363018', 'Eliminate', 'Represent', 'Decorate', 'Enlarge ', 'D'),
('6120d4124d3f1', 'a', 'b', 'c', 'd', 'A'),
('6120d448beccf', 'Depicting seasonal changes in animals ', 'Demonstrating accurate naturalistic detail', 'Exaggerating physical characteristics for dramatic effect', 'Revealing the essence of their subject’s spirit', 'C'),
('6120d4796d381', 'Woman sewing clothes', 'Modern activities ', 'Community games', 'Drum dancing ', 'B'),
('6120d65aa4cdb', 'The effects of glaciers', 'The domestication of crops', 'Genetics variants of cultivated crops', 'Eating habits of the earliest humans', 'C'),
('6120d685915d6', 'Forests ', 'Eurasia and north America ', 'Grassland', 'Large animal', 'C'),
('6120d6aec9ac8', 'Decreased', 'Doubled', 'Differed', 'Dominated ', 'A'),
('6120d6ece5e21', 'Attractive', 'Fresh', 'Important', 'Dependable', 'D'),
('6120d72055e41', 'Successful', 'Regular', 'Dependent', 'Intention', 'D'),
('6120d74f60edb', 'How to cultivate crops', 'That grains could be used as a food source ', 'How to increase their crop yields', 'How to combine seeds to create a superior type of grain', 'B'),
('6120d78b78200', 'Learned ', 'Evaluated', 'Begun', 'Repeated', 'C'),
('6120d7b81199e', 'Cultivated wheat stalks produce larger seeds that are easier to plant', 'Cultivated wheat stalks hold seeds so they can be gathered and replanted', 'Cultivated wheat stalks produces more seeds', 'Cultivated wheat stalks help scatter seeds as they ', 'A'),
('6120d7ecd8227', 'Its stalk needs to be strengthened', 'It needs to be protected from cold', 'It needs to be planted on grasslands', 'd', 'A'),
('6120d88090c21', 'Manufacture', 'Increase', 'Power ', 'Support', 'C');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` varchar(13) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` double NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kode`, `nama`, `nilai`, `status_id`) VALUES
('6120b7191b189', '96d4d', 'Listening - Conversation Singkat', 1, 0),
('6120d19792c4f', '33268', 'Reading - Passage 1', 1, 0),
('6120d6220dd64', '42e38', 'Reading - Passage 2', 1, 0),
('6120d88928513', '5dc2a', 'Reading - Passage 3', 1, 0),
('6120d8c589d52', '5ae1a', 'Reading - Passage 4', 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` varchar(13) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `pertanyaan` text NOT NULL,
  `kategori_id` varchar(13) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `kode`, `pertanyaan`, `kategori_id`, `status_id`) VALUES
('6120bc8ae6eee', '4c0e8', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I saw your mother at the bakery this morning.</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>Really? Did you say hello? My mother works there.</em></p><p>(narrator)&nbsp;:&nbsp;<em>Who is the woman&rsquo;s mother likely to be?</em></p>', '6120b7191b189', 0),
('6120bcbd1a91d', 'f4b75', '<p>(woman)   : <em>The President can’t attend the banquette.</em></p><p>(man)        : <em>I already know. His spokesman told me.</em></p><p>(narrator) : <em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120c1e9607e5', '7b415', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>The letter for our client has not arrived yet. Do you know why the delay is?</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>I&rsquo;m so sorry. Actually, the courier has not sent it yet.</em></p><p>(narrator)&nbsp;:&nbsp;<em>Where does the dialog probably take place?</em></p>', '6120b7191b189', 0),
('6120c22108d68', '6b78f', '<p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>How long have you been here?</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I&rsquo;ve been here for half an hour.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120c3786d63b', 'f6bc2', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I was looking for you at your house last night.</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>I&rsquo;m sorry. I went out for dinner with my parents last night.</em></p><p>(narrator)&nbsp;:&nbsp;<em>Where were the woman and her parents?</em></p>', '6120b7191b189', 0),
('6120c49f5c020', '5dc28', '<p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>I&rsquo;m so happy because the class is over.</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Me too.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120c4c9ae7c1', '0bf71', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>This is so ridiculous! You shouldn&rsquo;t have done that!</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>I know. We just want to give him a surprise on his birthday!</em></p><p>(narrator)&nbsp;:&nbsp;<em>Whose birthday is it?</em></p>', '6120b7191b189', 0),
('6120c512d2619', '5275c', '<p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>Do you like photography?</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Yes, I do. But I&rsquo;m not an expert.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120c53a140d1', '6e8f2', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I don&rsquo;t understand anything about law.</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>Why don&rsquo;t you see a lawyer to help you?</em></p><p>(narrator) :&nbsp;<em>What is the woman&rsquo;s suggestion?</em></p>', '6120b7191b189', 0),
('6120c56841efb', 'd210b', '<p>(woman)&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Do you need help?</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>No, thanks. It&rsquo;s not a big deal.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the man mean about the deal?</em></p>', '6120b7191b189', 0),
('6120ccc2eee1e', '4c7d9', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I can&rsquo;t hear the stereo.</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>You can turn it up.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the woman mean?</em></p>', '6120b7191b189', 0),
('6120ccf540505', 'ec414', '<p>(woman)&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Good morning. I have a reservation for a single room under the name Mrs. Jazz.</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Good morning, mam. Your room number is 324, and here is your key.</em></p><p>(narrator)&nbsp;:&nbsp;<em>Where does the conversation probably take place?</em></p>', '6120b7191b189', 0),
('6120cd2398c6e', 'dad0e', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>This is a very nice place! Beautiful mountain and green trees! I am glad to be here.</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>Same with me.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the woman mean?</em></p>', '6120b7191b189', 0),
('6120cd4ab7251', '79cba', '<p>(woman)&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Where have you been?</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I&rsquo;ve been in the book store. I have just bought the newest chemistry book.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120cd6d46535', '46ec9', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Have you told Diana about the meeting cancellation.</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>I&rsquo;m going to tell her later.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the woman mean?</em></p>', '6120b7191b189', 0),
('6120cd9ac90c7', '38890', '<p>(woman)&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I have to go home right now. Do you still want a ride with me?</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I need to stay for fifteen minutes longer.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120cdc4da762', '5507f', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Do you have any plans for the weekend? I&rsquo;m going to my grandma&rsquo;s house.</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>No, I don&rsquo;t. I&rsquo;m not going anywhere.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the woman mean?</em></p>', '6120b7191b189', 0),
('6120cdf04580f', '51ad3', '<p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>Do you think that this sandwich needs some ingredients?</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: No,&nbsp;<em>it&rsquo;s so good already.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120ce161edfa', '04c88', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>It&rsquo;s 2 pm already. When will the course begin?</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>It will begin at 6 pm.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the woman mean?</em></p>', '6120b7191b189', 0),
('6120ce3c8830f', '50f3a', '<p>(woman) :&nbsp;<em>It&rsquo;s a sunny day. Let&rsquo;s go outside together.</em></p><p>(man) :&nbsp;<em>OK. Let&rsquo;s go.</em></p><p>(narrator) :&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120cf1944bdd', 'bef27', '<p>*Gatau Jawaban Benar</p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>You look so upset. Are there any problems with your flight ticket?</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>No, there isn&rsquo;t. I just don&rsquo;t feel well today.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the woman mean?</em></p>', '6120b7191b189', 0),
('6120cf478d1ac', '2759b', '<p>(woman)&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I heard your baby cried last night.</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>He couldn&rsquo;t sleep.</em></p><p>(narrator) :&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120cf7e43563', 'f0d1c', '<p>(woman)&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>The weather makes me uncomfortable.</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>You can say that again.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120cfb379f71', 'd9b0a', '<p>*Gatau Jawaban Benar</p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Do you know where Jimmy is?</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>I think he is consulting his thesis to the professor.</em></p><p>(narrator) :&nbsp;<em>What does the woman mean?</em></p>', '6120b7191b189', 0),
('6120cfe0723df', 'b7621', '<p>(woman)&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>What are you doing?</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>My previous test score was not very good. Now I&rsquo;m studying harder for the next test tomorrow.</em></p><p>(narrator) :&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120d00f26598', 'cc513', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>This essay has still many mistakes.</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>Why don&rsquo;t you discuss with your friend to minimize the mistakes?</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the woman suggest?</em></p>', '6120b7191b189', 0),
('6120d04583fa0', '3afe9', '<p>(woman)&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I&rsquo;m so thirsty.</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Let&rsquo;s go to my kitchen. I have some orange juice there.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the man mean?</em></p>', '6120b7191b189', 0),
('6120d06d57a44', '8390e', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Ma&rsquo;am, is it our math test today?</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>I&rsquo;m sorry. We don&rsquo;t have enough time. We have to postpone it until next time.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the woman mean?</em></p>', '6120b7191b189', 0),
('6120d09ba47db', '9906c', '<p>(woman)&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Excuse me. May I help you, Sir?</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>No, I&rsquo;m just browsing.</em></p><p>(narrator)&nbsp;:&nbsp;<em>Where does the conversation probably take place?</em></p>', '6120b7191b189', 0),
('6120d0c311c3b', '0cf25', '<p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>I don&rsquo;t like the taste of the drink.</em></p><p>(woman)&nbsp;&nbsp;&nbsp;:&nbsp;<em>Really? I&rsquo;ll get another drink for you.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the woman mean?</em></p>', '6120b7191b189', 0),
('6120d1e6239a3', '90589', '<p>Keyword: Inuit Art, Canadian Arctic</p><p>Inspiration for the themes in Inuit art is intimately tied to personal experience of the Canadian Arctic land and its animals, camp and family life, hunting , spirituality, and mythology. In telling the story of their people through this wide array subject, inuits artists have created an almost encyclopedic visual catalog of traditional (and to a lesser extent transitional and modern) Inuit culture.</p><p>Animals play a vital role in the everyday lives of Inuit, and only in the past few decades has the people&rsquo;s absolute dependence on them lessened. Not too long ago, procuring food and other necessities depended solely on successful hunts, which in turn depended upon proper preparation and luck, in addition to the strict observance of taboos and respect for the sosul of the prey. As a consequence, animals constitute the prime inspiration for many Inuit artists, particularly in sculpture.</p><p>Based on years of observing and tracking prey, Inuit wildlife art shows a keen awareness of the physical characteristics, habits, and seasonal changes in animals. Some artists display a high degree of naturalistic detail, but others prefer to exaggerate certain physical attributes for effect. In general, while most inuit artists strive for a realistic presentation, they seem more concerned with capturing the essence of an animal&rsquo;s spirit.</p><p>Animals may be portrayed singly, in small groups, or in scenes that involve both hunter and prey. Pictorial arts often show the chase, while sculptures focus more on the final confrontation of hunter and prey, often with considerable drama. The hunter may be human or one of the great Arctic predators such as the polar bear, owl, hawk, or wolt.</p><p>Scenes of everyday life, which include camp scenes, games entertainment, are common to all forms of Inuit art, and activities sre far more prevalent than modern aspects of Inuit community life. Camp-related themes mostly potray woman engaged in domestic contests involve both individuals and the community, and drum dancing is a form of entertainment that also has conciderable spiritual significance.</p><p>&nbsp;</p><p>What does the passage mainly discuss?</p>', '6120d19792c4f', 0),
('6120d2640df25', '51bff', '<p>Keyword: Inuit Art, Canadian Arctic</p><p>Inspiration for the themes in Inuit art is intimately tied to personal experience of the Canadian Arctic land and its animals, camp and family life, hunting , spirituality, and mythology. In telling the story of their people through this wide array subject, inuits artists have created an almost encyclopedic visual catalog of traditional (and to a lesser extent transitional and modern) Inuit culture.</p><p>Animals play a vital role in the everyday lives of Inuit, and only in the past few decades has the people&rsquo;s absolute dependence on them lessened. Not too long ago, procuring food and other necessities depended solely on successful hunts, which in turn depended upon proper preparation and luck, in addition to the strict observance of taboos and respect for the sosul of the prey. As a consequence, animals constitute the prime inspiration for many Inuit artists, particularly in sculpture.</p><p>Based on years of observing and tracking prey, Inuit wildlife art shows a keen awareness of the physical characteristics, habits, and seasonal changes in animals. Some artists display a high degree of naturalistic detail, but others prefer to exaggerate certain physical attributes for effect. In general, while most inuit artists strive for a realistic presentation, they seem more concerned with capturing the essence of an animal&rsquo;s spirit.</p><p>Animals may be portrayed singly, in small groups, or in scenes that involve both hunter and prey. Pictorial arts often show the chase, while sculptures focus more on the final confrontation of hunter and prey, often with considerable drama. The hunter may be human or one of the great Arctic predators such as the polar bear, owl, hawk, or wolt.</p><p>Scenes of everyday life, which include camp scenes, games entertainment, are common to all forms of Inuit art, and activities sre far more prevalent than modern aspects of Inuit community life. Camp-related themes mostly potray woman engaged in domestic contests involve both individuals and the community, and drum dancing is a form of entertainment that also has conciderable spiritual significance.</p><p>&nbsp;</p><p>The word &ldquo;intimately&rdquo; in line 1 is closest in meaning to</p>', '6120d19792c4f', 0),
('6120d2a502b5f', 'ef84f', '<p>Inspiration for the themes in Inuit art is intimately tied to personal experience of the Canadian Arctic land and its animals, camp and family life, hunting , spirituality, and mythology. In telling the story of their people through this wide array subject, inuits artists have created an almost encyclopedic visual catalog of traditional (and to a lesser extent transitional and modern) Inuit culture.</p><p>Animals play a vital role in the everyday lives of Inuit, and only in the past few decades has the people&rsquo;s absolute dependence on them lessened. Not too long ago, procuring food and other necessities depended solely on successful hunts, which in turn depended upon proper preparation and luck, in addition to the strict observance of taboos and respect for the sosul of the prey. As a consequence, animals constitute the prime inspiration for many Inuit artists, particularly in sculpture.</p><p>Based on years of observing and tracking prey, Inuit wildlife art shows a keen awareness of the physical characteristics, habits, and seasonal changes in animals. Some artists display a high degree of naturalistic detail, but others prefer to exaggerate certain physical attributes for effect. In general, while most inuit artists strive for a realistic presentation, they seem more concerned with capturing the essence of an animal&rsquo;s spirit.</p><p>Animals may be portrayed singly, in small groups, or in scenes that involve both hunter and prey. Pictorial arts often show the chase, while sculptures focus more on the final confrontation of hunter and prey, often with considerable drama. The hunter may be human or one of the great Arctic predators such as the polar bear, owl, hawk, or wolt.</p><p>Scenes of everyday life, which include camp scenes, games entertainment, are common to all forms of Inuit art, and activities sre far more prevalent than modern aspects of Inuit community life. Camp-related themes mostly potray woman engaged in domestic contests involve both individuals and the community, and drum dancing is a form of entertainment that also has conciderable spiritual significance.</p><p>&nbsp;</p><p>According to the first paragraph, which of the following is a true description of Inuit art?</p>', '6120d19792c4f', 0),
('6120d2e2b731f', '5a21c', '<p>Keyword: Inuit Art, Canadian Arctic</p><p>Inspiration for the themes in Inuit art is intimately tied to personal experience of the Canadian Arctic land and its animals, camp and family life, hunting , spirituality, and mythology. In telling the story of their people through this wide array subject, inuits artists have created an almost encyclopedic visual catalog of traditional (and to a lesser extent transitional and modern) Inuit culture.</p><p>Animals play a vital role in the everyday lives of Inuit, and only in the past few decades has the people&rsquo;s absolute dependence on them lessened. Not too long ago, procuring food and other necessities depended solely on successful hunts, which in turn depended upon proper preparation and luck, in addition to the strict observance of taboos and respect for the sosul of the prey. As a consequence, animals constitute the prime inspiration for many Inuit artists, particularly in sculpture.</p><p>Based on years of observing and tracking prey, Inuit wildlife art shows a keen awareness of the physical characteristics, habits, and seasonal changes in animals. Some artists display a high degree of naturalistic detail, but others prefer to exaggerate certain physical attributes for effect. In general, while most inuit artists strive for a realistic presentation, they seem more concerned with capturing the essence of an animal&rsquo;s spirit.</p><p>Animals may be portrayed singly, in small groups, or in scenes that involve both hunter and prey. Pictorial arts often show the chase, while sculptures focus more on the final confrontation of hunter and prey, often with considerable drama. The hunter may be human or one of the great Arctic predators such as the polar bear, owl, hawk, or wolt.</p><p>Scenes of everyday life, which include camp scenes, games entertainment, are common to all forms of Inuit art, and activities sre far more prevalent than modern aspects of Inuit community life. Camp-related themes mostly potray woman engaged in domestic contests involve both individuals and the community, and drum dancing is a form of entertainment that also has conciderable spiritual significance.</p><p>&nbsp;</p><p>The word &ldquo;absolute&rdquo; in line 8 is closest in meaning to</p>', '6120d19792c4f', 0),
('6120d32993031', 'b9f49', '<p>Keyword: Inuit Art, Canadian Arctic</p><p>Inspiration for the themes in Inuit art is intimately tied to personal experience of the Canadian Arctic land and its animals, camp and family life, hunting , spirituality, and mythology. In telling the story of their people through this wide array subject, inuits artists have created an almost encyclopedic visual catalog of traditional (and to a lesser extent transitional and modern) Inuit culture.</p><p>Animals play a vital role in the everyday lives of Inuit, and only in the past few decades has the people&rsquo;s absolute dependence on them lessened. Not too long ago, procuring food and other necessities depended solely on successful hunts, which in turn depended upon proper preparation and luck, in addition to the strict observance of taboos and respect for the sosul of the prey. As a consequence, animals constitute the prime inspiration for many Inuit artists, particularly in sculpture.</p><p>Based on years of observing and tracking prey, Inuit wildlife art shows a keen awareness of the physical characteristics, habits, and seasonal changes in animals. Some artists display a high degree of naturalistic detail, but others prefer to exaggerate certain physical attributes for effect. In general, while most inuit artists strive for a realistic presentation, they seem more concerned with capturing the essence of an animal&rsquo;s spirit.</p><p>Animals may be portrayed singly, in small groups, or in scenes that involve both hunter and prey. Pictorial arts often show the chase, while sculptures focus more on the final confrontation of hunter and prey, often with considerable drama. The hunter may be human or one of the great Arctic predators such as the polar bear, owl, hawk, or wolt.</p><p>Scenes of everyday life, which include camp scenes, games entertainment, are common to all forms of Inuit art, and activities sre far more prevalent than modern aspects of Inuit community life. Camp-related themes mostly potray woman engaged in domestic contests involve both individuals and the community, and drum dancing is a form of entertainment that also has conciderable spiritual significance.</p><p>&nbsp;</p><p>According to the second paragraph, which of the following is most likely to be the subject of an Inuit sculpture?</p>', '6120d19792c4f', 0),
('6120d397846ed', '2df3d', '<p>Keyword: Inuit Art, Canadian Arctic</p><p>Inspiration for the themes in Inuit art is intimately tied to personal experience of the Canadian Arctic land and its animals, camp and family life, hunting , spirituality, and mythology. In telling the story of their people through this wide array subject, inuits artists have created an almost encyclopedic visual catalog of traditional (and to a lesser extent transitional and modern) Inuit culture.</p><p>Animals play a vital role in the everyday lives of Inuit, and only in the past few decades has the people&rsquo;s absolute dependence on them lessened. Not too long ago, procuring food and other necessities depended solely on successful hunts, which in turn depended upon proper preparation and luck, in addition to the strict observance of taboos and respect for the sosul of the prey. As a consequence, animals constitute the prime inspiration for many Inuit artists, particularly in sculpture.</p><p>Based on years of observing and tracking prey, Inuit wildlife art shows a keen awareness of the physical characteristics, habits, and seasonal changes in animals. Some artists display a high degree of naturalistic detail, but others prefer to exaggerate certain physical attributes for effect. In general, while most inuit artists strive for a realistic presentation, they seem more concerned with capturing the essence of an animal&rsquo;s spirit.</p><p>Animals may be portrayed singly, in small groups, or in scenes that involve both hunter and prey. Pictorial arts often show the chase, while sculptures focus more on the final confrontation of hunter and prey, often with considerable drama. The hunter may be human or one of the great Arctic predators such as the polar bear, owl, hawk, or wolt.</p><p>Scenes of everyday life, which include camp scenes, games entertainment, are common to all forms of Inuit art, and activities sre far more prevalent than modern aspects of Inuit community life. Camp-related themes mostly potray woman engaged in domestic contests involve both individuals and the community, and drum dancing is a form of entertainment that also has conciderable spiritual significance.</p><p>&nbsp;</p><p>The word &ldquo;tracking&rdquo; in line 15 is closest in meaning to</p>', '6120d19792c4f', 0),
('6120d3d363018', '23eba', '<p>Keyword: Inuit Art, Canadian Arctic</p><p>Inspiration for the themes in Inuit art is intimately tied to personal experience of the Canadian Arctic land and its animals, camp and family life, hunting , spirituality, and mythology. In telling the story of their people through this wide array subject, inuits artists have created an almost encyclopedic visual catalog of traditional (and to a lesser extent transitional and modern) Inuit culture.</p><p>Animals play a vital role in the everyday lives of Inuit, and only in the past few decades has the people&rsquo;s absolute dependence on them lessened. Not too long ago, procuring food and other necessities depended solely on successful hunts, which in turn depended upon proper preparation and luck, in addition to the strict observance of taboos and respect for the sosul of the prey. As a consequence, animals constitute the prime inspiration for many Inuit artists, particularly in sculpture.</p><p>Based on years of observing and tracking prey, Inuit wildlife art shows a keen awareness of the physical characteristics, habits, and seasonal changes in animals. Some artists display a high degree of naturalistic detail, but others prefer to exaggerate certain physical attributes for effect. In general, while most inuit artists strive for a realistic presentation, they seem more concerned with capturing the essence of an animal&rsquo;s spirit.</p><p>Animals may be portrayed singly, in small groups, or in scenes that involve both hunter and prey. Pictorial arts often show the chase, while sculptures focus more on the final confrontation of hunter and prey, often with considerable drama. The hunter may be human or one of the great Arctic predators such as the polar bear, owl, hawk, or wolt.</p><p>Scenes of everyday life, which include camp scenes, games entertainment, are common to all forms of Inuit art, and activities sre far more prevalent than modern aspects of Inuit community life. Camp-related themes mostly potray woman engaged in domestic contests involve both individuals and the community, and drum dancing is a form of entertainment that also has conciderable spiritual significance.</p><p>&nbsp;</p><p>The word &ldquo;exaggerate&rdquo; in line &nbsp;18 is closest in meaning to</p>', '6120d19792c4f', 0),
('6120d4124d3f1', '7b621', '<p>*Gatau Soalnya<br />Jawabannya Pokoknya&nbsp;3 suku kata<br /><br />Keyword: Inuit Art, Canadian Arctic</p><p>Inspiration for the themes in Inuit art is intimately tied to personal experience of the Canadian Arctic land and its animals, camp and family life, hunting , spirituality, and mythology. In telling the story of their people through this wide array subject, inuits artists have created an almost encyclopedic visual catalog of traditional (and to a lesser extent transitional and modern) Inuit culture.</p><p>Animals play a vital role in the everyday lives of Inuit, and only in the past few decades has the people&rsquo;s absolute dependence on them lessened. Not too long ago, procuring food and other necessities depended solely on successful hunts, which in turn depended upon proper preparation and luck, in addition to the strict observance of taboos and respect for the sosul of the prey. As a consequence, animals constitute the prime inspiration for many Inuit artists, particularly in sculpture.</p><p>Based on years of observing and tracking prey, Inuit wildlife art shows a keen awareness of the physical characteristics, habits, and seasonal changes in animals. Some artists display a high degree of naturalistic detail, but others prefer to exaggerate certain physical attributes for effect. In general, while most inuit artists strive for a realistic presentation, they seem more concerned with capturing the essence of an animal&rsquo;s spirit.</p><p>Animals may be portrayed singly, in small groups, or in scenes that involve both hunter and prey. Pictorial arts often show the chase, while sculptures focus more on the final confrontation of hunter and prey, often with considerable drama. The hunter may be human or one of the great Arctic predators such as the polar bear, owl, hawk, or wolt.</p><p>Scenes of everyday life, which include camp scenes, games entertainment, are common to all forms of Inuit art, and activities sre far more prevalent than modern aspects of Inuit community life. Camp-related themes mostly potray woman engaged in domestic contests involve both individuals and the community, and drum dancing is a form of entertainment that also has conciderable spiritual significance.</p>', '6120d19792c4f', 0),
('6120d448beccf', '78536', '<p>Keyword: Inuit Art, Canadian Arctic</p><p>Inspiration for the themes in Inuit art is intimately tied to personal experience of the Canadian Arctic land and its animals, camp and family life, hunting , spirituality, and mythology. In telling the story of their people through this wide array subject, inuits artists have created an almost encyclopedic visual catalog of traditional (and to a lesser extent transitional and modern) Inuit culture.</p><p>Animals play a vital role in the everyday lives of Inuit, and only in the past few decades has the people&rsquo;s absolute dependence on them lessened. Not too long ago, procuring food and other necessities depended solely on successful hunts, which in turn depended upon proper preparation and luck, in addition to the strict observance of taboos and respect for the sosul of the prey. As a consequence, animals constitute the prime inspiration for many Inuit artists, particularly in sculpture.</p><p>Based on years of observing and tracking prey, Inuit wildlife art shows a keen awareness of the physical characteristics, habits, and seasonal changes in animals. Some artists display a high degree of naturalistic detail, but others prefer to exaggerate certain physical attributes for effect. In general, while most inuit artists strive for a realistic presentation, they seem more concerned with capturing the essence of an animal&rsquo;s spirit.</p><p>Animals may be portrayed singly, in small groups, or in scenes that involve both hunter and prey. Pictorial arts often show the chase, while sculptures focus more on the final confrontation of hunter and prey, often with considerable drama. The hunter may be human or one of the great Arctic predators such as the polar bear, owl, hawk, or wolt.</p><p>Scenes of everyday life, which include camp scenes, games entertainment, are common to all forms of Inuit art, and activities sre far more prevalent than modern aspects of Inuit community life. Camp-related themes mostly potray woman engaged in domestic contests involve both individuals and the community, and drum dancing is a form of entertainment that also has conciderable spiritual significance.</p><p>&nbsp;</p><p>According to the third paragraph which of the following is the primary concern of most Inuit artists?</p>', '6120d19792c4f', 0),
('6120d4796d381', '86535', '<p>Keyword: Inuit Art, Canadian Arctic</p><p>Inspiration for the themes in Inuit art is intimately tied to personal experience of the Canadian Arctic land and its animals, camp and family life, hunting , spirituality, and mythology. In telling the story of their people through this wide array subject, inuits artists have created an almost encyclopedic visual catalog of traditional (and to a lesser extent transitional and modern) Inuit culture.</p><p>Animals play a vital role in the everyday lives of Inuit, and only in the past few decades has the people&rsquo;s absolute dependence on them lessened. Not too long ago, procuring food and other necessities depended solely on successful hunts, which in turn depended upon proper preparation and luck, in addition to the strict observance of taboos and respect for the sosul of the prey. As a consequence, animals constitute the prime inspiration for many Inuit artists, particularly in sculpture.</p><p>Based on years of observing and tracking prey, Inuit wildlife art shows a keen awareness of the physical characteristics, habits, and seasonal changes in animals. Some artists display a high degree of naturalistic detail, but others prefer to exaggerate certain physical attributes for effect. In general, while most inuit artists strive for a realistic presentation, they seem more concerned with capturing the essence of an animal&rsquo;s spirit.</p><p>Animals may be portrayed singly, in small groups, or in scenes that involve both hunter and prey. Pictorial arts often show the chase, while sculptures focus more on the final confrontation of hunter and prey, often with considerable drama. The hunter may be human or one of the great Arctic predators such as the polar bear, owl, hawk, or wolt.</p><p>Scenes of everyday life, which include camp scenes, games entertainment, are common to all forms of Inuit art, and activities sre far more prevalent than modern aspects of Inuit community life. Camp-related themes mostly potray woman engaged in domestic contests involve both individuals and the community, and drum dancing is a form of entertainment that also has conciderable spiritual significance.</p><p>&nbsp;</p><p>According to the fifth paragraph, which of the following types of activities would be LEAST likely to be represented in Inuit art?</p>', '6120d19792c4f', 0),
('6120d65aa4cdb', 'ff924', '<p>Passage 2:</p><p>Keyword: Forests migrated northward across Eurasia and North America&nbsp;</p><p>About 1800 years ago, the glaciers then convering large portions of Earth&rsquo;s surface began to retreat, justa as they had done eighteen or twenty times before during the preceeding two million years forests migrated northward across Eurasia and North America, while grasslands became less extensive and the large animals associated with hem dwindled in number. Probably no more than 5 million human existed throughout the world. Some of them lived along the seacoasts, where animals that could be used as sources of food were locally abundant, others, however, began to cultivate plants, thus gaining a new, relatively secure source of food.</p><p>The first deliberate planting of seeds was probably the logical consequence of a simple series of events. For example, the wild cereals are weed, ecologically speaking, that is, they grow readily on open or disturbed areas , patches of bare land where there are few other plants to complete with them. People who gathered these grains regularly might have spilled some of them accidentally near their campsides or planted them, and thus created a more reliable way to sustain theselves. When this sequence was initiated, cultivation began. In places where wild grains and legumens were abundant and readily gathered. Human would have remained for long periods of time, eventually learning how to increase their yields by saving and planting seeds and by watering and fertilizing them.</p><p>Thorough humans&rsquo; gradual selection of particular genetic variants of these plants, the characteristics of the domesticated crops would have changed gradually, with more seeds selected from plants with specifics characteristics that made the plants easier to gather, store or use. For example, the stalk (rachis) breaks readily in the wild wheat and their relatives scattering ripe seeds. In the cultivated species of wheat, the rachis is tough and holds the seeds until they are harvested. Seeds held in this way would not be dispersed well in nature, but they can be gathered easily by humans for food and replanting. As this selection process is continued, a crop plant steadily becomes more and more ddependent on the humans who cultivate it, just as the humans become more and more</p><p>&nbsp;</p><p>The major subject of the passage is__</p>', '6120d6220dd64', 0),
('6120d685915d6', 'ff985', '<p>Passage 2:</p><p>Keyword: Forests migrated northward across Eurasia and North America&nbsp;</p><p>About 1800 years ago, the glaciers then convering large portions of Earth&rsquo;s surface began to retreat, justa as they had done eighteen or twenty times before during the preceeding two million years forests migrated northward across Eurasia and North America, while grasslands became less extensive and the large animals associated with hem dwindled in number. Probably no more than 5 million human existed throughout the world. Some of them lived along the seacoasts, where animals that could be used as sources of food were locally abundant, others, however, began to cultivate plants, thus gaining a new, relatively secure source of food.</p><p>The first deliberate planting of seeds was probably the logical consequence of a simple series of events. For example, the wild cereals are weed, ecologically speaking, that is, they grow readily on open or disturbed areas , patches of bare land where there are few other plants to complete with them. People who gathered these grains regularly might have spilled some of them accidentally near their campsides or planted them, and thus created a more reliable way to sustain theselves. When this sequence was initiated, cultivation began. In places where wild grains and legumens were abundant and readily gathered. Human would have remained for long periods of time, eventually learning how to increase their yields by saving and planting seeds and by watering and fertilizing them.</p><p>Thorough humans&rsquo; gradual selection of particular genetic variants of these plants, the characteristics of the domesticated crops would have changed gradually, with more seeds selected from plants with specifics characteristics that made the plants easier to gather, store or use. For example, the stalk (rachis) breaks readily in the wild wheat and their relatives scattering ripe seeds. In the cultivated species of wheat, the rachis is tough and holds the seeds until they are harvested. Seeds held in this way would not be dispersed well in nature, but they can be gathered easily by humans for food and replanting. As this selection process is continued, a crop plant steadily becomes more and more ddependent on the humans who cultivate it, just as the humans become more and more</p><p>&nbsp;</p><p>The word &ldquo;them&rdquo; in line 6 refers to</p>', '6120d6220dd64', 0),
('6120d6aec9ac8', 'c5812', '<p>Passage 2:</p><p>Keyword: Forests migrated northward across Eurasia and North America&nbsp;</p><p>About 1800 years ago, the glaciers then convering large portions of Earth&rsquo;s surface began to retreat, justa as they had done eighteen or twenty times before during the preceeding two million years forests migrated northward across Eurasia and North America, while grasslands became less extensive and the large animals associated with hem dwindled in number. Probably no more than 5 million human existed throughout the world. Some of them lived along the seacoasts, where animals that could be used as sources of food were locally abundant, others, however, began to cultivate plants, thus gaining a new, relatively secure source of food.</p><p>The first deliberate planting of seeds was probably the logical consequence of a simple series of events. For example, the wild cereals are weed, ecologically speaking, that is, they grow readily on open or disturbed areas , patches of bare land where there are few other plants to complete with them. People who gathered these grains regularly might have spilled some of them accidentally near their campsides or planted them, and thus created a more reliable way to sustain theselves. When this sequence was initiated, cultivation began. In places where wild grains and legumens were abundant and readily gathered. Human would have remained for long periods of time, eventually learning how to increase their yields by saving and planting seeds and by watering and fertilizing them.</p><p>Thorough humans&rsquo; gradual selection of particular genetic variants of these plants, the characteristics of the domesticated crops would have changed gradually, with more seeds selected from plants with specifics characteristics that made the plants easier to gather, store or use. For example, the stalk (rachis) breaks readily in the wild wheat and their relatives scattering ripe seeds. In the cultivated species of wheat, the rachis is tough and holds the seeds until they are harvested. Seeds held in this way would not be dispersed well in nature, but they can be gathered easily by humans for food and replanting. As this selection process is continued, a crop plant steadily becomes more and more ddependent on the humans who cultivate it, just as the humans become more and more</p><p>&nbsp;</p><p>The word &ldquo;dwindled&rdquo; in line 6 is closest in meaning to</p>', '6120d6220dd64', 0),
('6120d6ece5e21', '3873e', '<p>Passage 2:</p><p>Keyword: Forests migrated northward across Eurasia and North America&nbsp;</p><p>About 1800 years ago, the glaciers then convering large portions of Earth&rsquo;s surface began to retreat, justa as they had done eighteen or twenty times before during the preceeding two million years forests migrated northward across Eurasia and North America, while grasslands became less extensive and the large animals associated with hem dwindled in number. Probably no more than 5 million human existed throughout the world. Some of them lived along the seacoasts, where animals that could be used as sources of food were locally abundant, others, however, began to cultivate plants, thus gaining a new, relatively secure source of food.</p><p>The first deliberate planting of seeds was probably the logical consequence of a simple series of events. For example, the wild cereals are weed, ecologically speaking, that is, they grow readily on open or disturbed areas , patches of bare land where there are few other plants to complete with them. People who gathered these grains regularly might have spilled some of them accidentally near their campsides or planted them, and thus created a more reliable way to sustain theselves. When this sequence was initiated, cultivation began. In places where wild grains and legumens were abundant and readily gathered. Human would have remained for long periods of time, eventually learning how to increase their yields by saving and planting seeds and by watering and fertilizing them.</p><p>Thorough humans&rsquo; gradual selection of particular genetic variants of these plants, the characteristics of the domesticated crops would have changed gradually, with more seeds selected from plants with specifics characteristics that made the plants easier to gather, store or use. For example, the stalk (rachis) breaks readily in the wild wheat and their relatives scattering ripe seeds. In the cultivated species of wheat, the rachis is tough and holds the seeds until they are harvested. Seeds held in this way would not be dispersed well in nature, but they can be gathered easily by humans for food and replanting. As this selection process is continued, a crop plant steadily becomes more and more ddependent on the humans who cultivate it, just as the humans become more and more</p><p>&nbsp;</p><p>The word &ldquo;secure&rdquo; in line 10 is closest in meaning to</p>', '6120d6220dd64', 0),
('6120d72055e41', 'e9e28', '<p>Passage 2:</p><p>Keyword: Forests migrated northward across Eurasia and North America&nbsp;</p><p>About 1800 years ago, the glaciers then convering large portions of Earth&rsquo;s surface began to retreat, justa as they had done eighteen or twenty times before during the preceeding two million years forests migrated northward across Eurasia and North America, while grasslands became less extensive and the large animals associated with hem dwindled in number. Probably no more than 5 million human existed throughout the world. Some of them lived along the seacoasts, where animals that could be used as sources of food were locally abundant, others, however, began to cultivate plants, thus gaining a new, relatively secure source of food.</p><p>The first deliberate planting of seeds was probably the logical consequence of a simple series of events. For example, the wild cereals are weed, ecologically speaking, that is, they grow readily on open or disturbed areas , patches of bare land where there are few other plants to complete with them. People who gathered these grains regularly might have spilled some of them accidentally near their campsides or planted them, and thus created a more reliable way to sustain theselves. When this sequence was initiated, cultivation began. In places where wild grains and legumens were abundant and readily gathered. Human would have remained for long periods of time, eventually learning how to increase their yields by saving and planting seeds and by watering and fertilizing them.</p><p>Thorough humans&rsquo; gradual selection of particular genetic variants of these plants, the characteristics of the domesticated crops would have changed gradually, with more seeds selected from plants with specifics characteristics that made the plants easier to gather, store or use. For example, the stalk (rachis) breaks readily in the wild wheat and their relatives scattering ripe seeds. In the cultivated species of wheat, the rachis is tough and holds the seeds until they are harvested. Seeds held in this way would not be dispersed well in nature, but they can be gathered easily by humans for food and replanting. As this selection process is continued, a crop plant steadily becomes more and more ddependent on the humans who cultivate it, just as the humans become more and more</p><p>&nbsp;</p><p>The word &ldquo;deliberate&rdquo; in line 11 is closest in meaning to</p>', '6120d6220dd64', 0),
('6120d74f60edb', '7f66a', '<p>Passage 2:</p><p>Keyword: Forests migrated northward across Eurasia and North America&nbsp;</p><p>About 1800 years ago, the glaciers then convering large portions of Earth&rsquo;s surface began to retreat, justa as they had done eighteen or twenty times before during the preceeding two million years forests migrated northward across Eurasia and North America, while grasslands became less extensive and the large animals associated with hem dwindled in number. Probably no more than 5 million human existed throughout the world. Some of them lived along the seacoasts, where animals that could be used as sources of food were locally abundant, others, however, began to cultivate plants, thus gaining a new, relatively secure source of food.</p><p>The first deliberate planting of seeds was probably the logical consequence of a simple series of events. For example, the wild cereals are weed, ecologically speaking, that is, they grow readily on open or disturbed areas , patches of bare land where there are few other plants to complete with them. People who gathered these grains regularly might have spilled some of them accidentally near their campsides or planted them, and thus created a more reliable way to sustain theselves. When this sequence was initiated, cultivation began. In places where wild grains and legumens were abundant and readily gathered. Human would have remained for long periods of time, eventually learning how to increase their yields by saving and planting seeds and by watering and fertilizing them.</p><p>Thorough humans&rsquo; gradual selection of particular genetic variants of these plants, the characteristics of the domesticated crops would have changed gradually, with more seeds selected from plants with specifics characteristics that made the plants easier to gather, store or use. For example, the stalk (rachis) breaks readily in the wild wheat and their relatives scattering ripe seeds. In the cultivated species of wheat, the rachis is tough and holds the seeds until they are harvested. Seeds held in this way would not be dispersed well in nature, but they can be gathered easily by humans for food and replanting. As this selection process is continued, a crop plant steadily becomes more and more ddependent on the humans who cultivate it, just as the humans become more and more</p><p>&nbsp;</p><p>It can be inferred from the second paragraph that by accidentally spilling grains near their campsites, early humans most likely learned</p>', '6120d6220dd64', 0);
INSERT INTO `pertanyaan` (`id`, `kode`, `pertanyaan`, `kategori_id`, `status_id`) VALUES
('6120d78b78200', '5e433', '<p>Passage 2:</p><p>Keyword: Forests migrated northward across Eurasia and North America&nbsp;</p><p>About 1800 years ago, the glaciers then convering large portions of Earth&rsquo;s surface began to retreat, justa as they had done eighteen or twenty times before during the preceeding two million years forests migrated northward across Eurasia and North America, while grasslands became less extensive and the large animals associated with hem dwindled in number. Probably no more than 5 million human existed throughout the world. Some of them lived along the seacoasts, where animals that could be used as sources of food were locally abundant, others, however, began to cultivate plants, thus gaining a new, relatively secure source of food.</p><p>The first deliberate planting of seeds was probably the logical consequence of a simple series of events. For example, the wild cereals are weed, ecologically speaking, that is, they grow readily on open or disturbed areas , patches of bare land where there are few other plants to complete with them. People who gathered these grains regularly might have spilled some of them accidentally near their campsides or planted them, and thus created a more reliable way to sustain theselves. When this sequence was initiated, cultivation began. In places where wild grains and legumens were abundant and readily gathered. Human would have remained for long periods of time, eventually learning how to increase their yields by saving and planting seeds and by watering and fertilizing them.</p><p>Thorough humans&rsquo; gradual selection of particular genetic variants of these plants, the characteristics of the domesticated crops would have changed gradually, with more seeds selected from plants with specifics characteristics that made the plants easier to gather, store or use. For example, the stalk (rachis) breaks readily in the wild wheat and their relatives scattering ripe seeds. In the cultivated species of wheat, the rachis is tough and holds the seeds until they are harvested. Seeds held in this way would not be dispersed well in nature, but they can be gathered easily by humans for food and replanting. As this selection process is continued, a crop plant steadily becomes more and more ddependent on the humans who cultivate it, just as the humans become more and more</p><p>&nbsp;</p><p>The word &lsquo;&rsquo;initiated&rdquo; in line 19 is closest in meaning to</p>', '6120d6220dd64', 0),
('6120d7b81199e', '82624', '<p>Passage 2:</p><p>Keyword: Forests migrated northward across Eurasia and North America&nbsp;</p><p>About 1800 years ago, the glaciers then convering large portions of Earth&rsquo;s surface began to retreat, justa as they had done eighteen or twenty times before during the preceeding two million years forests migrated northward across Eurasia and North America, while grasslands became less extensive and the large animals associated with hem dwindled in number. Probably no more than 5 million human existed throughout the world. Some of them lived along the seacoasts, where animals that could be used as sources of food were locally abundant, others, however, began to cultivate plants, thus gaining a new, relatively secure source of food.</p><p>The first deliberate planting of seeds was probably the logical consequence of a simple series of events. For example, the wild cereals are weed, ecologically speaking, that is, they grow readily on open or disturbed areas , patches of bare land where there are few other plants to complete with them. People who gathered these grains regularly might have spilled some of them accidentally near their campsides or planted them, and thus created a more reliable way to sustain theselves. When this sequence was initiated, cultivation began. In places where wild grains and legumens were abundant and readily gathered. Human would have remained for long periods of time, eventually learning how to increase their yields by saving and planting seeds and by watering and fertilizing them.</p><p>Thorough humans&rsquo; gradual selection of particular genetic variants of these plants, the characteristics of the domesticated crops would have changed gradually, with more seeds selected from plants with specifics characteristics that made the plants easier to gather, store or use. For example, the stalk (rachis) breaks readily in the wild wheat and their relatives scattering ripe seeds. In the cultivated species of wheat, the rachis is tough and holds the seeds until they are harvested. Seeds held in this way would not be dispersed well in nature, but they can be gathered easily by humans for food and replanting. As this selection process is continued, a crop plant steadily becomes more and more ddependent on the humans who cultivate it, just as the humans become more and more</p><p>&nbsp;</p><p>According to the third paragraph what advantage do cultivated wheat species have over wild wheat species?</p>', '6120d6220dd64', 0),
('6120d7ecd8227', '09401', '<p>Passage 2:</p><p>Keyword: Forests migrated northward across Eurasia and North America&nbsp;</p><p>About 1800 years ago, the glaciers then convering large portions of Earth&rsquo;s surface began to retreat, justa as they had done eighteen or twenty times before during the preceeding two million years forests migrated northward across Eurasia and North America, while grasslands became less extensive and the large animals associated with hem dwindled in number. Probably no more than 5 million human existed throughout the world. Some of them lived along the seacoasts, where animals that could be used as sources of food were locally abundant, others, however, began to cultivate plants, thus gaining a new, relatively secure source of food.</p><p>The first deliberate planting of seeds was probably the logical consequence of a simple series of events. For example, the wild cereals are weed, ecologically speaking, that is, they grow readily on open or disturbed areas , patches of bare land where there are few other plants to complete with them. People who gathered these grains regularly might have spilled some of them accidentally near their campsides or planted them, and thus created a more reliable way to sustain theselves. When this sequence was initiated, cultivation began. In places where wild grains and legumens were abundant and readily gathered. Human would have remained for long periods of time, eventually learning how to increase their yields by saving and planting seeds and by watering and fertilizing them.</p><p>Thorough humans&rsquo; gradual selection of particular genetic variants of these plants, the characteristics of the domesticated crops would have changed gradually, with more seeds selected from plants with specifics characteristics that made the plants easier to gather, store or use. For example, the stalk (rachis) breaks readily in the wild wheat and their relatives scattering ripe seeds. In the cultivated species of wheat, the rachis is tough and holds the seeds until they are harvested. Seeds held in this way would not be dispersed well in nature, but they can be gathered easily by humans for food and replanting. As this selection process is continued, a crop plant steadily becomes more and more ddependent on the humans who cultivate it, just as the humans become more and more</p><p>&nbsp;</p><p>It can be inferred that the cultivated crop plant becomes &lsquo;&rsquo;more and more dependent on the humans who cultivate it&rdquo; (line 33-34)</p>', '6120d6220dd64', 0),
('6120d88090c21', '1f49a', '<p>Keyword: Tentang wind machine (daknemu)&nbsp;<br />CARI PASSAGE INI GUYS ADA 5 SOAL<br /><br />&ldquo;drive&rdquo; is closest in meaning to</p>', '6120d88928513', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta_ujian`
--

CREATE TABLE `peserta_ujian` (
  `no_peserta` varchar(5) NOT NULL,
  `peserta_id` varchar(13) NOT NULL,
  `sesi_id` varchar(13) NOT NULL,
  `trash_id` int(11) NOT NULL DEFAULT 0,
  `submit_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('6120c24c6106e', 'TRY OUT SULIET 1', 'Online', '2021-08-21 16:00:00', '2021-08-21 18:00:00', '120', '17ba4', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal_to_sesi`
--

CREATE TABLE `soal_to_sesi` (
  `sesi_id` varchar(13) NOT NULL,
  `kategori_id` varchar(13) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` varchar(13) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role_id`, `status_id`) VALUES
('6120bda180892', 'akdev2101', 'akdev2101@gmail.com', '$2y$10$u51vz/rhkgsTgqDgt5KB1.PHRmWh4hARW0uJDcjXZEu9IV6uIEYGO', 1, 0),
('6120c319ae2b6', 'akdevid21', 'adikurniawan.dev@gmail.com', '$2y$10$uNxRGe9z.WYamnKmsZdd3./jVP/2lp8ykKUhVcUyp5KS8aKjvnFxm', 2, 0);

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
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `api_users`
--
ALTER TABLE `api_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `api_key` (`api_key`);

--
-- Indeks untuk tabel `content`
--
ALTER TABLE `content`
  ADD KEY `content__pertanyaan_fk` (`pertanyaan_id`);

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
-- Indeks untuk tabel `detail_status`
--
ALTER TABLE `detail_status`
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
  ADD PRIMARY KEY (`peserta_id`),
  ADD KEY `detail_user__jenis_kelamin_fk` (`jenis_kelamin_id`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD KEY `jawaban__pertanyaan_fk` (`pertanyaan_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_kode_uindex` (`kode`),
  ADD KEY `kategori__status_fk` (`status_id`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pertanyaan_kode_uindex` (`kode`),
  ADD KEY `pertanyaan__kategori_fk` (`kategori_id`),
  ADD KEY `pertanyaan__status_fk` (`status_id`);

--
-- Indeks untuk tabel `peserta_ujian`
--
ALTER TABLE `peserta_ujian`
  ADD PRIMARY KEY (`no_peserta`),
  ADD KEY `peserta_ujian__peserta_fk` (`peserta_id`),
  ADD KEY `peserta_ujian__sesi_fk` (`sesi_id`),
  ADD KEY `peserta_ujian__status_fk` (`trash_id`);

--
-- Indeks untuk tabel `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sesi__status_fk` (`status_id`);

--
-- Indeks untuk tabel `soal_to_sesi`
--
ALTER TABLE `soal_to_sesi`
  ADD KEY `soal_to_sesi__sesi_fk` (`sesi_id`),
  ADD KEY `soal_to_sesi__kategori_fk` (`kategori_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_username_uindex` (`username`),
  ADD UNIQUE KEY `user_email_uindex` (`email`),
  ADD KEY `user__role_fk` (`role_id`),
  ADD KEY `user__status_fk` (`status_id`);

--
-- Indeks untuk tabel `waktu`
--
ALTER TABLE `waktu`
  ADD UNIQUE KEY `waktu_item_id_uindex` (`item_id`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content__pertanyaan_fk` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_user`
--
ALTER TABLE `detail_user`
  ADD CONSTRAINT `detail_user__jenis_kelamin_fk` FOREIGN KEY (`jenis_kelamin_id`) REFERENCES `detail_jenis_kelamin` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_user__user_fk` FOREIGN KEY (`peserta_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban__pertanyaan_fk` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori__status_fk` FOREIGN KEY (`status_id`) REFERENCES `detail_status` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan__kategori_fk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pertanyaan__status_fk` FOREIGN KEY (`status_id`) REFERENCES `detail_status` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peserta_ujian`
--
ALTER TABLE `peserta_ujian`
  ADD CONSTRAINT `peserta_ujian__peserta_fk` FOREIGN KEY (`peserta_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peserta_ujian__sesi_fk` FOREIGN KEY (`sesi_id`) REFERENCES `sesi` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peserta_ujian__status_fk` FOREIGN KEY (`trash_id`) REFERENCES `detail_status` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sesi`
--
ALTER TABLE `sesi`
  ADD CONSTRAINT `sesi__status_fk` FOREIGN KEY (`status_id`) REFERENCES `detail_status` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soal_to_sesi`
--
ALTER TABLE `soal_to_sesi`
  ADD CONSTRAINT `soal_to_sesi__kategori_fk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `soal_to_sesi__sesi_fk` FOREIGN KEY (`sesi_id`) REFERENCES `sesi` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user__role_fk` FOREIGN KEY (`role_id`) REFERENCES `detail_role` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user__status_fk` FOREIGN KEY (`status_id`) REFERENCES `detail_status` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
