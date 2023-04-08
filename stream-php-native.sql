-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 12, 2023 at 05:42 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stream-php-native`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id_movie` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `genre` varchar(255) NOT NULL,
  `is_feature` varchar(4) NOT NULL DEFAULT '0',
  `rating` varchar(11) NOT NULL,
  `year` year(4) NOT NULL,
  `link_movie` text NOT NULL,
  `img_movie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id_movie`, `title`, `description`, `genre`, `is_feature`, `rating`, `year`, `link_movie`, `img_movie`) VALUES
(2, 'Morbius', 'Despite Jared Leto\'s transcendent transformation via latex prosthetics in House of Gucci, the actor argued that he wanted to go the computer-generated visual effects route for his take on the Marvel Legend.', 'Action', '0', '5', 2022, 'https://www.youtube.com/embed/Avo5ljNXagg', 'assets/images/63bf80a189026.png'),
(9, 'Iron Man', 'Tony Stark yang mewarisi perusahan kontraktor pertahanan Stark Industries dari mendiang ayahnya, digambarkan sebagai seorang jenius yang berhasil mengembangkan teknologi persenjataan militer. Namun, dia juga digambarkan sebagai seseorang yang senang berjudi dan bermain-main dengan perempuan. Demi urusan bisnis, dia pergi ke Afganistan yang luluh lantak oleh perang bersama teman sekaligus penghubung militernya, Letnan Kolonel James Rhodes untuk mendemonstrasikan peluru kendali &quot;Jericho&quot; yang baru. Kemudian adegan dipercepat, dengan menampilan penggalan ketika rombongan Stark disergap, Stark terluka oleh rudal, dan tindakan operasi yang dilakukan kepadanya. Setelah bangun ia mendapati dirinya ditangkap dan ditawan dalam sebuah gua oleh kelompok teroris bernama Ten Rings. Ho Yinsen, yang merupakan seorang dokter dan sesama tawanan, menanamkan elektromagnet ke dalam dada Stark untuk mencegah pecahan peluru yang melukainya agar tidak mencapai jantung dan membunuhnya. Pemimpin Ten Rings, Raza, menawarkan untuk membebaskan Stark dengan syarat dia membuatkan rudal Jericho untuk kelompok itu, tetapi Stark dan Yinsen tahu bahwa dia tidak akan menepati janjinya.', 'Action', '1', '5', 2008, 'https://www.youtube.com/embed/yGB8aj1QhIM', 'assets/images/63bf7f7cbfa0a.png'),
(10, 'The Incredible Hulk 2008', 'The Incredible Hulk merupakan sebuah film Amerika Serikat yang dirilis pada tahun 2008. Film ini adalah film kedua di Marvel Cinematic Universe. Film yang disutradarai oleh Louis Leterrier ini pemainnya antara lain ialah Edward Norton, Liv Tyler, Tim Roth, dan William Hurt. Tanggal rilisnya pada 13 Juni 2008.', 'Action', '1', '4', 2008, 'https://www.youtube.com/embed/Ad85di9XTWs', 'assets/images/63bf802ce1fcf.jpg'),
(11, 'KKN Di Desa Penari', 'In this movies, KKN\'s stories more closer with story that we read in the novels. You will see a lot of new scenes which will give you new experience. For someone that really love with KKN Stories, this movie really recomended to watch. In the post credits scene, they also give you bonus trailer about their new movie and honestly at first I thought it was still same story but apparently I was wrong lol.\r\n\r\nOverall, I have watched the first KKN movie for 4 times, read KKN novel 2 times, and watched this movie today (this movie also becomes my first movie that i watched in 2023) and i still really loved it.\r\n\r\nAnd for the last, love you kak Tissa Biani.', 'Horor - Drama', '0', '4', 2022, 'https://www.youtube.com/embed/uuI7K3qj8DE', 'assets/images/63bf812531a33.jpg'),
(12, 'Captain America Civil War', 'With many people fearing the actions of super heroes, the government decides to push for the Hero Registration Act, a law that limits a hero\'s actions. This results in a division in The Avengers. Iron Man stands with this Act, claiming that their actions must be kept in check otherwise cities will continue to be destroyed, but Captain America feels that saving the world is daring enough and that they cannot rely on the government to protect the world. This escalates into an all-out war between Team Iron Man (Iron Man, Black Panther, Vision, Black Widow, War Machine, and Spider-Man) and Team Captain America (Captain America, Bucky Barnes, Falcon, Scarlet Witch, Hawkeye, and Ant Man) while a new villain emerges.', 'Action', '0', '5', 2022, 'https://www.youtube.com/embed/Ix2my0LizKQ', 'assets/images/63bf889c00c70.jpg'),
(13, 'Doctor Strange', 'Hidup Stephen Strange (Benedict Cumberbatch), seorang dokter bedah pintar yang sombong, mendadak berubah drastis. Sebuah kecelakaan membuat kemampuan tangannya menjadi sangat terbatas. Bertekad untuk menyembuhkan kondisinya, ia pun berpetualang mencari obat untuk memulihkan lengannya.\r\n\r\nPerjalanan tersebut mempertemukan sang doktor bedah dengan penyihir bernama The Ancient One (Tilda Swinton), yang kemudian mengangkat Strange menjadi murid, dengan tujuan menjadikan ia sebagai pelindung alam manusia. Kali ini Strange harus mengesampingkan egonya, dan menggunakan segala kemampuannya untuk mnenjadi perantara antara dimensi manusia dan dimensi lain.', 'Action', '0', '5', 2016, 'https://www.youtube.com/embed/Zj7pPI-vLbA', 'assets/images/63bf8b14bcee9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subcription_plan`
--

CREATE TABLE `subcription_plan` (
  `id_subcription_plan` int(11) NOT NULL,
  `name_plan` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `active_period_in_month` int(11) NOT NULL,
  `feature` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcription_plan`
--

INSERT INTO `subcription_plan` (`id_subcription_plan`, `name_plan`, `price`, `active_period_in_month`, `feature`) VALUES
(1, 'Basic', '100000', 3, 'ok'),
(2, 'Gold', '300000', 6, 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `passw`, `role`) VALUES
(1, 'rizki', 'coba@gmail.com', '123', 'admin'),
(4, 'Rizki Darmawan', 'tokorizki@gmail.com', '123', 'guest'),
(5, 'Iron Heart', 'arina@gmail.com', '123', 'guest'),
(6, 'Ms Marvel', 'admin@gmail.com', '123', 'guest'),
(7, 'galeri', 'try@gmail.com', ' ', 'guest'),
(8, 'galeri', 'galeri@gmail.com', '1234', 'guest');

-- --------------------------------------------------------

--
-- Table structure for table `user_subcription`
--

CREATE TABLE `user_subcription` (
  `id_user_subcription` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_subcription_plan` int(11) NOT NULL,
  `code_unique` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `expirate_date` date NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `snap_token` varchar(255) NOT NULL,
  `url_snap_redirect` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_subcription`
--

INSERT INTO `user_subcription` (`id_user_subcription`, `id_user`, `id_subcription_plan`, `code_unique`, `price`, `expirate_date`, `payment_status`, `snap_token`, `url_snap_redirect`) VALUES
(52, 1, 1, 'STREAM-9sezlW63Tw', '100000', '2023-04-12', 'pending', '0dfe4486-5cba-491e-9371-631b74fde602', 'https://app.sandbox.midtrans.com/snap/v3/redirection/0dfe4486-5cba-491e-9371-631b74fde602'),
(53, 1, 1, 'STREAM-BSbN3N3Rds', '100000', '2023-04-12', 'pending', '5eb331e9-ca71-4cce-a157-cbd99dc07489', 'https://app.sandbox.midtrans.com/snap/v3/redirection/5eb331e9-ca71-4cce-a157-cbd99dc07489');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id_movie`);

--
-- Indexes for table `subcription_plan`
--
ALTER TABLE `subcription_plan`
  ADD PRIMARY KEY (`id_subcription_plan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_subcription`
--
ALTER TABLE `user_subcription`
  ADD PRIMARY KEY (`id_user_subcription`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_subcription_plan` (`id_subcription_plan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id_movie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subcription_plan`
--
ALTER TABLE `subcription_plan`
  MODIFY `id_subcription_plan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_subcription`
--
ALTER TABLE `user_subcription`
  MODIFY `id_user_subcription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_subcription`
--
ALTER TABLE `user_subcription`
  ADD CONSTRAINT `user_subcription_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_subcription_ibfk_2` FOREIGN KEY (`id_subcription_plan`) REFERENCES `subcription_plan` (`id_subcription_plan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
