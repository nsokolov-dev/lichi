CREATE TABLE IF NOT EXISTS `tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `script_name` varchar(25) NOT NULL,
  `start_time` int DEFAULT NULL,
  `end_time` int DEFAULT NULL,
  `result` enum('normal','illegal','failed','success') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX tests_result_index USING BTREE ON tests (`result`);
