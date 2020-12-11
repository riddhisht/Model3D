

CREATE TABLE `models` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




INSERT INTO `models` (`id`, `name`, `code`, `image`, `price`) VALUES
(12, 'Baymax', 'aq1', 'images/Baymax.png', 2000),
(13, 'Fall Guy', 'aq2', 'images/Fall Guy.png', 1500),
(14, 'Make Joke Of', 'aq3', 'images/Make Joke Of.png', 2000),
(15, 'Android', 'aq4', 'images/Android.png', 1500);


ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);


ALTER TABLE `models`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;


