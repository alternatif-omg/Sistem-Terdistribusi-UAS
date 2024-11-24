-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2024 at 05:02 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekskul`
--

-- --------------------------------------------------------

--
-- Table structure for table `Activities`
--

CREATE TABLE `Activities` (
  `activity_id` int(255) NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` varchar(225) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `Instructor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Activities`
--

INSERT INTO `Activities` (`activity_id`, `name`, `description`, `schedule`, `Instructor`) VALUES
(1, 'Basketball', 'Latihan keterampilan bermain basket dan kompetisi', 'Senin, 16:00-18:00', 'Budi Santoso'),
(2, 'Paduan Suara', 'Latihan vokal dan persiapan konser sekolah', 'Rabu, 15:00-17:00', 'Sari Lestari'),
(3, 'Fotografi', 'Pelatihan dasar-dasar fotografi dan komposisi gambar', 'Jumat, 16:00-18:00', 'Rizky Ananda'),
(4, 'Robotika', 'Kelas perakitan dan pemrograman robot sederhana', 'Selasa, 15:00-17:00', 'Teguh Wibowo'),
(5, 'Karate', 'Latihan bela diri karate dan persiapan kompetisi', 'Kamis, 16:00-18:00', 'Agus Prasetyo'),
(6, 'Teater', 'Latihan drama dan persiapan pentas sekolah', 'Jumat, 14:00-16:00', 'Lina Puspitasari'),
(7, 'Sepak Bola', 'Latihan teknik dasar dan strategi sepak bola', 'Sabtu, 08:00-10:00', 'Andi Saputra'),
(8, 'Komputer', 'Pelatihan dasar pemrograman dan desain grafis', 'Senin, 15:00-17:00', 'Dewi Suryani'),
(9, 'Tari Tradisional', 'Latihan tari tradisional daerah', 'Selasa, 16:00-18:00', 'Sri Handayani'),
(10, 'Pencak Silat', 'Latihan seni bela diri pencak silat', 'Kamis, 15:00-17:00', 'Yanto Wijaya');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(255) NOT NULL,
  `student_id` int(225) NOT NULL,
  `activity_id` int(225) NOT NULL,
  `attendance_date` date NOT NULL,
  `status` enum('izin','hadir','bolos') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `activity_id`, `attendance_date`, `status`) VALUES
(1, 22010001, 1, '2024-11-10', 'hadir');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `registration_id` int(255) NOT NULL,
  `student_id` int(225) NOT NULL,
  `activity_id` int(225) NOT NULL,
  `registration_date` date NOT NULL,
  `position` enum('Anggota','Ketua','Wakil Ketua','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`registration_id`, `student_id`, `activity_id`, `registration_date`, `position`) VALUES
(1, 22010001, 1, '2024-11-09', 'Anggota');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(255) NOT NULL,
  `name` varchar(225) NOT NULL,
  `class` varchar(225) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `name`, `class`, `contact`, `birth_date`) VALUES
(12345, 'kapten kaizo', 'A', '081234567890', '2006-01-15'),
(22010001, 'Ahmad Setiawan', 'A', '081234567890', '2006-01-15'),
(22010002, 'Budi Santoso', 'A', '081234567891', '2006-03-12'),
(22010003, 'Citra Lestari', 'A', '081234567892', '2006-04-20'),
(22010004, 'Dewi Kartika', 'A', '081234567893', '2006-05-11'),
(22010005, 'Eko Prasetyo', 'A', '081234567894', '2006-07-25'),
(22020001, 'Fajar Nugroho', 'B', '081234567895', '2006-02-14'),
(22020002, 'Gita Mahardika', 'B', '081234567896', '2006-06-16'),
(22020003, 'Hana Suryani', 'B', '081234567897', '2006-08-18'),
(22020004, 'Iwan Darmawan', 'B', '081234567898', '2006-09-23'),
(22020005, 'Joko Susilo', 'B', '081234567899', '2006-10-30'),
(22030001, 'Kiki Rizki', 'C', '081234567900', '2006-03-05'),
(22030002, 'Lia Anggraini', 'C', '081234567901', '2006-04-15'),
(22030003, 'Mira Wahyuni', 'C', '081234567902', '2006-07-22'),
(22030004, 'Nando Saputra', 'C', '081234567903', '2006-08-29'),
(22030005, 'Oka Pradana', 'C', '081234567904', '2006-11-09'),
(22040001, 'Pandu Fadli', 'D', '081234567905', '2006-01-21'),
(22040002, 'Qorya Rahmadini', 'D', '081234567906', '2006-03-30'),
(22040003, 'Rina Sulistyo', 'D', '081234567907', '2006-06-17'),
(22040004, 'Satria Mahendra', 'D', '081234567908', '2006-09-25'),
(22040005, 'Tia Mustika', 'D', '081234567909', '2006-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_admin`
--

CREATE TABLE `teacher_admin` (
  `teacher_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_admin`
--

INSERT INTO `teacher_admin` (`teacher_id`, `name`, `email`, `password`) VALUES
(1011, 'papa zola', 'kebenaran@gmail.com', 'kebenaran');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Activities`
--
ALTER TABLE `Activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `teacher_admin`
--
ALTER TABLE `teacher_admin`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `Activities` (`activity_id`);

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `Activities` (`activity_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
