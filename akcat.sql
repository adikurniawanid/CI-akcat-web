-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 21 Agu 2021 pada 11.36
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
('6120c56841efb', NULL, NULL);

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
('6120c56841efb', 'It’s short.', 'It’s simple.', 'It’s nice.', 'It’s important.', 'B');

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
('6120b7191b189', '96d4d', 'Listening', 1, 0);

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
('6120c56841efb', 'd210b', '<p>(woman)&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>Do you need help?</em></p><p>(man)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<em>No, thanks. It&rsquo;s not a big deal.</em></p><p>(narrator)&nbsp;:&nbsp;<em>What does the man mean about the deal?</em></p>', '6120b7191b189', 0);

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
