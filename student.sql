DROP TABLE IF EXISTS `user_info`;

CREATE TABLE `user_info` (
  `id` INT(11) NOT NULL PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `email` VARCHAR(50) NOT NULL,  -- Increased email size to 50
  `address` VARCHAR(200) NOT NULL,
  `gender` VARCHAR(20) NOT NULL,
  `course` VARCHAR(50) NOT NULL,
  `l_mode` VARCHAR(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE user_info AUTO_INCREMENT = 1;

SHOW CREATE TABLE user_info;
