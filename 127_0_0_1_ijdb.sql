--
-- Database: `ijdb`
--
CREATE DATABASE IF NOT EXISTS `ijdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ijdb`;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--
-- Creation: May 10, 2023 at 10:36 AM
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `author`:
--

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `email`) VALUES
(1, 'Kevin Yank', 'thatguy@kevinyank.com'),
(2, 'Tom Butler', 'tom@r.je');

-- --------------------------------------------------------

--
-- Table structure for table `joke`
--
-- Creation: May 20, 2023 at 09:09 PM
--

CREATE TABLE `joke` (
  `id` int(11) NOT NULL,
  `jokeText` text DEFAULT NULL,
  `jokeDate` date DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `joke`:
--

--
-- Dumping data for table `joke`
--

INSERT INTO `joke` (`id`, `jokeText`, `jokeDate`, `authorId`) VALUES
(2, 'Switch the loop with a variable r in between and you get a Switcharoo\'p', '2021-01-29', 2),
(3, 'Tell me why you are so lazy?, Well am waiting for you to finish loading', '2023-05-06', 2),
(4, 'All i did was set it to a constant, now it wont stop looping', '2023-06-21', 2),
(5, 'C my name is ruby! Ruby on rails.', '2023-05-15', 1),
(6, 'Format you, when? the next you update!	', '2023-05-18', 1),
(20, 'C when its Py', '2023-06-26', 1),
(21, 'Oi, Java, what you hava?', '2023-05-21', 1),
(22,'API, is that you or Py?', '2023-06-27', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joke`
--
ALTER TABLE `joke`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `joke`
--
ALTER TABLE `joke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
