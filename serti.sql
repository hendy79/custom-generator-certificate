CREATE DATABASE serti;

USE serti;

CREATE TABLE `organizer` (
  `id` INT(11) UNSIGNED NOT NULL,
  `nama_organizer` VARCHAR(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`id`, `nama_organizer`) VALUES
(1, 'UKK PUSBANGKI'),
(2, 'Fakultas Kedokteran UI'),
(3, 'ESQ Training');


-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` INT(10) UNSIGNED NOT NULL,
  `nama_event` VARCHAR(255) NOT NULL,
  `waktu_event` DATE NOT NULL,
  `organizer_id` INT(10) UNSIGNED NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `nama_event`, `waktu_event`, `organizer_id`) VALUES
(1, 'Workshop', '2020-02-07', 1),
(2, 'Seminar Kesehatan', '2020-02-07', 2),
(3, 'Job Fair', '2020-02-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id` VARCHAR(255) NOT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `tgl_keluar` DATE NOT NULL,
  `tgl_exp` DATE NOT NULL,
  `event_id` INT(10) UNSIGNED NOT NULL,
  `organizer_id` INT(10) UNSIGNED NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id`, `nama`, `tgl_keluar`, `tgl_exp`, `event_id`, `organizer_id`) VALUES
('pusbangki_0', 'Alland', '2020-02-07', '2024-02-07', 3, 1),
('pusbangki_1', 'Hendy', '2020-02-07', '2024-02-07', 1, 1),
('pusbangki_2', 'Zaki', '2020-02-07', '2024-02-07', 2, 2),
('pusbangki_3', 'Sabiil', '2020-02-07', '2024-02-07', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`id`);
  
--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organizer_id` (`organizer_id`);




--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `organizer_id` (`organizer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_organizer` FOREIGN KEY (`organizer_id`) REFERENCES `organizer` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_organizer` FOREIGN KEY (`organizer_id`) REFERENCES `organizer` (`id`) ON UPDATE CASCADE;
COMMIT;
