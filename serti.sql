CREATE DATABASE `serti`;

USE `serti`;

CREATE TABLE `user` (
  `username` VARCHAR(255) NOT NULL,
  `Nama` VARCHAR(255) NOT NULL
);

INSERT INTO `user` (`username`, `Nama`) VALUES
('pusbangki', 'PUSBANGKI');

CREATE TABLE `sertifikat` (
  `id` VARCHAR(255) NOT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `tgl_keluar` DATE NOT NULL,
  `tgl_exp` DATE DEFAULT NULL,
  `username_id` VARCHAR(255) NOT NULL,
  `event` VARCHAR(255) NOT NULL,
  `organizer` VARCHAR(255) NOT NULL
);

INSERT INTO `sertifikat` (`id`, `nama`, `tgl_keluar`, `tgl_exp`, `username_id`, `event`, `organizer`) VALUES
('pusbangki_0', 'Hendy', '2020-02-07', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI'),
('pusbangki_1', 'Alland Chandra Kesuma', '2020-02-07', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI'),
('pusbangki_2', 'Muhammad Khoiri Muzzaki', '2020-02-07', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI'),
('pusbangki_3', 'Muhammad Sabiil', '2020-02-07', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI'),
('pusbangki_4', 'Dani Abdul Malik', '2020-02-11', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI'),
('pusbangki_5', 'Evita Oktaviani', '2020-02-11', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI');


ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`username_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

ALTER TABLE `sertifikat`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`username_id`) REFERENCES `user` (`username`) ON UPDATE CASCADE;
  
SELECT * FROM sertifikat;