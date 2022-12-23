# BlogSystem

dowload the folder and paste it xampp/htdocs.
and open in localhost.
databse:-

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `firstName` varchar(100) NOT NULL,
    `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
   `phone` bigint(10) NOT NULL,
  `password` varchar(100) NOT NULL,
   `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `posts` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `user_id` int(11) DEFAULT NULL,
 `title` varchar(255) NOT NULL,
 `post` text NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1
