SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `expa` (
  `id` int(16) NOT NULL,
  `yaw` double NOT NULL,
  `pitch` double NOT NULL,
  `popis` varchar(1024) COLLATE utf8_bin NOT NULL,
  `url` varchar(1024) COLLATE utf8_bin NOT NULL,
  `valid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `expa`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `expa`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;
COMMIT;