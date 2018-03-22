--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `text`, `created`) VALUES
(1, 'test 1', 'test-1', 'test news 1', '2018-03-22 11:00:00'),
(2, 'test 2', 'test-2', 'test news 2', '2018-03-22 13:00:00'),
(3, 'Test 3', 'test-3', 'Test news 3 \"text\"', '2018-03-22 15:29:56'),
(4, 'Test news title', 'test-news-title', 'Test news 4 with text and text and \"text\"', '2018-03-22 15:30:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;