-- --------------------------------------------------------
-- Database: 04_AmandaDefina
-- Website: TIK Health - Informasi Kegiatan SMKN 1 Dlanggu
-- Programmer: Amanda_Defina
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `04_AmandaDefina` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `04_AmandaDefina`;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`username`, `password`) VALUES ('admin', 'Dlanggu');

DROP TABLE IF EXISTS `kegiatan`;
CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT 'Umum',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `kegiatan` (`judul`, `deskripsi`, `tanggal`, `gambar`, `kategori`) VALUES
('Pelantikan Pengurus OSIS SMKN 1 Dlanggu Tahun 2024/2025', 'SMK Negeri 1 Dlanggu telah resmi melantik Pengurus OSIS periode 2024/2025. Acara pelantikan berlangsung dengan khidmat di aula sekolah. Ketua OSIS yang baru berkomitmen untuk membawa program-program inovatif demi kemajuan sekolah dan seluruh siswa SMKN 1 Dlanggu.', '2025-03-15', NULL, 'Organisasi'),
('Kegiatan Praktik Kerja Industri (Prakerin) Siswa Kelas XI', 'Program Praktik Kerja Industri (Prakerin) resmi dilepas oleh Kepala SMKN 1 Dlanggu. Sebanyak ratusan siswa kelas XI dari berbagai jurusan ditempatkan di berbagai perusahaan dan instansi mitra sekolah. Program ini bertujuan membekali siswa dengan pengalaman kerja nyata sesuai bidang keahliannya.', '2025-02-20', NULL, 'Akademik'),
('Peringatan Hari Guru Nasional di SMKN 1 Dlanggu', 'SMKN 1 Dlanggu memperingati Hari Guru Nasional dengan berbagai kegiatan yang meriah. Seluruh siswa memberikan apresiasi kepada para guru melalui penampilan seni dan pemberian penghargaan. Kepala sekolah menyampaikan pesan agar guru terus berdedikasi dan berinovasi dalam dunia pendidikan.', '2024-11-25', NULL, 'Peringatan'),
('Lomba Kompetensi Siswa (LKS) Tingkat Kabupaten Mojokerto', 'Tim SMKN 1 Dlanggu berhasil meraih prestasi gemilang dalam ajang Lomba Kompetensi Siswa (LKS) Tingkat Kabupaten Mojokerto. Para siswa bersaing di berbagai bidang keahlian dan berhasil membawa pulang medali emas, perak, dan perunggu. Ini merupakan bukti nyata kualitas pendidikan vokasi di SMKN 1 Dlanggu.', '2024-10-10', NULL, 'Prestasi'),
('Workshop Kewirausahaan dan Digital Marketing untuk Siswa', 'SMKN 1 Dlanggu menyelenggarakan Workshop Kewirausahaan dan Digital Marketing yang diikuti oleh seluruh siswa kelas XII. Kegiatan ini menghadirkan narasumber berpengalaman dari dunia usaha dan industri. Siswa mendapatkan ilmu dan inspirasi untuk memulai usaha mandiri setelah lulus dari sekolah.', '2024-09-05', NULL, 'Workshop'),
('Upacara Bendera Peringatan HUT RI ke-79 SMKN 1 Dlanggu', 'SMKN 1 Dlanggu menggelar Upacara Bendera dalam rangka memperingati Hari Ulang Tahun Kemerdekaan Republik Indonesia ke-79. Seluruh warga sekolah mengikuti upacara dengan penuh semangat kebangsaan. Berbagai perlombaan dan kegiatan seni budaya juga diselenggarakan untuk memeriahkan hari bersejarah ini.', '2024-08-17', NULL, 'Peringatan');
