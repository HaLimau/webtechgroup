-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 11:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookID` int(11) NOT NULL,
  `ISBN` varchar(255) DEFAULT NULL,
  `book_code` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `in_stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `ISBN`, `book_code`, `title`, `author`, `publish_date`, `publisher`, `cover_image`, `description`, `in_stock`) VALUES
(1, '1927310237192', 'ME1233123', 'Okay sdh', 'Weiss', '2023-10-29', 'Self Published', 'BookCoverMissing.png', 'Mo1', 1),
(2, '9780061124266', 'B0006IU3DW', 'Brave New World', 'Aldous Huxley', '2006-10-17', 'Harper Perennial Modern Classics', 'BookCoverMissing.png', 'A dystopian novel that explores a future society where people are engineered for specific roles.', 1),
(3, '9780553213102', 'B000FC2J26', 'Pride and Prejudice', 'Jane Austen', '1983-12-01', 'Bantam Classics', 'BookCoverMissing.png', 'A classic romance novel that explores the themes of love and social expectations.', 1),
(4, '9780679723165', 'B000FC2J64', 'The Great Gatsby', 'F. Scott Fitzgerald', '1991-01-01', 'Vintage', 'BookCoverMissing.png', 'A novel set during the Roaring Twenties that explores the American Dream.', 1),
(5, '9780451524935', 'B001C1RKYG', 'The Catcher in the Rye', 'J.D. Salinger', '1991-05-01', 'Little, Brown and Company', 'BookCoverMissing.png', 'A novel that follows the experiences of a young man in New York City.', 1),
(6, '9780143111597', 'B000W969JQ', 'Fahrenheit 451', 'Ray Bradbury', '2004-01-01', 'Simon & Schuster', 'BookCoverMissing.png', 'A dystopian novel that explores the consequences of a society that bans books.', 1),
(7, '9780061120084', 'B000JMKT1Q', 'Lord of the Flies', 'William Golding', '2003-12-16', 'Perigee Books', 'BookCoverMissing.png', 'A novel that explores the dark side of human nature through the experiences of stranded boys.', 1),
(8, '9781400032716', 'B0016NZHAW', 'The Da Vinci Code', 'Dan Brown', '2003-03-18', 'Anchor', 'BookCoverMissing.png', 'A mystery thriller that follows a Harvard symbologist in a quest for hidden secrets.', 1),
(9, '9780062315007', 'B00BATNNPC', 'The Fault in Our Stars', 'John Green', '2014-04-08', 'Penguin Books', 'BookCoverMissing.png', 'A heartwarming novel that explores themes of love and loss in the face of illness.', 1),
(11, '9780345806971', 'B00770S8OK', 'The Hunger Games', 'Suzanne Collins', '2010-07-06', 'Scholastic Press', 'BookCoverMissing.png', 'A dystopian novel that follows the story of Katniss Everdeen in a televised fight to the death.', 1),
(12, '9780143039433', 'B0009XH52W', 'The Road', 'Cormac McCarthy', '2006-09-26', 'Vintage', 'BookCoverMissing.png', 'A post-apocalyptic novel that explores the journey of a father and son in a desolate world.', 1),
(13, '9780141187761', 'B002RI9XP2', 'One Flew Over the Cuckoo\'s Nest', 'Ken Kesey', '2002-11-21', 'Penguin Classics', 'BookCoverMissing.png', 'A novel set in a mental institution that challenges the authority of oppressive systems.', 1),
(14, '9780670030642', 'B002Y27P46', 'The Girl with the Dragon Tattoo', 'Stieg Larsson', '2008-09-16', 'Knopf', 'BookCoverMissing.png', 'A mystery thriller that follows journalist Mikael Blomkvist and hacker Lisbeth Salander.', 1),
(15, '9780307387899', 'B002VYRP8S', 'The Girl on the Train', 'Paula Hawkins', '2015-01-13', 'Riverhead Books', 'BookCoverMissing.png', 'A psychological thriller that unfolds through the perspectives of three women on a train.', 1),
(16, '9780743273565', 'B000FC2J6O', 'The Shining', 'Stephen King', '2002-06-26', 'Anchor', 'BookCoverMissing.png', 'A horror novel that explores the supernatural events that occur in an isolated hotel.', 1),
(17, '9780143128540', 'B009K3FWTC', 'Gone Girl', 'Gillian Flynn', '2014-04-22', 'Broadway Books', 'BookCoverMissing.png', 'A psychological thriller that explores the disappearance of a woman and the media frenzy that follows.', 1),
(18, '9780143039488', 'B00T3DNKIE', 'Life of Pi', 'Yann Martel', '2003-05-01', 'Mariner Books', 'BookCoverMissing.png', 'A novel that tells the story of Pi Patel, who survives a shipwreck and shares a lifeboat with a Bengal tiger.', 1),
(19, '9780743273565', 'B000FC2J64', 'Moby-Dick', 'Herman Melville', '2003-08-01', 'Signet Classics', 'BookCoverMissing.png', 'A classic novel that follows the obsessed Captain Ahab in his quest for the elusive white whale.', 1),
(20, '9780385319959', 'B000SEGEIU', 'Jurassic Park', 'Michael Crichton', '1990-11-20', 'Ballantine Books', 'BookCoverMissing.png', 'A science fiction novel that explores the consequences of cloning dinosaurs for a theme park.', 1),
(21, 'a', 'a', 'a', 'a', '2024-01-03', 'a', 'BookCoverMissing.png', 'a', 1),
(39, 'dddd', 'dzzzzzzzx', 'sdddddddddddd', 'xxxxx', '2024-01-03', 'xxxx', 'BookCoverMissing.png', 'xx', 0),
(40, '', '', '', '', '0000-00-00', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_reviews`
--

CREATE TABLE `book_reviews` (
  `review_id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `bookID` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_reviews`
--

INSERT INTO `book_reviews` (`review_id`, `userID`, `bookID`, `rating`, `comment`, `timestamp`) VALUES
(1, 1, 1, 5, 'WOW', '2024-01-09 16:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `borrowarchive`
--

CREATE TABLE `borrowarchive` (
  `borrow_arID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `bookID` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `return_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `borrowID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `bookID` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `return_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`borrowID`, `userID`, `bookID`, `start_date`, `due_date`, `return_status`) VALUES
(1, 2, 1, '2024-01-04', '2024-01-17', 'Not Returned'),
(4, 2, 1, '2024-01-10', '2024-01-16', 'Returned'),
(5, 2, 1, '2024-01-10', '2024-01-16', 'Not Returned'),
(6, 2, 1, '2024-01-10', '2024-01-16', 'Not Returned'),
(7, 2, 1, '2024-01-12', '2024-01-16', 'Not Returned'),
(8, 2, 7, '2024-01-10', '2024-01-16', 'Not Returned');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date_published` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `newsType` int(11) NOT NULL DEFAULT 1 CHECK (`newsType` in (1,2))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsID`, `title`, `content`, `date_published`, `image`, `newsType`) VALUES
(2, 'sadssadsa', 'asdsad', '2024-01-09', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `printorders`
--

CREATE TABLE `printorders` (
  `printerOrderID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `datetime_req` datetime DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `print_requests`
--

CREATE TABLE `print_requests` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `datetime_req` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `print_requests`
--

INSERT INTO `print_requests` (`id`, `userID`, `file_name`, `name`, `phone`, `datetime_req`) VALUES
(1, 2, 'OrderSummary.pdf', 'asdadsad', 'asdsad', '2024-01-13 03:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `roombookarchive`
--

CREATE TABLE `roombookarchive` (
  `booking_arID` int(11) NOT NULL,
  `roomID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roombookings`
--

CREATE TABLE `roombookings` (
  `bookingID` int(11) NOT NULL,
  `roomID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomID` int(11) NOT NULL,
  `roomName` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `roomType` int(11) DEFAULT NULL COMMENT 'Hall=1, Cubicle=2, Seminar=3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomID`, `roomName`, `location`, `capacity`, `roomType`) VALUES
(1, 'meowmeomwoemowemwoew', 'asdsada', 3, 2),
(4, 'sadsad', 'sadasdaaaaa', 1, 3),
(5, 'aasda', 'asd', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL COMMENT 'student=1,staff=2,admin=0,outsider=3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `email`, `user_password`, `user_type`) VALUES
(1, '123', '1@1.com', '$2y$10$gR9l3kUokHwG9sTdEayP5.Qj3NfhOk2SK6U.Ucxcvle34ygILz.Am', 0),
(2, '1', '11@1.com', '$2y$10$mPe0Gwl6jHGH2u1g7o6k8uN3QlGU6LJ0r1Rkq4/Sz9xer8C8kdUIu', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `bookID` (`bookID`);

--
-- Indexes for table `borrowarchive`
--
ALTER TABLE `borrowarchive`
  ADD PRIMARY KEY (`borrow_arID`);

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`borrowID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `bookID` (`bookID`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- Indexes for table `printorders`
--
ALTER TABLE `printorders`
  ADD PRIMARY KEY (`printerOrderID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `print_requests`
--
ALTER TABLE `print_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `roombookarchive`
--
ALTER TABLE `roombookarchive`
  ADD PRIMARY KEY (`booking_arID`);

--
-- Indexes for table `roombookings`
--
ALTER TABLE `roombookings`
  ADD PRIMARY KEY (`bookingID`),
  ADD KEY `roomID` (`roomID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `book_reviews`
--
ALTER TABLE `book_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `borrowarchive`
--
ALTER TABLE `borrowarchive`
  MODIFY `borrow_arID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `borrowID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `printorders`
--
ALTER TABLE `printorders`
  MODIFY `printerOrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `print_requests`
--
ALTER TABLE `print_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roombookarchive`
--
ALTER TABLE `roombookarchive`
  MODIFY `booking_arID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roombookings`
--
ALTER TABLE `roombookings`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD CONSTRAINT `book_reviews_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `book_reviews_ibfk_2` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`);

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrows_ibfk_2` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`) ON DELETE CASCADE;

--
-- Constraints for table `printorders`
--
ALTER TABLE `printorders`
  ADD CONSTRAINT `printorders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `print_requests`
--
ALTER TABLE `print_requests`
  ADD CONSTRAINT `print_requests_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `roombookings`
--
ALTER TABLE `roombookings`
  ADD CONSTRAINT `roombookings_ibfk_1` FOREIGN KEY (`roomID`) REFERENCES `rooms` (`roomID`) ON DELETE CASCADE,
  ADD CONSTRAINT `roombookings_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
