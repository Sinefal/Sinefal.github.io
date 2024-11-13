-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 10:58 AM
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
-- Database: `cineboxd_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `film_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `director` varchar(255) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `synopsis` text DEFAULT NULL,
  `backdrop` varchar(255) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `is_popular` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`film_id`, `title`, `year`, `director`, `genre`, `synopsis`, `backdrop`, `poster`, `is_popular`, `created_at`) VALUES
(2, 'Lawrence of Arabia', '1962', 'David Lean', 'SCIENCE FICTION', 'The story of British officer T.E. Lawrence\'s mission to aid the Arab tribes in their revolt against the Ottoman Empire during the First World War. Lawrence becomes a flamboyant, messianic figure in the cause of Arab unity but his psychological instability threatens to undermine his achievements.', 'backdrop_1730969968_AbIL5ZA3RPrMgppdhhqZ4lDjM5k.jpg', 'poster_1730969968_Lawrence-of-Arabia.jpg', 1, '2024-11-07 08:59:28'),
(3, 'Tenet', '2020', 'Christopher Nolan', 'ACTION', 'Armed with only one word - Tenet - and fighting for the survival of the entire world, the Protagonist journeys through a twilight world of international espionage on a mission that will unfold in something beyond real time.', 'backdrop_1731056513_xMCyWTQR50d0UGbDyeADQr6Vapj.jpg', 'poster_1731056513_oRkLA2EkXaRLmK63BkvK74G8tC4.jpg', 1, '2024-11-07 13:40:16'),
(4, 'The Seventh Seal', '1957', 'Ingmar Bergman', 'FANTASY', 'When disillusioned Swedish knight Antonius Block returns home from the Crusades to find his country in the grips of the Black Death, he challenges Death to a chess match for his life. Tormented by the belief that God does not exist, Block sets off on a journey, meeting up with traveling players Jof and his wife, Mia, and becoming determined to evade Death long enough to commit one redemptive act while he still lives.', 'backdrop_1731056578_m4PD25YPgYCtDTjBemSwkl8tvrl.jpg', 'poster_1731001979_The-Seventh-Seal.jpg', 1, '2024-11-07 17:52:59'),
(5, 'Raiders of the Lost Ark', '1981', 'Steven Spielberg', 'ADVENTURE', 'When Dr. Indiana Jones – the tweed-suited professor who just happens to be a celebrated archaeologist – is hired by the government to locate the legendary Ark of the Covenant, he finds himself up against the entire Nazi regime.', 'backdrop_1731056267_hrnaganT7il2P8DzhCNlFSSZopU.jpg', 'poster_1731056173_ceG9VzoRAVGwivFU403Wc3AHRys.jpg', 1, '2024-11-07 17:54:30'),
(6, 'Dune', '2021', 'Denis Villeneuve', 'SCIENCE FICTION', 'Paul Atreides, a brilliant and gifted young man born into a great destiny beyond his understanding, must travel to the most dangerous planet in the universe to ensure the future of his family and his people. As malevolent forces explode into conflict over the planet\'s exclusive supply of the most precious resource in existence-a commodity capable of unlocking humanity\'s greatest potential-only those who can conquer their fear will survive.', 'backdrop_1731056684_5737nHYFVoyZBuslK6OkwzsOVo3.jpg', 'poster_1731002282_Dune-Part-One.jpg', 1, '2024-11-07 17:58:02'),
(7, 'Portrait of a Lady on Fire', '2019', 'Céline Sciamma', 'DRAMA', 'On an isolated island in Brittany at the end of the eighteenth century, a female painter is obliged to paint a wedding portrait of a young woman.', 'backdrop_1731002529_foFq1RZWQIgFuCQ0nyYccywjFyX.jpg', 'poster_1731002529_Portrait-of-a-Lady-on-Fire.jpg', 1, '2024-11-07 18:02:09'),
(8, 'Your Name.', '2016', 'Makoto Shinkai', 'ROMANCE', 'High schoolers Mitsuha and Taki are complete strangers living separate lives. But one night, they suddenly switch places. Mitsuha wakes up in Taki’s body, and he in hers. This bizarre occurrence continues to happen randomly, and the two must adjust their lives around each other.', 'backdrop_1731002852_rjs5IfIv6Psl2YCSHKcluhTQGjJ.jpg', 'poster_1731002852_8GJsy7w7frGquw1cy9jasOGNNI1.jpg', 0, '2024-11-07 18:05:58'),
(9, 'The Northman', '2022', 'Robert Eggers', 'ADVENTURE', 'Prince Amleth is on the verge of becoming a man when his father is brutally murdered by his uncle, who kidnaps the boy\'s mother. Two decades later, Amleth is now a Viking who\'s on a mission to save his mother, kill his uncle and avenge his father.', 'backdrop_1731055984_c3NHprjgzTixd45eBjfHxoonwxF.jpg', 'poster_1731055984_zhLKlUaF1SEpO58ppHIAyENkwgw.jpg', 0, '2024-11-08 08:53:04'),
(10, 'Dunkirk', '2017', 'Christopher Nolan', 'WAR', 'The story of the miraculous evacuation of Allied soldiers from Belgium, Britain, Canada and France, who were cut off and surrounded by the German army from the beaches and harbour of Dunkirk between May 26th and June 4th 1940 during World War II.', 'backdrop_1731056498_4yjJNAgXBmzxpS6sogj4ftwd270.jpg', 'poster_1731056498_Dunkirk.jpg', 0, '2024-11-08 09:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `rating` decimal(1,0) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `film_id`, `rating`, `review`, `created_at`) VALUES
(3, 2, 3, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2024-11-08 10:23:09'),
(4, 3, 3, 5, 'MASTERPIECE!!!. THE MUSIC SCORE GOES BRRRRRRRRRRRRRRRRRRR', '2024-11-08 10:24:16'),
(6, 2, 3, 1, 'mrnrgknwrkgwww\r\nwrjbwfgw\r\nnwrbjg\r\nw', '2024-11-08 14:03:33'),
(7, 2, 3, 3, 'gesknskgnskrg\r\nge', '2024-11-08 14:19:59'),
(8, 1, 3, 3, 'halooo', '2024-11-08 14:21:38'),
(9, 1, 3, 2, 'ngjrwnfjwnefjnw jkwnefjwnrnwj jfwenfjw', '2024-11-08 14:22:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$CeOEEgFHtaR/vfbqO7XVCer7/GaDZtdp40R1m6UuLzzypxync/exS', 'admin', '2024-11-07 07:46:41'),
(2, 'user', '$2y$10$7yWAv7A33sRwtBh3ZHEKMeSkVvaZw2fyxr7iIDCWuG1MWi2xI7MZC', 'user', '2024-11-07 08:01:26'),
(3, 'Azuki', '$2y$10$B4JfK10R4L16K9wzHyYYceet/UlZ.3T7tb2gL1hVqgCbOjzeUixvW', 'user', '2024-11-08 10:23:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`film_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `films` (`film_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
