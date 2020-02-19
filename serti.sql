CREATE DATABASE `serti`;

/*
MIT License

Copyright (c) 2020 Hendy (M. Khoiri Muzaki, Alland C. Kesuma)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

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
  `organizer` VARCHAR(255) NOT NULL,
  `serial` CHAR(39) NOT NULL
);

INSERT INTO `sertifikat` (`id`, `nama`, `tgl_keluar`, `tgl_exp`, `username_id`, `event`, `organizer`, `serial`) VALUES
('pusbangki_0', 'Hendy', '2020-02-07', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI','5AAB-E917-73A0-0664-2AE3-1C7A-39E7-D02E'),
('pusbangki_1', 'Alland Chandra Kesuma', '2020-02-07', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI','1B42-F3F1-8097-3926-0A3B-7D66-1567-84E6'),
('pusbangki_2', 'Muhammad Khoiri Muzzaki', '2020-02-07', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI','BBB9-BE87-4CFA-8CD7-BD8F-1151-5C6F-CC81'),
('pusbangki_3', 'Muhammad Sabiil', '2020-02-07', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI','5FBB-3B92-1718-1369-CBB5-F238-D6E5-B599'),
('pusbangki_4', 'Dani Abdul Malik', '2020-02-11', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI','4C13-92F6-7ED4-CF5D-E632-C4BE-0DEE-97D3'),
('pusbangki_5', 'Evita Oktaviani', '2020-02-11', NULL, 'pusbangki', 'Kerja Praktek', 'UKK PUSBANGKI FKUI','C290-2092-2545-FD10-9186-4889-6204-B61C');


ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`username_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

ALTER TABLE `sertifikat`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`username_id`) REFERENCES `user` (`username`) ON UPDATE CASCADE;
  
/*SELECT * FROM sertifikat;*/