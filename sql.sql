CREATE TABLE `admin` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `full_name` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
)

INSERT INTO `admin` (`full_name`, `username`, `email`, `password`) VALUES ('Admin Bi-gramFinance', 'admin', 'admin@gmail.com', '$2y$10$It7/ICPiz09XZTN4EEH3R.ywSgzC7IdcsB3BqM3F/HaBVkHoHeYu.');

id, withdrawal_id, user_id, amount, method, address,withdrawal_status, withdrawal_date