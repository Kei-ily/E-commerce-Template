-- Database and table for training_maps carousel
CREATE DATABASE IF NOT EXISTS training_maps CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE training_maps;

CREATE TABLE IF NOT EXISTS countries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  capital VARCHAR(255) DEFAULT NULL,
  image_url TEXT DEFAULT NULL,
  image_name VARCHAR(255) DEFAULT NULL,
  image_blob LONGBLOB DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data (images taken from the template). image_name and image_blob are NULL.
INSERT IGNORE INTO countries (id, name, capital, image_url, image_name, image_blob) VALUES
(1,'The Philippines','Manila','https://cdn.britannica.com/73/3473-050-3A33E719/Flag-Philippines.jpg',NULL,NULL),
(2,'Japan','Tokyo','https://static.vecteezy.com/system/resources/previews/029/574/379/original/flat-illustration-of-japan-flag-japan-flag-free-vector.jpg',NULL,NULL),
(3,'United States of America','Washington, D.C','https://th.bing.com/th/id/OIP.5k3WNuXphz58RseLAG2n-wHaD9?w=314&h=180&c=7&r=0&o=7&dpr=1.2&pid=1.7&rm=3',NULL,NULL),
(4,'Vietnam','Hanoi','https://th.bing.com/th/id/OIP.V14v5L6VghCv5WXUskcEQAHaEK?w=291&h=180&c=7&r=0&o=7&dpr=1.2&pid=1.7&rm=3',NULL,NULL),
(5,'Australia','Canberra','https://th.bing.com/th/id/OIP.QVqhP3xS_gY4J2bktHUyhwHaEK?w=390&h=185&c=7&r=0&o=7&dpr=1.2&pid=1.7&rm=3',NULL,NULL);
